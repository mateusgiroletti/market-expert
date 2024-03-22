<?php

require_once '../vendor/autoload.php';

require_once __DIR__ . '/../src/routes.php';

// Lidar com a requisição
$router->handleRequest($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);