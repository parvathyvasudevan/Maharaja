<?php
// scripts/update_orders_table.php
require_once __DIR__ . '/../includes/db.php';

try {
    echo "Updating orders table to support bank_transfer...\n";
    $pdo->exec("ALTER TABLE orders MODIFY COLUMN payment_method ENUM('cod', 'stripe', 'bank_transfer') NOT NULL DEFAULT 'cod'");
    echo "Table updated successfully!\n";
} catch (PDOException $e) {
    die("ERROR: " . $e->getMessage() . "\n");
}
?>
