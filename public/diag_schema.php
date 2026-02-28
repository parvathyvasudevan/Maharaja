<?php
require_once __DIR__ . '/includes/db.php';

echo "<h2>PDO Database Diagnostic</h2><hr>";

try {
    $stmt = $pdo->query("DESCRIBE orders");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h3>Columns in 'orders' table:</h3><ul>";
    foreach ($columns as $column) {
        echo "<li><strong>" . $column['Field'] . "</strong> (" . $column['Type'] . ")</li>";
    }
    echo "</ul>";
} catch (Exception $e) {
    echo "<h3 style='color:red;'>Error fetching schema: " . $e->getMessage() . "</h3>";
}

echo "<hr><h3>Connection Info (Environment):</h3>";
echo "DB_SERVER: " . (getenv('DB_SERVER') ?: 'Not set') . "<br>";
echo "DB_NAME: " . (getenv('DB_NAME') ?: 'Not set') . "<br>";
?>
