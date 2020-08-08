# Тестовое задание для hr@work5.ru

![Иллюстрация к проекту](public/img/screen4.png)


## Getting Started 
   The requirements to application is:
   *    **PHP - Supported Versions**: >= 7.1
   *    **Webserver**: Nginx or Apache
   *    **Database**: MySQL, or Maria DB
   ### Git Clone
   ```sh
   $ git clone https://github.com/evgeniizab/php.mvc.test1.git
   $ cd php.mvc.test1
   ```
### Database
Скопируйте app/config/db_php app/config/db.php
```sh
$ cp app/config/db_php app/config/db.php
```
Отредактируйте app/config/db.php
```sh
return [
    'db_host' => '127.0.0.1',
    'db_port' => '3306',
    'db_name' => 'xxx',
    'db_user' => 'xxx',
    'db_password' => 'xxx',
];

```
Импортируйте БД base.sql
```sh
mysql -u USERNAME -p -h localhost BASENAME < base.sql 
```
Установите пакеты и выполните тесты
```sh
composer install --dev
./vendor/bin/phpunit 
```

### Задание
Проект выполнялся в качестве тестового задания.
* PHP
```sh
Создать страницу с авторизацией пользователя: логин и пароль и реализовать в ней:
возможность регистрации пользователя (email, логин, пароль, ФИО),
при входе в "личный кабинет" возможность сменить пароль и ФИО.
использовать "чистый" PHP 5.6 и выше (без фреймворков) и MySQL 5.5 и выше, дизайн не важен, верстка тоже простая. Наворотов не нужно, хотим посмотреть просто Ваш код.
```
* SQL
```sh
Есть 2 таблицы
таблица пользователей:
users
----------
`id` int(11)
`email` varchar(55)
`login` varchar(55)

и таблица заказов
orders
--------
`id` int(11)
`user_id` int(11)
`price` int(11)
```
***Необходимо :***
составить запрос, который выведет список email'лов встречающихся более чем у одного пользователя
вывести список логинов пользователей, которые не сделали ни одного заказа
вывести список логинов пользователей которые сделали более двух заказов