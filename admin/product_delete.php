<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $sql = "DELETE FROM products WHERE id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            header("location: products.php");
        } else {
            echo "Oops! Something went wrong.";
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($link);
?>
