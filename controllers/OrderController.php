<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\DebugHelper;
use app\core\Utils\FileHandler;
use app\models\Orders\Orders;
use app\models\Orders\Deliveries;
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
        $orderId = $queryParams['order_id'];
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
        $includeCustomer = $queryParams['include_customer'] ?? false;
        $includeSeller = $queryParams['include_seller'] ?? false;

        error_log($includeCustomer);

        // Extract filter conditions from query parameters
        $conditions = [];
        if (!empty($queryParams['customer_id'])) {
            $conditions['customer_id'] = $queryParams['customer_id'];
        }
        if (!empty($queryParams['order_status'])) {
            $conditions['order_status'] = $queryParams['order_status'];
        }
        // if (!empty($queryParams['date_from'])) {
        //     $conditions['date_from'] = $queryParams['date_from'];
        // }
        // if (!empty($queryParams['date_to'])) {
        //     $conditions['date_to'] = $queryParams['date_to'];
        // }

        // Fetch orders based on conditions
        $orders = $orderModel->read($conditions);

        if (empty($orders)) {
            $response->sendJson([
                'success' => false,
                'message' => 'No orders found matching the specified conditions.'
            ]);
            return;
        }

        $orderList = [];

        // Fetch promises and customers for each order
        foreach ($orders as $order) {
            $promise = $orderPromiseModel->getPromiseByOrderId($order['order_id']);
            $order['promise'] = $promise;

            if ($includeCustomer) {
                error_log("entered into loop");
                $customer = $userModel->getUserById($order['customer_id']);
                $order['customer'] = $customer;
            }

            if($includeSeller){
                $service = $serviceModel->getServiceById($order['service_id']);
                $seller = $userModel->getUserById($service['user_id']);
                $order['seller'] = $seller;
            }

            $orderList[] = $order;
        }
        error_log(print_r($orderList, true));

        // Return the response
        $response->sendJson([
            'success' => true,
            'message' => 'Order list retrieved successfully.',
            'data' => $orderList
        ]);
    }


    /**
     * Fetch a list of orders for the currently logged-in seller.
     *
     * @param Request $request  The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with the list of orders.
     */
    public function getSellerOrders($request, $response): void {
        try {
            // Initialize models
            $orderModel = new Orders();
            $orderPromiseModel = new OrderPromises();
            $serviceModel = new Service();
            $userModel = new User();
            
            // Get current logged-in user (seller)
            $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;
            $sellerRole  = AuthHelper::getCurrentUser()['role'];
            error_log("Seller ID: " . ($sellerId ?? 'null'));
            error_log("Seller role: " . ($sellerRole ?? 'null'));
            
            if (!$sellerId) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Unauthorized access: user not authenticated.'
                ], 401);
                return;
            }
            
            // Parse request parameters
            // $queryParams = $request->getQueryParams();
            // $page = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
            // $limit = isset($queryParams['limit']) ? (int)$queryParams['limit'] : 10;
            // $search = $queryParams['search'] ?? '';
            
            // Calculate offset for pagination
            // $offset = ($page - 1) * $limit;
            
            // Get orders directly by seller_id
            $orders = $orderModel->getOrdersBySellerId($sellerId);
            // $totalOrders = $orderModel->countOrdersBySellerId($sellerId);
            
            error_log("Found " . count($orders) . " orders for seller ID " . $sellerId);
            
            if (empty($orders)) {
                $response->sendJson([
                    'success' => true,
                    'message' => 'No orders found for your account.',
                    'data' => [],
                    // 'pagination' => [
                    //     'total' => 0,
                    //     'page' => $page,
                    //     'limit' => $limit,
                    //     'pages' => 0
                    // ]
                ]);
                return;
            }
            
            $orderList = [];
            
            // Enhance orders with additional information
            foreach ($orders as $order) {
                // Get promise data
                $promise = $orderPromiseModel->getPromiseByOrderId($order['order_id']);
                
                // Get service data
                $service = $serviceModel->getServiceById($order['service_id']);
                
                // Get customer data
                $customer = $userModel->getUserById($order['customer_id']);
                
                // Calculate due date based on order creation and delivery days
                $dueDate = null;
                if ($promise && isset($promise['delivery_days']) && isset($order['created_at'])) {
                    $createdDate = new \DateTime($order['created_at']);
                    $dueDate = $createdDate->modify("+{$promise['delivery_days']} days");
                    $dueDate = $dueDate->format('Y-m-d');
                }
                
                // Format order data for frontend
                $orderList[] = [
                    'order_id' => $order['order_id'],
                    'buyer' => $customer ? ($customer['name']) : 'Unknown',
                    'buyer_id' => $order['customer_id'],
                    'gig' => $service ? $service['title'] : 'Unknown Service',
                    'service_id' => $order['service_id'],
                    'dueOn' => $order['order_status'] === 'completed' ? 'Delivered' : ($dueDate ?? 'N/A'),
                    'total' => $promise ? ('LKR ' . number_format($promise['price'], 2)) : 'N/A',
                    'status' => ucfirst($order['order_status'] ?? 'Pending'),
                    'seller_role' => $sellerRole
                ];
            }
            
            // Return the response
            $response->sendJson([
                'success' => true,
                'message' => 'Seller orders retrieved successfully.',
                'data' => $orderList,
                // 'pagination' => [
                //     'total' => $totalOrders,
                //     'page' => $page,
                //     'limit' => $limit,
                //     'pages' => ceil($totalOrders / $limit)
                // ]
            ]);
        } catch (\Throwable $e) {
            error_log("Error in getSellerOrders: " . $e->getMessage());
            error_log("File: " . $e->getFile() . " Line: " . $e->getLine());
            error_log("Stack trace: " . $e->getTraceAsString());
            
            $response->sendJson([
                'success' => false,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
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
            'seller_id' => $serviceData['user_id'],	 // Assuming the service has a user_id field
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
            $validStatuses = ['pending', 'in_progress', 'completed', 'canceled'];
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
    
/**
     * Fetch delivery by ID with all associated data.
     *
     * @param Request $request The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with delivery details or error message.
     */
    public function getDelivery($request, $response): void
    {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Retrieve query parameters
        $queryParams = $request->getQueryParams();
        $deliveryId = $queryParams['delivery_id'] ?? null;

        // Validate required parameter
        if (empty($deliveryId)) {
            $response->sendError('Missing required parameter: delivery_id.', 400);
            return;
        }

        // Initialize models
        $deliveryModel = $this->model('Orders\Delivery');
        $orderModel = $this->model('Orders\Orders');

        // Fetch delivery data
        $deliveryData = $deliveryModel->getDeliveryById($deliveryId);

        if (!$deliveryData) {
            $response->sendError('Delivery not found.', 404);
            return;
        }

        // Fetch order data related to this delivery
        $orderData = $orderModel->getOrderById($deliveryData['order_id']);

        // Construct the response
        $deliveryProfile = [
            'delivery' => $deliveryData,
            'order' => $orderData
        ];

        // Send the response with delivery profile data
        $response->sendJson([
            'success' => true,
            'message' => 'Delivery retrieved successfully.',
            'data' => $deliveryProfile
        ]);
    }

    /**
     * Fetch all deliveries for a specific order.
     *
     * @param Request $request The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with deliveries list.
     */
    public function getOrderDeliveries($request, $response): void
    {
        error_log("entered to getOrderDeliveries");
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Retrieve query parameters
        $queryParams = $request->getQueryParams();
        $orderId = $queryParams['id'] ?? null;
        error_log("orderId: $orderId");

        // Validate required parameter
        if (empty($orderId)) {
            $response->sendError('Missing required parameter: order_id.', 400);
            return;
        }
        error_log("flag 1");

        // Initialize models
        $deliveryModel = $this->model('Orders\OrderDeliveries');
        // $orderModel = $this->model('Orders\Orders');

        // // Check if order exists
        // $orderData = $orderModel->getOrderById($orderId);
        // if (!$orderData) {
        //     $response->sendError('Order not found.', 404);
        //     return;
        // }
        
        // Fetch deliveries for this order
        error_log("flag 2");
        $deliveries = $deliveryModel->getDeliveriesByOrder($orderId);

       
        error_log(print_r($deliveries, true));

        if (empty($deliveries)) {
            $response->sendJson([
                'success' => true,
                'message' => 'No deliveries found for this order.',
                'data' => []
            ]);
            return;
        }

        // Send the response with deliveries data
        $response->sendJson([
            'success' => true,
            'message' => 'Deliveries retrieved successfully.',
            'data' => $deliveries
        ]);
    }

    /**
     * Create a new delivery for an order.
     *
     * @param Request $request The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response indicating success or failure.
     */
    public function createDelivery($request, $response): void
    {
        try {
            // Parse request body
            $requestData = $request->getParsedBody();
            $files = $request->getUploadedFiles();

            // Validate required fields
            $requiredFields = ['order_id', 'delivery_note'];
            $missingFields = array_filter($requiredFields, fn($field) => empty($requestData[$field]));

            if (!empty($missingFields)) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Missing required fields: ' . implode(', ', $missingFields) . '.'
                ], 400);
                return;
            }

            // Initialize models
            $deliveryModel = $this->model('Orders\Delivery');
            $orderModel = $this->model('Orders\Orders');

            // Check if order exists
            $orderData = $orderModel->getOrderById($requestData['order_id']);
            if (!$orderData) {
                $response->sendError('Order not found.', 404);
                return;
            }

            // Get current user (seller)
            $currentUser = AuthHelper::getCurrentUser();
            if (!$currentUser || $currentUser['user_id'] != $orderData['seller_id']) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Unauthorized: Only the seller of this order can create deliveries.'
                ], 403);
                return;
            }

            // Handle file uploads if present
            $uploadedFiles = [];
            if (!empty($files['revision_files'])) {
                $fileHandler = new FileHandler();
                $uploadedFiles = $fileHandler->handleMultipleUploads($files['revision_files'], 'deliveries');
                
                if (empty($uploadedFiles)) {
                    $response->sendJson([
                        'success' => false,
                        'message' => 'Failed to upload delivery files.'
                    ], 500);
                    return;
                }
            }

            // Prepare delivery data
            $deliveryData = [
                'order_id' => $requestData['order_id'],
                'delivery_note' => $requestData['delivery_note'],
                'revision_files' => !empty($uploadedFiles) ? json_encode($uploadedFiles) : null,
                'status' => 'delivered',
                'delivered_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Create the delivery
            $created = $deliveryModel->createDelivery($deliveryData);
            if (!$created) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Failed to create delivery.'
                ], 500);
                return;
            }

            // Update order status to indicate delivery
            $orderModel->updateOrderById($requestData['order_id'], [
                'order_status' => 'completed',
                'delivered_date' => date('Y-m-d H:i:s')
            ]);

            // Return success response
            $response->sendJson([
                'success' => true,
                'message' => 'Delivery created successfully.',
                'delivery_id' => $created
            ]);
        } catch (\Throwable $e) {
            error_log("Error in createDelivery: " . $e->getMessage());
            error_log("File: " . $e->getFile() . " Line: " . $e->getLine());
            
            $response->sendJson([
                'success' => false,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create a revision for an existing delivery.
     *
     * @param Request $request The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response indicating success or failure.
     */
    public function createRevision($request, $response): void
    {
        try {
            // Parse request body
            $requestData = $request->getParsedBody();
            $files = $request->getUploadedFiles();

            // Validate required fields
            $requiredFields = ['order_id', 'revision_note'];
            $missingFields = array_filter($requiredFields, fn($field) => empty($requestData[$field]));

            if (!empty($missingFields)) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Missing required fields: ' . implode(', ', $missingFields) . '.'
                ], 400);
                return;
            }

            // Initialize models
            $deliveryModel = $this->model('Orders\Delivery');
            $orderModel = $this->model('Orders\Orders');

            // Check if order exists and has revisions left
            $orderData = $orderModel->getOrderById($requestData['order_id']);
            if (!$orderData) {
                $response->sendError('Order not found.', 404);
                return;
            }

            if ($orderData['remained_revisions'] <= 0) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'No revisions left for this order.'
                ], 400);
                return;
            }

            // Get current user (buyer/customer)
            $currentUser = AuthHelper::getCurrentUser();
            if (!$currentUser || $currentUser['user_id'] != $orderData['customer_id']) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Unauthorized: Only the customer of this order can request revisions.'
                ], 403);
                return;
            }

            // Handle file uploads if present
            $uploadedFiles = [];
            if (!empty($files['revision_files'])) {
                $fileHandler = new FileHandler();
                $uploadedFiles = $fileHandler->handleMultipleUploads($files['revision_files'], 'revisions');
                
                if (empty($uploadedFiles)) {
                    $response->sendJson([
                        'success' => false,
                        'message' => 'Failed to upload revision files.'
                    ], 500);
                    return;
                }
            }

            // Create the revision
            $revisionData = [
                'order_id' => $requestData['order_id'],
                'revision_note' => $requestData['revision_note'],
                'revision_files' => !empty($uploadedFiles) ? json_encode($uploadedFiles) : null,
                'status' => 'revision_requested',
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Create revision using the createRevision method
            $created = $deliveryModel->createRevision($requestData['order_id'], $revisionData);
            if (!$created) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Failed to create revision request.'
                ], 500);
                return;
            }

            // Update order's remaining revisions count
            $orderModel->updateOrderById($requestData['order_id'], [
                'remained_revisions' => $orderData['remained_revisions'] - 1,
                'order_status' => 'in_progress'
            ]);

            // Return success response
            $response->sendJson([
                'success' => true,
                'message' => 'Revision requested successfully.',
                'delivery_id' => $created
            ]);
        } catch (\Throwable $e) {
            error_log("Error in createRevision: " . $e->getMessage());
            error_log("File: " . $e->getFile() . " Line: " . $e->getLine());
            
            $response->sendJson([
                'success' => false,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update delivery status.
     *
     * @param Request $request The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response indicating success or failure.
     */
    public function updateDeliveryStatus($request, $response): void
    {
        try {
            // Parse request body
            $requestData = $request->getParsedBody();

            // Validate required fields
            if (empty($requestData['delivery_id']) || empty($requestData['status'])) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Missing required fields: delivery_id and status are required.'
                ], 400);
                return;
            }

            // Validate status value
            $validStatuses = ['delivered', 'revision_requested', 'completed', 'rejected'];
            if (!in_array($requestData['status'], $validStatuses)) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Invalid status value. Allowed values: ' . implode(', ', $validStatuses)
                ], 400);
                return;
            }

            // Initialize models
            $deliveryModel = $this->model('Orders\Delivery');

            // Get the delivery
            $deliveryData = $deliveryModel->getDeliveryById($requestData['delivery_id']);
            if (!$deliveryData) {
                $response->sendError('Delivery not found.', 404);
                return;
            }

            // Update delivery status
            $updated = $deliveryModel->updateDelivery($requestData['delivery_id'], [
                'status' => $requestData['status'],
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if (!$updated) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Failed to update delivery status.'
                ], 500);
                return;
            }

            // Return success response
            $response->sendJson([
                'success' => true,
                'message' => 'Delivery status updated successfully.',
                'status' => $requestData['status']
            ]);
        } catch (\Throwable $e) {
            error_log("Error in updateDeliveryStatus: " . $e->getMessage());
            error_log("File: " . $e->getFile() . " Line: " . $e->getLine());
            
            $response->sendJson([
                'success' => false,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get latest delivery for an order.
     *
     * @param Request $request The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with the latest delivery data.
     */
    public function getLatestDelivery($request, $response): void
    {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Retrieve query parameters
        $queryParams = $request->getQueryParams();
        $orderId = $queryParams['order_id'] ?? null;

        // Validate required parameter
        if (empty($orderId)) {
            $response->sendError('Missing required parameter: order_id.', 400);
            return;
        }

        // Initialize models
        $deliveryModel = $this->model('Orders\Delivery');

        // Fetch latest delivery
        $latestDelivery = $deliveryModel->getLatestDelivery($orderId);

        if (!$latestDelivery) {
            $response->sendJson([
                'success' => false,
                'message' => 'No deliveries found for this order.'
            ], 404);
            return;
        }

        // Send the response with latest delivery data
        $response->sendJson([
            'success' => true,
            'message' => 'Latest delivery retrieved successfully.',
            'data' => $latestDelivery
        ]);
    }

    /**
     * Get all revisions for a delivery.
     *
     * @param Request $request The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with revisions data.
     */
    public function getRevisions($request, $response): void
    {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Retrieve query parameters
        $queryParams = $request->getQueryParams();
        $deliveryId = $queryParams['delivery_id'] ?? null;

        // Validate required parameter
        if (empty($deliveryId)) {
            $response->sendError('Missing required parameter: delivery_id.', 400);
            return;
        }

        // Initialize models
        $deliveryModel = $this->model('Orders\Delivery');

        // Fetch revisions
        $revisions = $deliveryModel->getRevisionsByDeliveryId($deliveryId);

        if (empty($revisions)) {
            $response->sendJson([
                'success' => true,
                'message' => 'No revisions found for this delivery.',
                'data' => []
            ]);
            return;
        }

        // Send the response with revisions data
        $response->sendJson([
            'success' => true,
            'message' => 'Revisions retrieved successfully.',
            'data' => $revisions
        ]);
    }
}

