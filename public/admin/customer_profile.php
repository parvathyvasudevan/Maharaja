<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();
require_once __DIR__ . '/../../config/database.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: customers.php'); exit; }

// Fetch customer
$res = mysqli_query($link, "SELECT * FROM customers WHERE id = $id");
$customer = mysqli_fetch_assoc($res);
if (!$customer) { header('Location: customers.php'); exit; }

// Fetch order stats
$stats = mysqli_fetch_assoc(mysqli_query($link,
    "SELECT COUNT(*) as total_orders, COALESCE(SUM(total_amount),0) as total_spent
     FROM orders WHERE email = '" . mysqli_real_escape_string($link, $customer['email']) . "'"
));

// Fetch order history (match by email since orders table stores email directly)
$orders = [];
$res_o = mysqli_query($link,
    "SELECT * FROM orders WHERE email = '" . mysqli_real_escape_string($link, $customer['email']) . "'
     ORDER BY created_at DESC"
);
while ($row = mysqli_fetch_assoc($res_o)) {
    $orders[] = $row;
}

$page_title = 'Customer: ' . $customer['name'];
include 'includes/header.php';

// Initials for avatar
$initials = '';
foreach (explode(' ', $customer['name']) as $p) $initials .= strtoupper(substr($p, 0, 1));
$initials = substr($initials, 0, 2);

// Status color helper
function status_color(string $s): array {
    return [
        'pending'    => ['#fef3c7','#92400e'],
        'processing' => ['#dbeafe','#1e40af'],
        'shipped'    => ['#ede9fe','#5b21b6'],
        'completed'  => ['#d1fae5','#065f46'],
        'cancelled'  => ['#fee2e2','#991b1b'],
    ][$s] ?? ['#f3f4f6','#374151'];
}
?>

