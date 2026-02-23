<?php

require_once __DIR__ . '/db.php';

function is_logged_in() {
    return isset($_SESSION['user_id']) || isset($_SESSION['customer_id']) || isset($_SESSION['admin_id']);
}

function logout() {
    session_unset();
    session_destroy();
}
?>
