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
    
            $portfolioData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'skills' => $_POST['skills']
            ];
    
            $uploadDir = 'uploads/designer/portfolio/'; // Adjust path as needed
    
            // Handle cover image
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
    
            // Handle other images
            if (isset($_FILES['other_images']) && count($_FILES['other_images']['name']) > 0) {
                $otherImages = [];
                for ($i = 0; $i < count($_FILES['other_images']['name']); $i++) {
                    if (!empty($_FILES['other_images']['name'][$i])) {
                        $targetFile = $uploadDir . uniqid() . '_' . basename($_FILES['other_images']['name'][$i]);
                        if (move_uploaded_file($_FILES['other_images']['tmp_name'][$i], $targetFile)) {
                            $otherImages[] = $targetFile;
                        }
                    }
                }
    
                if (count($otherImages) < 1) {
                    echo json_encode(['status' => 'error', 'message' => 'At least one additional image is required.']);
                    return;
                }
    
                $portfolioData['other_images'] = implode(',', $otherImages);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'At least one additional image is required.']);
                return;
            }
    
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
    

}

