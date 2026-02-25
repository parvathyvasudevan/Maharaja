<?php
require_once __DIR__ . "/../config/database.php";

echo "<h2>Database Connection Status</h2>";

if (isset($link) && $link) {
    echo "<p style='color: green;'>✅ OK – Database connected successfully!</p>";
    
    // Test a simple query
    $result = mysqli_query($link, "SHOW TABLES");
    if ($result) {
        echo "<p>Found " . mysqli_num_rows($result) . " tables in database.</p>";
    }
} else {
    echo "<p style='color: red;'>❌ FAILED – Database could not connect.</p>";
    if (isset($db_connection_error)) {
        echo "<p><strong>Error:</strong> " . htmlspecialchars($db_connection_error) . "</p>";
    }
}

if (getenv('RENDER')) {
    echo "<hr><p><strong>Environment:</strong> Render (Production)</p>";
} else {
    echo "<hr><p><strong>Environment:</strong> Local (XAMPP/WAMP)</p>";
}
?>
