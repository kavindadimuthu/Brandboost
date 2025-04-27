<?php

namespace app\models\Users;

use app\core\BaseModel;

class PendingUser extends BaseModel
{
    protected $table = 'pending_users';
    protected $primaryKey = 'pending_id';

    /**
     * Create a new pending user record.
     *
     * @param array $data Pending user data
     * @return bool Whether the creation was successful
     */
    public function createPendingUser(array $data)
    {
        return $this->create($data);
    }

    /**
     * Get a pending user by email.
     *
     * @param string $email User email
     * @return array|false Pending user data or false if not found
     */
    public function getByEmail(string $email)
    {
        $query = "SELECT * FROM {$this->table} WHERE email = :email";
        $params = [':email' => $email];
        
        return $this->executeCustomQuery($query, $params);
    }

    /**
     * Get a pending user by verification token.
     *
     * @param string $token Verification token
     * @return array|false Pending user data or false if not found
     */
    public function getByToken(string $token)
    {
        $query = "SELECT * FROM {$this->table} WHERE verification_token = :token";
        $params = [':token' => $token];
        
        return $this->executeCustomQuery($query, $params);
    }

    /**
     * Delete a pending user by email.
     *
     * @param string $email User email
     * @return bool Whether the deletion was successful
     */
    public function deleteByEmail(string $email)
    {
        $query = "DELETE FROM {$this->table} WHERE email = :email";
        $params = [':email' => $email];
        
        return $this->executeCustomQuery($query, $params);
    }

    /**
     * Update verification token and expiry for a pending user.
     *
     * @param string $email User email
     * @param string $token New verification token
     * @param string $expiry New token expiry date/time
     * @return bool Whether the update was successful
     */
    public function updateToken(string $email, string $token, string $expiry)
    {
        $query = "UPDATE {$this->table} 
                  SET verification_token = :token, token_expiry = :expiry 
                  WHERE email = :email";
        $params = [
            ':email' => $email,
            ':token' => $token,
            ':expiry' => $expiry
        ];
        
        return $this->executeCustomQuery($query, $params);
    }

    /**
     * Clean up expired verification tokens.
     *
     * @return bool Whether the cleanup was successful
     */
    public function cleanupExpiredTokens()
    {
        $query = "DELETE FROM {$this->table} WHERE token_expiry < NOW()";
        return $this->executeCustomQuery($query);
    }
}