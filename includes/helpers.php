<?php

function rename_upload($filename) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    return bin2hex(random_bytes(16)) . '.' . $ext;
}

function validate_image($file, $max_size = 2097152) { // Default 2MB
    $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array($file['type'], $allowed_types)) {
        return "Only JPG, PNG and WEBP are allowed.";
    }
    if ($file['size'] > $max_size) {
        return "File too large. Max 2MB.";
    }
    return true;
}

function format_currency($amount) {
    return number_format($amount, 2, '.', ',') . ' RON';
}

function calculate_tva($amount, $rate = 0.09) {
    return $amount * $rate;
}
?>
