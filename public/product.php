<?php
session_start();
// Config inclusion
$config_path_local = __DIR__ . '/config/database.php';
if (file_exists($config_path_local)) {
  require_once $config_path_local;
} else {
  require_once __DIR__ . '/../config/database.php';
}

$product = null;
if (isset($_GET['id'])) {
  $pid = intval($_GET['id']);
  $sql = "SELECT * FROM products WHERE id = $pid";
  $result = mysqli_query($link, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
  }
}

if (!$product) {
  echo "<script>window.location.href='shop.php';</script>";
  exit;
}
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
            alt="<?php echo htmlspecialchars($product['title']); ?>"
            style="width: 100%; height: auto; object-fit: contain;">
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="product-info-detail">
          <h1 class="product-title" style="font-size: 32px; font-weight: 700; margin-bottom: 20px; color: #333;">
            <?php echo htmlspecialchars($product['title']); ?></h1>

          <div class="product-price-wrapper" style="margin-bottom: 25px;">
            <span class="price"
              style="font-size: 28px; color: #6ea622; font-weight: 700;"><?php echo number_format($product['price'], 2); ?>
              RON</span>
          </div>

          <div class="product-description mb-4" style="color: #666; line-height: 1.6;">
            <?php echo nl2br(htmlspecialchars($product['description'])); ?>
          </div>

          <div class="product-actions" style="margin-top: 30px; padding-top: 30px; border-top: 1px solid #eee;">
            <form method="post" action="cart_add.php" class="d-flex align-items-center flex-wrap" style="gap: 15px;">
              <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

              <div class="quantity-wrapper d-flex align-items-center"
                style="border: 1px solid #ddd; border-radius: 8px;">
                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                  style="border:none; background:none; padding: 10px 15px; cursor: pointer;">-</button>
                <input type="number" name="quantity" value="1" min="1"
                  style="width: 50px; text-align: center; border: none; -moz-appearance: textfield;">
                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                  style="border:none; background:none; padding: 10px 15px; cursor: pointer;">+</button>
              </div>

              <button type="submit" class="btn btn--primary btn--lg" style="min-width: 200px;">
                Add to Cart
              </button>
            </form>
          </div>

          <div class="product-meta mt-4" style="color: #999; font-size: 14px;">
            <?php if (!empty($product['sku'])): ?>
              <p>SKU: <?php echo htmlspecialchars($product['sku']); ?></p>
            <?php endif; ?>
            <?php if (!empty($product['category'])): ?>
              <p>Category: <a href="shop.php?category=<?php echo urlencode($product['category']); ?>"
                  style="color: #6ea622;"><?php echo htmlspecialchars($product['category']); ?></a></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>