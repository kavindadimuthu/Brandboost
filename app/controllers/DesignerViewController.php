<?php
class DesignerViewController extends Controller {
    public function designerDashboard() {
        $this->view('pages/designer/DesignerDashboard');
    }
    public function profile() {
        $this->view('pages/designer/Profile');
    }
    public function designerPackages() {
        $this->view('pages/designer/DesignerPackages');
    }
    public function singlepackage() {
        $this->view('pages/designer/SinglePackage');
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