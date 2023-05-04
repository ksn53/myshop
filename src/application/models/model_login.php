<?php
class Model_Login extends Model{

    /**
     * Входная функция-селектор.
     * От значения GET и POST зависит, какая функция будет вызываться далее.
     * @return выдаёт ответ отработавшей функции в формате json
    **/
    public function postData()
    {
        if (isset($_GET["logout"])) {
            $this->LogoutCurrentUser();
        }
        if (isset($_POST["_mode"])) {
            $call="main".$_POST["_mode"];
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

    /*
     * Возвращает ID группы пользователя с заданным ID
     * @param тип int ID пользователя
     * @return тип int группа пользователя
     */
    function userGroupId($id)
    {
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $data = array();
        $arrayItems = $pdo->prepare("SELECT groups_id FROM `user_group` WHERE user_id=" . $id);
        if ($arrayItems->execute()) {
            $items = $arrayItems->fetch(PDO::FETCH_ASSOC);
        }
        return $items['groups_id'];
    }

    /**
     *  Проверка пароля пользователя
     * @param $value тип string строка для очистки
     * @return тип string выводит очищенную строку
    **/
    public function mainPasswordCheck()
    {
        $postData = $_POST;
        $db = new Database();
        $pdo = $db->getDatabase();
        $pdo = $db->getDatabaseError();
        $name = $this->clean($postData['name']);
        $password = $this->clean($postData['password']);
        $array_users = $pdo->prepare("SELECT id,password,name FROM users WHERE email='" . $name . "';");
        $array_users->execute();
        $userSettings = $array_users->fetch(PDO::FETCH_ASSOC);
        if ($userSettings['password'] == $password) {
            $loginFlag = true;
            $name = $userSettings['name'];
            setcookie("currentLogin", $name, time()+60*60*24*30, "/");
            $_SESSION["loginStatus"] = true;
            $_SESSION["currentLogin"] = $name;
            $_SESSION['id'] = $userSettings['id'];
            $_SESSION['group'] = $this->userGroupId($userSettings['id']);
        } else {
            $_SESSION['loginUnsuccessful'] = true;
        }
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

    /**
     *  Выход пользователя с сайта и завершение сессии
    **/
    public function LogoutCurrentUser()
    {
        $this->destroySession();
    }

}
