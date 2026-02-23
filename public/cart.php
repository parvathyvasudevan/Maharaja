<?php
// public/cart.php
require_once __DIR__ . '/../includes/init_lang.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/helpers.php';
require_once __DIR__ . '/../includes/security.php';

$cart_items = array();
$total_price = 0;
$title_col = get_col('title');

// Handle Remove
if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
    header("Location: cart.php");
    exit;
}

// Handle Update Quantity
if (isset($_POST['update_cart'])) {
    foreach ($_POST['qty'] as $pid => $qty) {
        $pid = intval($pid);
        $qty = intval($qty);
        
        // Stock check
        $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = ?");
        $stmt->execute([$pid]);
        $stock = $stmt->fetchColumn();

        if ($qty > 0) {
            $_SESSION['cart'][$pid] = min($qty, $stock);
        } else {
            unset($_SESSION['cart'][$pid]);
        }
    }
    header("Location: cart.php");
    exit;
}

// Fetch Items
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $ids = array_keys($_SESSION['cart']);
    if (!empty($ids)) {
        $placeholders = str_repeat('?,', count($ids) - 1) . '?';
        $sql = "SELECT * FROM products WHERE id IN ($placeholders)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($ids);
        
        while ($row = $stmt->fetch()) {
            $row['qty'] = $_SESSION['cart'][$row['id']];
            $row['subtotal'] = $row['price'] * $row['qty'];
            $total_price += $row['subtotal'];
            $cart_items[] = $row;
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
        <?php echo csrf_field(); ?>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead style="background: #f4f4f4;">
              <tr>
                <th style="width: 50px;"></th>
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
                  <td style="vertical-align: middle; text-align: center;">
                    <input type="checkbox" name="selected_items[]" value="<?php echo $item['id']; ?>" checked 
                           class="cart-item-checkbox" 
                           data-price="<?php echo $item['price']; ?>" 
                           data-qty="<?php echo $item['qty']; ?>">
                  </td>
                  <td>
                    <img src="<?php echo htmlspecialchars($image_path); ?>"
                      alt="<?php echo htmlspecialchars($item[$title_col]); ?>"
                      style="width: 80px; height: 80px; object-fit: contain;">
                  </td>
                  <td style="vertical-align: middle;">
                    <a href="product.php?id=<?php echo $item['id']; ?>"
                      style="font-weight: 600; color: #333;"><?php echo htmlspecialchars($item[$title_col]); ?></a>
                  </td>
                  <td style="vertical-align: middle;">
                    <?php echo format_currency($item['price']); ?>
                  </td>
                  <td style="vertical-align: middle;">
                    <input type="number" name="qty[<?php echo $item['id']; ?>]" value="<?php echo $item['qty']; ?>" min="1" max="<?php echo $item['stock']; ?>"
                      class="form-control text-center cart-qty-input" data-id="<?php echo $item['id']; ?>">
                  </td>
                  <td style="vertical-align: middle; font-weight: 700; color: #6ea622;">
                    <?php echo format_currency($item['subtotal']); ?>
                  </td>
                  <td style="vertical-align: middle; text-align: center;">
                    <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger"
                      onclick="return confirm('<?php echo $lang['are_you_sure'] ?? 'Are you sure?'; ?>')"
                      style="color: red; background: none; border: none; font-size: 20px;">&times;</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <div class="row mt-4">
          <div class="col-12 col-md-6">
            <a href="shop.php" class="btn btn--secondary"><?php echo $lang['continue_shopping'] ?? 'Continue Shopping'; ?></a>
          </div>
          <div class="col-12 col-md-6 text-md-end">
            <button type="submit" name="update_cart" class="btn btn--white me-2"><?php echo $lang['update_cart'] ?? 'Update Cart'; ?></button>
            <button type="submit" id="checkout-main" formaction="checkout.php" class="btn btn--primary btn--lg"><?php echo $lang['proceed_to_checkout'] ?? 'Proceed to Checkout'; ?></button>
          </div>
        </div>

        <script>
        function updateCartSubtotal() {
            const checkboxes = document.querySelectorAll('.cart-item-checkbox');
            const subtotalDisplay = document.getElementById('cart-total-val');
            let total = 0;
            let checkedCount = 0;
            
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    const price = parseFloat(cb.getAttribute('data-price')) || 0;
                    const qty = parseInt(cb.getAttribute('data-qty')) || 0;
                    total += price * qty;
                    checkedCount++;
                }
            });
            
            if (subtotalDisplay) {
                subtotalDisplay.textContent = total.toFixed(2) + ' RON';
            }
            
            const checkoutBtn = document.getElementById('checkout-main');
            if (checkoutBtn) {
                checkoutBtn.disabled = (checkedCount === 0);
                checkoutBtn.style.opacity = (checkedCount === 0) ? '0.5' : '1';
                checkoutBtn.style.cursor = (checkedCount === 0) ? 'not-allowed' : 'pointer';
            }
        }

        document.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('cart-item-checkbox')) {
                updateCartSubtotal();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            updateCartSubtotal();
        });
        </script>

        <div class="row mt-5">
          <div class="col-12 text-end">
            <h3 style="font-weight: 700;"><?php echo $lang['total'] ?? 'Total'; ?>: <span
                id="cart-total-val" style="color: #6ea622;"><?php echo format_currency($total_price); ?></span></h3>
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