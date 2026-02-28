<?php
// public/checkout.php
require_once __DIR__ . '/../includes/init_lang.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/email.php';

// Define constants
const SHIPPING_FLAT_RATE = 15.00;
const TVA_RATE = 0.09; // 9% on food

// --- DEBUGGING ACCORDING TO USER REQUEST ---
if (isset($_POST['name'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // echo "<div style='background:yellow; padding:10px; border:2px solid black;'>DEBUG: Place Order Reached! Processing...</div>";
}
// --- END DEBUGGING ---

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: shop.php");
    exit;
}

$title_col = get_col('title');
$show_checkout_form = isset($_SESSION['customer_id']) || (isset($_GET['guest']) && $_GET['guest'] == 'true');

// 1. Determine selected items for this checkout session
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selected_items'])) {
    $_SESSION['checkout_selected_items'] = $_POST['selected_items'];
} elseif (!isset($_SESSION['checkout_selected_items'])) {
    // Fallback: If no specific selection, use entire cart
    $_SESSION['checkout_selected_items'] = array_keys($_SESSION['cart']);
}

$selected_ids = $_SESSION['checkout_selected_items'];

// Calculate Totals and Prepare Items
$subtotal = 0.0;
$cart_items = [];
foreach ($_SESSION['cart'] as $pid => $qty) {
    // Only process selected items
    if (!in_array($pid, $selected_ids)) continue;

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$pid]);
    if ($p = $stmt->fetch()) {
        $p['qty'] = $qty;
        $p['subtotal'] = $p['price'] * $qty;
        $subtotal += $p['subtotal'];
        $cart_items[] = $p;
    }
}

// Check if any items are actually selected
if (empty($cart_items)) {
    header("Location: cart.php");
    exit;
}

$discount_amount = 0.0;
$coupon_id = null;
$coupon_code = '';
$coupon_error = '';

// Check GET parameter first, then falling back to Session
if (isset($_GET['discount']) && !empty($_GET['discount'])) {
    $coupon_code = sanitize($_GET['discount']);
    $_SESSION['applied_discount'] = $coupon_code; // Save to session
} elseif (isset($_SESSION['applied_discount']) && !empty($_SESSION['applied_discount'])) {
    $coupon_code = $_SESSION['applied_discount'];
}

if (!empty($coupon_code)) {
    $stmt = $pdo->prepare("SELECT * FROM coupons WHERE code = ? AND is_active = 1 AND (expires_at IS NULL OR expires_at >= CURDATE())");
    $stmt->execute([$coupon_code]);
    $coupon = $stmt->fetch();

    if ($coupon) {
        if ($coupon['max_uses'] == 0 || $coupon['used_count'] < $coupon['max_uses']) {
            if ($subtotal >= $coupon['min_order']) {
                $coupon_id = $coupon['id'];
                if ($coupon['type'] == 'percentage') {
                    $discount_amount = ($subtotal * $coupon['value']) / 100;
                } else {
                    $discount_amount = $coupon['value'];
                }
                $discount_amount = min($discount_amount, $subtotal);
            } else {
                $coupon_error = "Minimum order for this coupon is " . format_currency($coupon['min_order']);
                $coupon_code = ''; 
                unset($_SESSION['applied_discount']); // Clear invalid
            }
        } else {
            $coupon_error = "This coupon has reached its usage limit.";
            $coupon_code = '';
            unset($_SESSION['applied_discount']);
        }
    } else {
        $coupon_error = "Invalid or expired coupon code.";
        $coupon_code = '';
        unset($_SESSION['applied_discount']);
    }
}

$shipping = SHIPPING_FLAT_RATE;
$total = $subtotal + $shipping - $discount_amount;

