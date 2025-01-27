<?php

namespace app\models\Services;

use app\core\BaseModel;

class ServicePackage extends BaseModel
{
    protected $table = 'service_package'; // Specify the database table

    /**
     * Retrieve a package by its ID.
     *
     * @param int $packageId The ID of the package.
     * @return array|false The package record or false if not found.
     */
    public function getPackageById(int $packageId)
    {
        return $this->readOne(['package_id' => $packageId]);
    }

    /**
     * Retrieve packages by service ID.
     *
     * @param int $serviceId The ID of the service.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of packages or false on failure.
     */
    public function getPackagesByServiceId(int $serviceId, array $options = [])
    {
        return $this->read(['service_id' => $serviceId], $options);
    }

    /**
     * Retrieve packages by their type (basic or premium).
     *
     * @param string $packageType The type of the package.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of packages or false on failure.
     */
    public function getPackagesByType(string $packageType, array $options = [])
    {
        return $this->read(['package_type' => $packageType], $options);
    }

    /**
     * Create a new service package.
     *
     * @param array $data The package data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createPackage(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update a package by its ID.
     *
     * @param int $packageId The ID of the package to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updatePackageById(int $packageId, array $data)
    {
        return $this->update(['package_id' => $packageId], $data);
    }

    /**
     * Delete a package by its ID.
     *
     * @param int $packageId The ID of the package to delete.
     * @return bool Success or failure of the operation.
     */
    public function deletePackageById(int $packageId)
    {
        return $this->delete(['package_id' => $packageId]);
    }

    /**
     * Retrieve packages with a price range.
     *
     * @param float $minPrice The minimum price.
     * @param float $maxPrice The maximum price.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of packages or false on failure.
     */
    public function getPackagesByPriceRange(float $minPrice, float $maxPrice, array $options = [])
    {
        $conditions = [
            'price >=' => $minPrice,
            'price <=' => $maxPrice
        ];
        return $this->read($conditions, $options);
    }
}
