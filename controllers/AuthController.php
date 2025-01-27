<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\SessionHelper;

class AuthController extends BaseController {
    /**
     * Handle user registration.
     *
     * @param object $request  Request object containing user input.
     * @param object $response Response object to send back HTTP responses.
     */
    public function register($request, $response): void {
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
            'bio' => null
        ];

        if (!$userModel->createUser($user)) {
            $response->sendError('Error registering user.', 500);
            return;
        }

        $response->redirect('/login');
    }

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
            'role' => $user['role']
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