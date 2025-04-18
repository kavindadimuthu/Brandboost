<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Request;
use app\core\Response;

class ActionController extends BaseController {
    /**
     * Get a paginated and filtered list of admin actions
     * 
     * @param Request $request The HTTP request object
     * @param Response $response The HTTP response object
     * @return Response JSON response with action data and pagination details
     */
    public function getActionList($request, $response) {
        // Verify admin access
        $user = AuthHelper::getCurrentUser();
        if ($user['role'] !== 'admin') {
            return $response->sendJson(['error' => 'Unauthorized access'], 403);
        }

        // Extract and sanitize query parameters
        $queryParams = $request->getQueryParams();
        
        // Pagination parameters
        $limit = isset($queryParams['limit']) ? (int)$queryParams['limit'] : 10;
        $page = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
        $offset = ($page - 1) * $limit;
        
        // Sorting parameters
        $sortBy = in_array($queryParams['sort_by'] ?? '', [
            'action_id', 'admin_id', 'action_type', 'user_id', 
            'order_id', 'created_at', 'action_note'
        ]) ? $queryParams['sort_by'] : 'created_at';
        
        $orderDir = strtolower($queryParams['order_dir'] ?? '') === 'desc' ? 'DESC' : 'ASC';
        
        // Search parameters
        $search = $queryParams['search'] ?? '';
        $searchColumns = ['action_note', 'action_type']; // Columns to search in
        
        // Build filter conditions
        $conditions = [];
        
        // Apply specific filters if provided
        $filterableFields = [
            'action_id', 'admin_id', 'action_type', 
            'user_id', 'order_id'
        ];
        
        foreach ($filterableFields as $field) {
            if (isset($queryParams[$field]) && $queryParams[$field] !== '') {
                $conditions[$field] = $queryParams[$field];
            }
        }
        
        // Date range filtering
        $dateFrom = $queryParams['date_from'] ?? null;
        $dateTo = $queryParams['date_to'] ?? null;
        
        // Build options for querying
        $options = [
            'limit' => $limit,
            'offset' => $offset,
            'order' => "$sortBy $orderDir",
            'filters' => []
        ];
        
        // Add search if provided
        if (!empty($search)) {
            $options['search'] = $search;
            $options['searchColumns'] = $searchColumns;
        }
        
        // Add date range to options if provided
        if ($dateFrom || $dateTo) {
            $dateConditions = [];
            $dateParams = [];
            
            if ($dateFrom) {
                $options['filters']['created_at >='] = date('Y-m-d 00:00:00', strtotime($dateFrom));
            }
            
            if ($dateTo) {
                $options['filters']['created_at <='] = date('Y-m-d 23:59:59', strtotime($dateTo));
            }
        }

        // Get action model and fetch data
        $actionModel = $this->model('Actions\Action');
        
        // Get the count for pagination first
        $totalCount = $actionModel->count($conditions, $options);
        
        // Then get the actual data
        $actions = $actionModel->read($conditions, $options);
        
        if ($actions === false) {
            return $response->sendJson([
                'success' => false,
                'error' => 'Failed to fetch action records'
            ], 500);
        }

        // Calculate pagination metadata
        $totalPages = ceil($totalCount / $limit);
        
        // Format the response
        return $response->sendJson([
            'success' => true,
            'data' => $actions,
            'pagination' => [
                'total_records' => $totalCount,
                'total_pages' => $totalPages,
                'current_page' => $page,
                'per_page' => $limit,
                'has_next' => ($page < $totalPages),
                'has_prev' => ($page > 1)
            ],
            'filters' => [
                'search' => $search,
                'date_from' => $dateFrom,
                'date_to' => $dateTo,
                'sort_by' => $sortBy,
                'order_dir' => $orderDir
            ]
        ], 200);
    }
}