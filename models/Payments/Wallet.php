<?php

namespace app\models\Payments;

use app\core\BaseModel;

class Wallet extends BaseModel
{
    protected $table = 'wallet'; // Specify the database table

    /**
     * Retrieve a wallet by its ID.
     *
     * @param int $walletId The ID of the wallet.
     * @return array|false The wallet record or false if not found.
     */
    public function getWalletById(int $walletId)
    {
        return $this->readOne(['wallet_id' => $walletId]);
    }

    /**
     * Retrieve a wallet by seller ID.
     *
     * @param int $sellerId The ID of the seller.
     * @return array|false The wallet record or false if not found.
     */
    public function getWalletBySellerId(int $sellerId)
    {
        return $this->readOne(['seller_id' => $sellerId]);
    }

    /**
     * Create a new wallet for a seller.
     *
     * @param int $sellerId The ID of the seller.
     * @param float $initialBalance The initial balance (default: 0.00).
     * @param string $currency The currency code (default: USD).
     * @return bool Success or failure of the operation.
     */
    public function createWallet(int $sellerId, float $initialBalance = 0.00, string $currency = 'USD')
    {
        $data = [
            'seller_id' => $sellerId,
            'balance' => $initialBalance,
            'currency' => $currency
        ];
        return $this->create($data);
    }

    /**
     * Update a wallet's balance by seller ID.
     *
     * @param int $sellerId The ID of the seller.
     * @param float $amount The amount to add (positive) or subtract (negative).
     * @return bool Success or failure of the operation.
     */
    public function updateWalletBalance(int $sellerId, float $amount)
    {
        // First get the current wallet
        $wallet = $this->getWalletBySellerId($sellerId);
        
        if (!$wallet) {
            return false;
        }
        
        // Calculate new balance
        $newBalance = $wallet['balance'] + $amount;
        
        // Ensure balance doesn't go negative
        if ($newBalance < 0) {
            return false;
        }
        
        // Update the wallet
        return $this->update(['seller_id' => $sellerId], ['balance' => $newBalance]);
    }

    /**
     * Check if a seller has sufficient balance.
     *
     * @param int $sellerId The ID of the seller.
     * @param float $requiredAmount The amount to check against.
     * @return bool Whether the seller has sufficient balance.
     */
    public function hasSufficientBalance(int $sellerId, float $requiredAmount)
    {
        $wallet = $this->getWalletBySellerId($sellerId);
        return $wallet && $wallet['balance'] >= $requiredAmount;
    }

    /**
     * Transfer funds between wallets.
     *
     * @param int $fromSellerId The ID of the sender.
     * @param int $toSellerId The ID of the receiver.
     * @param float $amount The amount to transfer.
     * @return bool Success or failure of the operation.
     */
    public function transferFunds(int $fromSellerId, int $toSellerId, float $amount)
    {
        // Start transaction
        $this->db->beginTransaction();
        
        try {
            // Deduct from sender
            $senderSuccess = $this->updateWalletBalance($fromSellerId, -$amount);
            
            if (!$senderSuccess) {
                $this->db->rollBack();
                return false;
            }
            
            // Add to receiver
            $receiverSuccess = $this->updateWalletBalance($toSellerId, $amount);
            
            if (!$receiverSuccess) {
                $this->db->rollBack();
                return false;
            }
            
            // Commit transaction
            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollBack();
            $this->logError($e);
            return false;
        }
    }

    /**
     * Check if a wallet exists for a seller.
     *
     * @param int $sellerId The ID of the seller.
     * @return bool Whether a wallet exists.
     */
    public function walletExists(int $sellerId)
    {
        $result = $this->readOne(['seller_id' => $sellerId]);
        return $result !== false;
    }

    /**
     * Get the total balance of all wallets.
     *
     * @return float|false The total balance or false on failure.
     */
    public function getTotalSystemBalance()
    {
        $sql = "SELECT SUM(balance) as total FROM {$this->table}";
        
        try {
            $result = $this->db->executeWithParams($sql)->fetch(\PDO::FETCH_ASSOC);
            return $result ? (float)$result['total'] : 0.0;
        } catch (\Exception $e) {
            $this->logError($e);
            return false;
        }
    }

    /**
     * Get wallets with balance greater than specified amount.
     *
     * @param float $minBalance The minimum balance to filter by.
     * @return array|false List of wallets or false on failure.
     */
    public function getWalletsWithMinimumBalance(float $minBalance)
    {
        $sql = "SELECT * FROM {$this->table} WHERE balance >= :min_balance";
        $params = ['min_balance' => $minBalance];
        
        try {
            return $this->db->executeWithParams($sql, $params)->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $this->logError($e);
            return false;
        }
    }
}