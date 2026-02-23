<?php
/**
 * /public/lang_switch.php
 * Sets $_SESSION['lang'] and redirects the user back to where they came from.
 *
 * Usage in templates:
 *   <a href="/lang_switch.php?lang=ro">RO</a>
 *   <a href="/lang_switch.php?lang=en">EN</a>
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set language
$choice = $_GET['lang'] ?? 'en';
if (in_array($choice, ['en', 'ro'])) {
    $_SESSION['lang'] = $choice;
}

// Determine redirect destination
$back = $_GET['back'] ?? $_SERVER['HTTP_REFERER'] ?? '/';

// Safety: only allow same-host or relative redirects
$parsed = parse_url($back);
if (!empty($parsed['host']) && $parsed['host'] !== $_SERVER['HTTP_HOST']) {
    $back = '/';
}

// Map legacy .html → .php equivalents so static HTML pages don't cause 404s
$html_map = [
    '/ro.html'      => '/',
    '/index.html'   => '/',
    '/about.html'   => '/',
    '/contact.html' => '/contact.php',
    '/terms.html'   => '/',
];

$path = parse_url($back, PHP_URL_PATH) ?? '/';
foreach ($html_map as $old => $new) {
    if (rtrim($path, '/') === rtrim($old, '/')) {
        $back = $new;
        break;
    }
}

header('Location: ' . $back);
exit;
