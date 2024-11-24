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

    public function addFaq() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'question' => $_POST['question'],
                'answer' => $_POST['answer']
            ];

            $faqModel = $this->model('FaqModel');
            $result = $faqModel->addFaq($data);
            if($result) {
                header('location: /AdminViewController/viewAllFaqs');
            } else {
                echo 'Error adding faq';
            }
        }
    }

    public function updateFaq($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $faqModel = $this->model('FaqModel');
            $result = $faqModel->updateFaq([
                'id' => $id,
                'question' => $data['question'],
                'answer' => $data['answer']
            ]);
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error updating faq']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function deleteFaq($id) {
        $faqModel = $this->model('FaqModel');
        $result = $faqModel->deleteFaq($id);
        if($result) {
            header('location: /AdminViewController/viewAllFaqs');
        } else {
            echo 'Error deleting faq';
        }
    }
}
