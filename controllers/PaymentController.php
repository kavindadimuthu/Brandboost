<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\models\Orders\Orders;
use app\models\Payments\Transaction;
use app\models\Payments\Wallet;
use app\models\Users\User;

class PaymentController extends BaseController {
    /**
     * Create a new transaction for an order
     * 
     * @param Request $request
     * @param Response $response
     */
    public function createTransaction($request, $response): void
    {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $data = $request->getParsedBody();
        $requiredFields = ['order_id', 'amount', 'sender_id', 'receiver_id'];
        $missingFields = array_diff($requiredFields, array_keys($data));

        if (!empty($missingFields)) {
            $response->sendError('Missing required fields: ' . implode(', ', $missingFields), 400);
            return;
        }

        // Validate users exist
        $userModel = new User();
        if (!$userModel->getUserById($data['sender_id']) || !$userModel->getUserById($data['receiver_id'])) {
            $response->sendError('Invalid sender or receiver ID', 400);
            return;
        }

        // Validate order exists
        $orderModel = new Orders();
        if (!$orderModel->getOrderById($data['order_id'])) {
            $response->sendError('Order not found', 404);
            return;
        }

        $transactionModel = new Transaction();
        if ($transactionModel->transactionExistsForOrder($data['order_id'])) {
            $response->sendError('Transaction already exists for this order', 409);
            return;
        }

        $transactionData = [
            'order_id' => $data['order_id'],
            'sender_id' => $data['sender_id'],
            'receiver_id' => $data['receiver_id'],
            'amount' => $data['amount'],
            'hold_until' => $data['hold_until'] ?? $this->calculateDefaultHoldPeriod(),
            'status' => 'hold'
        ];

        if (!$transactionModel->createTransaction($transactionData)) {
            $response->sendError('Failed to create transaction', 500);
            return;
        }

        $response->sendJson([
            'success' => true,
            'message' => 'Transaction created successfully',
            'transaction_id' => $transactionModel->getLastInsertId()
        ]);
    }

    /**
     * Release funds to seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function releaseFunds($request, $response): void
    {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $data = $request->getParsedBody();
        $transactionId = $data['transaction_id'] ?? null;
        $orderId = $data['order_id'] ?? null;

        $transactionModel = new Transaction();
        $transaction = $transactionId 
            ? $transactionModel->getTransactionById($transactionId)
            : $transactionModel->readOne(['order_id' => $orderId]);

        if (!$transaction) {
            $response->sendError('Transaction not found', 404);
            return;
        }

        if ($transaction['status'] !== 'hold') {
            $response->sendError('Funds are not in hold status', 400);
            return;
        }

        if ($transaction['hold_until'] && strtotime($transaction['hold_until']) > time()) {
            $response->sendError('Funds cannot be released before hold period', 400);
            return;
        }

        $this->db->beginTransaction();

        try {
            // Update transaction status
            if (!$transactionModel->updateTransactionById($transaction['transaction_id'], ['status' => 'released'])) {
                throw new Exception('Failed to update transaction status');
            }

            // Update seller's wallet
            $walletModel = new Wallet();
            $sellerId = $transaction['receiver_id'];
            $amount = $transaction['amount'];

            if (!$walletModel->walletExists($sellerId)) {
                if (!$walletModel->createWallet($sellerId)) {
                    throw new Exception('Failed to create wallet for seller');
                }
            }

            if (!$walletModel->updateWalletBalance($sellerId, $amount)) {
                throw new Exception('Failed to update wallet balance');
            }

            $this->db->commit();

            $response->sendJson([
                'success' => true,
                'message' => 'Funds released successfully'
            ]);
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Release funds error: " . $e->getMessage());
            $response->sendError('Failed to release funds: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Process scheduled releases (cron job endpoint)
     *
     * @param Request $request
     * @param Response $response
     */
    public function processScheduledReleases($request, $response): void
    {
        $transactionModel = new Transaction();
        $walletModel = new Wallet();
        $orderModel = new Orders();

        // Get transactions that are ready to be released
        $transactions = $transactionModel->getPendingReleasableTransactions();

        if (empty($transactions)) {
            $response->sendJson(['success' => true, 'message' => 'No transactions to release']);
            return;
        }

        $successCount = 0;
        $errors = [];

        foreach ($transactions as $transaction) {
            $this->db->beginTransaction();

            try {
                // Fetch order to get seller_id
                $order = $orderModel->getOrderById($transaction['order_id']);
                if (!$order) {
                    throw new \Exception('Order not found for transaction ' . $transaction['transaction_id']);
                }

                $sellerId = $order['seller_id'];

                // Update original transaction status to released
                if (!$transactionModel->updateTransactionById($transaction['transaction_id'], ['status' => 'released'])) {
                    throw new \Exception('Failed to update transaction status');
                }

                // Create new transaction (system -> seller)
                $newTransactionData = [
                    'order_id' => $transaction['order_id'],
                    'sender_id' => 1, // System user_id
                    'receiver_id' => $sellerId,
                    'amount' => $transaction['amount'],
                    'status' => 'released',
                    'hold_until' => null // Immediate release
                ];

                if (!$transactionModel->createTransaction($newTransactionData)) {
                    throw new \Exception('Failed to create seller transaction');
                }

                // Ensure seller wallet exists
                if (!$walletModel->walletExists($sellerId)) {
                    if (!$walletModel->createWallet($sellerId)) {
                        throw new \Exception('Failed to create seller wallet');
                    }
                }

                // Deduct from system wallet
                if (!$walletModel->updateWalletBalance(1, -$transaction['amount'])) {
                    throw new \Exception('Failed to deduct from system wallet');
                }

                // Add to seller wallet
                if (!$walletModel->updateWalletBalance($sellerId, $transaction['amount'])) {
                    throw new \Exception('Failed to update seller wallet balance');
                }

                $this->db->commit();
                $successCount++;
            } catch (\Exception $e) {
                $this->db->rollBack();
                $errors[] = "Transaction {$transaction['transaction_id']}: " . $e->getMessage();
                error_log("Scheduled release error: " . $e->getMessage());
            }
        }

        $response->sendJson([
            'success' => true,
            'message' => "Released $successCount transactions",
            'errors' => $errors
        ]);
    }
    /**
     * Get seller wallet balance
     * 
     * @param Request $request
     * @param Response $response
     */
    public function getSellerBalance($request, $response): void
    {
        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;

        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }

