<?php
class DbConnection 
{    
    // Database connection parameters
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'car_rental_system';
    
    // Store the database connection
    protected $connection;
    
    // Constructor to establish the database connection
    public function __construct(){

        // Check if connection is not already set
        if (!isset($this->connection)) {
            
            // Create a new mysqli connection
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            // Check if connection is successful
            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
        
        // Return the database connection
        return $this->connection;
    }

    // Getter method to retrieve the database connection
    public function getConnection() {
        return $this->connection;
    }
}
?>
