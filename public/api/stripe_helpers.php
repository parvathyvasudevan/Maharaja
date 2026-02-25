<?php
require_once __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../config/stripe.php';

function stripe_api_request($method, $endpoint, $params)
{
    if (!STRIPE_SECRET_KEY) {
        throw new Exception('Stripe secret key is not configured.');
    }

    $ch = curl_init();
    $url = 'https://api.stripe.com' . $endpoint;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, STRIPE_SECRET_KEY . ':');
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    if (strtoupper($method) === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    }

    $response = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        throw new Exception('Stripe API request failed: ' . $error);
    }

    curl_close($ch);

    $data = json_decode($response, true);

    if ($status >= 400) {
        $message = $data['error']['message'] ?? 'Stripe API error';
        throw new Exception($message);
    }

    return $data;
}

function stripe_create_checkout_session($order_id, $line_items, $success_url, $cancel_url)
{
    $params = [
        'mode' => 'payment',
        'success_url' => $success_url,
        'cancel_url' => $cancel_url,
        'client_reference_id' => $order_id,
        'payment_method_types[]' => 'card',
    ];

    foreach ($line_items as $index => $item) {
        $params["line_items[$index][quantity]"] = $item['quantity'];
        $params["line_items[$index][price_data][currency]"] = APP_CURRENCY;
        $params["line_items[$index][price_data][product_data][name]"] = $item['name'];
        $params["line_items[$index][price_data][unit_amount]"] = (int)round($item['amount'] * 100);
    }

    return stripe_api_request('POST', '/v1/checkout/sessions', $params);
}

function stripe_verify_signature($payload, $sig_header, $secret)
{
    if (!$secret) {
        return false;
    }

    $parts = explode(',', $sig_header);
    $timestamp = null;
    $signature = null;

    foreach ($parts as $part) {
        [$key, $value] = array_pad(explode('=', $part, 2), 2, null);
        if ($key === 't') {
            $timestamp = $value;
        }
        if ($key === 'v1') {
            $signature = $value;
        }
    }

    if (!$timestamp || !$signature) {
        return false;
    }

    $signed_payload = $timestamp . '.' . $payload;
    $expected = hash_hmac('sha256', $signed_payload, $secret);

    return hash_equals($expected, $signature);
}
?>
