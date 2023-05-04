<?php
class Model_CategorysList extends Model{

    public function postData()
    {
        if (isset($_POST["_mode"])) {
            $call="post".$_POST["_mode"];
                return json_encode(array("error"=>false,"data"=>$this->$call()));
            } else {
                return json_encode(array("error"=>true));
            }
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
                $data[] = [$items['id'],$items['name']];
            }
        return $data;
    }

    /**
     * удаление и добавление категории в зависимости от входящего
     * значения $_POST.
    **/
    public function postModifyCategory()
    {
        if ($_POST) {
            $category = $this->clean(array_pop($_POST));
            if ($category != "") {
                $this->addCategory($category);
            }
            array_shift($_POST);
            foreach ($_POST as $value) {
                $this->delCategory($value);
            }
        }
    }

    /**
     * добавляет категорию
     * @param тип string имя категории
     * @return тип boolean - true если запрос был выполнено корректно, false - при наличии ошибки
    **/
    function addCategory($name)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        if ($name) {
            $array_items = $pdo->prepare("INSERT INTO categorys (id, name) VALUES (NULL, '" . $this->clean($name) . "')");
            return $array_items -> execute();
        }
        return false;
    }

    /**
     * удаляет категорию
     * @param тип string имя категории
     * @return тип boolean - true если запрос был выполнено корректно, false - при наличии ошибки
    **/
    function delCategory($number)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        if ($number) {
            $array_items = $pdo->prepare("DELETE FROM categorys WHERE id = " . $number);
            return $array_items -> execute();
        }
        return false;
    }

}
