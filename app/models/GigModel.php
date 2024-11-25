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


    // Delete a gig by ID and user_id
    public function deleteGigByIdAndUserId($id, $userId) {
        $this->db->query('DELETE FROM designer_gig WHERE id = :id AND user_id = :user_id');
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
    
}
