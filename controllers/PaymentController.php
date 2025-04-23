<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\models\Orders\Orders;
use app\models\Payments\Transaction;
use app\models\Payments\Wallet;
use app\models\Users\User;
use app\models\Payments\PayoutMethod;

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

        try {
            // Update transaction status
            if (!$transactionModel->updateTransactionById($transaction['transaction_id'], ['status' => 'released'])) {
                $response->sendError('Failed to update transaction status', 500);
                return;
            }

            // Update seller's wallet
            $walletModel = new Wallet();
            $sellerId = $transaction['receiver_id'];
            $amount = $transaction['amount'];

            if (!$walletModel->walletExists($sellerId)) {
                if (!$walletModel->createWallet($sellerId)) {
                    $response->sendError('Failed to create wallet for seller', 500);
                    return;
                }
            }

            if (!$walletModel->updateWalletBalance($sellerId, $amount)) {
                $response->sendError('Failed to update wallet balance', 500);
                return;
            }

            $response->sendJson([
                'success' => true,
                'message' => 'Funds released successfully'
            ]);
        } catch (Exception $e) {
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
            try {
                // Fetch order to get seller_id
                $order = $orderModel->getOrderById($transaction['order_id']);
                if (!$order) {
                    $errors[] = "Order not found for transaction " . $transaction['transaction_id'];
                    continue;
                }

                $sellerId = $order['seller_id'];
                error_log("Debug - Seller ID: " . $sellerId);

                // Update original transaction status to released
                if (!$transactionModel->updateTransactionById($transaction['transaction_id'], ['status' => 'released'])) {
                    $errors[] = "Failed to update transaction status for transaction " . $transaction['transaction_id'];
                    continue;
                }
                
                $amount_for_platform = $transaction['amount'] * 0.1; // 10% platform fee
                $amount_for_seller = $transaction['amount'] - $amount_for_platform; // 90% goes to seller

                // Create new transaction (system -> seller)
                $newTransactionData = [
                    'order_id' => $transaction['order_id'],
                    'sender_id' => 1, // System user_id
                    'receiver_id' => $sellerId,
                    'amount' => $amount_for_seller, // 90% goes to seller, 10% platform fee
                    'status' => 'released',
                    'hold_until' => null // Immediate release
                ];

                if (!$transactionModel->createTransaction($newTransactionData)) {
                    $errors[] = "Failed to create seller transaction for order " . $transaction['order_id'];
                    continue;
                }

                // Ensure seller wallet exists
                if (!$walletModel->walletExists($sellerId)) {
                    if (!$walletModel->createWallet($sellerId)) {
                        $errors[] = "Failed to create seller wallet for user " . $sellerId;
                        continue;
                    }
                }

                // Deduct from system wallet
                if (!$walletModel->updateWalletBalance(1, - $amount_for_seller)) {
                    $errors[] = "Failed to deduct from system wallet";
                    continue;
                }

                // Add to seller wallet
                if (!$walletModel->updateWalletBalance($sellerId,  $amount_for_seller)) {
                    $errors[] = "Failed to update seller wallet balance for user " . $sellerId;
                    continue;
                }

                $successCount++;
            } catch (\Exception $e) {
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
     * Get hold balance for seller (funds in hold status)
     * 
     * @param Request $request
     * @param Response $response
     */
    public function getSellerHoldBalance($request, $response): void
    {
        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;

        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }

        try {
            $transactionModel = new Transaction();
            $allTransactions = $transactionModel->getTransactionsByReceiverId($sellerId);
            
            $holdAmount = 0;
            $holdTransactions = [];
            
            foreach ($allTransactions as $transaction) {
                if ($transaction['status'] === 'hold') {
                    $holdAmount += (float)$transaction['amount'];
                    $holdTransactions[] = $transaction;
                }
            }

            $response->sendJson([
                'success' => true,
                'hold_balance' => number_format($holdAmount, 2, '.', ''),
                // 'currency' => 'USD',
                'transactions_count' => count($holdTransactions)
            ]);
        } catch (\Exception $e) {
            error_log("Error getting seller hold balance: " . $e->getMessage());
            $response->sendError('Failed to retrieve hold balance', 500);
        }
    }

    /**
     * Get seller's released earnings within a specific time period
     * 
     * @param Request $request
     * @param Response $response
     */
    public function getPeriodEarnings($request, $response): void
    {
        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;

        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }

        $queryParams = $request->getQueryParams();
        $startDate = $queryParams['start'] ?? null;
        $endDate = $queryParams['end'] ?? null;

        if (!$startDate || !$endDate) {
            $response->sendError('Start and end dates are required', 400);
            return;
        }

        // Validate date format
        if (!strtotime($startDate) || !strtotime($endDate)) {
            $response->sendError('Invalid date format', 400);
            return;
        }

        try {
            $transactionModel = new Transaction();
            $transactions = $transactionModel->getTransactionsByReceiverId($sellerId);
            
            $totalEarnings = 0;
            $releasedTransactions = [];
            
            foreach ($transactions as $transaction) {
                $transactionDate = strtotime($transaction['updated_at'] ?? $transaction['created_at']);
                $startTimestamp = strtotime($startDate);
                $endTimestamp = strtotime($endDate . ' 23:59:59');
                
                if ($transaction['status'] === 'released' && 
                    $transactionDate >= $startTimestamp && 
                    $transactionDate <= $endTimestamp) {
                    $totalEarnings += (float)$transaction['amount'];
                    $releasedTransactions[] = $transaction;
                }
            }

            $response->sendJson([
                'success' => true,
                'total_earnings' => number_format($totalEarnings, 2, '.', ''),
                'currency' => 'USD',
                'period' => [
                    'start' => $startDate,
                    'end' => $endDate
                ],
                'transactions_count' => count($releasedTransactions)
            ]);
        } catch (\Exception $e) {
            error_log("Error getting period earnings: " . $e->getMessage());
            $response->sendError('Failed to retrieve period earnings', 500);
        }
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
     * Get transactions for the current seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function getSellerTransactions($request, $response): void
    {
        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;
        error_log("Debug - Seller ID: " . $sellerId);

        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }

        // $queryParams = $request->getQueryParams();
        // $page = isset($queryParams['page']) ? (int)$queryParams['page'] : 1;
        // $limit = isset($queryParams['limit']) ? (int)$queryParams['limit'] : 10;
        // $status = $queryParams['status'] ?? null;

        // Ensure reasonable limits
        // if ($limit > 50) $limit = 50;
        // if ($page < 1) $page = 1;
        // $offset = ($page - 1) * $limit;

        $transactionModel = new Transaction();
        $transactions = $transactionModel->getTransactionsByReceiverId($sellerId);
        // $totalCount = $transactionModel->countTransactionsByReceiverId($sellerId, $status);
        // Debug: Log transaction data
        error_log("Seller Transactions for seller ID $sellerId: " . print_r($transactions, true));

        // You can also add this to view structured data in browser console if needed
        header('X-Debug-Transactions: ' . json_encode($transactions));

        $response->sendJson([
            'success' => true,
            'data' => $transactions,
            // 'pagination' => [
            //     'page' => $page,
            //     'limit' => $limit,
            //     'total' => $totalCount,
            //     'pages' => ceil($totalCount / $limit)
            // ]
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



    /**
     * Process a withdrawal request from a seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function withdrawFunds($request, $response): void
    {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;
        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }

        $data = $request->getParsedBody();
        if (!isset($data['amount']) || !is_numeric($data['amount']) || $data['amount'] <= 0) {
            $response->sendError('Valid withdrawal amount is required', 400);
            return;
        }
        // Log the withdrawal amount
        error_log("Withdrawal request received for amount: " . $data['amount'] . " from seller ID: " . $sellerId);

        $amount = (float)$data['amount'];
        $walletModel = new Wallet();
        
        // Get current wallet to check balance
        $wallet = $walletModel->getWalletBySellerId($sellerId);
        if (!$wallet) {
            $response->sendError('Wallet not found', 404);
            return;
        }
        
        // Make sure the user has enough balance
        if ($wallet['balance'] < $amount) {
            $response->sendError('Insufficient funds for withdrawal', 400);
            return;
        }
        
        // Convert to negative amount for withdrawal
        $withdrawalAmount = -1 * $amount;
        
        try {
            if ($walletModel->updateWalletBalance($sellerId, $withdrawalAmount)) {
                // Record the withdrawal transaction
                $transactionModel = new Transaction();
                $transactionData = [
                    'sender_id' => $sellerId,
                    'receiver_id' => null, // System user ID
                    'amount' => $amount,
                    'status' => 'withdrawal',
                    'order_id' => null // Not associated with an order
                ];
                
                $transactionModel->createTransaction($transactionData);
                
                $response->sendJson([
                    'success' => true,
                    'message' => 'Withdrawal processed successfully',
                    'withdrawn_amount' => $amount,
                    'new_balance' => $wallet['balance'] + $withdrawalAmount
                ]);
            } else {
                $response->sendError('Failed to process withdrawal', 500);
            }
        } catch (\Exception $e) {
            error_log("Withdrawal error: " . $e->getMessage());
            $response->sendError('Failed to process withdrawal: ' . $e->getMessage(), 500);
        }
    }



        /**
     * Add payout method for seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function addPayoutMethod($request, $response): void
    {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;
        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }

        $data = $request->getParsedBody();
        
        // Check for payment_type
        if (!isset($data['payment_type']) || empty($data['payment_type'])) {
            $response->sendError('Payment type is required', 400);
            return;
        }
        
        $paymentType = strtolower($data['payment_type']);
        
        // Validate payment type
        if (!in_array($paymentType, ['bank', 'paypal'])) {
            $response->sendError('Invalid payment type. Must be "bank" or "paypal"', 400);
            return;
        }
        
        // Check if this is a bank account or PayPal submission
        $isBankAccount = ($paymentType === 'bank');
        $isPayPal = ($paymentType === 'paypal');
        
        // Validate based on the submission type
        if ($isBankAccount) {
            $requiredFields = ['bank_name', 'branch', 'account_number', 'name_on_card'];
            $missingFields = array_diff($requiredFields, array_keys(array_filter($data)));
            
            if (!empty($missingFields)) {
                $response->sendError('Missing required fields: ' . implode(', ', $missingFields), 400);
                return;
            }
        } elseif ($isPayPal) {
            $requiredFields = ['paypal_name'];
            $missingFields = array_diff($requiredFields, array_keys(array_filter($data)));
            
            if (!empty($missingFields)) {
                $response->sendError('Missing required fields: ' . implode(', ', $missingFields), 400);
                return;
            }
            
            // Check that at least email OR mobile number is provided
            $hasEmail = !empty($data['paypal_email']);
            $hasMobile = !empty($data['paypal_mobile_number']);
            
            if (!$hasEmail && !$hasMobile) {
                $response->sendError('Either PayPal email or mobile number must be provided', 400);
                return;
            }
        }
        
        // Add seller ID to the payout method data
        $data['user_id'] = $sellerId;
        
        try {
            $payoutMethodModel = new PayoutMethod();
            // Add the payout method  
            if ($payoutMethodModel->addPayoutMethod($data)) {
                $response->sendJson([
                    'success' => true,
                    'message' => 'Payout method added successfully'
                ]);
            } else {
                $response->sendError('Failed to add payout method', 500);
            }
        } catch (\Exception $e) {
            error_log("Error adding payout method: " . $e->getMessage());
            $response->sendError('Failed to add payout method: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get payout methods for the current seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function getSellerPayoutMethods($request, $response): void
    {
        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;
        
        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }
        
        try {
            $payoutMethodModel = new PayoutMethod();
            $payoutMethods = $payoutMethodModel->getUserPayoutMethods($sellerId);
            
            $response->sendJson([
                'success' => true,
                'data' => $payoutMethods
            ]);
        } catch (\Exception $e) {
            error_log("Error retrieving payout methods: " . $e->getMessage());
            $response->sendError('Failed to retrieve payout methods', 500);
        }
    }

    /**
     * Update payout method for seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function updatePayoutMethod($request, $response): void
    {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;
        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }

        $data = $request->getParsedBody();
        if (!isset($data['id'])) {
            $response->sendError('Payout method ID is required', 400);
            return;
        }

        $payoutMethodId = $data['id'];
        
        try {
            $payoutMethodModel = new PayoutMethod();
            // Verify the payout method belongs to this user
            $existingMethod = $payoutMethodModel->getPayoutMethod($payoutMethodId);
            
            if (!$existingMethod || $existingMethod['user_id'] != $sellerId) {
                $response->sendError('Payout method not found or access denied', 403);
                return;
            }
            
            // Remove the ID from the data to be updated
            unset($data['id']);
            
            // Validate if payment type is present and the required fields are provided
            if (isset($data['payment_type'])) {
                $paymentType = strtolower($data['payment_type']);
                
                if ($paymentType === 'bank') {
                    $requiredFields = ['bank_name', 'branch', 'account_number', 'name_on_card'];
                    $providedFields = array_filter($data, function($value, $key) use ($requiredFields) {
                        return in_array($key, $requiredFields) && !empty($value);
                    }, ARRAY_FILTER_USE_BOTH);
                    
                    if (count($providedFields) > 0 && count($providedFields) < count($requiredFields)) {
                        $missingFields = array_diff($requiredFields, array_keys($providedFields));
                        $response->sendError('Missing required fields: ' . implode(', ', $missingFields), 400);
                        return;
                    }
                } elseif ($paymentType === 'paypal') {
                    if (isset($data['paypal_name']) && empty($data['paypal_name'])) {
                        $response->sendError('PayPal name is required', 400);
                        return;
                    }
                    
                    $hasEmail = !empty($data['paypal_email']);
                    $hasMobile = !empty($data['paypal_mobile_number']);
                    
                    if (isset($data['paypal_email']) || isset($data['paypal_mobile_number'])) {
                        if (!$hasEmail && !$hasMobile) {
                            $response->sendError('Either PayPal email or mobile number must be provided', 400);
                            return;
                        }
                    }
                }
            }
            
            if ($payoutMethodModel->updatePayoutMethod($payoutMethodId, $data)) {
                $response->sendJson([
                    'success' => true,
                    'message' => 'Payout method updated successfully'
                ]);
            } else {
                $response->sendError('Failed to update payout method', 500);
            }
        } catch (\Exception $e) {
            error_log("Error updating payout method: " . $e->getMessage());
            $response->sendError('Failed to update payout method: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Delete payout method for seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function deletePayoutMethod($request, $response): void
    {
        if ($request->getMethod() !== 'POST') {
            $response->setStatusCode(405);
            $response->sendError('Method Not Allowed');
            return;
        }

        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;
        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }

        $data = $request->getParsedBody();
        if (!isset($data['id'])) {
            $response->sendError('Payout method ID is required', 400);
            return;
        }

        $payoutMethodId = $data['id'];
        
        try {
            $payoutMethodModel = new PayoutMethod();
            // Verify the payout method belongs to this user
            $existingMethod = $payoutMethodModel->getPayoutMethod($payoutMethodId);
            
            if (!$existingMethod || $existingMethod['user_id'] != $sellerId) {
                $response->sendError('Payout method not found or access denied', 403);
                return;
            }
            
            if ($payoutMethodModel->deletePayoutMethod($payoutMethodId)) {
                $response->sendJson([
                    'success' => true,
                    'message' => 'Payout method deleted successfully'
                ]);
            } else {
                $response->sendError('Failed to delete payout method', 500);
            }
        } catch (\Exception $e) {
            error_log("Error deleting payout method: " . $e->getMessage());
            $response->sendError('Failed to delete payout method: ' . $e->getMessage(), 500);
        }
    }
}