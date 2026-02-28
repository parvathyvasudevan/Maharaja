<?php
// public/admin/db_migration.php
require_once __DIR__ . '/../../includes/init_lang.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/security.php';

// Simple authentication check - only admin
if (!isset($_SESSION['admin_id'])) {
    die("Unauthorized access. Please login as admin first.");
}

echo "<h2>Starting Database Migration...</h2><br>";

function addColumnIfMissing($pdo, $table, $column, $type) {
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
        if ($stmt->rowCount() == 0) {
            $pdo->exec("ALTER TABLE `$table` ADD `$column` $type");
            echo "<span style='color: green;'>✅ Added column `$column` to table `$table`.</span><br>";
        } else {
            echo "<span style='color: blue;'>ℹ️ Column `$column` already exists in table `$table`.</span><br>";
        }
    } catch (PDOException $e) {
        echo "<span style='color: red;'>❌ Error adding `$column` to `$table`: " . $e->getMessage() . "</span><br>";
    }
}

// 1. Migrate 'orders' table
addColumnIfMissing($pdo, 'orders', 'coupon_id', 'INT(11) DEFAULT NULL AFTER user_id');
addColumnIfMissing($pdo, 'orders', 'discount_amount', 'DECIMAL(10,2) DEFAULT 0.00 AFTER shipping_cost');
addColumnIfMissing($pdo, 'orders', 'payment_method', "VARCHAR(50) DEFAULT 'cod' AFTER status");

// 2. Ensure 'coupons' table has 'used_count' and 'max_uses'
addColumnIfMissing($pdo, 'coupons', 'used_count', 'INT(11) DEFAULT 0');
addColumnIfMissing($pdo, 'coupons', 'max_uses', 'INT(11) DEFAULT 0');

echo "<h3>Migration Completed!</h3> <a href='index.php'>Go to Admin Dashboard</a>";
?>
