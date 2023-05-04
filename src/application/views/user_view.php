<div style="width: 100%; min-height: 275px; padding: 10px;">
<?php
    if ( isset($_SESSION["loginStatus"]) && ($_SESSION['loginStatus'] == true) ) {
?>
<h2>Страница пользователя</h2>
<a href="/addorder">добавить заказ</a><br>
<a href="javascript:" onclick="emptyBasket()" >Очистить корзину</a><br>
<a href="/usersettings">настройки пользователя</a><br>
<?php
    if ( ($_SESSION['group'] == 1) || ($_SESSION['group'] == 2) ) {
?>
    <a href="/admin">панель админа</a>
<?php
    }
}
?>
</div>