<?php

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', 'https://demo2.sg1.clcknshop.com');
}

if (!defined('API_DOMAIN_URL')) {
    define('API_DOMAIN_URL', 'https://sandbox.sslcommerz.com'); // For Sandbox
    //define('API_DOMAIN_URL', 'https://securepay.sslcommerz.com'); // For Live
}

if (!defined('STORE_ID')) {
    define('STORE_ID', 'infos6080fc7d7aacf');
}

if (!defined('STORE_PASSWORD')) {
    define('STORE_PASSWORD', 'infos6080fc7d7aacf@ssl');
}

if (!defined('IS_LOCALHOST')) {
    define('IS_LOCALHOST', false);
}

return [
    'projectPath' => constant("PROJECT_PATH"),
    'apiDomain' => constant("API_DOMAIN_URL"),
    'apiCredentials' => [
        'store_id' => constant("STORE_ID"),
        'store_password' => constant("STORE_PASSWORD"),
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'connect_from_localhost' => constant("IS_LOCALHOST"),
    'success_url' => 'success',
    'failed_url' => 'fail',
    'cancel_url' => 'cancel',
    'ipn_url' => 'ipn',
];
