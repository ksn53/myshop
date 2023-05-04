<?php
class Model_Usersettings extends Model{
    /*
     * Возвращает параметры пользователя с заданным ID
     * @param тип int ID пользователя
     * @return тип array массив параметров пользователя
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
            $data[] = [$items['id'], $items['name'], $items['sur_name'], $items['second_name'], $items['email'], $items['phone'], $items['password'], $items['address']];
        }
        $data[] = $this->userGroup();
        return $data;
    }

    /*
     * Возвращает имя группы пользователя
     * @return тип string группа пользователя
     */
    function userGroup()
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT name FROM `groups` WHERE id =" . $_SESSION['group']);
        if ($arrayItems->execute()) {
            $items = $arrayItems->fetch(PDO::FETCH_ASSOC);
        }
        return $items['name'];
    }

}
