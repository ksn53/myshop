<?php
class Controller_Sale extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_Sale();
}

function action_index()
{
    $this->view->generate('sale_view.php', 'template_view.php', 'Распродажа');
}

}