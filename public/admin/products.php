/**
 * Admin Product Management Listing
 * 
 * Path: public/admin/products.php
 * Part of: Maharaja Supermarket Administration
 */
require_admin_login();

// Database Connection
if (file_exists(__DIR__ . '/../../config/database.php')) {
    require_once __DIR__ . '/../../config/database.php';
} elseif (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
} else {
    die("Database configuration not found.");
}

$page_title = 'Manage Products';

// Handle Quick Updates (Stock & Active Status)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_stock'])) {
        $product_id = (int)$_POST['product_id'];
        $new_stock = (int)$_POST['stock'];
        $stmt = mysqli_prepare($link, "UPDATE products SET stock = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'ii', $new_stock, $product_id);
        mysqli_stmt_execute($stmt);
    }
    
    if (isset($_POST['toggle_active'])) {
        $product_id = (int)$_POST['product_id'];
        $current_status = (int)$_POST['current_status'];
        $new_status = $current_status ? 0 : 1;
        $stmt = mysqli_prepare($link, "UPDATE products SET is_active = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'ii', $new_status, $product_id);
        mysqli_stmt_execute($stmt);
    }
}

// Fetch Categories for display/filter
$categories = [];
$res = mysqli_query($link, "SELECT id, name_en FROM categories");
while ($row = mysqli_fetch_assoc($res)) {
    $categories[$row['id']] = $row['name_en'];
}

// Fetch All Products
$products = [];
$res = mysqli_query($link, "SELECT * FROM products ORDER BY created_at DESC");
while ($row = mysqli_fetch_assoc($res)) {
    $products[] = $row;
}

include 'includes/header.php';
?>

<?php if (isset($_GET['success'])): ?>
    <div style="background:#d1fae5; color:#065f46; padding:1rem; border-radius:8px; margin-bottom:1.5rem; font-weight:600;">
        <i class="fas fa-check-circle"></i> Product saved successfully!
    </div>
<?php endif; ?>

<?php if (isset($_GET['deleted'])): ?>
    <div style="background:#fee2e2; color:#991b1b; padding:1rem; border-radius:8px; margin-bottom:1.5rem; font-weight:600;">
        <i class="fas fa-trash"></i> Product deleted successfully.
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h3>Product Inventory</h3>
        <div style="display: flex; gap: 10px; align-items: center;">
             <span class="badge" style="background: #f3f4f6; color: #4b5563;"><?php echo count($products); ?> Products</span>
             <a href="product_form.php" class="btn-submit" style="padding: 6px 15px; font-size: 13px; text-decoration: none; background:var(--primary); color:#fff; border-radius:6px; font-weight:600;">+ Add New Product</a>
        </div>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Product Name (EN)</th>
                    <th>Category</th>
                    <th>Price Details</th>
                    <th>Stock</th>
                    <th>SKU</th>
                    <th>Visibility</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr><td colspan="9" style="text-align:center; padding: 3rem; color: #6b7280;">No products found in inventory.</td></tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td style="color: #6b7280;">#<?php echo $product['id']; ?></td>
                        <td>
                            <?php if ($product['image']): ?>
                                <img src="../uploads/<?php echo $product['image']; ?>" alt="" style="width: 48px; height: 48px; object-fit: cover; border-radius: 6px; border: 1px solid #eee;">
                            <?php else: ?>
                                <div style="width: 48px; height: 48px; background: #f3f4f6; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #9ca3af;">No Img</div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="font-weight: 600;"><?php echo htmlspecialchars($product['title_en']); ?></div>
                            <div style="font-size: 11px; color: #9ca3af;"><?php echo htmlspecialchars($product['title_ro']); ?></div>
                        </td>
                        <td><span style="font-size: 13px; color: #4b5563;"><?php echo $categories[$product['category_id']] ?? 'Uncategorized'; ?></span></td>
                        <td>
                            <div style="font-size: 14px; font-weight: 700;">
                                <?php if ($product['sale_price']): ?>
                                    <span style="color: #ef4444;"><?php echo number_format($product['sale_price'], 2); ?> <span style="font-size:10px;">RON</span></span>
                                    <div style="font-size: 11px; font-weight: 500; text-decoration: line-through; color: #9ca3af;"><?php echo number_format($product['price'], 2); ?> RON</div>
                                <?php else: ?>
                                    <span><?php echo number_format($product['price'], 2); ?> <span style="font-size:10px;">RON</span></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <form method="POST" style="display: flex; align-items: center; gap: 5px;">
                                <input type="number" name="stock" value="<?php echo $product['stock']; ?>" style="width: 55px; padding: 4px; border: 1px solid #d1d5db; border-radius: 4px; font-size: 13px; font-weight: 700;">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="hidden" name="update_stock" value="1">
                                <button type="submit" style="background: none; border: none; color: var(--primary); cursor: pointer;" title="Update Stock"><i class="fas fa-check-circle"></i></button>
                            </form>
                        </td>
                        <td style="font-family: monospace; font-size: 12px; color: #6b7280;"><?php echo $product['sku'] ?: '-'; ?></td>
                        <td>
                            <form method="POST" style="margin:0;">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="hidden" name="current_status" value="<?php echo $product['is_active']; ?>">
                                <input type="hidden" name="toggle_active" value="1">
                                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;">
                                    <?php if ($product['is_active']): ?>
                                        <span class="badge" style="background: #d1fae5; color: #065f46; display: flex; align-items: center; gap: 4px;">
                                            <i class="fas fa-eye" style="font-size:10px;"></i> Active
                                        </span>
                                    <?php else: ?>
                                        <span class="badge" style="background: #f3f4f6; color: #6b7280; display: flex; align-items: center; gap: 4px;">
                                            <i class="fas fa-eye-slash" style="font-size:10px;"></i> Inactive
                                        </span>
                                    <?php endif; ?>
                                </button>
                            </form>
                            <?php if ($product['stock'] <= 0): ?>
                                <div style="font-size: 10px; color: #ef4444; font-weight: 700; margin-top: 4px;">STOCK OUT</div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="display: flex; gap: 12px; font-size: 15px;">
                                <a href="product_form.php?id=<?php echo $product['id']; ?>" class="btn-view" title="Edit Product" style="color:var(--primary);"><i class="fas fa-edit"></i></a>
                                <a href="delete_product.php?id=<?php echo $product['id']; ?>" style="color: #ef4444;" title="Delete Product" onclick="return confirm('Are you sure you want to delete this product?')"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
