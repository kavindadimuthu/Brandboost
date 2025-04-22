<?php

namespace app\models\Payments;

use app\core\BaseModel;

class BankAccount extends BaseModel
{
    protected $table = 'bank_details';

    /**
     * Add a new bank account
     *
     * @param array $data Bank account data
     * @return bool Success or failure
     */
    public function addBankAccount(array $data)
    {
        return $this->create($data);
    }

    /**
     * Get bank account by ID
     *
     * @param int $id Bank account ID
     * @return array|false Bank account data or false on failure
     */
    public function getBankAccount(int $id)
    {
        return $this->readOne(['id' => $id]);
    }

    /**
     * Get bank accounts by user ID
     *
     * @param int $userId User ID
     * @return array|false Bank accounts or false on failure
     */
    public function getUserBankAccounts(int $userId)
    {
        return $this->read(['user_id' => $userId]);
    }

    /**
     * Update bank account
     *
     * @param int $id Bank account ID
     * @param array $data Updated bank account data
     * @return bool Success or failure
     */
    public function updateBankAccount(int $id, array $data)
    {
        return $this->update(['id' => $id], $data);
    }

    /**
     * Delete bank account
     *
     * @param int $id Bank account ID
     * @return bool Success or failure
     */
    public function deleteBankAccount(int $id)
    {
        return $this->delete(['id' => $id]);
    }

    /**
     * Check if bank account exists
     *
     * @param string $accountNumber Account number
     * @param string $routingNumber Routing number
     * @param int|null $userId Optional user ID
     * @return bool True if exists, false otherwise
     */
    public function isBankAccountExists(string $accountNumber, string $routingNumber, int $userId = null)
    {
        $conditions = [
            'account_number' => $accountNumber,
            'routing_number' => $routingNumber
        ];

        if ($userId !== null) {
            $conditions['user_id'] = $userId;
        }

        return $this->readOne($conditions) !== false;
    }
}
