<?php
// public/db.php - Redirecting to the standardized includes/db.php
require_once __DIR__ . '/../config/database.php';
// This ensures that any file in public/ that does 'require db.php' 
// uses the correct environment-based connection.
?>
