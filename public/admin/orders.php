<?php include 'includes/header.php'; ?>
<?php
// Config
$config_path_local = __DIR__ . '/../config/database.php';
if (file_exists($config_path_local)) {
    require_once $config_path_local;
} else {
    require_once __DIR__ . '/../../config/database.php';
}

// Fetch Orders
$sql = "SELECT * FROM orders ORDER BY created_at DESC";
// If orders table has customer data, great. If not, might need joins.
// Assuming orders table structure: id, user_id (optional), name, total, status, created_at
$result = mysqli_query($link, $sql);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Orders</h1>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>#
                            <?php echo $row['id']; ?>
                        </td>
                        <td>
                            <?php
                            // Display name if available, else user ID
                            echo !empty($row['name']) ? htmlspecialchars($row['name']) : 'User #' . $row['user_id'];
                            ?>
                        </td>
                        <td>
                            <?php echo date('M d, Y', strtotime($row['created_at'])); ?>
                        </td>
                        <td>
                            <?php echo number_format($row['total_amount'], 2); ?> RON
                        </td>
                        <td>
                            <?php
                            $status = ucfirst($row['status']);
                            $badgeClass = 'bg-secondary';
                            if ($status == 'Completed')
                                $badgeClass = 'bg-success';
                            if ($status == 'Pending')
                                $badgeClass = 'bg-warning text-dark';
                            if ($status == 'Cancelled')
                                $badgeClass = 'bg-danger';
                            ?>
                            <span class="badge <?php echo $badgeClass; ?>">
                                <?php echo $status; ?>
                            </span>
                        </td>
                        <td>
                            <a href="order_view.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary">
                                View Details
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>