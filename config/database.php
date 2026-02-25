<?php
$host = "buzhj6ro7wqspxvahnlg-mysql.services.clever-cloud.com";
$user = "u7bqftk5wsk8uzhc";
$password = "VWClCAcZKzlSib9dArbN";
$database = "buzhj6ro7wqspxvahnlg";
$port = 3306;

define('DB_SERVER', $host);
define('DB_USERNAME', $user);
define('DB_PASSWORD', $password);
define('DB_NAME', $database);

/* Attempt to connect to MySQL database */
try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect($host, $user, $password, $database, $port);
    $conn = $link; // For compatibility
    mysqli_set_charset($link, 'utf8mb4');
} catch (Exception $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>