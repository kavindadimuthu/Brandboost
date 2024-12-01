<?php
class AdminViewController extends Controller {

    public function __construct() {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
            header('location: /');
        }
    }
    
    public function adminDashboard() {
        $this->view('pages/admin/adminDashboard');
    }
    public function allUsers() {
        $this->view('pages/admin/allUsers');
    }

    public function singleUserView() {
        $this->view('pages/admin/singleUserView');
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

    public function allComplaints() {
        $this->view('pages/admin/allComplaints');
    }
    public function singleComplaint() {
        $this->view('pages/admin/singlecomplaint');
    }
    public function allVerifications() {
        $this->view('pages/admin/allVerifications');
    }
    public function singleVerification() {
        $this->view('pages/admin/singleVerification');
    }


    // Faq functions----------------------------------------------
    public function viewAllFaqs() {

        $faqModel = $this->model('FaqModel');
        $faqs = $faqModel->getAllFaqs();

        $this->view('pages/admin/viewAllFaqs', ['faqs' => $faqs]);
    }

    

    

    
}
