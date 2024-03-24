<?php

namespace Config;

class Router
{
    protected $routes = [];

    public function get(string $url, string $controller, string $controllerMethod): void
    {
        $this->addRoute('GET', $url, $controller, $controllerMethod);
    }

    public function post(string $url, string $controller, string $controllerMethod): void
    {
        $this->addRoute('POST', $url, $controller, $controllerMethod);
    }

    protected function addRoute(string $method, string $url, string $controller, $controllerMethod): void
    {
        $this->routes[$method][$url] = ['controller' => $controller, 'method' => $controllerMethod];
    }

    protected function headersOptions(): void
    {
        header('Content-Type: application/json');

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    }

    public function handleRequest($method, $url)
    {
        $this->headersOptions();

        if (isset($this->routes[$method][$url])) {
            $handler = $this->routes[$method][$url];
            $controller = new $handler['controller']();

            // Lê o corpo da requisição
            $jsonPayload = file_get_contents('php://input');

            // Decodifica o JSON em um array associativo
            $requestData = json_decode($jsonPayload, true);

            $method = $handler['method'];
            $response = $controller->$method($requestData);

            echo $response;
            return;
        }
        echo "404 - Página não encontrada";
    }
}
