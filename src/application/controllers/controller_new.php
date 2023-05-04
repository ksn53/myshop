<?php
class Controller_New extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_New();
}

function action_index()
{
    $this->view->generate('new_view.php', 'template_view.php', 'Новинки');
}

}