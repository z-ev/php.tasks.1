<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><a href="/">Главная</a></li>
    </ol>
</nav>

<div class="jumbotron">

    <div class="row">
        <div class="col-md-8">
            <h1>Здравствуйте</h1>
            <p class="lead">Это тестовое задание для work5.ru</p>
            <p><small>Пользователь: user1 пароль:123<br>Пароль одинаковый для всех пользователей</small></p>
        </div>
        <div class="col-md-4">

            <div class="panel panel-default">
                <div class="panel-body">
            <?php if (!app\models\Account::isAuthorized()): ?>
                <p class="text-center">Авторизуйтесь или создайте пользователя</p>
                    <div class="form-group">
                <a class="btn btn-md btn-primary btn-block" href="/account/login" role="button">Войти</a>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-md btn-primary btn-block" href="/account/register" role="button">Регистрация</a>
                    </div>
                    <?php else: ?>
                <p>Здравствуйте. Вы можете войти в Ваш личный кабинет!</p>
                <p><a class="btn btn-md btn-primary btn-block" href="/account/cabinet/" role="button">Личный кабинет</a></p>

            <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Все заказы</h3>
    </div>
    <ul class="list-group list-group-flush">
        <?php

        foreach ($vars as $order): ?>
            <li class="list-group-item"><?=$order['fio']?> <?=$order['login']?> (<?=$order['email']?>) $<?=$order['price']?></li>
        <?php endforeach; ?>
    </ul>



</div>



