<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

$config_path_local = __DIR__ . '/config/database.php';
if (file_exists($config_path_local)) {
  require_once $config_path_local;
} else {
  require_once __DIR__ . '/../config/database.php';
}

$cart_items = array();
$total_price = 0;

// Handle Remove
if (isset($_GET['remove'])) {
  $remove_id = intval($_GET['remove']);
  if (isset($_SESSION['cart'][$remove_id])) {
    unset($_SESSION['cart'][$remove_id]);
  }
  header("Location: cart.php");
  exit;
}

// Handle Update Quantity (optional, good for professionalism)
if (isset($_POST['update_cart'])) {
  foreach ($_POST['qty'] as $pid => $qty) {
    $pid = intval($pid);
    $qty = intval($qty);
    if ($qty > 0) {
      $_SESSION['cart'][$pid] = $qty;
    } else {
      unset($_SESSION['cart'][$pid]);
    }
  }
  header("Location: cart.php");
  exit;
}

// Fetch Items
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
  $ids_arr = array();
  foreach ($_SESSION['cart'] as $pid => $qty) {
    $ids_arr[] = intval($pid);
  }

  if (!empty($ids_arr)) {
    $ids = implode(',', $ids_arr);
    $sql = "SELECT * FROM products WHERE id IN ($ids)";
    $result = mysqli_query($link, $sql);
    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $row['qty'] = $_SESSION['cart'][$row['id']];
        $row['subtotal'] = $row['price'] * $row['qty'];
        $total_price += $row['subtotal'];
        $cart_items[] = $row;
      }
    }
  }
}
?>
<?php include 'includes/header.php'; ?>

<div class="cart-page-wrapper" style="padding: 60px 0; background: #fff;">
  <div class="container">
    <h1 class="page-title mb-4" style="font-weight: 700; color: #333;">Your Shopping Cart</h1>

    <?php if (!empty($cart_items)): ?>
      <form action="cart.php" method="POST">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead style="background: #f4f4f4;">
              <tr>
                <th style="width: 100px;">Image</th>
                <th>Product</th>
                <th style="width: 150px;">Price</th>
                <th style="width: 120px;">Quantity</th>
                <th style="width: 150px;">Total</th>
                <th style="width: 50px;">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cart_items as $item):
                $image_path = !empty($item['image']) ? 'uploads/' . $item['image'] : 'https://placehold.co/100x100?text=No+Img';
                ?>
                <tr>
                  <td>
                    <img src="<?php echo htmlspecialchars($image_path); ?>"
                      alt="<?php echo htmlspecialchars($item['title']); ?>"
                      style="width: 80px; height: 80px; object-fit: contain;">
                  </td>
                  <td style="vertical-align: middle;">
                    <a href="product.php?id=<?php echo $item['id']; ?>"
                      style="font-weight: 600; color: #333;"><?php echo htmlspecialchars($item['title']); ?></a>
                  </td>
                  <td style="vertical-align: middle;">
                    <?php echo number_format($item['price'], 2); ?> RON
                  </td>
                  <td style="vertical-align: middle;">
                    <input type="number" name="qty[<?php echo $item['id']; ?>]" value="<?php echo $item['qty']; ?>" min="1"
                      class="form-control text-center">
                  </td>
                  <td style="vertical-align: middle; font-weight: 700; color: #6ea622;">
                    <?php echo number_format($item['subtotal'], 2); ?> RON
                  </td>
                  <td style="vertical-align: middle; text-align: center;">
                    <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger"
                      onclick="return confirm('Are you sure?')"
                      style="color: red; background: none; border: none; font-size: 20px;">&times;</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="row mt-4">
          <div class="col-12 col-md-6">
            <a href="shop.php" class="btn btn--secondary">Continue Shopping</a>
          </div>
          <div class="col-12 col-md-6 text-md-end">
            <button type="submit" name="update_cart" class="btn btn--white me-2">Update Cart</button>
            <a href="checkout.php" class="btn btn--primary btn--lg">Proceed to Checkout</a>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col-12 text-end">
            <h3 style="font-weight: 700;">Total: <span
                style="color: #6ea622;"><?php echo number_format($total_price, 2); ?> RON</span></h3>
          </div>
        </div>
      </form>
    <?php else: ?>
      <div class="empty-cart-message text-center py-5">
        <div style="font-size: 60px; color: #ddd; margin-bottom: 20px;">🛒</div>
        <h3>Your cart is empty</h3>
        <p class="mb-4">Looks like you haven't added anything to your cart yet.</p>
        <a href="shop.php" class="btn btn--primary">Start Shopping</a>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>