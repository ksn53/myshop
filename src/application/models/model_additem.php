<?php
class Model_AddItem extends Model
{
    /**
     * запрос списка категорий
     * @return тип array массив с именами категорий и их ID
    **/
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

}

