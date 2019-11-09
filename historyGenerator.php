<!-- Выгрузка из базы данных информации о загруженных пользователем балансов в интерфейс пользователя -->

<?php
$Database->connect();
$haveBalance = $Database->select("balancerecord", "balanceID", null, "userID = '".$_SESSION["session_id"]."'"); // Выбор из базы данных информации о загруженном балансе (имя компании, отчетный период, денежная единица баланса)
$balanceID = $Database->getResult();
$Database->select("balancerecord", "companyName", null, "userID = '".$_SESSION["session_id"]."'");
$companyName = $Database->getResult();
$Database->select("balancerecord", "reportPeriod", null, "userID = '".$_SESSION["session_id"]."'");
$reportPeriod = $Database->getResult();
$Database->select("balancerecord", "currencyUnit", null, "userID = '".$_SESSION["session_id"]."'");
$currencyUnit = $Database->getResult();

if($balanceID == array()) {
    $message = "<p>У вас нет загруженных балансов. Перейдите в окно <a href='upload.php'><b>Загрузка документа</b></a>, чтобы загрузить и проанализировать баланс.</p>"; // Если в базе данных нет информации о том, что пользователь загружал балансы, то выводится данное сообщение
}
else {
    for ($i = 0; $i < count($balanceID); $i++) { // Если в базе данных была найдена информация о балансе, то для каждого баланса создается блок с указанием компании, отчетного периода и денежной единицы баланса. А также прописывается скрипт, что при нажатии определенной кнопки открывается полный анализ загруженного баланса
        $content[$i] = "
              <!-- Форма блока баланса -->
              <div class=\"col-md-6 col-sm-12 col-xs-12\">
                <div class=\"x_panel\">
                  <div class=\"x_title\">
                    <h2>".$companyName[$i]['companyName']."</h2>
                    <div class=\"clearfix\"></div>
                  </div>
                  <div class=\"x_content\">
                    <p>Период баланса: ".$reportPeriod[$i]['reportPeriod']."</p>
                    <p>Денежная единица баланса: ".$currencyUnit[$i]['currencyUnit']."</p>
                    <form action='balanceAnalysis.php' method='post'>
                        <input type='text' id='balanceID' name='balanceID' value=".$balanceID[$i]['balanceID']." style='visibility:hidden; height:3px;'><br/>
                        <input id='openBalanceAnalysis'  type='submit' name='openBalanceAnalysis' class=\"btn btn-round btn-deafault\" value='Подробнее о балансе'>
                    </form>
                  </div>
                </div>
              </div>
            <!-- /Форма блока баланса -->";
    }
}
?>