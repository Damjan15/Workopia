<?php

class Database
{
    public $conn;

    /**
     * Constructor for Database Class
     * 
     * @param array $config The database configuration array
     */
    public function __construct($config)
    {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];

        try {
            $this->conn = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            throw new Exception("Database connection failed: ", $e->getMessage());
        }
    }

    /**
     * Query the database
     * 
     * @param string $query The SQL query to execute
     * 
     * @return PDOStatement the PDO statement object
     * @throws Exception If the execution failes
     */
    public function query($query)
    {
        try {
            $sth = $this->conn->prepare($query);
            $sth->execute();

            return $sth;
        } catch (PDOException $e) {
            throw new Exception("Query execution failed: " . $e->getMessage());
        }
    }
}
