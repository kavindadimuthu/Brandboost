<?php

namespace app\models\Actions;

use app\core\BaseModel;

class Verification extends BaseModel
{
    /**
     * Get a list of verification requests with pagination and filtering
     * 
     * @param array $params Query parameters for filtering and pagination
     * @return array|false Array of verification requests or false on failure
     */
        public function getVerificationsList($params = [])
    {
        // Default pagination parameters
        $page = isset($params['page']) ? (int)$params['page'] : 1;
        $perPage = isset($params['perPage']) ? (int)$params['perPage'] : 10;
        $offset = ($page - 1) * $perPage;
        
        // Main query for verification requests with user details
        $mainQuery = "
            (SELECT 
                b.user_id as id, 
                'business' AS type,
                b.business_name AS display_name,
                b.business_type AS identifier,
                NULL AS platform,
                b.updated_at as created_at,
                CONCAT('Business Name: ', b.business_name) AS details_summary,
                b.br_status AS status,
                u.user_id,
                u.name,
                u.email,
                u.profile_picture,
                u.role
             FROM businessman b
             JOIN user u ON b.user_id = u.user_id
             WHERE b.br_status = 'pending')
            
            UNION ALL
            
            (SELECT 
                isa.account_id as id, 
                'social_media' AS type,
                isa.username AS display_name,
                isa.link AS identifier,
                isa.platform,
                isa.created_at,
                CONCAT('Platform: ', isa.platform, ' | Username: ', isa.username) AS details_summary,
                isa.link_status AS status,
                u.user_id,
                u.name,
                u.email,
                u.profile_picture,
                u.role
             FROM influencer_social_account isa
             JOIN user u ON isa.user_id = u.user_id
             WHERE isa.link_status = 'pending')
             
            ORDER BY created_at DESC
            LIMIT :offset, :perPage";
        
        // Execute the main query with pagination
        $results = $this->executeCustomQuery($mainQuery, [
            ':offset' => $offset,
            ':perPage' => $perPage
        ]);
        
        // Count query for pagination metadata
        $countQuery = "
            SELECT SUM(count) as total FROM (
                SELECT COUNT(*) as count FROM businessman WHERE br_status = 'pending'
                UNION ALL
                SELECT COUNT(*) as count FROM influencer_social_account WHERE link_status = 'pending'
            ) as counts";
        
        $totalResult = $this->executeCustomQuery($countQuery, [], false);
        $totalRows = $totalResult['total'] ?? 0;
        $totalPages = ceil($totalRows / $perPage);
        
        // Return both the results and pagination metadata
        return [
            'verifications' => $results,
            'pagination' => [
                'currentPage' => $page,
                'perPage' => $perPage,
                'totalItems' => (int)$totalRows,
                'totalPages' => $totalPages
            ]
        ];
    }
}