// Handle Order Submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($cart_items) && isset($_POST['email'])) {
    // CSRF Check
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        die("CSRF Token validation failed.");
    }

    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $address = sanitize($_POST['address']);
    $payment_method = sanitize($_POST['payment_method']);
    $user_id = $_SESSION['customer_id'] ?? null;

    try {
        $pdo->beginTransaction();

        // 1. Insert Order
        $sql_order = "INSERT INTO orders (user_id, coupon_id, name, email, phone, address, subtotal_amount, shipping_cost, discount_amount, tax_amount, total_amount, status, payment_method, created_at) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, NOW())";
        $stmt_order = $pdo->prepare($sql_order);
        $stmt_order->execute([
            $user_id, 
            $coupon_id,
            $name, 
            $email, 
            $phone, 
            $address, 
            $subtotal, 
            $shipping, 
            $discount_amount,
            calculate_tva($subtotal - $discount_amount), 
            $total, 
            $payment_method
        ]);
        $order_id = $pdo->lastInsertId();

        // 1.5 Increment Coupon Use
        if ($coupon_id) {
            $pdo->prepare("UPDATE coupons SET used_count = used_count + 1 WHERE id = ?")->execute([$coupon_id]);
        }


        // 2. Insert Order Items
        $sql_item = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt_item = $pdo->prepare($sql_item);
        foreach ($cart_items as $item) {
            $stmt_item->execute([$order_id, $item['id'], $item['qty'], $item['price']]);
        }

        // 3. Handle Payment Placeholder
        /* 🏗️ PAYMENT GATEWAY PLACEHOLDER 🏗️
           - The project owner will integrate the payment gateway directly here.
           - For now, we only handle 'cod' (Cash on Delivery) and 'bank_transfer'.
           - Order is saved to DB regardless of payment method choice.
        */
        if ($payment_method === 'stripe') {
            // Integration will go here
        }

        $pdo->commit();

        // 4. Send Order Confirmation Email
        send_order_email($order_id, $pdo);

        // 5. Selective Cart Cleanup
        foreach ($_SESSION['checkout_selected_items'] as $pid) {
            unset($_SESSION['cart'][$pid]);
        }
        unset($_SESSION['checkout_selected_items']);

        header("Location: checkout_success.php?id=$order_id");
        exit;
    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $error = "<h3>❌ Error Placing Order</h3>" . $e->getMessage();
        if (strpos($e->getMessage(), 'Unknown column') !== false) {
            $error .= "<br><br><div class='alert alert-warning'><strong>FIX REQUIRED:</strong> It looks like your database is missing some columns. Please run this link once to fix it: <br> <a href='admin/ultra_fix.php' target='_blank' style='font-weight:bold; color:red; text-decoration:underline;'>CLICK HERE TO FIX DATABASE ON RENDER</a></div>";
        }
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="checkout-page-wrapper" style="padding: 60px 0; background: #f9f9f9;">
  <div class="container">

    <?php if (!$show_checkout_form): ?>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          <div class="auth-gate-box"
            style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: center;">
            <h2><?php echo $lang['checkout'] ?? 'Checkout'; ?></h2>
            <p style="margin-bottom: 30px; color: #666;">Please login or register to complete your order.</p>

            <div class="d-grid gap-3" style="display: flex; flex-direction: column; gap: 15px;">
              <a href="account/login.php?redirect=checkout.php" class="btn btn--primary btn--lg">Login</a>
              <a href="account/register.php?redirect=checkout.php" class="btn btn--secondary btn--lg">Create Account</a>

              <div style="position: relative; margin: 20px 0;">
                <hr style="border: 0; border-top: 1px solid #eee;">
                <span style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #fff; padding: 0 10px; color: #999; font-size: 14px;">OR</span>
              </div>

              <a href="checkout.php?guest=true" class="btn btn--white btn--lg" style="color: #666; border-color: #ddd;">Continue as Guest</a>
            </div>
          </div>
        </div>
      </div>
    <?php else: ?>
      <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>
      <?php if ($coupon_error): ?>
        <div class="alert alert-warning"><?php echo $coupon_error; ?></div>
      <?php endif; ?>

      <div class="row">
        <div class="col-12 col-lg-7 mb-4">
          <div class="checkout-form-box" style="background: #fff; padding: 30px; border-radius: 12px;">
            <h3 class="mb-4"><?php echo $lang['billing_details'] ?? 'Billing Details'; ?></h3>
            <form action="checkout.php<?php echo isset($_GET['guest']) ? '?guest=true' : ''; ?>" method="POST">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label"><?php echo $lang['name'] ?? 'Full Name'; ?></label>
                  <input type="text" name="name" class="form-control" placeholder="Ion Popescu" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label"><?php echo $lang['phone'] ?? 'Phone'; ?></label>
                  <input type="text" name="phone" class="form-control" placeholder="07xx xxx xxx" required>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label"><?php echo $lang['email'] ?? 'Email'; ?></label>
                <input type="email" name="email" class="form-control" placeholder="ion@example.ro" required>
              </div>
              <div class="mb-3">
                <label class="form-label"><?php echo $lang['address'] ?? 'Address'; ?></label>
                <textarea name="address" class="form-control" rows="3" placeholder="Street, Number, Apartment, City" required></textarea>
              </div>

              <h3 class="mb-3 mt-4"><?php echo $lang['payment_method'] ?? 'Payment Method'; ?></h3>
              <div class="payment-options">
                <div class="mb-3">
                  <label class="payment-option d-flex align-items-center" style="gap: 12px; cursor: pointer; border: 1px solid #eee; padding: 15px; border-radius: 12px; transition: all 0.2s; position: relative;">
                    <input type="radio" name="payment_method" value="cod" checked class="custom-radio">
                    <span class="radio-dot"></span>
                    <span style="font-weight: 500; font-size: 15px; color: #333;"><?php echo $lang['cash_on_delivery'] ?? 'Cash on Delivery (Ramburs)'; ?></span>
                  </label>
                </div>
                <div class="mb-3">
                  <label class="payment-option d-flex align-items-center" style="gap: 12px; cursor: pointer; border: 1px solid #eee; padding: 15px; border-radius: 12px; transition: all 0.2s; position: relative;">
                    <input type="radio" name="payment_method" value="bank_transfer" class="custom-radio">
                    <span class="radio-dot"></span>
                    <span style="font-weight: 500; font-size: 15px; color: #333;"><?php echo $lang['bank_transfer'] ?? 'Bank Transfer'; ?></span>
                  </label>
                </div>
              </div>

              <style>
                .custom-radio {
                  position: absolute;
                  opacity: 0;
                  cursor: pointer;
                  height: 0;
                  width: 0;
                }
                .radio-dot {
                  height: 20px;
                  width: 20px;
                  background-color: #fff;
                  border: 2px solid #ddd;
                  border-radius: 50%;
                  display: inline-block;
                  position: relative;
                  flex-shrink: 0;
                }
                .payment-option:hover .radio-dot {
                  border-color: var(--theme-color);
                }
                .custom-radio:checked ~ .radio-dot {
                  border-color: var(--theme-color);
                  background-color: #fff;
                }
                .radio-dot:after {
                  content: "";
                  position: absolute;
                  display: none;
                  top: 4px;
                  left: 4px;
                  width: 8px;
                  height: 8px;
                  border-radius: 50%;
                  background: var(--theme-color);
                }
                .custom-radio:checked ~ .radio-dot:after {
                  display: block;
                }
                .payment-option:hover {
                  border-color: var(--theme-color) !important;
                  background: #fdfdfd;
                }
                .custom-radio:checked ~ span:last-child {
                  color: var(--theme-color) !important;
                }
              </style>

              <button type="submit" class="btn btn--primary btn--lg w-100 mt-4">
                <?php echo $lang['place_order'] ?? 'Place Order'; ?> (<?php echo format_currency($total); ?>)
              </button>
            </form>
          </div>
        </div>

        <div class="col-12 col-lg-5">
          <div class="order-summary-box" style="background: #fff; padding: 30px; border-radius: 12px;">
            <h3 class="mb-4"><?php echo $lang['order_summary'] ?? 'Order Summary'; ?></h3>
            <table class="table w-100">
              <tbody>
                <?php foreach ($cart_items as $item): ?>
                  <tr>
                    <td style="padding: 10px 0;">
                      <?php echo htmlspecialchars($item[$title_col]); ?> <strong>x <?php echo $item['qty']; ?></strong>
                    </td>
                    <td class="text-end" style="padding: 10px 0;">
                      <?php echo format_currency($item['subtotal']); ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <tr style="border-top: 1px solid #eee;">
                  <td style="padding-top: 15px;"><?php echo $lang['subtotal'] ?? 'Subtotal'; ?></td>
                  <td class="text-end" style="padding-top: 15px;"><?php echo format_currency($subtotal); ?></td>
                </tr>
                <tr>
                  <td><?php echo $lang['shipping'] ?? 'Shipping'; ?></td>
                  <td class="text-end"><?php echo format_currency($shipping); ?></td>
                </tr>
                <tr>
                    <td style="font-size: 14px; color: #888;"><?php echo $lang['tva'] ?? 'Included TVA (9%)'; ?></td>
                    <td class="text-end" style="font-size: 14px; color: #888;"><?php echo format_currency(calculate_tva($subtotal - $discount_amount)); ?></td>
                </tr>
                <?php if ($discount_amount > 0): ?>
                <tr>
                  <td><?php echo $lang['discount'] ?? 'Discount'; ?> (<?php echo htmlspecialchars($coupon_code); ?>)</td>
                  <td class="text-end" style="color: #e44d26;">-<?php echo format_currency($discount_amount); ?></td>
                </tr>
                <?php endif; ?>
                <tr style="font-weight: 700; font-size: 18px;">
                  <td><?php echo $lang['total'] ?? 'Total'; ?></td>
                  <td class="text-end"><?php echo format_currency($total); ?></td>
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