<?php
class PromotionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function createPackage($userId, $gigData) {

    
        try {
            
            // echo "Creating package for user $userId";
            // Ensure platforms and tags are arrays
            $platforms = is_array($gigData['platforms']) ? $gigData['platforms'] : explode(',', $gigData['platforms']);
            $tags = is_array($gigData['tags']) ? $gigData['tags'] : explode(',', $gigData['tags']);
    
            // var_dump($platforms);
            // var_dump($tags);
            // Insert common gig details
            $this->db->query("
                INSERT INTO influencer_gig (user_id, title, description, platform, tags) 
                VALUES (:user_id, :title, :description, :platforms, :tags)
            ");
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':title', $gigData['title']);
            $this->db->bind(':description', $gigData['description']);
            $this->db->bind(':platforms', implode(',', $platforms));
            $this->db->bind(':tags', implode(',', $tags));
            $this->db->execute();
    
            $gigId = $this->db->lastInsertId();

            echo "Package created for user $userId with gig ID $gigId";

            var_dump($gigId);

    
            // Insert basic and premium packages
            $this->insertGigPackage($gigId, 'basic', $gigData['basic']);
            $this->insertGigPackage($gigId, 'premium', $gigData['premium']);
    
            return true;
        } catch (PDOException $e) {
            error_log("Gig creation failed: " . $e->getMessage());
            return false;
        }
    }
    

    private function insertGigPackage($gigId, $packageType, $packageDetails) {
        $this->db->query("
            INSERT INTO influencer_gig_package_details (gig_id, package_type, benefits, delivery_days, price, revisions) 
            VALUES (:gig_id, :package_type, :benefits, :delivery_days, :price, :revisions)
        ");
        $this->db->bind(':gig_id', $gigId);
        $this->db->bind(':package_type', $packageType);
        $this->db->bind(':benefits', $packageDetails['benefits']);
        $this->db->bind(':delivery_days', $packageDetails['delivery_days']);
        $this->db->bind(':price', $packageDetails['price']);
        $this->db->bind(':revisions', $packageDetails['revisions']);
        
        $this->db->execute();
    }
}
