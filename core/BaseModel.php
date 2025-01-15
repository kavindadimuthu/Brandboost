<?php

namespace app\core;

use app\core\Database\Database;
use app\core\Helpers\DebugHelper;
use PDO;

class BaseModel
{
    protected $db;
    protected $table; // Table name will be defined in the child model

    public function __construct($table = null)
    {
        $this->db = Database::getInstance()->getPdo(); // Get the PDO instance from Database
        $this->table = $table ?: $this->table; // Initialize table name if provided
    }

    // Find all records that match the given column and value (no LIMIT)
    public function find($value, $column = 'id')
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} = :value");
        $stmt->execute(['value' => $value]);
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Return all matching records as an array of objects
    }


    // Find one record based on custom conditions (column = value)
    public function findOne($value, $column = 'id')
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$column} = :value LIMIT 1");
        $stmt->execute(['value' => $value]);
        return $stmt->fetch(PDO::FETCH_OBJ); // Return the result as an object
    }

    // Find all records that match custom conditions, order, and limit
    public function findAll($conditions = [], $orderBy = null, $limit = null)
    {
        $sql = "SELECT * FROM {$this->table}";

        if (!empty($conditions)) {
            $sql .= " WHERE ";
            $whereClauses = [];
            foreach ($conditions as $key => $value) {
                $whereClauses[] = "$key = :$key";
            }
            $sql .= implode(' AND ', $whereClauses);
        }

        if ($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }

        if ($limit) {
            $sql .= " LIMIT $limit";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($conditions);
        return $stmt->fetchAll(PDO::FETCH_OBJ); // Return all records as an array of objects
    }

    // Create a new record in the database
    public function create($data)
    {
        // DebugHelper::dump( $data);
        // Prepare columns and values for insertion
        $columns = implode(', ', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute($data); // Execute and return result
    }

    // Update a record by custom column and value
    public function update($value, $data, $conditions = ['id'])
    {
        error_log("it entered to update in model");
        // Prepare the SET clause
        $setClauses = [];
        foreach ($data as $key => $val) {
            $setClauses[] = "$key = :set_$key";
        }

        // Prepare WHERE clauses
        $whereClauses = [];
        $whereData = [];
        
        if (is_array($conditions)) {
            // Handle multiple conditions
            foreach ($conditions as $field => $val) {
                if (is_numeric($field)) {
                    // Handle backward compatibility case
                    $whereClauses[] = "id = :where_value";
                    $whereData['where_value'] = $value;
                    break;
                }
                $whereClauses[] = "$field = :where_$field";
                $whereData["where_$field"] = $val;
            }
        } else {
            // Handle legacy single column case
            $whereClauses[] = "$conditions = :where_value";
            $whereData['where_value'] = $value;
        }

        $sql = "UPDATE {$this->table} SET " . implode(', ', $setClauses) .
            " WHERE " . implode(' AND ', $whereClauses);

        // Prepare final data array with unique parameter names
        $finalData = [];
        foreach ($data as $key => $val) {
            $finalData["set_$key"] = $val;
        }
        $finalData = array_merge($finalData, $whereData);

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($finalData);
    }

    // Delete a record by custom column and value
    public function delete($value, $column = 'id')
    {
        $sql = "DELETE FROM {$this->table} WHERE {$column} = :value";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['value' => $value]); // Execute and return result
    }

    // Begin a database transaction
    public function beginTransaction()
    {
        return $this->db->beginTransaction();
    }

    // Commit the transaction
    public function commit()
    {
        return $this->db->commit();
    }

    // Rollback the transaction
    public function rollback()
    {
        return $this->db->rollBack();
    }

    // Optional: Fetch the last insert ID (for after an insert operation)
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

}
