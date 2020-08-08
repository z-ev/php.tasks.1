<?php

namespace app\models;

use app\core\Model;

class Account extends Model
{
    public $user_id;
    /**
     * Меняем пароль пользователя
     * @param $pass
     * @return bool
     */
    public function changePass($pass)
    {
        // Генерируем хэш
        $pass = $this->passwordHash($pass);
        // Обновляем хэш в базе
        $query = 'UPDATE `users` SET `password`="'.$pass["hash"].'", `salt`="'.$pass["salt"].'" WHERE id='.$_SESSION["user_id"];
        $update_pass = $this->db->query($query);
        if ($update_pass)  {return true;} else {return false;}

    }

    /**
     * Проверяем логин пользователя на дубли
     * @param $user_l
     * @return bool
     */
    public function checkLogin($user_l)
    {
        $result = $this->db->column('SELECT COUNT(1) FROM users WHERE `login` = "'.$user_l.'" LIMIT 1');
        if ($result) return true;
        else return false;
    }

    /**
     * Валидируем почту пользователя
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        else return false;
    }

    /**
     * Регистрируем пользователя
     * @param $user_l
     * @param $user_e
     * @param $user_p
     * @return array
     * @throws \Exception
     */
    public function regUser($user_l, $user_e, $user_p)
    {
        // Готовим запрос
        $query = "insert into users (login, email, password, salt) values (:login, :email, :password, :salt)";

        // Проверяем есть ли соль для такого имени пользователя в базе
        $user_exists = $this->getSalt($user_l);
        // Если есть то возвращаем ошибку, так как пользователь с таким логином уже зарегестрирован
        if ($user_exists) {throw new \Exception("User exists: " . $user_l, 1);}

        // Генерируем хэш и соль для пользователя
        $haz = $this->passwordHash($user_p);

        $params = [
                'login' => $user_l,
                'email' => $user_e,
                'password' => $haz['hash'],
                'salt' => $haz['salt'],
        ];

        $create_user = $this->db->query($query, $params);

        // Пытаемся зарегистрировать пользователя
        if ($create_user) {return $params;} else { return $params;}

    }

    /**
     * Ищем соль у зарегистрированных пользователей
     * @param $login
     * @return bool|mixed
     */
    public function getSalt($login)
    {
        $query = 'select salt from `users` where `login` = "'.$login.'" limit 1';
        $get_salt = $this->db->column($query);

        if (!$get_salt) {return false;}

        return $get_salt;

    }

    /**
     * Создаем хэш и соль для пароля пользователя
     * @param $password
     * @param null $salt
     * @param int $iterations
     * @return array
     */
    public function passwordHash($password, $salt = null, $iterations = 10)
    {
        $salt || $salt = uniqid();
        $hash = md5(md5($password . md5(sha1($salt))));

        for ($i = 0; $i < $iterations; ++$i) {
            $hash = md5(md5(sha1($hash)));
        }

        return array('hash' => $hash, 'salt' => $salt);
    }

    /**
     * Авторизация пользователя
     * @param $username
     * @param $password
     * @param bool $remember
     * @return bool
     */
    public function authorize($username, $password, $remember = false)
    {
        //Проверяем существует ли соль для данного пользователя в базе
        $salt = $this->getSalt($username);
        if (!$salt) {return false;}

        // Создаем хэш из введенного пароля и полученной соли
        $hashes = $this->passwordHash($password, $salt);

        $query = 'select id, login, fio from users where login = :login and password = :password limit 1';
        $params = [
            'login' => $username,
            'password' => $hashes['hash'],
           ];


        $check_user = $this->db->query($query, $params);
        $this->user = $check_user->fetch();


        if (!$this->user) {
            // Если хэш пароля не совпадает с хэшем в базе то...
            $this->is_authorized = false;
        } else {
            // Если хэш пароля совпадает с хэшем в базе то...
            $this->is_authorized = true;
            $this->user_id = $this->user['id'];
            $this->saveSession($remember);
        }

        return $this->is_authorized;

    }

    /**
     * Если стоит галочка "Запомнить менять" то сохраняем сессию в cookie
     * @param bool $remember
     * @param bool $http_only
     * @param int $days
     */
    public function saveSession($remember = false, $http_only = true, $days = 7)
    {
        $_SESSION["user_id"] = $this->user_id;

        if ($remember) {
            // Save session id in cookies
            $sid = session_id();

            $expire = time() + $days * 24 * 3600;
            $domain = ""; // default domain
            $secure = false;
            $path = "/";

            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    /**
     * Проверяем авторизован ли пользователь
     * @return bool
     */
    public static function isAuthorized()
    {
        if (!empty($_SESSION["user_id"])) {
            return (bool)$_SESSION["user_id"];
        }
        return false;
    }

    /**
     * Выходим из системы
     */
    public function logout()
    {
        if (!empty($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
            return true;
        }

    }

    /**
     * Меняем фамилию пользователя
     * @param $fio
     * @return bool
     */
    public function changeFio($fio)
    {
        $query = 'UPDATE `users` SET `fio`="'.$fio.'" WHERE id='.$_SESSION["user_id"];
        $update_fio = $this->db->query($query);

        if ($update_fio)  {return true;} else {return false;}

    }

    /**
     * Информация о пользователе для личного кабинета
     * @return bool|mixed|\PDOStatement
     */
    public function getUserInfo()
    {
        $query = 'SELECT id, login, email, fio FROM `users` WHERE id='.$_SESSION["user_id"];
        $user_info = $this->db->query($query);
        $user_info = $user_info->fetch();

        return $user_info;

    }

    /**
     * Cоставить запрос, который выведет список email'лов встречающихся более чем у одного пользователя
     * @return array
     */
    public function getDblEmails() {
        $result = $this->db->row('
              SELECT users.email
            FROM users
            GROUP BY users.email
            HAVING COUNT(*) > 1');
        return $result;
    }

    /**
     * Вывести список логинов пользователей которые сделали более двух заказов
     * @return array
     */
    public function getUsers2 () {
        $result = $this->db->row('
            SELECT login,email FROM users LEFT JOIN orders ON (orders.user_id = users.id) GROUP BY login, email HAVING COUNT(orders.user_id) >= 2
            ');
        return $result;
    }

    /**
     * Вывести список логинов пользователей, которые не сделали ни одного заказа
     * @return array
     */
    public function getUsers0 () {
        $result = $this->db->row('
            SELECT login,email FROM users LEFT JOIN orders ON (orders.user_id = users.id) GROUP BY login, email HAVING COUNT(orders.user_id) < 1
            ');
        return $result;
    }

    /**
     * Все заказы в личный кабинет
     * @return array
     */
    public function getAllOrders() {
        $result = $this->db->row('SELECT login,email,fio, orders.price FROM users LEFT JOIN orders ON (orders.user_id = users.id) GROUP BY login, email, fio, orders.price HAVING COUNT(orders.user_id) >= 1');
        return $result;
    }

    /**
     * Все пользователи в личный кабинет
     * @return array
     */
    public function getAllUsers() {
        $result = $this->db->row('SELECT login, email,fio FROM users ');
        return $result;
    }

    public function killUser($id)
    {
        $result = $this->db->query('DELETE FROM `users` WHERE id='.$id);
        if ($result) { return true;} else {return false;}
    }
}