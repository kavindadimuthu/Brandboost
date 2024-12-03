<?php

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'brandboost');
define('DB_USER', 'root');
define('DB_PASS', '');

// Base URL
define('BASE_URL', 'http://localhost:8000');

// Debugging Mode
define('DEBUG', true);

// Timezone Setting
// date_default_timezone_set('Sri_Lanka/Colombo');

// Error Reporting
if (DEBUG) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    // ini_set('display_errors', 0);
    // error_reporting(0);
}
?>
