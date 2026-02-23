/**
 * General Helper Functions
 * 
 * Path: includes/helpers.php
 * Part of: Maharaja Supermarket
 */

/**
 * Rename uploaded file to a UUID-like name to prevent collisions/security risks
 * 
 * @param string $filename Original filename
 * @return string Randomized filename
 */
function rename_upload($filename) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    return bin2hex(random_bytes(16)) . '.' . $ext;
}

/**
 * Validate image upload type and size
 * 
 * @param array $file $_FILES element
 * @param int $max_size Maximum allowed size in bytes (default 2MB)
 * @return bool|string True if valid, error message otherwise
 */
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

/**
 * Format currency to RON
 * 
 * @param float $amount Amount to format
 * @return string Formatted currency string
 */
function format_currency($amount) {
    return number_format($amount, 2, '.', ',') . ' RON';
}

/**
 * Calculate TVA (9% for food in Romania)
 * 
 * @param float $amount Net amount
 * @param float $rate Tax rate (default 0.09)
 * @return float Calculated tax amount
 */
function calculate_tva($amount, $rate = 0.09) {
    return $amount * $rate;
}
?>
