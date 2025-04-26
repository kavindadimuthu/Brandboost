<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\DebugHelper;
use app\core\Utils\FileHandler;
use app\models\Orders\Orders;
use app\models\Orders\OrderDeliveries;
use app\models\Orders\OrderPromises;
use app\models\Services\Service;
use app\models\Services\ServicePackage;

use app\models\Users\User;
use app\models\Payments\Transaction;
use app\models\Payments\Wallet;
use app\models\Actions\Complaint;

class OrderController extends BaseController {
    /**
     * Fetch a list of orders with requested conditions and associative promise data.
     *
     * @param Request $request  The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with the list of orders.
     */
    public function getOrderListByAdmin($request, $response) {

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
        $orderModel = new Orders();
        $orderPromiseModel = new OrderPromises();
        $userModel = new User(); // Assuming a User model exists

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
            $userId = $orderData['seller_id']; // Assuming the order data contains a user_id field
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

            $totalOrders = $orderModel->count(['seller_id' => $sellerId]);

            // Optional: Get counts by status
            $pendingCount = $orderModel->count(['order_status' => 'pending', 'seller_id' => $sellerId]);
            $inProgressCount = $orderModel->count(['order_status' => 'in_progress', 'seller_id' => $sellerId]);
            $completedCount = $orderModel->count(['order_status' => 'completed', 'seller_id' => $sellerId]);
            $canceledCount = $orderModel->count(['order_status' => 'canceled', 'seller_id' => $sellerId]);
            
            
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
                'count' => [
                    'total' => $totalOrders,
                    'by_status' => [
                        'pending' => $pendingCount,
                        'in_progress' => $inProgressCount,
                        'completed' => $completedCount,
                        'canceled' => $canceledCount
                    ]
                ]
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
 * @param Request $request The incoming request object.
 * @param Response $response The response object to return data.
 * @return Response JSON response indicating success or failure.
 */
public function createOrder($request, $response) {
    // Extract data from the request
    $requestData = $request->getParsedBody();
    DebugHelper::logArray($requestData);

    error_log("Request data: " . json_encode($requestData, JSON_PRETTY_PRINT));
    
    // Get uploaded files - Using $_FILES instead of getUploadedFiles()
    $uploadedFiles = [];
    if (isset($_FILES)) {
        foreach ($_FILES as $key => $file) {
            if (strpos($key, 'additionalImage') === 0 && $file['error'] === UPLOAD_ERR_OK) {
                $uploadedFiles[$key] = $file;
            }
        }
    }
    error_log("Uploaded files: " . json_encode(array_keys($uploadedFiles)));

            // Handle media uploads
            $mediaPaths = [];
            foreach ($uploadedFiles as $key => $file) {
                // Use FileHandler to upload the file
                $mediaPath = FileHandler::fileUploader(
                    $file, 
                    'cdn_uploads/orders/order_attachments'
                );
                
                if ($mediaPath) {
                    $mediaPaths[] = $mediaPath;
                    error_log("File uploaded successfully: " . $mediaPath);
                } else {
                    error_log("Failed to upload file: " . $key);
                }
            }
    
    // Validate required fields
    $requiredFields = ['service_id', 'payment_type'];
    $missingFields = array_filter($requiredFields, fn($field) => empty($requestData[$field]));

    if (!empty($missingFields)) {
        return $response->sendJson([
            'success' => false,
            'message' => 'Missing required fields: ' . implode(', ', $missingFields) . '.'
        ], 400);
    }

    // Check authentication
    $customerId = AuthHelper::getCurrentUser()['user_id'] ?? null;
    if (!$customerId) {
        return $response->sendJson([
            'success' => false,
            'message' => 'Unauthorized access: user not authenticated.'
        ], 401);
    }
    
    // Initialize required models
    $orderModel = new Orders();
    $orderPromisesModel = new OrderPromises();
    $serviceModel = new Service();
    $servicePackageModel = new ServicePackage();
    $transactionModel = new Transaction();
    $walletModel = new Wallet();
    $orderDeliveriesModel = new OrderDeliveries();
    
    // Extract other data from the request
    $serviceId = $requestData['service_id'];
    $paymentType = $requestData['payment_type'];
    $packageId = $requestData['package_id'] ?? null;
    $customPackageId = $requestData['custom_package_id'] ?? null;
    
    // Parse promises if provided
    $promises = [];
    if (!empty($requestData['promises'])) {
        $promises = json_decode($requestData['promises'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $response->sendJson([
                'success' => false,
                'message' => 'Invalid JSON format in promises.'
            ], 400);
        }
    }
    
    // Fetch service and package data
    $serviceData = $serviceModel->getServiceById($serviceId);
    $packageData = $servicePackageModel->getPackageById($packageId);

    if (!$serviceData || !$packageData) {
        return $response->sendJson([
            'success' => false,
            'message' => 'Invalid service or package ID.'
        ], 400);
    }
    
    try {
        // Prepare order data
        $orderData = [
            'customer_id' => $customerId,
            'seller_id' => $serviceData['user_id'],
            'service_id' => $serviceId,
            'package_id' => $packageId,
            'custom_package_id' => $customPackageId,
            'payment_type' => $paymentType,
            'remained_revisions' => $packageData['revisions'] ?? 0,
            'order_status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Create the order
        if (!$orderModel->createOrder($orderData)) {
            throw new \Exception('Failed to create order.');
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

        // Log the uploaded file paths
        error_log("Media paths for order: " . json_encode($mediaPaths));

        // Create promises associated with the order
        $promiseData = [
            'order_id' => $orderId,
            'accepted_service' => $agreedData,
            'requested_service' => $buyerRequest,
            'delivery_days' => $packageData['delivery_days'] ?? 0,
            'number_of_revisions' => $packageData['revisions'] ?? 0,
            'project_documents' => json_encode($mediaPaths),
            'price' => $packageData['price'] ?? 0.00
        ];

        if (!$orderPromisesModel->createPromise($promiseData)) {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to create associated promises.'
            ]);
            return;
        }

        // Create initial transaction (customer -> system)
        $transactionData = [
            'order_id' => $orderId,
            'sender_id' => $customerId,
            'receiver_id' => 100, // System user_id
            'amount' => $packageData['price'] ?? 0.00,
            'status' => 'hold',
            'hold_until' => date('Y-m-d H:i:s', strtotime('+20 seconds'))
        ];

        if (!$transactionModel->createTransaction($transactionData)) {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to create associated transactions.'
            ]);
            return;
        }

        // Ensure system wallet exists
        if (!$walletModel->walletExists(100)) {
            if (!$walletModel->createWallet(100)) {
                throw new \Exception('Failed to create system wallet.');
            }
        }

        // Update system wallet balance
        if (!$walletModel->updateWalletBalance(100, $transactionData['amount'])) {
            throw new \Exception('Failed to update system wallet balance.');
        }

        // Return success response
        $response->sendJson([
            'success' => true,
            'message' => 'Order created successfully.',
            'order_id' => $orderId
        ]);
        
    } catch (\Exception $e) {
        // Handle exceptions and return error response
        error_log("Error creating order: " . $e->getMessage());
        $response->sendJson([
            'success' => false,
            'message' => 'Internal server error: ' . $e->getMessage()
        ], 500);
    }
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
    
    /**
     * Fetch delivery by ID with all associated data.
     *
     * @param Request $request The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with delivery details or error message.
     */
    // public function getDelivery($request, $response): void
    // {
    //     error_log("=== Starting getDelivery method ===");
    //     try {
    //         if ($request->getMethod() !== 'GET') {
    //             $response->setStatusCode(405);
    //             $response->sendError('Method Not Allowed');
    //             return;
    //         }

    //         // Retrieve query parameters
    //         $queryParams = $request->getQueryParams();
    //         $deliveryId = $queryParams['delivery_id'] ?? null;
    //         error_log("Retrieving delivery with ID: $deliveryId");

    //         // Validate required parameter
    //         if (empty($deliveryId)) {
    //             error_log("Missing delivery_id parameter");
    //             $response->sendError('Missing required parameter: delivery_id.', 400);
    //             return;
    //         }

    //         // Initialize models
    //         $deliveryModel = $this->model('Orders\OrderDeliveries');
    //         $orderModel = $this->model('Orders\Orders');

    //         // Fetch delivery data
    //         error_log("Fetching delivery data from database");
    //         $deliveryData = $deliveryModel->getDeliveryById($deliveryId);

    //         if (!$deliveryData) {
    //             error_log("No delivery found with ID: $deliveryId");
    //             $response->sendError('Delivery not found.', 404);
    //             return;
    //         }

    //         // Process file information
    //         if (!empty($deliveryData['deliveries'])) {
    //             try {
    //                 $deliveryData['files'] = json_decode($deliveryData['deliveries'], true);
    //                 // Keep original encoded data but provide decoded version
    //                 $deliveryData['has_files'] = !empty($deliveryData['files']);
    //                 $deliveryData['file_count'] = is_array($deliveryData['files']) ? count($deliveryData['files']) : 0;
    //             } catch (\Exception $e) {
    //                 error_log("Error decoding delivery files JSON: " . $e->getMessage());
    //                 $deliveryData['files'] = [];
    //                 $deliveryData['has_files'] = false;
    //                 $deliveryData['file_count'] = 0;
    //             }
    //         } else {
    //             $deliveryData['files'] = [];
    //             $deliveryData['has_files'] = false;
    //             $deliveryData['file_count'] = 0;
    //         }

    //         // Fetch order data related to this delivery
    //         error_log("Fetching related order data for order ID: {$deliveryData['order_id']}");
    //         $orderData = $orderModel->getOrderById($deliveryData['order_id']);

    //         // Construct the response
    //         $deliveryProfile = [
    //             'delivery' => $deliveryData,
    //             'order' => $orderData
    //         ];

    //         // Send the response with delivery profile data
    //         $response->sendJson([
    //             'success' => true,
    //             'message' => 'Delivery retrieved successfully.',
    //             'data' => $deliveryProfile
    //         ]);
            
    //         error_log("=== Completed getDelivery successfully ===");
    //     } catch (\Throwable $e) {
    //         error_log("Error in getDelivery: " . $e->getMessage());
    //         error_log("File: " . $e->getFile() . " Line: " . $e->getLine());
    //         error_log("Stack trace: " . $e->getTraceAsString());
            
    //         $response->sendJson([
    //             'success' => false,
    //             'message' => 'Internal server error: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    /**
     * Fetch all deliveries for a specific order.
     *
     * @param Request $request The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with deliveries list.
     */
    public function getOrderDeliveries($request, $response): void
    {
        error_log("=== Starting getOrderDeliveries method ===");
        try {
            if ($request->getMethod() !== 'GET') {
                $response->setStatusCode(405);
                $response->sendError('Method Not Allowed');
                return;
            }

            // Retrieve query parameters
            $queryParams = $request->getQueryParams();
            $orderId = $queryParams['id'] ?? null;
            error_log("Retrieving deliveries for order ID: $orderId");

            // Validate required parameter
            if (empty($orderId)) {
                error_log("Missing order_id parameter");
                $response->sendError('Missing required parameter: order_id.', 400);
                return;
            }

            // Initialize models
            $deliveryModel = $this->model('Orders\OrderDeliveries');
            
            // Fetch deliveries for this order
            error_log("Fetching deliveries from database for order: $orderId");
            $deliveries = $deliveryModel->getDeliveriesByOrder($orderId);
            
            // Process deliveries to decode file information
            if (!empty($deliveries)) {
                foreach ($deliveries as &$delivery) {
                    if (!empty($delivery['deliveries'])) {
                        try {
                            $delivery['files'] = json_decode($delivery['deliveries'], true);
                            // Keep original encoded data but provide decoded version
                            $delivery['has_files'] = !empty($delivery['files']);
                            $delivery['file_count'] = is_array($delivery['files']) ? count($delivery['files']) : 0;
                        } catch (\Exception $e) {
                            error_log("Error decoding delivery files JSON: " . $e->getMessage());
                            $delivery['files'] = [];
                            $delivery['has_files'] = false;
                            $delivery['file_count'] = 0;
                        }
                    } else {
                        $delivery['files'] = [];
                        $delivery['has_files'] = false;
                        $delivery['file_count'] = 0;
                    }
                }
                error_log("Successfully processed " . count($deliveries) . " deliveries");
            } else {
                error_log("No deliveries found for order: $orderId");
            }

            // Send the response with deliveries data
            $response->sendJson([
                'success' => true,
                'message' => !empty($deliveries) ? 'Deliveries retrieved successfully.' : 'No deliveries found for this order.',
                'data' => $deliveries ?? []
            ]);
            
            error_log("=== Completed getOrderDeliveries successfully ===");
        } catch (\Throwable $e) {
            error_log("Error in getOrderDeliveries: " . $e->getMessage());
            error_log("File: " . $e->getFile() . " Line: " . $e->getLine());
            error_log("Stack trace: " . $e->getTraceAsString());
            
            $response->sendJson([
                'success' => false,
                'message' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
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
        error_log("=== Starting createDelivery method ===");
        try {
            // Parse request body
            $requestData = $request->getParsedBody();
            error_log("Request data received: " . json_encode(array_keys($requestData)));
            
            // Get uploaded files using $_FILES instead of the undefined method
            $files = [];
            if (isset($_FILES['deliveries'])) {
                $files['deliveries'] = $_FILES['deliveries'];
                error_log("Found " . count($_FILES['deliveries']['name']) . " files in the request");
            } else {
                error_log("No files found in the request under 'deliveries' key");
            }
            
            // Validate required fields
            $requiredFields = ['order_id', 'delivery_note', 'content_link'];
            $missingFields = array_filter($requiredFields, fn($field) => empty($requestData[$field]));
    
            if (!empty($missingFields)) {
                error_log("Validation failed - Missing fields: " . implode(', ', $missingFields));
                $response->sendJson([
                    'success' => false,
                    'message' => 'Missing required fields: ' . implode(', ', $missingFields) . '.'
                ], 400);
                return;
            }
     
            // Initialize models - ensure consistent naming with uppercase O
            error_log("Initializing models for delivery creation");
            $deliveryModel = $this->model('Orders\OrderDeliveries');
            $orderModel = $this->model('Orders\Orders');
     
            // Check if order exists
            $orderId = $requestData['order_id'];
            error_log("Checking if order exists with ID: {$orderId}");
            $orderData = $orderModel->getOrderById($orderId);
            if (!$orderData) {
                error_log("Order not found with ID: {$orderId}");
                $response->sendError('Order not found.', 404);
                return;
            }
            error_log("Order found: " . json_encode(['id' => $orderId, 'status' => $orderData['order_status']]));
     
            // Get current user (seller)
            $currentUser = AuthHelper::getCurrentUser();
            error_log("Current user ID: " . ($currentUser ? $currentUser['user_id'] : 'not authenticated'));
             
            if (!$currentUser) {
                error_log("Authentication error: No current user found");
                $response->sendJson([
                    'success' => false,
                    'message' => 'Unauthorized: User not authenticated.'
                ], 403);
                return;
            }
             
            if ($currentUser['user_id'] != $orderData['seller_id']) {
                error_log("Authorization error: User {$currentUser['user_id']} is not the seller ({$orderData['seller_id']}) of order {$orderId}");
                $response->sendJson([
                    'success' => false,
                    'message' => 'Unauthorized: Only the seller of this order can create deliveries.'
                ], 403);
                return;
            }
     
            // Handle file uploads if present
            $uploadedFiles = [];
            if (!empty($files['deliveries'])) {
                error_log("Processing " . count($files['deliveries']['name']) . " uploaded files");
                
                try {
                    // Manual file upload handling
                    $uploadDir = 'cdn_uploads/services/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    
                    for ($i = 0; $i < count($files['deliveries']['name']); $i++) {
                        if ($files['deliveries']['error'][$i] === UPLOAD_ERR_OK) {
                            $tempFile = $files['deliveries']['tmp_name'][$i];
                            $originalName = $files['deliveries']['name'][$i];
                            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                            $newFileName = uniqid('delivery_') . '.' . $extension;
                            $targetPath = $uploadDir . '/' . $newFileName;
                            
                            if (move_uploaded_file($tempFile, $targetPath)) {
                                $uploadedFiles[] = [
                                    'name' => $originalName,
                                    'path' => $targetPath,
                                    'url' => 'cdn_uploads/services/' . $newFileName,
                                    'size' => $files['deliveries']['size'][$i],
                                    'type' => $files['deliveries']['type'][$i]
                                ];
                            }
                        }
                    }
                    
                    error_log("Files upload result: " . json_encode(['count' => count($uploadedFiles)]));
                    
                    if (empty($uploadedFiles)) {
                        error_log("File upload failed: No files were successfully uploaded");
                        $response->sendJson([
                            'success' => false,
                            'message' => 'Failed to upload delivery files.'
                        ], 500);
                        return;
                    }
                } catch (\Exception $fileEx) {
                    error_log("File upload exception: " . $fileEx->getMessage());
                    error_log("Stack trace: " . $fileEx->getTraceAsString());
                    $response->sendJson([
                        'success' => false,
                        'message' => 'File upload error: ' . $fileEx->getMessage()
                    ], 500);
                    return;
                }
            }
     
            // Prepare delivery data
            $deliveryData = [
                'order_id' => $requestData['order_id'],
                'delivery_note' => $requestData['delivery_note'],
                'content_link' => $requestData['content_link'] ?? null,
                'deliveries' => !empty($uploadedFiles) ? json_encode($uploadedFiles) : null,
                'status' => 'delivered',
                'delivered_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ];
     
            error_log("Prepared delivery data: " . json_encode(array_merge(
                ['order_id' => $deliveryData['order_id']],
                ['delivery_note_length' => strlen($deliveryData['delivery_note'])],
                ['content_link' => $deliveryData['content_link']],
                ['has_files' => !empty($uploadedFiles)],
                ['status' => $deliveryData['status']],
                ['timestamps' => [$deliveryData['delivered_at'], $deliveryData['created_at']]]
            )));
     
            // Create the delivery with detailed error catching
            try {
                error_log("Attempting to create delivery record in database");
                $created = $deliveryModel->createDelivery($deliveryData);
                 
                if (!$created) {
                    error_log("Database operation failed: createDelivery returned false/null");
                    $dbError = $deliveryModel->getLastError() ?? "Unknown database error";
                    error_log("Database error details: " . $dbError);
                     
                    $response->sendJson([
                        'success' => false,
                        'message' => 'Failed to create delivery. Database operation unsuccessful.'
                    ], 500);
                    return;
                }
                 
                error_log("Delivery created successfully with ID: {$created}");
            } catch (\Exception $dbEx) {
                error_log("Database exception in createDelivery: " . $dbEx->getMessage());
                error_log("Query error: " . ($deliveryModel->getLastQuery() ?? "No query information"));
                error_log("Exception file: " . $dbEx->getFile() . " on line: " . $dbEx->getLine());
                error_log("Stack trace: " . $dbEx->getTraceAsString());
                 
                $response->sendJson([
                    'success' => false,
                    'message' => 'Database error: ' . $dbEx->getMessage()
                ], 500);
                return;
            }
     
            // Update order status to indicate delivery
            error_log("Updating order status to 'completed' for order ID: {$orderId}");
            try {
                $updateResult = $orderModel->updateOrderById($requestData['order_id'], [
                    'order_status' => 'completed',
                    'delivered_date' => date('Y-m-d H:i:s')
                ]);
                 
                if (!$updateResult) {
                    error_log("Warning: Failed to update order status, but delivery was created");
                } else {
                    error_log("Order status updated successfully");
                }
            } catch (\Exception $updateEx) {
                // Log but don't fail the whole operation since delivery was created
                error_log("Order status update exception: " . $updateEx->getMessage());
                error_log("This is a non-critical error as delivery was created successfully");
            }
     
            // Return success response
            error_log("=== Completed createDelivery successfully ===");
            $response->sendJson([
                'success' => true,
                'message' => 'Delivery created successfully.',
                'delivery_id' => $created
            ]);
        } catch (\Throwable $e) {
            error_log("Critical error in createDelivery: " . $e->getMessage());
            error_log("Error type: " . get_class($e));
            error_log("File: " . $e->getFile() . " Line: " . $e->getLine());
            error_log("Stack trace: " . $e->getTraceAsString());
             
            if (isset($requestData)) {
                error_log("Request data at time of error: " . json_encode(array_keys($requestData ?? [])));
            }
             
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
            $deliveryModel = $this->model('Orders\OrderDeliveries');

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
        $deliveryModel = $this->model('Orders\OrderDeliveries');

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
        $deliveryModel = $this->model('Orders\orderDeliveries');

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

        $sql = "INSERT INTO order_revisions (order_id, revision_note, revision_files, status, created_at) VALUES (?, ?, ?, ?, ?)";

        $params = [
            $requestData['order_id'],
            $requestData['revision_note'],
            !empty($uploadedFiles) ? json_encode($uploadedFiles) : null,
            'revision_requested',
            date('Y-m-d H:i:s')
        ];
        
        $deliveryModel->executeCustomQuery($sql, $params);
    }


    public function createReview($request, $response){
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }
        
        // Parse request body
        $requestData = $request->getParsedBody(); 
        if (empty($requestData['order_id']) || empty($requestData['review'])) {
            $response->sendError('No data provided for review.');
        }

        error_log(print_r($requestData, 1));

        $review = [
            'order_id' => $requestData['order_id'], 
            'service_id' => 136 , 
            'user_id' => $_SESSION['user']['user_id'],
            'review_type' => 'review',            
            'content' => $requestData['reviewText'], 
            'rating' => 3 ,
            'created_at' => date('Y-m-d H:i:s')  

        ];

        $reviewModel = $this-> model('Orders\OrderReviewsFeedback');

        if (!$reviewModel ->create($review)) {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to update order.'
            ]);
            return;
        }

        $response->sendJson([
            'success' => true,
            'message' => 'Review Created successfully.',
            ]);


    }


/**
 * Handle order cancellation requests from sellers
 *
 * @param Request $request The incoming request object
 * @param Response $response The response object to return data
 * @return void JSON response indicating success or failure
 */
public function orderCancellation($request, $response): void
{
    try {
        $userId = AuthHelper::getCurrentUser()['user_id'] ?? null;
            
            // For multipart/form-data, access directly from $_POST and $_FILES
            $orderId = $_POST['order_id'] ?? null;
            $reason = $_POST['order_cancellation_reason'] ?? null;
        
        error_log("Order cancellation request received for order ID: $orderId, reason: $reason");

        if (!$orderId) {
            $response->sendJson([
                'success' => false,
                'message' => 'Order ID is required'
            ], 400);
            return;
        }
        
        // Get current user ID (the seller requesting cancellation)
        $currentUser = AuthHelper::getCurrentUser();
        $userRole = $currentUser['role'] ?? null;
        $sellerId = $currentUser['user_id'] ?? null;
        
        if (!$sellerId) {
            $response->sendJson([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
            return;
        }
        
        // Initialize order model
        $orderModel = new Orders();
        
        // Check if the order exists and belongs to the seller
        $order = $orderModel->getOrderById($orderId);
        
        if (!$order || $order['seller_id'] != $sellerId) {
            $response->sendJson([
                'success' => false,
                'message' => 'Order not found or you are not authorized to cancel it'
            ], 404);
            return;
        }
        
        // Create a cancellation request record
        // You may need to create a dedicated model for cancellations
        $orderCancellationModel = new Orders;
        
        $cancellationData = [
            'order_cancellation_reason' => $reason,
            'order_status' => 'pending',
            'cancellation_requested_by' => $userRole,
        ];
        
        $cancellationCreated = $orderCancellationModel->updateOrderById($orderId,$cancellationData);
        
        if (!$cancellationCreated) {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to create cancellation request'
            ], 500);
            return;
        }
        
        
        // if (!$orderUpdated) {
        //     $response->sendJson([
        //         'success' => false,
        //         'message' => 'Failed to update order status'
        //     ], 500);
        //     return;
        // }
        
        // Send notification to buyer and admins about the cancellation request
        // You may need to implement this according to your notification system
        
        $response->sendJson([
            'success' => true,
            'message' => 'Order cancellation request submitted successfully',
            'cancellation_id' => $orderCancellationModel->getLastInsertId()
        ]);
        
    } catch (\Exception $e) {
        error_log("Error in orderCancellation: " . $e->getMessage());
        error_log("File: " . $e->getFile() . " Line: " . $e->getLine());
        
        $response->sendJson([
            'success' => false,
            'message' => 'Failed to submit cancellation request: ' . $e->getMessage()
        ], 500);
    }
}



/**
 * Handle responses to order cancellation requests (accept or decline)
 *
 * @param Request $request The incoming request object
 * @param Response $response The response object to return data
 * @return void JSON response indicating success or failure
 */
public function respondToCancellation($request, $response): void
{
    try {
        // Check if it's a POST request
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendJson([
                'success' => false,
                'message' => 'Method Not Allowed'
            ]);
            return;
        }

        $orderId = $_POST['order_id'] ?? null;
        $status = $_POST['status'] ?? null;

        

        // Validate required fields
        if (!$orderId || !$status) {
            $response->sendJson([
                'success' => false,
                'message' => 'Missing required fields: order_id and status'
            ], 400);
            return;
        }

        // Validate status is either 'accepted' or 'declined'
        if (!in_array($status, ['accepted', 'declined'])) {
            $response->sendJson([
                'success' => false,
                'message' => 'Invalid status. Must be either "accepted" or "declined".'
            ], 400);
            return;
        }
        
        // Get the current user
        $user = AuthHelper::getCurrentUser();
        
        if (!$user) {
            $response->sendJson([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
            return;
        }
        
        // Initialize order model
        $orderModel = new Orders();
        
        // Get order details to check permissions
        $order = $orderModel->getOrderById($orderId);
        
        if (!$order) {
            $response->sendJson([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
            return;
        }
        error_log("Respondingggpgggggg to cancellation request for order ID: $orderId, status: $status");
        // Update order based on response
        if ($status === 'accepted') {
            // Accept the cancellation - update order status to cancelled
            $updateData = [
                'order_status' => 'canceled',
                'cancellation_acceptancy' => 'yes'
            ];
            
            $result = $orderModel->updateOrderById($orderId, $updateData);
            
            if ($result) {
                $response->sendJson([
                    'success' => true,
                    'message' => 'Cancellation request accepted successfully'
                ]);
                return;
            } else {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Failed to update order status'
                ], 500);
                return;
            }
        } else {
            // Decline the cancellation - clear the cancellation reason
            $updateData = [
                'order_cancellation_reason' => null,
                'cancellation_requested_by' => null
            ];
            
            $result = $orderModel->updateOrderById($orderId, $updateData);
            
            if ($result) {
                $response->sendJson([
                    'success' => true,
                    'message' => 'Cancellation request declined successfully'
                ]);
                return;
            } else {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Failed to update order status'
                ], 500);
                return;
            }
        }
    } catch (\Exception $e) {
        $response->sendJson([
            'success' => false,
            'message' => 'Error processing cancellation response: ' . $e->getMessage()
        ], 500);
    }
}

    public function submitComplaint($request, $response): void {
        try {
            if ($request->getMethod() != 'POST') {
                $response->setStatusCode(405);
                $response->sendJson([
                    'success' => false,
                    'message' => 'Method Not Allowed'
                ]);
                return;
            }
    
            $userId = AuthHelper::getCurrentUser()['user_id'] ?? null;
            
            // For multipart/form-data, access directly from $_POST and $_FILES
            $orderId = $_POST['order_id'] ?? null;
            $content = $_POST['content'] ?? null;
            $complaintType = $_POST['complaint_type'] ?? null;
    
            if (empty($orderId) || empty($content)) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'No data provided for complaint.'
                ]);
                return;
            }
    
            // Handle file uploads using FileHandler
            $savedFiles = [];
            $uploadDir = 'uploads/complaints/';
            
            if (isset($_FILES['proofs']) && is_array($_FILES['proofs']['name'])) {
                // Create a temporary array for multiple file uploads
                for ($i = 0; $i < count($_FILES['proofs']['name']); $i++) {
                    if ($_FILES['proofs']['error'][$i] === UPLOAD_ERR_OK) {
                        $tempFile = [
                            'name' => $_FILES['proofs']['name'][$i],
                            'type' => $_FILES['proofs']['type'][$i],
                            'tmp_name' => $_FILES['proofs']['tmp_name'][$i],
                            'error' => $_FILES['proofs']['error'][$i],
                            'size' => $_FILES['proofs']['size'][$i]
                        ];
                        
                        // Use FileHandler with proper namespace
                        $filePath = FileHandler::fileUploader(
                            $tempFile, 
                            $uploadDir
                        );
                        
                        if ($filePath) {
                            $savedFiles[] = $filePath;
                        }
                    }
                }
            }

            $orderModel = new Orders();
            $returnedOrder = $orderModel->getOrderById($orderId);
            $reportedUserId = $returnedOrder['seller_id'];
    
            // Save complaint in DB
            $complaint = [
                'order_id' => $orderId,
                'complainant_user_id' => $userId ?? 0,
                'reported_user_id' => $reportedUserId,
                'complaint_type' => $complaintType,
                'description' => $content,
                'proofs' => json_encode($savedFiles), // Store as JSON array
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            $complaintModel = new Complaint();
            if (!$complaintModel->createComplaint($complaint)) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Failed to submit complaint.'
                ]);
                return;
            }
    
            $response->sendJson([
                'success' => true,
                'message' => 'Complaint submitted successfully.'
            ]);
            
        } catch (\Exception $e) {
            // Log the error
            error_log('Complaint submission error: ' . $e->getMessage());
            
            // Send a JSON response even for errors
            $response->sendJson([
                'success' => false,
                'message' => 'An error occurred while processing your request: ' . $e->getMessage()
            ]);
        }
    }

}
