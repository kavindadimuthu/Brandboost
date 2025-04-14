<?php

namespace app\models\Transactions;

use app\core\BaseModel;

class Transactions extends BaseModel
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
     * Retrieve transactions by customer ID.
     *
     * @param int $customerId The ID of the customer.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByCustomerId(int $customerId, array $options = [])
    {
        return $this->read(['customer_id' => $customerId], $options);
    }

    /**
     * Retrieve transactions by designer ID.
     *
     * @param int $designerId The ID of the designer.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByDesignerId(int $designerId, array $options = [])
    {
        return $this->read(['designer_id' => $designerId], $options);
    }

    /**
     * Retrieve transactions by influencer ID.
     *
     * @param int $influencerId The ID of the influencer.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByInfluencerId(int $influencerId, array $options = [])
    {
        return $this->read(['influencer_id' => $influencerId], $options);
    }

    /**
     * Retrieve transactions by order ID.
     *
     * @param int $orderId The ID of the order associated with the transaction.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByOrderId(int $orderId, array $options = [])
    {
        return $this->read(['order_id' => $orderId], $options);
    }

    /**
     * Retrieve transactions by status.
     *
     * @param string $status The status of the transaction (e.g., pending, completed, failed).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByStatus(string $status, array $options = [])
    {
        return $this->read(['transaction_status' => $status], $options);
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
     * Delete a transaction by its ID.
     *
     * @param int $transactionId The ID of the transaction to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteTransactionById(int $transactionId)
    {
        return $this->delete(['transaction_id' => $transactionId]);
    }

    /**
     * Retrieve transactions within a date range.
     *
     * @param string $startDate The start date in YYYY-MM-DD format.
     * @param string $endDate The end date in YYYY-MM-DD format.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByDateRange(string $startDate, string $endDate, array $options = [])
    {
        $conditions = [
            'created_at >=' => $startDate,
            'created_at <=' => $endDate
        ];
        return $this->read($conditions, $options);
    }

    /**
     * Retrieve transactions by payment method.
     *
     * @param string $paymentMethod The payment method (e.g., credit_card, paypal, stripe).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByPaymentMethod(string $paymentMethod, array $options = [])
    {
        return $this->read(['payment_method' => $paymentMethod], $options);
    }

    /**
     * Retrieve transactions by recipient type (designer or influencer).
     *
     * @param string $recipientType The type of recipient ('designer' or 'influencer').
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of transactions or false on failure.
     */
    public function getTransactionsByRecipientType(string $recipientType, array $options = [])
    {
        return $this->read(['recipient_type' => $recipientType], $options);
    }
}