<!-- Страница загрузки баланса -->

<?php
    $title = "Загрузка документа"; //Переменная, хранящая название страницы
    include('isSessionSet.php'); // Скрипт, устанавливающий сессию и меню сайта
?>

<!-- Подключение стилей формы Wizard-->
<link href="vendors/colorlib-wizard-29/css/main.css" rel="stylesheet" media="all">

<!-- Главная часть страницы -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">

                        <div class="x_title">
                            <h3>Анализ документа</h3>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="container">
                                <br/>
                                <p>На данной странице можно загрузить ваш баланс, используя форму ниже. Пожалуйста, перед тем, как начать загрузку, прочитайте на <a href="intropage.php"><b>Главной странице</b></a> о том, как именно будет проанализирован ваш баланс, а также рекомендуется прочитать какой <a href="description.php"><b>Алгоритм</b></a> является основой для анализа документа баланса.</p>

                                <!-- Форма Wizard -->
                                <div id="wizard">
                                    <br/>
                                    <div class="page-wrapper p-b-100">
                                        <div class="wrapper wrapper--w820">
                                            <div class="card card-1">
                                                <div class="card-body">
                                                    <form class="wizard-container" method="POST" action="checkingFormUpload.php"
                                                          id="js-wizard-form" enctype="multipart/form-data">

                                                        <!-- Меню формы Wizard-->
                                                        <ul class="tab-list">
                                                            <div class="flex-container">
                                                                <li class="tab-list__item active">
                                                                    <a class="tab-list__link" href="#tab1"
                                                                       data-toggle="tab">
                                                                        <span class="step">1</span>
                                                                        <span class="desc">Компания</span>
                                                                    </a>
                                                                </li>
                                                                <li class="tab-list__item">
                                                                    <a class="tab-list__link" href="#tab2"
                                                                       data-toggle="tab">
                                                                        <span class="step">2</span>
                                                                        <span class="desc">Период</span>
                                                                    </a>
                                                                </li>
                                                                <li class="tab-list__item">
                                                                    <a class="tab-list__link" href="#tab3"
                                                                       data-toggle="tab">
                                                                        <span class="step">3</span>
                                                                        <span class="desc">Валюта</span>
                                                                    </a>
                                                                </li>
                                                                <li class="tab-list__item">
                                                                    <a class="tab-list__link" href="#tab4"
                                                                       data-toggle="tab">
                                                                        <span class="step">4</span>
                                                                        <span class="desc">Загрузка</span>
                                                                    </a>
                                                                </li>
                                                        </ul>
                                                        <!-- /Меню формы Wizard -->

                                                        <!-- Поля ввода формы Wizard -->
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tab1">
                                                                <div class="form">
                                                                    <div class="input-group">
                                                                        <input class="input--style-1"
                                                                               type="text"
                                                                               name="companyName"
                                                                               id="companyName"
                                                                               placeholder="Наименование компании"
                                                                               required="required">
                                                                        <a class="btn--next" href="#">
                                                                            > </a>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <p style="text-align:center;">Введите наименование компании. <b style="color:tomato">Не используйте кавычки ""!</b></p>
                                                            </div>

                                                            <div class="tab-pane" id="tab2">
                                                                <div class="form">
                                                                    <div class="input-group">
                                                                        <input class="input--style-1"
                                                                               type="text"
                                                                               name="reportPeriod"
                                                                               id="reportPeriod"
                                                                               placeholder="01.01.2018-31.12.2018"
                                                                               required="required">
                                                                        <a class="btn--next" href="#">
                                                                            > </a>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <p style="text-align:center;">Введите рамки отчетного периода в указанном формате.</b></p>
                                                            </div>

                                                            <div class="tab-pane" id="tab3">
                                                                <div class="form">
                                                                    <div class="input-group">
                                                                        <input class="input--style-1"
                                                                               type="text"
                                                                               name="currencyUnit"
                                                                               id="currencyUnit"
                                                                               placeholder="тысяча белорусских рублей"
                                                                               required="required">
                                                                        <a class="btn--next" href="#">
                                                                            > </a>
                                                                    </div>
                                                                </div>
                                                                <p style="text-align:center;">Введите денежную единицу, в которой указаны статьи баланса.</b></p>
                                                            </div>

                                                            <div class="tab-pane" id="tab4">
                                                                <div class="form">
                                                                    <div class="input-group">
                                                                        <label for="fileToUpload" class="input--style-1 uploadButton" id="FileSelecting">Выбрать</label>
                                                                        <input style="opacity: 0; z-index: -1;" type="file" name="fileToUpload" id="fileToUpload">
                                                                        <a class="btn--next" name="fileToUpload"
                                                                           href="#"
                                                                           onclick="document.forms[0].submit()">
                                                                            > </a>
                                                                    </div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <p style="text-align:center;">Здесь необходимо загружать баланс. Нажмите на "Выбрать" и выберите необходимый документ, который нужно загрузить и проанализировать. <b style="color:tomato;">Помните, что можно загружать балансы только в форматах docx или doc. Также, для корректного анализа, постарайтесь убрать лишнюю информацию с баланса и оставить только таблицу баланса. Пожалуйста, проследите, если указано значение только в одной из рамок периода, то во второй рамке поставьте 0. Например, строка: Прочие долгосрочне обязательства 560 22563 0.</b> После того, как выберите баланс, нажмите на стрелку и подождите несколько секунд, пока программа проанализирует его.</p>
                                                            </div>
                                                        </div>
                                                        <!-- Поля ввода формы Wizard -->

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Форма Wizard -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Главная часть страницы -->

<!-- Подключение пользовательских скриптов -->
<script src="js/custom.min.js"></script>

<!-- Подключение jquery-скриптов для формы Wizard -->
<script src="vendors/colorlib-wizard-29/vendor/jquery-validate/jquery.validate.min.js"></script>
<script src="vendors/colorlib-wizard-29/vendor/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>

<!-- Подключение скриптов для формы Wizard -->
<script src="vendors/colorlib-wizard-29/js/global.js"></script>

<?php
    include('footer.php'); // Подключение разметки футера
?>