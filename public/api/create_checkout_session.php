<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/stripe_helpers.php';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: ' . APP_URL . '/cart.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . APP_URL . '/checkout.php');
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$discount_code = trim($_POST['discount_code'] ?? '');

if (!$name || !$email || !$phone || !$address) {
    header('Location: ' . APP_URL . '/checkout.php?error=missing');
    exit;
}

$ids_arr = array_map('intval', array_keys($_SESSION['cart']));
$ids = implode(',', $ids_arr);

$cart_items = [];
$subtotal = 0.0;

$result = mysqli_query($link, "SELECT * FROM products WHERE id IN ($ids)");
while ($row = mysqli_fetch_assoc($result)) {
    $qty = (int)$_SESSION['cart'][$row['id']];
    $line_total = $row['price'] * $qty;
    $subtotal += $line_total;

    $cart_items[] = [
        'id' => $row['id'],
        'name' => $row['title'],
        'quantity' => $qty,
        'amount' => (float)$row['price'],
        'line_total' => (float)$line_total,
    ];
}

$discount_amount = 0.0;
if ($discount_code) {
    $stmt = mysqli_prepare($link, "SELECT * FROM discounts WHERE code = ? AND active = 1 AND (starts_at IS NULL OR starts_at <= NOW()) AND (ends_at IS NULL OR ends_at >= NOW()) LIMIT 1");
    mysqli_stmt_bind_param($stmt, 's', $discount_code);
    if (mysqli_stmt_execute($stmt)) {
        $res = mysqli_stmt_get_result($stmt);
        if ($disc = mysqli_fetch_assoc($res)) {
            if ($disc['min_order'] === null || $subtotal >= (float)$disc['min_order']) {
                if ($disc['type'] === 'percent') {
                    $discount_amount = round($subtotal * ((float)$disc['amount'] / 100), 2);
                } else {
                    $discount_amount = min($subtotal, (float)$disc['amount']);
                }
            }
        }
    }
}

$shipping_cost = SHIPPING_FLAT_RATE;
$tax_amount = round(($subtotal - $discount_amount) * (TAX_RATE / 100), 2);
$total = max(0, $subtotal - $discount_amount + $shipping_cost + $tax_amount);

$customer_id = $_SESSION['customer_id'] ?? null;

if ($customer_id) {
    $sql_order = "INSERT INTO orders (customer_id, customer_name, customer_email, customer_phone, customer_address, subtotal_amount, shipping_cost, tax_amount, discount_amount, total_amount, payment_method, payment_status, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'stripe', 'unpaid', 'pending')";
    $stmt = mysqli_prepare($link, $sql_order);
    mysqli_stmt_bind_param(
        $stmt,
        'issssddddd',
        $customer_id,
        $name,
        $email,
        $phone,
        $address,
        $subtotal,
        $shipping_cost,
        $tax_amount,
        $discount_amount,
        $total
    );
} else {
    $sql_order = "INSERT INTO orders (customer_id, customer_name, customer_email, customer_phone, customer_address, subtotal_amount, shipping_cost, tax_amount, discount_amount, total_amount, payment_method, payment_status, status) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'stripe', 'unpaid', 'pending')";
    $stmt = mysqli_prepare($link, $sql_order);
    mysqli_stmt_bind_param(
        $stmt,
        'ssssddddd',
        $name,
        $email,
        $phone,
        $address,
        $subtotal,
        $shipping_cost,
        $tax_amount,
        $discount_amount,
        $total
    );
}

if (!mysqli_stmt_execute($stmt)) {
    die('Error creating order: ' . mysqli_error($link));
}

$order_id = mysqli_insert_id($link);

foreach ($cart_items as $item) {
    $sql_item = "INSERT INTO order_items (order_id, product_id, quantity, price, line_total) VALUES (?, ?, ?, ?, ?)";
    $stmt_item = mysqli_prepare($link, $sql_item);
    mysqli_stmt_bind_param($stmt_item, 'iiidd', $order_id, $item['id'], $item['quantity'], $item['amount'], $item['line_total']);
    mysqli_stmt_execute($stmt_item);
}

$line_items = [];
foreach ($cart_items as $item) {
    $line_items[] = [
        'name' => $item['name'],
        'quantity' => $item['quantity'],
        'amount' => $item['amount'],
    ];
}

if ($shipping_cost > 0) {
    $line_items[] = [
        'name' => 'Shipping',
        'quantity' => 1,
        'amount' => $shipping_cost,
    ];
}

if ($tax_amount > 0) {
    $line_items[] = [
        'name' => 'Tax',
        'quantity' => 1,
        'amount' => $tax_amount,
    ];
}

$success_url = APP_URL . '/checkout_success.php?order_id=' . $order_id;
$cancel_url = APP_URL . '/checkout.php?cancel=1';

try {
    $session = stripe_create_checkout_session($order_id, $line_items, $success_url, $cancel_url);
    $stripe_session_id = $session['id'] ?? null;

    if ($stripe_session_id) {
        $stmt = mysqli_prepare($link, "UPDATE orders SET stripe_session_id = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'si', $stripe_session_id, $order_id);
        mysqli_stmt_execute($stmt);
    }

    header('Location: ' . $session['url']);
    exit;
} catch (Exception $e) {
    $error = $e->getMessage();
    header('Location: ' . APP_URL . '/checkout.php?error=' . urlencode($error));
    exit;
}
