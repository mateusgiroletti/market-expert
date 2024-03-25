<?php

use Config\Router;
use Infra\Controllers\ProductController;
use Infra\Controllers\ProductTypeController;
use Infra\Controllers\ProductTypeTaxesController;
use Infra\Controllers\SaleController;

$router = new Router();

// Routes products
$router->get('/products', ProductController::class, 'index');
$router->get('/productsById', ProductController::class, 'show');
$router->post('/products', ProductController::class, 'store');

// Routes products Type
$router->get('/product-types', ProductTypeController::class, 'index');
$router->post('/product-types', ProductTypeController::class, 'store');

// Routes products Type Taxes
$router->get('/product-type-taxes', ProductTypeTaxesController::class, 'index');
$router->post('/product-type-taxes', ProductTypeTaxesController::class, 'store');

// Routes Sales
$router->post('/sales', SaleController::class, 'store');