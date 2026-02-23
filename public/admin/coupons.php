<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();
require_once __DIR__ . '/../../config/database.php';

$page_title = 'Manage Coupons';
$error   = '';
$success = '';

// ── Handle POST ───────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = $_POST['action'] ?? '';

    // Toggle active status
    if ($action === 'toggle') {
        $cid = (int)$_POST['coupon_id'];
        mysqli_query($link, "UPDATE coupons SET is_active = !is_active WHERE id = $cid");
        header('Location: coupons.php?success=toggled');
        exit;
    }

    // Delete
    if ($action === 'delete') {
        $cid = (int)$_POST['coupon_id'];
        mysqli_query($link, "DELETE FROM coupons WHERE id = $cid");
        header('Location: coupons.php?success=deleted');
        exit;
    }

    // Add / Edit
    if ($action === 'add' || $action === 'edit') {
        $cid        = (int)($_POST['coupon_id'] ?? 0);
        $code       = strtoupper(trim($_POST['code'] ?? ''));
        $type       = in_array($_POST['type'], ['percentage','fixed']) ? $_POST['type'] : 'percentage';
        $value      = (float)($_POST['value'] ?? 0);
        $min_order  = (float)($_POST['min_order'] ?? 0);
        $max_uses   = $_POST['max_uses'] !== '' ? (int)$_POST['max_uses'] : null;
        $expires_at = !empty($_POST['expires_at']) ? $_POST['expires_at'] : null;
        $is_active  = isset($_POST['is_active']) ? 1 : 0;

        if ($code === '') $error = 'Coupon code is required.';
        elseif ($value <= 0) $error = 'Discount value must be greater than 0.';
        elseif ($type === 'percentage' && $value > 100) $error = 'Percentage cannot exceed 100.';

        if (!$error) {
            // Check duplicate code (ignore current row when editing)
            $esc_code = mysqli_real_escape_string($link, $code);
            $dup = mysqli_fetch_assoc(mysqli_query($link,
                "SELECT id FROM coupons WHERE code='$esc_code'" . ($action==='edit' ? " AND id <> $cid" : '')
            ));
            if ($dup) $error = "Coupon code \"$code\" already exists.";
        }

        if (!$error) {
            $max_uses_sql = $max_uses !== null ? $max_uses : 'NULL';
            $exp_sql      = $expires_at ? "'$expires_at'" : 'NULL';
            $esc_code     = mysqli_real_escape_string($link, $code);

            if ($action === 'add') {
                mysqli_query($link,
                    "INSERT INTO coupons (code,type,value,min_order,max_uses,expires_at,is_active)
                     VALUES ('$esc_code','$type',$value,$min_order,$max_uses_sql,$exp_sql,$is_active)"
                );
            } else {
                mysqli_query($link,
                    "UPDATE coupons SET code='$esc_code',type='$type',value=$value,
                     min_order=$min_order,max_uses=$max_uses_sql,expires_at=$exp_sql,
                     is_active=$is_active WHERE id=$cid"
                );
            }
            header('Location: coupons.php?success=' . ($action==='add'?'added':'updated'));
            exit;
        }
    }
}

// ── Fetch all coupons ─────────────────────────────────────────────────────────
$coupons = [];
$res = mysqli_query($link, "SELECT * FROM coupons ORDER BY created_at DESC");
while ($row = mysqli_fetch_assoc($res)) $coupons[] = $row;

// ── Edit prefill ──────────────────────────────────────────────────────────────
$edit = null;
if (isset($_GET['edit'])) {
    $eid = (int)$_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM coupons WHERE id=$eid"));
}

include 'includes/header.php';
?>

