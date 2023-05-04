<?php
class Controller_OrdersList extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_OrdersList();
}

function action_index()
{
    if ( ($_SESSION['group'] == 1) || ($_SESSION['group'] == 2) ) {
        $data = $this->model->ordersList();
    }
    $this->view->generate('orderslist_view.php', 'template_view.php', $data, 'Администирование');
}

}
