<?php
class BusinessViewController extends Controller {
    // public function businessHomepage() {
    //     $this->view('pages/business/businessHomepage');
    // }
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
        $this->view('pages/business/ViewInfluencers');
    }
    public function viewDesigners(){
        $this->view('pages/business/ViewDesigners');
    }
    public function viewInfluencerPackages(){
        $this->view('pages/business/ViewInfluencerPackages');
    }
    public function viewDesignerPackages(){
        $this->view('pages/business/ViewDesignerPackages');
    }
    public function influencerPackageInside(){
        $this->view('pages/business/InfluencerPackageInside');
    }
    public function designerPackageInside(){
        $this->view('pages/business/DesignerPackageInside');
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

    public function influencerFirst(){
        $this->view('pages/business/influencerFirst');
    }

    public function searchGigs(){
        $this->view('pages/business/SearchGigs');
    }
}