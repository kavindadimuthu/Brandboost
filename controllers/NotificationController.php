<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Request;
use app\core\Response;

// Utility Imports
use app\core\Helpers\AuthHelper;

// Model Imports
use app\models\Communication\Notification;

class NotificationController extends BaseController {
    
    /**
     * Constructor to check if the user is logged in
     */
    public function __construct() {
        if (!AuthHelper::isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }
    
    /**
     * Get all notifications for the current user
     */
    public function getNotifications($request, $response) {
        $userId = AuthHelper::getCurrentUser()['user_id'];
        
        $notificationModel = new Notification();
        
        $conditions = [];
        $options = [];

        // Get query parameters for pagination
        $queryParams = $request->getQueryParams();
        if (isset($queryParams['filter'])) {
            $conditions['read_status'] = $queryParams['filter'];
        }
        $page = isset($queryParams['page']) ? intval($queryParams['page']) : 1;
        $limit = isset($queryParams['limit']) ? intval($queryParams['limit']) : 20;
        $offset = ($page - 1) * $limit;

        $conditions['receiver_id'] = $userId;
        $options = [
            'order' => 'created_at DESC',
            'limit' => $limit,
            'offset' => $offset
        ]; 
        
        // Get notifications with pagination
        $notifications = $notificationModel->read($conditions, $options);
        
        // Get total count for pagination
        $totalCount = $notificationModel->count($conditions);
        
        // Format notifications for display
        $formattedNotifications = [];
        if ($notifications) {
            foreach ($notifications as $notification) {
                $formattedNotifications[] = [
                    'id' => $notification['notification_id'],
                    'message' => $notification['notification'],
                    'details' => $notification['generation_note'],
                    'read_status' => $notification['read_status'],
                    'created_at' => $notification['created_at'],
                    'time_ago' => $this->getTimeAgo($notification['created_at']),
                    'icon' => $this->getNotificationIcon($notification['notification'])
                ];
            }
        }
        
        $response->sendJson([
            'success' => true,
            'notifications' => $formattedNotifications,
            'pagination' => [
                'total' => $totalCount,
                'page' => $page,
                'limit' => $limit,
                'pages' => ceil($totalCount / $limit)
            ]
        ]);
    }
    
    /**
     * Mark a notification as read
     */
    public function markAsRead($request, $response) {
        $userId = AuthHelper::getCurrentUser()['user_id'];
        $data = $request->getParsedBody();
        $notificationId = $data['notification_id'] ?? null;
        
        if (!$notificationId) {
            $response->sendJson(['success' => false, 'message' => 'Notification ID is required']);
            return;
        }
        
        $notificationModel = new Notification();
        
        // Verify the notification belongs to this user
        $notification = $notificationModel->readOne([
            'notification_id' => $notificationId,
            'receiver_id' => $userId
        ]);
        
        if (!$notification) {
            $response->sendJson(['success' => false, 'message' => 'Notification not found']);
            return;
        }
        
        // Update to read status
        $updated = $notificationModel->update(['notification_id' => $notificationId], [
            'read_status' => 'read'
        ]);
        
        if ($updated) {
            $response->sendJson(['success' => true, 'message' => 'Notification marked as read']);
        } else {
            $response->sendJson(['success' => false, 'message' => 'Failed to mark notification as read']);
        }
    }
    
    /**
     * Mark all notifications as read for the current user
     */
    public function markAllAsRead($request, $response) {
        $userId = AuthHelper::getCurrentUser()['user_id'];
        
        $notificationModel = new Notification();
        
        // Update all unread notifications to read
        $updated = $notificationModel->update(
            [
                'receiver_id' => $userId,
                'read_status' => 'unread'
            ],
            [
                'read_status' => 'read'
            ]
        );
        
        if ($updated) {
            $response->sendJson(['success' => true, 'message' => 'All notifications marked as read']);
        } else {
            $response->sendJson(['success' => false, 'message' => 'Failed to mark notifications as read']);
        }
    }
    
    /**
     * Get unread notification count for the current user
     */
    public function getUnreadCount($request, $response) {
        $userId = AuthHelper::getCurrentUser()['user_id'];
        
        $notificationModel = new Notification();
        
        // Get unread count
        $unreadCount = $notificationModel->count([
            'receiver_id' => $userId,
            'read_status' => 'unread'
        ]);
        
        $response->sendJson([
            'success' => true,
            'unreadCount' => $unreadCount
        ]);
    }
    
    /**
     * Generate human-readable time difference
     */
    private function getTimeAgo($datetime) {
        $time = strtotime($datetime);
        $now = time();
        $diff = $now - $time;
        
        if ($diff < 60) {
            return 'Just now';
        } elseif ($diff < 3600) {
            $mins = floor($diff / 60);
            return $mins . ' minute' . ($mins > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 2592000) {
            $days = floor($diff / 86400);
            return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
        } elseif ($diff < 31536000) {
            $months = floor($diff / 2592000);
            return $months . ' month' . ($months > 1 ? 's' : '') . ' ago';
        } else {
            $years = floor($diff / 31536000);
            return $years . ' year' . ($years > 1 ? 's' : '') . ' ago';
        }
    }
    
    /**
     * Determine appropriate icon for notification based on content
     */
    private function getNotificationIcon($message) {
        $message = strtolower($message);
        
        if (strpos($message, 'order') !== false) {
            return 'fa-shopping-bag';
        } elseif (strpos($message, 'payment') !== false || strpos($message, 'paid') !== false || strpos($message, 'payout') !== false) {
            return 'fa-comment-dollar';
        } elseif (strpos($message, 'message') !== false || strpos($message, 'chat') !== false) {
            return 'fa-envelope';
        } elseif (strpos($message, 'approved') !== false || strpos($message, 'verified') !== false) {
            return 'fa-check-circle';
        } elseif (strpos($message, 'rejected') !== false || strpos($message, 'warning') !== false) {
            return 'fa-exclamation-triangle';
        } elseif (strpos($message, 'profile') !== false || strpos($message, 'account') !== false) {
            return 'fa-user';
        } elseif (strpos($message, 'custom package') !== false || strpos($message, 'package') !== false) {
            return 'fa-box';
        } else {
            return 'fa-bell';
        }
    }
}