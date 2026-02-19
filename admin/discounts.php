<?php
require_once __DIR__ . "/auth_guard.php";
require_once __DIR__ . "/../config/database.php";

$editing = false;
$edit_discount = null;

if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $res = mysqli_query($link, "SELECT * FROM discounts WHERE id = $edit_id");
    $edit_discount = mysqli_fetch_assoc($res);
    $editing = $edit_discount ? true : false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $code = trim($_POST['code']);
    $type = $_POST['type'] === 'fixed' ? 'fixed' : 'percent';
    $amount = (float)$_POST['amount'];
    $min_order = $_POST['min_order'] !== '' ? (float)$_POST['min_order'] : null;
    $starts_at = $_POST['starts_at'] ?: null;
    $ends_at = $_POST['ends_at'] ?: null;
    $active = isset($_POST['active']) ? 1 : 0;

    if ($id > 0) {
        $sql = "UPDATE discounts SET code=?, type=?, amount=?, min_order=?, starts_at=?, ends_at=?, active=? WHERE id=?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ssddssii', $code, $type, $amount, $min_order, $starts_at, $ends_at, $active, $id);
        mysqli_stmt_execute($stmt);
    } else {
        $sql = "INSERT INTO discounts (code, type, amount, min_order, starts_at, ends_at, active) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 'ssddssi', $code, $type, $amount, $min_order, $starts_at, $ends_at, $active);
        mysqli_stmt_execute($stmt);
    }
    header("location: discounts.php");
    exit;
}

if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    mysqli_query($link, "DELETE FROM discounts WHERE id = $delete_id");
    header("location: discounts.php");
    exit;
}

$discounts = [];
$result = mysqli_query($link, "SELECT * FROM discounts ORDER BY created_at DESC");
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $discounts[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discounts - Maharaja Admin</title>
    <style>
        body { font-family: sans-serif; display:flex; margin:0; }
        .sidebar { width:250px; background:#2c3e50; color:#fff; min-height:100vh; padding:20px; }
        .sidebar a { display:block; color:#fff; text-decoration:none; padding:10px; }
        .content { flex:1; padding:20px; background:#f4f4f4; }
        form { background:#fff; padding:20px; border-radius:6px; margin-bottom:20px; max-width:700px; }
        input, select { width:100%; padding:8px; margin:6px 0; }
        table { width:100%; border-collapse:collapse; background:#fff; }
        th, td { padding:10px; border:1px solid #ddd; text-align:left; }
        th { background:#5B8A1D; color:#fff; }
        .btn { padding:8px 12px; background:#5B8A1D; color:#fff; text-decoration:none; border-radius:4px; border:0; cursor:pointer; }
        .btn-danger { background:#e74c3c; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Maharaja Admin</h2>
        <a href="index.php">Dashboard</a>
        <a href="products.php">Products</a>
        <a href="categories.php">Categories</a>
        <a href="orders.php">Orders</a>
        <a href="discounts.php">Discounts</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h2>Discounts</h2>
        <form method="post">
            <?php if ($editing): ?>
                <input type="hidden" name="id" value="<?php echo $edit_discount['id']; ?>">
            <?php endif; ?>
            <label>Code</label>
            <input type="text" name="code" required value="<?php echo htmlspecialchars($edit_discount['code'] ?? ''); ?>">

            <label>Type</label>
            <select name="type">
                <option value="percent" <?php if (($edit_discount['type'] ?? '') === 'percent') echo 'selected'; ?>>Percent</option>
                <option value="fixed" <?php if (($edit_discount['type'] ?? '') === 'fixed') echo 'selected'; ?>>Fixed</option>
            </select>

            <label>Amount</label>
            <input type="number" step="0.01" name="amount" required value="<?php echo htmlspecialchars($edit_discount['amount'] ?? ''); ?>">

            <label>Minimum Order (optional)</label>
            <input type="number" step="0.01" name="min_order" value="<?php echo htmlspecialchars($edit_discount['min_order'] ?? ''); ?>">

            <label>Start Date (optional)</label>
            <input type="datetime-local" name="starts_at" value="<?php echo $edit_discount['starts_at'] ? date('Y-m-d\TH:i', strtotime($edit_discount['starts_at'])) : ''; ?>">

            <label>End Date (optional)</label>
            <input type="datetime-local" name="ends_at" value="<?php echo $edit_discount['ends_at'] ? date('Y-m-d\TH:i', strtotime($edit_discount['ends_at'])) : ''; ?>">

            <label>
                <input type="checkbox" name="active" <?php echo ($edit_discount['active'] ?? 1) ? 'checked' : ''; ?>> Active
            </label>

            <button class="btn" type="submit"><?php echo $editing ? 'Update' : 'Create'; ?> Discount</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($discounts)): ?>
                    <tr><td colspan="6">No discounts found.</td></tr>
                <?php else: ?>
                    <?php foreach ($discounts as $discount): ?>
                        <tr>
                            <td><?php echo $discount['id']; ?></td>
                            <td><?php echo htmlspecialchars($discount['code']); ?></td>
                            <td><?php echo htmlspecialchars($discount['type']); ?></td>
                            <td><?php echo number_format($discount['amount'], 2); ?></td>
                            <td><?php echo $discount['active'] ? 'Yes' : 'No'; ?></td>
                            <td>
                                <a class="btn" href="discounts.php?edit=<?php echo $discount['id']; ?>">Edit</a>
                                <a class="btn btn-danger" href="discounts.php?delete=<?php echo $discount['id']; ?>" onclick="return confirm('Delete this discount?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
