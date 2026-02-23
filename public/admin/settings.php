<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();
require_once __DIR__ . '/../../config/database.php';

$page_title = 'Store Settings';
$success = '';
$error   = '';

// ── Load all settings into associative array ──────────────────────────────────
function get_settings($link): array {
    $s = [];
    $res = mysqli_query($link, "SELECT setting_key, setting_value FROM settings");
    while ($r = mysqli_fetch_assoc($res)) $s[$r['setting_key']] = $r['setting_value'];
    return $s;
}

function save_setting($link, string $key, string $value): void {
    $key   = mysqli_real_escape_string($link, $key);
    $value = mysqli_real_escape_string($link, $value);
    mysqli_query($link, "INSERT INTO settings (setting_key, setting_value)
        VALUES ('$key','$value')
        ON DUPLICATE KEY UPDATE setting_value = '$value'");
}

// ── Handle POST ───────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $section = $_POST['section'] ?? '';

    $keys = match($section) {
        'store' => ['store_name','store_address','store_city','store_phone','store_phone2','store_email'],
        'order' => ['free_delivery_threshold','tva_rate'],
        'smtp'  => ['smtp_host','smtp_port','smtp_user','smtp_pass','smtp_from_name','smtp_from_email','smtp_secure'],
        default => []
    };

    if (!empty($keys)) {
        foreach ($keys as $k) {
            $val = trim($_POST[$k] ?? '');
            save_setting($link, $k, $val);
        }
        $success = ucfirst($section) . ' settings saved successfully!';
    } else {
        $error = 'Unknown settings section.';
    }
}

$s = get_settings($link);

function sv(array $s, string $key, string $default = ''): string {
    return htmlspecialchars($s[$key] ?? $default);
}

include 'includes/header.php';
?>

