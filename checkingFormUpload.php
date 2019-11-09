<?php
include('classes/Database.php');
include('classes/WordConverter.php');
include('classes/Balance.php');

session_start();

if (!empty($_POST['companyName']) && !empty($_POST['reportPeriod']) && !empty($_POST['currencyUnit'])) { // В случае, если необходимые поля заполнены, происходит проверка файла
    $target_dir = "uploads/";
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $fileArray = pathinfo($target_file);
    $file_ext  = $fileArray['extension'];
    if($file_ext == "doc" || $file_ext == "docx") { // Если файл формата docx или doc, то он загружается в папку uploads
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $WordConverter = new WordConverter($target_file); // Создается объект класса WordConverter, который преобразует текст документа Word в строку
        $documentText = $WordConverter->convertToText();

        $Database = new Database(); // Создание объекта класса для работы с базой данных
        $Database->connect(); // Подключение к базе данных
        $Database->insert('balanceRecord', array('companyName' => $_POST['companyName'], 'reportPeriod' => $_POST['reportPeriod'],
            'currencyUnit' => $_POST['currencyUnit'], 'userID' => $_SESSION['session_id'])); // Добавление данных о загрузке баланса (имя компании, отчетный период баланса, денежная единица баланса, id пользователя, загрузившего баланс, в базу данных
        $Balance = new Balance(); // Создается объект, который обрабатывает данные из баланса и вносит их в базу данных
        $Balance = $Balance->handleBalanceData($documentText);
        header('Location: history.php'); // Происходит перенаправление на страницу история загрузок
        $Database->disconnect();
    }
}
?>

<html>
<head>
    <title>Подождите...</title>
</head>
</html>
