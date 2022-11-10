<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'SslCommerzPayment',
    ['path' => '/ssl-commerz-payment'],
    function (RouteBuilder $routes) {
        $routes->connect('/success', ['controller' => 'payment', 'action' => 'success']);
        $routes->connect('/fail', ['controller' => 'payment', 'action' => 'fail']);
        $routes->connect('/cancel', ['controller' => 'payment', 'action' => 'cancel']);
        $routes->connect('/ipn', ['controller' => 'payment', 'action' => 'ipn']);
        
        
        $routes->fallbacks(DashedRoute::class);
    }
);
