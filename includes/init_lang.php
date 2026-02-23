/**
 * Language and Session Initialization
 * 
 * Path: includes/init_lang.php
 * Part of: Maharaja Supermarket
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Check if language is provided via URL parameter
if (isset($_GET['lang'])) {
    $lang_choice = $_GET['lang'];
    if (in_array($lang_choice, ['en', 'ro'])) {
        $_SESSION['lang'] = $lang_choice;
    }
}

// 2. Default to English if no session is set
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// 3. Load the translation array
$lang_file = __DIR__ . "/lang/" . $_SESSION['lang'] . ".php";

if (file_exists($lang_file)) {
    $lang = include $lang_file;
} else {
    $lang = []; 
}

/**
 * Helper function to get correct column for bilingual database content
 * 
 * @param string $base_name Basic column name (e.g., 'title')
 * @return string Language-suffixed column name (e.g., 'title_en')
 */
function get_col($base_name) {
    $current_lang = $_SESSION['lang'] ?? 'en';
    return $base_name . '_' . $current_lang;
}
?>
