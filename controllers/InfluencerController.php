<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class InfluencerController extends BaseController
{
    public function __construct(){
//        \app\core\Helpers\AuthHelper::CheckPermission('influencer');
    }

    public function dashboard($req, $res){
        $this->renderLayout('main', 'pages/common/seller_dashboard');
    }

    public function myPromotions($req, $res){
        $this->renderLayout('main', 'pages/influencer/my_promotions');
    }

    public function addPromotion($req, $res){
        $this->renderLayout('main', 'pages/influencer/add_promotion');
    }

    public function editPromotion($req, $res){
        $this->renderLayout('main', 'pages/influencer/edit_promotion');
    }

    public function ordersList($req, $res){
        $this->renderLayout('main', 'pages/common/seller_orders_list');
    }

    public function orderDetails($req, $res){
        $this->renderLayout('main', 'pages/common/seller_order_details');
    }

    public function customPackages($req, $res){
        $this->renderLayout('main', 'pages/common/custom_packages');
    }

    public function offerPackage($req, $res){
        $this->renderLayout('main', 'pages/common/offer_package');
    }

    public function earnings($req, $res){
        $this->renderLayout('main', 'pages/common/earnings');
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
}
