<?php
$host = "buzhj6ro7wqspxvahnlg-mysql.services.clever-cloud.com";
$user = "u7bqftk5wsk8uzhc";
$password = "VWClCAcZKzlSib9dArbN";
$database = "buzhj6ro7wqspxvahnlg";
$port = 3306;

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}
$link = $conn; 
?>
