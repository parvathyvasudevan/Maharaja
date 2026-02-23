<?php
// public/product.php
require_once __DIR__ . '/../includes/init_lang.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$product = null;
$title_col = get_col('title');
$desc_col = get_col('description');

if (isset($_GET['id'])) {
    $pid = intval($_GET['id']);
    $stmt = $pdo->prepare("SELECT p.*, c.name_en as cat_en, c.name_ro as cat_ro, c.slug as cat_slug 
                          FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.id 
                          WHERE p.id = ? AND p.is_active = 1");
    $stmt->execute([$pid]);
    $product = $stmt->fetch();
}

if (!$product) {
    header("Location: shop.php");
    exit;
}

$cat_name_col = 'cat_' . ($_SESSION['lang'] ?? 'en');
?>
<?php include 'includes/header.php'; ?>

<div class="product-details-page" style="padding: 60px 0; background: #fff;">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 mb-4">
        <div class="product-gallery" style="border: 1px solid #eee; border-radius: 12px; padding: 20px;">
          <?php
          $image_path = !empty($product['image']) ? 'uploads/' . $product['image'] : 'https://placehold.co/600x600?text=No+Image';
          ?>
          <img src="<?php echo htmlspecialchars($image_path); ?>"
            alt="<?php echo htmlspecialchars($product[$title_col]); ?>"
            style="width: 100%; height: auto; object-fit: contain;">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="product-info-detail">
          <h1 class="product-title" style="font-size: 32px; font-weight: 700; margin-bottom: 20px; color: #333;">
            <?php echo htmlspecialchars($product[$title_col]); ?></h1>

          <div class="product-price-wrapper" style="margin-bottom: 25px;">
            <span class="price"
              style="font-size: 28px; color: #6ea622; font-weight: 700;">
              <?php echo format_currency($product['price']); ?>
            </span>
          </div>

          <div class="product-description mb-4" style="color: #666; line-height: 1.6;">
            <?php echo nl2br(htmlspecialchars($product[$desc_col])); ?>
          </div>
          
          <div class="product-stock mb-4" style="color: <?php echo $product['stock'] > 0 ? '#6ea622' : '#dc3545'; ?>; font-weight: 600;">
              <?php if ($product['stock'] > 0): ?>
                  <?php echo $lang['in_stock']; ?> (<?php echo $product['stock']; ?> <?php echo $lang['available']; ?>)
              <?php else: ?>
                  <?php echo $lang['out_of_stock']; ?>
              <?php endif; ?>
          </div>

          <div class="product-actions" style="margin-top: 30px; padding-top: 30px; border-top: 1px solid #eee;">
            <form method="post" action="cart_add.php" class="d-flex align-items-center flex-wrap" style="gap: 15px;">
              <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

              <div class="quantity-wrapper d-flex align-items-center"
                style="border: 1px solid #ddd; border-radius: 8px;">
                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                  style="border:none; background:none; padding: 10px 15px; cursor: pointer;">-</button>
                <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['stock']; ?>"
                  style="width: 50px; text-align: center; border: none; -moz-appearance: textfield;">
                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                  style="border:none; background:none; padding: 10px 15px; cursor: pointer;">+</button>
              </div>

              <button type="submit" class="btn btn--primary btn--lg" style="min-width: 200px;" <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
                <?php echo $lang['add_to_cart']; ?>
              </button>
            </form>
          </div>

          <div class="product-meta mt-4" style="color: #999; font-size: 14px;">
            <?php if (!empty($product['sku'])): ?>
              <p>SKU: <?php echo htmlspecialchars($product['sku']); ?></p>
            <?php endif; ?>
            <?php if (!empty($product['cat_slug'])): ?>
              <p><?php echo $lang['category']; ?>: <a href="shop.php?category=<?php echo urlencode($product['cat_slug']); ?>"
                  style="color: #6ea622;"><?php echo htmlspecialchars($product[$cat_name_col]); ?></a></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>