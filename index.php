<?php

use app\core\Router;

/**
 * Регистрируем функцию в качестве реализации метода __autoload для загрузки классов
 */
spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if (file_exists($path)) {
        require $path;
    }
});

/**
 * создаём сессию, экземпояр класса роутера и запускаем метод run()
 */
session_start();
$router = new Router;
$router->run();


