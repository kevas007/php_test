<?php

class DB
{
    // The PDO instance for database connection
    private $pdo;

    // Singleton instance
    private static $instance = null;

    // Private constructor to prevent direct object creation
    private function __construct()
    {
        // Database connection parameters
        $dsn = 'mysql:dbname=phptest;host=127.0.0.1';
        $user = 'root';
        $password = 'pass';

        // Attempt to create a new PDO instance and set error mode to exception
        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Throw an exception if the database connection fails
            throw new Exception('Database connection failed: ' . $e->getMessage());
        }
    }

    // Get the singleton instance of the DB class
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Execute a SELECT query and return the results
    public function select(string $sql, array $params = []): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Execute an SQL query and return the number of affected rows
    public function exec(string $sql, array $params = []): int
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount();
    }

    // Get the ID of the last inserted row
    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}
?>
