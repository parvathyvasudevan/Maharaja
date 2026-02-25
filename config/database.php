<?php
// Database configuration - Support both custom and native Clever Cloud keys
$host = getenv('DB_SERVER') ?: getenv('MYSQL_ADDON_HOST') ?: "localhost";
$user = getenv('DB_USERNAME') ?: getenv('MYSQL_ADDON_USER') ?: "root";
$password = getenv('DB_PASSWORD') ?: getenv('MYSQL_ADDON_PASSWORD') ?: "";
$database = getenv('DB_NAME') ?: getenv('MYSQL_ADDON_DB') ?: "maharaja_db";
$port = getenv('DB_PORT') ?: getenv('MYSQL_ADDON_PORT') ?: 3306;

define('DB_SERVER', $host);
define('DB_USERNAME', $user);
define('DB_PASSWORD', $password);
define('DB_NAME', $database);

/* Attempt to connect to MySQL database */
$link = null;
$conn = null;
$db_connection_error = null;

try {
    mysqli_report(MYSQLI_REPORT_OFF); // Turn off strict reporting to handle errors manually if needed
    $link = mysqli_connect($host, $user, $password, $database, (int)$port);
    $conn = $link; // For compatibility
    if ($link) {
        mysqli_set_charset($link, 'utf8mb4');
    }
} catch (Exception $e) {
    $db_connection_error = $e->getMessage();
}

if (!$link) {
    error_log("Database connection error: " . ($db_connection_error ?: mysqli_connect_error()));
    
    // If on Render, we must show a clear message instead of crashing later
    if (getenv('RENDER')) {
        ?>
        <div style="background: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 20px; margin: 20px; border-radius: 8px; font-family: sans-serif;">
            <h3 style="margin-top: 0;">🚧 Database Connection Issue</h3>
            <p>The application could not connect to the database. This is usually due to missing or incorrect Environment Variables.</p>
            <p><strong>Error:</strong> <?php echo htmlspecialchars($db_connection_error ?: mysqli_connect_error()); ?></p>
            
            <?php if ($host === 'localhost' || $host === '127.0.0.1'): ?>
            <div style="background: #fffbeb; border: 1px solid #fef3c7; color: #92400e; padding: 12px; border-radius: 4px; margin: 15px 0;">
                ⚠️ <strong>Note:</strong> Your Host is currently set to <code>localhost</code>. This only works on your own computer. On Render, you must use the <strong>Host</strong> address from your Clever Cloud dashboard.
            </div>
            <?php endif; ?>

            <hr style="border: 0; border-top: 1px solid #fecaca; margin: 15px 0;">
            <p><strong>Action Required:</strong> Go to your <strong>Render Dashboard</strong> > <strong>Environment Variables</strong> and ensure the following are set:</p>
            <ul style="margin-bottom: 0;">
                <li><code>DB_SERVER</code> (Host)</li>
                <li><code>DB_NAME</code> (Database Name)</li>
                <li><code>DB_USERNAME</code> (User)</li>
                <li><code>DB_PASSWORD</code> (Password)</li>
            </ul>
        </div>
        <?php
        // We initialize $link to a dummy object or handle it in index.php
        // For now, let's at least avoid the fatal error by making it an object that fails silently if possible,
        // but die() is safer for preventing data-dependent crashes.
        die(); 
    }
}
?>
?>