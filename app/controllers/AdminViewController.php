<?php
class AdminViewController extends Controller {

    public function __construct() {
        // session_start();
        // if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        //     header('location: /');
        // }
    }
    public function adminDashboard() {
        $this->view('pages/admin/adminDashboard');
    }
    public function allUsers() {
        $this->view('pages/admin/allUsers');
    }
    public function singleInfluencer() {
        $this->view('pages/admin/singleInfluencer');
    }
    public function singleDesigner() {
        $this->view('pages/admin/singleDesigner');
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


    // Faq functions----------------------------------------------
    public function viewAllFaqs() {

        $faqModel = $this->model('FaqModel');
        $faqs = $faqModel->getAllFaqs();

        $this->view('pages/admin/viewAllFaqs', ['faqs' => $faqs]);
    }

    

    

    
}
