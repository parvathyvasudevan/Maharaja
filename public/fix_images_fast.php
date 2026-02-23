<?php
require_once __DIR__ . '/../config/database.php';

echo "<h1>Fast Image Fix</h1>";

// Category Image Mapping
$category_images = [
    'popular-brands' => '1771598757_build.jpg',
    'Maharaja Supermarket-shop-new-products' => 'UPTO_70_OFF_8_v=1758894951.png',
    'cosmetics' => 'image-29-66549174ac9f8_v=1716822069.webp',
    'Maharaja Supermarket-shop-dietary-supplements' => 'pathajali_v=1726697467.png',
    'kitchen-appliances' => 'premier550w_600x400_v=1756208621.webp'
];

foreach ($category_images as $slug => $img) {
    mysqli_query($link, "UPDATE categories SET image = '$img' WHERE slug = '$slug'");
    echo "Updated category $slug with $img<br>";
}

// Product Image Mapping (English titles as keys)
$product_images = [
    'Bikano Sev Murmura 400g' => 'Indian-Breakfast_v=1750153834.jpg',
    'Haldiram Soan Papdi 500g' => 'image-30-66549173e903a_v=1716822069.webp',
    'Fresh Curry Leaves' => 'green-chilli-200-g-product-images-o590000187-p590000187-1-202409251830_600x400_v=1747139257.webp',
    'Himalaya Neem Face Wash 150ml' => 'image_10_v=1717325053.png',
    'Dabur Vatika Hair Oil 200ml' => 'image_9_v=1717325055.png',
    'Patanjali Ashwagandha Churna 100g' => 'pathajali_v=1726697467.png',
    'Patanjali Giloy Ghan Vati 40g' => 'patanjali_logo_v=1764149448.webp',
    'Prestige Mixer Grinder' => 'premier550w_600x400_v=1756208621.webp',
    'Hawkins Pressure Cooker 5L' => 'prestige-pressure-cooker-500x500_b34842fe-a925-4a52-928b-569329997495_600x400_v=1749653398.webp'
];

foreach ($product_images as $title => $img) {
    mysqli_query($link, "UPDATE products SET image = '$img' WHERE title_en = '$title'");
    echo "Updated product $title with $img<br>";
}

echo "<h3>Done!</h3>";
?>
