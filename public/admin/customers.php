<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();

// Database Connection
if (file_exists(__DIR__ . '/../../config/database.php')) {
    require_once __DIR__ . '/../../config/database.php';
} elseif (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
} else {
    die("Database configuration not found.");
}

$page_title = 'Manage Customers';

// Fetch All Customers
$customers = [];
$res = mysqli_query($link, "SELECT id, name, email, phone, created_at FROM customers ORDER BY created_at DESC");
while ($row = mysqli_fetch_assoc($res)) {
    $customers[] = $row;
}

include 'includes/header.php';
?>

<div class="card">
    <div class="card-header">
        <h3>Customer Database</h3>
        <span class="badge" style="background: #f3f4f6; color: #4b5563;"><?php echo count($customers); ?> Registered Users</span>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Phone Number</th>
                    <th>Join Date</th>
                    <th>Activity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($customers)): ?>
                    <tr><td colspan="7" style="text-align:center; padding: 3rem; color: #6b7280;">No customers found in the system.</td></tr>
                <?php else: ?>
                    <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><strong>#<?php echo $customer['id']; ?></strong></td>
                        <td>
                            <div style="font-weight: 600; display: flex; align-items: center; gap: 8px;">
                                <div style="width: 32px; height: 32px; background: #eef2ff; color: #4f46e5; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;">
                                    <?php 
                                        $initials = '';
                                        $parts = explode(' ', $customer['name']);
                                        foreach($parts as $p) $initials .= strtoupper(substr($p, 0, 1));
                                        echo substr($initials, 0, 2);
                                    ?>
                                </div>
                                <?php echo htmlspecialchars($customer['name']); ?>
                            </div>
                        </td>
                        <td><a href="mailto:<?php echo htmlspecialchars($customer['email']); ?>" style="color: #4f46e5; text-decoration: none;"><?php echo htmlspecialchars($customer['email']); ?></a></td>
                        <td><?php echo htmlspecialchars($customer['phone']) ?: '<span style="color:#d1d5db;">N/A</span>'; ?></td>
                        <td><?php echo date('d M Y', strtotime($customer['created_at'])); ?></td>
                        <td>
                            <span class="badge" style="background: #d1fae5; color: #065f46;">Active</span>
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="customer_profile.php?id=<?php echo $customer['id']; ?>" class="btn-view" title="View Profile"><i class="fas fa-id-card"></i></a>
                                <a href="mailto:<?php echo htmlspecialchars($customer['email']); ?>" style="color: #6b7280;" title="Send Email"><i class="fas fa-envelope"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
