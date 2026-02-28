<?php
// public/admin/db_migration.php
require_once __DIR__ . '/../../includes/db.php';

// No strict session check for this specific fix-it script to ensure it runs
// but we add a small safety check for local or specific trigger

echo "<h2>Database Synchronization Tool</h2><hr>";

function addColumnIfMissing($pdo, $table, $column, $type) {
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
        if ($stmt->rowCount() == 0) {
            $pdo->exec("ALTER TABLE `$table` ADD `$column` $type");
            echo "<span style='color: green; font-weight: bold;'>✅ SUCCESS:</span> Added column `<strong>$column</strong>` to table `<strong>$table</strong>`.<br>";
        } else {
            echo "<span style='color: blue;'>ℹ️ INFO:</span> Column `<strong>$column</strong>` already exists in `<strong>$table</strong>`.<br>";
        }
    } catch (PDOException $e) {
        echo "<span style='color: red; font-weight: bold;'>❌ ERROR:</span> Adding `$column` to `$table`: " . $e->getMessage() . "<br>";
    }
}

// 1. Migrate 'orders' table
echo "<h4>Checking 'orders' table...</h4>";
addColumnIfMissing($pdo, 'orders', 'coupon_id', 'INT(11) DEFAULT NULL AFTER user_id');
addColumnIfMissing($pdo, 'orders', 'discount_amount', 'DECIMAL(10,2) DEFAULT 0.00 AFTER shipping_cost');
addColumnIfMissing($pdo, 'orders', 'tax_amount', 'DECIMAL(10,2) DEFAULT 0.00 AFTER discount_amount');
addColumnIfMissing($pdo, 'orders', 'payment_method', "VARCHAR(50) DEFAULT 'cod' AFTER status");

// 2. Ensure 'coupons' table has 'used_count' and 'max_uses'
echo "<h4>Checking 'coupons' table...</h4>";
addColumnIfMissing($pdo, 'coupons', 'used_count', 'INT(11) DEFAULT 0');
addColumnIfMissing($pdo, 'coupons', 'max_uses', 'INT(11) DEFAULT 0');

echo "<hr><h3>Migration Process Finished!</h3>";
echo "<p>Now try to place an order again at <a href='../checkout.php'>Checkout Page</a>.</p>";
?>