        $walletModel = new Wallet();
        $wallet = $walletModel->getWalletBySellerId($sellerId);

        $response->sendJson([
            'success' => true,
            'balance' => $wallet ? $wallet['balance'] : 0.00,
            'currency' => $wallet['currency'] ?? 'USD'
        ]);
    }

    /**
     * Mark transaction as failed
     * 
     * @param Request $request
     * @param Response $response
     */
    public function markFailedTransaction($request, $response): void
    {
        $data = $request->getParsedBody();
        $transactionId = $data['transaction_id'] ?? null;

        if (!$transactionId) {
            $response->sendError('Transaction ID required', 400);
            return;
        }

        $transactionModel = new Transaction();
        if (!$transactionModel->updateTransactionById($transactionId, ['status' => 'failed'])) {
            $response->sendError('Failed to update transaction status', 500);
            return;
        }

        $response->sendJson([
            'success' => true,
            'message' => 'Transaction marked as failed'
        ]);
    }


    
    /**
     * Get transaction details
     * 
     * @param Request $request
     * @param Response $response
     */
    public function getTransactionDetails($request, $response): void
    {
        $queryParams = $request->getQueryParams();
        $transactionId = $queryParams['transaction_id'] ?? null;
        $orderId = $queryParams['order_id'] ?? null;

        if (!$transactionId && !$orderId) {
            $response->sendError('Transaction ID or Order ID required', 400);
            return;
        }

        $transactionModel = new Transaction();
        $transaction = $transactionId 
            ? $transactionModel->getTransactionById($transactionId)
            : $transactionModel->readOne(['order_id' => $orderId]);

        if (!$transaction) {
            $response->sendError('Transaction not found', 404);
            return;
        }

        $response->sendJson([
            'success' => true,
            'data' => $transaction
        ]);
    }

    /**
     * Calculate default hold period (14 days from now)
     */
    private function calculateDefaultHoldPeriod(): string
    {
        $holdDays = 14;
        return date('Y-m-d H:i:s', strtotime("+$holdDays days"));
    }
}