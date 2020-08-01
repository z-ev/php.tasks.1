<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller {

	public function loginAction() {
        $errors = false;
        $messages = '';

        if ($_REQUEST) {

            if (isset($_POST["change_fio"])) {
                $new_fio = htmlspecialchars($_POST["change_fio"]);
                $this->model->changeFio($new_fio);header( 'Location: /account/cabinet', true, 301 );
            }
            if (isset($_POST["change_pass"])) {
                $change_pass = htmlspecialchars($_POST["change_pass"]);
                if ($this->model->changePass($change_pass)) {
                    header( 'Location: /account/cabinet', true, 301 );
                }
            }

            if (isset($_POST["act"])) {$this->model->logout();header( 'Location: /account/login', true, 301 );}

            isset($_POST["user_login"]) ? $user_l = $_POST['user_login'] : $user_l = '';
            isset($_POST["user_password"]) ? $user_p = $_POST['user_password'] : $user_p = '';
            isset($_POST["user_r"]) ? $user_r = $_POST['user_r'] : $user_r = '';

            $user_login = $this->model->authorize($user_l, $user_p, $user_r);

            if ($user_login) {
                $messages = '<div class="alert alert-success" role="alert">Добро пожаловать!</div>';
                header( 'Location: /account/cabinet', true, 301 );
            } else

                {$messages = '<div class="alert alert-danger" role="alert">Не верный логин или пароль</div>';}

            $vars = [
                'messages' => $messages,
                'login' => $user_l,
            ];


            $this->view->render('login', $vars);


        } else {


            $vars = [
                'messages' => '',
                'login' => '',
                'email' => '',
                'password' => '',
            ];
		$this->view->render('Вход', $vars);}
	}



	public function registerAction() {

	    if ($_REQUEST) {

	        $errors = false;
            $messages = '';

            isset($_POST["user_login"]) ? $user_l = $_POST['user_login'] : $user_l = '';
            isset($_POST["user_email"]) ? $user_e = $_POST['user_email'] : $user_e = '';
            isset($_POST["user_password"]) ? $user_p = $_POST['user_password'] : $user_p = '';

            $check_login = $this->model->checkLogin($user_l);
            $check_email = $this->model->checkEmail($user_e);

            if ($check_login) {$errors = true; $messages .= '<div class="alert alert-danger" role="alert">Пользователь: '.$user_l.' - уже существует.</div>';} else {$messages .= '<div class="alert alert-success" role="alert">Пользователь: '.$user_l.' -cвободен для регистрации</div>';}
            if (!$check_email) {$errors = true; $messages .=  '<div class="alert alert-danger" role="alert">Введите корректный email</div>';}


            if (!$errors) { $reg_user = $this->model->regUser($user_l, $user_e, $user_p);

            };

            if ($reg_user) {$messages = '<div class="alert alert-success" role="alert">Пользователь создан</div>';
               /* foreach ($reg_user as $key=>$param) {
                    $messages .= '<br>'.$key. ' '.$param.'<br>';
                } */


            }

            $vars = [
                'messages' => $messages,
                'login' => $user_l,
                'email' => $user_e,
                'password' => $user_p,
            ];

            $this->view->render('Регистрация', $vars);
        } else {
            $vars = [
                'messages' => '',
                'login' => '',
                'email' => '',
                'password' => '',
            ];
            $this->view->render('Регистрация', $vars);
        }







	}


    public function cabinetAction()
    {
        if ($this->model->isAuthorized()){
            $user_info = $this->model->getUserInfo();
        } else {$user_info='';}
        $dbl_emails = $this->model->getDblEmails();
        $orders_all = $this->model->getAllOrders();
        $users0 = $this->model->getUsers0();
        $users2 = $this->model->getUsers2();

        $vars = [
            'user_info' => $user_info,
            'dbl_emails' => $dbl_emails,
            'orders_all' => $orders_all,
            'users0' => $users0,
            'users2' => $users2,
        ];
        $this->view->render('Личный кабинет', $vars);

    }







}