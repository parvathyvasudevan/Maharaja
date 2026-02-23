/**
 * Authentication Helper Functions
 * 
 * Path: includes/auth.php
 * Part of: Maharaja Supermarket
 */

require_once __DIR__ . '/db.php';

/**
 * Check if any user (customer or admin) is logged in via session
 * 
 * @return bool
 */
function is_logged_in() {
    return isset($_SESSION['user_id']) || isset($_SESSION['customer_id']) || isset($_SESSION['admin_id']);
}

/**
 * Destroy current session and logout user
 * 
 * @return void
 */
function logout() {
    session_unset();
    session_destroy();
}
?>
