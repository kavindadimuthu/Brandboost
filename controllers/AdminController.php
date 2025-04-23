<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/UserController.php';
require_once __DIR__ . '/ServiceController.php';

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
        // $userId = $req->getParam('id') ?? null;

        $userController = new UserController();
        $serviceController = new ServiceController();

        // Fetch user profile data
        $userData = $userController->getUserProfile($req, $res, true);

        // Fetch service profile data
        $serviceData = $serviceController->getServiceList($req, $res, true);

        // Log the retrieved data for debugging
        if ($userData) {
            error_log('User Data: ' . print_r($userData, true));
        } else {
            error_log('User data is empty or invalid');
        }

        if ($serviceData) {
            // error_log('Service Data: ' . print_r($serviceData, true));
        } else {
            error_log('Service data is empty or invalid');
        }

        // Combine both data into one array
        $combinedData = [
            'userData' => $userData,
            'serviceData' => $serviceData,
            'isAdminView' => true  // This flag indicates admin view
        ];

        // error_log('Combined Data: ' . print_r($combinedData, true));

        // error_log("User ID: " . $userId); // Log the user ID for debugging
        $this->renderLayout('admin_layout', 'pages/guest/user_profile', ['combinedData' => $combinedData]);
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
