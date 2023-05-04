<?php
class Model_Ajax extends Model
{

    public function ajaxData()
    {
        if (isset($_POST["mode"])) {
            $call="ajax".$_POST["mode"];
          //      return json_encode(array("error"=>false,"data"=>$this->$call()));
                return json_encode($this->$call());
            } else {
                return json_encode(array("error"=>true));
            }
    }

    /**
     * Проверка размера файла
     * @param $fileName тип string путь к файлу картинки
     * @return тип boolen выводит true - если файл меньше 5 мб.
    **/
    function fileSizeCheck($fileName)
    {
        if (filesize($fileName) > 5242880) {
            return false;
        }
        return true;
    }

    /**
     * Проверка Типа файла
     * @param $fileName тип string путь к файлу
     * @return тип boolen выводит true - если файл является картинкой JPEG или PNG.
    **/
    function fileTypeCheck($fileName)
    {
        $allowedTypes = array('image/jpeg', 'image/png');
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $detectedType = finfo_file($fileInfo, $fileName);
        if (!in_array($detectedType, $allowedTypes)) {
            return false;
        }
        finfo_close( $fileInfo );
        return true;
    }

    /**
     * Проверка расширения файла
     * @param $fileName тип string путь к файлу
     * @return тип boolen выводит true - если файл имеет расширение jpg, jpeg, png.
    **/
    function fileExtCheck($fileName)
    {
        $allowedExtensions = array('jpg', 'jpeg', 'png');
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        if (!in_array($fileExtension, $allowedExtensions)) {
            return false;
        }
        return true;
    }

