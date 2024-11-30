<?php
class DesignerViewController extends Controller {

    public function __construct() {
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
        $this->view('pages/designer/DesignerGigs');
    }
    public function singleGig() {
        $this->view('pages/designer/SingleGig');
    }
    public function createGig() {
        $this->view('pages/designer/CreateGig');
    }
    public function updateGig() {
        $this->view('pages/designer/gigUpdate');
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
    public function addPortfolio(){
        $this->view('pages/designer/AddPortfolio');
    }
    public function viewMyPortfolio(){
        $this->view('pages/designer/ViewMyPortfolio');
    }
    public function updatePortfolio(){
        $this->view('pages/designer/UpdatePortfolio');
    }
}