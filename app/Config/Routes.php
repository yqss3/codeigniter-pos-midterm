<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/customers', 'Customers::index');
$routes->get('/users', 'Users::index');