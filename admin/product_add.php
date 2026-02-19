<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";
$categories = [];
$cat_result = mysqli_query($link, "SELECT id, name FROM categories ORDER BY name ASC");
if ($cat_result) {
    while ($row = mysqli_fetch_assoc($cat_result)) {
        $categories[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Product - Maharaja Admin</title>
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

        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn {
            padding: 10px 20px;
            background: #5B8A1D;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
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
        <h2>Add New Product</h2>
        <form action="product_save.php" method="post" enctype="multipart/form-data">
            <label>Title</label>
            <input type="text" name="title" required>

            <label>Description</label>
            <textarea name="description" rows="4"></textarea>

            <label>Category</label>
            <select name="category_id">
                <option value="">Uncategorized</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                <?php endforeach; ?>
            </select>

            <label>Price (RON)</label>
            <input type="number" name="price" step="0.01" required>

            <label>Stock</label>
            <input type="number" name="stock" value="100" required>

            <label>Image</label>
            <input type="file" name="image">

            <button type="submit" class="btn">Save Product</button>
        </form>
    </div>
</body>

</html>
