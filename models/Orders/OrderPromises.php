<?php

namespace app\models\Orders;

use app\core\BaseModel;

class OrderPromises extends BaseModel
{
    protected $table = 'order_promises'; // Specify the database table

    /**
     * Retrieve a promise by its ID.
     *
     * @param int $promiseId The ID of the promise.
     * @return array|false The promise record or false if not found.
     */
    public function getPromiseById(int $promiseId)
    {
        return $this->readOne(['promise_id' => $promiseId]);
    }

    /**
     * Retrieve promises by order ID.
     *
     * @param int $orderId The ID of the order.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of promises or false on failure.
     */
    public function getPromisesByOrderId(int $orderId, array $options = [])
    {
        return $this->read(['order_id' => $orderId], $options);
    }

    /**
     * Create a new order promise.
     *
     * @param array $data The promise data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createPromise(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update a promise by its ID.
     *
     * @param int $promiseId The ID of the promise to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updatePromiseById(int $promiseId, array $data)
    {
        return $this->update(['promise_id' => $promiseId], $data);
    }

    /**
     * Delete a promise by its ID.
     *
     * @param int $promiseId The ID of the promise to delete.
     * @return bool Success or failure of the operation.
     */
    public function deletePromiseById(int $promiseId)
    {
        return $this->delete(['promise_id' => $promiseId]);
    }

    /**
     * Retrieve promises by delivery days.
     *
     * @param int $deliveryDays The number of delivery days.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of promises or false on failure.
     */
    public function getPromisesByDeliveryDays(int $deliveryDays, array $options = [])
    {
        return $this->read(['delivery_days' => $deliveryDays], $options);
    }

    /**
     * Retrieve promises by price range.
     *
     * @param float $minPrice The minimum price.
     * @param float $maxPrice The maximum price.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of promises or false on failure.
     */
    public function getPromisesByPriceRange(float $minPrice, float $maxPrice, array $options = [])
    {
        $conditions = [
            'price >=' => $minPrice,
            'price <=' => $maxPrice
        ];
        return $this->read($conditions, $options);
    }

    /**
     * Retrieve promises by the number of revisions.
     *
     * @param int $revisions The number of revisions.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of promises or false on failure.
     */
    public function getPromisesByRevisions(int $revisions, array $options = [])
    {
        return $this->read(['number_of_revisions' => $revisions], $options);
    }
}
