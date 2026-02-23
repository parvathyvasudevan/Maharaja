<?php
require_once __DIR__ . '/../config/database.php';

try {
    echo "<h1>Database Setup</h1>";
    echo "Creating customer_addresses table...<br>";
    
    $query = "CREATE TABLE IF NOT EXISTS `customer_addresses` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `customer_id` int(11) NOT NULL,
      `address_line1` varchar(255) NOT NULL,
      `address_line2` varchar(255) DEFAULT NULL,
      `city` varchar(100) NOT NULL,
      `state` varchar(100) DEFAULT NULL,
      `zip` varchar(20) DEFAULT NULL,
      `country` varchar(100) DEFAULT 'Romania',
      `is_default` tinyint(1) NOT NULL DEFAULT 0,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      KEY `customer_id` (`customer_id`),
      CONSTRAINT `customer_addresses_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    if (mysqli_query($link, $query)) {
        echo "<b style='color:green;'>Success:</b> Table customer_addresses created or already exists!<br>";
        echo "<a href='account/addresses.php'>Go to Saved Addresses</a>";
    } else {
        throw new Exception(mysqli_error($link));
    }

} catch (Exception $e) {
    echo "<b style='color:red;'>Error:</b> " . $e->getMessage() . "<br>";
}
?>
