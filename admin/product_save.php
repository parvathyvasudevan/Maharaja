<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $category_id = !empty($_POST["category_id"]) ? intval($_POST["category_id"]) : null;

    // Image Upload
    $image = "";
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir_server = __DIR__ . "/../uploads/products/";
        $target_dir_local = __DIR__ . "/../public/uploads/products/";

        if (is_dir($target_dir_server)) {
            $target_dir = $target_dir_server;
        } elseif (is_dir($target_dir_local)) {
            $target_dir = $target_dir_local;
        } else {
            $target_dir = $target_dir_server; // Default to server path, maybe create it?
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
        }

        $file_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $file_name;
        }
    }

    $sql = "INSERT INTO products (category_id, title, description, price, stock, image) VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "issdis", $category_id, $title, $description, $price, $stock, $image);

        if (mysqli_stmt_execute($stmt)) {
            header("location: products.php");
        } else {
            echo "Error: " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>