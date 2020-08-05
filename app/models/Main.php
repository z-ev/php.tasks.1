<?php

namespace app\models;

use app\core\Model;

class Main extends Model {

    /**
     * Все заказы на главную страницу
     * @return array
     */
    public function getAllOrders() {
        $result = $this->db->row('SELECT login,email,fio, orders.price FROM users LEFT JOIN orders ON (orders.user_id = users.id) GROUP BY login, email, fio, orders.price HAVING COUNT(orders.user_id) >= 1');
        return $result;
    }


}