<?php

namespace app\controllers;

use app\core\Controller;


class MainController extends Controller {

	public function indexAction() {

        $vars = $this->model->getAllOrders();
   		$this->view->render('Добро пожаловать', $vars);
	}

}