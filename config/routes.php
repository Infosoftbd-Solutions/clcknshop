<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */


Router::defaultRouteClass(DashedRoute::class);


Router::prefix('admin', function (RouteBuilder $routes) {
    // All routes here will be prefixed with `/admin`
    // And have the prefix => admin route element added.

    $routes->setExtensions(['json','pdf']);
   // $routes->setExtensions(['pdf']);
    
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));



    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    $routes->applyMiddleware('csrf');
    $routes->connect('/', ['controller' => 'orders', 'action' => 'dashboard']);

    $routes->fallbacks(DashedRoute::class);
});





/*Router::prefix('/apiv1', function (RouteBuilder $routes) {

    $routes->setExtensions(['json']);
    $routes->resources('Customers');
    $routes->fallbacks(DashedRoute::class);
});*/

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));
          
    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    $routes->applyMiddleware('csrf');


    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'frontend', 'action' => 'homepage']);
    $routes->connect('/product/*', ['controller' => 'frontend', 'action' => 'product']);
    $routes->connect('/collection/*', ['controller' => 'frontend', 'action' => 'collection']);
    $routes->connect('/search/*', ['controller' => 'frontend', 'action' => 'search']);
    $routes->connect('/cart', ['controller' => 'frontend', 'action' => 'cart']);
    $routes->connect('/add_to_cart', ['controller' => 'frontend', 'action' => 'addToCart']);
    $routes->connect('/newsletter', ['controller' => 'frontend', 'action' => 'newsletter']);
    $routes->connect('/signin', ['controller' => 'frontend', 'action' => 'signin']);
    $routes->connect('/checkout/*', ['controller' => 'checkout', 'action' => 'index']);
    $routes->connect('/one-page-checkout/*', ['controller' => 'checkout', 'action' => 'onePageCheckout']);
    $routes->connect('/apply-coupon', ['controller' => 'checkout', 'action' => 'applyCoupon']);
    $routes->connect('/checkout/shipping/*', ['controller' => 'checkout', 'action' => 'shipping']);
    $routes->connect('/checkout/payment/*', ['controller' => 'checkout', 'action' => 'payment']);
    $routes->connect('/login', ['controller' => 'Customers', 'action' => 'login']);
    $routes->connect('/otp-login', ['controller' => 'Customers', 'action' => 'otpLogin']);
    $routes->connect('/verify-otp', ['controller' => 'Customers', 'action' => 'verifyOtp']);
    $routes->connect('/resend-otp', ['controller' => 'Customers', 'action' => 'resendOtp']);
    $routes->connect('/add-customer', ['controller' => 'Customers', 'action' => 'addCustomer']);
    $routes->connect('/register', ['controller' => 'Customers', 'action' => 'register']);
    $routes->connect('/reset-password/*', ['controller' => 'Customers', 'action' => 'resetPassword']);
    $routes->connect('/track-order/*', ['controller' => 'checkout', 'action' => 'trackOrder']);
    $routes->connect('/customer', ['controller' => 'Customers', 'action' => 'index']);
    $routes->connect('/customer/edit', ['controller' => 'Customers', 'action' => 'edit']);
    $routes->connect('/customer/profile', ['controller' => 'Customers', 'action' => 'profile']);
    $routes->connect('/customer/change-password', ['controller' => 'Customers', 'action' => 'changePassword']);
    $routes->connect('/customer/logout', ['controller' => 'Customers', 'action' => 'logout']);
    $routes->connect('/customer/order/view/:id', ['controller' => 'Customers', 'action' => 'view'],['id' => '\d+', 'pass' => ['id']]);
    $routes->connect('/review', ['controller' => 'frontend', 'action' => 'review']);
    $routes->connect('/image/*', ['controller' => 'frontend', 'action' => 'image']);
    $routes->connect('/page/*', ['controller' => 'frontend', 'action' => 'page']);
    $routes->connect('/contact', ['controller' => 'frontend', 'action' => 'contact']);
    $routes->connect('/thank-you/*', ['controller' => 'checkout', 'action' => 'thankYou']);
    
    $routes->connect('/robots.txt', ['controller' => 'frontend', 'action' => 'robots']);
    $routes->connect('/sitemap.xml', ['controller' => 'frontend', 'action' => 'sitemap','xml']);
    $routes->connect('/sitemap.txt', ['controller' => 'frontend', 'action' => 'sitemap','txt']);
    $routes->connect('/themes.json', ['controller' => 'stores', 'action' => 'themes','prefix'=>'admin']);
    $routes->connect('/registration', ['controller' => 'stores', 'action' => 'create','prefix'=>'admin']);
    $routes->connect('/docs/*', ['controller' => 'frontend', 'action' => 'docs']);
    $routes->connect('/pos/*', ['controller' => 'frontend', 'action' => 'pos']);
    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);


