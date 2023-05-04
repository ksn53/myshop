<?php
class Controller_Edit extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_Edit();
}

function action_index(){
    if ($_SESSION['group'] == 1) {
        if ($_GET['id']) {
            $data['categorysList'] = $this->model->categorysList();
            $data['itemData'] = $this->model->getItemData($_GET['id']);
            $this->view->generate('edit_view.php', 'template_view.php', $data, 'Изменить товар');
        }
    }
}

}
