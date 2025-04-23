<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\SessionHelper;
use app\models\Users\UserSession;

class AuthController extends BaseController {
    

    /**
     * Handle user login.
     *
     * @param object $request  Request object containing user input.
     * @param object $response Response object to send back HTTP responses.
     */
    public function login($request, $response): void {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $data = $request->getParsedBody();
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        // Validate input
        if (empty($email) || empty($password)) {
            $response->sendError('Email and password are required.', 400);
            return;
        }

        // Retrieve the User model using baseController method
        $adminModel = $this->model('Users\Admin');
        $userModel = $this->model('Users\User');

        // Fetch admin or user by email
        $user = $adminModel->getAdminByEmail($email);
        if($user) {
            $user['role'] = 'admin';
            $user['user_id'] = $user['admin_id'];
        } else {
            $user = $userModel->getUserByEmail($email);
        }

        if (!$user || !password_verify($password, $user['password'])) {
            $response->sendError('Invalid email or password.', 401);
            return;
        }

        // Set session data for the authenticated user
        if ($user['role'] === 'admin') {
            $loggedUser['user_id'] = $user['admin_id'];
        } else {
            $loggedUser['user_id'] = $user['user_id'];
            $loggedUser['profile_picture'] = $user['profile_picture'];
            $loggedUser['verification_status'] = $user['verification_status'];
        }
        $loggedUser['username'] = $user['name'];
        $loggedUser['email'] = $user['email'];
        $loggedUser['role'] = $user['role'];
        // $loggedUser = [
        //     // 'user_id' => $user['user_id'],
        //     'username' => $user['name'],
        //     'email' => $user['email'],
        //     'role' => $user['role'],
        // ];
        error_log(print_r($loggedUser, true));
        AuthHelper::logIn($loggedUser);

        $token = AuthHelper::generateSessionToken();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $expiresAt = date('Y-m-d H:i:s', strtotime('+30 days'));

        // Create a new session for the user
        $sessionModel = new UserSession();

        // Save to DB
        $sessionModel->createSession([
            'user_id' => $loggedUser['user_id'], 
            'session_token' => $token, 
            'user_agent' => $userAgent, 
            'ip_address' => $ipAddress, 
            'expires_at' => $expiresAt
        ]);

        // Store in client (e.g. cookie)
        setcookie('session_token', $token, time() + 60 * 60 * 24 * 30, '/', '', true, false); // HttpOnly

        // Redirect to appropriate dashboard based on user role
        $dashboardRoutes = [
            'admin' => '/admin/dashboard',
            'businessman' => '/services',
            'influencer' => '/influencer/dashboard',
            'designer' => '/designer/dashboard',
        ];

        $redirectUrl = $dashboardRoutes[$user['role']] ?? '/dashboard';
        $response->redirect($redirectUrl);
    }

    /**
     * Handle user logout.
     *
     * @param object $response Response object to send back HTTP responses.
     */
    public function logout($request, $response): void {
        AuthHelper::logOut();
        $response->redirect('/login');
    }

    public function changePassword($request, $response): void {

        error_log('Change password method called.');
        // Check if the request method is POST
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $data = $request->getParsedBody();
        $currentPassword = $data['current_password'] ?? '';
        $newPassword = $data['new_password'] ?? '';

        error_log(print_r($data, true));

        // Validate input
        if (empty($currentPassword) || empty($newPassword)) {
            $response->sendError('Current password and new password are required.', 400);
            return;
        }

        // Retrieve the User model using baseController method
        $userModel = $this->model('Users\User');
        $userId = AuthHelper::getCurrentUser()['user_id'];
        $user = $userModel->getUserById($userId);

        if (!$user || !password_verify($currentPassword, $user['password'])) {
            $response->sendError('Invalid current password.', 401);
            return;
        }

        // Update the password in the database
        if ($userModel->updateUserById($userId, ["password" => password_hash($newPassword, PASSWORD_DEFAULT)] )) {
            // Send a success response
            $response->setStatusCode(200);
            $response->sendJson(['message' => 'Password changed successfully.']);
        } else {
            $response->sendError('Failed to change password.', 500);
        }
    }


    // public function forgotPassword($request, $response): void {
    //     if ($request->getMethod() !== 'POST') {
    //         $response->setStatusCode(405);
    //         $response->sendError('Method Not Allowed');
    //         return;
    //     }

    //     $data = $request->getParsedBody();
    //     $email = trim($data['email'] ?? '');

    //     // Validate input
    //     if (empty($email)) {
    //         $response->sendError('Email is required.', 400);
    //         return;
    //     }

    //     // Retrieve the User model using baseController method
    //     $userModel = $this->model('Users\User');
    //     $user = $userModel->getUserByEmail($email);

    //     if (!$user) {
    //         $response->sendError('Email not found.', 404);
    //         return;
    //     }

    //     // Generate a password reset token and send email (not implemented here)
    //     // ...

    //     SessionHelper::setFlash('success', 'Password reset link sent to your email.');
    //     $response->redirect('/login');
    // }
}