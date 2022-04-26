<?php

class Database{
    
    // specify the credentials for the database
    private $host= "localhost";
    private $db_name= "hrmanagement";
    private $username= "root";
    private $password="";
    public $conn;

    // define a function for creating a connection with database
    public function getConnection(){
        $this->conn = null; // Initialize the connection as null

        // Try creating a connection with the specified credentials
        try {
            // Create new PHP Data Object (PDO) comprised of the connection elements
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            //Set up the connection through the connection object
            $this->conn->exec("set names utf8");
        }
        // If connection can't be established, give connection erro message
        catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        // Return the connection object 
        return $this->conn;
    }
    
}

?>