<?php

class AdminDataController extends Controller
{
    public function __construct() {
        if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
            header('location: /');
        }
    }

    public function addFaq()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'question' => $_POST['question'],
                'answer' => $_POST['answer']
            ];

            $faqModel = $this->model('FaqModel');
            $result = $faqModel->addFaq($data);
            if ($result) {
                header('location: /AdminViewController/viewAllFaqs');
            } else {
                echo 'Error adding faq';
            }
        }
    }

    public function updateFaq($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);
            $faqModel = $this->model('FaqModel');
            $result = $faqModel->updateFaq([
                'id' => $id,
                'question' => $data['question'],
                'answer' => $data['answer']
            ]);
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error updating FAQ']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function deleteFaq($id)
    {
        $faqModel = $this->model('FaqModel');
        $result = $faqModel->deleteFaq($id);
        header('Content-Type: application/json');
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'FAQ deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error deleting FAQ']);
        }
    }
}