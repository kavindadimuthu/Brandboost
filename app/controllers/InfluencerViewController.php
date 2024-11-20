<?php
class InfluencerViewController extends Controller {
    public function influencerDashboard() {
        $this->view('pages/influencer/InfluencerDashboard');
    }
    public function profile() {
        $this->view('pages/influencer/Profile');
    }
    public function influencerPackages() {
        $this->view('pages/influencer/InfluencerPackages');
    }
    public function singlepackage() {
        $this->view('pages/influencer/SinglePackage');
    }
    public function createPackage() {
        $this->view('pages/influencer/CreatePackage');
    }
    public function allOrders() {
        $this->view('pages/influencer/AllOrders');
    }
    public function singleOrder() {
        $this->view('pages/influencer/SingleOrder');
    }
    public function orderDelivery() {
        $this->view('pages/influencer/OrderDelivery');
    }
    public function earnings(){
        $this->view('pages/influencer/Earnings');
    }
    public function InfluencerReviews(){
        $this->view('pages/influencer/InfluencerReviews');
    }
    public function chat(){
        $this->view('pages/influencer/Chat');
    }

    public function influencerpreviewprofile(){
        $this->view('pages/influencer/InfluencerPreviewProfile');
    }
}