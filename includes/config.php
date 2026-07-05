<?php
/**
 * Configuration File
 * Database and Application Settings
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'barbershop');

// Application Settings
define('APP_NAME', 'Elite Barber Shop');
define('APP_URL', 'http://localhost/barbershop');
define('APP_TIMEZONE', 'UTC');

// Security Settings
define('SESSION_TIMEOUT', 3600);
define('PASSWORD_HASH_ALGO', 'bcrypt');
define('UPLOAD_PATH', __DIR__ . '/../uploads/');
define('MAX_UPLOAD_SIZE', 5242880); // 5MB

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');

// Set Timezone
date_default_timezone_set(APP_TIMEZONE);

// Start Session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    session_set_cookie_params([
        'lifetime' => SESSION_TIMEOUT,
        'path' => '/',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}
