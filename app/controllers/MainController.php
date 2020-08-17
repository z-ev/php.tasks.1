<?php

namespace app\controllers;

use app\core\Controller;

class MainController extends Controller {
    /**
     * Главная страница которая загружается по умолчанию
     */
	public function indexAction() {
	    // Получаем данные из модели (список заказов)
        $vars = $this->model->getAllOrders();
        // Отображаем страницу
   		$this->view->render('Welcome', $vars);
	}

}