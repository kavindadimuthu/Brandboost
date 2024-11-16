<?php
class DesignerViewController extends Controller {
    public function designerDashboard() {
        $this->view('pages/designer/DesignerDashboard');
    }
    public function profile() {
        $this->view('pages/designer/Profile');
    }
    public function designerPackages() {
        $this->view('pages/designer/AllPackages');
    }
    public function singlePackage() {
        $this->view('pages/designer/SinglePackage');
    }
    public function createPackage() {
        $this->view('pages/designer/CreatePackage');
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
    public function chat(){
        $this->view('pages/designer/Chat');
    }
}