    /**
     * Очистка строки от всякого мусора, тегов и пр.
     * @param $value тип string строка для очистки
     * @return тип string выводит очищенную строку
    **/
    function clean($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);
        return $value;
    }

    /**
     * Закрытие сессии
    **/
    function destroySession()
    {
        if ( session_id() ) {
            setcookie(session_name(), session_id(), time()-60*60*24);
            session_unset();
            session_destroy();
        }
    }

    public function ajaxDeleteItemFromList()
    {
        if ($_POST) {
            $db = new Database();
            $pdo = $db->getDatabase();
            $pdo = $db->getDatabaseError();
            //$data = $_POST['id'];
            $array_items = $pdo->prepare("UPDATE items SET visible = 0 WHERE items.id = " . $_POST['id']);
            if ($array_items->execute()) {
                return true;
            }
        }
    }

    public function ajaxUpdateOrder()
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        if ($_POST['id']) {
            $array_items = $pdo->prepare("UPDATE orders SET perf = 1 WHERE orders.id = " . $_POST['id']);
            return $array_items -> execute();
        }
        return false;
    }

    public function ajaxGetItemsData()
    {
        $activePage = 1;
        $orderby = "price";
        $orderbyDesc = "DESC";
        $mainQuery = " FROM items";
        $count = $_POST['count'];
        $new = "";
        $sale = "";
        $and = "";

        $mainQuery = $mainQuery . " WHERE";
        if ( isset($_POST['sale']) && ( $_POST['sale'] == 1 ) ) {
            $mainQuery = $mainQuery . " sale=1";
        }
        if ( isset($_POST['new']) && ($_POST['new'] == 1) ) {
            if ( isset($_POST['sale']) && ( $_POST['sale'] == 1 ) ) {
                $mainQuery = $mainQuery . " AND ";
            }
            $mainQuery = $mainQuery . " new = 1";
        }
        if ( isset($_POST['lowprice']) && isset($_POST['hightprice']) ) {
            if ( ( isset($_POST['sale']) && ( $_POST['sale'] == 1 ) ) || ( isset($_POST['new']) && ($_POST['new'] == 1) ) ) {
                $mainQuery = $mainQuery . " AND";
            }
            $mainQuery = $mainQuery . " price BETWEEN " . $_POST['lowprice'] . " AND " . $_POST['hightprice'];
        }
        if ( isset($_POST['category']) && ( $_POST['category'] != 0 ) )  {
            if ( ( isset($_POST['sale']) && ( $_POST['sale'] == 1 ) ) || ( isset($_POST['new']) && ($_POST['new'] == 1) ) || isset($_POST['lowprice']) ) {
                $mainQuery = $mainQuery . " AND";
            }
            $mainQuery = $mainQuery . " id IN (SELECT item_id FROM item_category WHERE category_id = " . $_POST["category"] . ")";
        }
        if ( $_POST['orderby'] == 1 ) {
            $orderby = "name";
        }
        if ( isset($_POST['orderbydesc']) && ( $_POST['orderbydesc'] == 1 ) ) {
            $orderbyDesc = "ASC";
        }

        if ( isset($_POST['active']) ) {
            $activePage = $_POST['active'];
        }
        $offset = ($activePage - 1) * $count;
        $countQuery = "SELECT COUNT(*)" . $mainQuery;
        $mainQuery = "SELECT *" . $mainQuery . " AND visible=1 ORDER BY " . $orderby . " " .  $orderbyDesc . " " . " LIMIT " . $offset . "," . $count;
        //SELECT * FROM items WHERE sale = 1 AND new = 1 AND price BETWEEN 300 AND 2000 AND id IN (SELECT item_id FROM item_category WHERE category_id = 1) ORDER BY price ASC LIMIT 0,9
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $array_items = $pdo->prepare($mainQuery);
        $array_items->execute();
        while($items = $array_items->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = [$items['id'], $items['name'], $items['picture'], $items['price']];
        }
        $array_count = $pdo->prepare($countQuery);
        $array_count->execute();
        $itemsCount = $array_count->fetch(PDO::FETCH_ASSOC);
        $data[] = $itemsCount["COUNT(*)"];
        return $data;
    }

    public function ajaxGetCategorys()
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();

        $array_items = $pdo->prepare("SELECT * FROM categorys;");
        $array_items->execute();
        while($items = $array_items->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = [$items['id'], $items['name']];
        }
        return $data;
    }

    public function ajaxGetItems()
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();

        $array_items = $pdo->prepare("SELECT * FROM items;");
        $array_items->execute();
        while($items = $array_items->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = [$items['id'], $items['name'], $items['description'], $items['picture'], $items['price'], $items['new'], $items['sale']];
        }
        return $data;
    }

    /**
     *  Выход пользователя с сайта и завершение сессии
    **/
    public function ajax_LogoutCurrentUser()
    {
        $this->destroySession();
    }

    function AddItemToCategory ($itemId, $categoryId)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $statement = $pdo->prepare("INSERT INTO `item_category` (`item_id`, `category_id`) VALUES ('" . $itemId . "', '" . $categoryId . "');");
        return $statement->execute();
    }

    function UpdateItemCategory ($itemId, $categoryId)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $statement = $pdo->prepare("UPDATE `item_category` SET `category_id` = " . $categoryId . " WHERE `item_category`.`item_id` = " . $itemId . ";");
        return $statement->execute();
    }

    function returnIdByName ($name)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $statement = $pdo->prepare("SELECT id FROM  items WHERE name='" . $name ."'");
        $statement->execute();
        $data[] = [$statement->fetch(PDO::FETCH_ASSOC)];
        return $data;
    }

    /**
     * Добавляет заказ на основе $_POST данных
     * @return тип boolean - true если запрос выполнен успешно, false если были ошибки.
    **/
    public function ajaxAddOrder()
    {
        $postData = $_POST;
        $deliveryPrice = 280;
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();

        $id = $this->clean($postData['id']);
        $delivery = $this->clean($postData['delivery']);
        $payment = $this->clean($postData['payment']);
        $description = str_replace(array("\r\n", "\r", "\n"), '<br>', $this->clean($postData['product-description']));
        $items = $this->clean($postData['items']);
        if (isset($postData['ammount'])) {
            $ammount = $this->clean($postData['ammount']);
            if (($delivery == 1) && ($ammount < 2000)) {
                $ammount = $ammount + $deliveryPrice;
            }
        } else {
            return false;
        }

        $statement = $pdo->prepare("INSERT INTO orders (userid, delivery, payment, description, items, ammount, perf, datetime1) VALUES (?, ?, ?, ?, ?, ?, 0, NOW());");

        $statement->bindParam(1, $id, PDO::PARAM_STR, 512);
        $statement->bindParam(2, $delivery, PDO::PARAM_STR, 512);
        $statement->bindParam(3, $payment, PDO::PARAM_STR, 512);
        $statement->bindParam(4, $description, PDO::PARAM_STR, 255);
        $statement->bindParam(5, $items, PDO::PARAM_STR, 512);
        $statement->bindParam(6, $ammount, PDO::PARAM_STR, 255);

        return $statement->execute();
    }

    //добавление товара
    public function ajaxAddItem()
    {
        $postData = $_POST;
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();

        if (is_uploaded_file($_FILES['product-photo']['tmp_name'])) {
                if ($this->fileTypeCheck($_FILES['product-photo']['tmp_name']) &&
                    $this->fileExtCheck($_FILES['product-photo']['name']) &&
                    $this->fileSizeCheck($_FILES['product-photo']['tmp_name'])) {
                        $postData["fileName1"] = time()."_".basename($_FILES['product-photo']['name']);
                        $uploaddir = 'img/products/';
                        $uploadfile = $uploaddir . $postData["fileName1"];
                        move_uploaded_file($_FILES['product-photo']['tmp_name'], $uploadfile);

                        $srcId = imagecreatefromjpeg($uploadfile);
                        $dstId = imagescale($srcId, 270, -1, IMG_BILINEAR_FIXED);
                        $postData["fileName1preview"] = "resized_".basename($uploadfile);
                        imagejpeg($dstId, $uploaddir.$postData["fileName1preview"]);
                        imagedestroy($srcId);
                        imagedestroy($dstId);

                        $name = $this->clean($postData['product-name']);
                        $description = str_replace(array("\r\n", "\r", "\n"), '<br>', $this->clean($postData['product-description']));
                        $picture = $uploaddir . $postData["fileName1"];
                        $new = 0;
                        $sale = 0;
                        if (isset($postData['new'])) {
                            $new = 1;
                        }
                        if (isset($postData['sale'])) {
                            $sale = 1;
                        }
                        $price = $this->clean($postData['product-price']);
                        $preview = $uploaddir . $postData["fileName1preview"];


                    $statement = $pdo->prepare("INSERT INTO `items` (`name`, `description`, `picture`, `new`, `sale`, `price`, `preview`, `visible`) VALUES (?, ?, ?, ?, ?, ?, ?, 1);");

                    $statement->bindParam(1, $name, PDO::PARAM_STR, 512);
                    $statement->bindParam(2, $description, PDO::PARAM_STR, 512);
                    $statement->bindParam(3, $picture, PDO::PARAM_STR, 512);
                    $statement->bindParam(4, $new, PDO::PARAM_STR, 255);
                    $statement->bindParam(5, $sale, PDO::PARAM_STR, 255);
                    $statement->bindParam(6, $price, PDO::PARAM_STR, 255);
                    $statement->bindParam(7, $preview, PDO::PARAM_STR, 512);

                }
        }
        if ($statement->execute()) {
            $returnId = $pdo->prepare("SELECT LAST_INSERT_ID();");
            if ($returnId->execute()) {
                $newItemId = $returnId->fetch(PDO::FETCH_ASSOC);
                return $this->AddItemToCategory ($newItemId['LAST_INSERT_ID()'], $postData['category']);
            }

        } else {
            return false;
        }
    }

    //изменение товара
    public function ajaxEditItem()
    {
        $postData = $_POST;
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $preview = "none";
        $picture = "none";

        if (is_uploaded_file($_FILES['product-photo']['tmp_name'])) {
                if ($this->fileTypeCheck($_FILES['product-photo']['tmp_name']) &&
                    $this->fileExtCheck($_FILES['product-photo']['name']) &&
                    $this->fileSizeCheck($_FILES['product-photo']['tmp_name'])) {
                        $postData["fileName1"] = time()."_".basename($_FILES['product-photo']['name']);
                        $uploaddir = 'img/products/';
                        $uploadfile = $uploaddir . $postData["fileName1"];
                        move_uploaded_file($_FILES['product-photo']['tmp_name'], $uploadfile);

                        $srcId = imagecreatefromjpeg($uploadfile);
                        $dstId = imagescale($srcId, 270, -1, IMG_BILINEAR_FIXED);
                        $postData["fileName1preview"] = "resized_".basename($uploadfile);
                        imagejpeg($dstId, $uploaddir.$postData["fileName1preview"]);
                        imagedestroy($srcId);
                        imagedestroy($dstId);
                        $preview = $uploaddir . $postData["fileName1preview"];
                        $picture = $uploaddir . $postData["fileName1"];
                }
        }
        $id = $postData['id'];
        $name = $this->clean($postData['product-name']);
        $description = str_replace(array("\r\n", "\r", "\n"), '<br>', $this->clean($postData['product-description']));
        $new = 0;
        $sale = 0;
        if (isset($postData['new'])) {
            $new = 1;
        }
        if (isset($postData['sale'])) {
            $sale = 1;
        }
        $price = $this->clean($postData['product-price']);
        $mainQuery = "UPDATE items SET `name` = '" . $name . "', `description` = '" . $description . "'";
        if ($picture != "none") {
            $mainQuery = $mainQuery . ", `picture` = '" . $picture . "'";
        }
        $mainQuery = $mainQuery . ", `new` = " . $new . ", `sale` = " . $sale . ", `price` = " . $price;
        if ($preview != "none") {
            $mainQuery = $mainQuery . ", `preview` = '" . $preview . "'";
        }
        $mainQuery = $mainQuery . " WHERE `items`.`id` = " . $id . ";";
        $statement = $pdo->prepare($mainQuery);
        //UPDATE items SET `name` = 'name', `description` = 'descript', `picture` = 'pictuere', `new` = 0, `sale` = 0, `price` = 876, `preview` = 'preview' WHERE `items`.`id` = 46
        //return $mainQuery;
        //exit();
        if ($statement->execute()) {
            //return $mainQuery;
            //$returnId = $pdo->prepare("SELECT LAST_INSERT_ID();");
            //if ($returnId->execute()) {
            //    $newItemId = $returnId->fetch(PDO::FETCH_ASSOC);
                return $this->UpdateItemCategory ($id, $postData['category']);
            //}

        } else {
            return false;
        }
    }

/*
 * Добавление товара в корзину
 */
    public function ajaxAddItemToBasket()
    {
        if ($_POST) {
            $_SESSION['basket'][] = $_POST['id'];
            $data = count($_SESSION['basket']);
            return $data;
        }
        return false;
    }

/*
 * Очистка корзины
 */
    public function ajaxEmptyBasket()
    {
        if ($_POST) {
            if (isset($_SESSION['basket'])) {
                unset($_SESSION['basket']);
                return true;
            }
        }
        return false;
    }


}