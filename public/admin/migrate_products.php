<?php
// migrate_products.php
require_once __DIR__ . '/../../config/database.php';

$queries = [
    "ALTER TABLE products ADD COLUMN IF NOT EXISTS sale_price DECIMAL(10,2) DEFAULT NULL AFTER price",
    "ALTER TABLE products ADD COLUMN IF NOT EXISTS is_active TINYINT(1) DEFAULT 1 AFTER sku"
];

foreach ($queries as $query) {
    if (mysqli_query($link, $query)) {
        echo "Successfully executed: $query\n";
    } else {
        echo "Error executing $query: " . mysqli_error($link) . "\n";
    }
}
?>
