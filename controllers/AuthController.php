<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\SessionHelper;
use Twilio\Rest\Client;

class AuthController extends BaseController {
    
    /**
     * Handle user login.
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

        if (empty($email) || empty($password)) {
            $response->sendError('Email and password are required.', 400);
            return;
        }

        $userModel = $this->model('Users\User');
        $user = $userModel->getUserByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $response->sendError('Invalid email or password.', 401);
            return;
        }

        $loggedUser = [
            'user_id' => $user['user_id'],
            'username' => $user['name'],
            'email' => $user['email'],
            'profile_picture' => $user['profile_picture'],
            'role' => $user['role'],
            'verification_status' => $user['verification_status']
        ];
        AuthHelper::logIn($loggedUser);

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
     */
    public function logout($request, $response): void {
        AuthHelper::logOut();
        $response->redirect('/login');
    }
}