<div style="width: 100%; min-height: 275px; padding: 10px;">
<div id="content">
    <form class="custom-form" action="/categoryslist" method="POST">
    <input type="hidden" name="_mode" value="ModifyCategory">
    <div style="display: table; margin-top: 10px; color: #2C1E1E;">
    <?php
    foreach ($data as $value) {
    ?>
    <div style="display: table-row;">
        <div style="margin-left: 10px; width: 150px; display: table-cell;"><?= $value[1] ?></div>
        <div style="margin-left: 10px; width: 90px; display: table-cell;"><input type="checkbox" name="itemsOutput<?= $value[0] ?>" value="<?= $value[0] ?>">удалить</div>
    </div>
    <?php
    }
    ?>
</div>
    <input type="text" size="40" name="category">
    <button class="button" id="addCategoryButton">Добавить/удалить категорию</button>
</form>
</div>