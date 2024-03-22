<?php

use Config\Router;
use Infra\Controllers\ProductController;

$router = new Router();

// Routes
$router->addRoute('GET', '/products', ProductController::class, 'index');
$router->addRoute('POST', '/products', ProductController::class, 'store');