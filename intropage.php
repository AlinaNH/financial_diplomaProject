<!-- Главная страница -->

<?php
$title = "Главная страница"; // Переменная, хранящая название страницы
include('isSessionSet.php'); // Скрипт, устанавливающий сессию и меню сайта
?>

<!-- Главная часть страницы -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Главная страница</h3>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-md-12 col-sm-12 col-xs-12">

            <!-- Левая панель -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="bs-example" data-example-id="simple-jumbotron">
                            <div class="jumbotron">
                                <h3><b>Добро пожаловать в financial.gq!</b></h3>
                                <p>Инструмент financial.gq позволяет по данным загруженного в него бухгалтерского баланса определять оценки состава, струтуры и динамики значений его статей, а также оценки платежеспособности и финансовой устойчивости организации, баланс которой принадлежит.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Левая панель -->

            <!-- Правая панель -->
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Описание инструмента</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="list-unstyled timeline">
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="description.php" class="tag">
                                            <span class="fa fa-edit icons"></span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Описание алгоритма</a>
                                        </h2>
                                        <p class="excerpt">На этой странице описывается алгоритм, по которому анализируется документ баланса. Пожалуйста, прочтите его перед загрузкой баланса, чтобы понимать, на каких источниках базируется анализ баланса.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="upload.php" class="tag">
                                            <span class="fa fa-bar-chart-o icons"></span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Загрузка документа</a>
                                        </h2>
                                        <p class="excerpt">На этой странице вы можете загрузить ваш документ баланса. Следуйте внимательно инструкциям, иначе баланс может проанализироваться некорректно. И помните, что financial.gq может анализировать документы только .docx либо .doc форматов.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="history.php" class="tag">
                                            <span class="fa fa-table icons"></span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>История загрузок</a>
                                        </h2>
                                        <p class="excerpt">После того, как баланс загрузится, его карточка будет отображена на этой странице. Когда нажмете на карточку, инструмент предоставит вам полный анализ вашего баланса в соотвествии с описанным ранее алгоритмом. Помните, что вы можете загрузить столько балансов, сколько вам потребуется :)</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Правая панель -->

        </div>
    </div>
</div>
<!-- /Главная часть страницы -->

<!-- Подключение пользовательских скриптов -->
<script src="js/custom.min.js"></script>

<?php
    include('footer.php'); // Подключение разметки футера
?>