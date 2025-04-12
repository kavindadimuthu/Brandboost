<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use \app\core\Helpers\AuthHelper;

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
            'role'            => $user['role'],
            'profile_picture' => $user['profile_picture'],
            'cover_picture'   => $user['cover_picture'],
            'bio'             => $user['bio']
        ];

        // Fetch additional data based on user role
        switch ($user['role']) {
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

        $reqData = $request->getParsedBody();
        error_log(print_r($reqData, true)); // Log the request data for debugging
        // error_log('Request Data: ' , $reqData); // Log the request data for debugging

        exit;

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
        $userId = $data['user_id'] ?? null;

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

        $role = $user['role'];

        // Update basic user details
        $updatedUser = [
            'name' => $data['name'] ?? $user['name'],
            'email' => $data['email'] ?? $user['email'],
            'profile_picture' => $data['profile_picture'] ?? $user['profile_picture'],
            'cover_picture' => $data['cover_picture'] ?? $user['cover_picture'],
            'bio' => $data['bio'] ?? $user['bio']
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
                    $businessmanData = [
                        'business_name' => $data['business_name'] ?? $existingBusinessman['business_name'],
                        'br_document' => $data['br_document'] ?? $existingBusinessman['br_document'],
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
                $influencerAccounts = $data['influencer_accounts'] ?? [];
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
                        'link' => $account['link'] ?? null
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
                $designerProjects = $data['designer_projects'] ?? [];
                foreach ($designerProjects as $project) {
                    if (!empty($project['delete']) && $project['delete'] === true) {
                        if (isset($project['project_id']) && !$designerModel->deleteProjectById($project['project_id'])) {
                            $response->sendError('Failed to delete designer project.', 500);
                            return;
                        }
                        continue;
                    }

                    $projectData = [
                        'user_id' => $userId,
                        'title' => $project['title'] ?? null,
                        'description' => $project['description'] ?? null,
                        'image_1' => $project['image_1'] ?? null,
                        'image_2' => $project['image_2'] ?? null,
                        'image_3' => $project['image_3'] ?? null
                    ];

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
