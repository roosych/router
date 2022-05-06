<?php


class Router {

    // Переменная для хранения получаемый маршрутов
    private $routes;

    /**
     * Router constructor.
     * При вызове класса подключаем файл с маршрутами
     */
    public function __construct() {
        $routesPath = include '../config/routes.php';
        $this->routes = $routesPath;
    }


    /**
     * @return mixed
     * Получаем строку запроса
     */
    private function getURI() {
        return $_SERVER['REQUEST_URI'];
    }


    public function start() {
        $uri = $this->getURI();

        if(array_key_exists($uri, $this->routes)) {
            include $this->routes[$uri];
            exit();
        } else {
            include $this->routes['404'];
        }
    }
}