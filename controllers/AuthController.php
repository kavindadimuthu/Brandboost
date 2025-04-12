<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\core\Helpers\SessionHelper;
use Twilio\Rest\Client;

use app\models\Users\PendingRegistration;
use app\models\Users\User;

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


    public function verifyEmail($request, $response): void {
        $token = $request->getQueryParam('token', '');
    
        if (empty($token)) {
            $response->redirect('/error?code=invalid_token');
            return;
        }
    
        $pendingModel = $this->model('Users\PendingRegistration');
        $userModel = $this->model('Users\User');
    
        try {
            $this->db->beginTransaction();
    
            // Get pending registration
            $pendingUser = $pendingModel->findByToken($token);
            
            if (!$pendingUser) {
                throw new Exception('Invalid verification token');
            }
    
            // Check expiration
            if (strtotime($pendingUser['expires_at']) < time()) {
                $pendingModel->delete($pendingUser['id']);
                throw new Exception('Verification link expired');
            }
    
            // Final duplicate check
            if ($userModel->findUserByEmail($pendingUser['email'])) {
                $pendingModel->delete($pendingUser['id']);
                throw new Exception('Email already registered');
            }
    
            // Create user
            $userData = [
                'name' => $pendingUser['name'],
                'email' => $pendingUser['email'],
                'password' => $pendingUser['password'],
                'role' => $pendingUser['role'],
                'email_verified_at' => date('Y-m-d H:i:s'),
                'account_status' => 'active'
            ];
    
            if (!$userModel->createUser($userData)) {
                throw new Exception('Failed to create user');
            }
    
            // Cleanup pending registration
            $pendingModel->delete($pendingUser['id']);
    
            $this->db->commit();
    
            // Redirect to success page
            $response->redirect('/registration-success');
    
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log('Verification Error: ' . $e->getMessage());
            $response->redirect('/error?code=' . urlencode($e->getMessage()));
        }
    }

}