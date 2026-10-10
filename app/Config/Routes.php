<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home and About
$routes->get('/', 'Home::index');
$routes->get('about', 'Home::about');

// Authentication
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');

// Customer Management
$routes->group('customers', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'CustomerController::index');
    $routes->get('create', 'CustomerController::create');
    $routes->post('store', 'CustomerController::store');
    $routes->get('edit/(:num)', 'CustomerController::edit/$1');
    $routes->post('update/(:num)', 'CustomerController::update/$1');
    $routes->post('delete/(:num)', 'CustomerController::delete/$1');
});

// Staff Management
$routes->group('users', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->post('update/(:num)', 'UserController::update/$1');
    $routes->post('delete/(:num)', 'UserController::delete/$1');
});

// Product Management
$routes->group('products', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'ProductController::index');
    $routes->get('create', 'ProductController::create');
    $routes->post('store', 'ProductController::store');
    $routes->get('edit/(:num)', 'ProductController::edit/$1');
    $routes->post('update/(:num)', 'ProductController::update/$1');
    $routes->post('delete/(:num)', 'ProductController::delete/$1');
});

// Sales Management
$routes->group('sales', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'SaleController::index');
    $routes->get('create', 'SaleController::create');
    $routes->post('store', 'SaleController::store');
});

// Sales History uses the same sales listing page
$routes->get('sales-history', 'SaleController::index', ['filter' => 'auth']);
