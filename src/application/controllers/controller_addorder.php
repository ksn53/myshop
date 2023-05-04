<?php
class Controller_AddOrder extends Controller {

function __construct()
{
    parent::__construct();
    $this->model = new Model_AddOrder();
}

function action_index()
{
    if (isset($_SESSION['loginStatus']) && ($_SESSION['loginStatus'] == true)) {
        $data['ordersList'] = $this->model->ordersList();
        $data['userSettings'] = $this->model->userSettings($_SESSION['id']);
        $data['itemsPrice'] = $this->model->ordersPrice();
        $data['deliveryList'] = $this->model->deliveryList();
        $data['paymentList'] = $this->model->paymentList();
        $this->view->generate('addorder_view.php', 'template_view.php', $data, 'Добавить заказ');
    } else {
        header('Location: /login');
    }
}

}
