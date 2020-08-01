
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">Личный кабинет</li>
    </ol>
</nav>

<?php if (app\models\Account::isAuthorized()): ?>


<div class="jumbotron">

    <div class="row">
        <div class="col-md-8">
            <h1>Личный кабинет</h1>
            <p>Личный кабинет пользователя</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Cписок email'лов встречающихся более чем у одного пользователя</h3>
                        </div>
                        <div class="panel-body">
                            <?php foreach ($dbl_emails as $email): ?>
                                <p><?=$email['email']?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Пользователи без заказов</h3>
                        </div>
                        <div class="panel-body">
                            <?php foreach ($users0 as $user0): ?>
                                <p><?=$user0['login']?> (<?=$user0['email']?>)</p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Пользователи > 2 Заказов</h3>
                        </div>
                        <div class="panel-body">
                            <?php foreach ($users2 as $user2): ?>
                                <p><?=$user2['login']?> (<?=$user2['email']?>)</p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Редактировать данные</h3>
                 <?php if ($vars['user_info']): $user_info = $vars['user_info']; ?>
                     <form action="/account/login" method="POST" class="form-signin">
                         <div class="form-group">
                        <input type="text" disabled value="<?=$user_info['login']?>" name="" class="form-control">
                         </div>
                         <div class="form-group">
                        <input type="text" disabled value="<?=$user_info['email']?>" name="" class="form-control">
                         </div>
                         <div class="form-group">
                            <input type="text" value="<?=$user_info['fio']?>" name="change_fio" class="form-control" placeholder="Фамилия">
                         </div>
                         <div class="form-group">
                             <button type="submit" class="btn btn-md btn-primary btn-block">Сохранить</button>
                         </div>
                        </form>
                        <form action="/account/login" method="POST" class="form-signin">
                            <div class="form-group">
                            <input type="password" id="change_pass" class="form-control" placeholder="Пароль" name="change_pass" required>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-md btn-primary btn-block">Сменить пароль</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>




</div>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Все заказы</h3>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($orders_all as $order): ?>
                    <li class="list-group-item"><?=$order['fio']?> - <?=$order['login']?> (<?=$order['email']?>) $<?=$order['price']?></li>
                <?php endforeach; ?>
            </ul>
        </div>

    </div>
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Все пользователи</h3>
            </div>
            <ul class="list-group list-group-flush">
                <?php foreach ($users_all as $user): ?>
                    <li class="list-group-item"><?=$user['fio']?> - <?=$user['login']?> (<?=$user['email']?>)</li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>






<?php else: ?>
    <div class="jumbotron">
        <h1>Личный кабинет</h1>
        <p>Доступно только авторизованным пользователям</p>
        <p><a class="btn btn-lg btn-primary" href="/account/login" role="button">Войти</a></p>
    </div>




<?php endif; ?>



