<?php

namespace app\core\Helpers;

require_once __DIR__ . '/../../vendor/autoload.php';

use app\models\Users\UserSession;

class AuthHelper {
    public static function isLoggedIn() {
        return SessionHelper::has('user');
    }

    public static function getCurrentUser() {
        return SessionHelper::get('user');
    }

    public static function checkPermission($requiredRole) {
        $currentUser = self::getCurrentUser();
        if (!$currentUser || $currentUser['role'] !== $requiredRole) {
            header("Location: /404");
            exit;
        }
    }

    public static function logIn($user) {
        SessionHelper::set('user', $user);
    }

    public static function logOut() {
        SessionHelper::remove('user');
    }
    
    public static function generateSessionToken(): string {
        return bin2hex(random_bytes(32));
    }

    public static function authenticate($token)
    {
        $userSessionModel = new UserSession();
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $sql = "SELECT * FROM user_sessions WHERE session_token = :token AND expires_at >= :now LIMIT 1";
        $result = $userSessionModel->executeCustomQuery($sql, [
            'token' => $token,
            'now' => $now
        ], false); // false = fetch single row
        return $result ? $result['user_id'] : false;
    }

    /**
     * Get the active session token for a user
     * 
     * @param int $userId The user ID to look up
     * @return string|false The session token if found, false otherwise
     */
    public static function getCurrentSessionToken()
    {
        $userId = AuthHelper::getCurrentUser()['user_id'];
        if (!$userId) {
            return false; // User ID is not set, return false
        }
        $userSessionModel = new UserSession();
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $sql = "SELECT session_token FROM user_sessions WHERE user_id = :userId AND expires_at >= :now ORDER BY expires_at DESC LIMIT 1";
        $result = $userSessionModel->executeCustomQuery($sql, [
            'userId' => $userId,
            'now' => $now
        ], false);
        
        return $result ? $result['session_token'] : false;
    }
}
