<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\DebugHelper;
use app\core\Request;
use app\core\Response;

require_once __DIR__ . '/ServiceController.php';

class TestController extends BaseController
{
    // **test function

    public function test($req, $res){

        // Tests for InfluencerSocialAccount model

        // $this->testGetSocialAccountByAccountId($req, $res);
        // $this->testGetSocialAccountsByUserId($req, $res);
        // $this->testCreateSocialAccount($req, $res);
        // $this->testUpdateSocialAccountById($req, $res);
        // $this->testDeleteSocialAccountById($req, $res);
        // $this->testGetSocialAccountsByPlatform($req, $res);
        // $this->testSearchSocialAccountsByUsername($req, $res);

        // Tests for User model

        // $this->testGetUserById($req, $res);
        // $this->testGetUserByEmail($req, $res);
        // $this->testGetUsersByRole($req, $res);
        // $this->testCreateUser($req, $res);
        // $this->testUpdateUserById($req, $res);
        // $this->testDeleteUserById($req, $res);
        // $this->testSearchUsers($req, $res);
        // $this->testGetUsersByStatus($req, $res);

        // $this->getUserProfile($req, $res);
        $this->testCreateServiceAPI();

        // $this->testCreateService();


        // Tests for Service model

        // $this->testGetServiceById($req, $res);
        // $this->testGetServicesByType($req, $res);
        // $this->testGetServicesByUser($req, $res);
        // $this->testSearchServicesByTitle($req, $res);
        // $this->testCreateService($req, $res);
        // $this->testUpdateServiceById($req, $res);
        // $this->testDeleteServiceById($req, $res);
        // $this->testGetServicesByPlatform($req, $res);
        // $this->testGetServicesByTag($req, $res);

    }


    public function testCreateServiceAPI()
    {
        // Prepare mock request data
        $mockFormData = [
            'user_id' => 14,
            'title' => 'Sample Service',
            'description' => 'This is a test description',
            'type' => 'basic',
            'platforms' => ['Web', 'Mobile'],
            'delivery_formats' => ['PDF', 'DOC'],
            'tags' => ['tag1', 'tag2'],
            'packages' => [
                ['name' => 'Package One', 'price' => 50],
                ['name' => 'Package Two', 'price' => 100]
            ]
        ];
    
        // Mock uploaded files if needed
        $mockFiles = [
            'cover_image' => [
                'name' => 'cover.jpg',
                'type' => 'image/jpeg',
                'tmp_name' => '/tmp/php-cover',
                'error' => UPLOAD_ERR_OK,
                'size' => 1234
            ],
            'media' => [
                [
                    'name' => 'sample1.png',
                    'type' => 'image/png',
                    'tmp_name' => '/tmp/php-media1',
                    'error' => UPLOAD_ERR_OK,
                    'size' => 2345
                ]
            ]
        ];
    
        // Create mock request and response objects
        $request = new Request($mockFormData, $mockFiles);
        $response = new Response();
    
        // Call the ServiceController method
        $serviceController = new ServiceController();
        $result = $serviceController->createService($request, $response);
    
        // Inspect the $result if needed
        var_dump($result);
    }

    /**
     * Fetch all details about a user based on their role and return as API response.
     *
     * @param object $request  Request object containing input data (e.g., user_id).
     * @param object $response Response object to send back HTTP responses.
     */
    public function getUserProfile($request, $response): void {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $userId = $request->getParam('user_id');

        if (empty($userId)) {
            $response->sendError('User ID is required.', 400);
            return;
        }

        // Retrieve the User model
        $userModel = $this->model('Users\User');
        $businessmanModel = $this->model('Users\Businessman');
        $influencerModel = $this->model('Users\InfluencerSocialAccount');
        $designerModel = $this->model('Users\DesignerProject');

        // Fetch basic user data
        $user = $userModel->getUserById($userId);

        if (!$user) {
            $response->sendError('User not found.', 404);
            return;
        }

        $userProfile = [
            'user_id'         => $user->user_id,
            'name'            => $user->name,
            'email'           => $user->email,
            'role'            => $user->role,
            'profile_picture' => $user->profile_picture,
            'bio'             => $user->bio
        ];

        // Fetch additional data based on user role
        switch ($user->role) {
            case 'businessman':
                $businessmanData = $businessmanModel->getBusinessRegistrationByUserId($userId);
                if ($businessmanData) {
                    $userProfile['br_details'] = $businessmanData;
                }
                break;

            case 'influencer':
                $influencerData = $influencerModel->getSocialAccountsByUserId($userId);
                if ($influencerData) {
                    $userProfile['social_accounts'] = $influencerData;
                }
                break;

            case 'designer':
                $designerData = $designerModel->getProjectsByUserId($userId);
                if ($designerData) {
                    $userProfile['portfolio_projects'] = $designerData;
                }
                break;

            default:
                $response->sendError('Invalid user role.', 400);
                return;
        }

        // Send the response with user profile data
        $response->sendJson($userProfile);
    }
    
