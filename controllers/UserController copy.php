<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use \app\core\Helpers\AuthHelper;
use app\core\Utils\FileHandler;

class UserController extends BaseController
{
    /**
     * Fetch a list of users based on search, filters, and query parameters.
     *
     * @param object $request  Request object containing query parameters.
     * @param object $response Response object to send back HTTP responses.
     */
    public function getUserList($request, $response): void {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Retrieve query parameters
        $queryParams = $request->getQueryParams();
        $searchTerm = $queryParams['search'] ?? null;
        $role = $queryParams['role'] ?? null;
        $status = $queryParams['status'] ?? null;
        $limit = $queryParams['limit'] ?? 10;
        $offset = $queryParams['offset'] ?? 0;
        $sortBy = $queryParams['sort_by'] ?? 'name';
        $orderDir = $queryParams['order_dir'] ?? 'asc';

        // Validate limit and offset
        if (!is_numeric($limit) || !is_numeric($offset)) {
            $response->sendError('Invalid pagination parameters.', 400);
            return;
        }

        // Retrieve the User model
        $userModel = $this->model('Users\User');

        // Build options for querying the user list
        $options = [
            'limit' => (int)$limit,
            'offset' => (int)$offset,
            'order' => $sortBy . ' ' . (strtolower($orderDir) === 'desc' ? 'desc' : 'asc'),
        ];

        // Add filters to the query
        $filters = [];

        if ($searchTerm) {
            $options['search'] = $searchTerm;
            $options['searchColumns'] = ['name', 'email'];
        }

        if ($role) {
            $filters['role'] = $role;
        }

        if ($status) {
            $filters['account_status'] = $status;
        }

        // Fetch the user list
        $users = $userModel->read($filters, $options);

        if ($users === false) {
            $response->sendError('Failed to fetch user list.', 500);
            return;
        }

        // Send the response with user list
        $response->sendJson(['users' => $users]);
    }


    /**
     * Fetch all details about a user based on their role and return as API response.
     *
     * @param object $request  Request object containing input data (e.g., user_id).
     * @param object $response Response object to send back HTTP responses.
     */
    public function getUserProfile($request, $response, $byController = false) {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Retrieve query parameters
        if($request->getParam('id') == 'me'){
            if (!AuthHelper::isLoggedIn()) {
                $response->sendError('Unauthorized', 401);
                return;
            }
            $userId = AuthHelper::getCurrentUser()['user_id'];
        } else {
            $userId = $request->getParam('id');
        }

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
            'user_id'         => $user['user_id'],
            'name'            => $user['name'],
            'email'           => $user['email'],
            'phone'           => $user['phone'],
            'role'            => $user['role'],
            'profile_picture' => $user['profile_picture'],
            'cover_picture'   => $user['cover_picture'],
            'bio'             => $user['bio'],
            'professional_title' => $user['professional_title'],
            'specialties' => $user['specialties'],
            'tools' => $user['tools'],
            'location' => $user['location'],

        ];

        // Fetch additional data based on user role
        switch ($user['role']) {
            case 'businessman':
                $businessmanData = $businessmanModel->getBusinessRegistrationByUserId($userId);
                if ($businessmanData) {
                    $userProfile['business_registration'] = $businessmanData;
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
        if($byController){
            return $userProfile;
        } else{
            $response->sendJson($userProfile);
        }
    }

    /**
     * Handle user registration.
     *
     * @param object $request  Request object containing user input.
     * @param object $response Response object to send back HTTP responses.
     */
    public function createUser($request, $response): void {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $data = $request->getParsedBody();
        $name = trim(($data['firstName'] ?? '') . ' ' . ($data['lastName'] ?? ''));
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $confirmPassword = $data['confirmPassword'] ?? '';
        $role = $data['role'] ?? 'user';

        // Validate input
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            $response->sendError('All fields are required.', 400);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response->sendError('Invalid email format.', 400);
            return;
        }

        if ($password !== $confirmPassword) {
            $response->sendError('Passwords do not match.', 400);
            return;
        }

        if ($role == 'businessman' || $role == 'influencer'){
            $verificationStatus = 'unverified';
        } else if ($role == 'designer'){
            $verificationStatus = 'verified';
        } 

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Retrieve the User model using baseController method
        $userModel = $this->model('Users\User');

        // Prepare user data for insertion
        $user = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role,
            'profile_picture' => null,
            'cover_picture' => null,
            'bio' => null,
            'account_status' => 'active',
            'verification_status' => $verificationStatus
        ];

        if (!$userModel->createUser($user)) {
            $response->sendError('Error registering user.', 500);
            return;
        }

