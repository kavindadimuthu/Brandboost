<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Request;
use app\core\Response;
use app\models\Actions\Verification;

class VerificationController extends BaseController {
    /**
     * Fetch a list of verification requests with pagination and filtering options.
     * 
     * @param Request $request The HTTP request object.
     * @param Response $response The response object.
     * @return void JSON response with the list of verification requests.
     */
    public function getVerificationsList($request, $response) {
        error_log('Verification list page entered successfully: ');
        $user = AuthHelper::getCurrentUser();
        if ($user['role'] !== 'admin') {
            return $response->sendJson(['error' => 'Unauthorized'], 403);
        }

        $queryParams = $request->getQueryParams();
        error_log('Query Params: '); // Log the query parameters for debugging
        error_log(print_r($queryParams, true)); // Log the query parameters for debugging

        // Pagination & sorting parameters
        $limit = $queryParams['limit'] ?? 10;
        $offset = $queryParams['offset'] ?? 0;
        $sortBy = $queryParams['sort_by'] ?? 'name';
        $orderDir = $queryParams['order_dir'] ?? 'asc';
        // Search & filter parameters
        $searchTerm = $queryParams['search'] ?? null;

        // Validate limit and offset
        if (!is_numeric($limit) || !is_numeric($offset)) {
            $response->sendError('Invalid pagination parameters.', 400);
            return;
        }

        // Build filter options for the model
        $allowedFilters = ['user_id', 'name', 'email', 'phone', 'bio', 'role', 'professional_title', 'specialties', 'tools', 'location', 'account_status', 'verification_status'];

        // Add filters to the query
        $filters = [];
        foreach ($allowedFilters as $filter) {
            if (isset($queryParams[$filter]) && $queryParams[$filter] !== '') {
                $filters[$filter] = $queryParams[$filter];
            }
        }

        // Retrieve the Verification model
        $verificationModel = $this->model('Actions\Verification');

        // Build options for querying the user list
        $options = [
            'limit' => (int)$limit,
            'offset' => (int)$offset,
            'order' => $sortBy . ' ' . (strtolower($orderDir) === 'desc' ? 'desc' : 'asc'),
        ];

        if ($searchTerm) {
            $options['search'] = $searchTerm;
            $options['searchColumns'] = ['name', 'email'];
        }

        if (!empty($filters)) {
            $options['filters'] = $filters;
        }
        
        $totalCount = $verificationModel->count([], $options);
        $result = $verificationModel->getVerificationsList($queryParams);

        $totalPages = $limit > 0 ? ceil($totalCount / $limit) : 1;
        $currentPage = $limit > 0 ? floor($offset / $limit) + 1 : 1;
        
        if ($result === false) {
            return $response->sendJson(['error' => 'Failed to fetch verification requests'], 500);
        }

        error_log(print_r($result, true)); // Log the result for debugging
        
        return $response->sendJson([
            'success' => true,
            'data' => $result['verifications'],
            'pagination' => $result['pagination']
        ], 200);
    }
    
    /**
     * Update the status of a verification request.
     * 
     * @param Request $request The HTTP request object.
     * @param Response $response The response object.
     * @return void JSON response with the result of the operation.
     */
    public function updateVerificationStatus($request, $response) {
        $user = AuthHelper::getCurrentUser();
        if ($user['role'] !== 'admin') {
            return $response->sendJson(['error' => 'Unauthorized'], 403);
        }
        
        $data = $request->getParsedBody();
        $id = $data['id'] ?? null;
        $type = $data['type'] ?? null;
        $status = $data['status'] ?? null;
        
        if (!$id || !$type || !$status) {
            return $response->sendJson(['error' => 'Missing required fields'], 400);
        }
        
        if (!in_array($status, ['verified', 'rejected'])) {
            return $response->sendJson(['error' => 'Invalid status value'], 400);
        }
        
        $verificationModel = new Verification();
        
        if ($type === 'business') {
            $updateQuery = "UPDATE businessman SET br_status = :status WHERE user_id = :id";
            $result = $verificationModel->executeCustomQuery($updateQuery, [
                ':status' => $status,
                ':id' => $id
            ]);
        } else if ($type === 'social_media') {
            $updateQuery = "UPDATE influencer_social_account SET link_status = :status WHERE account_id = :id";
            $result = $verificationModel->executeCustomQuery($updateQuery, [
                ':status' => $status,
                ':id' => $id
            ]);
        } else {
            return $response->sendJson(['error' => 'Invalid verification type'], 400);
        }
        
        if ($result === false) {
            return $response->sendJson(['error' => 'Failed to update verification status'], 500);
        }
        
        return $response->sendJson([
            'success' => true,
            'message' => 'Verification status updated successfully'
        ], 200);
    }





