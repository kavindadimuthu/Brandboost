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
        error_log("query params are:". print_r($queryParams, true));
        // Pagination & sorting parameters
        $limit = $queryParams['limit'] ?? 10;
        $offset = $queryParams['offset'] ?? 0;
        $sortBy = $queryParams['sort_by'] ?? 'name';
        $orderDir = $queryParams['order_dir'] ?? 'asc';
        // Search & filter parameters
        $searchTerm = $queryParams['search'] ?? null;
    
        // Validate limit and offset
        if (!is_numeric($limit) || !is_numeric($offset)) {
            $response->sendError('Invalid pagination parameters.', 400);
            return;
        }

        // Build filter options for the model
        $allowedFilters = ['user_id', 'name', 'email', 'phone', 'bio', 'role', 'professional_title', 'specialties', 'tools', 'location', 'account_status', 'verification_status'];

        // Add filters to the query
        $filters = [];
        foreach ($allowedFilters as $filter) {
            if (isset($queryParams[$filter]) && $queryParams[$filter] !== '') {
                $filters[$filter] = $queryParams[$filter];
            }
        }
    
        // Retrieve the User model
        $userModel = $this->model('Users\User');
    
        // Build options for querying the user list
        $options = [
            'limit' => (int)$limit,
            'offset' => (int)$offset,
            'order' => $sortBy . ' ' . (strtolower($orderDir) === 'desc' ? 'desc' : 'asc'),
        ];
    
        if ($searchTerm) {
            $options['search'] = $searchTerm;
            $options['searchColumns'] = ['name', 'email'];
        }

        if (!empty($filters)) {
            $options['filters'] = $filters;
        }
    
        $totalUsers = $userModel->count([], $options); // Count total users based on filters
        $users = $userModel->read($filters, $options); // Fetch paginated user list based on filters and options 
    
        if ($users === false) {
            $response->sendError('Failed to fetch user list.', 500);
            return;
        }
        if (empty($users)) {
            $response->sendJson(['success' => true, 'users' => [], 'pagination' => []]);
            return;
        }
    
        // Calculate pagination metadata
        $totalPages = ceil($totalUsers / (int)$limit);
        $currentPage = floor((int)$offset / (int)$limit) + 1;
    
        // Send the response with user list and pagination metadata
        $response->sendJson([
            'success' => true,
            'users' => $users,
            'pagination' => [
                'total_users' => $totalUsers,
                'total_pages' => $totalPages,
                'current_page' => $currentPage,
                'limit' => (int)$limit,
                'offset' => (int)$offset
            ]
        ]);
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

        $userProfile = $user;

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
     * Update user profile details, including creating, updating, or deleting user-specific details.
     *
     * @param object $request  Request object containing input data.
     * @param object $response Response object to send back HTTP responses.
     */
    public function updateUserProfile($request, $response): void {
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
    
        $role = $user['role'];
    
        // Handle cover photo upload
        $coverPhotoPath = $user['cover_picture'];
        if (!empty($uploadedFiles['cover-photo']) && $uploadedFiles['cover-photo']['error'] === UPLOAD_ERR_OK) {
            $coverPhotoPath = FileHandler::imageUploader($uploadedFiles['cover-photo'], 'cdn_uploads/users/cover_photo/');
            if($coverPhotoPath !== $user['cover_picture'] && $user['cover_picture'] != null){
                FileHandler::deleteFile($user['cover_picture']);
            }
        }
        
        // Handle profile photo upload
        $profilePhotoPath = $user['profile_picture'];
        if (!empty($uploadedFiles['profile-photo']) && $uploadedFiles['profile-photo']['error'] === UPLOAD_ERR_OK) {
            $profilePhotoPath = FileHandler::imageUploader($uploadedFiles['profile-photo'], 'cdn_uploads/users/dp/');
            if($profilePhotoPath !== $user['profile_picture'] && $user['profile_picture'] != null){
                FileHandler::deleteFile($user['profile_picture']);
            }
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
                        
                        // Delete old document if it exists and a new one was uploaded
                        if(!empty($existingBusinessman['br_document']) && $brDocumentPath !== $existingBusinessman['br_document']) {
                            FileHandler::deleteFile($existingBusinessman['br_document']);
                        }
                    }
                    
                    $businessmanData = [
                        'business_name' => $data['business_name'] ?? ($existingBusinessman['business_name'] ?? null),
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
                if (isset($data['influencer_accounts'])) {
                    // Make sure we're working with an array
                    if (is_string($data['influencer_accounts'])) {
                        $data['influencer_accounts'] = json_decode($data['influencer_accounts'], true);
                    }
                    
                    $influencerAccounts = $data['influencer_accounts'] ?? [];
                    
                    error_log(" display influencer accounts");
                    error_log(print_r($influencerAccounts, 1));
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
                }
                break;
    
            case 'designer':
                if (isset($data['designer_projects'])) {
                    // Make sure we're working with an array
                    if (is_string($data['designer_projects'])) {
                        $data['designer_projects'] = json_decode($data['designer_projects'], true);
                    }
                    
                    $designerProjects = $data['designer_projects'] ?? [];
                    $existingDesignerProjects = $designerModel->getProjectsByUserId($userId);
                    
                    // Create a lookup for existing projects
                    $existingProjectsLookup = [];
                    if ($existingDesignerProjects) {
                        foreach ($existingDesignerProjects as $project) {
                            $existingProjectsLookup[$project['project_id']] = $project;
                        }
                    }
                    
                    foreach ($designerProjects as $index => $project) {
                        // Handle project deletion
                        if (!empty($project['delete']) && $project['delete'] === true) {
                            if (isset($project['project_id'])) {
                                // Delete project images if they exist
                                $existingProject = $existingProjectsLookup[$project['project_id']] ?? null;
                                if ($existingProject) {
                                    for ($i = 1; $i <= 3; $i++) {
                                        $imageKey = "image_{$i}";
                                        if (!empty($existingProject[$imageKey])) {
                                            FileHandler::deleteFile($existingProject[$imageKey]);
                                        }
                                    }
                                }
                                
                                if (!$designerModel->deleteProjectById($project['project_id'])) {
                                    $response->sendError('Failed to delete designer project.', 500);
                                    return;
                                }
                            }
                            continue;
                        }
                        
                        // Prepare project data
                        $projectData = [
                            'user_id' => $userId,
                            'title' => $project['title'] ?? null,
                            'description' => $project['description'] ?? null
                        ];
                        
                        // Get existing project data if available
                        $existingProject = null;
                        if (isset($project['project_id'])) {
                            $existingProject = $existingProjectsLookup[$project['project_id']] ?? null;
                        }
                        
                        // Handle images for this project (up to 3)
                        for ($i = 1; $i <= 3; $i++) {
                            $fileKey = "portfolio_projects-" . ($index + 1) . "-image-{$i}";
                            $pathKey = "image_{$i}";
                            
                            // Initialize with existing path if available
                            $projectData[$pathKey] = $existingProject[$pathKey] ?? null;
                            
                            // If we have a new file uploaded for this image slot
                            if (isset($uploadedFiles[$fileKey]) && $uploadedFiles[$fileKey]['error'] === UPLOAD_ERR_OK) {
                                // Save the new image
                                $newImagePath = FileHandler::fileUploader(
                                    $uploadedFiles[$fileKey], 
                                    'cdn_uploads/users/portfolio_projects/'
                                );
                                
                                // Delete old image if it exists
                                if ($existingProject && !empty($existingProject[$pathKey])) {
                                    FileHandler::deleteFile($existingProject[$pathKey]);
                                }
                                
                                // Update project data with new image path
                                $projectData[$pathKey] = $newImagePath;
                            } 
                            // If there's a path in the submitted data, use it (for existing images)
                            else if (isset($project[$pathKey]) && !empty($project[$pathKey])) {
                                $projectData[$pathKey] = $project[$pathKey];
                            }
                            // If image was explicitly cleared
                            else if (isset($project['clear_' . $pathKey]) && $project['clear_' . $pathKey] === true) {
                                if ($existingProject && !empty($existingProject[$pathKey])) {
                                    FileHandler::deleteFile($existingProject[$pathKey]);
                                }
                                $projectData[$pathKey] = null;
                            }
                        }
                        
                        // Update or create the project
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
     * Update user account status by admin.
     * 
     * @param object $request  Request object containing input data.
     * @param object $response Response object to send back HTTP responses.
     */
    public function updateUserAccountStatus($request, $response) {
        if (AuthHelper::getCurrentUser()['role'] != 'admin'){
            $response->sendError('Unauthorized', 401);
            return;
        }

        $userId = $request->getParam('id') ?? null;
        $status = $request->getParam('status');

        if (empty($userId)) {
            $response->sendError('User ID is required.', 400);
            return;
        }

        if (!in_array($status, ['active', 'inactive', 'blocked', 'banned'], true)) {
            $response->sendError('Status is not valid', 400);
            return;
        }

        $userModel = $this->model('Users\User');

        if (!$userModel->update(['user_id'=> $userId], ['account_status'=> $status])){
            $response->sendError('Failed to change user account status.', 500);
            return;
        }

        $actionModel = $this->model('Actions\Action');
        $actionData = [
            'admin_id' => AuthHelper::getCurrentUser()['user_id'],
            'user_id' => $userId,
            'action_type' => 'user_' . $status,
            // 'action_details' => json_encode([
            //     'user_id' => $userId,
            //     'status' => $status
            // ]),
            'action_note' => 'User account status changed to ' . $status,
            'created_at' => date('Y-m-d H:i:s')
        ];

        if (!$actionModel->createAction($actionData)) {
            $response->sendError('Failed to log action.', 500);
            return;
        }

        $response->sendJson(
            [
                'success' => true,
                'message' => 'User account changed successfully.']
        );


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
