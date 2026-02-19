<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";

$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Orders</h2>
            <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?php echo $row['id']; ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['customer_name']); ?>
                        </td>
                        <td>
                            <?php echo $row['total_amount']; ?> RON
                        </td>
                        <td>
                            <span class="badge bg-<?php echo $row['status'] == 'pending' ? 'warning' : 'success'; ?>">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo $row['payment_status'] == 'paid' ? 'success' : 'secondary'; ?>">
                                <?php echo $row['payment_status']; ?>
                            </span>
                        </td>
                        <td>
                            <?php echo $row['created_at']; ?>
                        </td>
                        <td>
                            <a href="order_details.php?id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
