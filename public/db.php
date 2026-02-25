<?php
// Local Database configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "maharaja_db";
$port = 3306;

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = new mysqli($host, $user, $password, $database, $port);
    $link = $conn; 
} catch (Exception $e) {
    $conn = (object)[
        'connect_error' => $e->getMessage(),
        'error' => $e->getMessage()
    ];
}
?>
