<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>

    <link href="/public/css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="/public/js/my.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>

<div class="container bm-t-6 ">
    <div class="header clearfix">
        <nav class="mt-2 navbar">
            <h3><a href="">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M11.354 5.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708 0z"></path>
                    <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path>
                </svg></a>  Test task <span class="badge badge-primary">№1</span></h3>

            <ul class="nav nav-pills pull-right">
                <li role="presentation"><a href="/">Home</a></li>
                <?php if (app\models\Account::isAuthorized()): ?>
                    <li role="presentation"><a href="/account/cabinet">Accaunt</a></li>
                    <li role="presentation"><form action="/account/login" method="POST"><input type="hidden" name="logout" value="logout"><button type="submit" class="btn btn-danger">Sign out</button></form></li>
                <?php else: ?>
                    <li role="presentation"><a href="/account/login">Sign in</a></li>
                    <li role="presentation"><a href="/account/register">Sign up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <?php echo $content; ?>

    <footer class="footer text-center mb-6">
        <p><span class="badge badge-primary">&copy; 2020 Evgenii Z.</span></p>
    </footer>
</div>

</body>
</html>