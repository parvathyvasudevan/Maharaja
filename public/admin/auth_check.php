<?php
/**
 * Admin Auth + Security — handles session management, CSRF, and login check.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ── Session timeout: expire after 2 hours of inactivity ──────────────────────
define('SESSION_TIMEOUT', 7200); // 2 hours in seconds

function check_session_timeout(): void {
    if (isset($_SESSION['admin_id'])) {
        $last = $_SESSION['_last_activity'] ?? time();
        if ((time() - $last) > SESSION_TIMEOUT) {
            // Destroy session gracefully
            $_SESSION = [];
            if (ini_get('session.use_cookies')) {
                $p = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $p['path'], $p['domain'], $p['secure'], $p['httponly']);
            }
            session_destroy();
            header('Location: login.php?timeout=1');
            exit;
        }
        $_SESSION['_last_activity'] = time(); // refresh the clock
    }
}

// ── CSRF helpers ──────────────────────────────────────────────────────────────
function admin_csrf_token(): string {
    if (empty($_SESSION['_csrf_token'])) {
        $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_csrf_token'];
}

function csrf_field(): string {
    return '<input type="hidden" name="_csrf_token" value="' . htmlspecialchars(admin_csrf_token()) . '">';
}

function verify_csrf(): void {
    $token = $_POST['_csrf_token'] ?? '';
    if (!hash_equals(admin_csrf_token(), $token)) {
        http_response_code(403);
        die('<h2>403 — Invalid CSRF token. Please go back and try again.</h2>');
    }
}

// ── Require admin login ───────────────────────────────────────────────────────
function require_admin_login(): void {
    check_session_timeout();
    if (!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }
}

// ── Input sanitization helpers ────────────────────────────────────────────────
function clean(string $val): string {
    return strip_tags(trim($val));
}

function clean_int(mixed $val): int {
    return (int) filter_var($val, FILTER_SANITIZE_NUMBER_INT);
}

function clean_float(mixed $val): float {
    return (float) filter_var($val, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

// ── Secure image upload helper ────────────────────────────────────────────────
/**
 * Validates and saves an uploaded image.
 * - Checks MIME type (jpg/png/webp only)
 * - Enforces 2 MB size limit
 * - Renames to UUID v4 to prevent path traversal
 *
 * @param  array  $file        $_FILES['fieldname']
 * @param  string $target_dir  Absolute path to save directory (with trailing slash)
 * @param  string $prefix      Optional filename prefix, e.g. 'cat_' or 'prod_'
 * @return array{ok:bool, filename:string|null, error:string}
 */
function secure_upload(array $file, string $target_dir, string $prefix = ''): array {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $msgs = [
            UPLOAD_ERR_INI_SIZE   => 'File exceeds server upload limit.',
            UPLOAD_ERR_FORM_SIZE  => 'File exceeds form size limit.',
            UPLOAD_ERR_PARTIAL    => 'File was only partially uploaded.',
            UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary upload folder.',
            UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        ];
        return ['ok' => false, 'filename' => null, 'error' => $msgs[$file['error']] ?? 'Upload error.'];
    }

    // 2 MB size limit
    if ($file['size'] > 2 * 1024 * 1024) {
        return ['ok' => false, 'filename' => null, 'error' => 'Image must be under 2 MB.'];
    }

    // MIME-type validation (read the actual bytes, not the browser-provided type)
    $allowed_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $detected_mime = $finfo->file($file['tmp_name']);
    if (!in_array($detected_mime, $allowed_mime, true)) {
        return ['ok' => false, 'filename' => null, 'error' => 'Only JPG, PNG, and WebP images are allowed.'];
    }

    $ext_map = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    $ext = $ext_map[$detected_mime];

    // UUID v4 filename
    $uuid      = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
    $filename  = $prefix . $uuid . '.' . $ext;

    if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

    if (!move_uploaded_file($file['tmp_name'], $target_dir . $filename)) {
        return ['ok' => false, 'filename' => null, 'error' => 'Could not save the uploaded file. Check folder permissions.'];
    }

    return ['ok' => true, 'filename' => $filename, 'error' => ''];
}
