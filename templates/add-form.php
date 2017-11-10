
<form class="form container" action="<?=$_SERVER['PHP_SELF'];?>" method="post"> <!-- form--invalid -->
    <h2>Вход</h2>
    <div class="form__item <?=in_array('email', $errors) ? 'form__item--invalid' : '' ?>"> <!-- form__item--invalid -->
        <label for="email">E-mail*</label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=htmlspecialchars($email);?>" required>
        <span class="form__error">Введите e-mail</span>
    </div>
    <div class="form__item form__item--last <?=in_array('password', $errors) ? 'form__item--invalid' : '' ?>">
        <label for="password">Пароль*</label>
        <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?=htmlspecialchars($password);?>" required>
        <span class="form__error">Введите пароль</span>
    </div>
    <button type="submit" class="button">Войти</button>
</form>




<?php



//echo $_POST['email'];
//echo $_POST['password'];
?>