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
     * Retrieve orders by seller ID.
     *
     * @param int $sellerId The ID of the seller.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of orders or false on failure.
     */
    public function getOrdersBySellerId(int $sellerId, array $options = [])
    {
        return $this->read(['seller_id' => $sellerId], $options);
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
     * Retrieve a list of orders with joined data from order_promises, service, and user tables.
     *
     * @param array $conditions Filtering conditions for the orders.
     * @param array $options Additional options like order, limit, offset, search, filters.
     * @return array|false List of orders with joined data or false on failure.
     */
    public function getOrdersWithDetails(array $conditions = [], array $options = [])
    {
        $joins = [
            [
                'type' => 'LEFT',
                'table' => 'order_promises',
                'on' => 'orders.order_id = order_promises.order_id'
            ],
            [
                'type' => 'LEFT',
                'table' => 'service',
                'on' => 'orders.service_id = service.service_id'
            ],
            [
                'type' => 'LEFT',
                'table' => 'user AS customer',
                'on' => 'orders.customer_id = customer.user_id'
            ],
            [
                'type' => 'LEFT',
                'table' => 'user AS seller',
                'on' => 'orders.seller_id = seller.user_id'
            ]
        ];
        $options['columns'] = [
            'orders.*',
            'order_promises.promise_id',
            'order_promises.accepted_service',
            'order_promises.requested_service',
            'order_promises.delivery_days',
            'order_promises.number_of_revisions',
            'order_promises.price',
            'service.title AS service_title',
            'service.description AS service_description',
            'service.cover_image AS service_cover_image',
            'service.service_type',
            'customer.name AS customer_name',
            'customer.email AS customer_email',
            'customer.profile_picture AS customer_profile_picture',
            'customer.role AS customer_role',
            'seller.name AS seller_name',
            'seller.email AS seller_email',
            'seller.profile_picture AS seller_profile_picture',
            'seller.role AS seller_role'
        ];
        return $this->readWithJoin($joins, $conditions, $options);
    }

}