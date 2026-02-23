/**
 * Shop Listing Page
 * 
 * Path: public/shop.php
 * Part of: Maharaja Supermarket
 */
require_once __DIR__ . '/../includes/init_lang.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$category_slug = isset($_GET['category']) ? $_GET['category'] : '';
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';

// 1. Fetch Categories for dynamic filtering (if needed)
$cat_stmt = $pdo->query("SELECT * FROM categories");
$categories = $cat_stmt->fetchAll();

// 2. Build Query for Products
$title_col = get_col('title');
$desc_col = get_col('description');
$cat_name_col = get_col('name');

$sql = "SELECT p.*, c.slug as category_slug, c.{$cat_name_col} as category_name 
        FROM products p 
        LEFT JOIN categories c ON p.category_id = c.id 
        WHERE p.is_active = 1";

$params = [];
if ($category_slug && $category_slug != 'shop-all') {
    $sql .= " AND (c.slug = ? OR p.{$title_col} LIKE ?)";
    $params[] = $category_slug;
    $params[] = "%$category_slug%";
}

if ($search_query !== '') {
    $sql .= " AND (p.{$title_col} LIKE ? OR p.{$desc_col} LIKE ?)";
    $params[] = "%$search_query%";
    $params[] = "%$search_query%";
}

$sql .= " ORDER BY p.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

// Get the display name for the current category filter
$current_category_name = $lang['all_products'];
if ($search_query !== '') {
    $current_category_name = ($lang['search_results'] ?? 'Search Results for:') . ' ' . htmlspecialchars($search_query);
} elseif ($category_slug && $category_slug !== 'shop-all') {
    foreach ($categories as $cat) {
        if ($cat['slug'] == $category_slug) {
            $current_category_name = $cat[$cat_name_col];
            break;
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="shop-page-wrapper" style="padding: 40px 0; background-color: #f9f9f9;">
    <div class="container">
        <div class="section-header text-center mb-5" style="margin-bottom: 30px;">
            <h1 class="section-title">
                <?php echo htmlspecialchars($current_category_name); ?>
            </h1>
            <p><?php echo $lang['browse_wide_range'] ?? 'Browse our wide range of authentic products'; ?></p>
        </div>

        <div class="row">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $row):
                    $image_path = !empty($row['image']) ? 'uploads/' . $row['image'] : 'https://placehold.co/600x600?text=No+Image';
                    $title = $row[$title_col];
                    ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="product-card"
                            style="background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); transition: transform 0.3s; height: 100%; display: flex; flex-direction: column;">
                            <a href="product.php?id=<?php echo $row['id']; ?>" class="product-img-link"
                                style="display: block; position: relative; padding-top: 100%;">
                                <img src="<?php echo htmlspecialchars($image_path); ?>"
                                    alt="<?php echo htmlspecialchars($title); ?>"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain; padding: 20px;">
                            </a>
                            <div class="product-info"
                                style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                <div>
                                    <h3 class="product-title" style="font-size: 16px; font-weight: 600; margin-bottom: 10px;">
                                        <a href="product.php?id=<?php echo $row['id']; ?>"
                                            style="color: #333; text-decoration: none;"><?php echo htmlspecialchars($title); ?></a>
                                    </h3>
                                    <div class="product-price"
                                        style="color: #6ea622; font-weight: 700; font-size: 18px; margin-bottom: 15px;">
                                        <?php echo format_currency($row['price']); ?>
                                    </div>
                                </div>
                                <form method="post" action="cart_add.php">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn--primary"
                                        style="width: 100%; justify-content: center;">
                                        <?php echo $lang['add_to_cart']; ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p><?php echo $lang['no_products_found']; ?> <a href="shop.php"><?php echo $lang['view_all_products']; ?></a></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>