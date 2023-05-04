<?php
class Controller_Ajax extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_Ajax();
}

function action_index()
{
    echo $this->model->ajaxData();
}

}
