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

        // echo 'createPromotion';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']['user_id'])) {
            $userId = $_SESSION['user']['user_id'];
            
            // Handle cover image upload
            $coverImage = '';
            if (isset($_FILES['coverImage']) && $_FILES['coverImage']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/promotions/';
                $fileExtension = pathinfo($_FILES['coverImage']['name'], PATHINFO_EXTENSION);
                $coverImageName = uniqid('cover_') . '.' . $fileExtension;
                $coverImagePath = $uploadDir . $coverImageName;
                
                if (move_uploaded_file($_FILES['coverImage']['tmp_name'], $coverImagePath)) {
                    $coverImage = $coverImagePath;
                } else {
                    echo "Failed to upload cover image.";
                    return;
                }
            }
    
            // Handle additional media uploads
            $mediaFiles = [];
            for ($i = 1; $i <= 4; $i++) {
                $mediaKey = "media{$i}";
                if (isset($_FILES[$mediaKey]) && $_FILES[$mediaKey]['error'] === UPLOAD_ERR_OK) {
                    $fileExtension = pathinfo($_FILES[$mediaKey]['name'], PATHINFO_EXTENSION);
                    $mediaFileName = uniqid('media_') . '.' . $fileExtension;
                    $mediaPath = 'uploads/promotions/' . $mediaFileName;
                    
                    if (move_uploaded_file($_FILES[$mediaKey]['tmp_name'], $mediaPath)) {
                        $mediaFiles[] = $mediaPath;
                    }
                }
            }
    
            // Convert platforms array to string if multiple platforms selected
            $platforms = isset($_POST['platform']) ? implode(',', (array)$_POST['platform']) : '';
    
            $promotionData = [
                'user_id' => $userId,
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'cover_image' => $coverImage,
                'media' => !empty($mediaFiles) ? json_encode($mediaFiles) : null,
                'service_type' => 'promotion',
                'platforms' => $platforms,
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
            
            $result = $this->model('PromotionModel')->createPromotion($userId, $promotionData);
    
            if ($result) {
                $_SESSION['success_message'] = "Promotion created successfully!";
                header("Location: /influencer/my-promotions");
                exit;
            } else {
                $_SESSION['error_message'] = "Failed to create promotion. Please try again.";
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            echo "Invalid request or session expired.";
            exit;
        }
    }

}
