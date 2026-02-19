<?php
session_start();
// Config
$config_path_local = __DIR__ . '/config/database.php';
if (file_exists($config_path_local)) {
    require_once $config_path_local;
} else {
    require_once __DIR__ . '/../config/database.php';
}

$order_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<?php include 'includes/header.php'; ?>

<div class="success-page-wrapper text-center" style="padding: 80px 0; background: #fff;">
    <div class="container">
        <div style="font-size: 80px; color: #6ea622; margin-bottom: 20px;">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 style="color: #333; font-weight: 700; margin-bottom: 20px;">Order Placed Successfully!</h1>
        <p style="color: #666; font-size: 18px; margin-bottom: 30px;">
            Thank you for your order. Your order number is <strong>#<?php echo $order_id; ?></strong>.
        </p>
        <p class="mb-5">We will process it shortly. You will pay on delivery.</p>

        <a href="shop.php" class="btn btn--primary btn--lg">Continue Shopping</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>