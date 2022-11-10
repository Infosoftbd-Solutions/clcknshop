<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::plugin(
    'StripePayment',
    ['path' => '/stripe-payment'],
    function (RouteBuilder $routes) {
        $routes->connect('/pay/*', ['controller' => 'Stripe','action'=>'pay']);
        $routes->fallbacks(DashedRoute::class);
    }
);
