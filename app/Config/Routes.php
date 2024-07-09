<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// routes.php
// $routes->group('api/buku', ['namespace' => 'App\Controllers\Api'], function($routes) {
    

//     // ... rute API lainnya
// });
// $routes->resource('books', ['controller' => 'BookController']);
// $routes->get('books/(:num)/(:any)', 'CategoryController::addCategory/$1/$2');

// auto routes
// $routes->setAutoRoute(true);
$routes->get('books', 'BookController::index');
