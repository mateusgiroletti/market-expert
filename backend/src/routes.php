<?php

use Config\Router;
use Infra\Controllers\ProductController;

$router = new Router();

// Routes products
$router->get('/products', ProductController::class, 'index');
$router->post('/products', ProductController::class, 'store');

// Routes products Type
$router->post('/product-types', ProductController::class, 'store');