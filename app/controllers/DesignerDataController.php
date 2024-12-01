<?php

class DesignerDataController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 'designer') {
            header('location: /');
        }
    }
    
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
            
            // Set the content type to JSON
            header('Content-Type: application/json');
    
            // Check if a portfolio exists for the user
            if ($portfolio !== false) { // Check if fetching was successful
                echo json_encode($portfolio);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No portfolio found.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
    }
    

    public function updatePortfolio() {
        // Check if the user is logged in
        if (isset($_SESSION['user_id'])) {
            // Check if the form is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get data from the form with default values for missing fields
                $userId = $_POST['user_id'] ?? null;
                $title = $_POST['title'] ?? '';
                $description = $_POST['description'] ?? '';
                
                // Handle file uploads with default values for missing files
                $coverImage = $_FILES['cover_image']['name'] ?? null;
                $firstImage = $_FILES['first_image']['name'] ?? null;
                $secondImage = $_FILES['second_image']['name'] ?? null;
                $thirdImage = $_FILES['third_image']['name'] ?? null;
                $fourthImage = $_FILES['fourth_image']['name'] ?? null;
    
                // Upload files if they exist
                $uploadDir = 'uploads/designer/portfolio/';
                $uploadedCoverImage = $this->uploadFile($_FILES['cover_image'], $uploadDir);
                $uploadedFirstImage = $this->uploadFile($_FILES['first_image'], $uploadDir);
                $uploadedSecondImage = $this->uploadFile($_FILES['second_image'], $uploadDir);
                $uploadedThirdImage = $this->uploadFile($_FILES['third_image'], $uploadDir);
                $uploadedFourthImage = $this->uploadFile($_FILES['fourth_image'], $uploadDir);
    
                // Load the model
                $this->model('PortfolioModel');
                $portfolioModel = new PortfolioModel();

                // Fetch the existing portfolio data
                $existingPortfolio = $portfolioModel->getPortfolioByUserId($userId);

                // Determine the final paths for images
                $coverImagePath = $uploadedCoverImage ?? $existingPortfolio['cover_image'];
                $firstImagePath = $uploadedFirstImage ?? $existingPortfolio['first_image'];
                $secondImagePath = $uploadedSecondImage ?? $existingPortfolio['second_image'];
                $thirdImagePath = $uploadedThirdImage ?? $existingPortfolio['third_image'];
                $fourthImagePath = $uploadedFourthImage ?? $existingPortfolio['fourth_image'];
                    
                // Update the portfolio
                $result = $portfolioModel->updatePortfolio(
                    $userId,
                    $title,
                    $description,
                    $coverImagePath,
                    $firstImagePath,
                    $secondImagePath,
                    $thirdImagePath,
                    $fourthImagePath
                );

                var_dump($result);
    
                // Check if the update was successful
                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Portfolio updated successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to update portfolio.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
    }
    
    /**
     * Handles file uploads.
     */
    private function uploadFile($file, $uploadDir) {
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory if not exists
        }
    
        if ($file && isset($file['tmp_name']) && $file['error'] === UPLOAD_ERR_OK) {
            $filePath = $uploadDir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                return $filePath;
            }
        }
        return null;
    }
    
    

    public function deletePortfolio() {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
    
            $portfolioModel = $this->model('PortfolioModel');
    
            $result = $portfolioModel->deletePortfolioByUserId( $userId);
    
            echo json_encode($result);
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
        }
       
    }    

}

