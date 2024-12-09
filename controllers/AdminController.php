<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class AdminController extends BaseController
{
    public function dashboard($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/dashboard');
    }

    public function verificationsList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/verifications_list');
    }

    public function verificationDetails($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/verification_details');
    }

    public function complaintsList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/complaints_list');
    }

    public function complaintDetails($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/complaint_details');
    }

    public function usersList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/users_list');
    }

    public function ordersList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/orders_list');
    }

    public function orderDetails($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/order_details');
    }

    public function actionsList($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/actions_list');
    }

    public function actionDetails($req, $res){
        $this->renderLayout('admin_layout', 'pages/admin/action_details');
    }
}
