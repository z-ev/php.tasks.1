<?php
require_once './vendor/autoload.php';

use app\core\Router;
/**
 * создаём сессию, экземпояр класса роутера и запускаем метод run()
 */
session_start();
$router = new Router;
$router->run();


