<?php

namespace app\core;

class View {

	public $path;
	public $route;
	public $layout = 'default';

    /**
     * View constructor.
     * Определяем роут и путь до action
     * @param $route
     */
	public function __construct($route)
    {
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	/**
     * Рисуем страницу, передаем в неё title и массив данных
     * @param $title
     * @param array $vars
     */
	public function render($title, $vars = [])
    {
		extract($vars);
		$path = 'app/views/'.$this->path.'.php';
		if (file_exists($path)) {
			ob_start(); //Буферизируем
			require $path;
			$content = ob_get_clean(); //получаем и удаляем буфер
			require 'app/views/layouts/'.$this->layout.'.php';
		}
	}

    /**
     * Редирект
     * @param $url
     */
	public function redirect($url)
    {
		header('location: '.$url);
		exit;
	}

    /**
     * Отображаем страницы с ошибками.
     * @param $code
     */
	public static function errorCode($code)
    {
		http_response_code($code);
		$path = 'app/views/errors/'.$code.'.php';
		if (file_exists($path)) {
            ob_start();//Буферизируем
            require $path;
            $content = ob_get_clean(); //получаем и удаляем буфер
            require 'app/views/layouts/default.php';
		}
		exit;
	}

}	