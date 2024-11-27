<?php

class InfluencerDataController extends Controller {

    public function createPackage() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $gigData = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'platforms' => $_POST['platforms'],
                'tags' => $_POST['tags'],
                'basic' => [
                    'benefits' => $_POST['basic']['benefits'],
                    'delivery_days' => $_POST['basic']['delivery_days'],
                    'price' => $_POST['basic']['price'],
                    'revisions' => $_POST['basic']['revisions']
                    
                ],
                'premium' => [
                    'benefits' => $_POST['premium']['benefits'],
                    'delivery_days' => $_POST['premium']['delivery_days'],
                    'price' => $_POST['premium']['price'],
                    'revisions' => $_POST['premium']['revisions']
                    
                ]
            ];

            $this->model('PromotionModel');
            $promotionModel = new PromotionModel();
            // var_dump($promotionModel);


            $result = $promotionModel->createPackage($userId, $gigData);
            var_dump($result);

            if ($result) {
                echo "Package created successfully!";
                header("Location: /influencerviewcontroller/influencerPackages");
                // exit;
            } else {
                echo "Failed to create package. Please try again.";
                // echo $result;
            }
        } else {
            echo "Invalid request or session expired.";
        }
    }

    public function influencerPromotions() {

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            exit();
        }

        $userId = $_SESSION['user_id'];
        $promotionModel = $this->model('PromotionModel');

        $packages = $promotionModel->getPromotionsByUserId($userId);

        if ($packages) {
            echo json_encode($packages);
        } else {
            echo json_encode([]);
        }
    }

public function deletePromotion($id) {
    $userId = $_SESSION['user_id'];

    $promotionModel = $this->model('PromotionModel');

    $result = $promotionModel->deleteGigByIdAndUserId($id, $userId);

    echo json_encode($result);
    exit;
}



}

