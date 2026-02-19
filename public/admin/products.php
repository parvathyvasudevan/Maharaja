<?php include 'includes/header.php'; ?>
<?php
// Config
$config_path_local = __DIR__ . '/../config/database.php';
if (file_exists($config_path_local)) {
    require_once $config_path_local;
} else {
    require_once __DIR__ . '/../../config/database.php';
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    // Optional: Delete image file if exists
    mysqli_query($link, "DELETE FROM products WHERE id=$id");
    echo "<script>window.location.href='products.php';</script>";
}

// Fetch Products with Category Name
$sql = "SELECT p.*, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        ORDER BY p.created_at DESC";
$result = mysqli_query($link, $sql);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Products</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="product_form.php" class="btn btn-sm btn-primary">
            <i class="fas fa-plus me-2"></i>Add New Product
        </a>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th width="50">ID</th>
                <th width="80">Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)):
                    $img_src = !empty($row['image']) ? '../uploads/' . $row['image'] : 'https://placehold.co/50x50';
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['id']; ?>
                        </td>
                        <td><img src="<?php echo htmlspecialchars($img_src); ?>" width="50" height="50"
                                style="object-fit:cover;"></td>
                        <td>
                            <?php echo htmlspecialchars($row['title']); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($row['category_name'] ?? 'Uncategorized'); ?>
                        </td>
                        <td>
                            <?php echo number_format($row['price'], 2); ?> RON
                        </td>
                        <td>
                            <?php echo $row['stock']; ?>
                        </td>
                        <td>
                            <a href="product_form.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="products.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Delete this product?');">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>