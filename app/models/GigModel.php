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

    
    public function getGigsByUserId($userId) {
        $this->db->query('
            SELECT dg.*, dgp.*
            FROM designer_gig dg
            LEFT JOIN designer_gig_package_details dgp ON dg.gig_id = dgp.gig_id
            WHERE dg.user_id = :user_id
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
                    'delivery_formats' => $result->delivery_formats,
                    'tags' => $result->tags,
                    'packages' => []
                ];
            }
            $gigs[$gigId]['packages'][] = [
                'package_type' => $result->package_type,
                'benefits' => $result->benefits,
                'delivery_days' => $result->delivery_days,
                'revisions' => $result->revisions,
                'price' => $result->price
            ];
        }

        return array_values($gigs);
    }

    
    public function getGigByGigId($gigId) {
        $this->db->query('
            SELECT dg.*, dgp.*
            FROM designer_gig dg
            LEFT JOIN designer_gig_package_details dgp ON dg.gig_id = dgp.gig_id
            WHERE dg.gig_id = :gig_id
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
            'delivery_formats' => $results[0]->delivery_formats,
            'tags' => $results[0]->tags,
            'packages' => []
        ];

        foreach ($results as $result) {
            $gig['packages'][] = [
                'package_type' => $result->package_type,
                'benefits' => $result->benefits,
                'delivery_days' => $result->delivery_days,
                'revisions' => $result->revisions,
                'price' => $result->price
            ];
        }

        return $gig;
    }


    public function updateGig($gigId, $userId, $gigData) {
        try {
            // Update gig details
            $this->db->query("
                UPDATE designer_gig 
                SET title = :title, description = :description, delivery_formats = :delivery_formats, tags = :tags 
                WHERE gig_id = :gig_id AND user_id = :user_id
            ");
            $this->db->bind(':title', $gigData['title']);
            $this->db->bind(':description', $gigData['description']);
            $this->db->bind(':delivery_formats', implode(',', $gigData['delivery_formats']));
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
            UPDATE designer_gig_package_details 
            SET benefits = :benefits, delivery_days = :delivery_days, revisions = :revisions, price = :price 
            WHERE gig_id = :gig_id AND package_type = :package_type
        ");
        $this->db->bind(':gig_id', $gigId);
        $this->db->bind(':package_type', $packageType);
        $this->db->bind(':benefits', $packageDetails['benefits']);
        $this->db->bind(':delivery_days', $packageDetails['delivery_days']);
        $this->db->bind(':revisions', $packageDetails['revisions']);
        $this->db->bind(':price', $packageDetails['price']);
        $this->db->execute();
    }
    


    public function deleteGigByIdAndUserId($id, $userId) {
        try {
            $this->db->query('DELETE FROM designer_gig WHERE gig_id = :id AND user_id = :user_id');
            
            // Bind parameters
            $this->db->bind(':id', $id);
            $this->db->bind(':user_id', $userId);
            
            if ($this->db->execute()) {
                return ['status' => 'success', 'message' => 'Gig deleted successfully.'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to delete the gig.'];
            }
        } catch (PDOException $e) {
            // Catch any constraint or database-related errors
            return ['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()];
        }
    }


    
}