<style>
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:1000;align-items:center;justify-content:center;}
.modal-overlay.open{display:flex;}
.modal-box{background:#fff;border-radius:1rem;padding:2rem;width:100%;max-width:540px;position:relative;max-height:90vh;overflow-y:auto;}
.modal-close{position:absolute;top:1rem;right:1rem;background:none;border:none;font-size:1.4rem;cursor:pointer;color:#6b7280;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.form-group{margin-bottom:1rem;}
.form-group label{display:block;font-weight:600;margin-bottom:.4rem;font-size:.85rem;color:#374151;}
.form-group input,.form-group select{width:100%;padding:.65rem .85rem;border:1px solid #d1d5db;border-radius:.5rem;font-size:.875rem;box-sizing:border-box;}
.form-group input:focus,.form-group select:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 3px rgba(91,138,29,.1);}
.toggle-pill{position:relative;display:inline-block;width:44px;height:24px;}
.toggle-pill input{opacity:0;width:0;height:0;}
.toggle-pill .slider{position:absolute;cursor:pointer;inset:0;background:#d1d5db;border-radius:24px;transition:.3s;}
.toggle-pill .slider:before{content:'';position:absolute;height:18px;width:18px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:.3s;}
.toggle-pill input:checked+.slider{background:var(--primary);}
.toggle-pill input:checked+.slider:before{transform:translateX(20px);}
.badge-type{padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;}
.btn-icon{background:none;border:none;cursor:pointer;font-size:15px;padding:4px;}
.coupon-code{font-family:monospace;font-size:.9rem;background:#f3f4f6;padding:3px 10px;border-radius:6px;letter-spacing:.05em;font-weight:700;}
.expired-row{opacity:.55;}
</style>

<?php if (isset($_GET['success'])): 
    $msgs = ['added'=>'Coupon created!','updated'=>'Coupon updated!','deleted'=>'Coupon deleted.','toggled'=>'Status toggled.'];
    $is_del = $_GET['success']==='deleted';
?>
<div style="background:<?php echo $is_del?'#fee2e2':'#d1fae5';?>;color:<?php echo $is_del?'#991b1b':'#065f46';?>;padding:.85rem 1rem;border-radius:8px;margin-bottom:1.5rem;font-weight:600;">
    <i class="fas fa-<?php echo $is_del?'trash':'check-circle';?>"></i>
    <?php echo $msgs[$_GET['success']] ?? 'Done.'; ?>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div style="background:#fee2e2;color:#991b1b;padding:.85rem 1rem;border-radius:8px;margin-bottom:1.5rem;font-weight:600;">
    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h3>Discount Coupons</h3>
        <div style="display:flex;gap:10px;align-items:center;">
            <span class="badge" style="background:#f3f4f6;color:#4b5563;"><?php echo count($coupons); ?> Total</span>
            <button onclick="openModal()" class="btn-primary-sm" style="background:var(--primary);color:#fff;border:none;padding:8px 18px;border-radius:8px;font-weight:700;cursor:pointer;font-size:.875rem;">
                <i class="fas fa-plus"></i> Create Coupon
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Discount</th>
                    <th>Min. Order</th>
                    <th>Uses</th>
                    <th>Expires</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($coupons)): ?>
                <tr><td colspan="7" style="text-align:center;padding:3rem;color:#6b7280;">No coupons yet. Create your first one!</td></tr>
                <?php else: ?>
                <?php foreach ($coupons as $cp):
                    $is_expired = $cp['expires_at'] && strtotime($cp['expires_at']) < strtotime('today');
                    $uses_left  = $cp['max_uses'] !== null ? ($cp['max_uses'] - $cp['used_count']) : '∞';
                ?>
                <tr class="<?php echo $is_expired ? 'expired-row' : ''; ?>">
                    <td>
                        <span class="coupon-code"><?php echo htmlspecialchars($cp['code']); ?></span>
                        <?php if ($is_expired): ?><span style="font-size:10px;color:#ef4444;margin-left:6px;font-weight:600;">EXPIRED</span><?php endif; ?>
                    </td>
                    <td>
                        <?php if ($cp['type']==='percentage'): ?>
                            <span class="badge-type" style="background:#eff6ff;color:#1d4ed8;"><?php echo $cp['value']; ?>% OFF</span>
                        <?php else: ?>
                            <span class="badge-type" style="background:#fef3c7;color:#92400e;"><?php echo number_format($cp['value'],2); ?> RON</span>
                        <?php endif; ?>
                    </td>
                    <td style="color:#6b7280;">
                        <?php echo $cp['min_order'] > 0 ? number_format($cp['min_order'],2).' RON' : '<span style="color:#d1d5db;">None</span>'; ?>
                    </td>
                    <td style="font-size:.875rem;">
                        <span style="font-weight:700;"><?php echo $cp['used_count']; ?></span>
                        <span style="color:#6b7280;"> / <?php echo $cp['max_uses'] ?? '∞'; ?></span>
                    </td>
                    <td style="font-size:.875rem;color:#6b7280;">
                        <?php echo $cp['expires_at'] ? date('d M Y', strtotime($cp['expires_at'])) : '<span style="color:#d1d5db;">Never</span>'; ?>
                    </td>
                    <td>
                        <!-- Toggle pill -->
                        <form method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="action" value="toggle">
                            <input type="hidden" name="coupon_id" value="<?php echo $cp['id']; ?>">
                            <label class="toggle-pill" title="<?php echo $cp['is_active']?'Active — click to disable':'Inactive — click to enable'; ?>">
                                <input type="checkbox" <?php echo $cp['is_active']?'checked':''; ?> onchange="this.closest('form').submit()">
                                <span class="slider"></span>
                            </label>
                        </form>
                    </td>
                    <td>
                        <div style="display:flex;gap:8px;">
                            <button class="btn-icon" style="color:var(--primary);" onclick='openEditModal(<?php echo json_encode($cp); ?>)' title="Edit"><i class="fas fa-edit"></i></button>
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Delete coupon <?php echo htmlspecialchars($cp['code']); ?>?');">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="coupon_id" value="<?php echo $cp['id']; ?>">
                                <button type="submit" class="btn-icon" style="color:#ef4444;" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add / Edit Modal -->
<div class="modal-overlay" id="couponModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeModal()">&#x2715;</button>
        <h3 id="modalTitle" style="margin:0 0 1.5rem;font-size:1.15rem;">Create Coupon</h3>

        <form method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="hidden" name="coupon_id" id="formCouponId" value="0">

            <div class="form-group">
                <label>Coupon Code *</label>
                <input type="text" name="code" id="inputCode" required placeholder="e.g. SAVE20" style="text-transform:uppercase;">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Discount Type *</label>
                    <select name="type" id="inputType">
                        <option value="percentage">Percentage (%)</option>
                        <option value="fixed">Fixed Amount (RON)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Discount Value *</label>
                    <input type="number" name="value" id="inputValue" step="0.01" min="0.01" required placeholder="e.g. 20">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Min. Order Amount (RON)</label>
                    <input type="number" name="min_order" id="inputMinOrder" step="0.01" min="0" value="0" placeholder="0 = no minimum">
                </div>
                <div class="form-group">
                    <label>Max Uses</label>
                    <input type="number" name="max_uses" id="inputMaxUses" min="1" placeholder="Leave blank = unlimited">
                </div>
            </div>

            <div class="form-group">
                <label>Expiry Date</label>
                <input type="date" name="expires_at" id="inputExpiry">
            </div>

            <div class="form-group" style="display:flex;align-items:center;gap:10px;">
                <label class="toggle-pill" style="margin:0;">
                    <input type="checkbox" name="is_active" id="inputActive" checked>
                    <span class="slider"></span>
                </label>
                <span style="font-size:.875rem;font-weight:600;">Active (usable by customers)</span>
            </div>

            <button type="submit" style="width:100%;padding:.85rem;background:var(--primary);color:#fff;border:none;border-radius:.5rem;font-weight:700;cursor:pointer;font-size:.95rem;margin-top:.5rem;">
                <i class="fas fa-save"></i> Save Coupon
            </button>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modalTitle').textContent = 'Create Coupon';
    document.getElementById('formAction').value = 'add';
    document.getElementById('formCouponId').value = '0';
    document.getElementById('inputCode').value = '';
    document.getElementById('inputType').value = 'percentage';
    document.getElementById('inputValue').value = '';
    document.getElementById('inputMinOrder').value = '0';
    document.getElementById('inputMaxUses').value = '';
    document.getElementById('inputExpiry').value = '';
    document.getElementById('inputActive').checked = true;
    document.getElementById('couponModal').classList.add('open');
}

function openEditModal(cp) {
    document.getElementById('modalTitle').textContent = 'Edit Coupon';
    document.getElementById('formAction').value = 'edit';
    document.getElementById('formCouponId').value = cp.id;
    document.getElementById('inputCode').value = cp.code;
    document.getElementById('inputType').value = cp.type;
    document.getElementById('inputValue').value = cp.value;
    document.getElementById('inputMinOrder').value = cp.min_order;
    document.getElementById('inputMaxUses').value = cp.max_uses || '';
    document.getElementById('inputExpiry').value = cp.expires_at || '';
    document.getElementById('inputActive').checked = cp.is_active == 1;
    document.getElementById('couponModal').classList.add('open');
}

function closeModal() {
    document.getElementById('couponModal').classList.remove('open');
}

document.getElementById('couponModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Auto-uppercase coupon code
document.getElementById('inputCode').addEventListener('input', function() {
    this.value = this.value.toUpperCase();
});

<?php if ($edit): ?>
openEditModal(<?php echo json_encode($edit); ?>);
<?php endif; ?>
</script>

<?php include 'includes/footer.php'; ?>
