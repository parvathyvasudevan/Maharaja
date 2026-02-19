<?php
require_once __DIR__ . "/../config/database.php";

// 1. Create Admin
$password = password_hash("admin123", PASSWORD_DEFAULT);
$sql_admin = "INSERT INTO admins (username, password) VALUES ('admin', '$password')";
if (mysqli_query($link, $sql_admin)) {
    echo "Admin created successfully.<br>";
} else {
    echo "Error creating admin: " . mysqli_error($link) . "<br>";
}

// 2. Create Categories
$sql_cat = "INSERT INTO categories (name, slug) VALUES 
('Spices', 'spices'), 
('Rice', 'rice'), 
('Snacks', 'snacks')";
mysqli_query($link, $sql_cat);

// 3. Create Sample Products
$sql_prod = "INSERT INTO products (category_id, title, description, price, stock, image, is_featured) VALUES 
(2, 'Basmati Rice 5kg', 'Premium quality long grain rice.', 45.00, 50, '', 1),
(1, 'Turmeric Powder 200g', 'Organic turmeric powder.', 12.50, 100, '', 1),
(3, 'Mango Pickle', 'Spicy and tangy Indian pickle.', 15.00, 30, '', 0)";

if (mysqli_query($link, $sql_prod)) {
    echo "Sample products Inserted.<br>";
} else {
    echo "Error inserting products: " . mysqli_error($link) . "<br>";
}

echo "Setup Complete. Delete this file after running.";
?>
