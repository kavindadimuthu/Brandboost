<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class DesignerController extends BaseController
{
    public function __construct(){
//        \app\core\Helpers\AuthHelper::CheckPermission('designer');
    }

    public function dashboard($req, $res){
        $this->renderLayout('main', 'pages/common/seller_dashboard');
    }

    public function myGigs($req, $res){
        $this->renderLayout('main', 'pages/designer/my_gigs');
    }

    public function addGig($req, $res){
        $this->renderLayout('main', 'pages/designer/add_gig');
    }

    public function editGig($req, $res){
        $this->renderLayout('main', 'pages/designer/edit_gig');
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
