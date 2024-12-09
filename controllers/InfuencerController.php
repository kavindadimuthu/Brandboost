<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class InfuencerController extends BaseController
{
    public function myPromotions($req, $res){
        $this->renderLayout('main', 'pages/influencer/my_promotions');
    }

    public function addPromotion($req, $res){
        $this->renderLayout('main', 'pages/influencer/add_promotion');
    }

    public function editPromotion($req, $res){
        $this->renderLayout('main', 'pages/influencer/edit_promotion');
    }
}
