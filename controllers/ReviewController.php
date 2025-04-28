<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Request;
use app\core\Response;

// Utility Imports
use app\core\Helpers\AuthHelper;
use app\core\Utils\FileHandler;

// Model Imports
use app\models\Orders\Orders;


class ReviewController extends BaseController {

    /**
     * Create a review for an order
     */
    public function createReview($request, $response)
    {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Parse request body
        $requestData = $request->getParsedBody();
        if (empty($requestData['order_id']) || empty($requestData['reviewText']) || empty($requestData['rating'])) {
            $response->sendError('No data provided for review.');
        }

        error_log(print_r($requestData, 1));

        $user = AuthHelper::getCurrentUser();
        $role = $user['role'];
        error_log('Role: ' . $role);
        $id = $requestData['order_id'];
        $orderModel = new Orders();
        $order = $orderModel->getOrderById($id);

        $review = [
            'order_id' => $id,
            'service_id' => $order['service_id'],
            'user_id' => $_SESSION['user']['user_id'],
            'review_type' => ($role === 'businessman') ? 'review' : 'feedback',
            'content' => $requestData['reviewText'],
            'rating' => $requestData['rating'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        

        $reviewModel = $this->model('Orders\OrderReviewsFeedback');

        if (!$reviewModel->create($review)) {
            $response->sendJson([
                'success' => false,
                'message' => 'Failed to update order.'
            ]);
            return;
        }

        $response->sendJson([
            'success' => true,
            'message' => 'Review Created successfully.',
        ]);
    }
}