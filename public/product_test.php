<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>Product Page Logic Test</h1>";

// 1. Include Config
$config_path = __DIR__ . '/../config/database.php';
$config_path_local = __DIR__ . '/config/database.php';

if (file_exists($config_path_local)) {
    require_once $config_path_local;
    echo "<p style='color:green'>Config loaded from local.</p>";
} elseif (file_exists($config_path)) {
    require_once $config_path;
    echo "<p style='color:green'>Config loaded from parent.</p>";
} else {
    die("<p style='color:red'>Config not found!</p>");
}

// 2. Fetch a Product
$id = 1; // Assuming ID 1 exists from setup_data.php
if (isset($_GET['id']))
    $id = intval($_GET['id']);

echo "<p>Fetching Product ID: $id</p>";

$sql = "SELECT * FROM products WHERE id = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if ($product = mysqli_fetch_assoc($result)) {
            echo "<pre>";
            print_r($product);
            echo "</pre>";
        } else {
            echo "<p style='color:orange'>Product not found.</p>";
        }
    } else {
        echo "<p style='color:red'>Execute failed: " . mysqli_error($link) . "</p>";
    }
} else {
    echo "<p style='color:red'>Prepare failed: " . mysqli_error($link) . "</p>";
}

// 3. Test Cart Add Logic (Simulated)
echo "<h2>Simulating Cart Add</h2>";
if (!isset($_SESSION))
    session_start();
$_SESSION['cart'] = [];
$_SESSION['cart'][$id] = 1;
echo "<p>Session Cart updated.</p>";
print_r($_SESSION['cart']);

?>