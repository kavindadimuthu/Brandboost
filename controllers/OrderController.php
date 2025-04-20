<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\DebugHelper;
use app\core\Utils\FileHandler;
use app\models\Orders\Orders;
use app\models\Orders\OrderPromises;
use app\models\Services\Service;
use app\models\Services\ServicePackage;

class OrderController extends BaseController {
    /**
     * Fetch a list of orders with requested conditions and associative promise data.
     *
     * @param Request $request  The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with the list of orders.
     */
    public function getOrderList($request, $response) {

        // Parse request parameters
        $queryParams = $request->getQueryParams();

        // Pagination and sorting
        $limit = isset($queryParams['limit']) ? (int)$queryParams['limit'] : 10;
        $offset = isset($queryParams['offset']) ? (int)$queryParams['offset'] : 0;
        $sortBy = $queryParams['sort_by'] ?? 'orders.created_at';
        $orderDir = strtoupper($queryParams['order_dir'] ?? 'DESC');
        $allowedSortColumns = [
            'orders.order_id', 'orders.service_id', 'orders.customer_id', 'orders.seller_id',
            'orders.payment_type', 'orders.delivered_date', 'orders.order_status', 'orders.created_at'
        ];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'orders.created_at';
        }
        if (!in_array($orderDir, ['ASC', 'DESC'])) {
            $orderDir = 'DESC';
        }

        $options = [
            'limit' => $limit,
            'offset' => $offset,
            'order' => $sortBy . ' ' . $orderDir,
        ];

        // Extract search query
        if (!empty($queryParams['search'])) {
            $options['search'] = $queryParams['search'];
            $options['searchColumns'] = ['orders.order_id', 'service.title', 'customer.name', 'seller.name'];
        }

        // Extract filter conditions from query parameters
        $filters = [];
        if (!empty($queryParams['customer_id'])) {
            $filters['orders.customer_id'] = $queryParams['customer_id'];
        }
        if (!empty($queryParams['seller_id'])) {
            $filters['orders.seller_id'] = $queryParams['seller_id'];
        }
        if (!empty($queryParams['order_status'])) {
            $filters['orders.order_status'] = $queryParams['order_status'];
        }
        if (!empty($queryParams['payment_type'])) {
            $filters['orders.payment_type'] = $queryParams['payment_type'];
        }

        // Date range filtering
        if (!empty($queryParams['date_from'])) {
            $filters['orders.created_at >='] = $queryParams['date_from'];
        }
        if (!empty($queryParams['date_to'])) {
            $filters['orders.created_at <='] = $queryParams['date_to'] . ' 23:59:59';
        }

        // Add filters to options if any
        if (!empty($filters)) {
            $options['filters'] = $filters;
        }

        // Initialize models
        $orderModel = $this->model('Orders\Orders');

        $orders = $orderModel->getOrdersWithDetails([], $options); // Fetch orders with joined details
        if ($orders === false) {
            return $response->sendError('Failed to retrieve orders.', 500);
        }

        $totalOrders = $orderModel->count([], $options); // Get total count for pagination
        // Pagination metadata
        $totalPages = ceil($totalOrders / $limit);
        $currentPage = floor($offset / $limit) + 1;
        $pagination = [
            'total_records' => $totalOrders,
            'total_pages' => $totalPages,
            'current_page' => $currentPage,
            'limit' => $limit,
            'offset' => $offset,
        ];

        if (empty($orders)) {
            return $response->sendJson([
                'success' => true,
                'message' => 'No orders found matching the specified conditions.',
                'data' => [],
                'pagination' => $pagination
            ]);
        }