//    ROUTE FOR PRODUCT FEED
  //  $routes->connect('/feed/*', ['controller' => 'feed', 'action' => 'feed']);


      #SSLCOMMERZ Route First Part Start
    # These route will call from out side
    // $routes->connect('/example1', ['controller' => 'Payment', 'action' => 'example1']);
    // $routes->connect('/example2', ['controller' => 'Payment', 'action' => 'example2']);
    // $routes->connect('/success', ['controller' => 'Payment', 'action' => 'success']);
    // $routes->connect('/cancel', ['controller' => 'Payment', 'action' => 'cancel']);
    // $routes->connect('/fail', ['controller' => 'Payment', 'action' => 'fail']);
    // $routes->connect('/ipn', ['controller' => 'Payment', 'action' => 'ipn']); // This routing URL need to save in Merchat Panel's IPN setting as IPN Lisener.
    // #SSLCOMMERZ Route First Part End

    $routes->connect('/payViaAjax', ['controller' => 'Payment', 'action' => 'payViaAjax']); // You can set this route after CSRF. Because payment request will initiate by your site.

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
   

    #SSLCOMMERZ Route  Second Start
    $routes->connect('/pay', ['controller' => 'Payment', 'action' => 'index']);// You can set this route after CSRF. Because payment request will initiate by your site.
    #SSLCOMMERZ Route  Second End


    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *
     * ```
     * $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
     * $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
     * ```
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
    //$routes->connect('/*', ['controller' => 'frontend', 'action' => 'category']);
});

Router::scope('/api', ['_namePrefix' => 'api:'], function (RouteBuilder $routes) {
    // This route's name will be `api:ping`
    $routes->setExtensions(['json']);

    $routes->post('/build_store/*', ['controller' => 'users','action'=> 'build_store','prefix'=>'admin']);
    $routes->post('/admin_login/*', ['controller' => 'users','action'=> 'auto_login','prefix'=>'admin']);
    $routes->post('/gen_csv/*',     ['controller' => 'users','action'=> 'gen_csv','prefix'=>'admin']);
    $routes->post('/del_store/*',     ['controller' => 'users','action'=> 'del_store','prefix'=>'admin']);
    #POS ROUTE
    $routes->get('/pos/unauthorized', ['controller' => 'Pos', 'action' => 'unauthorized']);
    $routes->get('/pos/collection/*', ['controller' => 'Pos', 'action' => 'collection']);
    $routes->get('/pos/collections',['controller' => 'Pos', 'action' =>'collections']);
    $routes->get('/pos/product-types',['controller' => 'Pos', 'action' =>'productTypes']);
    $routes->get('/pos/customer-list', ['controller' => 'Pos', 'action' => 'customerList']);
    $routes->get('/pos/payment-methods', ['controller' => 'Pos', 'action' => 'paymentMethod']);
    $routes->post('/pos/order-create', ['controller' => 'Pos', 'action' => 'orderCreate']);
    $routes->options('/pos/order-create', ['controller' => 'Pos', 'action' => 'orderCreate']);

});


//Router::scope('/api', function (RouteBuilder $routes) {
     // No $routes->applyMiddleware() here.
     // Connect API actions here.
   // $routes->setExtensions(['json']);
   // $routes->resources('Products');
//});

/**
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */