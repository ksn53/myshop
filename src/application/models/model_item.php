<?php
class Model_Item extends Model{

    public function get_data()
    {
        if (isset($_GET["item"])) {
            $itemId = $_GET["item"];
        } else {
            $itemId = 1;
        }

        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();

            $array_items = $pdo->prepare("SELECT * FROM `items` WHERE id=" . $itemId);
            $array_items->execute();
            while($items = $array_items->fetch(PDO::FETCH_ASSOC))
              {
                $data[] = [$items['id'], $items['name'], $items['description'], $items['picture'], $items['new'], $items['sale'], $items['price']];
              }
            return $data;
    }

}