<?php
class Controller_Usersettings extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_Usersettings();
}

function action_index()
{
    if (isset($_SESSION['loginStatus']) && ($_SESSION['loginStatus'] == true)) {
        $data = $this->model->userSettings($_SESSION['id']);
        $this->view->generate('usersettings_view.php', 'template_view.php', $data, 'Панель пользователя');
    }
}

}
