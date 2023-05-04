<?php
class Controller_Itemlist extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_Itemlist();
}

function action_index()
{
    $this->view->generate('itemlist_view.php', 'template_view.php', 'список товаров');
}

}