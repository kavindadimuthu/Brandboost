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
     * Add new delivery for an order
     * 
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function addDelivery($request, $response): void {
        // Initialize models
        $orderModel = new Orders();
        $deliveryModel = $this->model('Deliveries');
    
        // Get current user
        $currentUser = AuthHelper::getCurrentUser();
        if (!$currentUser) {
            $response->sendJson([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
            return;
        }
    
        // Get request data
        $data = $request->getParsedBody();
        $files = $request->getUploadedFiles();
    
        // Validate required fields
        if (empty($data['order_id']) || empty($data['delivery_note'])) {
            $response->sendJson([
                'success' => false,
                'message' => 'Missing required fields'
            ], 400);
            return;
        }
    
        // Check order existence
        $order = $orderModel->getOrderById($data['order_id']);
        if (!$order) {
            $response->sendJson([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
            return;
        }
    
        // Handle file uploads
        $deliveryFiles = [];
        if (!empty($files['delivery_files'])) {
            $fileHandler = new FileHandler();
            $uploadPath = __DIR__ . '/../uploads/deliveries/' . $data['order_id'];
            
            foreach ($files['delivery_files'] as $file) {
                if ($file->getError() === UPLOAD_ERR_OK) {
                    $filename = $fileHandler->uploadFile($file, $uploadPath);
                    $deliveryFiles[] = $filename;
                }
            }
        }
    
        // Create delivery data
        $deliveryData = [
            'order_id' => $data['order_id'],
            'delivery_note' => $data['delivery_note'],
            'deliveries' => json_encode($deliveryFiles),
            'status' => 'delivered',
            'delivered_at' => date('Y-m-d H:i:s')
        ];
    
        // Create delivery
        if ($deliveryModel->createDelivery($deliveryData)) {
            $response->sendJson([
                'success' => true,
                'message' => 'Delivery created successfully',
                'delivery_id' => $deliveryModel->getLastInsertId()
            ]);
        } else {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to create delivery'
            ], 500);
        }
    }
    
    /**
     * Get all deliveries for an order
     * 
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function getOrderDeliveries($request, $response): void {
        $deliveryModel = $this->model('OrderRevision');
        $revisionModel = $this->model('Orders\OrderRevision');
        
        $orderId = $request->getQueryParams()['order_id'] ?? null;
        
        if (!$orderId) {
            $response->sendJson([
                'success' => false,
                'message' => 'Order ID required'
            ], 400);
            return;
        }
    
        $deliveries = $deliveryModel->getDeliveriesByOrder($orderId);
    
        // Process deliveries
        $result = [];
        foreach ($deliveries as $delivery) {
            // Get revisions for this delivery
            $revisions = $revisionModel->getRevisionsByOrderId($orderId, [
                'where' => ['delivery_id' => $delivery['delivery_id']]
            ]);
            
            $result[] = [
                'delivery_id' => $delivery['delivery_id'],
                'order_id' => $delivery['order_id'],
                'delivery_note' => $delivery['delivery_note'],
                'deliveries' => json_decode($delivery['deliveries'], true),
                'status' => $delivery['status'],
                'delivered_at' => $delivery['delivered_at'],
                'revisions' => $this->formatRevisions($revisions)
            ];
        }
    
        $response->sendJson([
            'success' => true,
            'data' => $result
        ]);
    }
    
    /**
     * Add revision to a delivery
     * 
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function addRevision($request, $response): void {
        $deliveryModel = $this->model('Deliveries');
        $revisionModel = $this->model('Orders\OrderRevision');
        $data = $request->getParsedBody();
        $files = $request->getUploadedFiles();
    
        // Validate input
        if (empty($data['delivery_id']) || empty($data['revision_notes'])) {
            $response->sendJson([
                'success' => false,
                'message' => 'Missing required fields'
            ], 400);
            return;
        }
    
        // Check delivery exists
        $delivery = $deliveryModel->getDeliveryById($data['delivery_id']);
        if (!$delivery) {
            $response->sendJson([
                'success' => false,
                'message' => 'Delivery not found'
            ], 404);
            return;
        }
    
        // Handle revision files
        $revisionFiles = [];
        if (!empty($files['revision_files'])) {
            $fileHandler = new FileHandler();
            $uploadPath = __DIR__ . '/../uploads/revisions/' . $delivery['order_id'];
            
            foreach ($files['revision_files'] as $file) {
                if ($file->getError() === UPLOAD_ERR_OK) {
                    $filename = $fileHandler->uploadFile($file, $uploadPath);
                    $revisionFiles[] = $filename;
                }
            }
        }
    
        // Count existing revisions to determine revision number
        $existingRevisions = $revisionModel->getRevisionsByOrderId($delivery['order_id'], [
            'where' => ['delivery_id' => $data['delivery_id']]
        ]);
        $revisionNumber = count($existingRevisions) + 1;
    
        // Create new revision
        $revisionData = [
            'order_id' => $delivery['order_id'],
            'delivery_id' => $data['delivery_id'],
            'revision_number' => $revisionNumber,
            'revision_notes' => $data['revision_notes'],
            'deliveries' => json_encode($revisionFiles),
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        // Update delivery status
        $deliveryModel->updateDelivery($data['delivery_id'], ['status' => 'in_revision']);
    
        if ($revisionModel->createRevision($revisionData)) {
            $response->sendJson([
                'success' => true,
                'message' => 'Revision added successfully'
            ]);
        } else {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to add revision'
            ], 500);
        }
    }
    
    /**
     * Update delivery status
     * 
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function updateDeliveryStatus($request, $response): void {
        $deliveryModel = $this->model('Deliveries');
        $data = $request->getParsedBody();
    
        // Validate input
        if (empty($data['delivery_id']) || empty($data['status'])) {
            $response->sendJson([
                'success' => false,
                'message' => 'Missing required fields'
            ], 400);
            return;
        }
    
        $validStatuses = ['delivered', 'in_revision', 'accepted', 'rejected'];
        if (!in_array($data['status'], $validStatuses)) {
            $response->sendJson([
                'success' => false,
                'message' => 'Invalid status'
            ], 400);
            return;
        }
    
        if ($deliveryModel->updateDelivery($data['delivery_id'], ['status' => $data['status']])) {
            $response->sendJson([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
        } else {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to update status'
            ], 500);
        }
    }
    
    /**
     * Get single delivery with revisions
     * 
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function getDeliveryDetails($request, $response): void {
        $deliveryModel = $this->model('Deliveries');
        $revisionModel = $this->model('Orders\OrderRevision');
        $deliveryId = $request->getQueryParams()['delivery_id'] ?? null;
    
        if (!$deliveryId) {
            $response->sendJson([
                'success' => false,
                'message' => 'Delivery ID required'
            ], 400);
            return;
        }
    
        $delivery = $deliveryModel->getDeliveryById($deliveryId);
        if (!$delivery) {
            $response->sendJson([
                'success' => false,
                'message' => 'Delivery not found'
            ], 404);
            return;
        }
    
        // Get revisions for this delivery
        $revisions = $revisionModel->read(['delivery_id' => $deliveryId]);
    
        $responseData = [
            'delivery_id' => $delivery['delivery_id'],
            'order_id' => $delivery['order_id'],
            'delivery_note' => $delivery['delivery_note'],
            'deliveries' => json_decode($delivery['deliveries'], true),
            'status' => $delivery['status'],
            'delivered_at' => $delivery['delivered_at'],
            'revisions' => $this->formatRevisions($revisions)
        ];
    
        $response->sendJson([
            'success' => true,
            'data' => $responseData
        ]);
    }
    
    /**
     * Helper method to format revisions
     * 
     * @param array $revisions The revisions to format
     * @return array Formatted revisions
     */
    private function formatRevisions($revisions) {
        if (empty($revisions)) {
            return [
                'count' => 0,
                'items' => []
            ];
        }
    
        $formattedRevisions = [];
        foreach ($revisions as $revision) {
            $formattedRevisions[] = [
                'revision_id' => $revision['revision_id'],
                'revision_number' => $revision['revision_number'],
                'notes' => $revision['revision_notes'],
                'files' => json_decode($revision['deliveries'], true),
                'status' => $revision['status'],
                'created_at' => $revision['created_at'],
                'delivered_at' => $revision['delivered_at'] ?? null
            ];
        }
    
        return [
            'count' => count($revisions),
            'items' => $formattedRevisions
        ];
    }
    }

