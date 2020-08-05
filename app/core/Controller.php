<?php

namespace app\core;

use app\core\View;

abstract class Controller {

	public $route;
	public $view;

    /**
     * Controller constructor.
     * Присваеваем переменным экземпляры классов View и Model
     * @param $route
     */
	public function __construct($route)
    {
		$this->route = $route;
    	$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);
    }

    /**
     * Возвращаем экземпляр класса модели соответствующей роуту
     * @param $name
     * @return mixed
     */
	public function loadModel($name)
    {
		$path = 'app\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}



}