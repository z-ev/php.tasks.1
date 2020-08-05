<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller {

    /**
     * Авторизация, выход, смена пароля и фамилии
     */
	public function loginAction() {
        $errors = false;
        $messages = '';

        if ($_REQUEST) {
             // Если существует change_fio то обновляем фамилию
            if (isset($_POST["change_fio"])) {
                $new_fio = htmlspecialchars($_POST["change_fio"]);
                $this->model->changeFio($new_fio);
                $this->view->redirect('/account/cabinet');
            }

            // Если существует change_pass то обновляем пароль
            if (isset($_POST["change_pass"])) {
                $change_pass = htmlspecialchars($_POST["change_pass"]);
                if ($this->model->changePass($change_pass)) {
                    $this->view->redirect('/account/cabinet');
                }
            }

            // Если logout существует то выходим из системы
            if (isset($_POST["logout"])) {if ($this->model->logout()) {setcookie("sid", "");}}

            // Если существуют user_login, user_password, user_r то передаем их для авторизации
            isset($_POST["user_login"]) ? $user_l = htmlspecialchars($_POST['user_login']) : $user_l = '';
            isset($_POST["user_password"]) ? $user_p = htmlspecialchars($_POST['user_password']) : $user_p = '';
            isset($_POST["user_r"]) ? $user_r = htmlspecialchars($_POST['user_r']) : $user_r = '';

            $user_login = $this->model->authorize($user_l, $user_p);

            // Если пользователь авторизован то авторизуем и редирект на кабинет
            if ($user_login) {
                $messages .= '<div class="alert alert-success" role="alert">Добро пожаловать!</div>';
                $this->view->redirect('/account/cabinet');
            } else
                {$messages .= '<div class="alert alert-danger" role="alert">Не верный логин или пароль</div>';}

            // Если пользователь не авторизован то отправляем ему сообщение, логин и рисуем страницу авторизации
            $vars = [
                'messages' => $messages,
                'login' => $user_l,
            ];
            $this->view->render('login', $vars);

        } else {
                // Если $_REQUEST пустой то отображаем страницу с чистыми полями
                $vars = [
                'messages' => '',
                'login' => '',
                'email' => '',
                'password' => '',
                ];
		        $this->view->render('Вход', $vars);
                }
	}


    /**
     * Регистрация нового пользователя
     */
	public function registerAction() {

	    if ($_REQUEST) {

	        $errors = false;
            $messages = '';

            // Если существуют user_login, user_email, user_password, то передаем их для регистрации
            isset($_POST["user_login"]) ? $user_l = htmlspecialchars($_POST['user_login']) : $user_l = '';
            isset($_POST["user_email"]) ? $user_e = htmlspecialchars($_POST['user_email']) : $user_e = '';
            isset($_POST["user_password"]) ? $user_p = htmlspecialchars($_POST['user_password']) : $user_p = '';
            // Проверяем логин на дубль
            $check_login = $this->model->checkLogin($user_l);
            // Проверяем email на корректность
            $check_email = $this->model->checkEmail($user_e);

            if ($check_login) {
                $errors = true;
                $messages .= '<div class="alert alert-danger" role="alert">Пользователь: '.$user_l.' - уже существует.</div>';
            }
            else {$messages .= '<div class="alert alert-success" role="alert">Пользователь: '.$user_l.' -cвободен для регистрации</div>';}

            if (!$check_email) {$errors = true; $messages .=  '<div class="alert alert-danger" role="alert">Введите корректный email</div>';}

            // Если ошибок нет то регестрируем пользователя
            if (!$errors) {$reg_user = $this->model->regUser($user_l, $user_e, $user_p);};

            // Если пользователь создан то авторизуем и редирект на кабинет
            if ($reg_user) {$messages = '<div class="alert alert-success" role="alert">Пользователь создан</div>';
            if ($user_login = $this->model->authorize($user_l, $user_p)) { $this->view->redirect('/account/cabinet');}
            }

            // Если регистрация не удалась то отправляем заполненные поля и сообщение об ошибках
            $vars = [
                'messages' => $messages,
                'login' => $user_l,
                'email' => $user_e,
                'password' => $user_p,
            ];
            $this->view->render('Регистрация', $vars);
        } else {
            // Если $_REQUEST пустой то отображаем страницу с чистыми полями
            $vars = [
                'messages' => '',
                'login' => '',
                'email' => '',
                'password' => '',
            ];
            $this->view->render('Регистрация', $vars);
        }

	}

    /**
     * Личный кабинет пользователя
     */
    public function cabinetAction()
    {
        // Если пользователь авторизован то получаем данныеи из модели
        if ($this->model->isAuthorized())
        {
            $user_info = $this->model->getUserInfo();
            $dbl_emails = $this->model->getDblEmails();
            $orders_all = $this->model->getAllOrders();
            $users_all = $this->model->getAllUsers();
            $users0 = $this->model->getUsers0();
            $users2 = $this->model->getUsers2();
            $vars = [
                'user_info' => $user_info,
                'dbl_emails' => $dbl_emails,
                'orders_all' => $orders_all,
                'users_all' => $users_all,
                'users0' => $users0,
                'users2' => $users2,
            ];
            $this->view->render('Личный кабинет', $vars);
        } else {
            // Если пользователь не авторизован то данные не передаем
            $this->view->render('Личный кабинет');
        }

    }

}