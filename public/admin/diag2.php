<?php
require_once __DIR__ . '/../../config/database.php';
$res = mysqli_query($link, "SELECT id, name_en, image FROM categories ORDER BY id");
$out = [];
while ($row = mysqli_fetch_assoc($res)) {
    $img = $row['image'] ?? 'NULL';
    $path1 = __DIR__ . '/../uploads/' . $img;
    $path2 = __DIR__ . '/../uploads/categories/' . $img;
    $out[] = [
        'id' => $row['id'],
        'name' => $row['name_en'],
        'db_image' => $img,
        'exists_in_uploads' => file_exists($path1) ? 'YES' : 'NO',
        'exists_in_uploads_categories' => file_exists($path2) ? 'YES' : 'NO',
    ];
}
header('Content-Type: application/json');
echo json_encode($out, JSON_PRETTY_PRINT);
