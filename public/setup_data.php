<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$config_path = __DIR__ . '/../config/database.php';
$config_path_local = __DIR__ . '/config/database.php';
if (file_exists($config_path_local)) {
    require_once $config_path_local;
} else {
    require_once $config_path;
}

echo "<h1>Setup Database & Data</h1>";

// 0. Create Tables from Schema
// We read schema.sql and execute commands
$schema_path = __DIR__ . '/../sql/schema.sql';
if (file_exists($schema_path)) {
    $sql_schema = file_get_contents($schema_path);
    // Execute multi query and handle results one by one to avoid sync issues
    try {
        if (mysqli_multi_query($link, $sql_schema)) {
            do {
                // Consume results
                if ($result = mysqli_store_result($link)) {
                    mysqli_free_result($result);
                }
            } while (mysqli_more_results($link) && mysqli_next_result($link));

            // Check for any reported errors during the multi_query sequence
            if (mysqli_errno($link)) {
                echo "Note: " . mysqli_error($link) . "<br>";
            } else {
                echo "Database tables checked/created successfully.<br>";
            }
        } else {
            echo "Error executing schema: " . mysqli_error($link) . "<br>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "Safe Warning: " . $e->getMessage() . " (You can likely ignore this if tables exist)<br>";
    }
} else {
    echo "Schema file not found!<br>";
}

// 1. Create Admin
$password = password_hash("admin123", PASSWORD_DEFAULT);
// Use INSERT IGNORE to avoid duplicate entry errors
$sql_admin = "INSERT IGNORE INTO admins (username, password) VALUES ('admin', '$password')";
if (mysqli_query($link, $sql_admin)) {
    echo "Admin user 'admin' (password: admin123) ready.<br>";
} else {
    echo "Error creating admin: " . mysqli_error($link) . "<br>";
}

// 2. Create Categories
$sql_cat = "INSERT IGNORE INTO categories (name, slug) VALUES 
('Spices', 'spices'), 
('Rice', 'rice'), 
('Snacks', 'snacks'),
('Frozen Foods', 'frozen-foods'),
('Dairy', 'dairy')";
if (mysqli_query($link, $sql_cat)) {
    echo "Categories inserted.<br>";
} else {
    echo "Error creating categories: " . mysqli_error($link) . "<br>";
}

// 3. Create Sample Products
// Need to fetch category IDs first to ensure valid FKs
$sql_prod = "INSERT INTO products (category_id, title, description, price, stock, image, is_featured) VALUES 
(1, 'Basmati Rice 5kg', 'Premium quality long grain rice.', 45.00, 50, '', 1),
(1, 'Turmeric Powder 200g', 'Organic turmeric powder.', 12.50, 100, '', 1),
(1, 'Mango Pickle', 'Spicy and tangy Indian pickle.', 15.00, 30, '', 0),
(1, 'Deep Lachcha Paratha 340g', 'Frozen paratha.', 15.99, 100, '', 1),
(1, 'Amul Ghee 1L', 'Pure cow ghee.', 65.00, 20, '', 1)
ON DUPLICATE KEY UPDATE stock = stock";

if (mysqli_query($link, $sql_prod)) {
    echo "Sample products inserted.<br>";
} else {
    echo "Error inserting products: " . mysqli_error($link) . "<br>";
}

echo "<h3>Setup Complete!</h3>";
echo "<p><a href='index.php'>Go to Homepage</a></p>";
?>