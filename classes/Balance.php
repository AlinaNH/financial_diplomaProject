<?php

class Balance { // Класс для обработки данных баланса и занесения их в базу данных

    public function handleBalanceData($documentText){ // Функция для обработки данных баланса и занесения их в базу данных (входное значение - данные документа, преобразованные в строку)
        $Database = new Database();
        $Database->connect(); // Подключение к базе данных

        $regexpArticleAndData = "/\d{3}((\d+|-\d+|\(\d+\))|\s(\d+|-\d+|\(\d+\)))\s+((\d+|-\d+|\(\d+\))|\s(\d+|-\d+|\(\d+\)))/u";
        preg_match_all($regexpArticleAndData, $documentText, $articleAndData); // Найти в строке документа трехзначное число и два числовых значения в после него (можно с минусами, можно в скобках) - номер статьи, значение на начало отчетного периода, значение на конец отчетного периода
        $regexpArticleNumber = "/^\d{3}/u";
        for($i = 0; $i < count($articleAndData[0]); $i++) { // Цикл для обработки полученных данных главы статьи, значения на начало периода, значения на конец периода
            $arrStartValue[$i] = $articleAndData[3][$i]; // Добавление в отдельных массив значений на начало периода
            $arrFinishValue[$i] = $articleAndData[5][$i]; // Добавление в отдельных массив значений на конец периода

            preg_match_all($regexpArticleNumber, $articleAndData[0][$i], $ArticleNumber); // Найти в строке значение глав статей
            $arrArticleNumber[$i] = $ArticleNumber[0][0]; // Добавление в отдельный массив значений глав статей
            $Database->select('balancedecryption', 'itemName', null, 'itemID="'.$arrArticleNumber[$i].'"'); // Выбрать из базы данных названия статей баланса в соответствии с номерами статей
            $data = $Database->getResult();
            $arrItemNames[$i] = $data[0]['itemName']; // Добавление в отдельный массив названий статей баланса

            if ($arrFinishValue[$i] > $arrStartValue[$i]){ // Если значение на конец периода больше, чем на начало периода
                $difference[$i] = $arrFinishValue[$i] - $arrStartValue[$i]; // Добавление разницы между конечным и начальным значением в отдельный массив
                $Database->select('balancedecryption', 'increase', null, 'itemID="'.$arrArticleNumber[$i].'"'); // Выбрать из базы данных значение, определяющее увеличение статьи баланса за период
                $data = $Database->getResult();
                $arrChange[$i] = $data[0]['increase']; // Добавление в отдельный массив значения увеличения статьи баланса за период
            }
            else if ($arrFinishValue[$i] < $arrStartValue[$i]){ // Если значение на конец периода меньше, чем на начало периода
                $difference[$i] = $arrStartValue[$i] - $arrFinishValue[$i]; // Добавление разницы между начальным и конечным значением в отдельный массив
                $Database->select('balancedecryption', 'decrease', null, 'itemID="'.$arrArticleNumber[$i].'"'); // Выбрать из базы данных значение, определяющее уменьшение статьи баланса за период
                $data = $Database->getResult();
                $arrChange[$i] = $data[0]['decrease']; // Добавление в отдельный массив значения уменьшения статьи баланса за период
            }
            $Database->select('balancerecord', 'MAX(balanceID)'); // Выбор последнего загруженного пользователем баланса
            $balanceID = $Database->getResult();
            $balanceID = $balanceID[0]['MAX(balanceID)']; // Добавление ID последнего баланса в отдельную переменную
            $Database->select('balancerecord', 'userID', null, 'balanceID = "'.$balanceID.'"');
            $userID = $Database->getResult();
            $userID = $userID[0]['userID']; // Добавление ID пользователя в отдельную переменную
        }
        for($i = 0; $i < count($arrArticleNumber); $i++){
            $Database->insert('balanceaccounting', array('userID' => $userID, 'balanceID' => $balanceID, 'itemID' => $arrArticleNumber[$i], 'itemName' => $arrItemNames[$i], 'startValue' => $arrStartValue[$i], 'finishValue' => $arrFinishValue[$i], 'difference' => $difference[$i], 'change' =>  $arrChange[$i])); // Загрузка всех статей баланса в отдельную таблицу в базы данных
        }
        $Database->disconnect(); // Отключение от базы данных
    }
}
?>