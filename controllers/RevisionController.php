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

    public function deliverNow($request, $response): void {
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
            $content = $_POST['delivery_notes'] ?? null;
            
    
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

            $currentRevisionNo = $returnedOrder['revision_number'];
            $newRevisionNo = $currentRevisionNo + 1;
            if ($newRevisionNo > 3) {
                throw new Exception('Maximum number of revisions (3) reached for this order');
            }
    
            // Save Revision request in DB
            $revision = [
                'order_id' => $orderId,
                'revision_number' => $newRevisionNo,
                'revision_note' => $content, 
                'revision_files' => json_encode($savedFiles[]), // Store as JSON array
                'created_at' => date('Y-m-d H:i:s')
            ];
    
            $revisionModel = new OrderRevision();
            if (!$revisionModel->createRevision($revision)) {
                $response->sendJson([
                    'success' => false,
                    'message' => 'Failed to submit complaint.'
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
    }
}