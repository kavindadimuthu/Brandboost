<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Dotenv\Dotenv;
use app\services\NotificationService;

// Load .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Start server
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new NotificationService()
        )
    ),
    8081
);

echo "BrandBoost Notification WebSocket server running on port 8081\n";
$server->run();