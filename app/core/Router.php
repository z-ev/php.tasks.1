<?php

namespace app\core;

use app\core\View;

class Router {

    protected $routes = [];
    protected $params = [];

    /**
     * Router constructor.
     * Добавляем в routes маршруты из файла роутов
     */
    public function __construct()
    {
        $arr = require 'app/config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    /**
     * Добавляем маршруты в routes[]
     * @param $route
     * @param $params
     */
    public function add($route, $params)
    {
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    /**
     * Сверяем текущий url с маршутами
     * @return bool
     */
    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * Если url соответсвует маршруту то проверяем налчие класса и метода, создаем его экземпляр и обращаемся к методу.
     * В противном случае выводим сообщение об ошибки 404.
     */
    public function run()
    {

        if ($this->match()) {
            $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);


        }
    }

}