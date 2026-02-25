<?php
$host = "buzhj6ro7wqspxvahnlg-mysql.services.clever-cloud.com";
$user = "u7bqftk5wsk8uzhc";
$password = "VWClCAcZKzlSib9dArbN";
$database = "buzhj6ro7wqspxvahnlg";
$port = 3386; // Corrected port from dashboard screenshot

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
