<?php

namespace Config;

class Router
{
    protected $routes = [];

    public function get($url, $controller, $controllerMethod)
    {
        $this->addRoute('GET', $url, $controller, $controllerMethod);
    }

    public function post($url, $controller, $controllerMethod)
    {
        $this->addRoute('POST', $url, $controller, $controllerMethod);
    }

    public function put($url, $controller, $controllerMethod)
    {
        $this->addRoute('PUT', $url, $controller, $controllerMethod);
    }

    public function delete($url, $controller, $controllerMethod)
    {
        $this->addRoute('DELETE', $url, $controller, $controllerMethod);
    }

    protected function addRoute($method, $url, $controller, $controllerMethod)
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
            $response = $controller->$method($requestData);

            // Configura o cabeçalho Content-Type para application/json
            header('Content-Type: application/json');

            // Retorna a resposta como JSON
            echo $response;
            return;
        }
        echo "404 - Página não encontrada";
    }
}
