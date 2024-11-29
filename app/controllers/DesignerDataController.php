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
    
            // Collect text input data
            $portfolioData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'skills' => $_POST['skills']
            ];
    
            $uploadDir = 'uploads/designer/portfolio/'; // Adjust path as needed
    
            // Create the upload directory if it doesn't exist
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
    
            // Handle cover image upload
            if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === 0) {
                $coverImage = $uploadDir . uniqid() . '_' . basename($_FILES['cover_image']['name']);
                if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $coverImage)) {
                    $portfolioData['cover_image'] = $coverImage;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to upload cover image.']);
                    return;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Cover image is required.']);
                return;
            }
    
            // Handle other image uploads
            $imageFields = ['first_image', 'second_image', 'third_image', 'fourth_image'];
            $uploadedImages = [];
    
            foreach ($imageFields as $field) {
                if (isset($_FILES[$field]) && $_FILES[$field]['error'] === 0) {
                    $targetFile = $uploadDir . uniqid() . '_' . basename($_FILES[$field]['name']);
                    if (move_uploaded_file($_FILES[$field]['tmp_name'], $targetFile)) {
                        $uploadedImages[] = $targetFile;
                    }
                }
            }
    
            // Validate that at least one additional image is uploaded
            if (count($uploadedImages) < 1) {
                echo json_encode(['status' => 'error', 'message' => 'At least one additional image is required.']);
                return;
            }
    
            // Save image paths into the portfolio data
            $portfolioData['first_image'] = $uploadedImages[0] ?? null;
            $portfolioData['second_image'] = $uploadedImages[1] ?? null;
            $portfolioData['third_image'] = $uploadedImages[2] ?? null;
            $portfolioData['fourth_image'] = $uploadedImages[3] ?? null;
    
            // Call the model to save the portfolio data
            $this->model('PortfolioModel');
            $portfolioModel = new PortfolioModel();
    
            $result = $portfolioModel->createPortfolio($userId, $portfolioData);
    
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Portfolio submitted successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to submit portfolio. Please try again.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request or session expired.']);
        }
    }
    

    public function viewPortfolio() {
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
    
            $this->model('PortfolioModel');
            $portfolioModel = new PortfolioModel();
    
            // Fetch portfolio data by user_id
            $portfolio = $portfolioModel->getPortfolioByUserId($userId);
    
            // Check if a portfolio exists for the user
            if ($portfolio) {
                $this->view('DesignerViewController/viewMyPortfolio', ['portfolio' => $portfolio]);
                var_dump($portfolio);
            } else {
                echo "No portfolio found for the current user.";
            }
        } else {
            echo "Unauthorized access.";
        }
    }
    
    

}

