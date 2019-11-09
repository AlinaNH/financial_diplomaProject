<?php
$Database->connect(); // Подключение к базе данных
if (isset($_POST["openBalanceAnalysis"])) {
    if (!empty($_POST['balanceID'])) { // Если была нажата кнопка "Посмотреть баланс" и если на вервер был отправлен ID баланса, то из базы данных выбтраются основные данные о балансе
        $Database->select('balancerecord', 'companyName', null, 'balanceID ="' . $_POST['balanceID'] . '"');
        $companyName = $Database->getResult();
        $Database->select('balancerecord', 'reportPeriod', null, 'balanceID ="' . $_POST['balanceID'] . '"');
        $reportPeriod = $Database->getResult();
        $Database->select('balancerecord', 'currencyUnit', null, 'balanceID ="' . $_POST['balanceID'] . '"');
        $currencyUnit = $Database->getResult();

        $Database->select('balanceaccounting', '*', null, 'balanceID ="' . $_POST['balanceID'] . '"');
        $result = $Database->getResult(); // из базы данных выбираются все данные о балансе

        for ($i = 0; $i < count($result); $i++) { // перебор всех данных из баланса

            if ($result[$i]['itemName'] == 'Долгосрочные активы') { // Опредение данных первой главы баланса в отдельный массив
                $chapter1[] = $result[$i];
                $checkChapter1 = true;
            }
            if (!$checkChapter1) {
                $checkChapter1 = false;
                $chapter1[] = $result[$i];
            }
            if ($result[$i]['itemName'] == 'Краткосрочные активы') { // Опредение данных второй главы баланса в отдельный массив
                $chapter2[] = $result[$i];
                $checkChapter2 = true;
            }
            if (!$checkChapter2 && $checkChapter1) {
                $checkChapter2 = false;
                $chapter2[] = $result[$i];
            }
            if ($result[$i]['itemName'] == 'Собственный капитал') { // Опредение данных третьей главы баланса в отдельный массив
                $chapter3[] = $result[$i];
                $checkChapter3 = true;
            }
            if (!$checkChapter3 && $checkChapter2 && $checkChapter1) {
                $checkChapter3 = false;
                $chapter3[] = $result[$i];
            }
            if ($result[$i]['itemName'] == 'Долгосрочные обязательства') { // Опредение данных четвертой главы баланса в отдельный массив
                $chapter4[] = $result[$i];
                $checkChapter4 = true;
            }
            if (!$checkChapter4 && $checkChapter3 && $checkChapter2 && $checkChapter1) {
                $checkChapter4 = false;
                $chapter4[] = $result[$i];
            }
            if ($result[$i]['itemName'] == 'Краткосрочные обязательства') { // Опредение данных пятой главы баланса в отдельный массив
                $chapter5[] = $result[$i];
                $checkChapter5 = true;
            }
            if (!$checkChapter5 && $checkChapter4 && $checkChapter3 && $checkChapter2 && $checkChapter1) {
                $checkChapter5 = false;
                $chapter5[] = $result[$i];
            }

            /* Определение итогов глав баланса для дальнейших расчетов */

            if($result[$i]["itemID"] == 190) {
                $article190[0] = $result[$i];
            }
            if($result[$i]["itemID"] == 290) {
                $article290[0] = $result[$i];
            }
            if($result[$i]["itemID"] == 300) {
                $article300[0] = $result[$i];
            }
            if($result[$i]["itemID"] == 490) {
                $article490[0] = $result[$i];
            }
            if($result[$i]["itemID"] == 590) {
                $article590[0] = $result[$i];
            }
            if($result[$i]["itemID"] == 690) {
                $article690[0] = $result[$i];
            }

            /* Вывод для итога Активов баланса */

            if ($result[$i]['itemID'] == 300) {
                if ($result[$i]['startValue'] != 0) {
                    $changePercentPart1 = round(-(100 - $result[$i]['finishValue'] / $result[$i]['startValue'] * 100),2);
                }
                else {
                    $changePercentPart1 = 100;
                }
                $reportPart1 = "<span style='color:tomato;'>Значение статьи <b>" . $result[$i]['itemName'] . " (" . $result[$i]['itemID'] . ")</b> на начало отчетного периода – " . $result[$i]['startValue'] . ", в течение периода " . $result[$i]['change'] . " на " . $result[$i]['difference'] . " (" . $changePercentPart1 . "%), в результате чего значение стало равно " . $result[$i]['finishValue'] . ".</span>";
            }

            /* Вывод для итога Собственных средств и обязательств баланса */

            if ($result[$i]['itemID'] == 700) {
                if ($result[$i]['startValue'] != 0) {
                    $changePercentPart2 = round(-(100 - $result[$i]['finishValue'] / $result[$i]['startValue'] * 100),2);
                }
                else {
                    $changePercentPart2 = 100;
                }
                $reportPart2 = "<span style='color:tomato;'>Значение статьи <b>" . $result[$i]['itemName'] . " (" . $result[$i]['itemID'] . ")</b> на начало отчетного периода – " . $result[$i]['startValue'] . ", в течение периода " . $result[$i]['change'] . " на " . $result[$i]['difference'] . " (" . $changePercentPart2 . "%), в результате чего значение стало равно " . $result[$i]['finishValue'] . ".</span>";
            }
        }

        array_shift($chapter2); // Удаление последних строк массивов глав (дубликаты)
        array_shift($chapter3);
        array_shift($chapter3);
        array_shift($chapter4);
        array_shift($chapter5);

        /* Генерация вывода по первой главе и создание отдельных массивов значений для вывода javascript диаграмм */

        for ($i = 0; $i < count($chapter1); $i++) {
            if ($article190[0]['startValue'] != 0) { // Подсчет процента начального значения статьи от начального значения главы
                $startValuePersent1[$i] = round($chapter1[$i]['startValue'] / $article190[0]['startValue'] * 100,2);
            }
            else {
                $startValuePersent1[$i] = 0;
            }
            if ($chapter1[$i]['startValue'] != 0) { // Подсчет изменения показателя в периоде в процентах
                $changePercent1[$i] = round(-(100 - $chapter1[$i]['finishValue'] / $chapter1[$i]['startValue'] * 100),2);
            }
            else {
                $changePercent1[$i] = 100;
            }
            if ($article190[0]['finishValue'] != 0) { // Подсчет процента конечного значения статьи от конечного значения главы
                $finishValuePersent1[$i] = round($chapter1[$i]['finishValue'] / $article190[0]['finishValue'] * 100,2);
            }
            else {
                $finishValuePersent1[$i] = 0;
            }
            $reportChapter1[$i] = "<span>Значение статьи <b>" . $chapter1[$i]['itemName'] . " (" . $chapter1[$i]['itemID'] . ")</b> на начало отчетного периода – " . $chapter1[$i]['startValue'] ." (" . $startValuePersent1[$i] . "% от начального значения долгосрочных активов), в течение периода " . $chapter1[$i]['change'] . " на " . $chapter1[$i]['difference'] . " (" . $changePercent1[$i] . "%), в результате чего значение стало равно " . $chapter1[$i]['finishValue'] . " (" . $finishValuePersent1[$i] . "% от конечного значения долгосрочных активов).</span>";
            $table1[$i] = "<tr class=\"even pointer\">
                            <td>" . $chapter1[$i]['itemID'] . "</td>
                            <td>" . $chapter1[$i]['startValue'] ."</td>
                            <td>" . $startValuePersent1[$i] . "</td>
                            <td>" . $chapter1[$i]['difference'] . "</td>
                            <td>" . $changePercent1[$i] . "</td>
                            <td>" . $chapter1[$i]['finishValue'] . "</td>
                            <td>" . $finishValuePersent1[$i] . "</a>
                            </td>
                          </tr>";
            $itemNameChapter1[$i] = $chapter1[$i]['itemID'];
            $startValueChapter1[$i] = $chapter1[$i]['startValue'];
            $finishValueChapter1[$i] = $chapter1[$i]['finishValue'];
        }

        /* Генерация вывода по второй главе и создание отдельных массивов значений для вывода javascript диаграмм */

        for ($i = 0; $i < count($chapter2); $i++) {
            if ($article290[0]['startValue'] != 0) { // Подсчет процента начального значения статьи от начального значения главы
                $startValuePersent2[$i] = round($chapter2[$i]['startValue'] / $article290[0]['startValue'] * 100,2);
            }
            else {
                $startValuePersent2[$i] = 0;
            }
            if ($chapter1[$i]['startValue'] != 0) { // Подсчет изменения показателя в периоде в процентах
                $changePercent2[$i] = round(-(100 - $chapter2[$i]['finishValue'] / $chapter2[$i]['startValue'] * 100),2);
            }
            else {
                $changePercent2[$i] = 100;
            }
            if ($article290[0]['finishValue'] != 0) { // Подсчет процента конечного значения статьи от конечного значения главы
                $finishValuePersent2[$i] = round($chapter2[$i]['finishValue'] / $article290[0]['finishValue'] * 100,2);
            }
            else {
                $finishValuePersent2[$i] = 0;
            }
            $reportChapter2[$i] = "<span>Значение статьи <b>" . $chapter2[$i]['itemName'] . " (" . $chapter2[$i]['itemID'] . ")</b> на начало отчетного периода – " . $chapter2[$i]['startValue'] . " (" . $startValuePersent2[$i] . "% от начального значения краткосрочных активов), в течение периода " . $chapter2[$i]['change'] . " на " . $chapter2[$i]['difference'] . " (" . $changePercent2[$i] . "%), в результате чего значение стало равно " . $chapter2[$i]['finishValue'] . " (" . $finishValuePersent2[$i] . "% от конечного значения краткосрочных активов).</span>";
            $table2[$i] = "<tr class=\"even pointer\">
                            <td>" . $chapter2[$i]['itemID'] . "</td>
                            <td>" . $chapter2[$i]['startValue'] ."</td>
                            <td>" . $startValuePersent2[$i] . "</td>
                            <td>" . $chapter2[$i]['difference'] . "</td>
                            <td>" . $changePercent2[$i] . "</td>
                            <td>" . $chapter2[$i]['finishValue'] . "</td>
                            <td>" . $finishValuePersent2[$i] . "</a>
                            </td>
                          </tr>";
            $itemNameChapter2[$i] = $chapter2[$i]['itemID'];
            $startValueChapter2[$i] = $chapter2[$i]['startValue'];
            $finishValueChapter2[$i] = $chapter2[$i]['finishValue'];
        }

        /* Генерация вывода по третьей главе и создание отдельных массивов значений для вывода javascript диаграмм */

        for ($i = 0; $i < count($chapter3); $i++) {
            if ($article490[0]['startValue'] != 0) { // Подсчет процента начального значения статьи от начального значения главы
                $startValuePersent3[$i] = round($chapter3[$i]['startValue'] / $article490[0]['startValue'] * 100,2);
            }
            else {
                $startValuePersent3[$i] = 0;
            }
            if ($chapter3[$i]['startValue'] != 0) { // Подсчет изменения показателя в периоде в процентах
                $changePercent3[$i] = round(-(100 - $chapter3[$i]['finishValue'] / $chapter3[$i]['startValue'] * 100),2);
            }
            else {
                $changePercent3[$i] = 100;
            }
            if ($article490[0]['finishValue'] != 0) { // Подсчет процента конечного значения статьи от конечного значения главы
                $finishValuePersent3[$i] = round($chapter3[$i]['finishValue'] / $article490[0]['finishValue'] * 100,2);
            }
            else {
                $finishValuePersent3[$i] = 0;
            }
            $reportChapter3[$i] = "<span>Значение статьи <b>" . $chapter3[$i]['itemName'] . " (" . $chapter3[$i]['itemID'] . ")</b> на начало отчетного периода – " . $chapter3[$i]['startValue'] . " (" . $startValuePersent3[$i] . "% от начального значения собственного капитала), в течение периода " . $chapter3[$i]['change'] . " на " . $chapter3[$i]['difference'] . " (" . $changePercent3[$i] . "%), в результате чего значение стало равно " . $chapter3[$i]['finishValue'] . " (" . $finishValuePersent3[$i] . "% от конечного значения собственного капитала).</span>";
            $table3[$i] = "<tr class=\"even pointer\">
                            <td>" . $chapter3[$i]['itemID'] . "</td>
                            <td>" . $chapter3[$i]['startValue'] ."</td>
                            <td>" . $startValuePersent3[$i] . "</td>
                            <td>" . $chapter3[$i]['difference'] . "</td>
                            <td>" . $changePercent3[$i] . "</td>
                            <td>" . $chapter3[$i]['finishValue'] . "</td>
                            <td>" . $finishValuePersent3[$i] . "</a>
                            </td>
                          </tr>";
            $itemNameChapter3[$i] = $chapter3[$i]['itemID'];
            $startValueChapter3[$i] = $chapter3[$i]['startValue'];
            $finishValueChapter3[$i] = $chapter3[$i]['finishValue'];
        }

        /* Генерация вывода по четвертой главе и создание отдельных массивов значений для вывода javascript диаграмм */

        for ($i = 0; $i < count($chapter4); $i++) {
            if ($article590[0]['startValue'] != 0) { // Подсчет процента начального значения статьи от начального значения главы
                $startValuePersent4[$i] = round($chapter4[$i]['startValue'] / $article590[0]['startValue'] * 100,2);
            }
            else {
                $startValuePersent4[$i] = 0;
            }
            if ($chapter4[$i]['startValue'] != 0) { // Подсчет изменения показателя в периоде в процентах
                $changePercent4[$i] = round(-(100 - $chapter4[$i]['finishValue'] / $chapter4[$i]['startValue'] * 100),2);
            }
            else {
                $changePercent4[$i] = 100;
            }
            if ($article590[0]['finishValue'] != 0) { // Подсчет процента конечного значения статьи от конечного значения главы
                $finishValuePersent4[$i] = round($chapter4[$i]['finishValue'] / $article590[0]['finishValue'] * 100,2);
            }
            else {
                $finishValuePersent4[$i] = 0;
            }
            $reportChapter4[$i] = "<span>Значение статьи <b>" . $chapter4[$i]['itemName'] . " (" . $chapter4[$i]['itemID'] . ")</b> на начало отчетного периода – " . $chapter4[$i]['startValue'] . " (" . $startValuePersent4[$i] . "% от начального значения долгосрочных обязательств), в течение периода " . $chapter4[$i]['change'] . " на " . $chapter4[$i]['difference'] . " (" . $changePercent4[$i] . "%), в результате чего значение стало равно " . $chapter4[$i]['finishValue'] . " (" . $finishValuePersent4[$i] . "% от конечного значения долгосрочных обязательств).</span>";
            $table4[$i] = "<tr class=\"even pointer\">
                            <td>" . $chapter4[$i]['itemID'] . "</td>
                            <td>" . $chapter4[$i]['startValue'] ."</td>
                            <td>" . $startValuePersent4[$i] . "</td>
                            <td>" . $chapter4[$i]['difference'] . "</td>
                            <td>" . $changePercent4[$i] . "</td>
                            <td>" . $chapter4[$i]['finishValue'] . "</td>
                            <td>" . $finishValuePersent4[$i] . "</a>
                            </td>
                          </tr>";
            $itemNameChapter4[$i] = $chapter4[$i]['itemID'];
            $startValueChapter4[$i] = $chapter4[$i]['startValue'];
            $finishValueChapter4[$i] = $chapter4[$i]['finishValue'];
        }

        /* Генерация вывода по пятой главе и создание отдельных массивов значений для вывода javascript диаграмм */

        for ($i = 0; $i < count($chapter5); $i++) {
            if ($article690[0]['startValue'] != 0) { // Подсчет процента начального значения статьи от начального значения главы
                $startValuePersent5[$i] = round($chapter5[$i]['startValue'] / $article690[0]['startValue'] * 100,2);
            }
            else {
                $startValuePersent5[$i] = 0;
            }
            if ($chapter5[$i]['startValue'] != 0) { // Подсчет изменения показателя в периоде в процентах
                $changePercent5[$i] = round(-(100 - $chapter5[$i]['finishValue'] / $chapter5[$i]['startValue'] * 100),2);
            }
            else {
                $changePercent5[$i] = 100;
            }
            if ($article690[0]['finishValue'] != 0) { // Подсчет процента конечного значения статьи от конечного значения главы
                $finishValuePersent5[$i] = round($chapter5[$i]['finishValue'] / $article690[0]['finishValue'] * 100,2);
            }
            else {
                $finishValuePersent5[$i] = 0;
            }
            $reportChapter5[$i] = "<span>Значение статьи <b>" . $chapter5[$i]['itemName'] . " (" . $chapter5[$i]['itemID'] . ")</b> на начало отчетного периода – " . $chapter5[$i]['startValue'] . " (" . $startValuePersent5[$i] . "% от начального значения краткосрочных обязательств), в течение периода " . $chapter5[$i]['change'] . " на " . $chapter5[$i]['difference'] . " (" . $changePercent5[$i] . "%), в результате чего значение стало равно " . $chapter5[$i]['finishValue'] . " (" . $finishValuePersent5[$i] . "% от конечного значения краткосрочных обязательств).</span>";
            $table5[$i] = "<tr class=\"even pointer\">
                            <td>" . $chapter5[$i]['itemID'] . "</td>
                            <td>" . $chapter5[$i]['startValue'] ."</td>
                            <td>" . $startValuePersent5[$i] . "</td>
                            <td>" . $chapter5[$i]['difference'] . "</td>
                            <td>" . $changePercent5[$i] . "</td>
                            <td>" . $chapter5[$i]['finishValue'] . "</td>
                            <td>" . $finishValuePersent5[$i] . "</a>
                            </td>
                          </tr>";
            $itemNameChapter5[$i] = $chapter5[$i]['itemID'];
            $startValueChapter5[$i] = $chapter5[$i]['startValue'];
            $finishValueChapter5[$i] = $chapter5[$i]['finishValue'];
        }

        /* Подсчет коэффициентов платежеспособности и финансовой устойчивости */

        $K1start = round($article290[0]['startValue'] / $article690[0]['startValue'],4);
        $K1finish = round($article290[0]['finishValue'] / $article690[0]['finishValue'],4);
        if ($K1finish >= 2) {
            $K1report = "<span style='color:green;'>Значение коэффициента K1 соответствует норме, что говорит о достаточном уровне платежеспособности компании.</span>";
        }
        else {
            $K1report = "<span style='color:tomato;'>Значение коэффициента K1 не соответствует норме, что говорит о недостаточном уровне платежеспособности компании.</span>";
        }

        $K2start = round(($article490[0]['startValue'] + $article590[0]['startValue'] - $article190[0]['startValue']) / $article290[0]['startValue'],4);
        $K2finish = round(($article490[0]['finishValue'] + $article590[0]['finishValue'] - $article190[0]['finishValue']) / $article290[0]['finishValue'],4);

        $K3start = round(($article690[0]['startValue'] + $article590[0]['startValue']) / $article300[0]['startValue'],4);
        $K3finish = round(($article690[0]['finishValue'] + $article590[0]['finishValue']) / $article300[0]['finishValue'],4);
        if ($K3finish <= 0.85) {
            $K3report = "<span style='color:green;'>Значение коэффициента K3 соответствует норме, что говорит о достаточном уровне платежеспособности компании.</span>";
        }
        else {
            $K3report = "<span style='color:tomato;'>Значение коэффициента K3 не соответствует норме, что говорит о недостаточном уровне платежеспособности компании.</span>";
        }

        $K4start = round((($article590[0]['startValue'] + $article690[0]['startValue']) / $article300[0]['startValue']),4);
        $K4finish = round((($article690[0]['finishValue'] + $article690[0]['finishValue']) / $article300[0]['finishValue']),4);
        if ($K4finish <= 1) {
            $K4report = "<span style='color:green;'>Значение коэффициента K4 соответствует норме, что говорит о достаточном уровне финансовой устойчивости компании.</span>";
        }
        else {
            $K4report = "<span style='color:tomato;'>Значение коэффициента K4 не соответствует норме, что говорит о недостаточном уровне финансовой устойчивости компании.</span>";
        }

        $K5start = round(($article490[0]['startValue'] / $article300[0]['startValue']),4);
        $K5finish = round(($article490[0]['finishValue'] / $article300[0]['finishValue']),4);
        if ($K5finish >= 0.4) {
            $K5report = "<span style='color:green;'>Значение коэффициента K5 соответствует норме, что говорит о достаточном уровне финансовой устойчивости компании.</span>";
        }
        else {
            $K5report = "<span style='color:tomato;'>Значение коэффициента K5 не соответствует норме, что говорит о недостаточном уровне финансовой устойчивости компании.</span>";
        }

        /* Генерация отчета о коэффициентах платежеспособности */

        $solvencyReport = "<span><b>Коэффициент текущей ликвидности (К1)</b> на начало отчетного периода – " . $K1start. ", в течение периода изменился на " . round(100 - $K1start / $K1finish * 100,2) . "%, в результате чего значение стало равно " . $K1finish . ". " . $K1report . "</span></br>
                           <span><b>Коэффициент обеспеченности собственными оборотными средствами (К2)</b> на начало отчетного периода – " . $K2start. ", в течение периода изменился на " . round(100 - $K2start / $K2finish * 100,2) . "%, в результате чего значение стало равно " . $K2finish . ". Нормативное значение коэффициента K2 можно посмотреть на странице <a href='description.php'>Описание алгоритма</a>.</span></br>
                           <span><b>Коэффициент обеспеченности обязательств активами (К3)</b> начало отчетного периода – " . $K3start. ", в течение периода изменился на " . round(100 - $K3start / $K3finish * 100,2) . "%, в результате чего значение стало равно " . $K3finish . ". " . $K1report . "</span></br>";

        /* Генерация отчета о коэффициентах финансовой устойчивости */

        $financialStablilityReport = "<span><b>Коэффициент капитализации (К4)</b> на начало отчетного периода – " . $K4start. ", в течение периода изменился на " . round(100 - $K4start / $K4finish * 100,2) . "%, в результате чего значение стало равно " . $K4finish . ". " . $K4report . "</span></br>
                                      <span><b>Коэффициент финансовой независимости (К5)</b> на начало отчетного периода – " . $K5start. ", в течение периода изменился на " . round(100 - $K5start / $K5finish * 100,2) . "%, в результате чего значение стало равно " . $K5finish . ". " . $K5report . "</span></br>";

        /* Создание переменных для передачи данных каждой главы в javascript для последующей генерации диаграмм */

        $jsonChapter1ItemName = json_encode($itemNameChapter1);
        $jsonChapter1StartValue = json_encode($startValueChapter1);
        $jsonChapter1FinishValue = json_encode($finishValueChapter1);

        $jsonChapter2ItemName = json_encode($itemNameChapter2);
        $jsonChapter2StartValue = json_encode($startValueChapter2);
        $jsonChapter2FinishValue = json_encode($finishValueChapter2);

        $jsonChapter3ItemName = json_encode($itemNameChapter3);
        $jsonChapter3StartValue = json_encode($startValueChapter3);
        $jsonChapter3FinishValue = json_encode($finishValueChapter3);

        $jsonChapter4ItemName = json_encode($itemNameChapter4);
        $jsonChapter4StartValue = json_encode($startValueChapter4);
        $jsonChapter4FinishValue = json_encode($finishValueChapter4);

        $jsonChapter5ItemName = json_encode($itemNameChapter5);
        $jsonChapter5StartValue = json_encode($startValueChapter5);
        $jsonChapter5FinishValue = json_encode($finishValueChapter5);

        /* Создание переменных для передачи данных каждого коэффициента в javascript для последующей генерации диаграмм */

        $jsonK1start = json_encode($K1start);
        $jsonK1finish = json_encode($K1finish);
        $jsonK2start = json_encode($K2start);
        $jsonK2finish = json_encode($K2finish);
        $jsonK3start = json_encode($K3start);
        $jsonK3finish = json_encode($K3finish);
        $jsonK4start = json_encode($K4start);
        $jsonK4finish = json_encode($K4finish);
        $jsonK5start = json_encode($K5start);
        $jsonK5finish = json_encode($K5finish);

    }
}
$Database->disconnect();
?>