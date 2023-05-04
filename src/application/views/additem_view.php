<main class="page-add">
    <h1 class="h h--1">Добавление товара</h1>
<form class="custom-form" id="addItemForm" method="post" action="/ajax" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="AddItem">
    <fieldset class="page-add__group custom-form__group">
      
      <label for="product-name" class="custom-form__input-wrapper page-add__first-wrapper">
        <input type="text" class="custom-form__input" name="product-name" id="product-name" required="">
        <p class="custom-form__input-label">
          Название товара
        </p>
      </label>
      <label for="product-price" class="custom-form__input-wrapper">
        <input type="text" class="custom-form__input" name="product-price" id="product-price" required>
        <p class="custom-form__input-label">
          Цена товара
        </p>
      </label>
    </fieldset>
      <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Описание товара</legend>
      <textarea name="product-description" id="product-description" cols=70 rows=20 style="margin-top: 15px;"></textarea>
    </fieldset>
    <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Фотография товара</legend>
      <ul class="add-list">
        <li class="add-list__item add-list__item--add">
          <input type="file" name="product-photo" id="product-photo" hidden="" required>
          <label for="product-photo">Добавить фотографию</label>
        </li>
      </ul>
    </fieldset>
        <fieldset class="page-add__group custom-form__group">
      <legend class="page-add__small-title custom-form__title">Раздел</legend>
      <div class="custom-form__select-wrapper page-add__select">
        <select name="category" class="custom-form__select">
        <?php
            foreach ($data as $value) {
        ?>
              <option value="<?= $value['0']?>"><?= $value['1']?></option>
        <?php
            }
        ?>
        </select>
      </div>
      <input type="checkbox" name="new" id="new" class="custom-form__checkbox">
      <label for="new" class="custom-form__checkbox-label">Новинка</label>
      <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox">
      <label for="sale" class="custom-form__checkbox-label">Распродажа</label>
    </fieldset>
    <button class="button" id="FileUpload1" >Добавить товар</button>
</form>
    <section class="shop-page__popup-end page-add__popup-end" hidden="" id="successPopUp">
    <div class="shop-page__wrapper shop-page__wrapper--popup-end">
      <h2 class="h h--1 h--icon shop-page__end-title">Товар успешно добавлен</h2>
    </div>
  </section>
  <section class="shop-page__popup-end page-add__popup-end" hidden="" id="errorPopUp">
    <div class="shop-page__wrapper shop-page__wrapper--popup-end">
      <h2 class="h h--1 h--icon shop-page__end-title">Ошибка добавления товара</h2>
    </div>
  </section>
</main>