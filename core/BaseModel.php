<?php

/**
 * BaseModel Class
 * 
 * This abstract class provides a base structure for interacting with the database
 * through various CRUD operations. It leverages the Database class to execute SQL queries.
 * 
 * Available Methods:
 * - __construct() : Initializes the Database instance.
 * - create(array $data) : Inserts a new record into the database.
 * - read(array $conditions = [], array $options = []) : Retrieves records based on conditions, options, search, and filtering.
 * - readOne(array $conditions = []) : Retrieves a single record based on conditions.
 * - update(array $conditions, array $data) : Updates existing records in the database.
 * - delete(array $conditions) : Deletes records based on conditions.
 * - buildWhereClause(array $conditions, $prefix = '') : Constructs the WHERE clause for SQL queries.
 * - buildOrderAndLimit(array $options) : Adds ORDER BY, LIMIT, and OFFSET to SQL queries.
 * - logError($e) : Logs database errors.
 */

namespace app\core;

use app\core\Database\Database;
use PDO;
use PDOException;
use Exception;

abstract class BaseModel
{
    /** @var Database $db Singleton instance of the Database class */
    protected $db;

    /** @var string $table The name of the table associated with the model */
    protected $table;

    /**
     * BaseModel constructor.
     * Initializes the Database instance.
     */
    public function __construct()
    {
        $this->db = Database::getInstance(); // Singleton instance of Database
    }

    /**
     * Inserts a new record into the database.
     * 
     * @param array $data Key-value pairs of column names and values to insert.
     * @return bool Success or failure of the operation.
     */
    public function create(array $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";

        try {
            return $this->db->executeWithParams($sql, $data);
        } catch (Exception $e) {
            $this->logError($e);
            return false;
        }
    }

    /**
     * Counts records from the database based on conditions, search, and filtering.
     * Particularly useful for pagination to determine total number of records.
     * 
     * @param array $conditions Key-value pairs for the WHERE clause.
     * @param array $options Additional options like search and filters.
     * @return int|false Number of matching records or false on failure.
     */
    public function count(array $conditions = [], array $options = [], array $joins = [])
    {
        // Remove SQL keywords from conditions
        unset($conditions['limit'], $conditions['offset'], $conditions['order']);

        $sql = "SELECT COUNT(*) as total FROM {$this->table}";

        // Build JOIN clauses
        foreach ($joins as $join) {
            $type = strtoupper($join['type'] ?? 'INNER');
            $table = $join['table'] ?? '';
            $on = $join['on'] ?? '';
            if ($table && $on) {
                $sql .= " $type JOIN $table ON $on";
            }
        }

        // Build WHERE clause
        $whereClause = $this->buildWhereClause($conditions);

        // Add search conditions if provided
        if (!empty($options['search']) && !empty($options['searchColumns'])) {
            $searchConditions = array_map(fn($col) => "$col LIKE :search", $options['searchColumns']);
            $whereClause .= ($whereClause ? " AND " : "WHERE ") . "(" . implode(" OR ", $searchConditions) . ")";
            $conditions['search'] = "%" . $options['search'] . "%";
        }

        // Add filter conditions with support for operators
        if (!empty($options['filters'])) {
            foreach ($options['filters'] as $filterCol => $filterValue) {
                if (preg_match('/^([a-zA-Z0-9_.]+)\s*(>=|<=|>|<|!=|=)$/', $filterCol, $matches)) {
                    $col = $matches[1];
                    $op = $matches[2];
                    $safeCol = str_replace('.', '_', $col);
                    $param = "filter_" . $safeCol . "_" . str_replace(['>=', '<=', '>', '<', '!=', '='], ['gte', 'lte', 'gt', 'lt', 'ne', 'eq'], $op);
                    $whereClause .= ($whereClause ? " AND " : "WHERE ") . "$col $op :$param";
                    $conditions[$param] = $filterValue;
                } else {
                    $safeCol = str_replace('.', '_', $filterCol);
                    $whereClause .= ($whereClause ? " AND " : "WHERE ") . "$filterCol = :filter_$safeCol";
                    $conditions["filter_$safeCol"] = $filterValue;
                }
            }
        }

        $sql .= " $whereClause";

        try {
            $stmt = $this->db->executeWithParams($sql, $conditions);
            $result = $this->db->fetch(PDO::FETCH_ASSOC);
            return (int) $result['total'];
        } catch (Exception $e) {
            $this->logError($e);
            return false;
        }
    }



