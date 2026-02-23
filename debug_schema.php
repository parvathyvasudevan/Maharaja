<?php
require_once __DIR__ . '/includes/db.php';
$tables = ['categories', 'products', 'customers'];
foreach ($tables as $table) {
    echo "Table: $table\n";
    $stmt = $pdo->query("DESCRIBE `$table`");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "  - " . $row['Field'] . "\n";
    }
}
?>
