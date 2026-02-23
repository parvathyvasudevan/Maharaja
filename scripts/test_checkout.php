<?php
// scripts/test_checkout.php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/helpers.php';

try {
    echo "Testing Order Insertion...\n";
    $pdo->beginTransaction();

    $name = "Test User";
    $email = "test@example.com";
    $phone = "0123456789";
    $address = "123 Test Street";
    $subtotal = 100.00;
    $shipping = 15.00;
    $tax = calculate_tva($subtotal);
    $total = $subtotal + $shipping;
    $payment_method = 'bank_transfer';
    $user_id = null;

    $sql_order = "INSERT INTO orders (user_id, name, email, phone, address, subtotal_amount, shipping_cost, tax_amount, total_amount, status, payment_method, created_at) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, NOW())";
    $stmt_order = $pdo->prepare($sql_order);
    $stmt_order->execute([
        $user_id, 
        $name, 
        $email, 
        $phone, 
        $address, 
        $subtotal, 
        $shipping, 
        $tax, 
        $total, 
        $payment_method
    ]);
    
    $order_id = $pdo->lastInsertId();
    echo "Inserted order ID: $order_id\n";

    // Verify
    $stmt_verify = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt_verify->execute([$order_id]);
    $order = $stmt_verify->fetch(PDO::FETCH_ASSOC);

    if ($order) {
        echo "Order Verification:\n";
        print_r($order);
    } else {
        echo "FAILED: Order not found after insertion.\n";
    }

    $pdo->rollBack(); // Don't persist test data
    echo "\nTest completed (rolled back).\n";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
?>
