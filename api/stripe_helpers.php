/**
 * Stripe Payment Gateway Integration Helpers
 * 
 * Path: api/stripe_helpers.php
 * Part of: Maharaja Supermarket API
 */
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/stripe.php';

/**
 * Execute a request to the Stripe API using cURL
 * 
 * @param string $method HTTP method (GET, POST, etc.)
 * @param string $endpoint Stripe API endpoint
 * @param array $params Request parameters
 * @throws Exception If request fails or Stripe returns an error
 * @return array Decoded JSON response
 */
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

/**
 * Initialize a new Stripe Checkout Session for an order
 * 
 * @param int $order_id Internal order ID
 * @param array $line_items List of items to charge for
 * @param string $success_url Redirect URL on success
 * @param string $cancel_url Redirect URL on cancellation
 * @return array Session data from Stripe
 */
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

/**
 * Verify the signature of a Stripe Webhook payload
 * 
 * @param string $payload Raw request body
 * @param string $sig_header Stripe-Signature header
 * @param string $secret Webhook signing secret
 * @return bool
 */
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
