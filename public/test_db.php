<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<html><body style='font-family: sans-serif; padding: 20px; line-height: 1.6;'>";
echo "<h2>🔍 Database Connection Diagnostic</h2>";

include "db.php";

echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #ddd; margin-bottom: 20px;'>";
echo "<b>Attempting connection to:</b><br>";
echo "Host: <code>" . htmlspecialchars($host) . "</code><br>";
echo "User: <code>" . htmlspecialchars($user) . "</code><br>";
echo "Database: <code>" . htmlspecialchars($database) . "</code>";
echo "</div>";

if ($conn->connect_error) {
    echo "<div style='background: #fff5f5; color: #c53030; padding: 15px; border-radius: 8px; border: 1px solid #feb2b2;'>";
    echo "<h3>❌ CONNECTION FAILED</h3>";
    echo "<b>Error:</b> " . htmlspecialchars($conn->connect_error) . "<br><br>";
    
    if (strpos($conn->connect_error, "No such host is known") !== false || strpos($conn->connect_error, "php_network_getaddresses") !== false) {
        echo "<h4>Why am I seeing this?</h4>";
        echo "<p>This is a <b>DNS Error</b>. It means the hostname could not be found over the internet.</p>";
        
        echo "<h4>Possible Fixes:</h4>";
        echo "<ul>";
        echo "<li><b>Check your dashboard:</b> Log in to Clever Cloud and copy the <b>\"Host\"</b> value from the \"Information\" tab again.</li>";
        echo "<li><b>Public Access:</b> Ensure the database has <b>Internet access</b> enabled.</li>";
        echo "<li><b>Format Check:</b> Sometimes Clever Cloud hostnames look like:</li>";
        echo "<ul>";
        echo "<li><code>" . htmlspecialchars($database) . "-mysql.services.clever-cloud.com</code> (Current)</li>";
        echo "<li><code>mysql-" . htmlspecialchars($database) . ".services.clever-cloud.com</code></li>";
        echo "<li><code>" . htmlspecialchars($database) . ".mysql.services.clever-cloud.com</code></li>";
        echo "</ul>";
        echo "</ul>";
    }
    echo "</div>";
} else {
    echo "<div style='background: #f0fff4; color: #276749; padding: 15px; border-radius: 8px; border: 1px solid #9ae6b4;'>";
    echo "<h3>✅ SUCCESS!</h3>";
    echo "Connected to the database successfully.";
    echo "</div>";

    echo "<h3>📊 Database Summary:</h3>";
    $result = $conn->query("SHOW TABLES");
    if ($result && $result->num_rows > 0) {
        echo "<b>Tables found:</b> " . $result->num_rows . "<ul>";
        while($row = $result->fetch_array()) {
            echo "<li>" . htmlspecialchars($row[0]) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color: #9c4221;'><b>Warning:</b> No tables found. You need to <b>Import</b> your SQL file in the Clever Cloud dashboard.</p>";
    }
}

echo "</body></html>";
?>
