<?php

namespace app\services;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use app\models\Communication\ChatMessage;
use app\models\Communication\ChatRoom;
use app\models\Users\User;
use app\core\Helpers\AuthHelper;

class ChatService implements MessageComponentInterface
{
    protected $clients;
    protected $userConnections = [];
    protected $chatMessageModel;
    protected $chatRoomModel;
    protected $userModel;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->chatMessageModel = new ChatMessage();
        $this->chatRoomModel = new ChatRoom();
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

                    // Broadcast online status to relevant users
                    $this->broadcastUserStatus($userId, 'online');

                    // Send conversation list after authentication
                    $this->sendConversationsList($from);
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
            case 'message':
                $this->handleMessage($from, $data);
                break;
            case 'fetch_history':
                $this->sendHistory($from, $data['withUserId'] ?? null, $data['orderId'] ?? null);
                break;
            case 'fetch_conversations':
                $this->sendConversationsList($from, $data['includeOrderChats'] ?? true);
                break;
            case 'fetch_order_chat':
                $this->fetchOrderChat($from, $data['orderId'] ?? null, $data['otherUserId'] ?? null);
                break;
            case 'mark_read':
                $this->markMessagesAsRead($from, $data['to'] ?? null, $data['orderId'] ?? null);
                break;
            case 'typing':
                $this->broadcastTypingStatus($from, $data['to'] ?? null, true, $data['orderId'] ?? null);
                break;
            case 'typing_stop':
                $this->broadcastTypingStatus($from, $data['to'] ?? null, false, $data['orderId'] ?? null);
                break;
            default:
                $from->send(json_encode(['type' => 'error', 'message' => 'Unknown command', 'data' => $data]));
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);

        if ($conn->authenticated && isset($this->userConnections[$conn->userId])) {
            // Broadcast offline status before removing the connection
            $this->broadcastUserStatus($conn->userId, 'offline');
            unset($this->userConnections[$conn->userId]);
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        error_log("Error in chat service: " . $e->getMessage());
        $conn->close();
    }

    /**
     * Handles sending and storing a chat message.
     */
    private function handleMessage(ConnectionInterface $from, $data)
    {
        $senderId = $from->userId;
        $receiverId = $data['to'] ?? null;
        $messageText = $data['message'] ?? '';
        $orderId = $data['orderId'] ?? null;

        if (!$receiverId || !$messageText) {
            $from->send(json_encode(['type' => 'error', 'message' => 'Missing receiver or message']));
            return;
        }

        // Determine if this is an order chat or general chat
        if ($orderId) {
            // Find or create an order-specific chat room
            $room = $this->getOrderChatRoom($orderId, $senderId, $receiverId);
        } else {
            // Find or create a general chat room for these two users
            $room = $this->getGeneralChatRoom($senderId, $receiverId);
        }

        if (!$room) {
            $from->send(json_encode(['type' => 'error', 'message' => 'Could not create chat room']));
            return;
        }

        $chatRoomId = $room['chat_room_id'];
        $now = date('Y-m-d H:i:s');

        // Store message
        $msgData = [
            'chat_room_id' => $chatRoomId,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $messageText,
            'read_status' => 'sent',
            'created_at' => $now
        ];

        $this->chatMessageModel->create($msgData);
        $messageId = $this->chatMessageModel->getLastInsertId();

        // Send to receiver if online
        if (isset($this->userConnections[$receiverId])) {
            $this->userConnections[$receiverId]->send(json_encode([
                'type' => 'message',
                'id' => $messageId,
                'from' => $senderId,
                'message' => $messageText,
                'created_at' => $now,
                'orderId' => $orderId,
                'chatType' => $orderId ? 'order' : 'general'
            ]));

            // Update to delivered status
            $this->chatMessageModel->update(['message_id' => $messageId], [
                'delivered_at' => $now,
                'read_status' => 'delivered'
            ]);
        }

        // Confirm to sender
        $from->send(json_encode([
            'type' => 'message_sent',
            'id' => $messageId,
            'to' => $receiverId,
            'message' => $messageText,
            'created_at' => $now,
            'orderId' => $orderId,
            'chatType' => $orderId ? 'order' : 'general'
        ]));
    }

    /**
     * Gets or creates a general chat room between two users
     */
    private function getGeneralChatRoom($user1Id, $user2Id)
    {
        // Make sure user_1 is the smaller ID to maintain consistency
        $user1 = min($user1Id, $user2Id);
        $user2 = max($user1Id, $user2Id);

        // Find existing chat room
        $room = $this->chatRoomModel->readOne([
            'user_1' => $user1,
            'user_2' => $user2,
            'chat_type' => 'general'
        ]);

        // Create if doesn't exist
        if (!$room) {
            $this->chatRoomModel->create([
                'user_1' => $user1,
                'user_2' => $user2,
                'chat_type' => 'general'
            ]);
            $room = $this->chatRoomModel->readOne([
                'user_1' => $user1,
                'user_2' => $user2,
                'chat_type' => 'general'
            ]);
        }

        return $room;
    }

    /**
     * Gets or creates an order-specific chat room
     */
    private function getOrderChatRoom($orderId, $user1Id, $user2Id)
    {
        // Make sure user_1 is the smaller ID to maintain consistency
        $user1 = min($user1Id, $user2Id);
        $user2 = max($user1Id, $user2Id);

        // Find existing order chat room
        $room = $this->chatRoomModel->readOne([
            'order_id' => $orderId,
            'chat_type' => 'order'
        ]);

        // Create if doesn't exist
        if (!$room) {
            $this->chatRoomModel->create([
                'user_1' => $user1,
                'user_2' => $user2,
                'order_id' => $orderId,
                'chat_type' => 'order'
            ]);
            $room = $this->chatRoomModel->readOne([
                'order_id' => $orderId,
                'chat_type' => 'order'
            ]);
        }

        return $room;
    }

    /**
     * Fetches or creates an order chat room and sends its details to the client.
     */
    private function fetchOrderChat(ConnectionInterface $conn, $orderId, $otherUserId = null)
    {
        $userId = $conn->userId;

        if (!$orderId) {
            $conn->send(json_encode(['type' => 'error', 'message' => 'Missing order ID']));
            return;
        }

        // We need to determine the other party in the order
        // This would require accessing the orders table to find who's the buyer and who's the seller
        // For now, let's assume we pass the other user ID in the request
        // In a real implementation, you would query the orders table

        // Create or get the order chat room
        $room = $this->chatRoomModel->readOne([
            'order_id' => $orderId,
            'chat_type' => 'order'
        ]);

        // If room exists, get other user from room data
        if ($room) {
            $otherUserId = ($room['user_1'] == $userId) ? $room['user_2'] : $room['user_1'];
        }
        // If room doesn't exist but we have order details, create a new room
        else {
            // Here you would ideally query your orders table to get the other party
            // For example: $orderDetails = $orderModel->getById($orderId);

            // For this implementation, we'll assume you have a way to get the other user ID
            // This could be passed in the request or determined from your orders table

            // You might need to add a parameter to the fetch_order_chat request
            // that includes the other user ID
            // $otherUserId = $data['otherUserId'] ?? null; // You'd need to add this parameter to your client request

            if (!$otherUserId) {
                $conn->send(json_encode([
                    'type' => 'error',
                    'message' => 'Cannot determine chat participant',
                    'orderId' => $orderId,
                    'withUserId' => $otherUserId,
                    'data' => $conn
                ]));
                return;
            }

            // Create a new chat room for this order
            $this->chatRoomModel->create([
                'user_1' => min($userId, $otherUserId),
                'user_2' => max($userId, $otherUserId),
                'order_id' => $orderId,
                'chat_type' => 'order'
            ]);

            // Get the newly created room
            $room = $this->chatRoomModel->read([
                'order_id' => $orderId,
                'chat_type' => 'order'
            ]);

            if (!$room) {
                $conn->send(json_encode([
                    'type' => 'error',
                    'message' => 'Failed to create order chat room'
                ]));
                return;
            }
        }

        // Determine the other user in the chat
        $otherUserId = ($room['user_1'] == $userId) ? $room['user_2'] : $room['user_1'];

        // Get user details
        $user = $this->userModel->getUserById($otherUserId);

        if (!$user) {
            $conn->send(json_encode([
                'type' => 'error',
                'message' => 'Chat participant not found'
            ]));
            return;
        }

        // Get last message
        $lastMessage = $this->chatMessageModel->read(
            ['chat_room_id' => $room['chat_room_id']],
            ['order' => 'created_at DESC', 'limit' => 1]
        );

        // Count unread messages
        $unreadCount = $this->chatMessageModel->count([
            'chat_room_id' => $room['chat_room_id'],
            'receiver_id' => $userId,
            'read_status' => ['sent', 'delivered']
        ]);

        $conn->send(json_encode([
            'type' => 'order_chat',
            'orderId' => $orderId,
            'chatRoomId' => $room['chat_room_id'],
            'participant' => [
                'userId' => $otherUserId,
                'name' => $user['name'] ?? 'User ' . $otherUserId,
                'avatar' => $user['profile_picture'] ?? '/assets/default-avatar.png',
                'status' => isset($this->userConnections[$otherUserId]) ? 'online' : 'offline'
            ],
            'lastMessage' => $lastMessage[0] ?? null,
            'unreadCount' => $unreadCount
        ]));

        // Also send the chat history
        $this->sendHistory($conn, $otherUserId, $orderId);
    }

    /**
     * Sends chat history between the authenticated user and another user.
     * Optionally filters by order ID for order-specific chats.
     */
    private function sendHistory(ConnectionInterface $conn, $withUserId, $orderId = null)
    {
        $userId = $conn->userId;

        if (!$withUserId) {
            $conn->send(json_encode(['type' => 'error', 'message' => 'Missing user ID']));
            return;
        }

        // Find appropriate chat room based on whether it's an order chat or general chat
        if ($orderId) {
            $room = $this->chatRoomModel->readOne([
                'order_id' => $orderId,
                'chat_type' => 'order'
            ]);
        } else {
            $room = $this->chatRoomModel->readOne([
                'user_1' => min($userId, $withUserId),
                'user_2' => max($userId, $withUserId),
                'chat_type' => 'general'
            ]);
        }

        if (!$room) {
            $conn->send(json_encode([
                'type' => 'history',
                'withUserId' => $withUserId,
                'orderId' => $orderId,
                'messages' => []
            ]));
            return;
        }

        $chatRoomId = $room['chat_room_id'];

        // Fetch messages in this room, ordered by created_at
        $messages = $this->chatMessageModel->read(
            ['chat_room_id' => $chatRoomId],
            ['order' => 'created_at ASC']
        );

        $conn->send(json_encode([
            'type' => 'history',
            'withUserId' => $withUserId,
            'orderId' => $orderId,
            'chatType' => $orderId ? 'order' : 'general',
            'messages' => $messages ?: []
        ]));
    }

    /**
     * Sends the list of all conversations for the current user.
     * @param bool $includeOrderChats Whether to include order-specific chats
     */
    private function sendConversationsList(ConnectionInterface $conn, $includeOrderChats = true)
    {
        $userId = $conn->userId;
        $conversations = [];

        // Find rooms where user is user_1
        $rooms1 = $this->chatRoomModel->read(['user_1' => $userId]);

        // Find rooms where user is user_2
        $rooms2 = $this->chatRoomModel->read(['user_2' => $userId]);

        // Merge the results
        $rooms = array_merge($rooms1 ?: [], $rooms2 ?: []);

        foreach ($rooms as $room) {
            // Skip order chats if not requested
            if (!$includeOrderChats && $room['chat_type'] === 'order') {
                continue;
            }

            // Determine the other user in the chat
            $otherUserId = ($room['user_1'] == $userId) ? $room['user_2'] : $room['user_1'];

            // Get user details
            $user = $this->userModel->getUserById($otherUserId);

            if (!$user) continue;

            // Get last message
            $lastMessage = $this->chatMessageModel->read(
                ['chat_room_id' => $room['chat_room_id']],
                ['order' => 'created_at DESC', 'limit' => 1]
            );

            // Count unread messages
            $unreadCount = $this->chatMessageModel->count([
                'chat_room_id' => $room['chat_room_id'],
                'receiver_id' => $userId,
                'read_status' => ['sent', 'delivered']
            ]);

            // Add to conversations list
            $conversations[] = [
                'userId' => $otherUserId,
                'name' => $user['name'] ?? 'User ' . $otherUserId,
                'avatar' => $user['profile_picture'] ?? '/assets/default-avatar.png',
                'lastMessage' => $lastMessage[0]['message'] ?? '',
                'lastMessageTime' => $lastMessage[0]['created_at'] ?? '',
                'unread' => $unreadCount,
                'status' => isset($this->userConnections[$otherUserId]) ? 'online' : 'offline',
                'chatType' => $room['chat_type'],
                'orderId' => $room['order_id'],
                'chatRoomId' => $room['chat_room_id']
            ];
        }

        $conn->send(json_encode([
            'type' => 'conversations',
            'conversations' => $conversations
        ]));
    }

    /**
     * Mark messages from a specific user as read.
     * Optionally in the context of an order chat.
     */
    private function markMessagesAsRead(ConnectionInterface $conn, $fromUserId, $orderId = null)
    {
        if (!$fromUserId) return;

        $userId = $conn->userId;
        
        // Find appropriate chat room
        if ($orderId) {
            $room = $this->chatRoomModel->readOne([
                'order_id' => $orderId,
                'chat_type' => 'order'
            ]);
        } else {
            $room = $this->chatRoomModel->readOne([
                'user_1' => min($userId, $fromUserId),
                'user_2' => max($userId, $fromUserId),
                'chat_type' => 'general'
            ]);
        }

        if (!$room) return;

        // Update all unread messages
        $this->chatMessageModel->update(
            [
                'chat_room_id' => $room['chat_room_id'],
                'sender_id' => $fromUserId,
                'receiver_id' => $userId,
                'read_status' => ['sent', 'delivered']
            ],
            [
                'read_status' => 'read',
                'read_at' => date('Y-m-d H:i:s')
            ]
        );

        // Notify the sender that messages have been read
        if (isset($this->userConnections[$fromUserId])) {
            $this->userConnections[$fromUserId]->send(json_encode([
                'type' => 'messages_read',
                'by' => $userId,
                'orderId' => $orderId,
                'chatType' => $orderId ? 'order' : 'general'
            ]));
        }
    }

    /**
     * Broadcast user online/offline status to relevant users.
     */
    private function broadcastUserStatus($userId, $status)
    {
        // Find rooms where user is user_1
        $rooms1 = $this->chatRoomModel->read(['user_1' => $userId]);

        // Find rooms where user is user_2
        $rooms2 = $this->chatRoomModel->read(['user_2' => $userId]);

        // Merge the results
        $rooms = array_merge($rooms1 ?: [], $rooms2 ?: []);

        if (!$rooms) return;

        foreach ($rooms as $room) {
            // Get the other user
            $otherUserId = ($room['user_1'] == $userId) ? $room['user_2'] : $room['user_1'];

            // Send status update if they're online
            if (isset($this->userConnections[$otherUserId])) {
                $this->userConnections[$otherUserId]->send(json_encode([
                    'type' => 'user_status',
                    'userId' => $userId,
                    'status' => $status,
                    'orderId' => $room['order_id'],
                    'chatType' => $room['chat_type']
                ]));
            }
        }
    }

    /**
     * Broadcast typing status to the recipient.
     * Optionally in the context of an order chat.
     */
    private function broadcastTypingStatus(ConnectionInterface $from, $toUserId, $isTyping, $orderId = null)
    {
        if (!$toUserId) return;

        $userId = $from->userId;

        if (isset($this->userConnections[$toUserId])) {
            $this->userConnections[$toUserId]->send(json_encode([
                'type' => $isTyping ? 'typing' : 'typing_stop',
                'userId' => $userId,
                'orderId' => $orderId,
                'chatType' => $orderId ? 'order' : 'general'
            ]));
        }
    }
}