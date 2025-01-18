<?php

namespace app\models\Services;

use app\core\BaseModel;

class Service extends BaseModel
{
    protected $table = 'service'; // Specify the database table

    /**
     * Retrieve a service by its ID.
     *
     * @param int $serviceId The ID of the service.
     * @return array|false The service record or false if not found.
     */
    public function getServiceById(int $serviceId)
    {
        return $this->readOne(['service_id' => $serviceId]);
    }

    /**
     * Retrieve services by their type.
     *
     * @param string $type The type of the service (e.g., 'gig', 'promotion').
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of services or false on failure.
     */
    public function getServicesByType(string $type, array $options = [])
    {
        return $this->read(['service_type' => $type], $options);
    }

    /**
     * Retrieve services by a specific user.
     *
     * @param int $userId The ID of the user.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of services or false on failure.
     */
    public function getServicesByUser(int $userId, array $options = [])
    {
        return $this->read(['user_id' => $userId], $options);
    }

    /**
     * Search services by their title.
     *
     * @param string $searchTerm The search term for titles.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of services or false on failure.
     */
    public function searchServicesByTitle(string $searchTerm, array $options = [])
    {
        $options['search'] = $searchTerm;
        $options['searchColumns'] = ['title'];
        return $this->read([], $options);
    }

    /**
     * Create a new service.
     *
     * @param array $data The service data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createService(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update a service by its ID.
     *
     * @param int $serviceId The ID of the service to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateServiceById(int $serviceId, array $data)
    {
        return $this->update(['service_id' => $serviceId], $data);
    }

    /**
     * Delete a service by its ID.
     *
     * @param int $serviceId The ID of the service to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteServiceById(int $serviceId)
    {
        return $this->delete(['service_id' => $serviceId]);
    }

    /**
     * Retrieve services by their platform.
     *
     * @param string $platform The platform of the services.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of services or false on failure.
     */
    public function getServicesByPlatform(string $platform, array $options = [])
    {
        $options['search'] = $platform;
        $options['searchColumns'] = ['platforms'];
        return $this->read([], $options);
    }

    /**
     * Retrieve services by their tags.
     *
     * @param string $tag The tag to search for.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of services or false on failure.
     */
    public function getServicesByTag(string $tag, array $options = [])
    {
        $options['search'] = $tag;
        $options['searchColumns'] = ['tags'];
        return $this->read([], $options);
    }
}
