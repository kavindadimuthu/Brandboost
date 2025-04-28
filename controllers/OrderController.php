<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Request;
use app\core\Response;

// Utility Imports
use app\core\Helpers\AuthHelper;
use app\core\Helpers\DebugHelper;
use app\core\Utils\FileHandler;

// Model Imports
use app\models\Orders\Orders;
use app\models\Orders\OrderDeliveries;
use app\models\Orders\OrderPromises;
use app\models\Services\Service;
use app\models\Services\ServicePackage;
use app\models\Users\User;
use app\models\Payments\Transaction;
use app\models\Payments\Wallet;
use app\models\Actions\Complaint;
use app\models\Communication\Notification;
use app\models\Actions\Action;

class OrderController extends BaseController
{
    /**
     * Fetch a list of orders with requested conditions and associative promise data.
     *
     * @param Request $request  The incoming request object.
     * @param Response $response The response object to return data.
     * @return void JSON response with the list of orders.
     */
    public function getOrderListByAdmin($request, $response)
    {

        // Parse request parameters
        $queryParams = $request->getQueryParams();

        // Pagination and sorting
        $limit = isset($queryParams['limit']) ? (int)$queryParams['limit'] : 10;
        $offset = isset($queryParams['offset']) ? (int)$queryParams['offset'] : 0;
        $sortBy = $queryParams['sort_by'] ?? 'orders.created_at';
        $orderDir = strtoupper($queryParams['order_dir'] ?? 'DESC');
        $allowedSortColumns = [
            'orders.order_id',
            'orders.service_id',
            'orders.customer_id',
            'orders.seller_id',
            'orders.payment_type',
            'orders.delivered_date',
            'orders.order_status',
            'orders.created_at'
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
    public function getOrderList($request, $response): void
    {
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

            if ($includeSeller) {
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
    public function getSellerOrders($request, $response): void
    {
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
     * @return mixed JSON response indicating success or failure.
     */
    public function createOrder($request, $response)
    {
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
                'remained_revisions' => ($packageData['revisions'] ?? 0) + 1,
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

            // Create notification for the seller
            $notificationModel = new Notification();

            $notificationData = [
                'generated_by' => 'system',
                'admin_id' => null,
                'receiver_id' => $serviceData['user_id'],
                'generation_note' => "New order created by customer : " .  AuthHelper::getCurrentUser()['username'],
                'notification' => "You have a new order for service : " . "\"" . $serviceData['title'] . "\""  ,
                'read_status' => 'unread',
                'created_at' => date('Y-m-d H:i:s')
            ];

            if (!$notificationModel->create($notificationData)) {
                error_log('Failed to create notification for the seller.');
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
    public function updateOrder($request, $response): void
    {
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

            $cancellationCreated = $orderCancellationModel->updateOrderById($orderId, $cancellationData);

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
            $responder = $_POST['responder'] ?? null; // 'admin' or not specified

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
            error_log("Responding to cancellation request for order ID: $orderId, status: $status");
            // Update order based on response
            if ($status === 'accepted') {
                // Accept the cancellation - update order status to cancelled
                $updateData = [
                    'order_status' => 'canceled',
                    'cancellation_acceptancy' => 'yes'
                ];

                $result = $orderModel->updateOrderById($orderId, $updateData);
                error_log("Orderrrrrrrr status updated to 'canceled' for order ID: $orderId, result: " . ($result ? 'success' : 'failure'));

                if ($result) {
                    // Refund the customer - assuming you have a refund process in place
                    $transaction = new Transaction();
                    $refund_time = date('Y-m-d H:i:s');

                    $returned_transaction = $transaction->getTransactionsByOrderId($orderId);
                    error_log("Returned transaction: " . json_encode($returned_transaction));
                    error_log(print_r($returned_transaction, 1));

                    $transaction_id = $returned_transaction[0]['transaction_id'];
                    error_log("Transaction ID: $transaction_id");
                    $refund_data = [
                        'status' => 'refund',
                        'refunded_at' => $refund_time
                    ];
                    $transaction_result = $transaction->updateTransactionById($transaction_id, $refund_data);

                    $wallet = new Wallet();
                    $transaction_amount = $returned_transaction[0]['amount'];

                    $refund_amount = - ($transaction_amount * 0.98); // 2% fee deducted, negative for deduction

                    $wallet_result = $wallet->updateWalletBalance(100, $refund_amount);
                }

                if ($result && $transaction_result && $wallet_result) {
                    
                    // Send notification to the customer about cancellation acceptance
                    $notificationModel = new Notification();
                    $notificationDataForCustomer = [
                        'generated_by' => 'system',
                        'admin_id' => null,
                        'receiver_id' => $order['customer_id'],
                        'generation_note' => "Order cancellation - Order ID #" .  $orderId,
                        'notification' => "Your order has been canceled. Refunded amount: " . $transaction_amount,
                        'read_status' => 'unread',
                        'created_at' => date('Y-m-d H:i:s')
                    ];

                    if (!$notificationModel->create($notificationDataForCustomer)) {
                        error_log('Failed to create notification for the customer.');
                    }

                    // Send notification to the seller about cancellation acceptance
                    $notificationDataForSeller = [
                        'generated_by' => 'system',
                        'admin_id' => null,
                        'receiver_id' => $order['seller_id'],
                        'generation_note' => "Order cancellation - Order ID #" .  $orderId,
                        'notification' => "Your order has been canceled.",
                        'read_status' => 'unread',
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    if (!$notificationModel->create($notificationDataForSeller)) {
                        error_log('Failed to create notification for the seller.');
                    }

                    // Log in admin action logs if responder is admin
                    if ($responder === 'admin') {
                        $adminActionModel = new Action();
                        $actionData = [
                            'admin_id' => $user['user_id'],
                            'user_id' => $order['customer_id'],
                            'order_id' => $orderId,
                            'action_type' => 'order_canceled',
                            'action_note' => "Order cancellation accepted by admin. Refunded amount: " . $transaction_amount,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        $adminActionModel->create($actionData);
                    }

                    // Send success response
                    $response->sendJson([
                        'success' => true,
                        'message' => 'Cancellation request accepted successfully and refunded!'
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


}
