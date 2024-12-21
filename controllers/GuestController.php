<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class GuestController extends BaseController
{
    public function home($req, $res){
        $this->renderLayout('main', 'pages/guest/landing');
    }

    public function servicesList($req, $res){
        $this->renderLayout('main', 'pages/guest/services_list');
    }

    public function serviceDetails($req, $res){
        $this->renderLayout('main', 'pages/guest/service_details');
    }

    public function userProfile($req, $res){
        $userId = $req->getParam('id') ?? null;
        $this->renderLayout('main', 'pages/guest/user_profile');
    }

    public function influencersList($req, $res){
        $this->renderLayout('main', 'pages/guest/influencers_list');
    }
    
    public function about($req, $res){
        $this->renderLayout('main', 'pages/guest/about_us');
    }

    public function contact($req, $res){
        $this->renderLayout('main', 'pages/guest/contact_us');
    }

    public function faq($req, $res){
        $this->renderLayout('main', 'pages/guest/faq');
    }

    public function register($req, $res){
        $this->renderPage('pages/guest/register');
    }

    public function login($req, $res){
        $this->renderPage('pages/guest/login');
    }

    public function forgotPassword($req, $res){
        $this->renderPage('pages/guest/forgot_password');
    }

    public function resetPassword($req, $res){
        $this->renderPage('pages/guest/reset_password');
    }


}