<?php
session_start();
// Enable error reporting for debugging 500 errors
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
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = mysqli_prepare($link, "SELECT id, name, email, phone, password FROM customers WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 's', $email);
    if (mysqli_stmt_execute($stmt)) {
        $res = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($res)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['customer_id'] = $row['id'];
                $_SESSION['customer_name'] = $row['name'];
                $_SESSION['customer_email'] = $row['email'];
                $_SESSION['customer_phone'] = $row['phone'];
                // Redirect to Shop for professional flow
                header('Location: ../shop.php');
                exit;
            }
        }
    }
    $error = 'Invalid email or password.';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Customer Login</title>
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
        <h1>Customer Login</h1>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button class="btn" type="submit">Login</button>
        </form>
        <p>New customer? <a href="register.php">Create an account</a></p>
    </div>
</body>

</html>