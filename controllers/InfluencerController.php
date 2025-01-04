<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class InfluencerController extends BaseController
{
    public function __construct(){
        \app\core\Helpers\AuthHelper::CheckPermission('influencer');
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


    // --------------------------------------------------------------------------

    public function createPromotion() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $gigData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'platform' => $_POST['platform'],
                'tags' => $_POST['tags'],
                'basic' => [
                    'benefits' => $_POST['basic']['benefits'],
                    'delivery_days' => $_POST['basic']['delivery_days'],
                    'price' => $_POST['basic']['price'],
                    'revisions' => $_POST['basic']['revisions']
                    
                ],
                'premium' => [
                    'benefits' => $_POST['premium']['benefits'],
                    'delivery_days' => $_POST['premium']['delivery_days'],
                    'price' => $_POST['premium']['price'],
                    'revisions' => $_POST['premium']['revisions']
                    
                ]
            ];

            $this->model('PromotionModel');
            $promotionModel = new PromotionModel();
            // var_dump($promotionModel);


            $result = $promotionModel->createPackage($userId, $gigData);
            var_dump($result);

            if ($result) {
                echo "Package created successfully!";
                header("Location: /influencerviewcontroller/influencerPackages");
                // exit;
            } else {
                echo "Failed to create package. Please try again.";
                // echo $result;
            }
        } else {
            echo "Invalid request or session expired.";
        }
    }

}
