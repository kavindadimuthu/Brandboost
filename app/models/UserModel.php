<?php
// FILE: app/models/UserModel.php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function registerUser( $firstName, $lastName, $email, $phone, $password, $role, $gender) {
        $this->db->query("INSERT INTO users (first_name, last_name, email, phone, password, role, gender) VALUES (:firstName, :lastName, :email, :phone, :password, :role, :gender)");
        $this->db->bind(':firstName', $firstName);
        $this->db->bind(':lastName', $lastName);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':password', password_hash($password, PASSWORD_BCRYPT)); // Hash the password
        $this->db->bind(':role', $role);
        $this->db->bind(':gender', $gender);
        return $this->db->execute();
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $this->db->query($query);
        $this->db->bind(':email', $email);
        return $this->db->single(); // Fetch a single user record
    }
}