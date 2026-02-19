<?php
require_once __DIR__ . '/_auth.php';
require_customer_login();

$customer_id = $_SESSION['customer_id'];
$orders = [];

$stmt = mysqli_prepare($link, "SELECT * FROM orders WHERE customer_id = ? ORDER BY created_at DESC");
mysqli_stmt_bind_param($stmt, 'i', $customer_id);
if (mysqli_stmt_execute($stmt)) {
    $res = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($res)) {
        $orders[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <style>
        body { font-family: sans-serif; background:#f4f4f4; margin:0; padding:40px; }
        .card { max-width:900px; margin:0 auto; background:#fff; padding:30px; border-radius:8px; box-shadow:0 0 5px rgba(0,0,0,0.1); }
        table { width:100%; border-collapse: collapse; }
        th, td { padding:12px; border-bottom:1px solid #ddd; text-align:left; }
        .btn { display:inline-block; margin-top:12px; background:#5B8A1D; color:#fff; padding:8px 12px; text-decoration:none; border-radius:4px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>My Orders</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['customer_name'] ?? ''); ?>.</p>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr><td colspan="5">No orders yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td>#<?php echo $order['id']; ?></td>
                            <td><?php echo number_format($order['total_amount'], 2); ?> RON</td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td><?php echo htmlspecialchars($order['payment_status']); ?></td>
                            <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <a class="btn" href="logout.php">Logout</a>
    </div>
</body>
</html>
