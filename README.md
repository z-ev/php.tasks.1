# Test task №1
* PHP
```sh
Создать страницу с авторизацией пользователя: логин и пароль и реализовать в ней:
возможность регистрации пользователя (email, логин, пароль, ФИО).
При входе в "личный кабинет" возможность сменить пароль и ФИО.
Использовать "чистый" PHP 5.6 и выше (без фреймворков) и MySQL 5.5 и выше, дизайн не важен, верстка тоже простая. 
Наворотов не нужно, хотим посмотреть просто Ваш код.
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

Необходимо составить запрос, который выведет:
* Cписок email'лов встречающихся более чем у одного пользователя.
* Cписок логинов пользователей, которые не сделали ни одного заказа.
* Cписок логинов пользователей которые сделали более двух заказов.
```
### Requirements
   The requirements to application is:
   *    **PHP - Supported Versions**: >= 7
   *    **Webserver**: Nginx or Apache
   *    **Database**: MySQL, or Maria DB

### Installation

#### 1. Git Clone
   ```sh
   $ git clone https://github.com/evgeniizab/php.tasks.1.git
   $ cd php.tasks.1
   ```
#### 2. Database
Copy app/config/db_php to app/config/db.php
```sh
$ cp app/config/db_php app/config/db.php
```
Edit app/config/db.php
```sh
return [
    'db_host' => '127.0.0.1',
    'db_port' => '3306',
    'db_name' => 'xxx',
    'db_user' => 'xxx',
    'db_password' => 'xxx',
];

```
Import DB base.sql
```sh
mysql -u USERNAME -p -h localhost BASENAME < base.sql 
```
#### 3. Install packages and run tests (17 tests)
```sh
composer install
./vendor/bin/phpunit 
```
#### 4. Open the application in a browser

![Иллюстрация к проекту](public/img/screen4.png)