<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Request;
use app\core\Response;

// Utility imports
use app\core\Helpers\AuthHelper;
use app\core\Utils\FileHandler;

// Model imports
use app\models\Actions\Complaint;
use app\models\Orders\Orders;

class ComplaintController extends BaseController {

    /**
     * Get a paginated and filtered list of complaints
     * 
     * @param Request $request The HTTP request object
     * @param Response $response The HTTP response object
     * @return mixed JSON response with complaint data and pagination details
     */
    public function getComplaintList($request, $response) {
    
        $user = AuthHelper::getCurrentUser();
        if ($user['role'] !== 'admin') {
            return $response->sendJson(['error' => 'Unauthorized']);
        }
    
        $queryParams = $request->getQueryParams();
        $limit = isset($queryParams['limit']) ? (int)$queryParams['limit'] : 10;
        $offset = isset($queryParams['offset']) ? (int)$queryParams['offset'] : 0;
        $sortBy = $queryParams['sort_by'] ?? 'created_at';
        $orderDir = strtolower($queryParams['order_dir'] ?? 'desc') === 'asc' ? 'asc' : 'desc';
    
        // Build filter options for the model
        $allowedFilters = [
            'complaint_id', 'order_id', 'complainant_user_id', 'reported_user_id',
            'complaint_type', 'status', 'resolved_by_admin_id'
        ];
        $filters = [];
        foreach ($allowedFilters as $filter) {
            if (isset($queryParams[$filter]) && $queryParams[$filter] !== '') {
                $filters[$filter] = $queryParams[$filter];
            }
        }
        // Allow filtering by multiple statuses: status=open,pending
        if (isset($queryParams['status']) && strpos($queryParams['status'], ',') !== false) {
            $statuses = array_map('trim', explode(',', $queryParams['status']));
            $filters['status'] = $statuses;
        }

        // Date range filtering for created_at
        if (!empty($queryParams['date_from'])) {
            $filters['complaint.created_at >='] = $queryParams['date_from'];
        }
        if (!empty($queryParams['date_to'])) {
            $filters['complaint.created_at <='] = $queryParams['date_to'];
        }
    
        $coditions = [];
        $options = [
            'limit' => $limit,
            'offset' => $offset,
            'order' => $sortBy . ' ' . $orderDir,
        ];
        
        // Search
        if (!empty($queryParams['search'])) {
            $options['search'] = $queryParams['search'];
            $options['searchColumns'] = ['orders.order_id', 'service.title', 'customer.name', 'seller.name'];
        }
        if (!empty($filters)) {
            $options['filters'] = $filters;
        }
    
        $disputeModel = $this->model('Actions\Complaint');
        $totalCount = $disputeModel->count([], $options);
        $totalPages = $limit > 0 ? ceil($totalCount / $limit) : 1;
        $currentPage = $limit > 0 ? floor($offset / $limit) + 1 : 1;

        $disputes = $disputeModel->getComplaintsWithUsersAndAdmin($coditions, $options);
    
        if ($disputes === false) {
            return $response->sendJson(['error' => 'Failed to fetch disputes'], 500);
        }
        if (empty($disputes)) {
            return $response->sendJson([
                'success' => true,
                'data' => [],
                'pagination' => [
                    'total_disputes' => 0,
                    'total_pages' => 0,
                    'current_page' => 1,
                    'limit' => $limit,
                    'offset' => $offset,
                ],
            ]);
        }
        // Format the complaint data for the UI
        $formattedDisputes = $this->formatComplaint($disputes);
    
        return $response->sendJson([
            'success' => true,
            'data' => $formattedDisputes,
            'pagination' => [
                'total_disputes' => $totalCount,
                'total_pages' => $totalPages,
                'current_page' => $currentPage,
                'limit' => $limit,
                'offset' => $offset,
            ],
        ]);
    }


    /**
     * Get detailed information about a specific complaint
     * 
     * @param Request $request The HTTP request object
     * @param Response $response The HTTP response object
     * @return mixed JSON response with detailed complaint data
     */
    public function getComplaintDetails($request, $response) {
        $user = AuthHelper::getCurrentUser();
        if ($user['role'] !== 'admin') {
            return $response->sendJson(['error' => 'Unauthorized'], 403);
        }
        
        $complaintId = $request->getParam('id');
        if (!$complaintId) {
            return $response->sendJson(['error' => 'Complaint ID is required'], 400);
        }
        
        $disputeModel = $this->model('Actions\Complaint');
        $orderModel = $this->model('Orders\Orders');
        $orderPromisesModel = $this->model('Orders\OrderPromises');
        
        // Get complaint with joined user data
        $conditions = ['complaint_id' => $complaintId];
        $options = [];
        
        $complaint = $disputeModel->getComplaintsWithUsersAndAdmin($conditions, $options);
        $order = $orderModel->getOrderById($complaint[0]['order_id']);
        $orderPromises = $orderPromisesModel->getPromiseByOrderId($complaint[0]['order_id']);

        error_log(print_r($complaint, true)); // Debugging line
        
        if (!$complaint || empty($complaint)) {
            return $response->sendJson(['error' => 'Complaint not found'], 404);
        }
        
        // Format the complaint data for the UI
        $formattedComplaint = $this->formatComplaint($complaint[0], true);
        $formattedComplaint['order'] = $order ?: null;
        $formattedComplaint['order_promises'] = $orderPromises ?: null;
        // $formattedComplaint['attachments'] = $attachments ?: [];
        
        return $response->sendJson([
            'success' => true,
            'data' => $formattedComplaint
        ]);
    }

