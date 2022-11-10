<?php
$baseDir = dirname(dirname(__FILE__));

return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'BkashPayment' => $baseDir . '/plugins/BkashPayment/',
        'CakePdf' => $baseDir . '/vendor/friendsofcake/cakepdf/',
        'CodPayment' => $baseDir . '/plugins/CodPayment/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'NagadPayment' => $baseDir . '/plugins/NagadPayment/',
        'PaypalPayment' => $baseDir . '/plugins/PaypalPayment/',
        'RocketPayment' => $baseDir . '/plugins/RocketPayment/',
        'SslCommerzPayment' => $baseDir . '/plugins/SslCommerzPayment/',
        'StripePayment' => $baseDir . '/plugins/StripePayment/',
        'WyriHaximus/TwigView' => $baseDir . '/vendor/wyrihaximus/twig-view/',
    ],
];
