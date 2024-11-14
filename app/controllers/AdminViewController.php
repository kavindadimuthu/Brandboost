<?php
class AdminViewController extends Controller {
    public function adminDashboard() {
        $this->view('pages/admin/adminDashboard');
    }
    public function allUsers() {
        $this->view('pages/admin/allUsers');
    }
    public function singleUser() {
        $this->view('pages/admin/singleUser');
    }
    public function customerComplaints() {
        $this->view('pages/admin/customerComplaints');
    }
    public function singleCustomerComplaint() {
        $this->view('pages/admin/singleCustomerComplaint');
    }
    public function registrationRequests() {
        $this->view('pages/admin/registrationRequests');
    }
    public function singleRegistrationRequest() {
        $this->view('pages/admin/singleRegistrationRequest');
    }
}

