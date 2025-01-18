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


    public function getServiceList($req, $res) {
        $serviceModel = $this->model('Services\\Service');
        $servicePackageModel = $this->model('Services\\ServicePackage');
        $userModel = $this->model('Users\\User');
    
        $conditions = [];
    
        // Filter services based on query parameters

        // Filter by gig or promotion
        if ($req->getParam('type')) {
            $conditions['service_type'] = $req->getParam('type');
        }
    
        // Filter by category
        if ($req->getParam('category')) {
            $conditions['category'] = $req->getParam('category');
        }

        // Filter by user
        if ($req->getParam('user') == 'current') {
            $conditions['user_id'] = AuthHelper::getCurrentUser()['user_id'];
        } else if ($req->getParam('user') == 'other' && $req->getParam('user_id')) {
            $conditions['user_id'] = $req->getParam('user_id');
        }
    
        // Search by title
        if ($req->getParam('query')) {
            $conditions['title LIKE'] = '%' . $req->getParam('query') . '%';
        }
    
        // Sort services
        $sort = 'created_at ASC'; // Default sort
        switch ($req->getParam('sort')) {
            case 'newest':
                $sort = 'created_at DESC';
                break;
            case 'oldest':
                $sort = 'created_at ASC';
                break;
            case 'price_high':
                $sort = 'price DESC';
                break;
            case 'price_low':
                $sort = 'price ASC';
                break;
        }

        $serviceList = $serviceModel->findAll($conditions, $sort);

        // Enhance service list with user details
        $enhancedServiceList = $serviceList;

        try {
            foreach ($enhancedServiceList as &$service) {
                error_log(print_r($service, true));
                $servicePackages = $servicePackageModel->find($service->service_id, 'service_id');
                error_log(print_r($servicePackages, true));
                $service->packages = $servicePackages;


                $user = $userModel->getUserById($service->user_id);
                error_log(print_r($user, true));
                if ($user) {
                    // Add only necessary user details
                    $service->user = [
                        'user_id' => $user->user_id,
                        'name' => $user->name,
                        'profile_picture' => $user->profile_picture,
                        'bio' => $user->bio
                    ];
                }
            }
        } catch (Exception $e) {
            error_log("Error enhancing service list with user details: " . $e->getMessage());
        }
    
        $res->sendJson($enhancedServiceList);
    }

    public function findGig($req, $res) {
        try {
            // Get the gig ID and query parameters
            $gigId = $req->getParam('id');
            $includeService = $req->getParam('service') === 'true';
            $includePackages = $req->getParam('packages') === 'true';
            
            if (!$gigId) {
                $res->sendError('Gig ID is required', 400);
                return;
            }

            // Initialize response data
            $responseData = ['success' => true, 'data' => []];

            // Load models
            $serviceModel = $this->model('Services\\Service');
            $servicePackageModel = $this->model('Services\\ServicePackage');

            // Get service details if requested
            if ($includeService) {
                $service = $serviceModel->findOne($gigId, 'service_id');
                if (!$service) {
                    $res->sendError('Gig not found', 404);
                    return;
                }
                // Decode JSON fields
                $service->media = json_decode($service->media);
                $responseData['data']['service'] = $service;
            }

            // Get packages if requested
            if ($includePackages) {
                $packages = $servicePackageModel->findAll(['service_id' => $gigId]);
                $responseData['data']['packages'] = $packages;
            }

            $res->sendJson($responseData);

        } catch (\Exception $e) {
            $res->sendError('Failed to fetch gig details. ' . $e->getMessage(), 500);
        }
    }
    
    public function getInfluencerList($req, $res){
        $userModel = $this->model('Users\\User');

        $conditions = ['role' => 'influencer'];

        $influencerList = $userModel->findAll($conditions);

        $res->sendJson($influencerList);
    }



    // *************

}