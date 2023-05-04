<?php
class Controller_Login extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_Login();
}

function action_index()
{
    $this->model->postData();
    $data = null;
    $this->view->generate('login_view.php', 'template_view.php', $data, 'Администирование');
}

}

