<?php
// Simple script to call the process-releases endpoint
$url = "http://localhost:8000/api/payments/process-releases";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Log the response
echo "Response ($httpCode): " . $response . "\n";