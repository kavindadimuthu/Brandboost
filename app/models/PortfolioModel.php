<?php
class PortfolioModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function createPortfolio($userId, $portfolioData) {
        try {
            $this->db->query("
                INSERT INTO designer_portfolio (user_id, title, description, cover_image, other_images) 
                VALUES (:user_id, :title, :description, :cover_image, :other_images)
            ");
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':title', $portfolioData['title']);
            $this->db->bind(':description', $portfolioData['description']);
            $this->db->bind(':cover_image', $portfolioData['cover_image']);
            $this->db->bind(':other_images', $portfolioData['other_images']);
            $this->db->execute();
    
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Portfolio creation failed: " . $e->getMessage());
            return false;
        }
    }


    public function getPortfoliosByUserId($userId) {
        $this->db->query("
            SELECT * 
            FROM designer_portfolio 
            WHERE user_id = :user_id
        ");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getPortfolioById($portfolioId) {
        $this->db->query("
            SELECT * 
            FROM designer_portfolio 
            WHERE portfolio_id = :portfolio_id
        ");
        $this->db->bind(':portfolio_id', $portfolioId);
        return $this->db->single();
    }

    public function updatePortfolio($portfolioId, $userId, $portfolioData) {
        try {
            $this->db->query("
                UPDATE designer_portfolio 
                SET title = :title, description = :description, images = :images 
                WHERE portfolio_id = :portfolio_id AND user_id = :user_id
            ");
            $this->db->bind(':title', $portfolioData['title']);
            $this->db->bind(':description', $portfolioData['description']);
            $this->db->bind(':images', implode(',', $portfolioData['images']));
            $this->db->bind(':portfolio_id', $portfolioId);
            $this->db->bind(':user_id', $userId);
            $this->db->execute();

            return ['status' => 'success', 'message' => 'Portfolio updated successfully.'];
        } catch (PDOException $e) {
            error_log("Portfolio update failed: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to update portfolio.'];
        }
    }

    public function deletePortfolioByIdAndUserId($portfolioId, $userId) {
        try {
            $this->db->query("
                DELETE FROM designer_portfolio 
                WHERE portfolio_id = :portfolio_id AND user_id = :user_id
            ");
            $this->db->bind(':portfolio_id', $portfolioId);
            $this->db->bind(':user_id', $userId);
            $this->db->execute();

            return ['status' => 'success', 'message' => 'Portfolio deleted successfully.'];
        } catch (PDOException $e) {
            error_log("Portfolio deletion failed: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to delete portfolio.'];
        }
    }
}
