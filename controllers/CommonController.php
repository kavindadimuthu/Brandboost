<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use \app\core\Helpers\AuthHelper;

class CommonController extends BaseController
{
    public function chat($req, $res){
        // Check if the user is logged in
        if (!AuthHelper::isLoggedIn()) {
            header('Location: /login');
            exit;
        }       
       $this->renderPage( 'pages/common/chat');
    }

    public function notifications($req, $res) {
        // Check if the user is logged in
        if (!AuthHelper::isLoggedIn()) {
            header('Location: /login');
            exit;
        }
        $this->renderLayout('main', 'pages/common/notifications');
    }

}