    // ...existing code...
    /**
     * Get detailed information about a single verification request.
     * 
     * @param Request $request The HTTP request object.
     * @param Response $response The response object.
     * @return void JSON response with detailed verification information.
     */
    public function getVerificationDetails($request, $response) {

        error_log('Verification details page entered successfully: ');
        $user = AuthHelper::getCurrentUser();
        if ($user['role'] !== 'admin') {
            return $response->sendJson(['error' => 'Unauthorized'], 403);
        }

        $params = $request->getQueryParams();
        $id = $params['id'] ?? null;
        $type = $params['type'] ?? null;

        if (!$id || !$type) {
            return $response->sendJson(['error' => 'Missing required parameters'], 400);
        }

        $verificationModel = new Verification();
        
        if ($type === 'business') {
            $query = "
                SELECT 
                    b.*,
                    u.email,
                    u.name,
                    u.phone
                FROM 
                    businessman b
                JOIN 
                    user u ON b.user_id = u.user_id
                WHERE 
                    b.user_id = :id
            ";
        } else if ($type === 'social_media') {
            $query = "
                SELECT 
                    isa.*,
                    u.email,
                    u.name,
                    u.phone
                FROM 
                    influencer_social_account isa
                JOIN 
                    user u ON isa.user_id = u.user_id
                WHERE 
                    isa.account_id = :id
            ";
        } else {
            return $response->sendJson(['error' => 'Invalid verification type'], 400);
        }

        $details = $verificationModel->executeCustomQuery($query, [':id' => $id], false);
        
        if (!$details) {
            return $response->sendJson(['error' => 'Verification request not found'], 404);
        }

        // Format response based on verification type
        $formattedDetails = $this->formatVerificationDetails($details, $type);
        
        return $response->sendJson([
            'success' => true,
            'data' => $formattedDetails
        ], 200);
    }

    /**
     * Format verification details based on type for consistent frontend display.
     * 
     * @param array $details Raw verification details from database.
     * @param string $type Type of verification ('business' or 'social_media').
     * @return array Formatted verification details.
     */
    private function formatVerificationDetails($details, $type) {
        $common = [
            'id' => $type === 'business' ? $details['user_id'] : $details['account_id'],
            'type' => $type,
            'user' => [
                'id' => $details['user_id'],
                'email' => $details['email'],
                'fullName' => $details['name'],
                'phone' => $details['phone']
            ],
            'status' => $type === 'business' ? $details['br_status'] : $details['link_status'],
            'createdAt' => $type === 'social_media' ? $details['created_at'] : null,
            'updatedAt' => $details['updated_at']
        ];

        if ($type === 'business') {
            return array_merge($common, [
                'businessName' => $details['business_name'],
                'businessType' => $details['business_type'],
                'brDocument' => $details['br_document']
                // Note: Removed fields that don't exist in the actual schema:
                // businessAddress, businessType, brNumber, and additionalInfo object
            ]);
        } else {
            return array_merge($common, [
                'platform' => $details['platform'],
                'username' => $details['username'],
                'link' => $details['link']
                // Note: Removed fields that don't exist in the actual schema:
                // displayName, followers, and additionalInfo object
            ]);
        }
    }
// ...existing code...
}