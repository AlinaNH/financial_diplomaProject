<!-- Страница регистрации и авторизации пользователя -->

<?php
        include('checkingSign.php'); // Подключение скрипта, проверяющего регистрацию и авторизацию пользователя
?>

<html lang="en">

<head>
    <!-- Метаданные -->
    <meta charset="utf-8">
    <title>Зарегистрироваться и войти</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="shortcut icon" href="/img/pageicon.png" type="image/png">
    <meta content="Инструмент financial.gq позволяет анализировать данные баланса, а также определеяет оценки платежеспособности и финансовой устойчивости организации."
          name="description">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- /Метаданные -->

    <!-- Подключение Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Подключение файла пользовательских стилей -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Подключение шрифтов -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Подключение NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Подключение Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Подключение стилей сайта -->
    <link href="css/custom.min.css" rel="stylesheet">

</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <p id="message" align="center"><?php echo $message;?></p>
    <div class="login_wrapper">

        <!-- Форма авторизации -->
        <div class="animate form login_form">
            <section class="login_content">
                <form method="post" action="">
                    <h1>Авторизация</h1>
                    <div>
                        <input type="text" id="a_login" name="a_login" class="form-control" placeholder="Логин"
                               required=""/>
                    </div>
                    <div>
                        <input type="password" id="a_password" name="a_password" class="form-control"
                               placeholder="Пароль" required=""/>
                    </div>
                    <div>
                        <input class="btn btn-default submit" type="submit" id="authorization" name="authorization"
                               value="Войти">
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Впервые на сайте?
                            <a href="#signup" class="to_register"> Зарегистрироваться </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1 id="logo"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i> financial.gq</h1>
                            <a href="http://financial.gq">Главная страница</a>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <!-- /Форма авторизации -->


        <!-- Форма регистрации -->
        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form method="post" action="">
                    <h1>Регистрация</h1>
                    <div>
                        <input type="text" id="r_login" class="form-control" name="r_login" placeholder="Логин"
                               required=""/>
                    </div>
                    <div>
                        <input type="email" id="r_email" class="form-control" name="r_email" placeholder="Email"
                               required=""/>
                    </div>
                    <div>
                        <input type="password" id="r_password" class="form-control" name="r_password"
                               placeholder="Пароль" required=""/>
                    </div>
                    <div>
                        <input class="btn btn-default submit" id="registration" name="registration" type="submit"
                               value="Отправить">
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change-link">Уже зарегистрировались?
                            <a href="#signin" class="to_register"> Войти </a>

                        <div class="clearfix"></div>
                        <br/>

                        <div>
                            <h1 id="logo"><i class="glyphicon glyphicon-fire" aria-hidden="true"></i> financial.gq</h1>
                            <a href="http://financial.gq">Главная страница</a>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <!-- /Форма регистрации -->
    </div>
</div>
</body>

</html>
