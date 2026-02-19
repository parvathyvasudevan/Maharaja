<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";

$stats = [
    'total_orders' => 0,
    'pending_orders' => 0,
    'total_sales' => 0.0,
    'monthly_sales' => 0.0,
];

$stats_sql = "SELECT\n    COUNT(*) AS total_orders,\n    SUM(CASE WHEN status IN ('pending','processing') THEN 1 ELSE 0 END) AS pending_orders,\n    SUM(CASE WHEN payment_status = 'paid' THEN total_amount ELSE 0 END) AS total_sales,\n    SUM(CASE WHEN payment_status = 'paid' AND YEAR(created_at)=YEAR(CURRENT_DATE()) AND MONTH(created_at)=MONTH(CURRENT_DATE()) THEN total_amount ELSE 0 END) AS monthly_sales\nFROM orders";

if ($result = mysqli_query($link, $stats_sql)) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $stats['total_orders'] = (int)$row['total_orders'];
        $stats['pending_orders'] = (int)$row['pending_orders'];
        $stats['total_sales'] = (float)$row['total_sales'];
        $stats['monthly_sales'] = (float)$row['monthly_sales'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Maharaja Supermarket</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            display: flex;
            background-color: #f4f4f4;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            color: #5B8A1D;
            text-align: center;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
        }

        .card {
            background: white;
            padding: 18px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 16px;
            color: #2c3e50;
        }

        .card .value {
            font-size: 26px;
            font-weight: bold;
            color: #5B8A1D;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Maharaja Admin</h2>
        <a href="index.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="categories.php">Categories</a>
        <a href="orders.php">Orders</a>
        <a href="discounts.php">Discounts</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
        <p>Here is a quick view of store performance.</p>

        <div class="cards">
            <div class="card">
                <h3>Total Orders</h3>
                <div class="value"><?php echo number_format($stats['total_orders']); ?></div>
            </div>
            <div class="card">
                <h3>Pending Orders</h3>
                <div class="value"><?php echo number_format($stats['pending_orders']); ?></div>
            </div>
            <div class="card">
                <h3>Total Sales (Paid)</h3>
                <div class="value"><?php echo number_format($stats['total_sales'], 2); ?> RON</div>
            </div>
            <div class="card">
                <h3>Sales This Month</h3>
                <div class="value"><?php echo number_format($stats['monthly_sales'], 2); ?> RON</div>
            </div>
        </div>
    </div>
</body>

</html>
