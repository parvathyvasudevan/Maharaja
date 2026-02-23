<?php
// public/checkout_success.php
require_once __DIR__ . '/../includes/init_lang.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/helpers.php';

$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($order_id <= 0) {
    header("Location: index.php");
    exit;
}

// Fetch order details
$stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->execute([$order_id]);
$order = $stmt->fetch();

if (!$order) {
    die("Order not found.");
}

// Fetch order items
$stmt_items = $pdo->prepare("SELECT oi.*, p.title_en, p.title_ro FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = ?");
$stmt_items->execute([$order_id]);
$items = $stmt_items->fetchAll();

$title_col = get_col('title');

include 'includes/header.php';
?>

<div class="success-page-wrapper" style="padding: 80px 0; text-align: center; background: #fff;">
    <div class="container">
        <div class="success-icon" style="margin-bottom: 30px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#6ea622" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <h1 style="color: #333; margin-bottom: 20px;"><?php echo $lang['thank_you'] ?? 'Thank You for Your Order!'; ?></h1>
        <p style="font-size: 18px; color: #666; margin-bottom: 40px;">
            <?php echo str_replace('#', '<strong>#' . $order_id . '</strong>', $lang['order_success_msg'] ?? 'Your order # has been placed successfully. We will contact you soon for confirmation.'); ?>
        </p>
        
        <div class="order-details-box" style="display: block; max-width: 800px; margin: 0 auto 40px; text-align: left; background: #fff; padding: 30px; border-radius: 12px; border: 1px solid #eee;">
            <div style="display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 20px; border-bottom: 2px solid #6ea622; padding-bottom: 15px;">
                <h4 style="margin: 0; color: #333;">Order Details</h4>
                <span style="color: #666;">Date: <?php echo date('d M Y, H:i', strtotime($order['created_at'])); ?></span>
            </div>
            
            <table class="table" style="width: 100%; margin-bottom: 20px;">
                <thead style="background: #fdfdfd;">
                    <tr>
                        <th style="padding: 12px; border-bottom: 1px solid #eee;">Item</th>
                        <th style="padding: 12px; border-bottom: 1px solid #eee; text-align: center;">Qty</th>
                        <th style="padding: 12px; border-bottom: 1px solid #eee; text-align: right;">Price</th>
                        <th style="padding: 12px; border-bottom: 1px solid #eee; text-align: right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td style="padding: 12px; border-bottom: 1px solid #f9f9f9;"><?php echo htmlspecialchars($item[$title_col]); ?></td>
                            <td style="padding: 12px; border-bottom: 1px solid #f9f9f9; text-align: center;"><?php echo $item['quantity']; ?></td>
                            <td style="padding: 12px; border-bottom: 1px solid #f9f9f9; text-align: right;"><?php echo format_currency($item['price']); ?></td>
                            <td style="padding: 12px; border-bottom: 1px solid #f9f9f9; text-align: right;"><?php echo format_currency($item['price'] * $item['quantity']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div style="width: 100%; max-width: 300px; margin-left: auto;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span>Subtotal:</span>
                    <span><?php echo format_currency($order['subtotal_amount']); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                    <span>Shipping:</span>
                    <span><?php echo format_currency($order['shipping_cost']); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 8px; color: #888; font-size: 0.9em;">
                    <span>Included TVA (9%):</span>
                    <span><?php echo format_currency($order['tax_amount']); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 15px; padding-top: 15px; border-top: 2px solid #eee; font-weight: 700; font-size: 1.2em; color: #6ea622;">
                    <span>Total:</span>
                    <span><?php echo format_currency($order['total_amount']); ?></span>
                </div>
            </div>

            <div style="margin-top: 30px; padding: 20px; background: #fdfdfd; border-radius: 8px; border: 1px dashed #ddd;">
                <p style="margin-bottom: 10px;"><strong>Billing Info:</strong></p>
                <p style="margin: 0; color: #555;"><?php echo htmlspecialchars($order['name']); ?></p>
                <p style="margin: 0; color: #555;"><?php echo htmlspecialchars($order['phone']); ?></p>
                <p style="margin: 0; color: #555;"><?php echo htmlspecialchars($order['email']); ?></p>
                <p style="margin: 0; color: #555;"><?php echo htmlspecialchars($order['address']); ?></p>
                <p style="margin-top: 10px; color: #555;"><strong>Payment:</strong> <?php echo strtoupper($order['payment_method']); ?> (<?php echo ucfirst($order['status']); ?>)</p>
            </div>
        </div>
        
        <div>
            <a href="shop.php" class="btn btn--primary btn--lg">Continue Shopping</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>