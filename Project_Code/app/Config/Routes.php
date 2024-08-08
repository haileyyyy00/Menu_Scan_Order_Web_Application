<?php


use CodeIgniter\Router\RouteCollection;


/**
* @var RouteCollection $routes
*/
$routes->get('/', 'MenuScanOrderController::index');

// Routes for admin
// $routes->group('admin', ['filter' => 'admin'], function($routes) {
//    $routes->get('/', 'MenuScanOrderController::admin');
//    $routes->match(['get', 'post'], 'addedit/', 'MenuScanOrderController::addedit');
//    $routes->match(['get', 'post'], 'addedit/(:num)', 'MenuScanOrderController::addedit/$1');
//    $routes->get('archive/(:num)', 'MenuScanOrderController::archive/$1');
// });

// Routes for login/logout
$routes->get('/login', 'Auth::google_login');  // Route to initiate Google login
$routes->get('/login/callback', 'Auth::google_callback');  // Callback route after Google auth
$routes->get('/logout', 'Auth::logout');
$routes->get('/access_denied', 'Auth::access_denied');
$routes->get('/not_logged_in', 'Auth::not_logged_in');

$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'AdminController::admin');
    $routes->match(['get', 'post'], 'addedit/', 'AdminController::addedit');
    $routes->match(['get', 'post'], 'addedit/(:num)', 'AdminController::addedit/$1');
    $routes->get('archive/(:num)', 'AdminController::archive/$1');
});

// $routes->get('/qrcode/(:num)', 'MenuScanOrderController::qrCode/$1', ['filter' => 'login']);


// $routes->group('viewmenu', ['filter' => 'login'] ,function($routes) {
//     $routes->get('(:num)', 'MenuScanOrderController::viewmenu/$1'); 
//     $routes->match(['get', 'post'], 'menuaddedit/(:num)', 'MenuScanOrderController::menuaddedit/$1'); 
//     $routes->match(['get', 'post'], 'menuaddedit/(:num)/(:num)', 'MenuScanOrderController::menuaddedit/$1/$2'); 
//     $routes->get('menudelete/(:num)/(:num)', 'MenuScanOrderController::menudelete/$1/$2');
// });


// $routes->group('viewmenuitems', ['filter' => 'login'] ,function($routes) {
//     $routes->get('(:num)', 'MenuScanOrderController::viewmenuitems/$1'); 
//     $routes->match(['get', 'post'], 'addedit/(:num)', 'MenuScanOrderController::itemaddedit/$1');
//     $routes->match(['get', 'post'], 'addedit/(:num)/(:num)', 'MenuScanOrderController::itemaddedit/$1/$2');
//     $routes->match(['get', 'post'],'editcategory/(:num)/(:segment)', 'MenuScanOrderController::editcategory/$1/$2');
//     $routes->get('delete(:num)/(:segment)', 'MenuScanOrderController::category_delete/$1/$2');
//     $routes->get('itemdelete/(:num)', 'MenuScanOrderController::menu_item_delete/$1');
// });

// $routes->match(['get', 'post'],'track_order/(:num)', 'MenuScanOrderController::track_order/$1', ['filter' => 'login']);
// $routes->get('view_order/(:num)/(:num)/(:segment)', 'MenuScanOrderController::view_order/$1/$2/$3', ['filter' => 'login']);
// $routes->match(['get', 'post'],'status_edit/(:num)/(:num)', 'MenuScanOrderController::order_status_edit/$1/$2', ['filter' => 'login']);
// $routes->match(['get', 'post'],'update_status/(:num)/(:num)/(:segment)', 'MenuScanOrderController::update_status/$1/$2/$3', ['filter' => 'login']);

// Routes for user
$routes->get('/qrcode/(:num)', 'UserController::qrCode/$1', ['filter' => 'login']);

$routes->group('viewmenu', ['filter' => 'login'] ,function($routes) {
    $routes->get('(:num)', 'UserController::viewmenu/$1'); 
    $routes->match(['get', 'post'], 'menuaddedit/(:num)', 'UserController::menuaddedit/$1'); 
    $routes->match(['get', 'post'], 'menuaddedit/(:num)/(:num)', 'UserController::menuaddedit/$1/$2'); 
    $routes->get('menudelete/(:num)/(:num)', 'UserController::menudelete/$1/$2');
});


$routes->group('viewmenuitems', ['filter' => 'login'] ,function($routes) {
    $routes->get('(:num)', 'UserController::viewmenuitems/$1'); 
    $routes->match(['get', 'post'], 'addedit/(:num)', 'UserController::itemaddedit/$1');
    $routes->match(['get', 'post'], 'addedit/(:num)/(:num)', 'UserController::itemaddedit/$1/$2');
    $routes->match(['get', 'post'],'editcategory/(:num)/(:segment)', 'UserController::editcategory/$1/$2');
    $routes->get('delete(:num)/(:segment)', 'UserController::category_delete/$1/$2');
    $routes->get('itemdelete/(:num)', 'UserController::menu_item_delete/$1');
});

$routes->group('orders', ['filter' => 'login'] ,function($routes) {
    $routes->match(['get', 'post'],'track_order/(:num)', 'UserController::track_order/$1', ['filter' => 'login']);
    $routes->get('view_order/(:num)/(:num)/(:segment)', 'UserController::view_order/$1/$2/$3', ['filter' => 'login']);
    // $routes->match(['get', 'post'],'status_edit/(:num)/(:num)', 'UserController::order_status_edit/$1/$2', ['filter' => 'login']);
    $routes->match(['get', 'post'],'update_status/(:num)/(:num)/(:segment)', 'UserController::update_status/$1/$2/$3', ['filter' => 'login']);
});


// // Routes for customer
// $routes->group('customers', ['filter' => 'login'] ,function($routes) {
//     $routes->get('/customer_menu_view/(:num)/(:num)', 'CustomerController::customer_menu/$1/$2');
//     $routes->post('/order_handling/(:num)/(:num)', 'CustomerController::order_handling/$1/$2');
// });

$routes->get('/customer_menu_view/(:num)/(:num)', 'MenuScanOrderController::customer_menu/$1/$2');
$routes->post('/order_handling/(:num)/(:num)', 'MenuScanOrderController::order_handling/$1/$2');

