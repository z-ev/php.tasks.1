<?php
if ($vars['login']) { $login = $vars['login']; }
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sing in</li>
    </ol>
</nav>

<div class="jumbotron">
    <div class="row">
        <div class="col-md-8">
            <h1>Sing in</h1>

            <p class="lead">Sign in to SMVC (simple mvc)</p>
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
    <p class="text-center">Please enter your email and password</p>
    <form class="form-signin" action="/account/login" method="post">
        <label for="inputLogin" class="sr-only">Login</label>
        <input type="text" id="inputLogin" class="form-control" name="user_login" placeholder="Email address" required autofocus value="<?=$login?>">

        <label for="inputPassword" class="sr-only mt-2" name="user_password">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="user_r" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-md btn-primary btn-block" type="submit">Sign in</button>

    </form>
<?php endif; ?>
                </div>
            </div>
        </div>

    </div>




</div>
