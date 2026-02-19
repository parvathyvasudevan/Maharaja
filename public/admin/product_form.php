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
$product = [
    'title' => '',
    'description' => '',
    'price' => '',
    'category_id' => '',
    'stock' => 0,
    'sku' => '',
    'image' => ''
];
$is_edit = false;

// Fetch if edit
if ($id > 0) {
    $res = mysqli_query($link, "SELECT * FROM products WHERE id=$id");
    if ($res && mysqli_num_rows($res) > 0) {
        $product = mysqli_fetch_assoc($res);
        $is_edit = true;
    }
}

// Fetch Categories
$cats = mysqli_query($link, "SELECT * FROM categories ORDER BY name ASC");

// Handle Submit
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $category_id = intval($_POST['category_id']);
    $sku = mysqli_real_escape_string($link, $_POST['sku']);

    // Image Upload
    $image_sql = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $upload_dir = __DIR__ . '/../uploads/';
        if (!is_dir($upload_dir))
            mkdir($upload_dir, 0777, true);

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $upload_dir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image_sql = ", image='$fileName'";
            // Update current product array for display
            $product['image'] = $fileName;
        } else {
            $error = "Failed to upload image.";
        }
    }

    if (empty($error)) {
        if ($is_edit) {
            $sql = "UPDATE products SET 
                    title='$title', 
                    description='$description', 
                    price='$price', 
                    stock='$stock',
                    category_id='$category_id',
                    sku='$sku'
                    $image_sql
                    WHERE id=$id";
        } else {
            $img_val = isset($product['image']) && !empty($product['image']) ? $product['image'] : ''; // In create mode, only set if uploaded above
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $img_val = $fileName;
            }

            $sql = "INSERT INTO products (title, description, price, stock, category_id, sku, image) 
                    VALUES ('$title', '$description', '$price', '$stock', '$category_id', '$sku', '$img_val')";
        }

        if (mysqli_query($link, $sql)) {
            $success = "Product saved successfully!";
            if (!$is_edit) {
                // Redirect to list or stay to add more? Stay for now with success message or clear?
                // Redirecting to list is standard.
                echo "<script>window.location.href='products.php';</script>";
                exit;
            }
        } else {
            $error = "Database Error: " . mysqli_error($link);
        }
    }
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <?php echo $is_edit ? 'Edit Product' : 'Add New Product'; ?>
    </h1>
    <a href="products.php" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to List
    </a>
</div>

<?php if ($error): ?>
    <div class="alert alert-danger">
        <?php echo $error; ?>
    </div>
<?php endif; ?>
<?php if ($success): ?>
    <div class="alert alert-success">
        <?php echo $success; ?>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Product Title</label>
                        <input type="text" name="title" class="form-control"
                            value="<?php echo htmlspecialchars($product['title']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"
                            rows="5"><?php echo htmlspecialchars($product['description']); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Price (RON)</label>
                            <input type="number" step="0.01" name="price" class="form-control"
                                value="<?php echo $product['price']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control"
                                value="<?php echo $product['stock']; ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">SKU (Optional)</label>
                            <input type="text" name="sku" class="form-control"
                                value="<?php echo htmlspecialchars($product['sku']); ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            <?php while ($c = mysqli_fetch_assoc($cats)): ?>
                                <option value="<?php echo $c['id']; ?>" <?php echo $product['category_id'] == $c['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($c['name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <?php if (!empty($product['image'])): ?>
                            <div class="mt-2">
                                <small>Current Image:</small><br>
                                <img src="../uploads/<?php echo $product['image']; ?>" class="img-thumbnail"
                                    style="max-height: 150px;">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary px-4">Save Product</button>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>