<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\models\Users\User;

class CommonController extends BaseController
{
    public function chat($req, $res){
       $this->renderPage( 'pages/common/chat');
    }

    public function test($req, $res){
        $userModel = new User();

        // $user = $userModel->find('15', 'user_id');
        $user = $userModel->findAll() ;

        // Send a JSON response
        return $res->sendJson($user);
    }

}
