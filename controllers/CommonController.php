<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class CommonController extends BaseController
{
    public function chat($req, $res){
        $this->renderLayout('main', 'pages/common/chat');
    }

    public function editProfile($req, $res){
        $this->renderLayout('main', 'pages/common/edit_profile');
    }

    public function changePassword($req, $res){
        $this->renderLayout('main', 'pages/common/change_password');
    }

    public function payoutMethods($req, $res){
        $this->renderLayout('main', 'pages/common/payout_methods');
    }

    public function sellerDashboard($req, $res){
        $this->renderLayout('main', 'pages/common/seller_dashboard');
    }

    public function sellerOrdersList($req, $res){
        $this->renderLayout('main', 'pages/common/seller_orders_list');
    }

    public function sellerOrderDetails($req, $res){
        $this->renderLayout('main', 'pages/common/seller_order_details');
    }

    public function earnings($req, $res){
        $this->renderLayout('main', 'pages/common/earnings');
    }

    public function customPackages($req, $res){
        $this->renderLayout('main', 'pages/common/custom_packages');
    }

    public function offerPackage($req, $res){
        $this->renderLayout('main', 'pages/common/offer_package');
    }
}
