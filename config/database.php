<?php
// Database configuration - Use Environment Variables first, then Clever Cloud fallback
$host = getenv('DB_SERVER') ?: "buzhj6ro7wqspxvahnlg-mysql.services.clever-cloud.com";
$user = getenv('DB_USERNAME') ?: "u7bqftk5wsk8uzhc";
$password = getenv('DB_PASSWORD') ?: "VWClCAcZKzlSib9dArbN";
$database = getenv('DB_NAME') ?: "buzhj6ro7wqspxvahnlg";
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
    // If the error is 'No such host', it's likely a DNS issue or typo in the fallback host
    die("ERROR: Could not connect to database. " . $e->getMessage());
}
?>