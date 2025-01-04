<?php
use app\core\BaseModel;

class PromotionModel extends BaseModel {
    public function __construct() {
        parent::__construct(); // Initialize the database connection from BaseModel
    }

    public function createPromotion($userId, $promotionData) {
        try {
            // Convert platforms to array if string
            $platforms = is_array($promotionData['platforms']) ? $promotionData['platforms'] : explode(',', $promotionData['platforms']);
            
            // Convert tags to array if string
            $tags = is_array($promotionData['tags']) ? $promotionData['tags'] : explode(',', $promotionData['tags']);
     
            // Insert promotion
            $this->db->query("
                INSERT INTO service (
                    user_id, title, description, cover_image, media, service_type, platforms, tags
                ) 
                VALUES (
                    :user_id, :title, :description, :cover_image, :media, :service_type, :platforms, :tags
                )
            ");
     
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':title', $promotionData['title']);
            $this->db->bind(':description', $promotionData['description']);
            $this->db->bind(':cover_image', $promotionData['cover_image']);
            $this->db->bind(':media', $promotionData['media']);
            $this->db->bind(':service_type', 'promotion');
            $this->db->bind(':platforms', implode(',', $platforms));
            $this->db->bind(':tags', implode(',', $tags));
     
            $this->db->execute();
            $promotionId = $this->db->lastInsertId();
     
            // Insert basic and premium packages
            $this->insertPackage($promotionId, 'basic', $promotionData['basic']);
            $this->insertPackage($promotionId, 'premium', $promotionData['premium']);
     
            return true;
     
        } catch (PDOException $e) {
            error_log("Promotion creation failed: " . $e->getMessage());
            return false;
        }
     }

    private function insertPackage($promotionId, $packageType, $packageDetails) {
        $this->db->query("
            INSERT INTO service_package (service_id, package_type, benefits, delivery_days, revisions, price) 
            VALUES (:promotion_id, :package_type, :benefits, :delivery_days, :revisions, :price)
        ");
        $this->db->bind(':promotion_id', $promotionId);
        $this->db->bind(':package_type', $packageType);
        $this->db->bind(':benefits', $packageDetails['benefits']);
        $this->db->bind(':delivery_days', $packageDetails['delivery_days']);
        $this->db->bind(':revisions', $packageDetails['revisions']);
        $this->db->bind(':price', $packageDetails['price']);
        
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

    public function getGigByGigId($gigId) {
        $this->db->query('
            SELECT ig.*, igp.*
            FROM influencer_gig ig
            LEFT JOIN influencer_gig_package_details igp ON ig.gig_id = igp.gig_id
            WHERE ig.gig_id = :gig_id
        ');
        $this->db->bind(':gig_id', $gigId);
        $results = $this->db->resultSet();

        if (empty($results)) {
            return null;
        }

        $gig = [
            'gig_id' => $results[0]->gig_id,
            'user_id' => $results[0]->user_id,
            'title' => $results[0]->title,
            'description' => $results[0]->description,
            'platform' => $results[0]->platform,
            'tags' => $results[0]->tags,
            'packages' => []
        ];

        foreach ($results as $result) {
            $gig['packages'][] = [
                'package_type' => $result->package_type,
                'benefits' => $result->benefits,
                'delivery_days' => $result->delivery_days,
                'price' => $result->price,
                'revisions' => $result->revisions
                
            ];
        }

        return $gig;
    }


    public function updateGig($gigId, $userId, $gigData) {
        try {
            // Update gig details
            $this->db->query("
                UPDATE influencer_gig 
                SET title = :title, description = :description, platform = :platform, tags = :tags 
                WHERE gig_id = :gig_id AND user_id = :user_id
            ");
            $this->db->bind(':title', $gigData['title']);
            $this->db->bind(':description', $gigData['description']);
            $this->db->bind(':platform', implode(',', $gigData['platform']));
            $this->db->bind(':tags', implode(',', $gigData['tags']));
            $this->db->bind(':gig_id', $gigId);
            $this->db->bind(':user_id', $userId);
            $this->db->execute();
    
            // Update basic and premium packages
            foreach (['basic', 'premium'] as $packageType) {
                $this->updateGigPackage($gigId, $packageType, $gigData[$packageType]);
            }
    
            return ['status' => 'success', 'message' => 'Gig updated successfully.'];
        } catch (PDOException $e) {
            error_log("Error updating gig: " . $e->getMessage());
            return ['status' => 'error', 'message' => 'Failed to update the gig.'];
        }
    }
    
    private function updateGigPackage($gigId, $packageType, $packageDetails) {
        $this->db->query("
            UPDATE influencer_gig_package_details 
            SET benefits = :benefits, delivery_days = :delivery_days, price = :price , revisions = :revisions 
            WHERE gig_id = :gig_id AND package_type = :package_type
        ");
        $this->db->bind(':gig_id', $gigId);
        $this->db->bind(':package_type', $packageType);
        $this->db->bind(':benefits', $packageDetails['benefits']);
        $this->db->bind(':delivery_days', $packageDetails['delivery_days']);
        $this->db->bind(':price', $packageDetails['price']);
        $this->db->bind(':revisions', $packageDetails['revisions']);
        
        $this->db->execute();
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