<style>
.settings-grid{display:grid;gap:1.5rem;}
.settings-card{background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,.07);overflow:hidden;}
.settings-card-header{padding:1rem 1.5rem;border-bottom:1px solid #f3f4f6;display:flex;align-items:center;gap:.75rem;}
.settings-card-header h4{margin:0;font-size:1rem;}
.settings-card-header .icon{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.9rem;}
.settings-body{padding:1.5rem;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.form-grid-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;}
.form-group{display:flex;flex-direction:column;gap:.4rem;}
.form-group.full{grid-column:1/-1;}
.form-group label{font-weight:600;font-size:.82rem;color:#374151;}
.form-group input,.form-group select{padding:.65rem .85rem;border:1px solid #d1d5db;border-radius:.5rem;font-size:.875rem;width:100%;box-sizing:border-box;}
.form-group input:focus,.form-group select:focus{outline:none;border-color:var(--primary);box-shadow:0 0 0 3px rgba(91,138,29,.1);}
.form-group .hint{font-size:.75rem;color:#9ca3af;}
.btn-save{background:var(--primary);color:#fff;border:none;padding:.7rem 1.8rem;border-radius:.5rem;font-weight:700;cursor:pointer;font-size:.875rem;display:flex;align-items:center;gap:.5rem;}
.btn-save:hover{background:var(--secondary);}
.section-footer{padding:1rem 1.5rem;border-top:1px solid #f9fafb;display:flex;justify-content:flex-end;}
.alert-success{background:#d1fae5;color:#065f46;padding:.85rem 1rem;border-radius:8px;margin-bottom:1.5rem;font-weight:600;}
.alert-error{background:#fee2e2;color:#991b1b;padding:.85rem 1rem;border-radius:8px;margin-bottom:1.5rem;font-weight:600;}
@media(max-width:640px){.form-grid,.form-grid-3{grid-template-columns:1fr;} .form-group.full{grid-column:auto;}}
</style>

<?php if ($success): ?>
<div class="alert-success"><i class="fas fa-check-circle"></i> <?php echo $success; ?></div>
<?php endif; ?>
<?php if ($error): ?>
<div class="alert-error"><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></div>
<?php endif; ?>

<div class="settings-grid">

    <!-- ── 1. Store Info ─────────────────────────────────────────────────────── -->
    <div class="settings-card">
        <div class="settings-card-header">
            <div class="icon" style="background:#eff6ff;color:#1d4ed8;"><i class="fas fa-store"></i></div>
            <h4>Store Information</h4>
        </div>
        <form method="POST">
            <input type="hidden" name="section" value="store">
            <div class="settings-body">
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Store Name</label>
                        <input type="text" name="store_name" value="<?php echo sv($s,'store_name','Maharaja Supermarket'); ?>" required>
                    </div>
                    <div class="form-group full">
                        <label>Street Address</label>
                        <input type="text" name="store_address" value="<?php echo sv($s,'store_address'); ?>" placeholder="e.g. Str. Mihai Eminescu 12">
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="store_city" value="<?php echo sv($s,'store_city'); ?>" placeholder="e.g. Cluj-Napoca">
                    </div>
                    <div class="form-group">
                        <label>Store Email</label>
                        <input type="email" name="store_email" value="<?php echo sv($s,'store_email','admin@maharajasupermarket.ro'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Phone Number 1</label>
                        <input type="text" name="store_phone" value="<?php echo sv($s,'store_phone'); ?>" placeholder="+40 7xx xxx xxx">
                    </div>
                    <div class="form-group">
                        <label>Phone Number 2 <span style="color:#9ca3af;font-weight:400;">(optional)</span></label>
                        <input type="text" name="store_phone2" value="<?php echo sv($s,'store_phone2'); ?>" placeholder="+40 7xx xxx xxx">
                    </div>
                </div>
            </div>
            <div class="section-footer">
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Store Info</button>
            </div>
        </form>
    </div>

    <!-- ── 2. Order Settings ──────────────────────────────────────────────────── -->
    <div class="settings-card">
        <div class="settings-card-header">
            <div class="icon" style="background:#d1fae5;color:#065f46;"><i class="fas fa-shopping-cart"></i></div>
            <h4>Order & Tax Settings</h4>
        </div>
        <form method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="section" value="order">
            <div class="settings-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Free Delivery Threshold (RON)</label>
                        <input type="number" name="free_delivery_threshold" value="<?php echo sv($s,'free_delivery_threshold','199'); ?>" min="0" step="0.01">
                        <span class="hint">Orders above this amount get free delivery. Set 0 to always charge delivery.</span>
                    </div>
                    <div class="form-group">
                        <label>TVA Rate (%)</label>
                        <input type="number" name="tva_rate" value="<?php echo sv($s,'tva_rate','9'); ?>" min="0" max="100" step="0.1">
                        <span class="hint">Romanian VAT rate applied to orders (reduced rate for food = 9%).</span>
                    </div>
                </div>
            </div>
            <div class="section-footer">
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Order Settings</button>
            </div>
        </form>
    </div>

    <!-- ── 3. SMTP Email ──────────────────────────────────────────────────────── -->
    <div class="settings-card">
        <div class="settings-card-header">
            <div class="icon" style="background:#fef3c7;color:#92400e;"><i class="fas fa-envelope"></i></div>
            <h4>SMTP Email Settings</h4>
        </div>
        <form method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="section" value="smtp">
            <div class="settings-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>SMTP Host</label>
                        <input type="text" name="smtp_host" value="<?php echo sv($s,'smtp_host'); ?>" placeholder="e.g. smtp.gmail.com">
                    </div>
                    <div class="form-group">
                        <label>SMTP Port</label>
                        <input type="number" name="smtp_port" value="<?php echo sv($s,'smtp_port','587'); ?>" placeholder="587">
                    </div>
                    <div class="form-group">
                        <label>SMTP Username</label>
                        <input type="text" name="smtp_user" value="<?php echo sv($s,'smtp_user'); ?>" placeholder="your@email.com">
                    </div>
                    <div class="form-group">
                        <label>SMTP Password</label>
                        <input type="password" name="smtp_pass" value="<?php echo sv($s,'smtp_pass'); ?>" placeholder="••••••••">
                    </div>
                    <div class="form-group">
                        <label>From Name</label>
                        <input type="text" name="smtp_from_name" value="<?php echo sv($s,'smtp_from_name','Maharaja Supermarket'); ?>">
                    </div>
                    <div class="form-group">
                        <label>From Email</label>
                        <input type="email" name="smtp_from_email" value="<?php echo sv($s,'smtp_from_email','noreply@maharajasupermarket.ro'); ?>">
                    </div>
                    <div class="form-group">
                        <label>Encryption</label>
                        <select name="smtp_secure">
                            <option value="tls" <?php echo ($s['smtp_secure']??'tls')==='tls'?'selected':''; ?>>TLS (port 587) — Recommended</option>
                            <option value="ssl" <?php echo ($s['smtp_secure']??'')==='ssl'?'selected':''; ?>>SSL (port 465)</option>
                            <option value="" <?php echo ($s['smtp_secure']??'')===''?'selected':''; ?>>None</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="section-footer">
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save SMTP Settings</button>
            </div>
        </form>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