    // Test functions for InfluencerSocialAccount model methods
    /**
     * Test reading social accounts by account ID.
     */
    public function testGetSocialAccountByAccountId($req, $res){
        $model = $this->model("Users\\InfluencerSocialAccount");
        $account = $model->getSocialAccountByAccountId(2);
        if ($account) {
            echo "Social account fetched successfully";
            DebugHelper::debugPrint($account);
        } else {
            echo "Error fetching social account";
        }
    }
    
    /**
     * Test reading social accounts by user ID.
     */
    public function testGetSocialAccountsByUserId($req, $res)
    {
        $model = $this->model("Users\\InfluencerSocialAccount");
        $accounts = $model->getSocialAccountsByUserId(1);
        if ($accounts) {
            echo "Social accounts fetched by user_id successfully";
            DebugHelper::debugPrint($accounts);
        } else {
            echo "Error fetching social accounts by user_id";
        }
    }
    
    /**
     * Test creating a new social account.
     */
    public function testCreateSocialAccount($req, $res)
    {
        $model = $this->model("Users\\InfluencerSocialAccount");
        $data = [
            // 'account_id' => 3,
            'user_id'    => 2,
            'platform'   => 'Youtube',
            'username'   => 'Rachell',
            'link'       => 'https://testYT.com/test'
        ];
        $result = $model->createSocialAccount($data);
        echo $result ? "Social account created" : "Error creating social account";
    }
    
    /**
     * Test updating a social account by ID.
     */
    public function testUpdateSocialAccountById($req, $res)
    {
        $model = $this->model("Users\\InfluencerSocialAccount");
        $data = [
            'username' => 'updated_insta'
        ];
        $result = $model->updateSocialAccountById(1, $data);
        echo $result ? "Social account updated" : "Error updating social account";
    }
    
    /**
     * Test deleting a social account by ID.
     */
    public function testDeleteSocialAccountById($req, $res)
    {
        $model = $this->model("Users\\InfluencerSocialAccount");
        $result = $model->deleteSocialAccountById(103);
        echo $result ? "Social account deleted" : "Error deleting social account";
    }
    
    /**
     * Test retrieving social accounts by platform.
     */
    public function testGetSocialAccountsByPlatform($req, $res)
    {
        $model = $this->model("Users\\InfluencerSocialAccount");
        $accounts = $model->getSocialAccountsByPlatform('Youtube');
        if ($accounts) {
            echo "Social accounts fetched by platform successfully";
            DebugHelper::debugPrint($accounts);
        } else {
            echo "Error fetching social accounts by platform";
        }
    }
    
    /**
     * Test searching social accounts by username.
     */
    public function testSearchSocialAccountsByUsername($req, $res)
    {
        $model = $this->model("Users\\InfluencerSocialAccount");
        $accounts = $model->searchSocialAccountsByUsername('rachell');
        if ($accounts) {
            echo "Social accounts fetched by searching username successfully";
            DebugHelper::debugPrint($accounts);
        } else {
            echo "Error searching social accounts by username";
        }
    }
    // ...existing code...




    // **Test functions for User model
    
    /**
     * Test retrieving a user by ID.
     */
    public function testGetUserById($req, $res)
    {
        $userModel = $this->model("Users\\User");
        $user = $userModel->getUserById(1);
        if ($user) {
            echo "User fetched by ID successfully";
            DebugHelper::debugPrint($user);
        } else {
            echo "Error fetching user by ID";
        }
    }
    
    /**
     * Test retrieving a user by email.
     */
    public function testGetUserByEmail($req, $res)
    {
        $userModel = $this->model("Users\\User");
        $user = $userModel->getUserByEmail('alicep@brandboost.lk');
        if ($user) {
            echo "User fetched by email successfully";
            DebugHelper::debugPrint($user);
        } else {
            echo "Error fetching user by email";
        }
    }
    
    /**
     * Test retrieving users by role.
     */
    public function testGetUsersByRole($req, $res)
    {
        $userModel = $this->model("Users\\User");
        $users = $userModel->getUsersByRole('businessman');
        if ($users) {
            echo "Users fetched by role successfully";
            DebugHelper::debugPrint($users);
        } else {
            echo "Error fetching users by role";
        }
    }
    
    /**
     * Test creating a new user.
     */
    public function testCreateUser($req, $res)
    {
        $userModel = $this->model("Users\\User");
        $data = [
            'name'           => 'Test User',
            'email'          => 'test@example.com',
            'role'           => 'designer',
            'account_status' => 'active'
        ];
        $result = $userModel->createUser($data);
        echo $result ? "User created" : "Error creating user";
    }
    
