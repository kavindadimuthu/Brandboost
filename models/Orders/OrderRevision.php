<?php

namespace app\models\Orders;

use app\core\BaseModel;

class OrderRevision extends BaseModel
{
    protected $table = 'order_deliveries'; // Specify the database table

    /**
     * Retrieve a revision by its ID.
     *
     * @param int $revisionId The ID of the revision.
     * @return array|false The revision record or false if not found.
     */
    public function getRevisionById(int $revisionId)
    {
        return $this->readOne(['delivery_id' => $revisionId]);
    }

    /**
     * Retrieve revisions by order ID.
     *
     * @param int $orderId The ID of the order.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of revisions or false on failure.
     */
    public function getRevisionsByOrderId(int $orderId, array $options = [])
    {
        return $this->read(['order_id' => $orderId], $options);
    }

    /**
     * Retrieve revisions by status.
     *
     * @param string $status The status of the revision (pending, submitted, etc.).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of revisions or false on failure.
     */
    public function getRevisionsByStatus(string $status, array $options = [])
    {
        return $this->read(['status' => $status], $options);
    }

    /**
     * Create a new order revision.
     *
     * @param array $data The revision data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createRevision(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update a revision by its ID.
     *
     * @param int $revisionId The ID of the revision to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateRevisionById(int $revisionId, array $data)
    {
        return $this->update(['revision_id' => $revisionId], $data);
    }

    /**
     * Delete a revision by its ID.
     *
     * @param int $revisionId The ID of the revision to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteRevisionById(int $revisionId)
    {
        return $this->delete(['revision_id' => $revisionId]);
    }

    /**
     * Retrieve revisions with a specific revision number.
     *
     * @param int $revisionNumber The revision number.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of revisions or false on failure.
     */
    public function getRevisionsByNumber(int $revisionNumber, array $options = [])
    {
        return $this->read(['revision_number' => $revisionNumber], $options);
    }

    /**
     * Retrieve revisions by delivery date.
     *
     * @param string $deliveredAt The delivery date.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of revisions or false on failure.
     */
    public function getRevisionsByDeliveredAt(string $deliveredAt, array $options = [])
    {
        return $this->read(['delivered_at' => $deliveredAt], $options);
    }

    /**
     * Retrieve revisions with deliveries matching a JSON condition.
     *
     * @param string $deliveryCondition The JSON condition for deliveries.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of revisions or false on failure.
     */
    public function getRevisionsByDeliveryCondition(string $deliveryCondition, array $options = [])
    {
        $conditions = [
            'deliveries' => $deliveryCondition
        ];
        return $this->read($conditions, $options);
    }
}
