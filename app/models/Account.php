<?php

namespace app\models;

use app\core\Model;

class Account extends Model
{


    public function changePass($pass)
    {
        $pass = $this->passwordHash($pass);

        $query = 'UPDATE `users` SET `password`="'.$pass["hash"].'", `salt`="'.$pass["salt"].'" WHERE id='.$_SESSION["user_id"];
        $update_pass = $this->db->query($query);

        if ($update_pass)  {return true;} else {return false;}

    }


    public function checkLogin($user_l)
    {
        $result = $this->db->column('SELECT COUNT(1) FROM users WHERE `login` = "'.$user_l.'" LIMIT 1');
        if ($result) return true;
        else return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        else return false;
    }

    public function regUser($user_l, $user_e, $user_p)
    {

        $query = "insert into users (login, email, password, salt) values (:login, :email, :password, :salt)";

        $user_exists = $this->getSalt($user_l);

        if ($user_exists) {
            throw new \Exception("User exists: " . $user_l, 1);
        }

        $haz = $this->passwordHash($user_p);

        $params = [
                'login' => $user_l,
                'email' => $user_e,
                'password' => $haz['hash'],
                'salt' => $haz['salt'],
        ];


        $create_user = $this->db->query($query, $params);
        if ($create_user) { return $params;} else { return $params;}
    }

    public function getSalt($login)
    {
        $query = 'select salt from `users` where `login` = "'.$login.'" limit 1';
        $get_salt = $this->db->column($query);
        //$get_salt = $get_salt->fetch();

        if (!$get_salt) {
            return false;
        }

        return $get_salt;

    }

    public function passwordHash($password, $salt = null, $iterations = 10)
    {
        $salt || $salt = uniqid();
        $hash = md5(md5($password . md5(sha1($salt))));

        for ($i = 0; $i < $iterations; ++$i) {
            $hash = md5(md5(sha1($hash)));
        }

        return array('hash' => $hash, 'salt' => $salt);
    }

    public function authorize($username, $password, $remember = false)
    {

        $salt = $this->getSalt($username);

        if (!$salt) {
            return false;
        }

        $hashes = $this->passwordHash($password, $salt);

        $query = 'select id, login, fio from users where login = :login and password = :password limit 1';
        $params = [
            'login' => $username,
            'password' => $hashes['hash'],
           ];

        $check_user = $this->db->query($query, $params);

        $this->user = $check_user->fetch();

        if (!$this->user) {
            $this->is_authorized = false;
        } else {
            $this->is_authorized = true;
            $this->user_id = $this->user['id'];
            $this->user_g = $this->user['user_g'];
            $this->saveSession($remember);
        }

        return $this->is_authorized;


    }

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

    public static function isAuthorized()
    {
        if (!empty($_SESSION["user_id"])) {
            return (bool)$_SESSION["user_id"];
        }
        return false;
    }

    public function logout()
    {
        if (!empty($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
        }

    }

    public function changeFio($fio)
    {
        $query = 'UPDATE `users` SET `fio`="'.$fio.'" WHERE id='.$_SESSION["user_id"];
        $update_fio = $this->db->query($query);

        if ($update_fio)  {return true;} else {return false;}

    }





    public function getUserInfo()
    {
        $query = 'SELECT login, email, fio FROM `users` WHERE id='.$_SESSION["user_id"];
        $user_info = $this->db->query($query);
        $user_info = $user_info->fetch();

        return $user_info;

    }


    /** составить запрос, который выведет список email'лов встречающихся более чем у одного пользователя */
    public function getDblEmails() {
        $result = $this->db->row('
              SELECT users.email
            FROM users
            GROUP BY users.email
            HAVING COUNT(*) > 1');
        return $result;
    }
    /** вывести список логинов пользователей которые сделали более двух заказов */
    public function getUsers2 () {
        $result = $this->db->row('
            SELECT login,email FROM users LEFT JOIN orders ON (orders.user_id = users.id) GROUP BY login, email HAVING COUNT(orders.user_id) >= 2
            ');
        return $result;
    }

    /** вывести список логинов пользователей, которые не сделали ни одного заказа */
    public function getUsers0 () {
        $result = $this->db->row('
            SELECT login,email FROM users LEFT JOIN orders ON (orders.user_id = users.id) GROUP BY login, email HAVING COUNT(orders.user_id) < 1
            ');
        return $result;
    }
    /** Все заказы */
    public function getAllOrders() {
        $result = $this->db->row('SELECT login,email,fio, orders.price FROM users LEFT JOIN orders ON (orders.user_id = users.id) GROUP BY login, email, fio, orders.price HAVING COUNT(orders.user_id) >= 1');
        return $result;
    }



    /** Все пользователи */
    public function getAllUsers() {
        $result = $this->db->row('SELECT login, email,fio FROM users ');
        return $result;
    }






}