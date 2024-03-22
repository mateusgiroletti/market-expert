<?php

namespace Config;

class Router
{
    protected $routes = [];

    public function addRoute($method, $url, $controller, $controllerMethod)
    {
        $this->routes[$method][$url] = ['controller' => $controller, 'method' => $controllerMethod];
    }

    public function handleRequest($method, $url)
    {
        if (isset($this->routes[$method][$url])) {
            header('Content-Type: application/json');

            $handler = $this->routes[$method][$url];
            $controller = new $handler['controller']();

            // Lê o corpo da requisição
            $jsonPayload = file_get_contents('php://input');

            // Decodifica o JSON em um array associativo
            $requestData = json_decode($jsonPayload, true);

            $method = $handler['method'];
            $controller->$method($requestData);
        }

        echo "404 - Página não encontrada";
    }
}
