<?php


class Router {

    //массив где храним все маршруты
    private static $routes = [];

    //метод для добавления маршрутов в массив
    public static function page($uri, $page_name) {
        self::$routes[] = [
            'uri' => $uri,
            'page_name' => $page_name
        ];
    }

    //получаем введенный урл
    public static function getURI() {
        return $_SERVER['REQUEST_URI'];
    }

    //если нету маршрута - показываем страницу 404
    private static function notFound() {
        include '../controllers/404.php';
    }

    //запуск роутера
    public static function run() {
        $uri = self::getURI();

        //перебираем массив маршрутов, если маршрут совпадает в введенным урлом,
        //то показываем страницу с таким названием и сразу же прекращаем работу скрипта
        foreach (self::$routes as $route) {
            if($route['uri'] === $uri) {
                include '../controllers/' .$route['page_name']. '.php';
                exit();
            }
        }
        //иначе показываем 404
        self::notFound();
    }
}