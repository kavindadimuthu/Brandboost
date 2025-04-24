<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Dotenv\Dotenv;

// --- Load .env for DB credentials ---
$dotenv = Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load();

error_log('Chat server started...');
error_log('DB_DSN: ' . $_ENV['DB_DSN']);
error_log('DB_USER: ' . $_ENV['DB_USER']);
error_log('DB_PASSWORD: ' . $_ENV['DB_PASSWORD']);

// --- Setup DB credentials from env ---
$dbUser = $_ENV['DB_USER'] ?? 'root';
$dbPass = $_ENV['DB_PASSWORD'] ?? '';
$dbName = 'brandboost';
$dbHost = 'localhost';

// --- Use BaseModel for DB operations ---
require_once __DIR__ . '/core/BaseModel.php';

class ChatMessageModel extends \app\core\BaseModel
{
    protected $table = 'chat_messages';
}

class UserSessionModel extends \app\core\BaseModel
{
    protected $table = 'user_sessions';
}

class Chat implements MessageComponentInterface {
    protected $clients; // All connected clients
    protected $userConnections; // Map userId => ConnectionInterface

    protected $chatMessageModel;
    protected $userSessionModel;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->userConnections = [];
        $this->chatMessageModel = new ChatMessageModel();
        $this->userSessionModel = new UserSessionModel();
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
                $userId = $this->authenticateToken($data['token']);
                if ($userId) {
                    $from->authenticated = true;
                    $from->userId = $userId;
                    $this->userConnections[$userId] = $from;
                    $from->send(json_encode(['type' => 'auth_success', 'userId' => $userId]));
                } else {
                    $from->send(json_encode(['type' => 'auth_failed']));
                    $from->close();
                }
            } else {
                $from->send(json_encode(['type' => 'auth_required']));
            }
            return;
        }

        if (!isset($data['type'])) {
            $from->send(json_encode(['type' => 'error', 'message' => 'Missing type']));
            return;
        }

        switch ($data['type']) {
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

    // --- Helper Methods ---

    private function authenticateToken($token) {
        $session = $this->userSessionModel->readOne([
            'session_token' => $token,
            'expires_at >=' => date('Y-m-d H:i:s')
        ]);
        return $session ? $session['user_id'] : false;
    }

    private function handleMessage(ConnectionInterface $from, $data) {
        $senderId = $from->userId;
        $receiverId = intval($data['to'] ?? 0);
        $message = trim($data['message'] ?? '');
        $now = date('Y-m-d H:i:s');

        if (!$receiverId || !$message) {
            $from->send(json_encode(['type' => 'error', 'message' => 'Invalid message']));
            return;
        }

        // Store message in DB
        $msgData = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $message,
            'created_at' => $now,
            'status' => 'sent'
        ];
        $success = $this->chatMessageModel->create($msgData);
        $msgId = $this->chatMessageModel->getLastInsertId();

        $payload = [
            'type' => 'message',
            'id' => $msgId,
            'from' => $senderId,
            'to' => $receiverId,
            'message' => $message,
            'created_at' => $now,
            'status' => 'sent'
        ];

        // Send to receiver if online
        if (isset($this->userConnections[$receiverId])) {
            $this->userConnections[$receiverId]->send(json_encode($payload));
            // Update status to 'delivered'
            $this->chatMessageModel->update(['id' => $msgId], [
                'status' => 'delivered',
                'delivered_at' => date('Y-m-d H:i:s')
            ]);
            $payload['status'] = 'delivered';
        }

        // Echo back to sender (for UI update)
        $from->send(json_encode($payload));
    }

    private function sendHistory(ConnectionInterface $conn, $withUserId) {
        $userId = $conn->userId;
        $withUserId = intval($withUserId);
        if (!$withUserId) {
            $conn->send(json_encode(['type' => 'error', 'message' => 'Missing withUserId']));
            return;
        }
        $messages = $this->chatMessageModel->read(
            [],
            [
                'columns' => [
                    'id', 'sender_id', 'receiver_id', 'message', 'created_at', 'status'
                ],
                'order' => 'created_at ASC',
                'limit' => 100,
                'filters' => [
                    // Custom filter for (sender_id = userId AND receiver_id = withUserId) OR (sender_id = withUserId AND receiver_id = userId)
                ]
            ]
        );

        // If BaseModel doesn't support OR in filters, fallback to custom query:
        if ($messages === false) {
            $sql = "SELECT id, sender_id, receiver_id, message, created_at, status 
                    FROM chat_messages 
                    WHERE (sender_id = :uid1 AND receiver_id = :uid2) OR (sender_id = :uid2 AND receiver_id = :uid1)
                    ORDER BY created_at ASC LIMIT 100";
            $messages = $this->chatMessageModel->executeCustomQuery($sql, [
                'uid1' => $userId,
                'uid2' => $withUserId
            ]);
        } else {
            // Filter manually if needed
            $messages = array_filter($messages, function ($row) use ($userId, $withUserId) {
                return
                    ($row['sender_id'] == $userId && $row['receiver_id'] == $withUserId) ||
                    ($row['sender_id'] == $withUserId && $row['receiver_id'] == $userId);
            });
        }

        $conn->send(json_encode([
            'type' => 'history',
            'withUserId' => $withUserId,
            'messages' => array_values($messages)
        ]));
    }
}

// Run the server
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080 // Port
);

echo "BrandBoost Chat WebSocket server running on port 8080\n";
$server->run();