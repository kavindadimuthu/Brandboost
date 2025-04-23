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

    // public static function authenticate($token) {
    //     $userSessionModel = new UserSession();
    //     $session = $userSessionModel->readOne([
    //         'session_token' => $token,
    //         'expires_at >=' => date('Y-m-d H:i:s')
    //     ]);
    //     return $session ? $session['user_id'] : false;
    // }

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

    public static function generateSessionToken(): string {
        return bin2hex(random_bytes(32));
    }
}
