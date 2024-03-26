<?php

namespace Config;

use Factories\ControllerFactory;

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
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

        header('Content-Type: application/json');
    }

    public function handleRequest($method, $url)
    {
        $this->headersOptions();

        $queryParams = [];
        $urlParts = explode('?', $url);
        $urlWithoutQuery = $urlParts[0];
        if (count($urlParts) > 1) {
            $query = $urlParts[1];
            parse_str($query, $queryParams);
        }

        if (isset($this->routes[$method][$urlWithoutQuery])) {
            $handler = $this->routes[$method][$urlWithoutQuery];
            $controller = ControllerFactory::create($handler['controller']);

            // Lê o corpo da requisição
            $jsonPayload = file_get_contents('php://input');

            // Decodifica o JSON em um array associativo
            $requestBodyData = json_decode($jsonPayload, true);

            $requestData = $queryParams;

            if (!empty($requestBodyData)) {
                $requestData = array_merge($requestData, $requestBodyData);
            }

            $method = $handler['method'];
            $response = $controller->$method($requestData);

            echo $response;
            return;
        }

        echo "404 - Página não encontrada";
    }
}
