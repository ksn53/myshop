  <section class="shop container">
    <section class="shop__filter filter">
      <form>
      <div class="filter__wrapper">
        <b class="filter__title">Категории</b>
        <ul class="filter__list">
          <li>
            <a class="filter__list-item active" id="categoryAll" href="javascript://">Все</a>
          </li>
          <li>
            <a class="filter__list-item" href="javascript://" id="categoryWoman">Женщины</a>
          </li>
          <li>
            <a class="filter__list-item" href="javascript://" id="categoryMan">Мужчины</a>
          </li>
          <li>
            <a class="filter__list-item" href="javascript://" id="categoryChildren">Дети</a>
          </li>
          <li>
            <a class="filter__list-item" href="javascript://" id="categoryAcc">Аксессуары</a>
          </li>
        </ul>
      </div>
        <div class="filter__wrapper">
          <b class="filter__title">Фильтры</b>
          <!---<div class="filter__range range">--->
<!----------------test slider------------------------->
            <span class="range__info">Цена</span>
            <div id="slider-range"></div>
            <div class="range__res">
                <input type="text" id="lowprice" class="range__res-item min-price" readonly style="border:0;">
                <input type="text" id="higthprice" class="range__res-item max-price" readonly style="border:0;">
            </div>
          </div>
        </div>

        <fieldset class="custom-form__group">
          <input type="checkbox" name="new" id="new" class="custom-form__checkbox">
          <label for="new" class="custom-form__checkbox-label custom-form__info" style="display: block;">Новинка</label>
          <input type="checkbox" name="sale" id="sale" class="custom-form__checkbox">
          <label for="sale" class="custom-form__checkbox-label custom-form__info" style="display: block;">Распродажа</label>
        </fieldset>
        <button class="button" type="button" id="searchbutton" style="width: 100%">Применить</button>
      </form>
    </section>

    <div class="shop__wrapper" id="shopWrapper">
      <section class="shop__sorting">
        <div class="shop__sorting-item custom-form__select-wrapper">
          <select class="custom-form__select" name="category" id="orderby">
            <option selected value="0">По цене</option>
            <option value="1">По названию</option>
          </select>
        </div>
        <div class="shop__sorting-item custom-form__select-wrapper">
          <select class="custom-form__select" name="prices" id="orderbydesc">
            <option selected value="0">По убыванию</option>
            <option value="1">По возрастанию</option>
          </select>
        </div>
<!-------счётчик товаров в выборке----------------------->
        <p class="shop__sorting-res">Найдено <span class="res-sort" id="itemsCount"></span> моделей</p>
      </section>
<!-- вывод товаров---------- ------------------------------------>
      <section class="shop__list" id="itemsList">
      <script type="text/javascript">
          ajaxPostFunc(0, 1);
      </script>
      </section>
<!-------конец выдачи товаров---------->
    <div class="shop__paginator" id="paginatorWrapper"></div>
    </div>
  </section>

</main>