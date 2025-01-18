<?php

namespace app\models\Actions;

use app\core\BaseModel;

class Complaint extends BaseModel
{
    protected $table = 'complaint'; // Specify the database table

    /**
     * Retrieve a complaint by its ID.
     *
     * @param int $complaintId The ID of the complaint.
     * @return array|false The complaint record or false if not found.
     */
    public function getComplaintById(int $complaintId)
    {
        return $this->readOne(['complaint_id' => $complaintId]);
    }

    /**
     * Retrieve complaints by order ID.
     *
     * @param int $orderId The ID of the order.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints or false on failure.
     */
    public function getComplaintsByOrderId(int $orderId, array $options = [])
    {
        return $this->read(['order_id' => $orderId], $options);
    }

    /**
     * Retrieve complaints by sender ID.
     *
     * @param int $senderId The ID of the sender.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints or false on failure.
     */
    public function getComplaintsBySenderId(int $senderId, array $options = [])
    {
        return $this->read(['sender_id' => $senderId], $options);
    }

    /**
     * Retrieve complaints by their status.
     *
     * @param string $status The status of the complaints (open, resolved, pending).
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints or false on failure.
     */
    public function getComplaintsByStatus(string $status, array $options = [])
    {
        return $this->read(['status' => $status], $options);
    }

    /**
     * Create a new complaint.
     *
     * @param array $data The complaint data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createComplaint(array $data)
    {
        return $this->create($data);
    }

    /**
     * Update a complaint by its ID.
     *
     * @param int $complaintId The ID of the complaint to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateComplaintById(int $complaintId, array $data)
    {
        return $this->update(['complaint_id' => $complaintId], $data);
    }

    /**
     * Delete a complaint by its ID.
     *
     * @param int $complaintId The ID of the complaint to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteComplaintById(int $complaintId)
    {
        return $this->delete(['complaint_id' => $complaintId]);
    }

    /**
     * Search complaints by their subject or content.
     *
     * @param string $searchTerm The search term to look for.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints or false on failure.
     */
    public function searchComplaints(string $searchTerm, array $options = [])
    {
        $options['search'] = $searchTerm;
        $options['searchColumns'] = ['subject', 'content'];
        return $this->read([], $options);
    }
}