    /**
     * Retrieves records from the database based on conditions, options, search, and filtering.
     * 
     * @param array $conditions Key-value pairs for the WHERE clause.
     * @param array $options Additional options like order, limit, offset, search, and filters.
     * @return array|false Fetched records or false on failure.
     */
    public function read(array $conditions = [], array $options = [])
    {
        // Select specific columns if provided
        $columns = !empty($options['columns']) ? implode(', ', $options['columns']) : '*';

        $sql = "SELECT $columns FROM {$this->table}";

        // Build WHERE clause
        $whereClause = $this->buildWhereClause($conditions);

        // Handle search logic
        if (!empty($options['search']) && !empty($options['searchColumns'])) {
            $searchConditions = array_map(fn($col) => "$col LIKE :search", $options['searchColumns']);
            $whereClause .= ($whereClause ? " AND " : "WHERE ") . "(" . implode(" OR ", $searchConditions) . ")";
            $conditions['search'] = "%" . $options['search'] . "%";
        }

        // Handle filters (with operators)
        if (!empty($options['filters'])) {
            foreach ($options['filters'] as $filterCol => $filterValue) {
                if (preg_match('/^([a-zA-Z0-9_.]+)\s*(>=|<=|>|<|!=|=)$/', $filterCol, $matches)) {
                    $col = $matches[1];
                    $op = $matches[2];
                    $safeCol = str_replace('.', '_', $col);
                    $param = "filter_" . $safeCol . "_" . str_replace(['>=', '<=', '>', '<', '!=', '='], ['gte', 'lte', 'gt', 'lt', 'ne', 'eq'], $op);
                    $whereClause .= ($whereClause ? " AND " : "WHERE ") . "$col $op :$param";
                    $conditions[$param] = $filterValue;
                } else {
                    $safeCol = str_replace('.', '_', $filterCol);
                    $whereClause .= ($whereClause ? " AND " : "WHERE ") . "$filterCol = :filter_$safeCol";
                    $conditions["filter_$safeCol"] = $filterValue;
                }
            }
        }

        // Final SQL with ordering and limits
        $sql .= " $whereClause";
        $sql .= $this->buildOrderAndLimit($options);

        error_log("SQL Query: $sql"); // Optional debug

        try {
            $this->db->executeWithParams($sql, $conditions);
            return $this->db->fetchAll(PDO::FETCH_ASSOC); // Fetch all results
        } catch (Exception $e) {
            $this->logError($e);
            return false;
        }
    }



    /**
     * Retrieves a single record from the database based on conditions.
     * 
     * @param array $conditions Key-value pairs for the WHERE clause.
     * @return array|false Fetched record or false on failure.
     */
    public function readOne(array $conditions = [])
    {
        $options = ['limit' => 1];
        $result = $this->read($conditions, $options);
        return $result ? $result[0] : false;
    }


    /**
     * Retrieves data from multiple tables using JOIN queries.
     * 
     * @param array $joins Array of join definitions. Each join should be:
     *   [
     *     'type' => 'INNER'|'LEFT'|'RIGHT'|'FULL', // join type
     *     'table' => 'other_table',
     *     'on' => 'main_table.col = other_table.col'
     *   ]
     * @param array $conditions Key-value pairs for the WHERE clause.
     * @param array $options Additional options: 
     *   - 'columns' => array of columns to select (default: ['*'])
     *   - 'order', 'limit', 'offset', 'search', 'searchColumns', 'filters'
     * @return array|false Result set or false on failure.
     */
    public function readWithJoin(array $joins = [], array $conditions = [], array $options = [])
    {
        $columns = !empty($options['columns']) ? implode(', ', $options['columns']) : '*';
        $sql = "SELECT $columns FROM {$this->table}";

        // Build JOIN clauses
        foreach ($joins as $join) {
            $type = strtoupper($join['type'] ?? 'INNER');
            $table = $join['table'] ?? '';
            $on = $join['on'] ?? '';
            if ($table && $on) {
                $sql .= " $type JOIN $table ON $on";
            }
        }

        // Build WHERE clause (with search and filters)
        $whereClause = $this->buildWhereClause($conditions);
        if (!empty($options['search']) && !empty($options['searchColumns'])) {
            $searchConditions = array_map(fn($col) => "$col LIKE :search", $options['searchColumns']);
            $whereClause .= ($whereClause ? " AND " : "WHERE ") . "(" . implode(" OR ", $searchConditions) . ")";
            $conditions['search'] = "%" . $options['search'] . "%";
        }
        // Add filter conditions if provided
        if (!empty($options['filters'])) {
            foreach ($options['filters'] as $filterCol => $filterValue) {
                // Support operators in filter keys, e.g., "created_at >="
                error_log("Filter column: $filterCol"); // Debugging line
                if (preg_match('/^([a-zA-Z0-9_.]+)\s*(>=|<=|>|<|!=|=)$/', $filterCol, $matches)) {
                    $col = $matches[1];
                    $op = $matches[2];
                    $safeCol = str_replace('.', '_', $col);
                    $param = "filter_" . $safeCol . "_" . str_replace(['>=', '<=', '>', '<', '!=', '='], ['gte', 'lte', 'gt', 'lt', 'ne', 'eq'], $op);
                    $whereClause .= ($whereClause ? " AND " : "WHERE ") . "$col $op :$param";
                    $conditions[$param] = $filterValue;
                } else {
                    $safeCol = str_replace('.', '_', $filterCol); // 💡 fix is here
                    $whereClause .= ($whereClause ? " AND " : "WHERE ") . "$filterCol = :filter_$safeCol";
                    $conditions["filter_$safeCol"] = $filterValue;
                }
            }
        }

        $sql .= " $whereClause";
        $sql .= $this->buildOrderAndLimit($options);
        error_log("SQL Query: $sql"); // Debugging line 

        try {
            $this->db->executeWithParams($sql, $conditions);
            return $this->db->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            $this->logError($e);
            return false;
        }
    }


