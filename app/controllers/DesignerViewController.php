<?php
class DesignerViewController extends Controller {

    public function __construct() {
        // session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'designer') {
            header('Location: /login');
        }
    }

    public function designerDashboard() {
        $this->view('pages/designer/DesignerDashboard');
    }
    public function profile() {
        $this->view('pages/designer/Profile');
    }
    public function designerGigs() {
        echo "Designer Gigs Controller";

        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page if not logged in
            header('Location: /login');
            exit();
        }
    
        $userId = $_SESSION['user_id'];
        $gigModel = $this->model('GigModel');
        $gigs = $gigModel->getGigsByUserId($userId);

        // $this->view('pages/designer/DesignerGigs');
        $this->view('pages/designer/DesignerGigs', ['gigs' => $gigs ?: []]);
    }
    public function singleGig() {
        $this->view('pages/designer/SingleGig');
    }
    public function createGig() {
        $this->view('pages/designer/CreateGig');
    }
    public function allOrders() {
        $this->view('pages/designer/AllOrders');
    }
    public function singleOrder() {
        $this->view('pages/designer/SingleOrder');
    }
    public function orderDelivery() {
        $this->view('pages/designer/OrderDelivery');
    }
    public function earnings(){
        $this->view('pages/designer/Earnings');
    }
    public function designerReviews(){
        $this->view('pages/designer/DesignerReviews');
    }
    public function chat(){
        $this->view('pages/designer/Chat');
    }

    public function register(){
        $this->view('pages/register/designer');
    }

    public function designerpreviewprofile(){
        $this->view('pages/designer/DesignerPreviewProfile');
    }
}