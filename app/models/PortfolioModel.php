<?php
class PortfolioModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function createPortfolio($userId, $portfolioData) {
        try {
            // Prepare SQL query
            $this->db->query("
                INSERT INTO designer_portfolio (user_id, title, description, images) 
                VALUES (:user_id, :title, :description, :images)
            ");

            // Bind values
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':title', $portfolioData['title']);
            $this->db->bind(':description', $portfolioData['description']);
            $this->db->bind(':images', implode(',', $portfolioData['images'])); // Convert images array to a comma-separated string

            // Execute query
            $this->db->execute();

            return [
                'status' => 'success',
                'message' => 'Portfolio created successfully.',
                'portfolio_id' => $this->db->lastInsertId()
            ];
        } catch (PDOException $e) {
            error_log("Portfolio creation failed: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to create portfolio.'];
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
