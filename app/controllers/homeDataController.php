<?php

class HomeDataController extends Controller {
    public function fetchAllFaqs() {
        $faqModel = $this->model('FaqModel');
        $faqs = $faqModel->getAllFaqs();
        echo json_encode($faqs);

    }
    
}