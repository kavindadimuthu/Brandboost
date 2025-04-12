<?php

namespace app\models\Actions;

use app\core\BaseModel;

class EmailVerification extends BaseModel {
    public function create(array $data): bool {
        $sql = "INSERT INTO email_verifications 
                (email, token, expires_at) 
                VALUES (:email, :token, :expires_at)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':email' => $data['email'],
            ':token' => $data['token'],
            ':expires_at' => $data['expires_at']
        ]);
    }

    public function findByToken(string $token): ?array {
        $sql = "SELECT * FROM email_verifications WHERE token = :token";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function delete(int $id): bool {
        $sql = "DELETE FROM email_verifications WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}