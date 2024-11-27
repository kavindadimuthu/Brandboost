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


    public function getPromotionsByUserId($userId) {
        $this->db->query('
            SELECT ig.*, igp.*
            FROM influencer_gig ig
            LEFT JOIN influencer_gig_package_details igp ON ig.gig_id = igp.gig_id
            WHERE ig.user_id = :user_id
        ');
        $this->db->bind(':user_id', $userId);
        $results = $this->db->resultSet();
        

        $gigs = [];
        foreach ($results as $result) {
            $gigId = $result->gig_id;
            if (!isset($gigs[$gigId])) {
                $gigs[$gigId] = [
                    'gig_id' => $result->gig_id,
                    'user_id' => $result->user_id,
                    'title' => $result->title,
                    'description' => $result->description,
                    'platform' => $result->platform,
                    'tags' => $result->tags,
                    'packages' => []
                ];
            }
            $gigs[$gigId]['packages'][] = [
                'package_type' => $result->package_type,
                'benefits' => $result->benefits,
                'delivery_days' => $result->delivery_days,
                'price' => $result->price,
                'revisions' => $result->revisions
                
            ];
        }

        return array_values($gigs);
    }


    public function deletePromotionByIdAndUserId($id, $userId) {
        try {
            $this->db->query('DELETE FROM influencer_gig WHERE gig_id = :id AND user_id = :user_id');
            
            // Bind parameters
            $this->db->bind(':id', $id);
            $this->db->bind(':user_id', $userId);
            
            if ($this->db->execute()) {
                return ['status' => 'success', 'message' => 'Promotion deleted successfully.'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to delete the promotion.'];
            }
        } catch (PDOException $e) {
            // Catch any constraint or database-related errors
            return ['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()];
        }
    }
    
}