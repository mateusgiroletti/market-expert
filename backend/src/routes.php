<?php

use Config\Router;
use Infra\Controllers\ProductController;

$router = new Router();

// Routes
$router->get('/products', ProductController::class, 'index');
$router->post('/products', ProductController::class, 'store');