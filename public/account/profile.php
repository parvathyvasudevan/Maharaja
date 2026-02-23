<?php
require_once __DIR__ . '/_auth.php';
require_customer_login();

$customer_id = $_SESSION['customer_id'];
$success = '';
$error = '';

// Fetch current user data
$stmt = mysqli_prepare($link, "SELECT name, email, phone FROM customers WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $customer_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $name = trim($_POST['name'] ?? '');
        $phone = trim($_POST['phone'] ?? '');

        if ($name) {
            $update_stmt = mysqli_prepare($link, "UPDATE customers SET name = ?, phone = ? WHERE id = ?");
            mysqli_stmt_bind_param($update_stmt, 'ssi', $name, $phone, $customer_id);
            if (mysqli_stmt_execute($update_stmt)) {
                $_SESSION['customer_name'] = $name;
                $_SESSION['customer_phone'] = $phone;
                $user['name'] = $name;
                $user['phone'] = $phone;
                $success = 'Profile updated successfully.';
            } else {
                $error = 'Failed to update profile.';
            }
        } else {
            $error = 'Name is required.';
        }
    } elseif (isset($_POST['change_password'])) {
        $current_pass = $_POST['current_password'] ?? '';
        $new_pass = $_POST['new_password'] ?? '';
        $confirm_pass = $_POST['confirm_password'] ?? '';

        if ($new_pass !== $confirm_pass) {
            $error = 'New passwords do not match.';
        } else {
            $pass_stmt = mysqli_prepare($link, "SELECT password FROM customers WHERE id = ?");
            mysqli_stmt_bind_param($pass_stmt, 'i', $customer_id);
            mysqli_stmt_execute($pass_stmt);
            $pass_res = mysqli_stmt_get_result($pass_stmt);
            $pass_row = mysqli_fetch_assoc($pass_res);

            if (password_verify($current_pass, $pass_row['password'])) {
                $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                $update_pass_stmt = mysqli_prepare($link, "UPDATE customers SET password = ? WHERE id = ?");
                mysqli_stmt_bind_param($update_pass_stmt, 'si', $hashed_pass, $customer_id);
                if (mysqli_stmt_execute($update_pass_stmt)) {
                    $success = 'Password changed successfully.';
                } else {
                    $error = 'Failed to update password.';
                }
            } else {
                $error = 'Current password is incorrect.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - Maharaja Supermarket</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f9fafb; margin: 0; padding: 20px; color: #374151; }
        .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
        h1 { font-size: 24px; font-weight: 700; margin-bottom: 24px; color: #111827; }
        h2 { font-size: 18px; font-weight: 600; margin-top: 32px; margin-bottom: 16px; color: #374151; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px; }
        .nav { margin-bottom: 30px; }
        .nav a { margin-right: 20px; text-decoration: none; color: #6b7280; font-weight: 500; }
        .nav a.active { color: #5B8A1D; border-bottom: 2px solid #5B8A1D; padding-bottom: 4px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 14px; font-weight: 500; margin-bottom: 6px; }
        input { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; }
        .btn { background: #5B8A1D; color: #fff; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; width: 100%; }
        .btn:hover { background: #4a7017; }
        .alert { padding: 12px; border-radius: 6px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .alert-error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="profile.php" class="active">Profile</a>
            <a href="orders.php">Order History</a>
            <a href="logout.php">Logout</a>
        </div>

        <h1>Account Settings</h1>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <h2>Personal Information</h2>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                <small style="color: #6b7280;">Email cannot be changed.</small>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
            </div>
            <button type="submit" name="update_profile" class="btn">Update Profile</button>
        </form>

        <form method="POST">
            <h2>Change Password</h2>
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit" name="change_password" class="btn">Change Password</button>
        </form>
    </div>
</body>
</html>
