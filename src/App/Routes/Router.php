<?php

namespace App\Routes;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function addRoute($path, $handler, $method = 'GET')
    {
        $this->routes[$method][$path] = $handler;
    }

    public function route($requestUri, $requestMethod)
    {
        $routeKey = strtok($requestUri, '?');

        if (isset($this->routes[$requestMethod]) && array_key_exists($routeKey, $this->routes[$requestMethod])) {
            $handler = $this->routes[$requestMethod][$routeKey];
            return $handler();
        } else {
            return 'Route not found';
        }
    }
}
