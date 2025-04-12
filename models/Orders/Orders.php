<?php

namespace app\models\Orders;

use app\core\BaseModel;

class Orders extends BaseModel
{
    protected $table = 'orders'; // Specify the database table

    /**
     * Retrieve an order by its ID.
     *
     * @param int $orderId The ID of the order.
     * @return array|false The order record or false if not found.
     */
    public function getOrderById(int $orderId)
    {
        return $this->readOne(['order_id' => $orderId]);
    }

    /**
     * Retrieve orders by service ID.
     *
     * @param int $serviceId The ID of the service.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of orders or false on failure.
     */
    public function getOrdersByServiceId(int $serviceId, array $options = [])
    {
        return $this->read(['service_id' => $serviceId], $options);
    }

    /**
     * Retrieve orders by customer ID.
     *
     * @param int $customerId The ID of the customer.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of orders or false on failure.
     */
    public function getOrdersByCustomerId(int $customerId, array $options = [])
    {
        return $this->read(['customer_id' => $customerId], $options);
    }

    /**
     * Retrieve orders by status.
     *
     * @param string $status The status of the orders (e.g., pending, in_progress, completed, canceled).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of orders or false on failure.
     */
    public function getOrdersByStatus(string $status, array $options = [])
    {
        return $this->read(['order_status' => $status], $options);
    }

    /**
     * Create a new order.
     *
     * @param array $data The order data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createOrder(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update an order by its ID.
     *
     * @param int $orderId The ID of the order to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateOrderById(int $orderId, array $data)
    {
        return $this->update(['order_id' => $orderId], $data);
    }

    /**
     * Delete an order by its ID.
     *
     * @param int $orderId The ID of the order to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteOrderById(int $orderId)
    {
        return $this->delete(['order_id' => $orderId]);
    }

    /**
     * Retrieve orders within a date range.
     *
     * @param string $startDate The start date in YYYY-MM-DD format.
     * @param string $endDate The end date in YYYY-MM-DD format.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of orders or false on failure.
     */
    public function getOrdersByDateRange(string $startDate, string $endDate, array $options = [])
    {
        $conditions = [
            'created_at >=' => $startDate,
            'created_at <=' => $endDate
        ];
        return $this->read($conditions, $options);
    }

    /**
     * Retrieve orders by payment type.
     *
     * @param string $paymentType The payment type (credit_card, paypal, etc.).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of orders or false on failure.
     */
    public function getOrdersByPaymentType(string $paymentType, array $options = [])
    {
        return $this->read(['payment_type' => $paymentType], $options);
    }





        /**
     * Get orders by service IDs with pagination and search
     *
     * @param array $serviceIds Array of service IDs
     * @param int $limit Number of records to return
     * @param int $offset Offset for pagination
     * @param string $search Search term for filtering
     * @return array Array of order records
     */
    public function getOrdersByServiceIds(array $serviceIds): array
    {
        if (empty($serviceIds)) {
            return [];
        }
        
        // Convert array to comma-separated string for IN clause
        $serviceIdsStr = implode(',', array_map('intval', $serviceIds));
        
        $sql = "SELECT * FROM orders WHERE service_id IN ($serviceIdsStr)";
        
        // Add search condition if provided
        // if (!empty($search)) {
        //     $search = $this->db->escape_string($search);
        //     $sql .= " AND (order_id LIKE '%$search%' OR EXISTS (
        //         SELECT 1 FROM users 
        //         WHERE users.user_id = orders.customer_id 
        //         AND (users.first_name LIKE '%$search%' OR users.last_name LIKE '%$search%')
        //     ))";
        // }
        
        // // Add sorting and pagination
        // $sql .= " ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        
        return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Count total orders by service IDs with search
     *
     * @param array $serviceIds Array of service IDs
     * @param string $search Search term for filtering
     * @return int Total number of matching orders
     */
    public function countOrdersByServiceIds(array $serviceIds): int
    {
        if (empty($serviceIds)) {
            return 0;
        }
        
        // Convert array to comma-separated string for IN clause
        $serviceIdsStr = implode(',', array_map('intval', $serviceIds));
        
        $sql = "SELECT COUNT(*) as total FROM orders WHERE service_id IN ($serviceIdsStr)";
        
        // Add search condition if provided
        // if (!empty($search)) {
        //     $search = $this->db->escape_string($search);
        //     $sql .= " AND (order_id LIKE '%$search%' OR EXISTS (
        //         SELECT 1 FROM users 
        //         WHERE users.user_id = orders.customer_id 
        //         AND (users.first_name LIKE '%$search%' OR users.last_name LIKE '%$search%')
        //     ))";
        // }
        
        $result = $this->db->query($sql)->fetch_assoc();
        return (int)($result['total'] ?? 0);
    }
}
