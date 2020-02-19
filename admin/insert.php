<?php
    require_once "../config.php"; // содержит подключение к базе данных
        $title = ""; $year = ""; $id=""; $author = ""; // переменные, очищающие поля формы
        // получим всех авторов для заполнения селекта
        $query = "SELECT * FROM author";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        for($authors = []; $row = mysqli_fetch_assoc($result); $authors[] = $row); 
    // если поле названия запонено
    if(!empty($_POST['new-title'])){
        $newtitle = $_POST['new-title']; // получаем новое название
        $newyear = $_POST['new-year']; // новый год
        if(empty($_POST['new-author-name']) && empty($_POST['new-author-surname'])){ // если поля с ФИ автора остались пустыми
            $newauth = $_POST['select-author']; // получаем id автора из значения селектора
        }else{
            $newname = $_POST['new-author-name']; // новое имя автора
            $newsurname = $_POST['new-author-surname']; // новая фамилия автора
            $query = "INSERT INTO author SET surname='$newsurname', `name`='$newname'"; // добавить нового автора
            mysqli_query($link, $query) or die(mysqli_error($link));
            $query = "SELECT id FROM author WHERE surname='$newsurname' AND `name`='$newname'"; // получить id нового автора
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
            $newauth = mysqli_fetch_assoc($result)['id']; // хранит id только что добавленного автора
        } // запрос на добавление новой книги
        $query = "INSERT INTO book SET title='$newtitle', `year`='$newyear', author=$newauth";
        //$query = "UPDATE book SET title='$newtitle', `year`='$newyear', author=$newauth WHERE id=$bookid";
        mysqli_query($link, $query) or die(mysqli_error($link));
        header("Location: admin.php"); die(); // редирект на административную страницу
    }

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <div class="main">
        <?php require_once "../elements/form.php"; ?>
    </div>
</body>
</html>