    /**
     * Submit a complaint for an order
     * 
     * @param Request $request The HTTP request object
     * @param Response $response The HTTP response object
     * @return void
     */
    public function CreateComplaint($request, $response): void
    {
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
            $uploadDir = 'cdn_uploads/complaints/';

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
    
    /**
     * Update the status of a complaint
     * 
     * @param Request $request The HTTP request object
     * @param Response $response The HTTP response object
     * @return mixed JSON response with result of the update operation
     */
    public function updateComplaintStatus($request, $response) {
        $user = AuthHelper::getCurrentUser();
        if ($user['role'] !== 'admin') {
            return $response->sendJson(['error' => 'Unauthorized'], 403);
        }
        
        $body = $request->getParsedBody();
        $complaintId = $body['complaint_id'] ?? null;
        $status = $body['status'] ?? null;
        $resolutionNotes = $body['resolution_notes'] ?? null;

        error_log("fvwrfbwrbwbb");
        error_log(print_r($body, true)); // Debugging line
        
        if (!$complaintId || !$status) {
            return $response->sendJson(['error' => 'Complaint ID and status are required'], 400);
        }
        
        // Validate status value
        $validStatuses = ['open', 'pending', 'resolved'];
        if (!in_array($status, $validStatuses)) {
            return $response->sendJson(['error' => 'Invalid status value'], 400);
        }
        
        $disputeModel = $this->model('Actions\Complaint');
        $updateData = [
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        // If status is resolved or closed, add resolution details
        if ($status === 'resolved') {
            $updateData['resolved_by_admin_id'] = $user['user_id'];
            $updateData['updated_at'] = date('Y-m-d H:i:s');
            
            if ($resolutionNotes) {
                $updateData['resolution_notes'] = $resolutionNotes;
            }
        }
        
        $result = $disputeModel->updateComplaintById($complaintId, $updateData);
        
        if (!$result) {
            return $response->sendJson(['error' => 'Failed to update complaint status'], 500);
        }
        
        // Log the admin action
        $actionModel = $this->model('Actions\Action');
        $actionData = [
            'admin_id' => $user['admin_id'],
            'action_type' => 'complaint_status_update',
            'entity_type' => 'complaint',
            'entity_id' => $complaintId,
            'details' => json_encode([
                'status' => $status,
                'previous_status' => $body['previous_status'] ?? 'unknown'
            ]),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $actionModel->create($actionData);
        
        return $response->sendJson([
            'success' => true,
            'message' => 'Complaint status updated successfully',
            'data' => ['status' => $status]
        ]);
    }



    /**
     * Format complaint data for API response
     * 
     * @param array $complaint Single complaint or array of complaints
     * @param bool $isDetailView Whether to include additional detail fields
     * @return array Formatted complaint data
     */
    private function formatComplaint($complaint, bool $isDetailView = false)
    {
        $formatter = function ($row) use ($isDetailView) {
            $formatted = [
                'complaint_id' => $row['complaint_id'],
                'complainant_user_id' => $row['complainant_user_id'],
                'reported_user_id' => $row['reported_user_id'],
                'complaint_type' => $row['complaint_type'],
                'description' => $row['description'],
                'status' => $row['status'],
                'is_priority' => (bool)($row['is_priority'] ?? 0),
                'resolved_by_admin_id' => $row['resolved_by_admin_id'],
                'resolution_notes' => $row['resolution_notes'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'complainant' => [
                    'user_id' => $row['complainant_user_id'],
                    'username' => $row['complainant_name'] ?? ($isDetailView ? 'Unknown User' : null),
                    'email' => $row['complainant_email'] ?? null,
                    'profile_image' => $row['complainant_profile_picture'] ?? null,
                    'user_role' => $row['complainant_user_role'] ?? null
                ],
                'reported_user' => [
                    'user_id' => $row['reported_user_id'],
                    'username' => $row['reported_name'] ?? ($isDetailView ? 'Unknown User' : null),
                    'email' => $row['reported_email'] ?? null,
                    'profile_image' => $row['reported_profile_picture'] ?? null,
                    'user_role' => $row['reported_user_role'] ?? null
                ],
                'admin' => $row['admin_name'] ? [
                    'admin_id' => $row['resolved_by_admin_id'],
                    'username' => $row['admin_name'],
                    'email' => $row['admin_email'] ?? null
                ] : null
            ];
            
            // Add detail-specific fields when needed
            if ($isDetailView) {
                $formatted = array_merge($formatted, [
                    'order_id' => $row['order_id'] ?? null,
                    'resolution_date' => $row['resolution_date'] ?? null,
                    'last_response_at' => $row['last_response_at'] ?? null,
                ]);
            }
            
            return $formatted;
        };
        
        // Handle both single complaint and array of complaints
        if (isset($complaint[0])) {
            return array_map($formatter, $complaint);
        }
        
        return $formatter($complaint);
    }


}