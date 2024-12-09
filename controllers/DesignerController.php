<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;

class DesignerController extends BaseController
{
    public function myGigs($req, $res){
        $this->renderLayout('main', 'pages/designer/my_gigs');
    }

    public function addGig($req, $res){
        $this->renderLayout('main', 'pages/designer/add_gig');
    }

    public function editGig($req, $res){
        $this->renderLayout('main', 'pages/designer/edit_gig');
    }
}
