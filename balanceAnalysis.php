<!-- Страница анализа балансов -->

<?php
    $title = "Анализ баланса"; // Переменная, хранящая название страницы
    include('isSessionSet.php'); // Скрипт, устанавливающий сессию и меню сайта
    include('balanceAnalysisGenerator.php'); // Скрипт, генерирующий анализ баланса
?>

        <!-- Главная часть страницы -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="row">

                        <div id="balance">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h3>Анализ документа</h3>
                                        <div class="clearfix"></div>
                                        <a href="history.php"><i class="fa fa-arrow-left"></i> Вернуться назад</a>
                                    </div>
                                    <div class="x_content">
                                        <div class="container">
                                            <br/>
                                            <div id="balanceAnalysis">
                                                <!-- Основная информация о балансе -->
                                                <h3 style="text-align:center;"><?php echo $companyName[0]['companyName']; ?></h3>
                                                <p>Отчетный период баланса: <?php echo $reportPeriod[0]['reportPeriod']; ?></p>
                                                <p>Денежная единица баланса: <?php echo $currencyUnit[0]['currencyUnit']; ?></p>
                                                <br/>
                                                <h2>Оценка состава, структуры и динамики статей баланса</h2>
                                                <br/>
                                                <!-- /Основная информация о балансе -->

                                                <!-- Первая глава -->
                                                <div class="col-md-6 col-sm-6 col-xs-12 barChart">
                                                    <div class="x_panel flexibleChart">
                                                        <div class="x_title">
                                                            <h2>Долгосрочные активы</h2>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <canvas id="chartChapter1"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p><?php for ($i = 0; $i < count($reportChapter1); $i++) { echo $reportChapter1[$i]; } ?></p> <!-- Отчет первой главы -->
                                                <div class="clearfix"></div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped jambo_table bulk_action">
                                                        <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">Статья</th>
                                                            <th class="column-title">Начальное значение</th>
                                                            <th class="column-title">% начальная структура</th>
                                                            <th class="column-title">Изменение</th>
                                                            <th class="column-title">% Изменение</th>
                                                            <th class="column-title">Конечное значение</th>
                                                            <th class="column-title">% конечная структура</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php for ($i = 0; $i < count($table1); $i++) { echo $table1[$i]; } ?> <!-- Данные таблицы первой главы -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /Первая глава -->

                                                <div class="clearfix"></div>

                                                <!-- Вторая глава -->
                                                <div class="col-md-6 col-sm-6 col-xs-12 barChart">
                                                    <div class="x_panel flexibleChart">
                                                        <div class="x_title">
                                                            <h2>Краткосрочные активы</h2>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <canvas id="chartChapter2"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p><?php for ($i = 0; $i < count($reportChapter2); $i++) { echo $reportChapter2[$i]; } ?></p> <!-- Отчет второй главы -->
                                                <div class="clearfix"></div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped jambo_table bulk_action">
                                                        <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">Статья</th>
                                                            <th class="column-title">Начальное значение</th>
                                                            <th class="column-title">% начальная структура</th>
                                                            <th class="column-title">Изменение</th>
                                                            <th class="column-title">% Изменение</th>
                                                            <th class="column-title">Конечное значение</th>
                                                            <th class="column-title">% конечная структура</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php for ($i = 0; $i < count($table2); $i++) { echo $table2[$i]; } ?> <!-- Данные таблицы второй главы -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /Вторая глава -->

                                                <div class="clearfix"></div>

                                                <p><?php echo $reportPart1; ?></p> <!-- Итог Активов баланса -->
                                                <div class="clearfix"></div>

                                                <!-- Третья глава -->
                                                <div class="col-md-6 col-sm-6 col-xs-12 barChart">
                                                    <div class="x_panel flexibleChart">
                                                        <div class="x_title">
                                                            <h2>Собственный капитал</h2>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <canvas id="chartChapter3"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p><?php for ($i = 0; $i < count($reportChapter3); $i++) { echo $reportChapter3[$i]; } ?></p> <!-- Отчет третьей главы -->
                                                <div class="clearfix"></div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped jambo_table bulk_action">
                                                        <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">Статья</th>
                                                            <th class="column-title">Начальное значение</th>
                                                            <th class="column-title">% начальная структура</th>
                                                            <th class="column-title">Изменение</th>
                                                            <th class="column-title">% Изменение</th>
                                                            <th class="column-title">Конечное значение</th>
                                                            <th class="column-title">% конечная структура</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php for ($i = 0; $i < count($table3); $i++) { echo $table3[$i]; } ?> <!-- Данные таблицы третьей главы -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /Третья глава -->

                                                <div class="clearfix"></div>

                                                <!-- Четвертая глава -->
                                                <div class="col-md-6 col-sm-6 col-xs-12 barChart">
                                                    <div class="x_panel flexibleChart">
                                                        <div class="x_title">
                                                            <h2>Долгосрочные обязательства</h2>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <canvas id="chartChapter4"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p><?php for ($i = 0; $i < count($reportChapter4); $i++) { echo $reportChapter4[$i]; } ?></p> <!-- Отчет четвертой главы -->
                                                <div class="clearfix"></div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped jambo_table bulk_action">
                                                        <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">Статья</th>
                                                            <th class="column-title">Начальное значение</th>
                                                            <th class="column-title">% начальная структура</th>
                                                            <th class="column-title">Изменение</th>
                                                            <th class="column-title">% Изменение</th>
                                                            <th class="column-title">Конечное значение</th>
                                                            <th class="column-title">% конечная структура</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php for ($i = 0; $i < count($table4); $i++) { echo $table4[$i]; } ?> <!-- Данные таблицы четвертой главы -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /Четвертая глава -->

                                                <div class="clearfix"></div>

                                                <!-- Пятая глава -->
                                                <div class="col-md-6 col-sm-6 col-xs-12 barChart">
                                                    <div class="x_panel flexibleChart">
                                                        <div class="x_title">
                                                            <h2>Краткосрочные обязательства</h2>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <canvas id="chartChapter5"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p><?php for ($i = 0; $i < count($reportChapter5); $i++) { echo $reportChapter5[$i]; } ?></p> <!-- Отчет пятой главы -->
                                                <div class="clearfix"></div>
                                                <div class="table-responsive">
                                                    <table class="table table-striped jambo_table bulk_action">
                                                        <thead>
                                                        <tr class="headings">
                                                            <th class="column-title">Статья</th>
                                                            <th class="column-title">Начальное значение</th>
                                                            <th class="column-title">% начальная структура</th>
                                                            <th class="column-title">Изменение</th>
                                                            <th class="column-title">% Изменение</th>
                                                            <th class="column-title">Конечное значение</th>
                                                            <th class="column-title">% конечная структура</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php for ($i = 0; $i < count($table5); $i++) { echo $table5[$i]; } ?> <!-- Данные таблицы пятой главы -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /Пятая глава -->

                                                <p><?php echo $reportPart2; ?></p> <!-- Итог Собственного капитала и обязательсв баланса -->

                                                <div class="clearfix"></div><br/>

                                                <!-- Оценка платежеспособности организации -->
                                                <h2>Оценка платежеспособности организации</h2><br/>
                                                <div class="col-md-6 col-sm-6 col-xs-12 barChart">
                                                    <div class="x_panel flexibleChart">
                                                        <div class="x_title">
                                                            <h2>Коэффициенты платежеспособности</h2>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <canvas id="solvencyReport"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p><?php echo $solvencyReport; ?></p>
                                                <!-- /Оценка платежеспособности организации -->

                                                <div class="clearfix"></div><br/>

                                                <!-- Оценка финансовой стабильности организации -->
                                                <h2>Оценка финансовой стабильности организации</h2><br/>
                                                <div class="col-md-6 col-sm-6 col-xs-12 barChart">
                                                    <div class="x_panel flexibleChart">
                                                        <div class="x_title">
                                                            <h2>Коэффициенты финансовой стабильности</h2>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                            <canvas id="financialStablilityReport"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p><?php echo $financialStablilityReport; ?></p>
                                            </div>
                                        </div>
                                        <!-- /Оценка финансовой стабильности организации -->

                                        <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /Главная часть страницы -->

        <!-- Футер -->
        <footer>
            <div class="pull-right">
                2019 <a href="http://www.sbmt.bsu.by/">Институт бизнеса БГУ</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /Футер -->

    </div>
</div>

<!-- Chart.js -->
<script src="vendors/Chart.js/dist/Chart.min.js"></script>

<!-- Подключение пользовательских скриптов -->
<script src="js/custom.min.js"></script>

<!-- Подключение скрипта генерации диаграмм -->
<?php include('diagramsGenerator.php'); ?>
</body>
</html>
