<?php
session_start();
require_once __DIR__ . '/../../config/database.php';

function require_customer_login() {
    if (!isset($_SESSION['customer_id'])) {
        header('Location: login.php');
        exit;
    }
}
?>
