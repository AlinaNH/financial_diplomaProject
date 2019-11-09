<?php require('Database.php'); // Подключение класса для работы с базой данных

class User // Класс для работы с пользователем
{
    public $r_login; // Логин пользователя 
    public $r_email; // email пользователя 
    public $r_password; // Пароль пользователя 

    function __construct($login, $email, $password) { // Конструктор класса для работы с пользователем 
        $this->r_login = $login;
        $this->r_email = $email;
        $this->r_password = $password;
    }

    public function saveregistration() // Функция сохранения данных пользователя в базе данных 
    {
        $Database = new Database(); // Создается объект базы данных 
        $Database->connect(); // Создается подключение к базе данных 
        $Database->insert('user', array('login' => $this->r_login, 'email' => $this->r_email,'password' => $this->r_password)); // Добавление данных пользователя в базу данных 
        $Database->disconnect(); // Отключение базы данных 
    }
}
?>
