<?php
class Model_AddOrder extends Model
{
    /*
     * запрос списка категорий
     * @return тип array массив категорий и их ID
    */
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
    /*
     * запрос списка типов доставки
     * @return тип array массив названий способов доставки и их ID
    */
    function deliveryList()
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT * FROM delivery_types;");
        $arrayItems->execute();
        while ($items = $arrayItems->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = [$items['id'], $items['name']];
        }
        return $data;
    }

    /*
     * запрос списка типов оплаты
     * @return тип array массив названий способов оплаты и их ID
    */
    function paymentList()
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT * FROM payment_types;");
        $arrayItems->execute();
        while ($items = $arrayItems->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = [$items['id'], $items['name']];
        }
        return $data;
    }

    function returnItemById ($id)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT * FROM items WHERE id=" . $id);
        $arrayItems->execute();
        while ($items = $arrayItems->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = [$items['name'], $items['description'], $items['picture'], $items['new'], $items['sale'], $items['price'], $items['preview']];
        }
        return $data;
    }
    /*
     * запрос списка заказов их корзины
     * @return тип array массив ID заказанных товаров
    */
     public function ordersList()
     {
        if (isset($_SESSION['basket'])){
            foreach ($_SESSION['basket'] as $value) {
                $data[] = $this->returnItemById($value);
            }
        return $data;
        }
     }
    /*
     * рассчёт суммы оплаты
     * @return тип int сумма к оплате
    */
    public function ordersPrice()
    {
        $data = 0;
        $deliveryPrice = 280;
        if (isset($_SESSION['basket'])){
            foreach ($_SESSION['basket'] as $value) {
                $currentItem = $this->returnItemById($value);
                $data += $currentItem[0][5];
            }
        return $data;
        }
    }
    /*
     * вывод параметров пользователя, которые нужны для размещения заказа
     * @return тип array массив парамтров пользователя
    */
    public function userSettings($id)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT * FROM users WHERE id=" . $id);
        $arrayItems->execute();
        while ($items = $arrayItems->fetch(PDO::FETCH_ASSOC))
        {
            $data = [$items['id'], $items['name'], $items['sur_name'], $items['second_name'], $items['email'], $items['phone'], $items['password'], $items['address']];
        }
        return $data;
    }

}

