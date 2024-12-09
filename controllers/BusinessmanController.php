<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class BusinessmanController extends BaseController
{
    public function requestOrder($req, $res){
        $this->renderLayout('main', 'pages/businessman/request_order');
    }

    public function placeOrder($req, $res){
        $this->renderLayout('main', 'pages/businessman/place_order');
    }

    public function requestPackage($req, $res){
        $this->renderLayout('main', 'pages/businessman/request_package');
    }

    public function ordersList($req, $res){
        $this->renderLayout('main', 'pages/businessman/orders_list');
    }

    public function orderDetails($req, $res){
        $this->renderLayout('main', 'pages/businessman/order_details');
    }
}
