<main class="page-order">
<div id="orderList">
<h1 class="h h--1">Список заказов</h1>
    <ul class="page-order__list">
<?php
if ($data['ordersList'])
{
    foreach ($data['ordersList'] as $value) {
?>
    <li class="order-item page-order__item">
        <div class="order-item__wrapper">
        <div class="order-item__group-order-name">
            <span class="order-item__title">Название</span>
            <span class="order-item__info "><?= $value[0][0]; ?></span>
        </div>
        <div class="order-item__group-order-price">
            <span class="order-item__title">Цена</span>
            <?= $value[0][5] ?> руб.
        </div>
      </div>
    </li>
<?php
    }
?>
    <li class="order-item page-order__item">
      <div class="order-item__wrapper">
      <span class="order-item__info ">Сумма заказа: <?= $data['itemsPrice']; ?> руб.</span>
      <span class="order-item__info" id="deliveryAdd"></span>
      </div>
    </li>
<?php
} else {
?>
<h2>Ни одного товара не заказано</h2>
<script type="text/javascript">
    var buttonDisable = 1;
</script>
<?php
}
?>
  </ul>
      <div class="order-item__wrapper">
        <div class="order-item__group order-item__group--margin">
          <span class="order-item__title">Заказчик</span>
          <span class="order-item__info"><?= $data['userSettings'][2] ?> <?= $data['userSettings'][1] ?> <?= $data['userSettings'][3] ?></span>
        </div>
        <div class="order-item__group">
            <span class="order-item__title">Номер телефона</span>
            <span class="order-item__info"><?= $data['userSettings'][5] ?></span>
        </div>
        <div class="order-item__group">
            <span class="order-item__title">Адрес доставки</span>
            <span class="order-item__info"><?= $data['userSettings'][7] ?></span>
        </div>
      </div>
</div>

<form class="custom-form" id="addOrderForm" method="post" action="/ajax" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="AddOrder">
    <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
    <input type="hidden" name="items" value="<?= base64_encode(serialize($_SESSION['basket'])) ?>">
    <input type="hidden" name="ammount" value="<?= $data['itemsPrice']; ?>">

      <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">тип оплаты</legend>
      <div class="custom-form__select-wrapper page-add__select">
        <select name="payment" class="custom-form__select">
          <?php
          foreach ($data['paymentList'] as $value) {
          ?>
          <option value="<?= $value[0]; ?>"><?= $value[1]; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <legend class="page-add__small-title custom-form__title">тип доставки</legend>
      <div class="custom-form__select-wrapper page-add__select">
        <select id="deliveryType" name="delivery" class="custom-form__select">
          <?php
          foreach ($data['deliveryList'] as $value) {
              if ($value[0] == 1) {
                  $isSelected = "selected";
              }
          ?>
              <option value="<?= $value[0]; ?>" <?=  $isSelected; ?>><?= $value[1]; ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <legend class="page-add__small-title custom-form__title">Комментарий к заказу</legend>
      <textarea name="product-description" id="product-description" cols=70 rows=12 style="margin-top: 15px;"></textarea>
    </fieldset>
    <button class="button" id="addOrderButton">Добавить заказ</button>
</form>
<script type="text/javascript">
    if (buttonDisable == 1) {
        document.getElementById("addOrderButton").disabled = true;
    }
</script>
    <section class="shop-page__popup-end page-add__popup-end" hidden="" id="successPopUp">
    <div class="shop-page__wrapper shop-page__wrapper--popup-end">
      <h2 class="h h--1 h--icon shop-page__end-title">Заказ успешно добавлен</h2>
      <h3><a href="/">Продолжить покупки</a></h3>
    </div>
  </section>
  <section class="shop-page__popup-end page-add__popup-end" hidden="" id="errorPopUp">
    <div class="shop-page__wrapper shop-page__wrapper--popup-end">
      <h2 class="h h--1 h--icon shop-page__end-title">Ошибка добавления заказа</h2>
    </div>
  </section>
</main>