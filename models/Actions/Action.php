<?php

namespace app\models\Actions;

use app\core\BaseModel;

class Action extends BaseModel
{
    protected $table = 'action'; // Specify the database table

    /**
     * Retrieve an action by its ID.
     *
     * @param int $actionId The ID of the action.
     * @return array|false The action record or false if not found.
     */
    public function getActionById(int $actionId)
    {
        return $this->readOne(['action_id' => $actionId]);
    }

    /**
     * Retrieve actions by admin ID.
     *
     * @param int $adminId The ID of the admin.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of actions or false on failure.
     */
    public function getActionsByAdminId(int $adminId, array $options = [])
    {
        return $this->read(['admin_id' => $adminId], $options);
    }

    /**
     * Retrieve actions related to a specific user.
     *
     * @param int $userId The ID of the user.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of actions or false on failure.
     */
    public function getActionsByUserId(int $userId, array $options = [])
    {
        return $this->read(['user_id' => $userId], $options);
    }

    /**
     * Retrieve actions related to a specific order.
     *
     * @param int $orderId The ID of the order.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of actions or false on failure.
     */
    public function getActionsByOrderId(int $orderId, array $options = [])
    {
        return $this->read(['order_id' => $orderId], $options);
    }

    /**
     * Retrieve actions by their type (e.g., banned, blocked, reversed, canceled).
     *
     * @param string $actionType The type of the action.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of actions or false on failure.
     */
    public function getActionsByType(string $actionType, array $options = [])
    {
        return $this->read(['action_type' => $actionType], $options);
    }

    /**
     * Create a new action.
     *
     * @param array $data The action data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createAction(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update an action by its ID.
     *
     * @param int $actionId The ID of the action to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateActionById(int $actionId, array $data)
    {
        return $this->update(['action_id' => $actionId], $data);
    }

    /**
     * Delete an action by its ID.
     *
     * @param int $actionId The ID of the action to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteActionById(int $actionId)
    {
        return $this->delete(['action_id' => $actionId]);
    }

    /**
     * Search actions by action note content.
     *
     * @param string $searchTerm The search term to look for in action notes.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of actions or false on failure.
     */
    public function searchActionsByNote(string $searchTerm, array $options = [])
    {
        $options['search'] = $searchTerm;
        $options['searchColumns'] = ['action_note'];
        return $this->read([], $options);
    }
}
