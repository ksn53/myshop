<?php
class Controller_CategorysList extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_CategorysList();
}

function action_index()
{
    if ($_SESSION['group'] == 1) {
        $this->model->postData();
        $data = $this->model->categorysList();
    }
    $this->view->generate('categoryslist_view.php', 'template_view.php', $data, 'Администирование');
}

}
