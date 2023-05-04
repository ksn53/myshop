<?php
class Controller_Delivery extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_Delivery();
}

function action_index()
{
    $this->view->generate('delivery_view.php', 'template_view.php', 'Доставка');
}

}
