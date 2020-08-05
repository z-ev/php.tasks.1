<?php

namespace app\core;

use app\lib\Db;

abstract class Model {

	public $db;

    /**
     * Model constructor.
     * Присваеваем переменной db экземпляр класса Db
     */
	public function __construct()
    {
		$this->db = new Db;
	}

}