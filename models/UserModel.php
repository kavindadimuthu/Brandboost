<?php

namespace app\models;

use app\core\BaseModel;

class UserModel extends BaseModel {
    public function __construct() {
        parent::__construct(); // Initialize the database connection from BaseModel
    }

    // Create a new user
    public function createUser($name, $email, $password, $role = 'businessman', $profilePicture = null, $bio = null) {
        $sql = "INSERT INTO user (name, email, password, profile_picture, bio, role, account_status, created_at, updated_at) 
                VALUES (:name, :email, :password, :profile_picture, :bio, :role, 'active', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $params = [
            ':name' => $name,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':profile_picture' => $profilePicture,
            ':bio' => $bio,
            ':role' => $role
        ];
        return $this->db->executeWithParams($sql, $params);
    }

    // Get user by ID
    public function getUserById($userId) {
        $sql = "SELECT * FROM user WHERE user_id = :user_id";
        $params = [':user_id' => $userId];
        return $this->db->executeWithParams($sql, $params) ? $this->db->single() : null;
    }

    // Get user by email
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM user WHERE email = :email";
        $params = [':email' => $email];
        return $this->db->executeWithParams($sql, $params) ? $this->db->single() : null;
    }

    // Get admin by ID
    public function getAdminById($adminId) {
        $sql = "SELECT * FROM admin WHERE admin_id = :admin_id";
        $params = [':admin_id' => $adminId];
        return $this->db->executeWithParams($sql, $params) ? $this->db->single() : null;
    }

    // Get admin by email
    public function getAdminByEmail($email) {
        $sql = "SELECT * FROM admin WHERE email = :email";
        $params = [':email' => $email];
        return $this->db->executeWithParams($sql, $params) ? $this->db->single() : null;
    }

    // Update user information
    public function updateUser($userId, $updates) {
        $fields = [];
        $params = [':user_id' => $userId];

        foreach ($updates as $key => $value) {
            $fields[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        if (empty($fields)) {
            return false; // No fields to update
        }

        $sql = "UPDATE user SET " . implode(', ', $fields) . ", updated_at = CURRENT_TIMESTAMP WHERE user_id = :user_id";
        return $this->db->executeWithParams($sql, $params);
    }

    // Delete user
    public function deleteUser($userId) {
        $sql = "DELETE FROM user WHERE user_id = :user_id";
        $params = [':user_id' => $userId];
        return $this->db->executeWithParams($sql, $params);
    }

    // Fetch all users with optional filters
    public function getUsers($filters = []) {
        $sql = "SELECT * FROM user";
        $params = [];

        if (!empty($filters)) {
            $conditions = [];
            foreach ($filters as $key => $value) {
                $conditions[] = "$key = :$key";
                $params[":$key"] = $value;
            }
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        return $this->db->executeWithParams($sql, $params) ? $this->db->resultSet() : [];
    }

    // Check if email exists
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
        $params = [':email' => $email];
        return $this->db->executeWithParams($sql, $params) ? $this->db->fetchColumn() > 0 : false;
    }
}
