<?php
namespace app\core\Database;

use PDO;
use PDOException;

/**
 * Database class that handles database connection and queries using PDO.
 * Implements Singleton Pattern to ensure a single instance of the Database connection.
 */
class Database
{
    private $dsn;        // Data Source Name (DSN) for the database connection
    private $user;       // Username for the database connection
    private $pass;       // Password for the database connection

    private $dbh;        // PDO instance for database interaction
    private $stmt;       // PDO statement object for prepared queries
    private static $instance = null;  // Singleton instance of the Database class

    /**
     * Private constructor to prevent direct instantiation.
     * Initializes the database connection using values from environment variables.
     */
    private function __construct()
    {
        // Get the database connection details from environment variables
        $this->dsn = $_ENV['DB_DSN'] ?? '';
        $this->user = $_ENV['DB_USER'] ?? '';
        $this->pass = $_ENV['DB_PASSWORD'] ?? '';

        // PDO options for persistent connection and error handling
        $options = [
            PDO::ATTR_PERSISTENT => true,  // Enable persistent connections
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  // Throw exceptions on errors
        ];

        // Attempt to establish a PDO connection
        try {
            $this->dbh = new PDO($this->dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            // Log and rethrow any connection errors
            $this->logError($e);
            throw new \Exception('Database connection failed: ' . $e->getMessage());
        }
    }

    /**
     * Get the singleton instance of the Database class.
     * Ensures only one instance of the Database class exists.
     *
     * @return Database
     */
    public static function getInstance()
    {
        // Create a new instance if it doesn't exist
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Prepares an SQL query for execution.
     *
     * @param string $sql SQL query to prepare
     * @throws \Exception if query preparation fails
     */
    public function prepare($sql)
    {
        try {
            $this->stmt = $this->dbh->prepare($sql);
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to prepare statement: ' . $e->getMessage());
        }
    }

    /**
     * Binds a value to a parameter in the prepared statement.
     *
     * @param string $param The parameter placeholder (e.g., ':id')
     * @param mixed $value The value to bind to the parameter
     * @param int|null $type The PDO parameter type (optional)
     * @throws \Exception if binding fails
     */
    public function bind($param, $value, $type = null)
    {
        // Automatically determine the type if not provided
        if ($type === null) {
            $type = match (true) {
                is_int($value) => PDO::PARAM_INT,
                is_bool($value) => PDO::PARAM_BOOL,
                is_null($value) => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            };
        }

        try {
            $this->stmt->bindValue($param, $value, $type);
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to bind parameter: ' . $e->getMessage());
        }
    }

    /**
     * Executes the prepared statement.
     *
     * @return bool Returns true on success, false on failure
     * @throws \Exception if execution fails
     */
    public function execute()
    {
        try {
            return $this->stmt->execute();
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to execute query: ' . $e->getMessage());
        }
    }

    /**
     * Fetches all rows from the result set as an associative array.
     *
     * @param int $fetchStyle Fetch mode (default: PDO::FETCH_ASSOC)
     * @return array An array of fetched rows
     * @throws \Exception if fetching fails
     */
    public function fetchAll($fetchStyle = PDO::FETCH_ASSOC)
    {
        try {
            $this->execute();
            return $this->stmt->fetchAll($fetchStyle);
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to fetch all records: ' . $e->getMessage());
        }
    }

    /**
     * Fetches a single row from the result set.
     *
     * @return array|false An associative array of the fetched row, or false if no row is found
     * @throws \Exception if fetching fails
     */
    public function fetch()
    {
        try {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to fetch record: ' . $e->getMessage());
        }
    }

    /**
     * Fetches a single column from the result set.
     *
     * @return mixed The value of the column
     * @throws \Exception if fetching fails
     */
    public function fetchColumn()
    {
        try {
            $this->execute();
            return $this->stmt->fetchColumn();
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to fetch column: ' . $e->getMessage());
        }
    }

    /**
     * Returns the number of rows affected by the last query.
     *
     * @return int The number of rows affected
     * @throws \Exception if fetching the row count fails
     */
    public function rowCount()
    {
        try {
            return $this->stmt->rowCount();
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to get row count: ' . $e->getMessage());
        }
    }

    /**
     * Returns the ID of the last inserted row.
     *
     * @return string The last insert ID
     * @throws \Exception if fetching the last insert ID fails
     */
    public function lastInsertId()
    {
        try {
            return $this->dbh->lastInsertId();
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to get last insert ID: ' . $e->getMessage());
        }
    }

    /**
     * Begins a database transaction.
     *
     * @return bool True on success, false on failure
     * @throws \Exception if starting the transaction fails
     */
    public function beginTransaction()
    {
        try {
            return $this->dbh->beginTransaction();
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to begin transaction: ' . $e->getMessage());
        }
    }

    /**
     * Commits the current transaction.
     *
     * @return bool True on success, false on failure
     * @throws \Exception if committing the transaction fails
     */
    public function commit()
    {
        try {
            return $this->dbh->commit();
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to commit transaction: ' . $e->getMessage());
        }
    }

    /**
     * Rolls back the current transaction.
     *
     * @return bool True on success, false on failure
     * @throws \Exception if rolling back the transaction fails
     */
    public function rollBack()
    {
        try {
            return $this->dbh->rollBack();
        } catch (PDOException $e) {
            $this->logError($e);
            throw new \Exception('Failed to roll back transaction: ' . $e->getMessage());
        }
    }

    /**
     * Executes a query with bound parameters.
     *
     * @param string $sql The SQL query to execute
     * @param array $params The parameters to bind to the query
     * @return bool True on success, false on failure
     * @throws \Exception if the query execution fails
     */
    public function executeWithParams($sql, $params = [])
    {
        error_log("Executing SQL: $sql with params: " . json_encode($params)); // Log the SQL and parameters
        $this->prepare($sql);
        foreach ($params as $key => $value) {
            $this->bind($key, $value);
        }
        $this->execute();
        return $this->stmt; // Return the PDOStatement
    }

    /**
     * Logs errors to the PHP error log.
     *
     * @param PDOException $e The exception object containing the error details
     */
    private function logError($e)
    {
        error_log("[Database Error] " . $e->getMessage());
    }

    /**
     * Closes the database connection and prepares the statement for garbage collection.
     */
    public function closeConnection()
    {
        $this->dbh = null;
        $this->stmt = null;
    }
}
