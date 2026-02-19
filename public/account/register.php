<?php
session_start();
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Robust Database Connection
if (file_exists(__DIR__ . '/../../config/database.php')) {
    require_once __DIR__ . '/../../config/database.php';
} elseif (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
} else {
    die("Database configuration not found.");
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$name || !$email || !$password) {
        $error = 'Please fill all required fields.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($link, "INSERT INTO customers (name, email, password, phone) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $hash, $phone);
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['customer_id'] = mysqli_insert_id($link);
            $_SESSION['customer_name'] = $name;
            $_SESSION['customer_email'] = $email;
            $_SESSION['customer_phone'] = $phone;
            // Redirect to Shop for professional flow
            header('Location: ../shop.php');
            exit;
        } else {
            $error = 'Email already exists or invalid.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 40px;
        }

        .card {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }

        .btn {
            background: #5B8A1D;
            color: #fff;
            padding: 10px 16px;
            border: 0;
            cursor: pointer;
            width: 100%;
        }

        .error {
            color: #b00020;
        }
    </style>
</head>

<body>
    <div class="card">
        <h1>Create Account</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
        <form method="post">
            <input type="text" name="name" placeholder="Full name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone (optional)">
            <input type="password" name="password" placeholder="Password" required>
            <button class="btn" type="submit">Create Account</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>

</html>