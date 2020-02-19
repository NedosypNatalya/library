<?php // страница с формой авторизации
    session_start(); // начало сессии
    require_once "../config.php"; // содержит подключение к базе данных
    $message = ""; // переменная для хранения оповещения

    if(!empty($_POST['login']) && !empty($_POST['password'])){ // если поля логина и пароля заполнены

        $_SESSION['auth'] = null; // авторизация забыта
        $_SESSION['login'] = null; // логин забыт

        $login = $_POST['login']; // получение логина
        $password = $_POST['password']; // получение пароля

        $query = "SELECT * FROM users WHERE `login`='$login' AND `password`='$password'"; // запрос на проверку существования аккаунта

        $result = mysqli_query($link, $query) or die(mysqli_error($link)); // отправка запроса
        $user = mysqli_fetch_assoc($result); // получение результат

        if (!empty($user)) { // если аккаунт найден
            $_SESSION['auth'] = true; // запоминание авторизации
            $_SESSION['login'] = $login; // запоминание логина
            header("Location: admin.php"); die(); // редирект на страницу администратора
        } else { // если аккаунт не найден
            $message = "<span class=\" message \"> ! </span>"; // оповещение о неудаче
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Войти</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <div class="main">
        <?php require_once "../elements/login.php"; ?>
    </div>
</body>
</html>
