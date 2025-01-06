<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\DebugHelper;

class GuestController extends BaseController
{
    public function home($req, $res){
        // $this->renderLayout('main', 'pages/guest/landing');
        $this->renderLayout('main', 'pages/guest/landing');
    }

    public function servicesList($req, $res){
        $this->renderLayout('main', 'pages/guest/services_list');
    }

    public function serviceDetails($req, $res){
        $this->renderLayout('main', 'pages/guest/service_details');
    }

    public function userProfile($req, $res){
        $userId = $req->getParam('') ?? null;
        $this->renderLayout('main', 'pages/guest/user_profile');
    }

    public function influencersList($req, $res){
        $this->renderLayout('main', 'pages/guest/influencers_list');
    }
    
    public function about($req, $res){
        // $this->renderLayout('main', 'pages/guest/about_us');
        $this->renderLayout('main', 'pages/guest/about_us');
    }

    public function contact($req, $res){
        // $this->renderLayout('main', 'pages/guest/contact_us');
        $this->renderLayout('main', 'pages/guest/contact_us');
    }

    public function faq($req, $res){
        // $this->renderLayout('main', 'pages/guest/faq');
        $this->renderLayout('main', 'pages/guest/faq');
    }

    public function register($req, $res){
        $this->renderPage('pages/guest/register');
    }
    public function registerForm($req, $res){
        $param = $req->getParam('role');

        $this->renderPage('pages/guest/registerForm', $data = [$param]);
    }

    public function login($req, $res){
        if(AuthHelper::isLoggedIn()){
            $user = AuthHelper::getCurrentUser();
            // Redirect to the user's dashboard according to their role
            switch ($user['role']) {
                case 'admin':
                    header("Location: /admin/dashboard");
                    break;
                case 'businessman':
                    header("Location: /services");
                    break;
                case 'influencer':
                    header("Location: /influencer/dashboard");
                    break;
                case 'designer':
                    header("Location: /designer/dashboard");
                    break;
                default:
                    header("Location: /auth/login?error=Invalid%20role");
                    break;
            }
        }

        $this->renderPage('pages/guest/login');      
    }

    public function forgotPassword($req, $res){
        $this->renderPage('pages/guest/forgot_password');
    }

    public function resetPassword($req, $res){
        $this->renderPage('pages/guest/reset_password');
    }


    // API endpoints

    public function getServiceList($req, $res){
        $serviceModel = $this->model('Services\\Service');

        $conditions = ['service_type' => 'promotion'];

        if ($req->getParam('type')) {
            $conditions = ['service_type' => $req->getParam('type')];
        }

        $serviceList = $serviceModel->findAll($conditions);

        $res->sendJson($serviceList);
    }
    
    public function getInfluencerList($req, $res){
        $userModel = $this->model('Users\\User');

        $conditions = ['role' => 'influencer'];

        $influencerList = $userModel->findAll($conditions);

        $res->sendJson($influencerList);
    }



    // *************

}