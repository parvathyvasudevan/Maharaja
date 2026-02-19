<?php
session_start();
ini_set('display_errors', 1); // Debugging
error_reporting(E_ALL);

// Determine config path
$config_path_local = __DIR__ . '/config/database.php';
if (file_exists($config_path_local)) {
    require_once $config_path_local;
} else {
    require_once __DIR__ . '/../config/database.php';
}

$category = isset($_GET['category']) ? mysqli_real_escape_string($link, $_GET['category']) : '';

// Build Query
$sql = "SELECT p.*, c.slug as category_slug, c.name as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE 1=1";

if ($category && $category != 'shop-all') {
    $category_safe = mysqli_real_escape_string($link, $category);
    $sql .= " AND (c.slug LIKE '%$category_safe%' OR p.title LIKE '%$category_safe%')";
}
$sql .= " ORDER BY p.created_at DESC";

$result = mysqli_query($link, $sql);
?>
<?php include 'includes/header.php'; ?>

<div class="shop-page-wrapper" style="padding: 40px 0; background-color: #f9f9f9;">
    <div class="container">
        <div class="section-header text-center mb-5" style="margin-bottom: 30px;">
            <h1 class="section-title">
                <?php echo $category ? 'Category: ' . htmlspecialchars($category) : 'All Products'; ?>
            </h1>
            <p>Browse our wide range of authentic products</p>
        </div>

        <div class="row">
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)):
                    $image_path = !empty($row['image']) ? 'uploads/' . $row['image'] : 'https://placehold.co/600x600?text=No+Image';
                    // Clean up image path if needed (e.g. if absolute vs relative)
                    // Assuming uploads/ is in public/
                    ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="product-card"
                            style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); transition: transform 0.3s; height: 100%; display: flex; flex-direction: column;">
                            <a href="product.php?id=<?php echo $row['id']; ?>" class="product-img-link"
                                style="display: block; position: relative; padding-top: 100%;">
                                <img src="<?php echo htmlspecialchars($image_path); ?>"
                                    alt="<?php echo htmlspecialchars($row['title']); ?>"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; padding: 20px;">
                            </a>
                            <div class="product-info"
                                style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>
                                    <h3 class="product-title" style="font-size: 16px; font-weight: 600; margin-bottom: 10px;">
                                        <a href="product.php?id=<?php echo $row['id']; ?>"
                                            style="color: #333; text-decoration: none;"><?php echo htmlspecialchars($row['title']); ?></a>
                                    </h3>
                                    <div class="product-price"
                                        style="color: #6ea622; font-weight: 700; font-size: 18px; margin-bottom: 15px;">
                                        <?php echo number_format($row['price'], 2); ?> RON
                                    </div>
                                </div>
                                <form method="post" action="cart_add.php">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn--primary"
                                        style="width: 100%; justify-content: center;">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p>No products found matching your criteria. <a href="shop.php">View all products</a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>