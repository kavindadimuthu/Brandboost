<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

// Utility Imports
use app\core\Helpers\AuthHelper;
use app\core\Utils\FileHandler;

// Model Imports
use app\models\Orders\Orders;
use app\models\Orders\OrderDeliveries;



class RevisionController extends BaseController {

    public function requestRevision($request, $response): void {
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
            $content = $_POST['revision_notes'] ?? null;
            
            if (empty($orderId) || empty($content)) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'No data provided for revision.'
                ]);
                return;
            }

            // Handle file uploads using FileHandler
            $savedFiles = [];
            $uploadDir = 'cdn_uploads/revision/';
            
            if (isset($_FILES['revision_photos']) && is_array($_FILES['revision_photos']['name'])) {
                // Create a temporary array for multiple file uploads
                for ($i = 0; $i < count($_FILES['revision_photos']['name']); $i++) {
                    if ($_FILES['revision_photos']['error'][$i] === UPLOAD_ERR_OK) {
                        $tempFile = [
                            'name' => $_FILES['revision_photos']['name'][$i],
                            'type' => $_FILES['revision_photos']['type'][$i],
                            'tmp_name' => $_FILES['revision_photos']['tmp_name'][$i],
                            'error' => $_FILES['revision_photos']['error'][$i],
                            'size' => $_FILES['revision_photos']['size'][$i]
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

            $deliveriesModel = new OrderDeliveries();
            $returnedDelivery = $deliveriesModel->getDeliveriesByOrder($orderId);

            // Check if there are any deliveries
            if (empty($returnedDelivery) || !is_array($returnedDelivery)) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'No deliveries found for this order.'
                ]);
                return;
            }

            // Find the latest delivery by ID
            $latestDelivery = null;
            $latestDeliveryId = 0;

            foreach ($returnedDelivery as $delivery) {
                if (isset($delivery['delivery_id']) && $delivery['delivery_id'] > $latestDeliveryId) {
                    $latestDeliveryId = $delivery['delivery_id'];
                    $latestDelivery = $delivery;
                }
            }

            if (!$latestDelivery) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Could not determine the latest delivery.'
                ]);
                return;
            }

            // Save Revision request in DB
            $revision = [
                'delivery_id' => $latestDeliveryId,
                'order_id' => $orderId,
                'revision_note' => $content, 
                'revision_files' => json_encode($savedFiles), // Fixed: removed unnecessary array brackets
                'status' => 'rejected',
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            if (!$deliveriesModel->updateDelivery($latestDeliveryId, $revision)) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Failed to submit revision request.'
                ]);
                return;
            }
    
            $response->sendJson([
                'success' => true,
                'message' => 'Revision requested successfully.'
            ]);
            
        } catch (\Exception $e) {
            // Log the error
            error_log('Revision request error: ' . $e->getMessage());
            
            // Send a JSON response even for errors
            $response->sendJson([
                'success' => false,
                'message' => 'An error occurred while processing your request: ' . $e->getMessage()
            ]);
        }
    }}