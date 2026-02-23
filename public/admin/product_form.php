<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();

// Database Connection
if (file_exists(__DIR__ . '/../../config/database.php')) {
    require_once __DIR__ . '/../../config/database.php';
} elseif (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
} else {
    die("Database configuration not found.");
}

$success = '';
$error = '';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = [
    'title_en' => '', 'title_ro' => '', 
    'description_en' => '', 'description_ro' => '',
    'price' => 0, 'sale_price' => '', 
    'stock' => 0, 'category_id' => '', 
    'image' => '', 'sku' => '', 'is_active' => 1
];

if ($id > 0) {
    $page_title = 'Edit Product';
    $stmt = mysqli_prepare($link, "SELECT * FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($res)) {
        $product = $row;
    } else {
        header('Location: products.php');
        exit;
    }
} else {
    $page_title = 'Add New Product';
}

// Fetch categories
$categories = [];
$res = mysqli_query($link, "SELECT id, name_en FROM categories ORDER BY name_en ASC");
while ($row = mysqli_fetch_assoc($res)) {
    $categories[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title_en = $_POST['title_en'];
    $title_ro = $_POST['title_ro'];
    $desc_en = $_POST['description_en'];
    $desc_ro = $_POST['description_ro'];
    $price = $_POST['price'];
    $sale_price = $_POST['sale_price'] !== '' ? $_POST['sale_price'] : null;
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];
    $sku = $_POST['sku'];
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    
    $image_name = $product['image'];
    
    // Handle Image Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = __DIR__ . '/../uploads/';
        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);
        
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new_name = uniqid('prod_') . '.' . $ext;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $new_name)) {
            $image_name = $new_name;
        }
    }

    if ($id > 0) {
        $stmt = mysqli_prepare($link, "UPDATE products SET title_en=?, title_ro=?, description_en=?, description_ro=?, price=?, sale_price=?, stock=?, category_id=?, image=?, sku=?, is_active=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'ssssddisssii', $title_en, $title_ro, $desc_en, $desc_ro, $price, $sale_price, $stock, $category_id, $image_name, $sku, $is_active, $id);
    } else {
        $stmt = mysqli_prepare($link, "INSERT INTO products (title_en, title_ro, description_en, description_ro, price, sale_price, stock, category_id, image, sku, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssssddisssi', $title_en, $title_ro, $desc_en, $desc_ro, $price, $sale_price, $stock, $category_id, $image_name, $sku, $is_active);
    }

    if (mysqli_stmt_execute($stmt)) {
        header('Location: products.php?success=1');
        exit;
    } else {
        $error = "Database error: " . mysqli_error($link);
    }
}

include 'includes/header.php';
?>

<div style="max-width: 800px; margin: 0 auto;">
    <div class="card">
        <div class="card-header">
            <h3><?php echo $page_title; ?></h3>
            <a href="products.php" class="btn-view">Back to List</a>
        </div>
        <div style="padding: 2rem;">
            <?php if ($error): ?><div style="color:red; margin-bottom:1rem;"><?php echo $error; ?></div><?php endif; ?>
            
            <form method="POST" enctype="multipart/form-data" style="display: grid; gap: 1.5rem;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:0.5rem;">Title (English) *</label>
                        <input type="text" name="title_en" value="<?php echo htmlspecialchars($product['title_en']); ?>" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:0.5rem;" required>
                    </div>
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:0.5rem;">Title (Romanian) *</label>
                        <input type="text" name="title_ro" value="<?php echo htmlspecialchars($product['title_ro']); ?>" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:0.5rem;" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:0.5rem;">Description (English)</label>
                        <textarea name="description_en" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:0.5rem; height:100px;"><?php echo htmlspecialchars($product['description_en']); ?></textarea>
                    </div>
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:0.5rem;">Description (Romanian)</label>
                        <textarea name="description_ro" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:0.5rem; height:100px;"><?php echo htmlspecialchars($product['description_ro']); ?></textarea>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:0.5rem;">Price (RON) *</label>
                        <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:0.5rem;" required>
                    </div>
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:0.5rem;">Sale Price (RON)</label>
                        <input type="number" step="0.01" name="sale_price" value="<?php echo $product['sale_price']; ?>" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:0.5rem;">
                    </div>
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:0.5rem;">Stock *</label>
                        <input type="number" name="stock" value="<?php echo $product['stock']; ?>" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:0.5rem;" required>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:0.5rem;">Category *</label>
                        <select name="category_id" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:0.5rem;" required>
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo $product['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name_en']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-weight:600; margin-bottom:0.5rem;">SKU</label>
                        <input type="text" name="sku" value="<?php echo htmlspecialchars($product['sku']); ?>" style="width:100%; padding:0.75rem; border:1px solid #d1d5db; border-radius:0.5rem;">
                    </div>
                </div>

                <div>
                    <label style="display:block; font-weight:600; margin-bottom:0.5rem;">Product Image</label>
                    <?php if ($product['image']): ?>
                        <div style="margin-bottom:1rem;">
                            <img src="../uploads/<?php echo $product['image']; ?>" style="width:100px; border-radius:8px; border:1px solid #eee;">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="image" accept="image/*" style="width:100%; padding:0.5rem; border:1px solid #d1d5db; border-radius:0.5rem; background:#f9fafb;">
                </div>

                <div style="display:flex; align-items:center; gap:0.5rem;">
                    <input type="checkbox" name="is_active" id="is_active" <?php echo $product['is_active'] ? 'checked' : ''; ?> style="width:20px; height:20px;">
                    <label for="is_active" style="font-weight:600;">Show product on storefront (Active)</label>
                </div>

                <div style="margin-top:1rem;">
                    <button type="submit" style="background:var(--primary); color:#fff; padding:1rem 2rem; border:none; border-radius:0.5rem; font-size:1rem; font-weight:700; cursor:pointer; width:100%;">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
