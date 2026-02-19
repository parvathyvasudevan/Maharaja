<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";

if (!isset($_GET['id'])) {
    header("Location: orders.php");
    exit;
}

$id = intval($_GET['id']);

// Update Status Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status'])) {
    $new_status = mysqli_real_escape_string($link, $_POST['status']);
    $sql_update = "UPDATE orders SET status = '$new_status' WHERE id = $id";
    mysqli_query($link, $sql_update);
}

// Fetch Order
$sql_order = "SELECT * FROM orders WHERE id = $id";
$result_order = mysqli_query($link, $sql_order);
$order = mysqli_fetch_assoc($result_order);

// Fetch Items
$sql_items = "SELECT oi.*, p.title, p.image FROM order_items oi LEFT JOIN products p ON oi.product_id = p.id WHERE oi.order_id = $id";
$result_items = mysqli_query($link, $sql_items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details #
        <?php echo $id; ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Order details #
                <?php echo $id; ?>
            </h2>
            <a href="orders.php" class="btn btn-secondary">Back to Orders</a>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Customer Info</div>
                    <div class="card-body">
                        <p><strong>Name:</strong>
                            <?php echo htmlspecialchars($order['customer_name']); ?>
                        </p>
                        <p><strong>Email:</strong>
                            <?php echo htmlspecialchars($order['customer_email']); ?>
                        </p>
                        <p><strong>Phone:</strong>
                            <?php echo htmlspecialchars($order['customer_phone']); ?>
                        </p>
                        <p><strong>Address:</strong>
                            <?php echo nl2br(htmlspecialchars($order['customer_address'])); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Order Info</div>
                    <div class="card-body">
                        <p><strong>Date:</strong>
                            <?php echo $order['created_at']; ?>
                        </p>
                        <p><strong>Total Amount:</strong>
                            <?php echo number_format($order['total_amount'], 2); ?> RON
                        </p>
                        <p><strong>Payment:</strong>
                            <?php echo htmlspecialchars($order['payment_method']); ?> /
                            <?php echo htmlspecialchars($order['payment_status']); ?>
                        </p>
                        <p><strong>Status:</strong>
                            <span class="badge bg-<?php echo $order['status'] == 'pending' ? 'warning' : 'success'; ?>">
                                <?php echo $order['status']; ?>
                            </span>
                        </p>

                        <form method="post" class="mt-3">
                            <label>Update Status:</label>
                            <select name="status" class="form-select w-auto d-inline-block">
                                <option value="pending" <?php if ($order['status'] == 'pending')
                                    echo 'selected'; ?>
                                    >Pending</option>
                                <option value="processing" <?php if ($order['status'] == 'processing')
                                    echo 'selected'; ?>>Processing</option>
                                <option value="completed" <?php if ($order['status'] == 'completed')
                                    echo 'selected'; ?>
                                    >Completed</option>
                                <option value="cancelled" <?php if ($order['status'] == 'cancelled')
                                    echo 'selected'; ?>
                                    >Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <h4>Order Items</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = mysqli_fetch_assoc($result_items)):
                    $subtotal = $item['line_total'] ?? ($item['price'] * $item['quantity']);
                    $img_src = $item['image'] ? "/uploads/products/" . $item['image'] : "https://placehold.co/50x50";
                    ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($item['title']); ?>
                        </td>
                        <td><img src="<?php echo $img_src; ?>" width="50"></td>
                        <td>
                            <?php echo $item['price']; ?> RON
                        </td>
                        <td>
                            <?php echo $item['quantity']; ?>
                        </td>
                        <td>
                            <?php echo $subtotal; ?> RON
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
