<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\BaseController;
use app\core\Helpers\AuthHelper;
use app\models\Orders\Orders;
use app\models\Payments\Transaction;
use app\models\Payments\Wallet;
use app\models\Users\User;
use app\models\Payments\BankAccount;

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
                if (!$walletModel->updateWalletBalance(1, -$transaction['amount'])) {
                    $errors[] = "Failed to deduct from system wallet";
                    continue;
                }

                // Add to seller wallet
                if (!$walletModel->updateWalletBalance($sellerId, $transaction['amount'])) {
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
     * Add bank account for seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function addBankAccount($request, $response): void
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
        $requiredFields = ['bank_name', 'branch', 'account_number', 'name_on_card'];
        $missingFields = array_diff($requiredFields, array_keys($data));

        if (!empty($missingFields)) {
            $response->sendError('Missing required fields: ' . implode(', ', $missingFields), 400);
            return;
        }

        // Add seller ID to the bank account data
        $data['user_id'] = $sellerId;
        
        try {
            $bankAccountModel = new BankAccount();
            // Check if the bank account already exists for the seller  
            if ($bankAccountModel->addBankAccount($data)) {
                $response->sendJson([
                    'success' => true,
                    'message' => 'Bank account added successfully'
                ]);
            } else {
                $response->sendError('Failed to add bank account', 500);
            }
        } catch (\Exception $e) {
            error_log("Error adding bank account: " . $e->getMessage());
            $response->sendError('Failed to add bank account: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get bank accounts for the current seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function getSellerBankAccounts($request, $response): void
    {
        $sellerId = AuthHelper::getCurrentUser()['user_id'] ?? null;
        
        if (!$sellerId) {
            $response->sendError('Unauthorized', 401);
            return;
        }
        
        try {
            $bankAccountModel = new BankAccount();
            $bankAccounts = $bankAccountModel->getUserBankAccounts($sellerId);
            
            $response->sendJson([
                'success' => true,
                'data' => $bankAccounts
            ]);
        } catch (\Exception $e) {
            error_log("Error retrieving bank accounts: " . $e->getMessage());
            $response->sendError('Failed to retrieve bank accounts', 500);
        }
    }

    /**
     * Update bank account for seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function updateBankAccount($request, $response): void
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
            $response->sendError('Bank account ID is required', 400);
            return;
        }

        $bankAccountId = $data['id'];
        
        try {
            $bankAccountModel = new BankAccount();
            // Verify the bank account belongs to this user
            $existingAccount = $bankAccountModel->getBankAccountById($bankAccountId);
            
            if (!$existingAccount || $existingAccount['user_id'] != $sellerId) {
                $response->sendError('Bank account not found or access denied', 403);
                return;
            }
            
            // Remove the ID from the data to be updated
            unset($data['id']);
            
            if ($bankAccountModel->updateBankAccount($bankAccountId, $data)) {
                $response->sendJson([
                    'success' => true,
                    'message' => 'Bank account updated successfully'
                ]);
            } else {
                $response->sendError('Failed to update bank account', 500);
            }
        } catch (\Exception $e) {
            error_log("Error updating bank account: " . $e->getMessage());
            $response->sendError('Failed to update bank account: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Delete bank account for seller
     * 
     * @param Request $request
     * @param Response $response
     */
    public function deleteBankAccount($request, $response): void
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
            $response->sendError('Bank account ID is required', 400);
            return;
        }

        $bankAccountId = $data['id'];
        
        try {
            $bankAccountModel = new BankAccount();
            // Verify the bank account belongs to this user
            $existingAccount = $bankAccountModel->getBankAccountById($bankAccountId);
            
            if (!$existingAccount || $existingAccount['user_id'] != $sellerId) {
                $response->sendError('Bank account not found or access denied', 403);
                return;
            }
            
            if ($bankAccountModel->deleteBankAccount($bankAccountId)) {
                $response->sendJson([
                    'success' => true,
                    'message' => 'Bank account deleted successfully'
                ]);
            } else {
                $response->sendError('Failed to delete bank account', 500);
            }
        } catch (\Exception $e) {
            error_log("Error deleting bank account: " . $e->getMessage());
            $response->sendError('Failed to delete bank account: ' . $e->getMessage(), 500);
        }
    }
}