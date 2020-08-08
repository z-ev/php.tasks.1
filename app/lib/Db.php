<?php

namespace app\lib;

use PDO;

class Db {

	protected $db;
	
	public function __construct()
    {
        $config = require 'app/config/db.php';
		$this->db = new PDO('mysql:host='.$config['db_host'].';port='.$config['db_port'].';dbname='.$config['db_name'].'', $config['db_user'], $config['db_password']);
	}


	public function query($sql, $params = [])
    {
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $val) {
				$stmt->bindValue(':'.$key, $val);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function row($sql, $params = [])
    {
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = [])
    {
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}

	public function lastInsertId() {
	    return $this->db->lastInsertId();
    }

    /**
     * Транзакции

    public function connect_db()
    {
        $driver = array(PDO :: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES `utf8`');
        try {
            $dbx = new PDO('mysql:host='.$config['db_host'].';port='.$config['db_port'].';dbname='.$config['db_name'].'', $config['db_user'], $config['db_password'], $driver); //создаем новый объект класса PDO для взаимодействия с БД
            $dbx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Устанавливаем режим обработки ошибок ERRMODE_EXCEPTION
        } catch (PDOException $e) {
            echo 'Подключение не удалось: '. $e->getCode() .'|'. $e->getMessage());
           return false;
         }
        return $dbx;
    }
    public function doQuery($dbx, $sql, $count_db = 0) {
        if($count_db>5) {
            echo "Кол-во попыток подключения превысило допустимый лимит";
            return false;
        }
        try {
            if($dbx->inTransaction()) {
                echo "Транзакция уже начата";
                return false;
            }
            $dbx->beginTransaction();//Начинаем транзакцию
            $dbx->exec($sql);
        } catch (PDOException $e) {
            if($dbx->inTransaction())
                $dbx->rollBack();
            if($e->errorInfo[1] >= 2000&&$dbx=connect_db()) { //если код ошибки > 2000 (это потеря соединения с БД и пр.) то пробуем переподключится и выполнить запрос заново
                return doQuery($dbx, $sql, $count_db++);
            } else {
                echo 'PDOException: '.$e->getCode() .'|'. $e->getMessage();
                return false;
            }
        }
        if($dbx->inTransaction())
            return $dbx->commit();
    }
*/

}