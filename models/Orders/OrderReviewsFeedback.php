<?php

namespace app\models\Orders;

use app\core\BaseModel;

class OrderReviewsFeedback extends BaseModel
{
    protected $table = 'order_reviews_feedback'; // Specify the database table

    /**
     * Retrieve a review or feedback by its ID.
     *
     * @param int $id The ID of the record.
     * @return array|false The record or false if not found.
     */
    public function getById(int $id)
    {
        return $this->readOne(['id' => $id]);
    }

    /**
     * Retrieve reviews or feedback by order ID.
     *
     * @param int $orderId The ID of the order.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of records or false on failure.
     */
    public function getByOrderId(int $orderId, array $options = [])
    {
        return $this->read(['order_id' => $orderId], $options);
    }

    /**
     * Retrieve reviews or feedback by user ID.
     *
     * @param int $userId The ID of the user.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of records or false on failure.
     */
    public function getByUserId(int $userId, array $options = [])
    {
        return $this->read(['user_id' => $userId], $options);
    }

    /**
     * Retrieve records by review type (review or feedback).
     *
     * @param string $reviewType The type of the record (review or feedback).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of records or false on failure.
     */
    public function getByReviewType(string $reviewType, array $options = [])
    {
        return $this->read(['review_type' => $reviewType], $options);
    }

    /**
     * Retrieve records with a specific rating.
     *
     * @param int $rating The rating (between 1 and 5).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of records or false on failure.
     */
    public function getByRating(int $rating, array $options = [])
    {
        return $this->read(['rating' => $rating], $options);
    }

    /**
     * Create a new review or feedback record.
     *
     * @param array $data The data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createRecord(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update a review or feedback record by its ID.
     *
     * @param int $id The ID of the record to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateById(int $id, array $data)
    {
        return $this->update(['id' => $id], $data);
    }

    /**
     * Delete a review or feedback record by its ID.
     *
     * @param int $id The ID of the record to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteById(int $id)
    {
        return $this->delete(['id' => $id]);
    }

    /**
     * Retrieve records created within a specific date range.
     *
     * @param string $startDate The start date.
     * @param string $endDate The end date.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of records or false on failure.
     */
    public function getByDateRange(string $startDate, string $endDate, array $options = [])
    {
        $conditions = [
            'created_at >=' => $startDate,
            'created_at <=' => $endDate
        ];
        return $this->read($conditions, $options);
    }

    /**
     * Retrieve records with both review and feedback content for a specific order.
     *
     * @param int $orderId The ID of the order.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of records or false on failure.
     */
    public function getBothReviewAndFeedbackByOrderId(int $orderId, array $options = [])
    {
        return $this->read(['order_id' => $orderId], $options);
    }
}
