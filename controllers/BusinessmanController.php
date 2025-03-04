<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;

class BusinessmanController extends BaseController
{
    public function __construct()
    {
        AuthHelper::CheckPermission('businessman');
    }

    public function ordersList($req, $res)
    {
        $this->renderLayout('main', 'pages/businessman/orders_list');
    }

    public function orderDetails($req, $res)
    {
        $this->renderLayout('main', 'pages/businessman/order_details');
    }

    public function requestOrder($req, $res)
    {
        $this->renderLayout('main', 'pages/businessman/request_order');
    }

    public function placeOrder($req, $res)
    {
        $this->renderLayout('main', 'pages/businessman/place_order');
    }

    public function requestPackage($req, $res)
    {
        $this->renderLayout('main', 'pages/businessman/request_package');
    }

    public function requestedCustomPackages($req, $res)
    {
        $this->renderLayout('main', 'pages/businessman/requested_custom_packages');
    }

    public function editProfile($req, $res)
    {
        $this->renderLayout('main', 'pages/common/edit_profile');
    }

    public function changePassword($req, $res)
    {
        $this->renderLayout('main', 'pages/common/change_password');
    }

}
