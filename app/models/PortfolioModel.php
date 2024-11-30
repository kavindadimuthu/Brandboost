<?php
class PortfolioModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function createPortfolio($userId, $portfolioData) {
        try {
            $this->db->query("
                INSERT INTO designer_portfolio (user_id, title, description, cover_image, first_image, second_image, third_image, fourth_image) 
                VALUES (:user_id, :title, :description, :cover_image, :first_image, :second_image, :third_image, :fourth_image)
            ");
    
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':title', $portfolioData['title']);
            $this->db->bind(':description', $portfolioData['description']);
            $this->db->bind(':cover_image', $portfolioData['cover_image']);
            $this->db->bind(':first_image', $portfolioData['first_image'] ?? null); // Use null if not set
            $this->db->bind(':second_image', $portfolioData['second_image'] ?? null); // Use null if not set
            $this->db->bind(':third_image', $portfolioData['third_image'] ?? null); // Use null if not set
            $this->db->bind(':fourth_image', $portfolioData['fourth_image'] ?? null); // Use null if not set
    
            $this->db->execute();
    
            return $this->db->lastInsertId(); // Return the ID of the newly inserted portfolio
        } catch (PDOException $e) {
            error_log("Portfolio creation failed: " . $e->getMessage());
            return false;
        }
    }
    


    public function getPortfolioByUserId($userId) {
        try {
            $this->db->query("
                SELECT title, description, cover_image, first_image, second_image, third_image, fourth_image
                FROM designer_portfolio 
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $userId);
            return $this->db->single();
        } catch (PDOException $e) {
            error_log("Error fetching portfolio: " . $e->getMessage());
            return false; // Return false on error
        }
    }

    

    public function updatePortfolio($userId, $title, $description, $coverImage, $firstImage, $secondImage, $thirdImage, $fourthImage) {
        try {
            $this->db->query("
                UPDATE designer_portfolio SET
                title = :title,
                description = :description,
                cover_image = :cover_image,
                first_image = :first_image,
                second_image = :second_image,
                third_image = :third_image,
                fourth_image = :fourth_image
                WHERE user_id = :user_id
            ");
    
            // Bind parameters with validation to prevent SQL injection
            $this->db->bind(':title', $title);
            $this->db->bind(':description', $description);
            $this->db->bind(':cover_image', $coverImage !== null ? $coverImage : $existingPortfolio['cover_image']);
            $this->db->bind(':first_image', $firstImage !== null ? $firstImage : $existingPortfolio['first_image']);
            $this->db->bind(':second_image', $secondImage !== null ? $secondImage : $existingPortfolio['second_image']);
            $this->db->bind(':third_image', $thirdImage !== null ? $thirdImage : $existingPortfolio['third_image']);
            $this->db->bind(':fourth_image', $fourthImage !== null ? $fourthImage : $existingPortfolio['fourth_image']);
            $this->db->bind(':user_id', $userId);
    
            // Execute the query
            return $this->db->execute();
        } catch (PDOException $e) {
            error_log("Error updating portfolio: " . $e->getMessage());
            return false;
        }
    }
    
    

    public function deletePortfolioByUserId( $userId) {
        try {
            $this->db->query("
                DELETE FROM designer_portfolio 
                WHERE user_id = :user_id
            ");
            $this->db->bind(':user_id', $userId);
            $this->db->execute();

            return ['status' => 'success', 'message' => 'Portfolio deleted successfully.'];
        } catch (PDOException $e) {
            error_log("Portfolio deletion failed: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to delete portfolio.'];
        }
    }
}
