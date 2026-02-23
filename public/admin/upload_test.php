<?php
// Quick upload test - run via browser ONLY, delete after testing
require_once __DIR__ . '/auth_check.php';
require_admin_login();

$target_dir = __DIR__ . '/../uploads/';
$results = [];

// 1. Check directory exists and is writable
$results['uploads_dir_exists'] = is_dir($target_dir) ? 'YES' : 'NO';
$results['uploads_dir_writable'] = is_writable($target_dir) ? 'YES' : 'NO';
$results['uploads_dir_path'] = realpath($target_dir);

// 2. Check PHP upload settings
$results['upload_max_filesize'] = ini_get('upload_max_filesize');
$results['post_max_size'] = ini_get('post_max_size');
$results['file_uploads_enabled'] = ini_get('file_uploads') ? 'YES' : 'NO';

// 3. If a file was uploaded, show its info
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['testfile']['name'])) {
    $f = $_FILES['testfile'];
    $results['uploaded_name'] = $f['name'];
    $results['uploaded_size'] = $f['size'];
    $results['upload_error_code'] = $f['error'];
    $error_messages = [0=>'OK',1=>'File too large (ini)',2=>'File too large (form)',3=>'Partial upload',4=>'No file uploaded',6=>'Missing temp dir',7=>'Write failed',8=>'Extension stopped'];
    $results['upload_error_msg'] = $error_messages[$f['error']] ?? 'Unknown';
    
    if ($f['error'] === 0) {
        $ext = strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
        $new_name = 'test_' . time() . '.' . $ext;
        $dest = $target_dir . $new_name;
        $results['destination_path'] = $dest;
        $moved = move_uploaded_file($f['tmp_name'], $dest);
        $results['move_uploaded_file_result'] = $moved ? 'SUCCESS' : 'FAILED';
        if ($moved) {
            $results['file_url'] = '/uploads/' . $new_name;
            // Clean up test file
            // unlink($dest);
        } else {
            $results['last_php_error'] = error_get_last()['message'] ?? 'none';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Upload Test</title><style>body{font-family:monospace;padding:20px;} table{border-collapse:collapse;width:100%} td,th{border:1px solid #ccc;padding:8px;text-align:left;} .ok{background:#d1fae5;} .fail{background:#fee2e2;}</style></head>
<body>
<h2>Upload Diagnostics</h2>
<table>
<?php foreach ($results as $k => $v): ?>
<tr class="<?php echo (strpos($v,'NO')!==false||strpos($v,'FAIL')!==false)?'fail':'ok'; ?>">
    <th><?php echo $k; ?></th>
    <td><?php echo htmlspecialchars($v); ?></td>
</tr>
<?php endforeach; ?>
</table>

<hr>
<h3>Test Upload</h3>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="testfile" accept="image/*" required>
    <button type="submit" style="padding:8px 16px;background:#5B8A1D;color:#fff;border:none;border-radius:4px;cursor:pointer;">Upload Test Image</button>
</form>
<?php if (isset($results['file_url'])): ?>
<p>✅ File saved! URL: <a href="<?php echo $results['file_url']; ?>"><?php echo $results['file_url']; ?></a></p>
<img src="<?php echo $results['file_url']; ?>" style="max-width:200px;margin-top:10px;">
<?php endif; ?>
</body>
</html>
