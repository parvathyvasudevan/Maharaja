<?php
session_start();
$config_path = __DIR__ . '/../config/database.php';
$config_path_local = __DIR__ . '/config/database.php';
if (file_exists($config_path_local)) {
    require_once $config_path_local;
} else {
    require_once $config_path;
}


// Check if customer is logged in (Disabled for guest checkout)
/*
if (!isset($_SESSION['customer_id'])) {
    header("Location: /account/login.php");
    exit;
}
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : null;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    if ($quantity < 1) {
        $quantity = 1;
    }

    if ($product_id) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }

    // Redirect back
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'shop.php';
    header("Location: " . $referer);
    exit;
}
?>