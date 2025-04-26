<?php

namespace app\services;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use app\models\Communication\Notification;
use app\models\Users\User;
use app\core\Helpers\AuthHelper;

class NotificationService implements MessageComponentInterface
{
    protected $clients;
    protected $userConnections = [];
    protected $notificationModel;
    protected $userModel;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->notificationModel = new Notification();
        $this->userModel = new User();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $conn->authenticated = false;
        $conn->userId = null;
        $conn->send(json_encode(['type' => 'auth_required']));
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);

        // Handle authentication first
        if (!$from->authenticated) {
            if (isset($data['type']) && $data['type'] === 'auth' && !empty($data['token'])) {
                $userId = AuthHelper::authenticate($data['token']);
                if ($userId) {
                    $from->authenticated = true;
                    $from->userId = $userId;
                    $this->userConnections[$userId] = $from;
                    $from->send(json_encode(['type' => 'auth_success', 'userId' => $userId]));

                    // Send notifications list after authentication
                    $this->sendNotificationsList($from);
                } else {
                    $from->send(json_encode(['type' => 'auth_failed']));
                    $from->close();
                }
            } else {
                $from->send(json_encode(['type' => 'auth_required']));
            }
            return;
        }

        // Handle various message types
        switch ($data['type'] ?? '') {
            case 'fetch_notifications':
                $this->sendNotificationsList($from);
                break;
            case 'mark_read':
                $this->markNotificationAsRead($from, $data['notification_id'] ?? null);
                break;
            case 'mark_all_read':
                $this->markAllNotificationsAsRead($from);
                break;
            default:
                $from->send(json_encode(['type' => 'error', 'message' => 'Unknown command', 'data' => $data]));
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

        if ($conn->authenticated && isset($this->userConnections[$conn->userId])) {
            unset($this->userConnections[$conn->userId]);
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        error_log("Error in notification service: " . $e->getMessage());
        $conn->close();
    }

    /**
     * Sends the list of all notifications for the current user.
     */
    private function sendNotificationsList(ConnectionInterface $conn)
    {
        $userId = $conn->userId;

        // Fetch notifications for this user, ordered by created_at
        $notifications = $this->notificationModel->read(
            ['receiver_id' => $userId],
            ['order' => 'created_at DESC', 'limit' => 50]
        );

        // Get unread count
        $unreadCount = $this->notificationModel->count([
            'receiver_id' => $userId,
            'read_status' => 'unread'
        ]);

        // Format notifications for display
        $formattedNotifications = [];
        if ($notifications) {
            foreach ($notifications as $notification) {
                $formattedNotifications[] = [
                    'id' => $notification['notification_id'],
                    'message' => $notification['notification'],
                    'details' => $notification['generation_note'],
                    'read' => $notification['read_status'] === 'read',
                    'created_at' => $notification['created_at'],
                    'time_ago' => $this->getTimeAgo($notification['created_at'])
                ];
            }
        }

        $conn->send(json_encode([
            'type' => 'notifications_list',
            'notifications' => $formattedNotifications,
            'unread_count' => $unreadCount
        ]));
    }

    /**
     * Mark a notification as read.
     */
    private function markNotificationAsRead(ConnectionInterface $conn, $notificationId)
    {
        if (!$notificationId) {
            $conn->send(json_encode(['type' => 'error', 'message' => 'Missing notification ID']));
            return;
        }

        $userId = $conn->userId;

        // Verify the notification belongs to this user
        $notification = $this->notificationModel->readOne([
            'notification_id' => $notificationId,
            'receiver_id' => $userId
        ]);

        if (!$notification) {
            $conn->send(json_encode(['type' => 'error', 'message' => 'Notification not found']));
            return;
        }

        // Update to read status
        $this->notificationModel->update(['notification_id' => $notificationId], [
            'read_status' => 'read'
        ]);

        // Get updated unread count
        $unreadCount = $this->notificationModel->count([
            'receiver_id' => $userId,
            'read_status' => 'unread'
        ]);

        $conn->send(json_encode([
            'type' => 'notification_marked_read',
            'notification_id' => $notificationId,
            'unread_count' => $unreadCount
        ]));
    }

    /**
     * Mark all notifications as read for the current user.
     */
    private function markAllNotificationsAsRead(ConnectionInterface $conn)
    {
        $userId = $conn->userId;

        // Update all unread notifications to read
        $this->notificationModel->update(
            [
                'receiver_id' => $userId,
                'read_status' => 'unread'
            ],
            [
                'read_status' => 'read'
            ]
        );

        $conn->send(json_encode([
            'type' => 'all_notifications_marked_read',
            'unread_count' => 0
        ]));
    }

    /**
     * Send a notification to a specific user.
     * This method can be called from other parts of the application.
     * 
     * @param int $userId The ID of the user to send the notification to
     * @param string $notification The notification message
     * @param string $details Optional details about the notification
     * @param string $generatedBy Who generated the notification ('system' or 'admin')
     * @param int|null $adminId The admin ID if generated by an admin
     * @return bool Success or failure
     */
    public function sendNotification($userId, $notification, $details = '', $generatedBy = 'system', $adminId = null)
    {
        // Create notification in database
        $notificationData = [
            'generated_by' => $generatedBy,
            'admin_id' => $adminId,
            'receiver_id' => $userId,
            'generation_note' => $details,
            'notification' => $notification,
            'read_status' => 'unread',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $created = $this->notificationModel->create($notificationData);
        if (!$created) {
            return false;
        }

        $notificationId = $this->notificationModel->getLastInsertId();

        // If user is connected, send the notification in real-time
        if (isset($this->userConnections[$userId])) {
            $this->userConnections[$userId]->send(json_encode([
                'type' => 'new_notification',
                'notification' => [
                    'id' => $notificationId,
                    'message' => $notification,
                    'details' => $details,
                    'read' => false,
                    'created_at' => date('Y-m-d H:i:s'),
                    'time_ago' => 'Just now'
                ]
            ]));
        }

        return true;
    }

    /**
     * Generate human-readable time difference
     */
    private function getTimeAgo($datetime)
    {
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
}