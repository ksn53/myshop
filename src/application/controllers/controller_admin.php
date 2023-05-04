<?php
class Controller_Admin extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_Admin();
}

function action_index()
{
    if ( ($_SESSION['group'] == 1) || ($_SESSION['group'] == 2) ) {
        $this->view->generate('admin_view.php', 'template_view.php', 'Администирование');
    }
}

}
