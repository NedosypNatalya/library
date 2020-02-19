<?php
    require_once "../config.php"; // содержит подключение к базе данных
    if(!empty($_POST['update-id'])){ // если значение id книги не пусто
        $id = $_POST['update-id']; // получем это id
        // выборка данных о книге по её id 
        $query = "SELECT book.title, book.year, author.id, author.surname, author.name FROM book, author WHERE book.id=$id AND book.author=author.id";
        $result = mysqli_query($link, $query) or die(mysqli_error($link)); // отправка запроса и получение данных
        $data = mysqli_fetch_assoc($result); // получение данных в массив data
        $title = $data['title']; // название
        $year = $data['year']; // год
        $author = $data['id']; // id автора
        $name = $data['name']; // имя автора
        $surname = $data['surname']; // фамилия автора

        // получим всех авторов для заполнения селекта
        $query = "SELECT * FROM author";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for($authors = []; $row = mysqli_fetch_assoc($result); $authors[] = $row); 
    }

    if(!empty($_POST['new-title'])){ // если поле с названием книги не пусто
        $newtitle = $_POST['new-title']; // новое название
        $newyear = $_POST['new-year']; // новый год
        $bookid = $_POST['upd-hidden']; // id книги
        if(empty($_POST['new-author-name']) && empty($_POST['new-author-surname'])){ // если поля с ФИ автора пустые
            $newauth = $_POST['select-author']; // выбрать id автора из значений селектора
        }else{ // в случаем наличия значений в полях ФИ автора, создаём нового автора
            $newname = $_POST['new-author-name']; // имя автвора
            $newsurname = $_POST['new-author-surname']; // фамилия автора
            $query = "INSERT INTO author SET surname='$newsurname', `name`='$newname'"; // добавить нового автора
            mysqli_query($link, $query) or die(mysqli_error($link));
            $query = "SELECT id FROM author WHERE surname='$newsurname' AND `name`='$newname'"; // получить id нового автора
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            $newauth = mysqli_fetch_assoc($result)['id']; // хранит id только что добавленного автора
        } // запрос на изменение данных книги
        $query = "UPDATE book SET title='$newtitle', `year`='$newyear', author=$newauth WHERE id=$bookid";
        mysqli_query($link, $query) or die(mysqli_error($link));
        header("Location: admin.php"); die(); // переадресация на страницу администрирования
    }

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменить</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <div class="main">
        <?php require_once "../elements/form.php"; ?>
    </div>
</body>
</html>