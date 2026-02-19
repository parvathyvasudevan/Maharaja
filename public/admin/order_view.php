<?php include 'includes/header.php'; ?>
<?php
// Config
$config_path_local = __DIR__ . '/../config/database.php';
if (file_exists($config_path_local)) {
    require_once $config_path_local;
} else {
    require_once __DIR__ . '/../../config/database.php';
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) {
    echo "<script>window.location.href='orders.php';</script>";
    exit;
}

// Update Status
if (isset($_POST['update_status'])) {
    $new_status = mysqli_real_escape_string($link, $_POST['status']);
    mysqli_query($link, "UPDATE orders SET status='$new_status' WHERE id=$id");
    echo "<div class='alert alert-success m-3'>Order status updated!</div>";
}

// Fetch Order
$order_res = mysqli_query($link, "SELECT * FROM orders WHERE id=$id");
$order = mysqli_fetch_assoc($order_res);

// Fetch Items
$items_res = mysqli_query($link, "SELECT oi.*, p.title, p.image 
                                  FROM order_items oi 
                                  LEFT JOIN products p ON oi.product_id = p.id 
                                  WHERE oi.order_id=$id");

?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Order #
        <?php echo $order['id']; ?>
    </h1>
    <a href="orders.php" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-box me-1"></i> Order Items
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($item = mysqli_fetch_assoc($items_res)): ?>
                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($item['title'] ?? 'Product Removed'); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo number_format($item['price'], 2); ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $item['quantity']; ?>
                                </td>
                                <td class="text-end">
                                    <?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total Amount:</th>
                            <th class="text-end">
                                <?php echo number_format($order['total_amount'], 2); ?> RON
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header text-white bg-info">
                <i class="fas fa-user me-1"></i> Customer Details
            </div>
            <div class="card-body">
                <p><strong>Name:</strong>
                    <?php echo htmlspecialchars($order['name'] ?? 'Guest'); ?>
                </p>
                <p><strong>Email:</strong>
                    <?php echo htmlspecialchars($order['email'] ?? 'N/A'); ?>
                </p>
                <p><strong>Phone:</strong>
                    <?php echo htmlspecialchars($order['phone'] ?? 'N/A'); ?>
                </p>
                <p><strong>Address:</strong><br>
                    <?php echo nl2br(htmlspecialchars($order['address'] ?? 'N/A')); ?>
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-cog me-1"></i> Order Actions
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Update Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>
                                >Pending</option>
                            <option value="processing" <?php echo $order['status'] == 'processing' ? 'selected' : ''; ?>
                                >Processing</option>
                            <option value="completed" <?php echo $order['status'] == 'completed' ? 'selected' : ''; ?>
                                >Completed</option>
                            <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>
                                >Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" name="update_status" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>