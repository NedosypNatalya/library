<?php
    if(!empty($_SESSION['auth'])){ // если пользователь авторизирован, то вывести возможности администратора
?>
<div class="main">
    <div class="main__container">
        <table class="main__table">
            <thead class="main__thead">
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Год</th>
                    <td>Изменить</td>
                    <td>Удалить</td>
                </tr>
            </thead>
            <tbody class="main__tbody">
                <?php
                    foreach ($data as $k => $v) {
                        $idtbl = $k+1; // порядковый номер в таблице(не в БД)
                        $title = $v['title']; // название
                        $author = $v["fullname"]; // автор
                        $year = $v['year']; // год
                        $hidden = $v['id']; // значение id книги
                        $update = "<form action=\"update.php\" method=\"post\"><input hidden name=\"update-id\" value=\"$hidden\">
                        <input type=\"submit\" class=\"main__update submit\" value=\"Изменить\"></form>";
                        $delete = "<form method=\"post\"><input hidden name=\"delete-id\" value=\"$hidden\">
                        <input type=\"submit\" class=\"main__delete submit\" value=\"Удалить\"></form>";
                        echo "<tr><td>$idtbl</td><td>$title</td><td>$author</td><td>$year</td><td>$update</td><td>$delete</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
    }else {
?>
<div class="main">
    <div class="main__container">
        <table class="main__table">
            <thead class="main__thead">
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Год</th>
                </tr>
            </thead>
            <tbody class="main__tbody">
                <?php
                    foreach ($data as $k => $v) {
                        $idtbl = $k+1;
                        $title = $v['title'];
                        $author = $v["fullname"];
                        $year = $v['year'];
                        echo "<tr><td>$idtbl</td><td>$title</td><td>$author</td><td>$year</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php 
    }
?>