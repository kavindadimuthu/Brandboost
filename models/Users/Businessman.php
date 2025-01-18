<?php

namespace app\models\Users;

use app\core\BaseModel;

class Businessman extends BaseModel
{
    protected $table = 'businessman';

    /**
     * Retrieves a business registration by the user ID.
     *
     * @param int $userId The ID of the user.
     * @return array|false The businessman record or false if not found.
     */
    public function getBusinessRegistrationByUserId(int $userId)
    {
        return $this->readOne(['user_id' => $userId]);
    }

    /**
     * Creates a new business registration.
     *
     * @param array $data The business registration data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createBusinessRegistration(array $data)
    {
        return $this->create($data);
    }

    /**
     * Updates a business registration by the user ID.
     *
     * @param int $userId The ID of the user to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateBusinessRegistrationByUserId(int $userId, array $data)
    {
        return $this->update(['user_id' => $userId], $data);
    }

    /**
     * Deletes a business registration by the user ID.
     *
     * @param int $userId The ID of the user to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteBusinessRegistrationByUserId(int $userId)
    {
        return $this->delete(['user_id' => $userId]);
    }

    /**
     * Retrieves business registrations by their BR status.
     *
     * @param string $status The BR status (pending, approved, rejected).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of businessman records or false on failure.
     */
    public function getBusinessRegistrationsByStatus(string $status, array $options = [])
    {
        return $this->read(['br_status' => $status], $options);
    }
}
