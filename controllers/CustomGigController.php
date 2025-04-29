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


class CustomGigController extends BaseController
{

    /**
     * Create a review for an order
     */
    public function createCustomGig($request, $response)
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
                'message' => 'Failed to create review.'
            ]);
            return;
        }

        // Send success response
        $response->sendJson([
            'success' => true,
            'message' => 'Review created successfully.'
        ]);
    }

    /**
     * Get custom gig for a specific order
     */

    public function getCustomGig($request, $response)
    {
        if ($request->getMethod() !== 'GET') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        // Parse request body
        $requestData = $request->getQueryParams();
        if (empty($requestData['order_id'])) {
            $response->sendError('No data provided for review.');
        }

        error_log(print_r($requestData, 1));

        $user = AuthHelper::getCurrentUser();
        $role = $user['role'];
        error_log('Role: ' . $role);
        $id = $requestData['order_id'];
        $orderModel = new Orders();
        $order = $orderModel->getOrderById($id);


        // Send success response
        $response->sendJson([
            'success' => true,
            'message' => 'Review created successfully.'
        ]);



        // Get date & time at sri lanka timezone
        $data = [
            'created_at' => (new DateTime('now', new DateTimeZone('Asia/Colombo')))->format('Y-m-d H:i:s')
        ];





        //

    }
}

?>


<html>
<body>
    <script>
        const state1 = {
            order_status: ''
        };
        const itemsPerPageSelect = document.getElementById('statusfilter');



        itemsPerPageSelect.addEventListener('change', function() {
            state1.order_status = this.value;
            loadOrdersData();
        });


        // Global state
        const state = {
            orders: [],
            filteredOrders: [],
            searchTerm: ''
        };

        // Function to load data into the table
        async function loadOrdersData() {
            const queryParams = new URLSearchParams({

            });
            if (state1.order_status) {
                queryParams.append('order_status', state1.order_status);
            }
            console.log("queryyyyy", queryParams);

            const tableBody = document.getElementById('ordersTableBody');

            try {
                const response = await fetch(`/api/orders?include_seller=true&${queryParams.toString()}`);
                const result = await response.json();

                console.log('Orders data:', result);

                if (result.success !== false) {
                    state.orders = result.data;
                    state.filteredOrders = [...state.orders];
                    renderOrders();
                    updateStats();
                } else {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="fas fa-exclamation-circle"></i>
                                <p class="empty-state-text">Error: ${result.message || 'Failed to load orders'}</p>
                            </td>
                        </tr>`;
                }
            } catch (error) {
                console.error('Error fetching orders:', error);
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class="fas fa-exclamation-triangle"></i>
                            <p class="empty-state-text">Failed to load orders. Please try again later.</p>
                        </td>
                    </tr>`;
            }
        }
    </script>
</body>

</html>