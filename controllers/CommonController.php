<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use \app\core\Helpers\AuthHelper;

class CommonController extends BaseController
{
    public function chat($req, $res){
       $this->renderPage( 'pages/common/chat');
    }

}
