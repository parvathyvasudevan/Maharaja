/**
 * Admin Dashboard Overview
 * 
 * Path: public/admin/index.php
 * Part of: Maharaja Supermarket Administration
 */
require_admin_login();

// Database Connection
if (file_exists(__DIR__ . '/../../config/database.php')) {
    require_once __DIR__ . '/../../config/database.php';
} elseif (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
} else {
    die("Database configuration not found.");
}

$page_title = 'Dashboard Overview';

// --- Analytics Calculations ---

// 1. Orders Stats
$stats = [
    'today' => ['orders' => 0, 'revenue' => 0],
    'week' => ['orders' => 0, 'revenue' => 0],
    'month' => ['orders' => 0, 'revenue' => 0]
];

// Today
$res = mysqli_query($link, "SELECT COUNT(id) as cnt, SUM(total_amount) as rev FROM orders WHERE DATE(created_at) = CURDATE() AND status != 'cancelled'");
$row = mysqli_fetch_assoc($res);
$stats['today']['orders'] = $row['cnt'] ?? 0;
$stats['today']['revenue'] = $row['rev'] ?? 0;

// This Week
$res = mysqli_query($link, "SELECT COUNT(id) as cnt, SUM(total_amount) as rev FROM orders WHERE YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1) AND status != 'cancelled'");
$row = mysqli_fetch_assoc($res);
$stats['week']['orders'] = $row['cnt'] ?? 0;
$stats['week']['revenue'] = $row['rev'] ?? 0;

// This Month
$res = mysqli_query($link, "SELECT COUNT(id) as cnt, SUM(total_amount) as rev FROM orders WHERE MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) AND status != 'cancelled'");
$row = mysqli_fetch_assoc($res);
$stats['month']['orders'] = $row['cnt'] ?? 0;
$stats['month']['revenue'] = $row['rev'] ?? 0;

// 2. Low Stock Alerts (Stock < 5)
$low_stock_items = [];
$res = mysqli_query($link, "SELECT id, title_en, stock FROM products WHERE stock < 5 ORDER BY stock ASC LIMIT 10");
while ($row = mysqli_fetch_assoc($res)) {
    $low_stock_items[] = $row;
}

// 3. Recent Orders
$recent_orders = [];
$res = mysqli_query($link, "SELECT * FROM orders ORDER BY created_at DESC LIMIT 10");
while ($row = mysqli_fetch_assoc($res)) {
    $recent_orders[] = $row;
}

include 'includes/header.php';
?>

<div class="stats-grid">
    <div class="stat-card">
        <div class="label">Today's Orders</div>
        <div class="value"><?php echo $stats['today']['orders']; ?></div>
        <div class="trend up"><i class="fas fa-chart-line"></i> Today</div>
    </div>
    <div class="stat-card">
        <div class="label">Today's Revenue</div>
        <div class="value"><?php echo number_format($stats['today']['revenue'], 2); ?> <span style="font-size: 14px;">RON</span></div>
        <div class="trend up"><i class="fas fa-coins"></i> Today</div>
    </div>
    <div class="stat-card">
        <div class="label">This Week</div>
        <div class="value"><?php echo $stats['week']['orders']; ?> <span style="font-size: 14px; color: #6b7280; font-weight: 500;">Orders</span></div>
        <div class="trend up"><i class="fas fa-calendar-week"></i> 7 Days</div>
    </div>
    <div class="stat-card">
        <div class="label">This Month</div>
        <div class="value"><?php echo number_format($stats['month']['revenue'], 2); ?> <span style="font-size: 14px;">RON</span></div>
        <div class="trend up"><i class="fas fa-calendar-alt"></i> 30 Days</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
    <!-- Recent Orders -->
    <div class="card">
        <div class="card-header">
            <h3>Recent Orders</h3>
            <a href="#" class="btn-view">View All</a>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recent_orders)): ?>
                        <tr><td colspan="5" style="text-align:center;">No orders found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($recent_orders as $order): ?>
                        <tr>
                            <td><strong>#<?php echo $order['id']; ?></strong></td>
                            <td><?php echo htmlspecialchars($order['name']); ?></td>
                            <td><?php echo number_format($order['total_amount'], 2); ?> RON</td>
                            <td>
                                <span class="badge badge-<?php echo strtolower($order['status']); ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('d M, H:i', strtotime($order['created_at'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Low Stock Alerts -->
    <div class="card">
        <div class="card-header">
            <h3>Low Stock Alerts</h3>
            <span class="badge badge-low-stock"><?php echo count($low_stock_items); ?> Items</span>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($low_stock_items)): ?>
                        <tr><td colspan="2" style="text-align:center; padding: 2rem; color: #6b7280;">Inventory is healthy.</td></tr>
                    <?php else: ?>
                        <?php foreach ($low_stock_items as $item): ?>
                        <tr>
                            <td style="font-weight: 500;"><?php echo htmlspecialchars($item['title_en']); ?></td>
                            <td><span style="color: #ef4444; font-weight: 700;"><?php echo $item['stock']; ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
