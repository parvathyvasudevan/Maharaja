<?php
require_once __DIR__ . '/../../config/database.php';
$res = mysqli_query($link, "SELECT id, name_en, image FROM categories ORDER BY id");
while ($row = mysqli_fetch_assoc($res)) {
    $image = $row['image'];
    $file_path = __DIR__ . '/../uploads/' . $image;
    $file_exists = $image ? (file_exists($file_path) ? 'YES' : 'NO') : 'n/a';
    $web_path = '../uploads/' . $image;
    echo "ID:{$row['id']} | {$row['name_en']} | DB image: [{$image}] | File exists: $file_exists | Web path: $web_path\n";
}
?>
