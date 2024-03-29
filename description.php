<!-- Страница описания алгоритма -->

<?php
    $title = "Описание документа"; // Переменная, хранящая название страницы
    include('isSessionSet.php'); // Скрипт, устанавливающий сессию и меню сайта
?>

<!-- Главная часть страницы -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">

            <div class="title_left">
                <h3>Описание алгоритма</h3>
                <div class="clearfix"></div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <p>Инструмент <b>financial.gq</b> умеет анализировать информацию, полученную из бухгалтерских балансов. Его основные функции –</p>
                <ul>
                    <li>анализ состава, структуры и динамики значений его статей;</li>
                    <li>анализ платежеспособности;</li>
                    <li>анализ финансовой устойчивости.</li>
                </ul>
                <p>Анализ бухгалтерского баланса проводится на основании бланка бухгалтерского баланса, представленного в Приложении к постановлению Министерства финансов Республики Беларусь № 104 от 12.12.2016 в ред. № 16 от 06.03.2018, № 74 от 22.12.2018.</p>

                <div class="clearfix"></div>

                <h2>Анализ состава, структуры и динамики значений статей баланса</h2>
                <p>При разработке отчета об анализе состава, структуры и динамики значений статей баланса, <b>financial.gq</b> совершает следущие действия:</p>
                <ul>
                    <li>Расчет разницы между значениями статей на начало отчетного периода и на конец отчетного периода;</li>
                    <li>Расчет доли изменения между значениями статей на начало отчетного периода и на конец отчетного периода;</li>
                    <li>Расчет доли каждой статьи от итога главы на начало отчетного периода и на конец отчетного периода (начальная и конечная структура);</li>
                    <li>Генерация отчета анализа состава, структуры и динамики значений статей баланса;</li>
                    <li>Генерация столбиковых диаграмм, демонстрирующих изменения значений статей на начало отчетного периода и на конец отчетного периода;</li>
                    <li>Генерация таблиц, отобращающих исходные данные и все выполненные расчеты.</li>
                </ul>

                <div class="clearfix"></div>

                <h2>Оценка платежеспособности организации</h2>
                <p>При оценке платежеспособности организации <b>financial.gq</b> рассчитывает следующие показатели, предлагаемые Инструкцией о порядке расчета коэффициентов платежеспособности и проведения анализа финансового состояния и платежеспособности субъектов хозяйствования в редакции постановлений Министерства Финансов Республики Беларусь и Министерства Экономики Республики Беларусь от 07.06.2013 N 40/41, от 09.12.2013 N 75/92, от 22.02.2016 N 9/10:
                </p>
                <ul>
                    <li><b>Коэффициент текущей ликвидности (К1)</b>, который рассчитывается как отношение итога раздела II бухгалтерского баланса к итогу раздела V бухгалтерского баланса Позволяет определить, достаточно ли у фирмы оборотных средств  для своевременного покрытия текущих обязательств. Чем выше оказался данный показатель, тем выше платежеспособность предприятия. Минимальное значение – не ниже 1, чтобы оборотных средств было минимум достаточно, чтобы погасить краткосрочные обязательства. Оптимальным считают значение коэффициента  2 и более.</li>
                    <br/>
                    <li><b>Коэффициент обеспеченности собственными оборотными средствами (К2)</b>, который рассчитывается как отношение суммы итога раздела III бухгалтерского баланса и итога IV бухгалтерского баланса за вычетом итога раздела I бухгалтерского баланса к итогу раздела II бухгалтерского баланса. Этот коэффициент показывает достаточность у организации собственных средств для финансирования текущей деятельности.</li>
                    <br/>
                    <p>
                        Нормативные значения коэффициента обеспеченности предприятий собственными оборотными средствами в Беларуси варьируются в зависимости от отрасли:
                        <br/>– промышленность в целом - 0,3;
                        <br/>– топливная промышленность - 0,3;
                        <br/>– химическая промышленность - 0,2;
                        <br/>– машиностроение и металлообработка - 0,2;
                        <br/>– станкостроение - 0,2;
                        <br/>– машиностроение - 0,1;
                        <br/>– с/х машиностроение - 0,1;
                        <br/>– производство средств связи - 0,05;
                        <br/>– производство стройматериалов - 0,15;
                        <br/>– легкая промышленность - 0,2;
                        <br/>– сельское хозяйство - 0,2;
                        <br/>– транспорт - 0,15;
                        <br/>– почтовая связь - 0,05;
                        <br/>– радио и электросвязь - 0,15;
                        <br/>– строительство - 0,15;
                        <br/>– торговля и общественное питание - 0,1;
                        <br/>– материально-техническое снабжение и сбыт - 0,15;
                        <br/>– ЖКХ в целом - 0,1;
                        <br/>– газоснабжение - 0,3;
                        <br/>– непроизводственные виды бытового обслуживания населения - 0,1;
                        <br/>– наука - 0,2;
                        <br/>– прочее - 0,2.
                    </p>
                    <li><b>Коэффициент обеспеченности обязательств активами (К3)</b>, который рассчитывается как отношение суммы итогов разделов IV и V бухгалтерского баланса к итогу бухгалтерского баланса. Этот коэффициент показывает, способна ли организация погасить свои долги после продажи имеющихся активов и насколько фирма является независимой от кредиторов. В Беларуси норма для Кобесп во всех отраслях экономики утверждена на уровне не выше 0,85. Но желательно чтобы его значение было как можно ниже. Суть в том, что стоимость обязательств не должна быть выше 85% суммы активов, потому что иначе фирме угрожает банкротство. Запас в 15% взят  с учетом поправки на разницу в учетной и рыночной стоимости имеющихся у предприятия активов.</li>
                </ul>

                <div class="clearfix"></div>

                <h2>Оценка финансовой устойчивости организации</h2>
                <p>При оценке финансовой устойчивости <b>financial.gq</b> рассчитывает следующие показатели, предлагаемые Инструкцией о порядке расчета коэффициентов платежеспособности и проведения анализа финансового состояния и платежеспособности субъектов хозяйствования в редакции постановлений Министерства Финансов Республики Беларусь и Министерства Экономики Республики Беларусь от 07.06.2013 N 40/41, от 09.12.2013 N 75/92, от 22.02.2016 N 9/10:
                </p>
                <ul>
                    <li><b>Коэффициент капитализации (К4)</b>, который рассчитывается как отношение суммы итогов разделов IV и V бухгалтерского баланса (строка 590 и строка 690) к итогу раздела III бухгалтерского баланса (строка 490). Значение коэффициента капитализации должно быть не более 1,0. Этот коэффициент характеризует долгосрочную платежеспособность.</li>
                    <li><b>Коэффициент финансовой независимости (К5) </b> (автономии) рассчитывается как отношение итога раздела III бухгалтерского баланса (строка 490) к итогу бухгалтерского баланса (строка 700). Значение коэффициента финансовой независимости должно быть не менее 0,4 - 0,6. Этот коэффициент показывает из каких источников (собственных или заемных) поступают основные денежные потоки предприятия, т.е. какая доля вложений в общей сумме активов сформирована из собственного капитала организации. Отсюда следует его другое название - коэффициент финансовой устойчивости.</li>
                </ul>

                <div class="clearfix"></div>

                <a href="https://myfin.by/" target="_blank">Источник: myfin.by</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- /Главная часть страницы -->

<!-- Подключение пользовательских скриптов -->
<script src="js/custom.min.js"></script>

<?php
    include('footer.php'); // Подключение разметки футера
?>