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
        $userModel = $this->model('Users\User');

        // Fetch user by email
        $user = $userModel->getUserByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $response->sendError('Invalid email or password.', 401);
            return;
        }

        // Set session data for the authenticated user
        $loggedUser = [
            'user_id' => $user['user_id'],
            'username' => $user['name'],
            'email' => $user['email'],
            'profile_picture' => $user['profile_picture'],
            'role' => $user['role'],
            'verification_status' => $user['verification_status']
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