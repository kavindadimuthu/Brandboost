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
        // Only admins can access
        $user = AuthHelper::getCurrentUser();
        if ($user['role'] !== 'admin') {
            $response->sendJson(['error' => 'Unauthorized access'], 403);
            return;
        }

        // Query parameters
        $queryParams = $request->getQueryParams();

        // Pagination
        $limit = isset($queryParams['limit']) && is_numeric($queryParams['limit']) ? (int)$queryParams['limit'] : 10;
        $page = isset($queryParams['page']) && is_numeric($queryParams['page']) ? (int)$queryParams['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Sorting
        $allowedSorts = ['action_id', 'admin_id', 'action_type', 'user_id', 'order_id', 'created_at', 'action_note'];
        $sortBy = in_array($queryParams['sort_by'] ?? '', $allowedSorts) ? $queryParams['sort_by'] : 'created_at';
        $orderDir = strtolower($queryParams['order_dir'] ?? '') === 'desc' ? 'DESC' : 'ASC';

        // Search
        $search = $queryParams['search'] ?? null;
        $searchColumns = ['action_note', 'action_type'];

        // Filters
        $allowedFilters = ['action_id', 'admin_id', 'action_type', 'user_id', 'order_id'];
        $filters = [];
        foreach ($allowedFilters as $filter) {
            if (isset($queryParams[$filter]) && $queryParams[$filter] !== '') {
                $filters[$filter] = $queryParams[$filter];
            }
        }

        // Date range filtering
        if (!empty($queryParams['date_from'])) {
            $filters['created_at >='] = $queryParams['date_from'];
        }
        if (!empty($queryParams['date_to'])) {
            $filters['created_at <='] = $queryParams['date_to'] . ' 23:59:59';
        }

        // Build options for model
        $options = [
            'limit' => $limit,
            'offset' => $offset,
            'order' => "$sortBy $orderDir"
        ];
        if ($search) {
            $options['search'] = $search;
            $options['searchColumns'] = $searchColumns;
        }
        if (!empty($filters)) {
            $options['filters'] = $filters;
        }

        // Model
        $actionModel = $this->model('Actions\Action');
        $totalCount = $actionModel->count([], $options);
        $actions = $actionModel->read([], $options);

        // Pagination meta
        $totalPages = ceil($totalCount / $limit);
        $pagination = [
            'total_records' => $totalCount,
            'total_pages' => $totalPages,
            'current_page' => $page,
            'per_page' => $limit
        ];

        if ($actions === false) {
            return $response->sendJson(['success' => false, 'error' => 'Failed to fetch action records'], 500);
        }
        if (empty($actions)) {
            return $response->sendJson([
                'success' => true, 
                'data' => [], 
                'pagination' => $pagination
            ]);
        }

        // Response
        return $response->sendJson([
            'success' => true,
            'data' => $actions,
            'pagination' => $pagination
        ]);
    }
}