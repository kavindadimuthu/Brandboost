<?php

namespace app\models\Orders;

use app\core\BaseModel;

class OrderDeliveries extends BaseModel
{
    protected $table = 'order_deliveries';

    /**
     * Get delivery by ID
     */
    public function getDeliveryById(int $deliveryId)
    {
        return $this->readOne(['delivery_id' => $deliveryId]);
    }

    /**
     * Get all deliveries for an order
     */
    public function getDeliveriesByOrder(int $orderId, array $options = [])
    {
        return $this->read(['order_id' => $orderId], $options);
    }

    /**
     * Get all revisions for a specific delivery
     */
    public function getRevisionsByDeliveryId(int $deliveryId, array $options = [])
    {
        return $this->read([
            'delivery_id' => $deliveryId,
            'revision_number IS NOT' => null
        ], $options);
    }

    /**
     * Create new delivery
     */
    public function createDelivery(array $data)
    {
        return $this->create($data);
    }

    /**
     * Create revision for a delivery
     */
    public function createRevision(int $orderId, array $data)
    {
        // Auto-increment revision number for this order
        $latestRevision = $this->readOne(
            ['order_id' => $orderId],
            ['order' => 'revision_number DESC']
        );
        
        $nextRevisionNumber = 1;
        if ($latestRevision && isset($latestRevision['revision_number'])) {
            $nextRevisionNumber = $latestRevision['revision_number'] + 1;
        }
        
        $data['order_id'] = $orderId;
        $data['revision_number'] = $nextRevisionNumber;
        
        return $this->create($data);
    }

    /**
     * Update delivery
     */
    public function updateDelivery(int $deliveryId, array $data)
    {
        return $this->update(['delivery_id' => $deliveryId], $data);
    }

    /**
     * Delete delivery
     */
    public function deleteDelivery(int $deliveryId)
    {
        return $this->delete(['delivery_id' => $deliveryId]);
    }

    /**
     * Get deliveries by status
     */
    public function getDeliveriesByStatus(string $status, array $options = [])
    {
        return $this->read(['status' => $status], $options);
    }

    /**
     * Get latest delivery for an order
     */
    public function getLatestDelivery(int $orderId)
    {
        return $this->readOne(
            ['order_id' => $orderId],
            ['order' => 'delivered_at DESC']
        );
    }
    
    /**
     * Upload revision files
     */
    public function uploadRevisionFiles(int $deliveryId, array $files)
    {
        // Implementation would depend on how files are handled in your application
        // This is just a placeholder for the required functionality
        $fileData = json_encode($files); // Or some other processing
        
        return $this->update(
            ['delivery_id' => $deliveryId],
            ['revision_files' => $fileData]
        );
    }
    
    /**
     * Get all deliveries with their respective notes
     */
    public function getDeliveriesWithNotes(array $options = [])
    {
        return $this->read(['delivery_note IS NOT' => null], $options);
    }

}