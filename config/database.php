<?php
// Database configuration - Use Environment Variables first, then Local fallback
$host = getenv('DB_SERVER') ?: "localhost";
$user = getenv('DB_USERNAME') ?: "root";
$password = getenv('DB_PASSWORD') ?: "";
$database = getenv('DB_NAME') ?: "maharaja_db";
$port = getenv('DB_PORT') ?: 3306;

define('DB_SERVER', $host);
define('DB_USERNAME', $user);
define('DB_PASSWORD', $password);
define('DB_NAME', $database);

/* Attempt to connect to MySQL database */
try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect($host, $user, $password, $database, (int)$port);
    $conn = $link; // For compatibility
    mysqli_set_charset($link, 'utf8mb4');
} catch (Exception $e) {
    // Prevent fatal crash, just log/handle the error
    error_log("Database connection error: " . $e->getMessage());
    $db_connection_error = $e->getMessage();
}
?>