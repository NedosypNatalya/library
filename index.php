<?php
    require_once "config.php"; // содержит подключение к базе данных
    // запрос на вывод данных
    $query = "SELECT book.title, CONCAT(author.`name`,' ',author.surname) AS fullname ,book.`year` FROM book, author WHERE book.author=author.id";

    if(!empty($_POST['search-text'])){ // если поиск заполнен
        $element = strip_tags($_POST['search-text']); // защита от инъекций
        $query = "SELECT book.title, CONCAT(author.`name`,' ',author.surname) AS fullname ,book.`year` FROM book, author 
        WHERE  (book.title LIKE '%$element%' OR CONCAT(author.`name`,' ',author.surname) LIKE '%$element%') AND book.author=author.id";
    }

    if(!empty($_POST['sort-select'])){
        $sort = $_POST['sort-select'];
        $query.=" ORDER BY ".$sort;
    }

    $result = mysqli_query($link, $query) or die(mysqli_error($link)); // отправка запроса и получение данных
    for($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row); // получение данных в массив data
    require_once "layout.php"; // вставка шаблона
?>
