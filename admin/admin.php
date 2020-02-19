<?php
    session_start();
    $login = $_SESSION['login']; // логин авторизированного пользователя

    require_once "../config.php"; // содержит подключение к базе данных

    if(empty($_SESSION['auth'])){ // если не авторизорован, то переадресация на главную
        header("Location: ../"); die();
    }

    if(!empty($_GET['control']) && $_GET['control']=='exit'){ // выход из аккаунта
        $_SESSION['auth'] = null; // забыть авторизацию
        $_SESSION['login'] = null; // забыть логин
        header("Location: ../"); die(); // перейти на главную
    }


    if(!empty($_POST['delete-id'])){ // удаление книги
        $delbook = $_POST['delete-id'];
        $query = "DELETE FROM book WHERE id=$delbook";
        mysqli_query($link, $query) or die(mysqli_error($link)); 
    }

    if(!empty($_POST['remove'])){
        $query = "DELETE FROM book";
        mysqli_query($link, $query) or die(mysqli_error($link)); 
    }

    // запрос на вывод данных
    $query = "SELECT book.id, book.title, CONCAT(author.`name`,' ',author.surname) AS fullname ,book.`year` FROM book, author WHERE book.author=author.id";

    if(!empty($_POST['search-text'])){ // если поиск заполнен
        $element = strip_tags($_POST['search-text']); // защита от инъекций
        // запрос на поиск значения среди названий книг и ФИ авторов
        $query = "SELECT book.id, book.title, CONCAT(author.`name`,' ',author.surname) AS fullname ,book.`year` FROM book, author 
        WHERE  (book.title LIKE '%$element%' OR CONCAT(author.`name`,' ',author.surname) LIKE '%$element%') AND book.author=author.id";
    }

    // если выбрана сортировка
    if(!empty($_POST['sort-select'])){
        $sort = $_POST['sort-select']; // то дополнить запрос сортировкой по полю указаному в значении селектора
        $query.=" ORDER BY ".$sort;
    }

    $result = mysqli_query($link, $query) or die(mysqli_error($link)); // отправка запроса и получение данных
    for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row); // получение данных в массив data


    require_once "layout.php"; // вставка шаблона
?>

