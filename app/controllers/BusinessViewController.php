<?php
class BusinessViewController extends Controller {

    public function __construct() {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 'businessman') {
            header('location: /');
        }
    }

    
    public function businessDashboard() {
        $this->view('pages/business/businessdashboard');
    }
    public function profile() {
        $this->view('pages/business/Profile');
    }
    public function myComplaints(){
        $this->view('pages/business/MyComplaints');
    }
    public function makeComplaint(){
        $this->view('pages/business/MakeComplaint');
    }
    public function myOrders() {
        $this->view('pages/business/MyOrders');
    }
    public function deliveries() {
        $this->view('pages/business/Deliveries');
    }
    public function BusinessSingleOrder() {
        $this->view('pages/business/BusinessSingleOrder');
    }
    public function RequestRivision() {
        $this->view('pages/business/RequestRivision');
    }
    public function BusinessDSingleOrder() {
        $this->view('pages/business/BusinessDSingleOrder');
    }
    public function makeRequest(){
        $this->view('pages/business/MakeRequest');
    }
    public function fillRequirement(){
        $this->view('pages/business/FillRequirement');
    }
    public function payment(){
        $this->view('pages/business/Payment');
    }
    public function viewInfluencers(){
        $this->view('pages/business/ViewUsers');
    }
    public function viewDesigners(){
        $this->view('pages/business/ViewUsers');
    }
    public function viewInfluencerPromotions(){
        $this->view('pages/business/ViewServices');
    }
    public function viewDesignerGigs(){
        $this->view('pages/business/ViewServices');
    }
    public function influencerPromotionInside(){
        $this->view('pages/business/InfluencerPromotionInside');
    }
    public function designerGigInside(){
        $this->view('pages/business/DesignerGigInside');
    }

    public function influencerProfile(){
        $this->view('pages/business/InfluencerProfile');
    }
    public function designerProfile(){
        $this->view('pages/business/DesignerProfile');
    }
    public function chat(){
        $this->view('pages/business/chat2');
    }

    public function register(){
        $this->view('pages/register/businessOwner');
    }
    public function serviceCard() {
        $this->view('components/common/serviceCard');
    }

    public function influencerFirst(){
        $this->view('pages/business/influencerFirst');
    }

    public function searchGigs(){
        $this->view('pages/business/SearchGigs');
    }

    public function orderRequirements(){
        $this->view('pages/business/OrderRequirements');
    }



    
}