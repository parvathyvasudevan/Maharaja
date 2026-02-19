<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/stripe.php';
require_once __DIR__ . '/stripe_helpers.php';

$payload = file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

if (!stripe_verify_signature($payload, $sig_header, STRIPE_WEBHOOK_SECRET)) {
    http_response_code(400);
    echo 'Invalid signature';
    exit;
}

$event = json_decode($payload, true);
$type = $event['type'] ?? '';

if ($type === 'checkout.session.completed') {
    $session = $event['data']['object'] ?? [];
    $session_id = $session['id'] ?? null;
    $payment_intent = $session['payment_intent'] ?? null;

    if ($session_id) {
        $stmt = mysqli_prepare($link, "UPDATE orders SET payment_status = 'paid', status = 'processing', stripe_payment_intent_id = ? WHERE stripe_session_id = ?");
        mysqli_stmt_bind_param($stmt, 'ss', $payment_intent, $session_id);
        mysqli_stmt_execute($stmt);
    }
}

http_response_code(200);
echo 'ok';
