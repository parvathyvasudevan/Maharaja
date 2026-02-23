<?php
// scripts/seed.php
// Script to apply seed data to the database

require_once __DIR__ . '/../includes/db.php';

try {
    $sql = file_get_contents(__DIR__ . '/../sql/seed_data.sql');
    
    // Execute multiple queries
    $pdo->exec($sql);
    
    echo "Seed data applied successfully!\n";
    echo "- Categories inserted\n";
    echo "- Products inserted\n";
    echo "- Admin account created (username: admin, password: admin123)\n";
} catch (PDOException $e) {
    echo "Error applying seed data: " . $e->getMessage() . "\n";
}
?>
