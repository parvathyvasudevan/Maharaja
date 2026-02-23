<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($link, $_POST['name']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $subject = mysqli_real_escape_string($link, $_POST['subject']);
    $message = mysqli_real_escape_string($link, $_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($link, $sql)) {
        $_SESSION['success_message'] = "Your message has been sent successfully!";
    } else {
        $_SESSION['error_message'] = "Oops! Something went wrong. Please try again later.";
    }

    header("Location: contact.php");
    exit;
} else {
    header("Location: contact.php");
    exit;
}
?>
