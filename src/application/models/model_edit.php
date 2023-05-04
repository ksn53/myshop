<?php
class Model_Edit extends Model
{

    function categorysList()
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT * FROM categorys;");
        $arrayItems->execute();
        while ($items = $arrayItems->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = [$items['id'], $items['name']];
        }
        return $data;
    }

    function getItemData($id)
    {
            $db = new Database();
            $pdo = $db->getDatabase();
            $pdo = $db->getDatabaseError();
            $data = array();
            $arrayItems = $pdo->prepare("SELECT * FROM items WHERE id=" . $id);
            $arrayItems->execute();
            while ($items = $arrayItems->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = [$items['id'], $items['name'], $items['description'], $items['picture'], $items['new'], $items['sale'], $items['price'], $items['preview'], $items['visible']];
            }
            $arrayCategory = $pdo->prepare("SELECT category_id FROM item_category WHERE item_id=" . $_GET['id']);
            $arrayCategory->execute();
            while ($items = $arrayCategory->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = [$items['category_id']];
            }
        return $data;
    }

}

