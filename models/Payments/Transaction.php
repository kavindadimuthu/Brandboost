<?php

namespace app\models\Payments;

use app\core\BaseModel;

class Transaction extends BaseModel
{
    protected $table = 'transactions'; // Specify the database table

    /**
     * Retrieve a transaction by its ID.
     *
     * @param int $transactionId The ID of the transaction.
     * @return array|false The transaction record or false if not found.
     */
    public function getTransactionById(int $transactionId)
    {
        return $this->readOne(['transaction_id' => $transactionId]);
    }

    /**
     * Retrieve transactions by order ID.
     *
     * @param int $orderId The ID of the order.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByOrderId(int $orderId, array $options = [])
    {
        return $this->read(['order_id' => $orderId], $options);
    }

    /**
     * Retrieve transactions by sender ID.
     *
     * @param int $senderId The ID of the sender.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsBySenderId(int $senderId, array $options = [])
    {
        return $this->read(['sender_id' => $senderId], $options);
    }

    /**
     * Retrieve transactions by receiver ID.
     *
     * @param int $receiverId The ID of the receiver.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByReceiverId(int $receiverId, array $options = [])
    {
        return $this->read(['receiver_id' => $receiverId], $options);
    }

    /**
     * Retrieve transactions by status.
     *
     * @param string $status The status of the transactions (hold, released, failed).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByStatus(string $status, array $options = [])
    {
        return $this->read(['status' => $status], $options);
    }

    /**
     * Create a new transaction.
     *
     * @param array $data The transaction data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createTransaction(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update a transaction by its ID.
     *
     * @param int $transactionId The ID of the transaction to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateTransactionById(int $transactionId, array $data)
    {
        return $this->update(['transaction_id' => $transactionId], $data);
    }

    /**
     * Update transaction status by order ID.
     *
     * @param int $orderId The ID of the order.
     * @param string $status The new status to set.
     * @return bool Success or failure of the operation.
     */
    public function updateTransactionStatusByOrderId(int $orderId, string $status)
    {
        return $this->update(['order_id' => $orderId], ['status' => $status]);
    }

    /**
     * Release funds from hold status to released status.
     *
     * @param int $transactionId The ID of the transaction.
     * @return bool Success or failure of the operation.
     */
    public function releaseFunds(int $transactionId)
    {
        return $this->update(['transaction_id' => $transactionId], ['status' => 'released']);
    }

    /**
     * Check if a transaction exists for an order.
     *
     * @param int $orderId The ID of the order.
     * @return bool Whether a transaction exists.
     */
    public function transactionExistsForOrder(int $orderId)
    {
        $result = $this->readOne(['order_id' => $orderId]);
        return $result !== false;
    }

    /**
     * Get the total amount of transactions for a user within a date range.
     *
     * @param int $userId The ID of the user.
     * @param string $startDate The start date in YYYY-MM-DD format.
     * @param string $endDate The end date in YYYY-MM-DD format.
     * @param string $type 'sender' or 'receiver' to determine which role the user played.
     * @return float|false The total amount or false on failure.
     */
    public function getTotalAmountByUserIdAndDateRange(int $userId, string $startDate, string $endDate, string $type = 'receiver')
    {
        $field = ($type === 'sender') ? 'sender_id' : 'receiver_id';
        $conditions = [
            $field => $userId,
            'status' => 'released',
            'created_at >=' => $startDate,
            'created_at <=' => $endDate
        ];
        
        $sql = "SELECT SUM(amount) as total FROM {$this->table} WHERE {$field} = :user_id AND status = :status AND created_at >= :start_date AND created_at <= :end_date";
        $params = [
            'user_id' => $userId,
            'status' => 'released',
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
        
        try {
            $result = $this->db->executeWithParams($sql, $params)->fetch(\PDO::FETCH_ASSOC);
            return $result ? (float)$result['total'] : 0.0;
        } catch (\Exception $e) {
            $this->logError($e);
            return false;
        }
    }

    /**
     * Get all transactions that need to be released (hold_until date has passed).
     *
     * @return array|false List of transactions or false on failure.
     */
    public function getPendingReleasableTransactions()
    {
        $now = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM {$this->table} WHERE status = :status AND hold_until <= :now";
        $params = [
            'status' => 'hold',
            'now' => $now
        ];
        
        try {
            return $this->db->executeWithParams($sql, $params)->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $this->logError($e);
            return false;
        }
    }
}