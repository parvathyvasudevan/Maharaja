<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();

require_once __DIR__ . '/../../config/database.php';

$page_title = 'Manage Orders';

// ── Status update ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    verify_csrf();
    $order_id   = (int)$_POST['order_id'];
    $new_status = mysqli_real_escape_string($link, $_POST['status']);
    $allowed   = ['pending','processing','shipped','completed','cancelled'];
    if (in_array($new_status, $allowed)) {
        $stmt = mysqli_prepare($link, "UPDATE orders SET status = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'si', $new_status, $order_id);
        mysqli_stmt_execute($stmt);
    }
    header('Location: orders.php' . (isset($_GET['status']) ? '?status=' . urlencode($_GET['status']) : ''));
    exit;
}

// ── Filter ────────────────────────────────────────────────────────────────────
$filter_status = $_GET['status'] ?? '';
$allowed_filters = ['','pending','processing','shipped','completed','cancelled'];
if (!in_array($filter_status, $allowed_filters)) $filter_status = '';

$where = $filter_status ? "WHERE status = '" . mysqli_real_escape_string($link, $filter_status) . "'" : '';

// ── Counts per status for the filter bar ─────────────────────────────────────
$counts = ['all' => 0];
$res_c = mysqli_query($link, "SELECT status, COUNT(*) as cnt FROM orders GROUP BY status");
while ($rc = mysqli_fetch_assoc($res_c)) {
    $counts[$rc['status']] = (int)$rc['cnt'];
    $counts['all'] += (int)$rc['cnt'];
}

// ── Fetch orders ──────────────────────────────────────────────────────────────
$orders = [];
$sql = "SELECT * FROM orders $where ORDER BY created_at DESC";
$res = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $orders[] = $row;
}

// ── Status color helper ───────────────────────────────────────────────────────
function status_badge(string $s): string {
    $map = [
        'pending'    => ['#fef3c7','#92400e'],
        'processing' => ['#dbeafe','#1e40af'],
        'shipped'    => ['#ede9fe','#5b21b6'],
        'completed'  => ['#d1fae5','#065f46'],
        'cancelled'  => ['#fee2e2','#991b1b'],
    ];
    [$bg, $color] = $map[$s] ?? ['#f3f4f6','#374151'];
    return "<span style=\"background:$bg;color:$color;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;\">$s</span>";
}

include 'includes/header.php';
?>

<style>
.filter-bar { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:1.5rem; }
.filter-btn { padding:6px 16px; border-radius:20px; border:1.5px solid #d1d5db; background:#fff; font-size:13px; font-weight:600; cursor:pointer; text-decoration:none; color:#374151; transition:all .15s; }
.filter-btn:hover,.filter-btn.active { background:var(--primary); color:#fff; border-color:var(--primary); }
.filter-btn .count { display:inline-block; background:rgba(0,0,0,.12); border-radius:10px; padding:0 6px; font-size:11px; margin-left:4px; }
.btn-view { color:var(--primary); font-size:15px; }
.btn-view:hover { color:var(--secondary); }
</style>

<!-- Status filter pills -->
<div class="filter-bar">
    <?php
    $labels = [''=>'All','pending'=>'Pending','processing'=>'Processing','shipped'=>'Shipped','completed'=>'Completed','cancelled'=>'Cancelled'];
    foreach ($labels as $val => $label):
        $is_active = ($filter_status === $val) ? 'active' : '';
        $cnt = ($val === '') ? ($counts['all'] ?? 0) : ($counts[$val] ?? 0);
        $url = $val ? '?status=' . urlencode($val) : 'orders.php';
    ?>
    <a href="<?php echo $url; ?>" class="filter-btn <?php echo $is_active; ?>">
        <?php echo $label; ?> <span class="count"><?php echo $cnt; ?></span>
    </a>
    <?php endforeach; ?>
</div>

<div class="card">
    <div class="card-header">
        <h3><?php echo $filter_status ? ucfirst($filter_status) . ' Orders' : 'All Orders'; ?></h3>
        <span class="badge" style="background:#f3f4f6;color:#4b5563;"><?php echo count($orders); ?> orders</span>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total (RON)</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr><td colspan="8" style="text-align:center;padding:3rem;color:#6b7280;">No orders found.</td></tr>
                <?php else: ?>
                    <?php foreach ($orders as $o): 
                        // Item count
                        $ic = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(*) as c FROM order_items WHERE order_id = {$o['id']}"));
                        $item_count = $ic['c'] ?? 0;
                    ?>
                    <tr>
                        <td><strong>#<?php echo $o['id']; ?></strong></td>
                        <td>
                            <strong><?php echo htmlspecialchars($o['name'] ?? 'Guest'); ?></strong><br>
                            <span style="font-size:12px;color:#6b7280;"><?php echo htmlspecialchars($o['email'] ?? ''); ?></span>
                        </td>
                        <td><span style="font-size:13px;color:#6b7280;"><?php echo $item_count; ?> item<?php echo $item_count!=1?'s':''; ?></span></td>
                        <td><strong style="color:var(--primary);"><?php echo number_format($o['total_amount'], 2); ?> RON</strong></td>
                        <td><span style="text-transform:uppercase;font-size:11px;font-weight:700;color:#71717a;"><?php echo htmlspecialchars($o['payment_method'] ?? '-'); ?></span></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                <input type="hidden" name="update_status" value="1">
                                <select name="status" onchange="this.form.submit()" style="padding:4px 8px;border-radius:6px;border:1px solid #d1d5db;font-size:13px;font-weight:600;cursor:pointer;">
                                    <?php foreach (['pending','processing','shipped','completed','cancelled'] as $st): ?>
                                    <option value="<?php echo $st; ?>" <?php echo $st==$o['status']?'selected':''; ?>><?php echo ucfirst($st); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </td>
                        <td style="white-space:nowrap;font-size:13px;"><?php echo date('d M Y, H:i', strtotime($o['created_at'])); ?></td>
                        <td style="white-space:nowrap;">
                            <a href="order_detail.php?id=<?php echo $o['id']; ?>" class="btn-view" title="View Details"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
