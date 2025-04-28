<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\DebugHelper;
use app\core\Request;
use app\core\Response;


class GetCountController extends BaseController{
    /**
     * Get summary of service counts (total and by type).
     *
     * @param object $request Request object containing input data.
     * @param object $response Response object to send back HTTP responses.
     */
    public function getOrderCountsSummary($request, $response): void {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }
        
        if (!AuthHelper::isLoggedIn()) {
            $response->sendError('Unauthorized', 401);
            return;
        }
        
        $orderModel = $this->model('Orders\Orders');

        $totalOrders = $orderModel->count();
        $completedCount = $orderModel->count(['order_status' => 'completed']);
        $pendingCount = $orderModel->count(['order_status' => 'pending']);
        $inProgressCount = $orderModel->count(['order_status' => 'in_progress']);
        $canceledCount = $orderModel->count(['order_status' => 'canceled']);

        error_log("Total Orders: $totalOrders, Completed: $completedCount, Pending: $pendingCount, In Progress: $inProgressCount, Canceled: $canceledCount");
        // Return the counts
        $response->sendJson([
            'success' => true,
            'counts' => [
                'total' => $totalOrders,
                'completedCount' => $completedCount,
                'pendingCount' => $pendingCount,
                'inProgressCount' => $inProgressCount,
                'canceledCount' => $canceledCount
            ]
        ]);
    }

       /**
     * Get summary of service counts (total and by type).
     *
     * @param object $request Request object containing input data.
     * @param object $response Response object to send back HTTP responses.
     */
    public function getServiceCountsSummary($request, $response): void {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }
        
        if (!AuthHelper::isLoggedIn()) {
            $response->sendError('Unauthorized', 401);
            return;
        }
        
        $serviceModel = $this->model('Services\Service');

        $totalServices = $serviceModel->count();
        $gigCount = $serviceModel->count(['service_type' => 'gig']);
        $promotionCount = $serviceModel->count(['service_type' => 'promotion']);

        error_log("Total Services: $totalServices, Gig Count: $gigCount, Promotion Count: $promotionCount");
        
        // Return the counts
        $response->sendJson([
            'success' => true,
            'counts' => [
                'total' => $totalServices,
                'gig' => $gigCount,
                'promotion' => $promotionCount,
            ]
        ]);
    }

        /**
     * Get summary of user counts (total and by role).
     *
     * @param object $request Request object containing input data.
     * @param object $response Response object to send back HTTP responses.
     */
    public function getUserCountsSummary($request, $response): void {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }
        
        // Only admin users should be able to access this data
        if (AuthHelper::getCurrentUser()['role'] !== 'admin') {
            $response->sendError('Unauthorized', 401);
            return;
        }
        
        // Retrieve the User model
        $userModel = $this->model('Users\User');
        
        // Get total users count
        $totalUsers = $userModel->count();
        
        // Get counts by role
        $businessmenCount = $userModel->count(['role' => 'businessman']);
        $influencersCount = $userModel->count(['role' => 'influencer']);
        $designersCount = $userModel->count(['role' => 'designer']);
        
        // Get new signups count if sinceTime parameter exists
        $sinceTime = $request->getQueryParams()['sinceTime'] ?? null;
        $newSignupsCount = 0;
        
        if ($sinceTime) {
            // Count users registered since the given time
            $newSignupsCount = $userModel->count(['created_at >=' => $sinceTime]);
        }
        
        // Return the counts
        $response->sendJson([
            'success' => true,
            'counts' => [
                'total' => $totalUsers,
                'businessmen' => $businessmenCount,
                'influencers' => $influencersCount,
                'designers' => $designersCount,
                'newSignupsToday' => $newSignupsCount
            ]
        ]);
    }


    public function getComplaintCountsSummary($request, $response): void {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }
        
        // Safer user role checking
        try {
            $currentUser = AuthHelper::getCurrentUser();
            if (!$currentUser || !isset($currentUser['role']) || $currentUser['role'] !== 'admin') {
                $response->sendError('Unauthorized', 401);
                return;
            }
            
            // Retrieve the Complaint model
            $complaintModel = $this->model('Actions\Complaint');
            
            // Get total complaints count
            $totalComplaints = $complaintModel->count();
            
            // Get counts by status
            $openCount = $complaintModel->count(['status' => 'open']);
            $pendingCount = $complaintModel->count(['status' => 'pending']);
            $resolvedCount = $complaintModel->count(['status' => 'resolved']);

            error_log("Total Complaints: $totalComplaints, Open: $openCount, Pending: $pendingCount, Resolved: $resolvedCount");
            
            // Return the counts
            $response->sendJson([
                'success' => true,
                'counts' => [
                    'total' => $totalComplaints,
                    'pending' => $pendingCount,	
                    'open' => $openCount,
                    'resolved' => $resolvedCount
                ]
            ]);
        } catch (\Exception $e) {
            error_log('Error in getComplaintCountsSummary: ' . $e->getMessage());
            $response->setStatusCode(500);
            $response->sendJson(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }


}


