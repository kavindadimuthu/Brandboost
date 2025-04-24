<?php
namespace app\services;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use app\models\Communication\ChatMessage;
use app\models\Communication\ChatRoom;
use app\core\Helpers\AuthHelper;

class ChatService implements MessageComponentInterface {
    protected $clients;
    protected $userConnections = [];
    protected $chatMessageModel;
    protected $chatRoomModel;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->chatMessageModel = new ChatMessage();
        $this->chatRoomModel = new ChatRoom();
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        $conn->authenticated = false;
        $conn->userId = null;
        $conn->send(json_encode(['type' => 'auth_required']));
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        if (!$from->authenticated) {
            if (isset($data['type']) && $data['type'] === 'auth' && !empty($data['token'])) {
                $userId = AuthHelper::authenticate($data['token']);
                if ($userId) {
                    $from->authenticated = true;
                    $from->userId = $userId;
                    $this->userConnections[$userId] = $from;
                    $from->send(json_encode(['type' => 'auth_success', 'userId' => $userId]));
                } else {
                    $from->send(json_encode(['type' => 'auth_failed', 'message' => $data]));
                    $from->close();
                }
            } else {
                $from->send(json_encode(['type' => 'auth_required']));
            }
            return;
        }

        switch ($data['type'] ?? null) {
            case 'message':
                $this->handleMessage($from, $data);
                break;
            case 'fetch_history':
                $this->sendHistory($from, $data['withUserId'] ?? null);
                break;
            default:
                $from->send(json_encode(['type' => 'error', 'message' => 'Unknown command']));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        if ($conn->authenticated && isset($this->userConnections[$conn->userId])) {
            unset($this->userConnections[$conn->userId]);
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }

    /**
     * Handles sending and storing a chat message.
     */
    private function handleMessage(ConnectionInterface $from, $data) {
        $senderId = $from->userId;
        $receiverId = $data['to'] ?? null;
        $messageText = $data['message'] ?? '';

        if (!$receiverId || !$messageText) {
            $from->send(json_encode(['type' => 'error', 'message' => 'Missing receiver or message']));
            return;
        }

        // Find or create chat room for these two users (order doesn't matter)
        $room = $this->chatRoomModel->readOne([
            'user_1' => min($senderId, $receiverId),
            'user_2' => max($senderId, $receiverId)
        ]);
        if (!$room) {
            $this->chatRoomModel->create([
                'user_1' => min($senderId, $receiverId),
                'user_2' => max($senderId, $receiverId)
            ]);
            $room = $this->chatRoomModel->readOne([
                'user_1' => min($senderId, $receiverId),
                'user_2' => max($senderId, $receiverId)
            ]);
        }
        $chatRoomId = $room['chat_room_id'];

        // Store message
        $msgData = [
            'chat_room_id' => $chatRoomId,
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $messageText,
            'read_status' => 'sent'
        ];
        $this->chatMessageModel->create($msgData);
        $msgData['created_at'] = date('Y-m-d H:i:s'); // Optionally add timestamp

        // Send to receiver if online
        if (isset($this->userConnections[$receiverId])) {
            $this->userConnections[$receiverId]->send(json_encode([
                'type' => 'message',
                'from' => $senderId,
                'message' => $messageText,
                'created_at' => $msgData['created_at']
            ]));
            // Optionally update delivered_at and read_status
            $lastId = $this->chatMessageModel->getLastInsertId();
            $this->chatMessageModel->update(['message_id' => $lastId], [
                'delivered_at' => date('Y-m-d H:i:s'),
                'read_status' => 'delivered'
            ]);
        }

        // Confirm to sender
        $from->send(json_encode([
            'type' => 'message_sent',
            'to' => $receiverId,
            'message' => $messageText,
            'created_at' => $msgData['created_at']
        ]));
    }

    /**
     * Sends chat history between the authenticated user and another user.
     */
    private function sendHistory(ConnectionInterface $conn, $withUserId) {
        $userId = $conn->userId;
        if (!$withUserId) {
            $conn->send(json_encode(['type' => 'error', 'message' => 'Missing withUserId']));
            return;
        }

        // Find chat room for these two users
        $room = $this->chatRoomModel->readOne([
            'user_1' => min($userId, $withUserId),
            'user_2' => max($userId, $withUserId)
        ]);
        if (!$room) {
            $conn->send(json_encode(['type' => 'history', 'messages' => []]));
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
            'messages' => $messages ?: []
        ]));
    }
}