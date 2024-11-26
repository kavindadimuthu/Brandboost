<?php

class adminDataController extends Controller
{
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

    public function deleteFaq($id)
    {
        $faqModel = $this->model('FaqModel');
        $result = $faqModel->deleteFaq($id);
        if ($result) {
            header('location: /AdminViewController/viewAllFaqs');
        } else {
            echo 'Error deleting faq';
        }
    }
}