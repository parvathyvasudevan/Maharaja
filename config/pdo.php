<?php
// PDO configuration - Use Environment Variables first, then Local fallback
$host = getenv('DB_SERVER') ?: "localhost";
$db   = getenv('DB_NAME') ?: "maharaja_db";
$user = getenv('DB_USERNAME') ?: "root";
$pass = getenv('DB_PASSWORD') ?: "";
$port = getenv('DB_PORT') ?: 3306;
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
     if (getenv('RENDER')) {
         error_log("PDO Connection Error: " . $e->getMessage());
         // We don't die here because some pages might only use mysqli,
         // but we ensuring $pdo is null to prevent fatal errors.
         $pdo = null;
     } else {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
     }
}
?>
