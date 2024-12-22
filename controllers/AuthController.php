<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;

class AuthController extends BaseController{
    public function login($req, $res){
        $username = $req->getParam('username');
        $role = $req->getParam('role');

        $user['username'] = $username;
        $user['role'] = $role;

        // temporary login logic
        AuthHelper::logIn($user);

        if ($role === 'admin') {
            header("Location: /admin/dashboard"); exit;}
        elseif ($role === 'businessman') {
            header("Location: /services"); exit;}
        elseif ($role === 'influencer') {
            header("Location: /influencer/dashboard"); exit;}
        elseif ($role === 'designer') {
            header("Location: /designer/dashboard"); exit;}
        else {
            echo "Invalid role.";}
        // end of temporary login logic
    }

    public function logout($req, $res){
        echo 'Logging out...';
        print_r($_SESSION);
        AuthHelper::logOut();
        echo 'Logged out.';
        print_r($_SESSION);
        header("Location: /login"); exit;
    }
}