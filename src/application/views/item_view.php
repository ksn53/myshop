<?php
    foreach ($data as $item) {
    ?>
    <article tabindex="0" style="margin: 20px; margin-left: 50px;">
        <div class="product__image">
            <img src="<?= $item[3]; ?>" alt="product-name">
        </div>
        <p class="product__name"><?= $item[1]; ?></p>
        <p style="width: 500px;"><?= $item['2']; ?></p>
        <span class="product__price"><?= $item[6]; ?> руб.</span>
<?php
    }
?>
<form class="custom-form" method="post" action="/ajax" id="addBusketForm">
    <input type="hidden" name="mode" value="AddItemToBasket">
    <input type="hidden" name="id" value="<?= $item['0']; ?>">
    <button class="button" id="addToBasket" >Добавить товар в корзину</button>
</form>
</article>
