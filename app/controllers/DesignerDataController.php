<?php

class DesignerDataController extends Controller {

    public function createGig() {

        // echo "Create Gig Controller";
        // session_start();
        
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
    

    // Delete a gig by ID, ensuring it belongs to the logged-in user
    public function deleteGig($id) {
        // session_start();

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            exit();
        }

        $userId = $_SESSION['user_id'];
        $gigModel = $this->model('GigModel');

        if ($gigModel->deleteGigByIdAndUserId($id, $userId)) {
            echo json_encode(['status' => 'success', 'message' => 'Gig deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete gig or unauthorized action.']);
        }
    }
}

