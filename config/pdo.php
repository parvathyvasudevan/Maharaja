<?php
// PDO configuration - Use Environment Variables first, then Clever Cloud fallback
$host = getenv('DB_SERVER') ?: "buzhj6ro7wqspxvahnlg-mysql.services.clever-cloud.com";
$db   = getenv('DB_NAME') ?: "buzhj6ro7wqspxvahnlg";
$user = getenv('DB_USERNAME') ?: "u7bqftk5wsk8uzhc";
$pass = getenv('DB_PASSWORD') ?: "VWClCAcZKzlSib9dArbN";
$port = getenv('DB_PORT') ?: 3306; // Reverted to 3306 as requested
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
