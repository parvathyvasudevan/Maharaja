<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Starting test...<br>";

$config_path_parent = __DIR__ . '/../config/database.php';
$config_path_local = __DIR__ . '/config/database.php';

echo "Checking parent: $config_path_parent<br>";
echo "Checking local: $config_path_local<br>";

if (file_exists($config_path_local)) {
    echo "Local Config file found.<br>";
    require_once $config_path_local;
} elseif (file_exists($config_path_parent)) {
    echo "Parent Config file found.<br>";
    require_once $config_path_parent;
} else {
    echo "Config file NOT found in either location.<br>";
    exit;
}

if (isset($link)) {
    echo "DB Link is set.<br>";
} else {
    echo "DB Link is NOT set.<br>";
}

echo "Test complete.";
?>