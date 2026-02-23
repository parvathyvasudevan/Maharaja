<?php
require_once __DIR__ . '/_auth.php';
require_customer_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = (int)$_POST['order_id'];
    $customer_id = $_SESSION['customer_id'];

    // Verify order belongs to customer
    $stmt = mysqli_prepare($link, "SELECT id FROM orders WHERE id = ? AND user_id = ?");
    mysqli_stmt_bind_param($stmt, 'ii', $order_id, $customer_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($res) > 0) {
        // Fetch order items
        $item_stmt = mysqli_prepare($link, "SELECT product_id, quantity FROM order_items WHERE order_id = ?");
        mysqli_stmt_bind_param($item_stmt, 'i', $order_id);
        mysqli_stmt_execute($item_stmt);
        $item_res = mysqli_stmt_get_result($item_stmt);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        while ($item = mysqli_fetch_assoc($item_res)) {
            $pid = $item['product_id'];
            $qty = $item['quantity'];
            
            if (isset($_SESSION['cart'][$pid])) {
                $_SESSION['cart'][$pid] += $qty;
            } else {
                $_SESSION['cart'][$pid] = $qty;
            }
        }
        
        header('Location: ../cart.php');
        exit;
    }
}

header('Location: orders.php');
exit;
