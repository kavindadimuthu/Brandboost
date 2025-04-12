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

        $userId = $request->getParam('id');

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
        // Get registration data
        $data = $request->getParsedBody();
        $firstName = trim($data['firstName'] ?? '');
        $lastName = trim($data['lastName'] ?? '');
        $email = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $password = $data['password'] ?? '';
        $confirmPassword = $data['confirmPassword'] ?? '';
        $role = $data['role'] ?? 'user';
        $name = "$firstName $lastName";
    
        // Validate input
        $errors = [];
        if (empty($firstName)) $errors[] = 'First name is required';
        if (empty($lastName)) $errors[] = 'Last name is required';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Invalid email format';
        if (strlen($password) < 8) $errors[] = 'Password must be at least 8 characters';
        if ($password !== $confirmPassword) $errors[] = 'Passwords do not match';
    
        if (!empty($errors)) {
            $response->sendError(implode(', ', $errors), 400);
            return;
        }
    
        // Check existing users
        $userModel = $this->model('Users\User');
        $pendingModel = $this->model('Users\PendingRegistration');
    
        if ($userModel->findUserByEmail($email)) {
            $response->sendError('Email is already registered', 400);
            return;
        }
    
        if ($pendingModel->findByEmail($email)) {
            $response->sendError('Verification already pending for this email', 400);
            return;
        }
    
        // Generate secure verification token
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', time() + 3600); // 1 hour expiration
    
        try {
            // Store in pending registrations
            $pendingModel->create([
                'email' => $email,
                'token' => $token,
                'name' => $name,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'role' => $role,
                'expires_at' => $expiresAt
            ]);
        } catch (PDOException $e) {
            error_log('Database error: ' . $e->getMessage());
            $response->sendError('Error initiating registration', 500);
            return;
        }
    
        // Send verification email
        try {
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = getenv('SMTP_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = getenv('SMTP_USER');
            $mail->Password = getenv('SMTP_PASSWORD');
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
    
            $verificationLink = getenv('APP_URL') . "/verify-email?token=$token";
            
            $mail->setFrom(getenv('SMTP_USER'), 'Your App Name');
            $mail->addAddress($email, $name);
            $mail->isHTML(true);
            $mail->Subject = 'Verify Your Email Address';
            $mail->Body = "
                <h2>Almost done, $firstName!</h2>
                <p>Click below to verify your email:</p>
                <a href='$verificationLink'>Verify Email</a>
                <p>Link expires in 1 hour</p>
            ";
    
            $mail->send();
        } catch (Exception $e) {
            $pendingModel->deleteByEmail($email);
            error_log('Mail Error: ' . $e->getMessage());
            $response->sendError('Failed to send verification email', 500);
            return;
        }
    
        $response->sendJson(['message' => 'Verification email sent. Check your inbox.']);
    }

    
    public function verifyEmail($request, $response): void {
        $token = $request->getQueryParam('token', '');
        
        if (empty($token)) {
            $response->sendError('Missing verification token', 400);
            return;
        }
    
        $pendingModel = $this->model('Users\PendingRegistration');
        $userModel = $this->model('Users\User');
    
        try {
            // Find pending registration
            $pendingUser = $pendingModel->findByToken($token);
            
            if (!$pendingUser) {
                $response->sendError('Invalid verification link', 400);
                return;
            }
    
            // Check expiration
            if (strtotime($pendingUser['expires_at']) < time()) {
                $pendingModel->delete($pendingUser['id']);
                $response->sendError('Verification link has expired', 400);
                return;
            }
    
            // Final check if email was registered since initiating
            if ($userModel->findUserByEmail($pendingUser['email'])) {
                $pendingModel->delete($pendingUser['id']);
                $response->sendError('Email already registered', 400);
                return;
            }
    
            // Create actual user
            $userData = [
                'name' => $pendingUser['name'],
                'email' => $pendingUser['email'],
                'password' => $pendingUser['password'],
                'role' => $pendingUser['role'],
                'account_status' => 'active',
                'email_verified_at' => date('Y-m-d H:i:s') // Add verification timestamp
            ];
    
            if (!$userModel->createUser($userData)) {
                throw new Exception('Failed to create user');
            }
    
            // Cleanup pending registration
            $pendingModel->delete($pendingUser['id']);
    
            // Redirect to success page
            $response->redirect('/registration-success');
    
        } catch (Exception $e) {
            error_log('Verification Error: ' . $e->getMessage());
            $response->sendError('Error processing verification', 500);
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
