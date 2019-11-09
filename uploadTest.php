<?php
include '/test/test_asserttrue.php';
include '/classes/User.php';
$user = new User("AlinaNH", "Test@mail.com", "123"); // В случае, если все необходимые поля заполнены, создается объект пользователя, в которого помещаются введенные данные
$Database = new Database(); // Создание объекта класса для работы с базой данных
$Database->connect();
$user->saveregistration();
$result = $Database->select('user', '*', null, 'login= "AlinaNH"');
print_r(test_asserttrue::assertTrue($result));
