<?php
    if(!empty($_SESSION['auth'])){ // если пользователь авторизирован, то вывести возможности администратора
?>
<div class="header">
    <div class="header__info">
        Вы зашли как <i><?= $login ?></i>
        <a class="header__link-back" href="?control=exit">выйти</a>
    </div>
    <div class="header__search">
        <form method="post">
            <input class="header__search-text"  type="text" name="search-text" placeholder="Поиск...">
            <input class="header__search-submit submit" type="submit" name="search-submit" value="Поиск">
        </form>
    </div>
    <div class="header__sort">
        <form method="post">
            <select class="header__sort-select" name="sort-select">
                <option value=null></option>
                <option value="book.title">По названию</option>
                <option value="fullname">По автору</option>
            </select>
            <input class="header__sort-submit submit" type="submit" name="sort-submit" value="Сортировать">
        </form>
    </div>
    <div class="header__insert">
        <form method="post" action="../admin/insert.php">
            <input type="hidden" name="h-insert" value="insert">
            <input class="header__insert-submit submit" type="submit" name="insert" value="Добавить новую книгу">
        </form>
    </div>
    <div class="header__remove">
        <form method="post" action="../admin/admin.php">
            <input class="header__remove-submit submit" type="submit" name="remove" value="Удалить всё">
        </form>
    </div>
</div>
<?php } else { ?>
<div class="header">
    <div class="header__search">
        <form method="post">
            <input class="header__search-text"  type="text" name="search-text" placeholder="Поиск...">
            <input class="header__search-submit submit" type="submit" name="search-submit" value="Поиск">
        </form>
    </div>
    <div class="header__sort">
        <form method="post">
            <select class="header__sort-select" name="sort-select">
                <option value=null></option>
                <option value="book.title">По названию</option>
                <option value="fullname">По автору</option>
            </select>
            <input class="header__sort-submit submit" type="submit" name="sort-submit" value="Сортировать">
        </form>
    </div>
</div>
<?php } ?>