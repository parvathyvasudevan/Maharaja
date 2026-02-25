<?php

$host = "buzhj6ro7wqspxvahnlg-mysql.services.clever-cloud.com";
$db   = "buzhj6ro7wqspxvahnlg";
$user = "u7bqftk5wsk8uzhc";
$pass = "VWClCAcZKzlSib9dArbN";
$port = 3306;
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
