<?php
if ($vars['login']) { $login = $vars['login']; }
if ($vars['email']) { $email = $vars['email']; }
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">Регистрация</li>
    </ol>
</nav>


<div class="jumbotron">
    <div class="row">
        <div class="col-md-8">
            <h1>Регистрация</h1>

            <p class="lead">Зарегистрируйтесь в нашей системе</p>
            <div id="result" class="white-popup mfp-hide22" >
                <?php if ($vars['messages']): ?>

                        <?=$vars['messages']?>

                <?php endif; ?>
            </div>

        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php if (!app\models\Account::isAuthorized()): ?>
                    <p class="text-center">Введите логин, почту и пароль</p>
                    <form class="form-signup" method="post" action="/account/register">
                        <div class="form-group">
                        <label for="inputName" class="sr-only">Name</label>
                        <input id="inputName" name="user_login" type="text" required class="user_login form-control" placeholder="Логин" value="<?=$login?>">
                        </div>
                        <div class="form-group">
                        <input id="user_email" name="user_email" type="text" required class="user_email form-control" placeholder="Почта" value="<?=$email?>">
                        </div>
                            <div class="form-group">
                        <input type="password" id="inputPassword"  name="user_password"  class="form-control" placeholder="Пароль" required>
                        </div>

                       <!-- <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>-->

                        <div class="form-group">
                            <button id="reg" class="btn btn-md btn-primary btn-block" type="submit">Зарегистрировать</button>
                        </div>
                    </form>
                    <?php else: ?>

                        <p>Здравствуйте. Вы можете войти в Ваш личный кабинет!</p>
                        <p><a class="btn btn-lg btn-success" href="/account/cabinet/" role="button">Личный кабинет</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

</div>

