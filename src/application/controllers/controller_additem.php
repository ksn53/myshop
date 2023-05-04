<?php
class Controller_AddItem extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_AddItem();
}

function action_index()
{
    if ($_SESSION['group'] == 1) {
        $data = $this->model->categorysList();
        $this->view->generate('additem_view.php', 'template_view.php', $data, 'Добавить товар');
    }
}

}