    /**
     * Test updating a user by ID.
     */
    public function testUpdateUserById($req, $res)
    {
        $userModel = $this->model("Users\\User");
        $data = [
            'name' => 'Updated User'
        ];
        $result = $userModel->updateUserById(40, $data);
        echo $result ? "User updated" : "Error updating user";
    }
    
    /**
     * Test deleting a user by ID.
     */
    public function testDeleteUserById($req, $res)
    {
        $userModel = $this->model("Users\\User");
        $result = $userModel->deleteUserById(40);
        echo $result ? "User deleted" : "Error deleting user";
    }
    
    /**
     * Test searching users by name or email.
     */
    public function testSearchUsers($req, $res)
    {
        $userModel = $this->model("Users\\User");
        $users = $userModel->searchUsers('test');
        if ($users) {
            echo "Users fetched by search term successfully";
            DebugHelper::debugPrint($users);
        } else {
            echo "Error searching users";
        }
    }
    
    /**
     * Test retrieving users by account status.
     */
    public function testGetUsersByStatus($req, $res)
    {
        $userModel = $this->model("Users\\User");
        $users = $userModel->getUsersByStatus('active');
        if ($users) {
            echo "Users fetched by status successfully";
            DebugHelper::debugPrint($users);
        } else {
            echo "Error fetching users by status";
        }
    }
    
    // Test functions to test service model methods

    /**
     * Test retrieving a service by ID.
     */
    public function testGetServiceById($req, $res)
    {
        $serviceModel = $this->model("Services\\Service");
        $service = $serviceModel->getServiceById(42);
        if ($service) {
            echo "Service fetched by ID successfully";
            DebugHelper::debugPrint($service);
        } else {
            echo "Error fetching service by ID";
        }
    }

    /**
     * Test retrieving services by type.
     */
    public function testGetServicesByType($req, $res)
    {
        $serviceModel = $this->model("Services\\Service");
        $services = $serviceModel->getServicesByType('promotion');
        if ($services) {
            echo "Services fetched by type successfully";
            DebugHelper::debugPrint($services);
        } else {
            echo "Error fetching services by type";
        }
    }

    /**
     * Test retrieving services by user.
     */
    public function testGetServicesByUser($req, $res)
    {
        $serviceModel = $this->model("Services\\Service");
        $services = $serviceModel->getServicesByUser(1);
        if ($services) {
            echo "Services fetched by user successfully";
            DebugHelper::debugPrint($services);
        } else {
            echo "Error fetching services by user";
        }
    }

    /**
     * Test searching services by title.
     */
    public function testSearchServicesByTitle($req, $res)
    {
        $serviceModel = $this->model("Services\\Service");
        $services = $serviceModel->searchServicesByTitle('Test');
        if ($services) {
            echo "Services fetched by title search successfully";
            DebugHelper::debugPrint($services);
        } else {
            echo "Error searching services by title";
        }
    }

    /**
     * Test creating a new service.
     */
    public function testCreateService($req, $res)
    {
        $serviceModel = $this->model("Services\\Service");
        $data = [
            'service_id'   => 107,
            'title'        => 'Test Service',
            'service_type' => 'promotion',
            'user_id'      => 1,
            'platforms'    => 'Instagram',
            'tags'         => 'test, sample'
        ];
        $result = $serviceModel->createService($data);
        echo $result ? "Service created" : "Error creating service";
    }

    /**
     * Test updating a service by ID.
     */
    public function testUpdateServiceById($req, $res)
    {
        $serviceModel = $this->model("Services\\Service");
        $data = [
            'title' => 'Updated Test Service'
        ];
        $result = $serviceModel->updateServiceById(101, $data);
        echo $result ? "Service updated" : "Error updating service";
    }

    /**
     * Test deleting a service by ID.
     */
    public function testDeleteServiceById($req, $res)
    {
        $serviceModel = $this->model("Services\\Service");
        $result = $serviceModel->deleteServiceById(101);
        echo $result ? "Service deleted" : "Error deleting service";
    }

    /**
     * Test retrieving services by platform.
     */
    public function testGetServicesByPlatform($req, $res)
    {
        $serviceModel = $this->model("Services\\Service");
        $services = $serviceModel->getServicesByPlatform('Instagram');
        if ($services) {
            echo "Services fetched by platform successfully";
            DebugHelper::debugPrint($services);
        } else {
            echo "Error fetching services by platform";
        }
    }

    /**
     * Test retrieving services by tag.
     */
    public function testGetServicesByTag($req, $res)
    {
        $serviceModel = $this->model("Services\\Service");
        $services = $serviceModel->getServicesByTag('fab');
        if ($services) {
            echo "Services fetched by tag successfully";
            DebugHelper::debugPrint($services);
        } else {
            echo "Error fetching services by tag";
        }
    }









}