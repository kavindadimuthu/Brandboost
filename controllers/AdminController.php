<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class AdminController extends BaseController
{
    public function __construct(){
        \app\core\Helpers\AuthHelper::CheckPermission('admin');
    }

    public function dashboard($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/dashboard');
    }

    public function servicesList($req, $res){
        $this->renderLayout('admin_layout', 'pages/guest/services_list');
    }

    public function serviceDetails($req, $res){
        $this->renderLayout('admin_layout', 'pages/guest/service_details');
    }

    public function usersList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/users_list');
    }

    public function userProfile($req, $res){
        $userId = $req->getParam('id') ?? null;
        $this->renderLayout('admin_layout', 'pages/guest/user_profile');
    }

    public function verificationsList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/verifications_list');
    }

    public function verificationDetails($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/verification_details');
    }

    public function ordersList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/orders_list');
    }

    public function orderDetails($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/order_details');
    }

    public function complaintsList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/complaints_list');
    }

    public function complaintDetails($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/complaint_details');
    }

    public function actionsList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/actions_list');
    }

    public function actionDetails($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/action_details');
    }
}
