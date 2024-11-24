<?php
class GigModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function createGig($userId, $gigData) {
        try {
            // Ensure delivery_formats and tags are arrays
            $deliveryFormats = is_array($gigData['delivery_formats']) ? $gigData['delivery_formats'] : explode(',', $gigData['delivery_formats']);
            $tags = is_array($gigData['tags']) ? $gigData['tags'] : explode(',', $gigData['tags']);
    
            // Insert common gig details
            $this->db->query("
                INSERT INTO designer_gig (user_id, title, description, delivery_formats, tags) 
                VALUES (:user_id, :title, :description, :delivery_formats, :tags)
            ");
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':title', $gigData['title']);
            $this->db->bind(':description', $gigData['description']);
            $this->db->bind(':delivery_formats', implode(',', $deliveryFormats));
            $this->db->bind(':tags', implode(',', $tags));
            $this->db->execute();
    
            $gigId = $this->db->lastInsertId();

    
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
            INSERT INTO designer_gig_package_details (gig_id, package_type, benefits, delivery_days, revisions, price) 
            VALUES (:gig_id, :package_type, :benefits, :delivery_days, :revisions, :price)
        ");
        $this->db->bind(':gig_id', $gigId);
        $this->db->bind(':package_type', $packageType);
        $this->db->bind(':benefits', $packageDetails['benefits']);
        $this->db->bind(':delivery_days', $packageDetails['delivery_days']);
        $this->db->bind(':revisions', $packageDetails['revisions']);
        $this->db->bind(':price', $packageDetails['price']);
        $this->db->execute();
    }
}
