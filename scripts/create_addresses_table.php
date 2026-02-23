<?php
// scripts/create_addresses_table.php
require_once __DIR__ . '/../config/database.php';

try {
    echo "Creating customer_addresses table...\n";
    
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
        echo "Table customer_addresses created successfully!\n";
    } else {
        throw new Exception(mysqli_error($link));
    }

} catch (Exception $e) {
    die("ERROR: " . $e->getMessage() . "\n");
}
?>
