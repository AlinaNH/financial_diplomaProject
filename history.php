<!-- Страница истории загрузок -->

<?php
    $title = "История загрузок"; // Переменная, хранящая название страницы
    include('isSessionSet.php'); // Скрипт, устанавливающий сессию и меню сайта
    include('historyGenerator.php'); // Скрипт, генерирующий блоки балансов, есои таковы имеются в базе данных
?>

<!-- Главная часть страницы -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="row">
                <!-- Блоки балансов -->
                <div id="history">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="title_left">
                            <h3>История загрузок</h3>
                        </div>
                        <div class="clearfix"></div>
                        <?php echo $message; ?>
                        <?php for($i = 0; $i < count($content); $i++) {echo $content[$i];}?>
                    </div>
                </div>
                <!-- Блоки балансов -->
            </div>
        </div>
    </div>
</div>
<!-- /Главная часть страницы -->

<!-- Подключение пользовательских скриптов -->
<script src="js/custom.min.js"></script>

<?php
    include('footer.php'); // Подключение разметки футера
?>