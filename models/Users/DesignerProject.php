<?php

namespace app\models\Users;

use app\core\BaseModel;

class DesignerProject extends BaseModel
{
    protected $table = 'designer_project';

    /**
     * Retrieves portfolio projects by the user ID.
     *
     * @param int $userId The ID of the designer.
     * @return array|false List of portfolio projects or false if not found.
     */
    public function getProjectsByUserId(int $userId)
    {
        return $this->read(['user_id' => $userId]);
    }

    /**
     * Creates a new portfolio project.
     *
     * @param array $data The project data to insert.
     * @return bool Success or failure of the operation.
     */
    public function createProject(array $data)
    {
        return $this->create($data);
    }

    /**
     * Updates a portfolio project by its ID.
     *
     * @param int $projectId The ID of the project to update.
     * @param array $data The data to update.
     * @return bool Success or failure of the operation.
     */
    public function updateProjectById(int $projectId, array $data)
    {
        return $this->update(['project_id' => $projectId], $data);
    }

    /**
     * Deletes a portfolio project by its ID.
     *
     * @param int $projectId The ID of the project to delete.
     * @return bool Success or failure of the operation.
     */
    public function deleteProjectById(int $projectId)
    {
        return $this->delete(['project_id' => $projectId]);
    }

    /**
     * Searches portfolio projects by title.
     *
     * @param string $title The title to search for.
     * @param array $options Additional options like order, limit, and offset.
     * @return array|false List of portfolio projects or false on failure.
     */
    public function searchProjectsByTitle(string $title, array $options = [])
    {
        $options['search'] = $title;
        $options['searchColumns'] = ['title'];
        return $this->read([], $options);
    }
}
