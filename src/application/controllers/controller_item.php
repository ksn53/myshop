<?php
class Controller_Item extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_Item();
}

function action_index()
{
    $data = $this->model->get_data();
    $this->view->generate('item_view.php', 'template_view.php', $data, 'Услуги');
}

}