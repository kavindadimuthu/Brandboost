<?php

namespace app\models\Services;

use app\core\BaseModel;

class ServiceCustomPackage extends BaseModel
{
    protected $table = 'service_custom_package'; // Specify the database table

    /**
     * Retrieve a custom package by its ID.
     *
     * @param int $customPackageId The ID of the custom package.
     * @return array|false The custom package record or false if not found.
     */
    public function getCustomPackageById(int $customPackageId)
    {
        return $this->readOne(['custom_package_id' => $customPackageId]);
    }

    /**
     * Retrieve custom packages by service ID.
     *
     * @param int $serviceId The ID of the service.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of custom packages or false on failure.
     */
    public function getCustomPackagesByServiceId(int $serviceId, array $options = [])
    {
        return $this->read(['service_id' => $serviceId], $options);
    }

    /**
     * Retrieve custom packages by customer ID.
     *
     * @param int $customerId The ID of the customer.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of custom packages or false on failure.
     */
    public function getCustomPackagesByCustomerId(int $customerId, array $options = [])
    {
        return $this->read(['customer_id' => $customerId], $options);
    }

    /**
     * Retrieve custom packages by seller ID.
     *
     * @param int $sellerId The ID of the seller.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of custom packages or false on failure.
     */
    public function getCustomPackagesBySellerId(int $sellerId, array $options = [])
    {
        return $this->read(['seller_id' => $sellerId], $options);
    }

    /**
     * Create a new custom service package.
     *
     * @param array $data The custom package data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createCustomPackage(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update a custom package by its ID.
     *
     * @param int $customPackageId The ID of the custom package to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateCustomPackageById(int $customPackageId, array $data)
    {
        return $this->update(['custom_package_id' => $customPackageId], $data);
    }

    /**
     * Delete a custom package by its ID.
     *
     * @param int $customPackageId The ID of the custom package to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteCustomPackageById(int $customPackageId)
    {
        return $this->delete(['custom_package_id' => $customPackageId]);
    }

    /**
     * Retrieve custom packages created within a specific time frame.
     *
     * @param string $startDate The start date in Y-m-d format.
     * @param string $endDate The end date in Y-m-d format.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of custom packages or false on failure.
     */
    public function getCustomPackagesByDateRange(string $startDate, string $endDate, array $options = [])
    {
        $conditions = [
            'created_at >=' => $startDate,
            'created_at <=' => $endDate
        ];
        return $this->read($conditions, $options);
    }

    /**
     * Retrieve custom packages with service details.
     * 
     * @param array $conditions Key-value pairs for the WHERE clause.
     * @param array $options Additional options like order, limit, offset, search, and filters.
     * @return array|false Fetched records or false on failure.
     */
    public function getCustomPackagesWithServiceDetails(array $conditions = [], array $options = [])
    {
        try {
            // Start building the base query
            $sql = "SELECT scp.*, s.title AS service_title, s.description AS service_description, 
                    s.cover_image AS service_cover_image
                    FROM {$this->table} scp
                    JOIN service s ON scp.service_id = s.service_id";
    
            // Build WHERE clause
            if (!empty($conditions)) {
                $whereClauses = [];
                foreach ($conditions as $key => $value) {
                    $whereClauses[] = "scp.$key = :$key";
                }
                $sql .= " WHERE " . implode(" AND ", $whereClauses);
            }
    
            // Add ORDER BY if specified
            if (!empty($options['order'])) {
                $sql .= " ORDER BY " . $options['order'];
            }
    
            // Add LIMIT and OFFSET if specified
            if (isset($options['limit'])) {
                $sql .= " LIMIT " . (int)$options['limit'];
                if (isset($options['offset'])) {
                    $sql .= " OFFSET " . (int)$options['offset'];
                }
            }
    
            // Execute the query with parameters
            return $this->executeCustomQuery($sql, $conditions);
            
    
        } catch (\Exception $e) {
            error_log("Error in getCustomPackagesWithServiceDetails: " . $e->getMessage());
            return false;
        }
    }
}
