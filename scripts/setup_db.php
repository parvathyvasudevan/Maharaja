<?php
// scripts/setup_db.php
// Robust script to apply migrations (adding bilingual columns) and seed data

require_once __DIR__ . '/../includes/db.php';

function columnExists($pdo, $table, $column) {
    try {
        $stmt = $pdo->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
        return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        return false;
    }
}

try {
    echo "--- MAHARAJA DB SETUP ---\n\n";

    // 1. MIGRATION: Update categories table
    if (!columnExists($pdo, 'categories', 'name_en')) {
        echo "Updating categories table...\n";
        $pdo->exec("ALTER TABLE categories CHANGE COLUMN name name_en VARCHAR(100)");
        $pdo->exec("ALTER TABLE categories ADD COLUMN name_ro VARCHAR(100) AFTER name_en");
        echo "Added name_en/name_ro to categories.\n";
    }

    // 2. MIGRATION: Update products table
    if (!columnExists($pdo, 'products', 'title_en')) {
        echo "Updating products table...\n";
        $pdo->exec("ALTER TABLE products CHANGE COLUMN title title_en VARCHAR(255)");
        $pdo->exec("ALTER TABLE products ADD COLUMN title_ro VARCHAR(255) AFTER title_en");
        $pdo->exec("ALTER TABLE products CHANGE COLUMN description description_en TEXT");
        $pdo->exec("ALTER TABLE products ADD COLUMN description_ro TEXT AFTER description_en");
        echo "Added bilingual columns to products.\n";
    }

    // 3. MIGRATION: Update customers table
    if (!columnExists($pdo, 'customers', 'preferred_lang')) {
        echo "Updating customers table...\n";
        $pdo->exec("ALTER TABLE customers ADD COLUMN preferred_lang ENUM('en', 'ro') DEFAULT 'en' AFTER phone");
        echo "Added preferred_lang to customers.\n";
    }

    echo "\n--- SEEDING DATA ---\n";
    
    // Clear existing data to avoid duplicate key errors if re-running
    // (Optional: remove if you want to keep existing data)
    echo "Cleaning existing products/categories for fresh seed...\n";
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("TRUNCATE TABLE order_items");
    $pdo->exec("TRUNCATE TABLE products");
    $pdo->exec("TRUNCATE TABLE categories");
    $pdo->exec("TRUNCATE TABLE admins");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    // Load and split seed data
    $seedSql = file_get_contents(__DIR__ . '/../sql/seed_data.sql');
    
    // Simple split by semicolon (caution: won't handle semicolons inside strings perfectly, but works for our seed file)
    $queries = array_filter(array_map('trim', explode(';', $seedSql)));
    
    foreach ($queries as $query) {
        if (!empty($query)) {
            $pdo->exec($query);
        }
    }
    
    echo "Seed data applied successfully!\n";
    echo "Admin account (admin / admin123) is ready.\n";

} catch (PDOException $e) {
    die("ERROR: " . $e->getMessage() . "\n");
}
?>
