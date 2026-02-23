/**
 * Stripe Payment Gateway Configuration
 * 
 * Path: config/stripe.php
 * Part of: Maharaja Supermarket
 */

define('STRIPE_SECRET_KEY', getenv('STRIPE_SECRET_KEY') ?: '');
define('STRIPE_WEBHOOK_SECRET', getenv('STRIPE_WEBHOOK_SECRET') ?: '');
?>