        return $response->sendJson([
            'success' => true,
            'message' => 'Order list retrieved successfully.',
            'data' => $orders,
            'pagination' => $pagination
        ]);
    }


    /**
     * Fetch order profile with all associative data.
     *
     * @param Request $request  The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with order details or error message.
     */
    public function getOrderProfile($request, $response): void
    {
        error_log("entered to getOrderProfile");
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Retrieve query parameters
        $queryParams = $request->getQueryParams();
        $orderId = $queryParams['id'];
        $includeUser = $queryParams['include_user'] ?? false;

        // Validate required parameter
        if (empty($orderId)) {
            $response->sendError('Missing required parameter: order_id.', 400);
            return;
        }

        // Retrieve the necessary models
        $orderModel = $this->model('Orders\Orders');
        $orderPromiseModel = $this->model('Orders\OrderPromises');
        $userModel = $this->model('Users\User'); // Assuming a User model exists

        error_log($orderId);
        // Fetch order data
        $orderData = $orderModel->getOrderById($orderId);

        if (!$orderData) {
            $response->sendError('Order not found.', 404);
            return;
        }

        // Fetch associated promises
        $promise = $orderPromiseModel->getPromiseByOrderId($orderId);

        if (!$promise) {
            $response->sendError('No promise found for this order.', 404);
            return;
        }

        // Construct the response
        $orderProfile = [
            'order' => $orderData,
            'promise' => $promise
        ];

        // Include user details if requested
        if ($includeUser) {
            $userId = $orderData['customer_id']; // Assuming the order data contains a user_id field
            $user = $userModel->getUserById($userId);

            if ($user) {
                $orderProfile['user'] = $user;
            } else {
                $orderProfile['user'] = null; // Or handle the case where the user is not found
            }
        }

        // Send the response with order profile data
        $response->sendJson([
            'success' => true,
            'message' => 'Order profile retrieved successfully.',
            'data' => $orderProfile
        ]);
    }


    /**
     * Create a new order API endpoint.
     *
     * @param Request $request  The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response indicating success or failure.
     */
    public function createOrder($request, $response): void {

        // Initialize models
        $orderModel = new Orders();
        $orderPromisesModel = new OrderPromises();
        $serviceModel = new Service();
        $servicePackageModel = new ServicePackage();

        // Parse request body
        $requestData = $request->getParsedBody();
        DebugHelper::logArray($requestData);

        // Validate required fields
        $requiredFields = ['service_id', 'payment_type'];
        $missingFields = array_filter($requiredFields, fn($field) => empty($requestData[$field]));

        if (!empty($missingFields)) {
            $response->sendJson([
                'success' => false,
                'message' => 'Missing required fields: ' . implode(', ', $missingFields) . '.'
            ]);
            return;
        }

        // Extract data from the request
        $customerId = AuthHelper::getCurrentUser()['user_id'] ?? 1; // tempory user value is 1

        if (!$customerId) {
            $response->sendJson([
                'success' => false,
                'message' => 'Unauthorized access: user not authenticated.'
            ], 401);
            return;
        }

        $serviceId = $requestData['service_id'];
        $paymentType = $requestData['payment_type'];
        $packageId = $requestData['package_id'] ?? null;
        $customPackageId = $requestData['custom_package_id'] ?? null;
        $promises = json_decode($requestData['promises'] ?? '[]', true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $response->sendJson([
                'success' => false,
                'message' => 'Invalid JSON format in promises.'
            ]);
            return;
        }

        // Fetch service and package data
        $serviceData = $serviceModel->getServiceById($serviceId);
        $packageData = $servicePackageModel->getPackageById($packageId);

        if (!$serviceData || !$packageData) {
            $response->sendJson([
                'success' => false,
                'message' => 'Invalid service or package ID.'
            ]);
            return;
        }

        // Prepare order data
        $orderData = [
            'customer_id' => $customerId,
            'service_id' => $serviceId,
            'package_id' => $packageId,
            'custom_package_id' => $customPackageId,
            'payment_type' => $paymentType,
            'remained_revisions' => $packageData['revisions'] ?? 0, // Default value
            'order_status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Create the order
        if (!$orderModel->createOrder($orderData)) {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to create order.'
            ]);
            return;
        }

        // Get the last inserted order ID
        $orderId = $orderModel->getLastInsertId();

        // Add service description and package benefits to promised data
        $agreedData = json_encode([
            'title' => $serviceData['title'],
            'description' => $serviceData['description'],
            'delivery_formats' => $serviceData['delivery_formats'] ?? 'No delivery formats available.',
            'benefits' => $packageData['benefits'] ?? 'No benefits available.',
            'service_type' => $serviceData['service_type'] 
        ]);

        $buyerRequest = json_encode([
            'requirements' => $requestData['requirements'] ?? 'No requirements provided.',
            'description' => $requestData['description'] ?? 'No description provided.'
        ]);

        // Create promises associated with the order
        $promiseData = [
            'order_id' => $orderId,
            'accepted_service' => $agreedData,
            'requested_service' => $buyerRequest,
            'delivery_days' => $packageData['delivery_days'] ?? 0,
            'number_of_revisions' => $packageData['revisions'] ?? 0,
            'price' => $packageData['price'] ?? 0.00
        ];

        if (!$orderPromisesModel->createPromise($promiseData)) {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to create associated promises.'
            ]);
            return;
        }

        // Return success response
        $response->sendJson([
            'success' => true,
            'message' => 'Order created successfully.',
            'order_id' => $orderId
        ]);
    }


    /**
     * Update an existing order API endpoint.
     *
     * @param Request $request  The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response indicating success or failure.
     */
    public function updateOrder($request, $response): void {
        // Initialize models
        $orderModel = new Orders();

        // Parse request body
        $requestData = $request->getParsedBody();

        // Validate required fields
        if (empty($requestData['order_id'])) {
            $response->sendJson([
                'success' => false,
                'message' => 'Missing required field: order_id.'
            ]);
            return;
        }

        $orderId = $requestData['order_id'];
        $updateFields = [];

        // Check for fields to update
        if (!empty($requestData['delivered_date'])) {
            $updateFields['delivered_date'] = $requestData['delivered_date'];
        }
        if (isset($requestData['remained_revisions'])) {
            $updateFields['remained_revisions'] = (int)$requestData['remained_revisions'];
        }
        if (!empty($requestData['order_status'])) {
            $validStatuses = ['pending', 'in_progress', 'completed', 'canceled', 'disputed'];
            if (in_array($requestData['order_status'], $validStatuses, true)) {
                $updateFields['order_status'] = $requestData['order_status'];
            } else {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Invalid order_status value.'
                ]);
                return;
            }
        }

        // Ensure there are fields to update
        if (empty($updateFields)) {
            $response->sendJson([
                'success' => false,
                'message' => 'No valid fields provided for update.'
            ]);
            return;
        }

        // Update the order
        if (!$orderModel->updateOrderById($orderId, $updateFields)) {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to update order.'
            ]);
            return;
        }

        // Return success response
        $response->sendJson([
            'success' => true,
            'message' => 'Order updated successfully.',
            'updated_fields' => $updateFields
        ]);
    }
}
