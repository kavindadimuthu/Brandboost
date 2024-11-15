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

    public function singleUserPackage() {
        $this->view('pages/admin/singleUserPackage');
    }

    public function allCustomerComplaints() {
        $this->view('pages/admin/allCustomerComplaints');
    }
    public function singleCustomerComplaint() {
        $this->view('pages/admin/singleCustomerComplaint');
    }
    public function allRegistrationRequests() {
        $this->view('pages/admin/allRegistrationRequests');
    }
    public function singleRegistrationRequest() {
        $this->view('pages/admin/singleRegistrationRequest');
    }
}

