<?php
// Database configuration - Use Environment Variables first, then Clever Cloud fallback
$host = getenv('DB_SERVER') ?: "buzhj6ro7wqspxvahnlg-mysql.services.clever-cloud.com";
$user = getenv('DB_USERNAME') ?: "u7bqftk5wsk8uzhc";
$password = getenv('DB_PASSWORD') ?: "VWClCAcZKzlSib9dArbN";
$database = getenv('DB_NAME') ?: "buzhj6ro7wqspxvahnlg";
$port = getenv('DB_PORT') ?: 3386; // Corrected default port

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