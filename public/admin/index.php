<?php include 'includes/header.php'; ?>
<?php
// Config
$config_path_local = __DIR__ . '/../config/database.php';
if (file_exists($config_path_local)) {
    require_once $config_path_local;
} else {
    require_once __DIR__ . '/../../config/database.php';
}

// Fetch Stats
$product_count = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as count FROM products"))['count'];
$order_count_res = mysqli_query($link, "SELECT COUNT(*) as count FROM orders");
$order_count = $order_count_res ? mysqli_fetch_assoc($order_count_res)['count'] : 0;
// Assuming we have orders table. If not, 0.

// Recent products
$recent_products = mysqli_query($link, "SELECT * FROM products ORDER BY created_at DESC LIMIT 5");
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card card-stats bg-primary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Products</h6>
                        <h2 class="mb-0">
                            <?php echo $product_count; ?>
                        </h2>
                    </div>
                    <div>
                        <i class="fas fa-box fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between border-0 bg-primary-subtle">
                <a href="products.php" class="text-white text-decoration-none stretched-link">View All</a>
                <i class="fas fa-angle-right text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card card-stats bg-success text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Total Orders</h6>
                        <h2 class="mb-0">
                            <?php echo $order_count; ?>
                        </h2>
                    </div>
                    <div>
                        <i class="fas fa-shopping-cart fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between border-0 bg-success-subtle">
                <a href="orders.php" class="text-white text-decoration-none stretched-link">View Orders</a>
                <i class="fas fa-angle-right text-white"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card card-stats bg-warning text-dark h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Quick Actions</h6>
                        <div class="d-grid gap-2 mt-2">
                            <a href="product_form.php" class="btn btn-light btn-sm">Add New Product</a>
                        </div>
                    </div>
                    <div>
                        <i class="fas fa-bolt fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h3 class="mt-4">Recently Added Products</h3>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($recent_products && mysqli_num_rows($recent_products) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($recent_products)):
                    $img_src = !empty($row['image']) ? '../uploads/' . $row['image'] : 'https://placehold.co/50x50';
                    ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($img_src); ?>" alt="img" width="50" height="50"
                                style="object-fit:cover;"></td>
                        <td>
                            <?php echo htmlspecialchars($row['title']); ?>
                        </td>
                        <td>
                            <?php echo number_format($row['price'], 2); ?> RON
                        </td>
                        <td>
                            <?php
                            // Quick category lookup directly or join in query
                            // For simplicity in dashboard, showing ID or assuming fetch
                            echo $row['category_id'];
                            ?>
                        </td>
                        <td>
                            <a href="product_form.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>