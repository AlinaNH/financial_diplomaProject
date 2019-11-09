<!-- Скрипт проверки регистрации и авторизации пользователя -->

<?php include('classes/User.php'); // Подключение класса для работы с пользователем
$message=""; // Переменная, хранящая сообщение, получаемое от скрипта (о статусе регистрации/авторизации)
if (isset($_POST["registration"])) {
    if (!empty($_POST['r_login']) && !empty($_POST['r_email']) && !empty($_POST['r_password'])) {
        $user = new User($_POST['r_login'], $_POST['r_email'], $_POST['r_password']); // В случае, если все необходимые поля заполнены, создается объект пользователя, в которого помещаются введенные данные 
        $Database = new Database(); // Создание объекта класса для работы с базой данных 
        $Database->connect(); // Подключение к базе данных 
        $checkingUser = $Database->select('user', '*', null, 'login="' . $_POST['r_login'] . '"'); // Выполняется селективный запрос из базы данных всех пользователей с именем, аналогичным введеному 
        $numrows = $Database->numRows(); // Подсчет количества строк результата селективного запроса 
        if ($numrows == 0) {
            $user->saveregistration();
            $Database->disconnect(); // Если пользователей с именем, аналогичным введенному, в базе данных не существует, то регистрация нового пользователя сохраняется, отключается база данных 
            $message = "Аккаунт успешно создан!";
        } else {
            $Database->disconnect();
            $message = "Пользователь с таким логином уже существует! Выберите, пожалуйста, другой догин.";
        }
    }
}

session_start(); // Функция начала пользовательской сессии 
if (isset($_SESSION["session_id"])) {
    header("Location: http://financial.gq/intropage.php"); // Если сессия была начата, то происходит перенаправление на следующую страницу 
} else {
    if (isset($_POST["authorization"])) {
        if (!empty($_POST['a_login']) && !empty($_POST['a_password'])) {
            $Database = new Database();
            $Database->connect(); // В случае, если все необходимые поля заполнены, создается объект базы данных и подключение к базе данных
            $checkingUser = $Database->select('user', '*', null, null);  // Выполняется селективный запрос из базы данных всех пользователей с именем и паролем, аналогичным введеному
            $numrows = $Database->numRows(); // Подсчет количества строк результата селективного запроса
            if ($numrows != 0) {
                $row = $Database->getResult();
                $row = $row[0];
                $id = $row['userID'];
                $login = $row['login'];
                $password = $row['password'];
                if ($_POST['a_login'] == $login && $_POST['a_password'] == $password) {
                    $_SESSION['session_id'] = $id;//Если в базе данных существует пользователь с логином и паролем, аналогичным введенным, то его идентификационный номер этого пользователя становится идентификационным номером сессии пользователя 
                    header("Location: http://financial.gq/intropage.php"); // Перенаправление на следующую страницу 
                    $Database->disconnect(); // Отключение базы данных 
                } else {
                    $Database->disconnect();
                    $message = "Неправильный логин или пароль!";
                }
            } else {
                $Database->disconnect();
                $message = "Неправильный логин или пароль!";
            }
        } else {
            $Database->disconnect();
        }
    }
}
?>