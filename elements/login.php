<div class="main__login">
    <div class="main__link-back">
        <a class="link" href="../">вернуться</a>
    </div>
    <form method="post">
        Логин <?= $message ?><input class="main__login-text" type="text" name="login">
        Пароль <?= $message ?><input class="main__login-text" type="password" name="password">
        <input class="submit" type="submit" value="Войти">
    </form>
</div>

