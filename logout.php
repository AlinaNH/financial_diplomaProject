<?php
session_start(); /* Функция начала сессии */
unset($_SESSION['session_login']); /* Удаление из сессии идентификационного номера пользователя */
session_destroy(); /* Функция закрытия сессии */
header("location: http://financial.gq/"); /* Перенаправление на главную страницу*/
?>