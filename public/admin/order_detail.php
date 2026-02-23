<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();
require_once __DIR__ . '/../../config/database.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: orders.php'); exit; }

// ── Update status ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    verify_csrf();
    $new_status = mysqli_real_escape_string($link, $_POST['status']);
    $allowed = ['pending','processing','shipped','completed','cancelled'];
    if (in_array($new_status, $allowed)) {
        $stmt = mysqli_prepare($link, "UPDATE orders SET status = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'si', $new_status, $id);
        mysqli_stmt_execute($stmt);
    }
    header("Location: order_detail.php?id=$id&updated=1");
    exit;
}

// ── Fetch order ───────────────────────────────────────────────────────────────
$res = mysqli_query($link, "SELECT * FROM orders WHERE id = $id");
$order = mysqli_fetch_assoc($res);
if (!$order) { header('Location: orders.php'); exit; }

// ── Fetch items ───────────────────────────────────────────────────────────────
$items = [];
$res_i = mysqli_query($link, "SELECT oi.*, p.title_en as product_name, p.image as product_image
    FROM order_items oi
    LEFT JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = $id");
while ($row = mysqli_fetch_assoc($res_i)) {
    $items[] = $row;
}

// ── Status color ──────────────────────────────────────────────────────────────
$status_colors = [
    'pending'    => ['fef3c7','92400e'],
    'processing' => ['dbeafe','1e40af'],
    'shipped'    => ['ede9fe','5b21b6'],
    'completed'  => ['d1fae5','065f46'],
    'cancelled'  => ['fee2e2','991b1b'],
];
[$sbg, $sc] = $status_colors[$order['status']] ?? ['f3f4f6','374151'];

$page_title = 'Order #' . $id;
include 'includes/header.php';
?>

<style>
@media print {
    .sidebar, header, .filter-bar, .btn-back, .no-print, .nav-links { display:none !important; }
    .main-wrapper { margin:0 !important; }
    .invoice-box { box-shadow:none !important; border:none !important; padding:0 !important; }
    body { background:#fff !important; }
}
.invoice-box { background:#fff; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.07); padding:2rem; }
.inv-header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:2rem; flex-wrap:wrap; gap:1rem; }
.inv-logo { font-size:1.6rem; font-weight:800; color:var(--primary); }
.inv-meta { text-align:right; }
.inv-meta h2 { font-size:1.3rem; margin:0 0 .3rem; }
.inv-meta p { margin:0; color:#6b7280; font-size:.875rem; }
.info-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:2rem; }
.info-box { background:#f9fafb; border-radius:8px; padding:1rem 1.25rem; }
.info-box h4 { margin:0 0 .6rem; font-size:.8rem; text-transform:uppercase; letter-spacing:.05em; color:#6b7280; }
.info-box p { margin:0; font-size:.875rem; line-height:1.7; }
.items-table { width:100%; border-collapse:collapse; margin-bottom:1.5rem; }
.items-table th { background:#f9fafb; padding:.75rem 1rem; text-align:left; font-size:.75rem; text-transform:uppercase; letter-spacing:.05em; color:#6b7280; }
.items-table td { padding:.75rem 1rem; border-bottom:1px solid #f3f4f6; font-size:.875rem; }
.items-table tr:last-child td { border-bottom:none; }
.totals-box { max-width:320px; margin-left:auto; }
.totals-row { display:flex; justify-content:space-between; padding:.4rem 0; font-size:.9rem; }
.totals-row.grand { border-top:2px solid #111; margin-top:.5rem; padding-top:.75rem; font-size:1.1rem; font-weight:800; }
.status-badge { padding:4px 14px; border-radius:20px; font-size:11px; font-weight:700; text-transform:uppercase; }
.prod-thumb { width:36px; height:36px; object-fit:cover; border-radius:4px; vertical-align:middle; margin-right:8px; }
.prod-thumb-ph { display:inline-block; width:36px; height:36px; background:#f3f4f6; border-radius:4px; vertical-align:middle; margin-right:8px; }
.action-bar { display:flex; gap:10px; flex-wrap:wrap; margin-bottom:1.5rem; align-items:center; }
.btn-print { background:var(--primary); color:#fff; border:none; padding:8px 18px; border-radius:8px; font-weight:700; cursor:pointer; font-size:.875rem; display:flex; align-items:center; gap:6px; }
.btn-print:hover { background:var(--secondary); }
.btn-back { color:var(--primary); font-weight:600; font-size:.875rem; text-decoration:none; display:flex; align-items:center; gap:5px; }
</style>

<div class="action-bar no-print">
    <a href="orders.php" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Orders</a>
    <div style="margin-left:auto; display:flex; gap:10px; align-items:center;">
        <!-- Quick status update -->
        <form method="POST" style="display:flex; align-items:center; gap:8px;">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="update_status" value="1">
            <label style="font-size:.875rem;font-weight:600;">Status:</label>
            <select name="status" style="padding:6px 12px;border-radius:8px;border:1px solid #d1d5db;font-size:.875rem;font-weight:600;">
                <?php foreach (['pending','processing','shipped','completed','cancelled'] as $st): ?>
                <option value="<?php echo $st; ?>" <?php echo $st==$order['status']?'selected':''; ?>><?php echo ucfirst($st); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn-print" style="padding:6px 14px;"><i class="fas fa-save"></i> Save</button>
        </form>
        <button onclick="window.print()" class="btn-print"><i class="fas fa-print"></i> Print Invoice</button>
    </div>
</div>

<?php if (isset($_GET['updated'])): ?>
<div style="background:#d1fae5;color:#065f46;padding:.75rem 1rem;border-radius:8px;margin-bottom:1rem;font-weight:600;" class="no-print">
    <i class="fas fa-check-circle"></i> Order status updated successfully.
</div>
<?php endif; ?>

<div class="invoice-box">
    <!-- Invoice Header -->
    <div class="inv-header">
        <div>
            <div class="inv-logo">🛒 Maharaja Supermarket</div>
            <p style="margin:.4rem 0 0;color:#6b7280;font-size:.85rem;">Fresh & Authentic Indian & Romanian Food</p>
        </div>
        <div class="inv-meta">
            <h2>INVOICE</h2>
            <p>Order #<?php echo $id; ?></p>
            <p>Date: <?php echo date('d M Y', strtotime($order['created_at'])); ?></p>
            <p style="margin-top:.5rem;">
                <span class="status-badge" style="background:#<?php echo $sbg; ?>;color:#<?php echo $sc; ?>;">
                    <?php echo strtoupper($order['status']); ?>
                </span>
            </p>
        </div>
    </div>

    <!-- Customer & Shipping Info -->
    <div class="info-grid">
        <div class="info-box">
            <h4>Customer</h4>
            <p>
            <strong><?php echo htmlspecialchars($order['name'] ?? 'Guest'); ?></strong><br>
                <?php echo htmlspecialchars($order['email'] ?? ''); ?><br>
                <?php echo htmlspecialchars($order['phone'] ?? ''); ?>
            </p>
        </div>
        <div class="info-box">
            <h4>Delivery Address</h4>
            <p>
                <?php
                $addr_parts = array_filter([
                    $order['address']  ?? '',
                    $order['city']     ?? '',
                    $order['postcode'] ?? '',
                    $order['country']  ?? '',
                ]);
                echo $addr_parts ? implode('<br>', array_map('htmlspecialchars', $addr_parts)) : 'N/A';
                ?>
            </p>
        </div>
        <div class="info-box">
            <h4>Order Info</h4>
            <p>
                Placed: <?php echo date('d M Y, H:i', strtotime($order['created_at'])); ?><br>
                Payment: <strong><?php echo strtoupper(htmlspecialchars($order['payment_method'] ?? '-')); ?></strong><br>
                <?php if (!empty($order['notes'])): ?>
                Note: <?php echo htmlspecialchars($order['notes']); ?>
                <?php endif; ?>
            </p>
        </div>
        <div class="info-box" style="background:#f0fdf4;">
            <h4>Order Total</h4>
            <p style="font-size:1.5rem;font-weight:800;color:var(--primary);">
                <?php echo number_format($order['total_amount'], 2); ?> RON
            </p>
        </div>
    </div>

    <!-- Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Unit Price</th>
                <th>Qty</th>
                <th style="text-align:right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($items)): ?>
            <tr><td colspan="5" style="text-align:center;color:#6b7280;padding:2rem;">No items found for this order.</td></tr>
            <?php else: ?>
            <?php foreach ($items as $i => $item): ?>
            <tr>
                <td style="color:#6b7280;"><?php echo $i+1; ?></td>
                <td>
                    <?php if (!empty($item['product_image'])): ?>
                    <img src="/uploads/<?php echo htmlspecialchars($item['product_image']); ?>" class="prod-thumb no-print">
                    <?php else: ?>
                    <span class="prod-thumb-ph no-print"></span>
                    <?php endif; ?>
                    <strong><?php echo htmlspecialchars($item['product_name'] ?? 'Deleted Product'); ?></strong>
                    <?php if (!empty($item['sku'])): ?>
                    <br><span style="font-size:11px;color:#6b7280;">SKU: <?php echo $item['sku']; ?></span>
                    <?php endif; ?>
                </td>
                <td><?php echo number_format($item['price'], 2); ?> RON</td>
                <td><?php echo $item['quantity']; ?></td>
                <td style="text-align:right;font-weight:700;">
                    <?php echo number_format($item['price'] * $item['quantity'], 2); ?> RON
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Totals -->
    <div class="totals-box">
        <?php
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $items));
        $shipping = ($order['total_amount'] - $subtotal);
        ?>
        <div class="totals-row">
            <span>Subtotal</span>
            <span><?php echo number_format($subtotal, 2); ?> RON</span>
        </div>
        <?php if (abs($shipping) > 0.01): ?>
        <div class="totals-row">
            <span>Shipping / Other</span>
            <span><?php echo number_format($shipping, 2); ?> RON</span>
        </div>
        <?php endif; ?>
        <div class="totals-row grand">
            <span>TOTAL</span>
            <span><?php echo number_format($order['total_amount'], 2); ?> RON</span>
        </div>
    </div>

    <!-- Footer -->
    <div style="margin-top:3rem;border-top:1px solid #f3f4f6;padding-top:1rem;text-align:center;color:#9ca3af;font-size:.75rem;">
        Thank you for shopping at Maharaja Supermarket! &nbsp;|&nbsp; Generated on <?php echo date('d M Y H:i'); ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
