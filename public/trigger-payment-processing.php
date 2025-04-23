<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../controllers/PaymentController.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use app\core\Request;
use app\core\Response;

// Simulate a GET request (optional if controller logic depends on method)
$_SERVER['REQUEST_METHOD'] = 'GET';

// Initialize response object
$response = new Response();

echo "<pre>";
print_r($_ENV); // or getenv('DB_HOST') etc.
echo "</pre>";


// Run the payment processing controller logic
try {
    $controller = new PaymentController();
    $controller->processScheduledReleases(new Request(), $response);

    // Display output
    echo "<h1>Payment Processing Results:</h1>";
    echo "<pre>" . print_r(json_decode($response->getContent(), true), true) . "</pre>";
} catch (Exception $e) {
    echo "<h1>Error Occurred</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
