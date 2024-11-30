<?php
class BusinessViewController extends Controller {
    // public function businessHomepage() {
    //     $this->view('pages/business/businessHomepage');
    // }
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
    public function mySingleOrder() {
        $this->view('pages/business/MySingleOrder');
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
    public function viewInfluencerPromotions(){
        $this->view('pages/business/ViewInfluencerPromotions');
    }
    public function viewDesignerGigs(){
        $this->view('pages/business/ViewDesignerGigs');
    }
    public function influencerPackageInside(){
        $this->view('pages/business/InfluencerPackageInside');
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
        $this->view('pages/business/Chat');
    }

    public function register(){
        $this->view('pages/register/businessOwner');
    }




    public function serviceCard() {
        $this->view('components/common/serviceCard');
    }
}