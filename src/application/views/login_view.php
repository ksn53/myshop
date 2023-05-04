<div class="container" style="margin-top: 20px; text-align: center;">
<?php
    if ( !isset($_SESSION['loginStatus']) || ($_SESSION['loginStatus'] != "true") ) {
?>
<?php
    if (isset($_SESSION['loginUnsuccessful'])) {
?>
    <h2 style="color: red;">Имя пользователя или пароль указаны неверно.</h2>
<?php
    }
    unset($_SESSION['loginUnsuccessful']);
?>
<main class="page-authorization">
<h1 class="h h--1">Авторизация</h1>
    <form class="custom-form" id="loginForm" action="/login" method="POST">
        <input type="hidden" name="_mode" value="PasswordCheck">
        <input type="text" id="name" name="name" class="custom-form__input" required="">
        <input type="password" class="custom-form__input" id="password" name="password"  required="">
        <button class="button">Войти в личный кабинет</button>
    </form>
</main>
<?php
    } else {
?>
<script>
    setTimeout( 'location="/user";', 5 );
</script>
<?php
    }
?>
</div>