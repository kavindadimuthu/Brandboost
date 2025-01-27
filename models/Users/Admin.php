<?php

namespace app\models\Users;

use app\core\BaseModel;

class Admin extends BaseModel
{
    protected $table = 'admin';

    /**
     * Retrieves an admin by their ID.
     *
     * @param int $adminId The ID of the admin.
     * @return array|false The admin record or false if not found.
     */
    public function getAdminById(int $adminId)
    {
        return $this->readOne(['admin_id' => $adminId]);
    }

    /**
     * Retrieves an admin by their email.
     *
     * @param string $email The email of the admin.
     * @return array|false The admin record or false if not found.
     */
    public function getAdminByEmail(string $email)
    {
        return $this->readOne(['email' => $email]);
    }

    /**
     * Creates a new admin user.
     *
     * @param array $data The admin data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createAdmin(array $data)
    {
        return $this->create($data);
    }

    /**
     * Updates an admin's details by their ID.
     *
     * @param int $adminId The ID of the admin to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateAdminById(int $adminId, array $data)
    {
        return $this->update(['admin_id' => $adminId], $data);
    }

    /**
     * Deletes an admin by their ID.
     *
     * @param int $adminId The ID of the admin to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteAdminById(int $adminId)
    {
        return $this->delete(['admin_id' => $adminId]);
    }
}
