<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();

// Database Connection
if (file_exists(__DIR__ . '/../../config/database.php')) {
    require_once __DIR__ . '/../../config/database.php';
} elseif (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
} else {
    die("Database configuration not found.");
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Optional: Delete the image file from server if needed
    // $res = mysqli_query($link, "SELECT image FROM products WHERE id = $id");
    // if ($row = mysqli_fetch_assoc($res)) {
    //     $img_path = __DIR__ . '/../uploads/' . $row['image'];
    //     if (file_exists($img_path)) unlink($img_path);
    // }

    $stmt = mysqli_prepare($link, "DELETE FROM products WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: products.php?deleted=1');
    } else {
        header('Location: products.php?error=delete_failed');
    }
} else {
    header('Location: products.php');
}
exit;
?>
