<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'PaypalPayment',
    ['path' => '/paypal-payment'],
    function (RouteBuilder $routes) {
        $routes->connect('/pay/*', ['controller' => 'Paypal','action'=>'pay']);
        $routes->connect('/notify/*', ['controller' => 'Paypal','action'=>'notify']);
        $routes->connect('/cancel/*', ['controller' => 'Paypal','action'=>'cancel']);
        $routes->connect('/return/*', ['controller' => 'Paypal','action'=>'return']);
        $routes->fallbacks(DashedRoute::class);
    }
);
