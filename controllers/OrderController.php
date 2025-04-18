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
use app\models\Users\User;

class OrderController extends BaseController {
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
     * Fetch a list of orders with requested conditions and associative promise data.
     *
     * @param Request $request  The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with the list of orders.
     */
    public function getOrderList($request, $response): void {
        // Initialize models
        $orderModel = new Orders();
        $orderPromiseModel = new OrderPromises();
        $serviceModel = new Service();
        $userModel = new User();
    
        // Parse request parameters
        $queryParams = $request->getQueryParams();
        $includeCustomer = filter_var($queryParams['include_customer'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $includeSeller = filter_var($queryParams['include_seller'] ?? false, FILTER_VALIDATE_BOOLEAN);
    
        // Extract filter conditions from query parameters
        $conditions = [];
        if (!empty($queryParams['customer_id'])) {
            $conditions['customer_id'] = $queryParams['customer_id'];
        }
        
        if (!empty($queryParams['seller_id'])) {
            $conditions['seller_id'] = $queryParams['seller_id'];
        }
        
        if (!empty($queryParams['order_status'])) {
            $conditions['order_status'] = $queryParams['order_status'];
        }
        
        if (!empty($queryParams['payment_type'])) {
            $conditions['payment_type'] = $queryParams['payment_type'];
        }
    
        // Set up pagination
        $limit = isset($queryParams['limit']) ? (int)$queryParams['limit'] : 10;
        $offset = isset($queryParams['offset']) ? (int)$queryParams['offset'] : 0;
        
        // Set up sorting
        $sortBy = $queryParams['sort_by'] ?? 'created_at';
        // Validate sort column (allow only safe columns)
        error_log("sortBy: ");
        error_log($sortBy);
        $orderDir = strtoupper($queryParams['order_dir'] ?? 'DESC');
        
        // Validate sort direction
        if (!in_array($orderDir, ['ASC', 'DESC'])) {
            $orderDir = 'DESC';
        }
        
        // Validate sort column (allow only safe columns)
        $allowedSortColumns = ['order_id', 'service_id', 'customer_id', 'seller_id', 'payment_type', 'delivered_date', 'order_status', 'created_at'];
        if (!in_array($sortBy, $allowedSortColumns)) {
            $sortBy = 'created_at';
        }
        
        // Handle date range filtering
        if (!empty($queryParams['date_from']) && !empty($queryParams['date_to'])) {
            $dateFrom = date('Y-m-d H:i:s', strtotime($queryParams['date_from']));
            $dateTo = date('Y-m-d 23:59:59', strtotime($queryParams['date_to']));
            
            $sql = "SELECT * FROM orders WHERE created_at BETWEEN :date_from AND :date_to";
            $params = [':date_from' => $dateFrom, ':date_to' => $dateTo];
            
            // Add other conditions if they exist
            foreach ($conditions as $key => $value) {
                $sql .= " AND $key = :$key";
                $params[":$key"] = $value;
            }
            
            // Add sorting
            $sql .= " ORDER BY $sortBy $orderDir";
            
            // Add pagination
            $sql .= " LIMIT $limit OFFSET $offset";
            
            $orders = $orderModel->executeCustomQuery($sql, $params);
        } else {
            // Prepare options for read method
            $options = [
                'order' => "$sortBy $orderDir",
                'limit' => $limit,
                'offset' => $offset
            ];
            
            // Handle search parameter
            if (!empty($queryParams['search'])) {
                $options['search'] = $queryParams['search'];
                $options['searchColumns'] = ['order_id']; // Add more searchable columns if needed
            }

            error_log("options: ");
            error_log(print_r($options, 1));
            
            // Fetch orders based on conditions and options
            $orders = $orderModel->read($conditions, $options);
        }
    
        // Get total count for pagination metadata
        $totalOrders = $orderModel->count($conditions);
    
        if (empty($orders)) {
            $response->sendJson([
                'success' => false,
                'message' => 'No orders found matching the specified conditions.',
                'pagination' => [
                    'total' => 0,
                    'limit' => $limit,
                    'offset' => $offset,
                    'total_pages' => 0,
                    'current_page' => 1
                ]
            ]);
            return;
        }
    
        $orderList = [];
    
        // Fetch promises and customers for each order
        foreach ($orders as $order) {
            $promise = $orderPromiseModel->getPromiseByOrderId($order['order_id']);
            $order['promise'] = $promise;
    
            if ($includeCustomer) {
                $customer = $userModel->getUserById($order['customer_id']);
                $order['customer'] = $customer;
            }
    
            if ($includeSeller) {
                $service = $serviceModel->getServiceById($order['service_id']);
                if ($service) {
                    $seller = $userModel->getUserById($service['user_id']);
                    $order['seller'] = $seller;
                }
            }
    
            $orderList[] = $order;
        }
    
        // Calculate pagination metadata
        $totalPages = ceil($totalOrders / $limit);
        $currentPage = floor($offset / $limit) + 1;
    
        // Return the response
        $response->sendJson([
            'success' => true,
            'message' => 'Order list retrieved successfully.',
            'data' => $orderList,
            'pagination' => [
                'total_records' => $totalOrders,
                'total_pages' => $totalPages,
                'current_page' => $currentPage,
                'limit' => $limit,
                'offset' => $offset,
                'has_next' => ($currentPage < $totalPages),
                'has_prev' => ($currentPage > 1)
            ]
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
