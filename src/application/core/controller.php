<?php

class Controller {

    public $model;
    public $view;
    public $arg = array();

    function __construct() {
        $this->view = new View();
    }

    function action_index() { }
}
