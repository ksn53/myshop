<?php
class Model_OrdersList extends Model{

    function ordersList()
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT * FROM orders ORDER BY perf, datetime1 DESC;");
        $arrayItems->execute();
        while ($items = $arrayItems->fetch(PDO::FETCH_ASSOC))
            {
                $data[] = [$items['id'],$items['userid'],$items['delivery'],$items['payment'],$items['description'],$items['items'],$items['ammount'],$items['perf'],$items['datetime1']];
            }
        return $data;
    }

    function returnUserName($id)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT name FROM users WHERE id=" . $id);
        $arrayItems->execute();
        $items = $arrayItems->fetch(PDO::FETCH_ASSOC);
        return $items['name'];
    }

    function returnItemName($id)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT name FROM items WHERE id=" . $id);
        $arrayItems->execute();
        $items = $arrayItems->fetch(PDO::FETCH_ASSOC);
        return $items['name'];
    }

    function returnPaymentType($id)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT name FROM payment_types WHERE id=" . $id);
        $arrayItems->execute();
        $items = $arrayItems->fetch(PDO::FETCH_ASSOC);
        return $items['name'];
    }

    function returnDeliveryType($id)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT name FROM delivery_types WHERE id=" . $id);
        $arrayItems->execute();
        $items = $arrayItems->fetch(PDO::FETCH_ASSOC);
        return $items['name'];
    }
}
