<?php
if ($vars['login']) { $login = $vars['login']; }
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">Вход</li>
    </ol>
</nav>

<div class="jumbotron">
    <div class="row">
        <div class="col-md-8">
            <h1>Вход</h1>

            <p><small>Введите логин и пароль чтобы войти в личный кабинет</small></p>
            <?php if ($vars['messages']): ?>

                <?=$vars['messages']?>

            <?php endif; ?>

        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
<?php if (app\models\Account::isAuthorized()): ?>
    <p>Здравствуйте. Вы можете войти в Ваш личный кабинет!</p>
    <p><a class="btn btn-lg btn-success" href="/account/cabinet/" role="button">Личный кабинет</a></p>
<?php else: ?>
    <p class="text-center">Введите Ваш логин и пароль</p>
    <form class="form-signin" action="/account/login" method="post">
        <div class="form-group">
        <label for="inputLogin" class="sr-only">Логин</label>
        <input type="text" id="inputLogin" class="form-control" name="user_login" placeholder="Логин" required autofocus value="<?=$login?>">
        </div>
        <div class="form-group">
        <label for="inputPassword" class="sr-only mt-2">Пароль</label>
        <input type="password" id="inputPassword" name="user_password" class="form-control" placeholder="Пароль" required>
        </div>
        <div class="form-group">
        <div class="checkbox mb-3">
          <!--  <label>
                <input type="checkbox" name="user_r" value="remember-me"> Запомнить меня
            </label> -->
        </div>
        </div>

        <div class="form-group">
        <button class="btn btn-md btn-primary btn-block" type="submit">Войти</button>
        </div>
    </form>
<?php endif; ?>
                </div>
            </div>
        </div>

    </div>




</div>
