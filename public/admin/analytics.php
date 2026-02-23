<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();

// Database Connection
if (file_exists(__DIR__ . '/../../config/database.php')) {
    require_once __DIR__ . '/../../config/database.php';
}

$page_title = 'Sales Analytics';
include 'includes/header.php';
?>

<div class="card">
    <div class="card-header">
        <h3>Sales & Performance Analytics</h3>
    </div>
    <div style="padding: 3rem; text-align: center;">
        <i class="fas fa-chart-bar" style="font-size: 4rem; color: #e5e7eb; margin-bottom: 1.5rem;"></i>
        <h4 style="margin-bottom: 0.5rem;">Analytics Module Coming Soon</h4>
        <p style="color: #6b7280; max-width: 400px; margin: 0 auto;">We are currently integrating advanced charting libraries to provide detailed insights into your store's performance.</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
