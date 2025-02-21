<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\SessionHelper;

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
            $loggedUser['admin_id'] = $user['user_id'];
        } else {
            $loggedUser['user_id'] = $user['user_id'];
            $loggedUser['profile_picture'] = $user['profile_picture'];
            $loggedUser['verification_status'] = $user['verification_status'];
        }
        $loggedUser = [
            // 'user_id' => $user['user_id'],
            'username' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];
        AuthHelper::logIn($loggedUser);

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
}