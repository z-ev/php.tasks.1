<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
    <link href="/public/css/style.css" rel="stylesheet">

    <!-- Последняя компиляция и сжатый CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Дополнение к теме -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Последняя компиляция и сжатый JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<br><br><br><br>
    <div class="container ">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="active"><a href="/">Home</a></li>
                    <li role="presentation"><a href="/account/login">Sign in </a></li>
                    <li role="presentation"><a href="/account/register">Sing up</a></li>
                    <li role="presentation"><a href="/account/cabinet">Cabinet</a></li>
                    <?php if (app\models\Account::isAuthorized()): ?>
                        <li role="presentation">
                            <form action="/account/login" method="POST">
                                <input type="hidden" name="act" value="logout">
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>

                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <h3 class="text-muted"><a href="/">SMVC</a></h3>

        </div>

        <?php echo $content; ?>



    <footer class="footer text-center">
        <p>&copy; 2020 Evgenii Z.</p>
    </footer>
    </div>

</body>
</html>