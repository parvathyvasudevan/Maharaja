<?php
session_start();
// Config
$config_path_local = __DIR__ . '/config/database.php';
if (file_exists($config_path_local)) {
  require_once $config_path_local;
  require_once __DIR__ . '/config/app.php';
} else {
  require_once __DIR__ . '/../config/database.php';
  require_once __DIR__ . '/../config/app.php'; // Ensure app.php exists or define constants
}

// Define constants if missing
if (!defined('SHIPPING_FLAT_RATE'))
  define('SHIPPING_FLAT_RATE', 15.00);
if (!defined('TAX_RATE'))
  define('TAX_RATE', 19);

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
  header("Location: shop.php");
  exit;
}

// Handle Login/Register Actions if posted to this page (or separate files)
// For now, we assume user navigates to login.php or register.php then comes back.
// But user asked for "login/register or sign up at the time of check out".
// So we show it here if not logged in.

$show_checkout_form = isset($_SESSION['customer_id']);
// Allow guest checkout if they explicitly choose it (optional, based on "user need only to login... at time of checkout" - implies forced? or option?)
// "user need only to login/register or sign up at the time of check out ...its fine"
// This sounds like "authentication is required, but don't force it *before* they click checkout".
// So now they are at checkout. We show login options.

?>
<?php include 'includes/header.php'; ?>

<div class="checkout-page-wrapper" style="padding: 60px 0; background: #f9f9f9;">
  <div class="container">

    <?php if (!$show_checkout_form): ?>
      <!-- Login / Register Gate -->
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          <div class="auth-gate-box"
            style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: center;">
            <h2 style="margin-bottom: 20px;">Checkout</h2>
            <p style="margin-bottom: 30px; color: #666;">Please login or register to complete your order.</p>

            <div class="d-grid gap-3" style="display: flex; flex-direction: column; gap: 15px;">
              <a href="login.php?redirect=checkout.php" class="btn btn--primary btn--lg" style="width: 100%;">Login</a>
              <a href="register.php?redirect=checkout.php" class="btn btn--secondary btn--lg" style="width: 100%;">Create
                Account</a>

              <div style="position: relative; margin: 20px 0;">
                <hr style="border: 0; border-top: 1px solid #eee;">
                <span
                  style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #fff; padding: 0 10px; color: #999; font-size: 14px;">OR</span>
              </div>

              <a href="checkout.php?guest=true" class="btn btn--white btn--lg"
                style="width: 100%; color: #666; border-color: #ddd;">Continue as Guest</a>
            </div>
          </div>
        </div>
      </div>

      <?php
      // Check for guest override
      if (isset($_GET['guest']) && $_GET['guest'] == 'true') {
        // In a real app we might set a flag in session
        $show_checkout_form = true; // Show form below
      }
      ?>
    <?php endif; ?>

    <?php if ($show_checkout_form):
      // Calculate Totals
      $subtotal = 0.0;
      $cart_items = [];
      foreach ($_SESSION['cart'] as $pid => $qty) {
        $pid = intval($pid);
        $res = mysqli_query($link, "SELECT * FROM products WHERE id=$pid");
        if ($p = mysqli_fetch_assoc($res)) {
          $p['qty'] = $qty;
          $p['subtotal'] = $p['price'] * $qty;
          $subtotal += $p['subtotal'];
          $cart_items[] = $p;
        }
      }
      $shipping = SHIPPING_FLAT_RATE;
      $total = $subtotal + $shipping;

      // Handle Form Submission
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($cart_items)) {
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $phone = mysqli_real_escape_string($link, $_POST['phone']);
        $address = mysqli_real_escape_string($link, $_POST['address']);
        $payment_method = mysqli_real_escape_string($link, $_POST['payment_method']);
        $user_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id'] : 'NULL';

        // Insert Order
        $sql_order = "INSERT INTO orders (user_id, name, email, phone, address, total_amount, status, payment_method, created_at) 
                        VALUES ($user_id, '$name', '$email', '$phone', '$address', '$total', 'pending', '$payment_method', NOW())";

        if (mysqli_query($link, $sql_order)) {
          $order_id = mysqli_insert_id($link);

          // Insert Order Items
          foreach ($cart_items as $item) {
            $prod_id = $item['id'];
            $quantity = $item['qty'];
            $price = $item['price'];

            $sql_item = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                               VALUES ($order_id, $prod_id, $quantity, $price)";
            mysqli_query($link, $sql_item);
          }

          // Clear Cart
          unset($_SESSION['cart']);

          echo "<script>window.location.href='checkout_success.php?id=$order_id';</script>";
          exit;
        } else {
          echo "<div class='alert alert-danger'>Error placing order: " . mysqli_error($link) . "</div>";
        }
      }
      ?>
      <div class="row <?php echo (!isset($_SESSION['customer_id']) && !isset($_GET['guest'])) ? 'd-none' : ''; ?>">
        <!-- Hide if gate is active and no guest mode -->
        <div class="col-12 col-lg-7 mb-4">
          <div class="checkout-form-box" style="background: #fff; padding: 30px; border-radius: 12px;">
            <h3 class="mb-4">Billing Details</h3>
            <form action="checkout.php<?php echo isset($_GET['guest']) ? '?guest=true' : ''; ?>" method="POST">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Full Name</label>
                  <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" required>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="3" required></textarea>
              </div>

              <h3 class="mb-3 mt-4">Payment Method</h3>
              <div class="mb-3">
                <label class="payment-option d-flex align-items-center" style="gap: 10px; cursor: pointer;">
                  <input type="radio" name="payment_method" value="cod" checked>
                  <span>Cash on Delivery</span>
                </label>
              </div>

              <button type="submit" class="btn btn--primary btn--lg w-100 mt-4">Place Order</button>
            </form>
          </div>
        </div>

        <div class="col-12 col-lg-5">
          <div class="order-summary-box" style="background: #fff; padding: 30px; border-radius: 12px;">
            <h3 class="mb-4">Order Summary</h3>
            <table class="table w-100">
              <tbody>
                <?php foreach ($cart_items as $item): ?>
                  <tr>
                    <td style="padding: 10px 0;">
                      <?php echo htmlspecialchars($item['title']); ?> <strong>x <?php echo $item['qty']; ?></strong>
                    </td>
                    <td class="text-end" style="padding: 10px 0;">
                      <?php echo number_format($item['subtotal'], 2); ?> RON
                    </td>
                  </tr>
                <?php endforeach; ?>
                <tr style="border-top: 1px solid #eee;">
                  <td style="padding-top: 15px;">Subtotal</td>
                  <td class="text-end" style="padding-top: 15px;"><?php echo number_format($subtotal, 2); ?> RON</td>
                </tr>
                <tr>
                  <td>Shipping</td>
                  <td class="text-end"><?php echo number_format($shipping, 2); ?> RON</td>
                </tr>
                <tr style="font-weight: 700; font-size: 18px;">
                  <td>Total</td>
                  <td class="text-end"><?php echo number_format($total, 2); ?> RON</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>