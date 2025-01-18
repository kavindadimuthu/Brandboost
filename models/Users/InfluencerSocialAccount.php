<?php

namespace app\models\Users;

use app\core\BaseModel;

class InfluencerSocialAccount extends BaseModel
{
    protected $table = 'influencer_social_account';

    /**
     * Retrieves an influencer social account by its account ID.
     *
     * @param int $accountId The ID of the influencer's social account.
     * @return array|false The influencer social account record or false if not found.
     */
    public function getSocialAccountByAccountId(int $accountId)
    {
        return $this->readOne(['account_id' => $accountId]);
    }

    /**
     * Retrieves social accounts by the user ID.
     *
     * @param int $userId The ID of the user.
     * @return array|false List of social accounts or false if not found.
     */
    public function getSocialAccountsByUserId(int $userId)
    {
        return $this->read(['user_id' => $userId]);
    }

    /**
     * Creates a new social account entry.
     *
     * @param array $data The social account data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createSocialAccount(array $data)
    {
        return $this->create($data);
    }

    /**
     * Updates a social account by its ID.
     *
     * @param int $accountId The ID of the social account to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateSocialAccountById(int $accountId, array $data)
    {
        return $this->update(['account_id' => $accountId], $data);
    }

    /**
     * Deletes a social account by its ID.
     *
     * @param int $accountId The ID of the social account to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteSocialAccountById(int $accountId)
    {
        return $this->delete(['account_id' => $accountId]);
    }

    /**
     * Retrieves social accounts by platform.
     *
     * @param string $platform The platform (Instagram, YouTube, TikTok, etc.).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of social accounts or false on failure.
     */
    public function getSocialAccountsByPlatform(string $platform, array $options = [])
    {
        return $this->read(['platform' => $platform], $options);
    }

    /**
     * Searches social accounts by username.
     *
     * @param string $username The username to search for.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of social accounts or false on failure.
     */
    public function searchSocialAccountsByUsername(string $username, array $options = [])
    {
        $options['search'] = $username;
        $options['searchColumns'] = ['username'];
        return $this->read([], $options);
    }
}
