<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";

$id = $title = $description = $price = $stock = $image = "";
$category_id = null;

$categories = [];
$cat_result = mysqli_query($link, "SELECT id, name FROM categories ORDER BY name ASC");
if ($cat_result) {
    while ($row = mysqli_fetch_assoc($cat_result)) {
        $categories[] = $row;
    }
}

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $id = trim($_GET["id"]);
    $sql = "SELECT * FROM products WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $title = $row["title"];
                $description = $row["description"];
                $price = $row["price"];
                $stock = $row["stock"];
                $image = $row["image"];
                $category_id = $row["category_id"];
            } else {
                header("location: products.php");
                exit;
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $category_id = !empty($_POST["category_id"]) ? intval($_POST["category_id"]) : null;

    // Check for new image
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir_server = __DIR__ . "/../uploads/products/";
        $target_dir_local = __DIR__ . "/../public/uploads/products/";

        if (is_dir($target_dir_server)) {
            $target_dir = $target_dir_server;
        } elseif (is_dir($target_dir_local)) {
            $target_dir = $target_dir_local;
        } else {
            $target_dir = $target_dir_server;
             if (!file_exists($target_dir)) {
                 mkdir($target_dir, 0777, true);
             }
        }

        $file_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $file_name;
            // Query with updating image
            $sql = "UPDATE products SET category_id=?, title=?, description=?, price=?, stock=?, image=? WHERE id=?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "issdisi", $category_id, $title, $description, $price, $stock, $image, $id);
        }
    } else {
        // Query WITHOUT updating image
        $sql = "UPDATE products SET category_id=?, title=?, description=?, price=?, stock=? WHERE id=?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "issdii", $category_id, $title, $description, $price, $stock, $id);
    }

    if (mysqli_stmt_execute($stmt)) {
        header("location: products.php");
    } else {
        echo "Error updating record: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product - Maharaja Admin</title>
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
        <h2>Edit Product</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label>Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>" required>

            <label>Description</label>
            <textarea name="description" rows="4"><?php echo htmlspecialchars($description); ?></textarea>

            <label>Category</label>
            <select name="category_id">
                <option value="">Uncategorized</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php if ($category_id == $cat['id'])
                           echo 'selected'; ?>>
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Price (RON)</label>
            <input type="number" name="price" step="0.01" value="<?php echo $price; ?>" required>

            <label>Stock</label>
            <input type="number" name="stock" value="<?php echo $stock; ?>" required>

            <label>Current Image</label>
            <?php if ($image): ?>
                <img src="/uploads/products/<?php echo $image; ?>" width="100">
            <?php else: ?>
                <p>No image</p>
            <?php endif; ?>

            <label>Change Image (Leave blank to keep current)</label>
            <input type="file" name="image">

            <button type="submit" class="btn">Update Product</button>
        </form>
    </div>
</body>

</html>