<?php

namespace app\models\Users;

use app\core\BaseModel;


class PendingRegistration extends BaseModel {
    public function create(array $data): bool {
        $sql = "INSERT INTO pending_registrations 
                (email, token, name, password, role, expires_at)
                VALUES (:email, :token, :name, :password, :role, :expires_at)";
                
        return $this->db->prepare($sql)->execute([
            ':email' => $data['email'],
            ':token' => $data['token'],
            ':name' => $data['name'],
            ':password' => $data['password'],
            ':role' => $data['role'],
            ':expires_at' => $data['expires_at']
        ]);
    }

    public function findByToken(string $token): ?array {
        $stmt = $this->db->prepare("SELECT * FROM pending_registrations WHERE token = ?");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function findByEmail(string $email): ?array {
        $stmt = $this->db->prepare("SELECT * FROM pending_registrations WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function delete(int $id): bool {
        return $this->db->prepare("DELETE FROM pending_registrations WHERE id = ?")->execute([$id]);
    }

    public function deleteByEmail(string $email): bool {
        return $this->db->prepare("DELETE FROM pending_registrations WHERE email = ?")->execute([$email]);
    }
}