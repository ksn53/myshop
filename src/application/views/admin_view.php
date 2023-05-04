<div style="width: 100%; min-height: 275px;">
<ul>
    <li><a href="/orderslist">Список заказов</a></li>
    <?php
    if ($_SESSION['group'] == 1) {
    ?>
        <li><a href="/additem">Добавить товар</a></li>
        <li><a href="/itemlist">Список товаров</a></li>
        <li><a href="/categoryslist">Список категорий</a></li>
    <?php
    }
    ?>
</ul>

</div>