        $response->redirect('/login');
    }

    /**
     * Update user profile details, including creating, updating, or deleting user-specific details.
     *
     * @param object $request  Request object containing input data.
     * @param object $response Response object to send back HTTP responses.
     */
    public function updateUserProfile($request, $response): void {

        error_log('Update User Profile Called'); // Log for debugging

        // $reqData = $request->getParsedBody();
        // error_log(print_r($reqData, true)); // Log the request data for debugging
        // error_log('Request Data: ' , $reqData); // Log the request data for debugging

        // exit;

        if(!AuthHelper::isLoggedIn()){
            $response->sendError('Unauthorized', 401);
            return;
        }

        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $data = $request->getParsedBody();
        $uploadedFiles = $request->getFiles();

        error_log(print_r($uploadedFiles, true)); // Log the uploaded files for debugging
        error_log(print_r($data, true)); // Log the request data for debugging
        // $userId = $data['user_id'] ?? null;
        $userId = AuthHelper::getCurrentUser()['user_id'] ?? null;

        if (empty($userId)) {
            $response->sendError('User ID is required.', 400);
            return;
        }

        // Retrieve models using baseController method
        $userModel = $this->model('Users\User');
        $businessmanModel = $this->model('Users\Businessman');
        $influencerModel = $this->model('Users\InfluencerSocialAccount');
        $designerModel = $this->model('Users\DesignerProject');

        // Fetch basic user data to determine the role
        $user = $userModel->getUserById($userId);

        if (!$user) {
            $response->sendError('User not found.', 404);
            return;
        }

        // Check if the user is the same as the logged-in user
        $role = $user['role'];
        error_log("this flag for role:");
        error_log($role);

        // Handle cover photo upload
        $coverPhotoPath = $user['cover_picture'];
        if (!empty($uploadedFiles['cover-photo']) && $uploadedFiles['cover-photo']['error'] === UPLOAD_ERR_OK) {
            $coverPhotoPath = FileHandler::imageUploader($uploadedFiles['cover-photo'], 'cdn_uploads/users/cover_photo/');
        }
        if($coverPhotoPath !== $user['cover_picture'] && $user['cover_picture'] != null){
            FileHandler::deleteFile($user['cover_picture']);
        }
        
        // Handle profile photo upload
        $profilePhotoPath = $user['profile_picture'];
        if (!empty($uploadedFiles['profile-photo']) && $uploadedFiles['profile-photo']['error'] === UPLOAD_ERR_OK) {
            $profilePhotoPath = FileHandler::imageUploader($uploadedFiles['profile-photo'], 'cdn_uploads/users/dp/');
        }
        if($profilePhotoPath !== $user['profile_picture'] && $user['profile_picture'] != null){
            FileHandler::deleteFile($user['profile_picture']);
        }


        // Update basic user details
        $updatedUser = [
            'name' => $data['full_name'] ?? $user['name'],
            'email' => $data['email'] ?? $user['email'],
            'phone' => $data['phone'] ?? $user['phone'],
            'bio' => $data['bio'] ?? $user['bio'],
            'professional_title' => $data['professional_title'] ?? $user['professional_title'],
            'specialties' => $data['specialties'] ?? $user['specialties'],
            'tools' => $data['tools'] ?? $user['tools'],
            'location' => $data['location'] ?? $user['location'],
            'profile_picture' => $profilePhotoPath,
            'cover_picture' => $coverPhotoPath
        ];

        if (!$userModel->updateUserById($userId, $updatedUser)) {
            $response->sendError('Failed to update user details.', 500);
            return;
        }

        // Role-specific updates
        switch ($role) {
            case 'businessman':
                $existingBusinessman = $businessmanModel->getBusinessRegistrationByUserId($userId);

                if (!empty($data['delete_businessman']) && $data['delete_businessman'] === true) {
                    if ($existingBusinessman && !$businessmanModel->deleteBusinessRegistrationByUserId($userId)) {
                        $response->sendError('Failed to delete businessman details.', 500);
                        return;
                    }
                } else {
                    // Upload business registration document
                    $brDocumentPath = $existingBusinessman['br_document'] ?? null;
                    if (!empty($uploadedFiles['br_document']) && $uploadedFiles['br_document']['error'] === UPLOAD_ERR_OK) {
                        $brDocumentPath = FileHandler::fileUploader($uploadedFiles['br_document'], 'cdn_uploads/users/business_registration/');
                    }
                    $businessmanData = [
                        'business_name' => $data['business_name'] ?? $existingBusinessman['business_name'],
                        'br_document' => $brDocumentPath,
                    ];

                    if ($existingBusinessman) {
                        if (!$businessmanModel->updateBusinessRegistrationByUserId($userId, $businessmanData)) {
                            $response->sendError('Failed to update businessman details.', 500);
                            return;
                        }
                    } else {
                        $businessmanData['user_id'] = $userId;
                        if (!$businessmanModel->createBusinessRegistration($businessmanData)) {
                            $response->sendError('Failed to create businessman details.', 500);
                            return;
                        }
                    }
                }
                break;

            case 'influencer':
                $data['influencer_accounts'] = json_decode($data['influencer_accounts'], true);
                $influencerAccounts = $data['influencer_accounts'] ?? [];
                error_log(print_r($influencerAccounts, true)); // Log the influencer accounts for debugging
                foreach ($influencerAccounts as $account) {
                    if (!empty($account['delete']) && $account['delete'] === true) {
                        if (isset($account['account_id']) && !$influencerModel->deleteSocialAccountById($account['account_id'])) {
                            $response->sendError('Failed to delete influencer account.', 500);
                            return;
                        }
                        continue;
                    }

                    $accountData = [
                        'user_id' => $userId,
                        'platform' => $account['platform'] ?? null,
                        'username' => $account['username'] ?? null,
                        'link' => $account['url'] ?? null
                    ];

                    if (isset($account['account_id'])) {
                        if (!$influencerModel->updateSocialAccountById($account['account_id'], $accountData)) {
                            $response->sendError('Failed to update influencer account.', 500);
                            return;
                        }
                    } else {
                        if (!$influencerModel->createSocialAccount($accountData)) {
                            $response->sendError('Failed to create influencer account.', 500);
                            return;
                        }
                    }
                }
                break;

            case 'designer':
                $existingDesignerProjects = $designerModel->getProjectsByUserId($userId);
                error_log(print_r($existingDesignerProjects, 1));
                $data['designer_projects'] = json_decode($data['designer_projects'], true);
                $designerProjects = $data['designer_projects'] ?? [];
                error_log("Designer projects are here");
                error_log(print_r($designerProjects, true)); // Log the designer projects for debugging
                $pointer = 1;
                foreach ($designerProjects as $project) {
                    if (!empty($project['delete']) && $project['delete'] === true) {
                        if (isset($project['project_id']) && !$designerModel->deleteProjectById($project['project_id'])) {
                            $response->sendError('Failed to delete designer project.', 500);
                            return;
                        }
                        continue;
                    }

                    // Handle media uploads
                    // $mediaPaths = json_decode($existingService['media'], true) ?? [];
                    $mediaPaths = [];
                    for ($i = 1; $i < 4; $i++) {
                        $key = "portfolio_projects-{$pointer}-image-{$i}";
                        if (isset($uploadedFiles[$key]) && $uploadedFiles[$key]['error'] === UPLOAD_ERR_OK) {
                            $file = $uploadedFiles[$key];
                            $mediaPath[$i] = FileHandler::fileUploader($file, 'cdn_uploads/users/portfolio_projects/');
                            
                        }
                    }

                    $projectData = [
                        'user_id' => $userId,
                        'title' => $project['title'] ?? null,
                        'description' => $project['description'] ?? null,
                        'image_1' => $mediaPath[1] ?? null,
                        'image_2' => $mediaPath[2] ?? null,
                        'image_3' => $mediaPath[3] ?? null
                        // 'image_1' => $project['image_1'] ?? null,
                        // 'image_2' => $project['image_2'] ?? null,
                        // 'image_3' => $project['image_3'] ?? null
                    ];

                    $pointer++;

                    if (isset($project['project_id'])) {
                        if (!$designerModel->updateProjectById($project['project_id'], $projectData)) {
                            $response->sendError('Failed to update designer project.', 500);
                            return;
                        }
                    } else {
                        if (!$designerModel->createProject($projectData)) {
                            $response->sendError('Failed to create designer project.', 500);
                            return;
                        }
                    }
                }
                break;

            default:
                $response->sendError('Invalid user role.', 400);
                return;
        }

        // Respond with success message
        $response->sendJson(['message' => 'User profile updated successfully.']);
    }

    /**
     * Delete user profile and all associated details.
     *
     * @param object $request  Request object containing input data.
     * @param object $response Response object to send back HTTP responses.
     */
    public function deleteUserProfile($request, $response): void {
        if (!AuthHelper::isLoggedIn()) {
            $response->sendError('Unauthorized', 401);
            return;
        }

        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // $data = $request->getParsedBody();
        // $userId = $data['user_id'] ?? null;
        $userId = $request->getParam('id') ?? null;

        if (empty($userId)) {
            $response->sendError('User ID is required.', 400);
            return;
        }

        // Retrieve models using baseController method
        $userModel = $this->model('Users\User');
        $businessmanModel = $this->model('Users\Businessman');
        $influencerModel = $this->model('Users\InfluencerSocialAccount');
        $designerModel = $this->model('Users\DesignerProject');

        // Check if user exists
        $user = $userModel->getUserById($userId);
        if (!$user) {
            $response->sendError('User not found.', 404);
            return;
        }

        // Delete the user record (if it deletes a user DB will cascadely delete associated details)
        if (!$userModel->deleteUserById($userId)) {
            $response->sendError('Failed to delete user.', 500);
            return;
        }

        // Respond with success message
        $response->sendJson(['message' => 'User profile deleted successfully.']);
    }

}
