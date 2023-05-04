<div style="width: 100%; min-height: 275px; padding: 10px; margin-left: 30px;">
<?php
    if ( isset($_SESSION["loginStatus"]) && ($_SESSION['loginStatus'] == true) ) {
?>
<h2>Страница параметров пользователя</h2>
      <div class="order-item__wrapper">
        <div class="order-item__group order-item__group--margin">
          <span class="order-item__title">Заказчик</span>
          <span class="order-item__info"><?= $data[0][2] ?> <?= $data[0][1] ?> <?= $data[0][3] ?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Номер телефона</span>
          <span class="order-item__info"><?= $data[0][5] ?></span>
        </div>
        <div class="order-item__group">
          <span class="order-item__title">Email</span>
          <span class="order-item__info"><?= $data[0][4] ?></span>
        </div>
      </div>
      <div class="order-item__group">
          <span class="order-item__title">Уровень доступа</span>
          <span class="order-item__info"><?= $data[1] ?></span>
      </div>
      <div class="order-item__wrapper">
        <div class="order-item__group">
          <span class="order-item__title">Адрес доставки</span>
          <span class="order-item__info"><?= $data[0][7] ?></span>
        </div>
      </div>
      <pre>
<?php
}
?>
</div>