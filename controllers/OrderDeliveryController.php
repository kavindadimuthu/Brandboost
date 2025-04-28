<?php


require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Request;
use app\core\Response;

// Utility Imports
use app\core\Helpers\AuthHelper;
use app\core\Utils\FileHandler;


class OrderDeliveryController extends BaseController
{
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

            $revisionData = [
                'remained_revisions' => isset($orderData['remained_revisions']) && is_numeric($orderData['remained_revisions']) 
                    ? max(0, (int)$orderData['remained_revisions'] - 1) 
                    : 0
            ];
            error_log("Prepared revision dataaaaaa: " . json_encode($revisionData));

            // Create the delivery with detailed error catching
            try {
                error_log("Attempting to create delivery record in database");
                $created = $deliveryModel->createDelivery($deliveryData);

                $revision = $orderModel->updateOrderById($orderId, $revisionData);

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

}