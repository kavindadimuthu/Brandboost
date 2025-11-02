<?php

namespace app\models\Actions;

use app\core\BaseModel;

class ComplaintTypes extends BaseModel
{
    protected $table = 'complaint_types'; // Specify the database table

    /**
     * Retrieve a complaint by its ID.
     *
     * @param int $complaintId The ID of the complaint.
     * @return array|false The complaint record or false if not found.
     */
    public function getAllComplaintTypes()
    {
        error_log("Fetching all complaint types from the database.");
        return $this->read([], []);
    }
}