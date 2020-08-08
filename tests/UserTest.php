<?php

use PHPUnit\Framework\TestCase;
use app\models\Account;


class UserTest extends TestCase {

    private $account;
    private $user_id;

    protected function setUp() : void
    {
        $this->account = new Account();
    }

    protected function tearDown(): void
    {
        unset($this->account);
    }

    /**
     * Проверяем зарегистрироан ли пользователь с заданным логином
     */
    public function test_user_can_check_login()
    {
        $this->assertFalse($this->account->checkLogin('testuser'));
    }

    /*
     * Проверяем валидный ли емайл
     */
    public function test_user_can_check_email()
    {
        $this->assertTrue($this->account->checkEmail('user@test.ru'));
    }

    /**
     * Регистрация пользователя
     * @throws Exception
     * @depends test_user_can_check_login, test_user_can_check_email
     */
    public function test_user_can_reg()
    {
        $this->account->regUser('testuser', 'user@test.ru', '123');
        $this->assertEquals('user@test.ru', $this->account->db->column('select email from users where login="testuser"'));

    }

    /**
     * Метод смены ФИО
     * @depends test_user_can_reg
     */
    public function test_user_can_change_fio()
    {
        $this->user_id = $this->account->db->column('select id from users where login="testuser"');
        $_SESSION = ['user_id' => $this->user_id];
        $this->assertTrue($this->account->changeFio('Владимиров Игорь Андреевич'));
    }

    /**
     * Получаем массив с хэшем и солью в функции passwordHash
     */
    public function test_user_can_get_hash() {
        $this->assertArrayHasKey('hash', $this->account->passwordHash('123'));
        $this->assertArrayHasKey('salt', $this->account->passwordHash('123'));
    }

    /**
     * Создать соль по имени пользователя и найти её в базе
     * @depends test_user_can_reg
     */
    public function test_user_can_get_salt()
    {
        $salt = $this->account->db->column('select salt from users where login="testuser"');
        $this->assertEquals($salt, $this->account->getSalt('testuser'));
    }

    /**
     * Смена пароля пользователя
     * @depends test_user_can_reg
     */
    public function test_user_can_change_pass()
    {
        $this->user_id = $this->account->db->column('select id from users where login="testuser"');
        $_SESSION = ['user_id' => $this->user_id];
        $this->assertTrue($this->account->changePass('123'));
    }

    /**
     * Авторизация пользователя
     * @depends test_user_can_reg
     */
    public function test_user_can_authorize()
    {
        $this->assertTrue($this->account->authorize('testuser','123'));
    }

    /**
     *  Метод выхода из системы
     */
    public function test_user_can_logout()
    {
        $_SESSION = ["user_id" => '1'];
        $this->assertTrue($this->account->logout());
    }

    /**
     * Проверяем авторизован ли пользователь
     */
    public function test_user_isAuthorized()
    {
        $_SESSION = ["user_id" => '1'];
        $this->assertTrue($this->account->isAuthorized());
    }

    /**
     * Проверяем сохраняется ли ссесия при авторизации

    public function test_user_can_saveSession()
    {

    }
     */

    /**
     * Удаление пользователя
     * @depends test_user_can_reg
     */
    public function test_user_can_kill_user() {
        $this->user_id = $this->account->db->column('select id from users where login="testuser"');
        $this->account->killUser($this->user_id);
        $this->assertEquals('0', $this->account->db->column('SELECT COUNT(1) FROM users WHERE id = '.$this->user_id));
    }

      /**
     *  Вывод всех пользователей в личном кабинете
     */
    public function test_user_can_getAllUsers()
    {
        $this->assertIsArray($this->account->getAllUsers());
    }

    /**
     * Вывод всех заказов в личном кабинете
     */
    public function test_user_can_getAllOrders()
    {
        $this->assertIsArray($this->account->getAllOrders());
    }

    /**
     * Получение информации о пользователе
     */
    public function test_user_can_getUserInfo()
    {
        $this->assertIsArray($this->account->getUserInfo());
    }

    /**
     * Cоставить запрос, который выведет список email'лов встречающихся более чем у одного пользователя
     */
    public function test_user_can_getDblEmails()
    {
        $this->assertIsArray($this->account->getDblEmails());
    }

    /**
     * Вывести список логинов пользователей которые сделали более двух заказов
     */
    public function test_user_can_getUsers2()
    {
        $this->assertIsArray($this->account->getUsers2());
    }

    /**
     * Вывести список логинов пользователей, которые не сделали ни одного заказа
     */
    public function test_user_can_getUsers0()
    {
        $this->assertIsArray($this->account->getUsers0());
    }

}



