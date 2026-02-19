<?php
// Database Configuration

define('DB_SERVER', getenv('DB_SERVER') ?: 'localhost');
define('DB_USERNAME', getenv('DB_USERNAME') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'maharaja_db');

/* Attempt to connect to MySQL database */
try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    mysqli_set_charset($link, 'utf8mb4');
} catch (Exception $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>