<style>
.profile-grid { display:grid; grid-template-columns:300px 1fr; gap:1.5rem; align-items:start; }
.profile-card { background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,.07); padding:2rem; text-align:center; }
.avatar { width:80px; height:80px; background:linear-gradient(135deg,var(--primary),#a3d65c); color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.8rem; font-weight:800; margin:0 auto 1rem; }
.profile-name { font-size:1.2rem; font-weight:700; margin-bottom:.25rem; }
.profile-email { color:#6b7280; font-size:.85rem; }
.profile-stats { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; margin-top:1.5rem; }
.stat-box { background:#f9fafb; border-radius:8px; padding:.75rem; }
.stat-box .val { font-size:1.3rem; font-weight:800; color:var(--primary); }
.stat-box .lbl { font-size:.75rem; color:#6b7280; }
.info-row { display:flex; align-items:center; gap:.75rem; padding:.65rem 0; border-bottom:1px solid #f3f4f6; font-size:.875rem; }
.info-row:last-child { border-bottom:none; }
.info-label { color:#6b7280; min-width:90px; }
.orders-card { background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,.07); overflow:hidden; }
.orders-card h4 { padding:1rem 1.5rem; margin:0; border-bottom:1px solid #f3f4f6; font-size:1rem; }
.order-row { display:grid; grid-template-columns:80px 1fr auto auto auto; gap:1rem; align-items:center; padding:.85rem 1.5rem; border-bottom:1px solid #f9fafb; font-size:.875rem; }
.order-row:last-child { border-bottom:none; }
.order-row:hover { background:#fafafa; }
@media(max-width:768px){ .profile-grid{grid-template-columns:1fr;} .order-row{grid-template-columns:1fr 1fr;} }
</style>

<div style="margin-bottom:1.5rem;">
    <a href="customers.php" style="color:var(--primary);font-weight:600;text-decoration:none;font-size:.875rem;">
        <i class="fas fa-arrow-left"></i> Back to Customers
    </a>
</div>

<div class="profile-grid">
    <!-- LEFT: Profile Card -->
    <div>
        <div class="profile-card">
            <div class="avatar"><?php echo $initials; ?></div>
            <div class="profile-name"><?php echo htmlspecialchars($customer['name']); ?></div>
            <div class="profile-email"><?php echo htmlspecialchars($customer['email']); ?></div>

            <div class="profile-stats">
                <div class="stat-box">
                    <div class="val"><?php echo $stats['total_orders']; ?></div>
                    <div class="lbl">Orders</div>
                </div>
                <div class="stat-box">
                    <div class="val"><?php echo number_format($stats['total_spent'], 0); ?></div>
                    <div class="lbl">RON Spent</div>
                </div>
            </div>
        </div>

        <div class="profile-card" style="margin-top:1rem;text-align:left;">
            <div style="font-weight:700;margin-bottom:1rem;font-size:.9rem;text-transform:uppercase;letter-spacing:.05em;color:#6b7280;">Account Details</div>
            <div class="info-row">
                <span class="info-label"><i class="fas fa-user" style="width:16px;"></i> Name</span>
                <span><?php echo htmlspecialchars($customer['name']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label"><i class="fas fa-envelope" style="width:16px;"></i> Email</span>
                <span><a href="mailto:<?php echo htmlspecialchars($customer['email']); ?>" style="color:var(--primary);"><?php echo htmlspecialchars($customer['email']); ?></a></span>
            </div>
            <div class="info-row">
                <span class="info-label"><i class="fas fa-phone" style="width:16px;"></i> Phone</span>
                <span><?php echo htmlspecialchars($customer['phone'] ?? 'N/A'); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label"><i class="fas fa-globe" style="width:16px;"></i> Language</span>
                <span><?php echo strtoupper($customer['preferred_lang'] ?? 'EN'); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label"><i class="fas fa-calendar" style="width:16px;"></i> Joined</span>
                <span><?php echo date('d M Y', strtotime($customer['created_at'])); ?></span>
            </div>
        </div>
    </div>

    <!-- RIGHT: Order History -->
    <div class="orders-card">
        <h4><i class="fas fa-shopping-bag" style="color:var(--primary);margin-right:8px;"></i>Order History
            <span style="font-weight:400;color:#6b7280;font-size:.85rem;margin-left:8px;">(<?php echo count($orders); ?> orders)</span>
        </h4>

        <?php if (empty($orders)): ?>
        <div style="padding:3rem;text-align:center;color:#6b7280;">
            <i class="fas fa-box-open" style="font-size:2rem;margin-bottom:.75rem;display:block;opacity:.3;"></i>
            This customer has no orders yet.
        </div>
        <?php else: ?>

        <!-- Header row -->
        <div class="order-row" style="background:#f9fafb;font-size:.75rem;text-transform:uppercase;letter-spacing:.05em;color:#6b7280;font-weight:700;">
            <span>Order #</span>
            <span>Date</span>
            <span>Items</span>
            <span>Status</span>
            <span>Total</span>
        </div>

        <?php foreach ($orders as $o):
            // Item count for this order
            $ic = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as c FROM order_items WHERE order_id = {$o['id']}"));
            $item_count = $ic['c'] ?? 0;
            [$sbg, $sc] = status_color($o['status']);
        ?>
        <div class="order-row">
            <span><a href="order_detail.php?id=<?php echo $o['id']; ?>" style="font-weight:700;color:var(--primary);text-decoration:none;">#<?php echo $o['id']; ?></a></span>
            <span style="color:#6b7280;"><?php echo date('d M Y', strtotime($o['created_at'])); ?></span>
            <span style="color:#6b7280;"><?php echo $item_count; ?> item<?php echo $item_count!=1?'s':''; ?></span>
            <span>
                <span style="background:<?php echo $sbg; ?>;color:<?php echo $sc; ?>;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;">
                    <?php echo $o['status']; ?>
                </span>
            </span>
            <span style="font-weight:700;color:var(--primary);"><?php echo number_format($o['total_amount'], 2); ?> RON</span>
        </div>
        <?php endforeach; ?>

        <!-- Summary row -->
        <div style="padding:1rem 1.5rem;border-top:2px solid #f3f4f6;display:flex;justify-content:space-between;align-items:center;">
            <span style="font-size:.85rem;color:#6b7280;">Lifetime value</span>
            <strong style="font-size:1.1rem;color:var(--primary);"><?php echo number_format($stats['total_spent'], 2); ?> RON</strong>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
