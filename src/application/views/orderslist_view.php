<div style="width: 100%; min-height: 275px; padding: 10px;">
<?php
    $this->model = new Model_OrdersList();
?>
<div id="content">
<div style="display: table; margin-top: 10px; color: #2C1E1E;">
    <div style="display: table-row;">
        <div style="margin-left: 10px; width: 90px; display: table-cell;">дата</div>
        <div style="margin-left: 10px; width: 90px; display: table-cell;">ID заказа</div>
        <div style="margin-left: 10px; width: 100px; display: table-cell;">клиент</div>
        <div style="margin-left: 10px; width: 120px; display: table-cell;">доставка</div>
        <div style="margin-left: 10px; width: 100px; display: table-cell;">оплата</div>
        <div style="margin-left: 10px; width: 200px; display: table-cell;">описание</div>
        <div style="margin-left: 10px; width: 250px; display: table-cell;">товары</div>
        <div style="margin-left: 10px; width: 100px; display: table-cell; padding: 5px;">сумма</div>
        <div style="margin-left: 10px; width: 100px; display: table-cell;">статус</div>
        <div style="margin-left: 10px; width: 120px; display: table-cell; padding: 5px;">статус</div>
    </div>
<?php
$rowNumber = 1;
foreach ($data as $value) {
    if ($rowNumber % 2 === 0) {
?>
    <div style="display: table-row;">
    <?php
    } else {
    ?>
    <div style="display: table-row; background-color: #C3C3C3;">
    <?php
    }
    ?>
      <div style="display: table-cell;"><?= $value[8] ?></div>
      <div style="display: table-cell;"><?= $value[0] ?></div>
      <div style="display: table-cell;"><?= $this->model->returnUserName($value[1]); ?></div>
      <div style="display: table-cell;"><?= $this->model->returnDeliveryType($value[2]); ?></div>
      <div style="display: table-cell;"><?= $this->model->returnPaymentType($value[3]); ?></div>
      <div style="display: table-cell;"><?= $value[4] ?></div>
      <div style="display: table-cell;">
          <?php
          foreach (unserialize(base64_decode($value[5])) as $item) {
              echo $this->model->returnItemName($item) . "<br>";
          }
          ?>
      </div>
      <div style="display: table-cell; padding: 5px;"><?= $value[6] ?></div>
      <div style="display: table-cell;"><button  onclick="updateOrder(<?= $value[0] ?>)" class="itemListButton">выполнено</button></div>
      <div style="display: table-cell;" id="OrderStatus<?= $value[0] ?>">
      <?php
      if ($value[7] == 1) {
      ?>
          выполнено
      <?php
      } else {
      ?>
          не выполнено
      <?php
      }
      ?>
    </div>

</div>
<?php
$rowNumber++;
}
?>
</div>

</div>

</div>