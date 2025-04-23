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
     * Retrieve complaints by complainant user ID.
     *
     * @param int $userId The ID of the complainant user.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints or false on failure.
     */
    public function getComplaintsByComplainantUserId(int $userId, array $options = [])
    {
        return $this->read(['complainant_user_id' => $userId], $options);
    }

    /**
     * Retrieve complaints by reported user ID.
     *
     * @param int $userId The ID of the reported user.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints or false on failure.
     */
    public function getComplaintsByReportedUserId(int $userId, array $options = [])
    {
        return $this->read(['reported_user_id' => $userId], $options);
    }

    /**
     * Retrieve complaints by status.
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
     * Retrieve complaints resolved by a specific admin.
     *
     * @param int $adminId The ID of the admin.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints or false on failure.
     */
    public function getComplaintsByResolvedByAdminId(int $adminId, array $options = [])
    {
        return $this->read(['resolved_by_admin_id' => $adminId], $options);
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
     * Search complaints by complaint_type or description.
     *
     * @param string $searchTerm The search term to look for.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints or false on failure.
     */
    public function searchComplaints(string $searchTerm, array $options = [])
    {
        $options['search'] = $searchTerm;
        $options['searchColumns'] = ['complaint_type', 'description'];
        return $this->read([], $options);
    }

    /**
     * Get all complaints with optional filters.
     *
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints or false on failure.
     */
    public function getAllComplaints(array $options = [])
    {
        return $this->read([], $options);
    }

    /**
     * Count the total number of complaints based on conditions.
     *
     * @param array $conditions Conditions to filter the count.
     * @return int|false Total count of complaints or false on failure.
     */
    public function countComplaints(array $conditions = [])
    {
        return $this->count($conditions);
    }

    /**
     * Get complaints with complainant, reported user, and admin details.
     *
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of complaints with user and admin info or false on failure.
     */
    public function getComplaintsWithUsersAndAdmin(array $conditions = [], array $options = [])
    {
        $joins = [
            [
                'type' => 'LEFT',
                'table' => 'user AS complainant',
                'on' => 'complaint.complainant_user_id = complainant.user_id'
            ],
            [
                'type' => 'LEFT',
                'table' => 'user AS reported',
                'on' => 'complaint.reported_user_id = reported.user_id'
            ],
            [
                'type' => 'LEFT',
                'table' => 'admin',
                'on' => 'complaint.resolved_by_admin_id = admin.admin_id'
            ]
        ];
        $options['columns'] = [
            'complaint.*',
            'complainant.name AS complainant_name',
            'complainant.email AS complainant_email',
            'complainant.profile_picture AS complainant_profile_picture',
            'complainant.role AS complainant_user_role',
            'reported.name AS reported_name',
            'reported.email AS reported_email',
            'reported.profile_picture AS reported_profile_picture',
            'reported.role AS reported_user_role',
            'admin.name AS admin_name',
            'admin.email AS admin_email'
        ];
        $options['searchColumns'] = ['complaint_id', 'complaint_type', 'description', 'complainant.name', 'reported.name', 'admin.name'];

        // error_log("Filters: " . print_r($options['filters'], true)); // Debugging line
        // error_log("Conditions: " . print_r($options, true)); // Debugging line
        return $this->readWithJoin($joins, $conditions, $options);
    }
}