    /**
     * Updates existing records in the database.
     * 
     * @param array $conditions Key-value pairs for the WHERE clause.
     * @param array $data Key-value pairs of column names and values to update.
     * @return bool Success or failure of the operation.
     */
    public function update(array $conditions, array $data)
    {
        $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $whereClause = $this->buildWhereClause($conditions, 'cond_');
        $sql = "UPDATE {$this->table} SET $setClause $whereClause";

        $params = array_merge($data, array_combine(array_map(fn($key) => 'cond_' . $key, array_keys($conditions)), $conditions));

        try {
            return $this->db->executeWithParams($sql, $params);
        } catch (Exception $e) {
            $this->logError($e);
            return false;
        }
    }

    /**
     * Deletes records from the database based on conditions.
     * 
     * @param array $conditions Key-value pairs for the WHERE clause.
     * @return bool Success or failure of the operation.
     */
    public function delete(array $conditions)
    {
        $whereClause = $this->buildWhereClause($conditions);
        $sql = "DELETE FROM {$this->table} $whereClause";

        try {
            return $this->db->executeWithParams($sql, $conditions);
        } catch (Exception $e) {
            $this->logError($e);
            return false;
        }
    }

    /**
     * Constructs the WHERE clause for SQL queries.
     * 
     * @param array $conditions Key-value pairs for the WHERE clause.
     * @param string $prefix Prefix for the placeholder keys to avoid conflicts.
     * @return string The constructed WHERE clause.
     */
    protected function buildWhereClause(array $conditions, $prefix = '')
    {
        if (empty($conditions)) {
            return '';
        }

        $clauses = [];
        foreach ($conditions as $key => $value) {
            // Support operators in key, e.g., "created_at >="
            if (preg_match('/^([a-zA-Z0-9_]+)\s*(>=|<=|>|<|!=|=)$/', $key, $matches)) {
                $col = $matches[1];
                $op = $matches[2];
                $param = $prefix . str_replace([' ', '>=', '<=', '>', '<', '!=', '='], ['_', 'gte', 'lte', 'gt', 'lt', 'ne', 'eq'], $key);
                $clauses[] = "$col $op :$param";
            } else {
                $clauses[] = "$key = :$prefix$key";
            }
        }
        return 'WHERE ' . implode(' AND ', $clauses);
    }

    /**
     * Adds ORDER BY, LIMIT, and OFFSET to SQL queries.
     * 
     * @param array $options Key-value pairs for order, limit, and offset.
     * @return string The constructed ORDER BY, LIMIT, and OFFSET clause.
     */
    protected function buildOrderAndLimit(array $options)
    {
        $order = isset($options['order']) ? " ORDER BY {$options['order']}" : "";
        $limit = isset($options['limit']) ? " LIMIT {$options['limit']}" : "";
        $offset = isset($options['offset']) ? " OFFSET {$options['offset']}" : "";

        return $order . $limit . $offset;
    }

    /**
     * Executes a custom SQL query with optional parameters.
     * 
     * @param string $sql The SQL query to execute.
     * @param array $params Parameters to bind to the SQL query.
     * @param bool $fetchAll Whether to fetch all rows (true) or a single row (false).
     * @return mixed Array of results, single result, or boolean success status.
     */
    public function executeCustomQuery($sql, $params = [], $fetchAll = true)
    {
        try {
            // Execute the query first
            $this->db->prepare($sql);

            foreach ($params as $key => $value) {
                $this->db->bind($key, $value);
            }

            $this->db->execute();

            // Determine return type based on SQL statement and fetchAll parameter
            $trimmedSql = preg_replace('/^\s*\(*\s*/', '', trim($sql));
            if (stripos($trimmedSql, 'SELECT') === 0) {
                if ($fetchAll) {
                    return $this->db->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return $this->db->fetch();
                }
            } else {
                // For INSERT, UPDATE, DELETE queries - already executed above
                return true; // Return true instead of the execute result which was already called
            }
        } catch (PDOException $e) {
            $this->logError($e);
            return false;
        } catch (Exception $e) {
            $this->logError($e);
            return false;
        }
    }


    /**
     * Retrieves the last inserted ID.
     * 
     * @return int The last inserted ID.
     */
    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }

    /**
     * Logs database errors.
     * 
     * @param Exception $e The exception to log.
     */
    protected function logError($e)
    {
        error_log("[Database BaseModel Error] " . $e->getMessage());
    }
}
