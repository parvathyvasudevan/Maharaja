<?php
// public/admin/ultra_fix.php

// STANDALONE SCRIPT - DO NOT DELETE
// This script bypasses all includes to fix the database directly.

$host = getenv('DB_SERVER') ?: getenv('MYSQL_ADDON_HOST') ?: "localhost";
$db   = getenv('DB_NAME') ?: getenv('MYSQL_ADDON_DB') ?: "maharaja_db";
$user = getenv('DB_USERNAME') ?: getenv('MYSQL_ADDON_USER') ?: "root";
$pass = getenv('DB_PASSWORD') ?: getenv('MYSQL_ADDON_PASSWORD') ?: "";
$port = getenv('DB_PORT') ?: getenv('MYSQL_ADDON_PORT') ?: 3306;

echo "<h2>Database Ultra-Fix Utility (Comprehensive)</h2><hr>";
echo "Connecting to: $host ($db)...<br>";

$conn = mysqli_connect($host, $user, $pass, $db, (int)$port);

if (!$conn) {
    die("<span style='color:red;'>Connection failed: " . mysqli_connect_error() . "</span>");
}

function addCol($conn, $table, $col, $type) {
    echo "Checking $table -> $col... ";
    $check = mysqli_query($conn, "SHOW COLUMNS FROM `$table` LIKE '$col'");
    if (!$check || mysqli_num_rows($check) == 0) {
        $sql = "ALTER TABLE `$table` ADD `$col` $type";
        if (mysqli_query($conn, $sql)) {
            echo "<span style='color:green;'>ADDED ✅</span><br>";
        } else {
            echo "<span style='color:red;'>FAILED ❌ (" . mysqli_error($conn) . ")</span><br>";
        }
    } else {
        echo "<span style='color:blue;'>EXISTS ℹ️</span><br>";
    }
}

// 1. Mandatory Orders table columns check
echo "<h3>1. Fixing 'orders' table structure</h3>";
addCol($conn, 'orders', 'user_id', 'INT(11) DEFAULT NULL AFTER id');
addCol($conn, 'orders', 'coupon_id', 'INT(11) DEFAULT NULL AFTER user_id');
addCol($conn, 'orders', 'name', 'VARCHAR(100) NOT NULL AFTER coupon_id');
addCol($conn, 'orders', 'email', 'VARCHAR(100) DEFAULT NULL AFTER name');
addCol($conn, 'orders', 'phone', 'VARCHAR(20) NOT NULL AFTER email');
addCol($conn, 'orders', 'address', 'TEXT NOT NULL AFTER phone');
addCol($conn, 'orders', 'subtotal_amount', 'DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER address');
addCol($conn, 'orders', 'shipping_cost', 'DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER subtotal_amount');
addCol($conn, 'orders', 'discount_amount', 'DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER shipping_cost');
addCol($conn, 'orders', 'tax_amount', 'DECIMAL(10,2) NOT NULL DEFAULT 0.00 AFTER discount_amount');
addCol($conn, 'orders', 'total_amount', 'DECIMAL(10,2) NOT NULL AFTER tax_amount');
addCol($conn, 'orders', 'status', "ENUM('pending','processing','completed','cancelled') NOT NULL DEFAULT 'pending' AFTER total_amount");
addCol($conn, 'orders', 'payment_method', "VARCHAR(50) DEFAULT 'cod' AFTER status");
addCol($conn, 'orders', 'created_at', 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER payment_method');

// 2. Coupons table synchronization
echo "<h3>2. Fixing 'coupons' table structure</h3>";
$table_check = mysqli_query($conn, "SHOW TABLES LIKE 'coupons'");
if (mysqli_num_rows($table_check) == 0) {
    echo "Creating 'coupons' table... ";
    $sql = "CREATE TABLE `coupons` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `code` varchar(50) NOT NULL,
      `type` enum('percentage','fixed') NOT NULL,
      `value` decimal(10,2) NOT NULL,
      `min_order` decimal(10,2) DEFAULT 0.00,
      `used_count` int(11) DEFAULT 0,
      `max_uses` int(11) DEFAULT 0,
      `is_active` tinyint(1) DEFAULT 1,
      `expires_at` date DEFAULT NULL,
      `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`),
      UNIQUE KEY `code` (`code`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    if (mysqli_query($conn, $sql)) { echo "<span style='color:green;'>CREATED ✅</span><br>"; }
    else { echo "<span style='color:red;'>FAILED ❌</span><br>"; }
} else {
    addCol($conn, 'coupons', 'used_count', 'INT(11) DEFAULT 0');
    addCol($conn, 'coupons', 'max_uses', 'INT(11) DEFAULT 0');
    addCol($conn, 'coupons', 'min_order', 'DECIMAL(10,2) DEFAULT 0.00');
    addCol($conn, 'coupons', 'is_active', 'TINYINT(1) DEFAULT 1');
    addCol($conn, 'coupons', 'expires_at', 'DATE DEFAULT NULL');
}

echo "<hr><h4>ALL DONE!</h4>";
echo "<p>Now try to place an order: <a href='../checkout.php'>Go to Checkout</a></p>";

mysqli_close($conn);
?>
