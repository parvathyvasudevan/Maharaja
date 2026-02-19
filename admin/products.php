<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";

// Fetch products
$sql = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products - Maharaja Admin</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #f4f4f4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #5B8A1D;
            color: white;
        }

        .btn {
            padding: 8px 15px;
            background: #5B8A1D;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-danger {
            background: #e74c3c;
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
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Products</h2>
            <a href="product_add.php" class="btn">Add New Product</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        $img = $row['image'] ? "/uploads/products/" . $row['image'] : "placeholder.png";
                        echo "<td><img src='" . $img . "' width='50'></td>";
                        echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['category_name'] ?? '') . "</td>";
                        echo "<td>" . $row['price'] . " RON</td>";
                        echo "<td>" . $row['stock'] . "</td>";
                        echo "<td>";
                        echo "<a href='product_edit.php?id=" . $row['id'] . "' class='btn'>Edit</a> ";
                        echo "<a href='product_delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No products found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
