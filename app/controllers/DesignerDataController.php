<?php
// require_once '../app/models/GigModel.php';

class DesignerDataController extends Controller {
    // private $gigModel;

    // public function __construct($dbConnection) {
    //     $this->gigModel = new GigModel($dbConnection);
    // }

    public function createGig() {

        echo "Create Gig Controller";
        session_start();
        
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
                header("Location: /designerviewcontroller/designerGigs?success=true");
                // exit;
            } else {
                echo "Failed to create gig. Please try again.";
            }
        } else {
            echo "Invalid request or session expired.";
        }
    }
}
