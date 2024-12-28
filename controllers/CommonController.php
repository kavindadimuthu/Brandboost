<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class CommonController extends BaseController
{
    public function chat($req, $res){
        $this->renderLayout('main', 'pages/common/chat');
//        $this->renderPage( 'pages/common/chat');
    }

}
