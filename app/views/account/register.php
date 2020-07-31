<?php
if ($vars['login']) { $login = $vars['login']; }
if ($vars['email']) { $email = $vars['email']; }
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sing up</li>
    </ol>
</nav>


<div class="jumbotron">
    <div class="row">
        <div class="col-md-8">
            <h1>Sing up</h1>

            <p class="lead">Sign up to SMVC (simple mvc)</p>
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
                    <p class="text-center">Please enter your login, email and password</p>
                    <form class="form-signup" method="post" action="/account/register">
                        <label for="inputName" class="sr-only">Name</label>
                        <input id="inputName" name="user_login" type="text" required class="user_login form-control" placeholder="login" value="<?=$login?>">
                        <input id="user_email" name="user_email" type="text" required class="user_email form-control" placeholder="Почта" value="<?=$email?>">
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>


                       <!-- <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>-->


                            <button id="reg" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

                    </form>
                    <?php else: ?>

                        <p>Здравствуйте. Вы можете войти в Ваш личный кабинет!</p>
                        <p><a class="btn btn-lg btn-success" href="/account/cabinet/" role="button">Личный кабинет</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>



<?php

//if ($vars) { print_r($vars); }

?>
</div>

