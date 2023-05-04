<main class="page-add">
    <h1 class="h h--1">Изменение товара</h1>
<form class="custom-form" id="editItemForm" method="post" action="/ajax" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="EditItem">
    <input type="hidden" name="id" value=<?= $data['itemData'][0][0]; ?> >
    <fieldset class="page-add__group custom-form__group">

      <div>Название</div>
        <textarea name="product-name" id="product-name" required=""><?= $data['itemData'][0][1]; ?></textarea>
      <div>Цена товара</div>
      <textarea name="product-price" id="product-price" required=""><?= $data['itemData'][0][6]; ?></textarea>
    </fieldset>
      <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Описание</legend>
      <textarea name="product-description" id="product-description" cols=70 rows=20 style="margin-top: 15px;"><?= $data['itemData'][0][2]; ?></textarea>
    </fieldset>
    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Фотография товара</legend>
      <img src="<?= $data['itemData'][0][3] ?>">
      <ul class="add-list">
        <li class="add-list__item add-list__item--add">
          <input type="file" name="product-photo" id="product-photo" hidden="">
          <label for="product-photo">Добавить фотографию</label>
        </li>
      </ul>
    </fieldset>
        <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Раздел</legend>
      <div class="custom-form__select-wrapper page-add__select">
        <select name="category" class="custom-form__select">
        <?php
            foreach ($data['categorysList'] as $value) {
              if ($data['itemData'][1][0] == $value['0']) {
        ?>
              <option value="<?= $value['0']?>" selected><?= $value['1']?></option>
        <?php
            } else {
        ?>
              <option value="<?= $value['0']?>"><?= $value['1']?></option>
        <?php
          }
        }
        ?>
        </select>
      </div>
      <?php
          if ($data['itemData'][0][4] == 1) {
      ?>
      <input type="checkbox" name="new" id="new" class="custom-form__checkbox" checked="">
      <?php
          } else {
      ?>
      <input type="checkbox" name="new" id="new" class="custom-form__checkbox">
      <?php
      }
      ?>
      <label for="new" class="custom-form__checkbox-label">Новинка</label>
      <?php
          if ($data['itemData'][0][5] == 1) {
      ?>
      <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox" checked="">
      <?php
          } else {
      ?>
      <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox">
      <?php
      }
      ?>
      <label for="sale" class="custom-form__checkbox-label">Распродажа</label>
    </fieldset>
    <button class="button" id="editItemButton" >Обновить товар</button>
</form>
    <section class="shop-page__popup-end page-add__popup-end" hidden="" id="successPopUp">
    <div class="shop-page__wrapper shop-page__wrapper--popup-end">
      <h2 class="h h--1 h--icon shop-page__end-title">Товар успешно изменён</h2>
    </div>
  </section>
  <section class="shop-page__popup-end page-add__popup-end" hidden="" id="errorPopUp">
    <div class="shop-page__wrapper shop-page__wrapper--popup-end">
      <h2 class="h h--1 h--icon shop-page__end-title">Ошибка записи товара</h2>
    </div>
  </section>
</main>