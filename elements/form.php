<div class="main__form-upd">
    <div class="main__link-back">
        <a class="link" href="admin.php">отмена</a>
    </div>
    <form method="post">
        <input type="hidden" name="upd-hidden" value="<?= $id ?>">
        Название <input class="main__form-upd-text" type="text" name="new-title" value="<?= $title ?>">
        Год <input class="main__form-upd-text" type="text" name="new-year" value="<?= $year ?>">
        Автор <select class="main__form-upd-text select-author" name="select-author">
                <?php
                    foreach ($authors as $k => $v) {
                        $vid = $v['id'];
                        $vname = $v['name'];
                        $vsurname = $v['surname'];
                        if($author==$vid){ // по умолчанию выбрать автора этой книги
                            echo "<option selected value=\"$vid\">$vsurname $vname</option>";
                        }else{
                            echo "<option value=\"$vid\">$vsurname $vname</option>";
                        }
                    }
                ?>
            </select>
        Новый автор <br>
        Имя <input class="main__form-upd-text" type="text" name="new-author-name">
        Фамилия <input class="main__form-upd-text" type="text" name="new-author-surname">
        <input name="submit-update" class="submit" type="submit" value="Готово">
    </form>
</div>
