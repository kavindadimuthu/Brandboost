<?php

namespace app\models\Users;

use app\core\BaseModel;
use app\core\Helpers\DebugHelper;

class User extends BaseModel
{
    protected $table = 'user'; // Table name for User model

    public function __construct()
    {
        parent::__construct($this->table);
    }

    // Create a new user
    public function createUser($data)
    {
        // Hash the password before inserting it
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        return $this->create($data);
    }

    // Update user details
    public function updateUser($user_id, $data)
    {
        // If password is being updated, hash it
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        return $this->update($user_id, $data, 'user_id');
    }

    // Find user by email
    public function findByEmail($email)
    {
        return $this->findOne($email, 'email');
    }

    // Verify if the provided password matches the hashed password
    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    // Find users by status (active, inactive, suspended)
    public function findByStatus($status)
    {
        return $this->findAll(['account_status' => $status]);
    }

    // Change user account status (active, inactive, suspended)
    public function changeStatus($user_id, $status)
    {
        return $this->update($user_id, ['account_status' => $status], 'user_id');
    }

    // Get all users with a specific role
    public function findByRole($role)
    {
        return $this->findAll(['role' => $role]);
    }

    // Update user profile picture
    public function updateProfilePicture($user_id, $profile_picture)
    {
        return $this->update($user_id, ['profile_picture' => $profile_picture], 'user_id');
    }

    // Update user bio
    public function updateBio($user_id, $bio)
    {
        return $this->update($user_id, ['bio' => $bio], 'user_id');
    }

    // Get all users (with optional filters)
    public function getAllUsers($conditions = [], $orderBy = null, $limit = null)
    {
        return $this->findAll($conditions, $orderBy, $limit);
    }

    // Get the user by their ID
    public function getUserById($user_id)
    {
        return $this->findOne($user_id, 'user_id');
    }
}
