<?php

define('APP_URL', getenv('APP_URL') ?: 'http://localhost');
define('APP_CURRENCY', getenv('APP_CURRENCY') ?: 'ron');
define('APP_CURRENCY_SYMBOL', getenv('APP_CURRENCY_SYMBOL') ?: 'RON');
define('SHIPPING_FLAT_RATE', (float)(getenv('SHIPPING_FLAT_RATE') ?: 15.00));
define('TAX_RATE', (float)(getenv('TAX_RATE') ?: 0));
?>
