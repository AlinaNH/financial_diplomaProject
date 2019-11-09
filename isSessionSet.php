<!-- Скрипт для проверки начала сессии и хранения имени пользователя и меню сайта -->
<?php
session_start(); // Начало сессии пользователя
if(!isset($_SESSION["session_id"])){ // Перенаправление на главную страницу, если пользователь не выполнил вход
    header("location: http://financial.gq/");
}
include('classes/Database.php');
$Database = new Database();
$Database->connect(); // В случае, если все необходимые поля заполнены, создается объект базы данных и подключение к базе данных
$checkingUser = $Database->select('user', 'login', null, 'userID="'.$_SESSION["session_id"].'"');
$userData = $Database->getResult();
$userData = $userData[0];
$sessionLogin = $userData['login']; // Хранение имени пользователя (для последующего его использования в HTML)
$Database->disconnect();
?>

<html lang="en">
<head>
    <!-- Метаданные -->
    <meta charset="utf-8">
    <title><?php echo $title ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="shortcut icon" href="/img/pageicon.png" type="image/png">
    <meta content="Инструмент financial.gq позволяет анализировать данные баланса, а также определеяет оценки платежеспособности и финансовой устойчивости организации." name="description">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- /Метаданные -->

    <!-- Подключение Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Подключение шрифтов -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Подключение NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Подключение пользовательских стилей формы Wizard -->
    <link href="css/wizardStyle.css" rel="stylesheet">

    <!-- Подключение стилей сайта -->
    <link href="css/custom.min.css" rel="stylesheet">

</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <!-- Лого сайта -->
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="glyphicon glyphicon-fire"></i> <span>financial.gq</span></a>
                </div>
                <div class="clearfix"></div>

                <div class="profile clearfix">
                    <br/>
                    <div class="profile_info">
                        <h3>Welcome, <?php echo $sessionLogin;?>!</h3>
                    </div>
                </div>
                <!-- /Лого сайта -->

                <br />

                <!-- Левое меню сайта -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <br/>
                            <li><a href="intropage.php"><i class="fa fa-home"></i> Главная страница </a></li>
                            <li><a href="description.php"><i class="fa fa-edit"></i> Описание алгоритма </a></li>
                            <li><a href="upload.php"><i class="fa fa-bar-chart-o"></i> Загрузка документа </a></li>
                            <li><a href="history.php"><i class="fa fa-table"></i> История загрузок </a></li>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Главная страница" href="intropage.php">
                        <span class="fa fa-home" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Описание алгоритма" href="description.php">
                        <span class="fa fa-edit" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Загрузка документа" href="upload.php">
                        <span class="fa fa-bar-chart-o" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="История загрузок" href="history.php">
                        <span class="fa fa-table" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /Левое меню сайта -->

            </div>
        </div>

        <!-- Верхнее меню сайта -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="logout.php"><i class="fa fa-power-off"></i> Выйти </a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Верхнее меню сайта -->
