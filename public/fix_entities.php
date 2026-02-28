<?php
require_once __DIR__ . '/../includes/db.php';

echo "<h2>Database Entity Cleanup</h2><hr>";

function fix_table($pdo, $table, $columns) {
    echo "Processing table: <strong>$table</strong><br>";
    $stmt = $pdo->query("SELECT id, " . implode(", ", $columns) . " FROM $table");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($rows as $row) {
        $updates = [];
        $params = [];
        foreach ($columns as $col) {
            $decoded = html_entity_decode($row[$col], ENT_QUOTES, 'UTF-8');
            if ($decoded !== $row[$col]) {
                $updates[] = "$col = ?";
                $params[] = $decoded;
            }
        }
        
        if (!empty($updates)) {
            $params[] = $row['id'];
            $sql = "UPDATE $table SET " . implode(", ", $updates) . " WHERE id = ?";
            $update_stmt = $pdo->prepare($sql);
            $update_stmt->execute($params);
            echo " - Updated ID: " . $row['id'] . "<br>";
        }
    }
    echo "Done with $table.<br><br>";
}

try {
    fix_table($pdo, 'categories', ['name_en', 'name_ro']);
    fix_table($pdo, 'products', ['title_en', 'title_ro', 'description_en', 'description_ro']);
    fix_table($pdo, 'orders', ['name', 'address']);
    echo "<h3>All fixes completed!</h3>";
} catch (Exception $e) {
    echo "<h3 style='color:red;'>Error: " . $e->getMessage() . "</h3>";
}
?>
