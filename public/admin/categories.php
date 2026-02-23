<?php
require_once __DIR__ . '/auth_check.php';
require_admin_login();

if (file_exists(__DIR__ . '/../../config/database.php')) {
    require_once __DIR__ . '/../../config/database.php';
} else {
    die("Database configuration not found.");
}

$page_title = 'Manage Categories';
$success = '';
$error   = '';

// ─── Helpers ──────────────────────────────────────────────────────────────────
function slugify(string $text): string {
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

function upload_category_image(array $file): ?string {
    // Delegated to secure_upload() in auth_check.php
    $result = secure_upload($file, __DIR__ . '/../uploads/', 'cat_');
    return $result['ok'] ? $result['filename'] : null;
}

// ─── Handle POST ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action   = $_POST['action'] ?? '';
    $name_en  = clean($_POST['name_en'] ?? '');
    $name_ro  = clean($_POST['name_ro'] ?? '');
    $cat_id   = clean_int($_POST['cat_id'] ?? 0);

    if ($action === 'add' || $action === 'edit') {
        if ($name_en === '' || $name_ro === '') {
            $error = 'Both English and Romanian names are required.';
        } else {
            $slug       = slugify($name_en);
            $image_name = null;

            if (!empty($_FILES['image']['name'])) {
                $image_name = upload_category_image($_FILES['image']);
                if ($image_name === null) {
                    $error = 'Invalid image file. Allowed: jpg, png, gif, webp.';
                }
            }

            if (!$error) {
                if ($action === 'add') {
                    // Make slug unique
                    $base_slug = $slug;
                    $n = 1;
                    while (true) {
                        $chk = mysqli_query($link, "SELECT id FROM categories WHERE slug = '" . mysqli_real_escape_string($link, $slug) . "'");
                        if (!mysqli_fetch_assoc($chk)) break;
                        $slug = $base_slug . '-' . $n++;
                    }
                    if ($image_name) {
                        $stmt = mysqli_prepare($link, "INSERT INTO categories (name_en, name_ro, slug, image) VALUES (?,?,?,?)");
                        mysqli_stmt_bind_param($stmt, 'ssss', $name_en, $name_ro, $slug, $image_name);
                    } else {
                        $stmt = mysqli_prepare($link, "INSERT INTO categories (name_en, name_ro, slug) VALUES (?,?,?)");
                        mysqli_stmt_bind_param($stmt, 'sss', $name_en, $name_ro, $slug);
                    }
                } else {
                    // Edit — only update image if a new one was uploaded
                    if ($image_name) {
                        $stmt = mysqli_prepare($link, "UPDATE categories SET name_en=?, name_ro=?, slug=?, image=? WHERE id=?");
                        mysqli_stmt_bind_param($stmt, 'ssssi', $name_en, $name_ro, $slug, $image_name, $cat_id);
                    } else {
                        $stmt = mysqli_prepare($link, "UPDATE categories SET name_en=?, name_ro=?, slug=? WHERE id=?");
                        mysqli_stmt_bind_param($stmt, 'sssi', $name_en, $name_ro, $slug, $cat_id);
                    }
                }
                if (mysqli_stmt_execute($stmt)) {
                    header('Location: categories.php?success=' . ($action === 'add' ? 'added' : 'updated'));
                    exit;
                } else {
                    $error = 'Database error: ' . mysqli_error($link);
                }
            }
        }
    }

    if ($action === 'delete' && $cat_id > 0) {
        $stmt = mysqli_prepare($link, "DELETE FROM categories WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $cat_id);
        mysqli_stmt_execute($stmt);
        header('Location: categories.php?success=deleted');
        exit;
    }
}

// ─── Fetch for edit (AJAX-like: via GET id) ───────────────────────────────────
$edit_cat = null;
if (isset($_GET['edit'])) {
    $eid  = (int)$_GET['edit'];
    $res  = mysqli_query($link, "SELECT * FROM categories WHERE id = $eid");
    $edit_cat = mysqli_fetch_assoc($res);
}

// ─── Fetch all categories ─────────────────────────────────────────────────────
$categories = [];
$res = mysqli_query($link, "SELECT c.*, COUNT(p.id) as product_count FROM categories c LEFT JOIN products p ON p.category_id = c.id GROUP BY c.id ORDER BY c.name_en ASC");
while ($row = mysqli_fetch_assoc($res)) {
    $categories[] = $row;
}

include 'includes/header.php';
?>

<style>
    .modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:1000;align-items:center;justify-content:center;}
    .modal-overlay.open{display:flex;}
    .modal-box{background:#fff;border-radius:1rem;padding:2rem;width:100%;max-width:520px;position:relative;}
    .modal-box h3{margin:0 0 1.5rem;font-size:1.2rem;}
    .form-group{margin-bottom:1rem;}
    .form-group label{display:block;font-weight:600;margin-bottom:.4rem;font-size:.875rem;}
    .form-group input[type=text],.form-group input[type=file]{width:100%;padding:.65rem .85rem;border:1px solid #d1d5db;border-radius:.5rem;font-size:.875rem;}
    .modal-close{position:absolute;top:1rem;right:1rem;background:none;border:none;font-size:1.4rem;cursor:pointer;color:#6b7280;}
    .btn-primary-sm{background:var(--primary);color:#fff;border:none;padding:.65rem 1.5rem;border-radius:.5rem;font-weight:700;cursor:pointer;font-size:.875rem;}
    .cat-img{width:48px;height:48px;object-fit:cover;border-radius:6px;border:1px solid #eee;}
    .cat-img-placeholder{width:48px;height:48px;background:#f3f4f6;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#d1d5db;font-size:1.2rem;}
    .preview-img{margin-top:.5rem;width:80px;height:80px;object-fit:cover;border-radius:8px;border:1px solid #eee;display:none;}
</style>

<?php if (isset($_GET['success'])): ?>
    <?php $msgs=['added'=>'Category added!','updated'=>'Category updated!','deleted'=>'Category deleted.']; ?>
    <div style="background:<?php echo $_GET['success']==='deleted'?'#fee2e2':'#d1fae5'; ?>;color:<?php echo $_GET['success']==='deleted'?'#991b1b':'#065f46'; ?>;padding:1rem;border-radius:8px;margin-bottom:1.5rem;font-weight:600;">
        <i class="fas fa-<?php echo $_GET['success']==='deleted'?'trash':'check-circle'; ?>"></i>
        <?php echo $msgs[$_GET['success']] ?? 'Done.'; ?>
    </div>
<?php endif; ?>
<?php if ($error): ?>
    <div style="background:#fee2e2;color:#991b1b;padding:1rem;border-radius:8px;margin-bottom:1.5rem;font-weight:600;"><?php echo $error; ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <h3>Categories</h3>
        <div style="display:flex;gap:10px;align-items:center;">
            <span class="badge" style="background:#f3f4f6;color:#4b5563;"><?php echo count($categories); ?> Total</span>
            <button onclick="openModal()" class="btn-primary-sm">+ Add Category</button>
        </div>
    </div>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name (EN)</th>
                    <th>Name (RO)</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                    <tr><td colspan="7" style="text-align:center;padding:3rem;color:#6b7280;">No categories yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td style="color:#6b7280;">#<?php echo $cat['id']; ?></td>
                        <td>
                            <?php
                            $img_file = $cat['image'];
                            $img_disk = __DIR__ . '/../uploads/' . $img_file;
                            if ($img_file && file_exists($img_disk)):
                                // Build a root-relative URL so it always works regardless of subfolder depth
                                $img_url = '/uploads/' . $img_file;
                            ?>
                                <img src="<?php echo htmlspecialchars($img_url); ?>" class="cat-img" alt="">
                            <?php else: ?>
                                <div class="cat-img-placeholder"><i class="fas fa-image"></i></div>
                            <?php endif; ?>
                        </td>
                        <td><strong><?php echo htmlspecialchars($cat['name_en']); ?></strong></td>
                        <td><?php echo htmlspecialchars($cat['name_ro']); ?></td>
                        <td style="font-family:monospace;font-size:12px;color:#6b7280;"><?php echo htmlspecialchars($cat['slug']); ?></td>
                        <td>
                            <span class="badge" style="background:#eff6ff;color:#1d4ed8;"><?php echo $cat['product_count']; ?> products</span>
                        </td>
                        <td>
                            <div style="display:flex;gap:12px;font-size:15px;">
                                <button onclick='openEditModal(<?php echo json_encode($cat); ?>)' style="background:none;border:none;color:var(--primary);cursor:pointer;" title="Edit"><i class="fas fa-edit"></i></button>
                                <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this category? Products in it will become uncategorized.');">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="cat_id" value="<?php echo $cat['id']; ?>">
                                    <button type="submit" style="background:none;border:none;color:#ef4444;cursor:pointer;" title="Delete"><i class="fas fa-trash-alt"></i></button>
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

<!-- ── Add / Edit Modal ─────────────────────────────────────────────────────── -->
<div class="modal-overlay" id="catModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeModal()">&#x2715;</button>
        <h3 id="modalTitle">Add Category</h3>
        <form method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="action" id="formAction" value="add">
            <input type="hidden" name="cat_id" id="formCatId" value="0">

            <div class="form-group">
                <label>Name (English) *</label>
                <input type="text" name="name_en" id="inputNameEn" required placeholder="e.g. Fruits & Vegetables">
            </div>
            <div class="form-group">
                <label>Name (Romanian) *</label>
                <input type="text" name="name_ro" id="inputNameRo" required placeholder="e.g. Fructe și Legume">
            </div>
            <div class="form-group">
                <label>Category Image <span style="color:#9ca3af;font-weight:400;">(jpg, png, gif, webp)</span></label>
                <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImage(this)">
                <img id="imagePreview" class="preview-img">
                <div id="currentImageWrap" style="display:none;margin-top:.5rem;">
                    <p style="font-size:12px;color:#6b7280;margin-bottom:4px;">Current image:</p>
                    <img id="currentImageThumb" class="preview-img" style="display:block;">
                </div>
            </div>

            <button type="submit" class="btn-primary-sm" style="width:100%;padding:.8rem;">Save Category</button>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modalTitle').textContent = 'Add Category';
    document.getElementById('formAction').value = 'add';
    document.getElementById('formCatId').value = '0';
    document.getElementById('inputNameEn').value = '';
    document.getElementById('inputNameRo').value = '';
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('currentImageWrap').style.display = 'none';
    document.getElementById('catModal').classList.add('open');
}

function openEditModal(cat) {
    document.getElementById('modalTitle').textContent = 'Edit Category';
    document.getElementById('formAction').value = 'edit';
    document.getElementById('formCatId').value = cat.id;
    document.getElementById('inputNameEn').value = cat.name_en;
    document.getElementById('inputNameRo').value = cat.name_ro;
    document.getElementById('imagePreview').style.display = 'none';

    const wrap = document.getElementById('currentImageWrap');
    const thumb = document.getElementById('currentImageThumb');
    if (cat.image) {
        thumb.src = '/uploads/' + cat.image;
        wrap.style.display = 'block';
        thumb.style.display = 'block';
    } else {
        wrap.style.display = 'none';
    }

    document.getElementById('catModal').classList.add('open');
}

function closeModal() {
    document.getElementById('catModal').classList.remove('open');
}

function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}

// Close on overlay click
document.getElementById('catModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Auto-open edit modal if we come back after a validation error
<?php if ($edit_cat): ?>
openEditModal(<?php echo json_encode($edit_cat); ?>);
<?php endif; ?>
</script>

<?php include 'includes/footer.php'; ?>
