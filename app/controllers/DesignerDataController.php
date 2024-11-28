<?php

class DesignerDataController extends Controller {

    public function createGig() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $gigData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'delivery_formats' => $_POST['delivery_formats'],
                'tags' => $_POST['tags'],
                'basic' => [
                    'benefits' => $_POST['basic']['benefits'],
                    'delivery_days' => $_POST['basic']['delivery_days'],
                    'revisions' => $_POST['basic']['revisions'],
                    'price' => $_POST['basic']['price']
                ],
                'premium' => [
                    'benefits' => $_POST['premium']['benefits'],
                    'delivery_days' => $_POST['premium']['delivery_days'],
                    'revisions' => $_POST['premium']['revisions'],
                    'price' => $_POST['premium']['price']
                ]
            ];

            $this->model('GigModel');
            $gigModel = new GigModel();

            $result = $gigModel->createGig($userId, $gigData);

            if ($result) {
                echo "Gig created successfully!";
                header("Location: /designerviewcontroller/designerGigs");
                // exit;
            } else {
                echo "Failed to create gig. Please try again.";
            }
        } else {
            echo "Invalid request or session expired.";
        }
    }

    public function designerGigs() {

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            exit();
        }

        $userId = $_SESSION['user_id'];
        $gigModel = $this->model('GigModel');

        $gigs = $gigModel->getGigsByUserId($userId);

        if ($gigs) {
            echo json_encode($gigs);
        } else {
            echo json_encode([]);
        }
    }

    public function fetchSingleGig($gigId) {
        $userId = $_SESSION['user_id'];

        $gigModel = $this->model('GigModel');

        $gig = $gigModel->getGigByGigId($gigId);

        if ($gig) {
            echo json_encode($gig);
        } else {
            echo json_encode([]);
        }
    }

    public function updateGig($gigId) {
        $gigData = json_decode(file_get_contents('php://input'), true);
        $userId = $_SESSION['user_id'];

        $gigModel = $this->model('GigModel');
    
        $result = $gigModel->updateGig($gigId, $userId, $gigData);
    
        echo json_encode($result);
    }
    

    public function deleteGig($id) {
        $userId = $_SESSION['user_id'];

        $gigModel = $this->model('GigModel');

        $result = $gigModel->deleteGigByIdAndUserId($id, $userId);

        echo json_encode($result);
        exit;
    }









    public function addPortfolio() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
    
            // Check if a file is uploaded
            if (!isset($_FILES['upload']) || $_FILES['upload']['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(['status' => 'error', 'message' => 'File upload failed.']);
                return;
            }
    
            // Process the uploaded file
            $uploadDir = 'uploads/designer/portfolio'; // Ensure this directory exists and is writable
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            $fileTmpPath = $_FILES['upload']['tmp_name'];
            $fileName = uniqid() . '_' . basename($_FILES['upload']['name']);
            $filePath = $uploadDir . $fileName;
    
            if (!move_uploaded_file($fileTmpPath, $filePath)) {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save uploaded file.']);
                return;
            }
    
            // Collect portfolio data
            $portfolioData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'skills' => $_POST['skills'],
                'images' => [$filePath], // Add the file path to the images array
            ];
    
            // Call the model
            $this->model('PortfolioModel');
            $portfolioModel = new PortfolioModel();
            $result = $portfolioModel->createPortfolio($userId, $portfolioData);
    
            // Send response
            if ($result['status'] === 'success') {
                echo json_encode(['status' => 'success', 'message' => $result['message']]);
            } else {
                echo json_encode(['status' => 'error', 'message' => $result['message']]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request or session expired.']);
        }
    }
    

}

