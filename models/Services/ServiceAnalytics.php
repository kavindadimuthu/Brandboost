<?php

namespace app\models\Services;

use app\core\BaseModel;

class ServiceAnalytics extends BaseModel
{
    protected $table = 'service_analytics'; // Specify the database table

    /**
     * Retrieve analytics data by its ID.
     *
     * @param int $analyticsId The ID of the analytics record.
     * @return array|false The analytics record or false if not found.
     */
    public function getAnalyticsById(int $analyticsId)
    {
        return $this->readOne(['analytics_id' => $analyticsId]);
    }

    /**
     * Retrieve analytics data by service ID.
     *
     * @param int $serviceId The ID of the service.
     * @return array|false The analytics record or false if not found.
     */
    public function getAnalyticsByServiceId(int $serviceId)
    {
        return $this->readOne(['service_id' => $serviceId]);
    }

    /**
     * Create a new analytics record.
     *
     * @param array $data The analytics data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createAnalytics(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update analytics data by its ID.
     *
     * @param int $analyticsId The ID of the analytics record to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateAnalyticsById(int $analyticsId, array $data)
    {
        return $this->update(['analytics_id' => $analyticsId], $data);
    }

    /**
     * Delete an analytics record by its ID.
     *
     * @param int $analyticsId The ID of the analytics record to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteAnalyticsById(int $analyticsId)
    {
        return $this->delete(['analytics_id' => $analyticsId]);
    }

    /**
     * Retrieve services with the highest views.
     *
     * @param int $limit The number of top services to retrieve.
     * @return array|false List of services or false on failure.
     */
    public function getTopViewedServices(int $limit = 10)
    {
        $options = [
            'order' => ['views DESC'],
            'limit' => $limit
        ];
        return $this->read([], $options);
    }

    /**
     * Retrieve services with the highest clicks.
     *
     * @param int $limit The number of top services to retrieve.
     * @return array|false List of services or false on failure.
     */
    public function getTopClickedServices(int $limit = 10)
    {
        $options = [
            'order' => ['clicks DESC'],
            'limit' => $limit
        ];
        return $this->read([], $options);
    }

    /**
     * Retrieve services with the highest revenue.
     *
     * @param int $limit The number of top services to retrieve.
     * @return array|false List of services or false on failure.
     */
    public function getTopRevenueServices(int $limit = 10)
    {
        $options = [
            'order' => ['revenue DESC'],
            'limit' => $limit
        ];
        return $this->read([], $options);
    }

    /**
     * Retrieve the average rating of a service.
     *
     * @param int $serviceId The ID of the service.
     * @return float|false The average rating or false on failure.
     */
    public function getAverageRatingByServiceId(int $serviceId)
    {
        $query = "SELECT AVG(rating) as average_rating FROM {$this->table} WHERE service_id = :service_id";
        $result = $this->db->executeWithParams($query, ['service_id' => $serviceId])->fetch();
        return $result ? (float)$result['average_rating'] : false;
    }
}
