<?php
class Manager{
 
    // database connection and table name
    private $conn;
    private $table_name = "manager";
 
    // object properties
    public $manager_id;
    public $name;
    public $phone;
    public $email;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all managers
    function read(){
    
        // select all query
        $query = "SELECT
                    `manager_id`, `name`, `phone`, `email`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    manager_id DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get a single manager tuple
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `manager_id`, `name`, `phone`, `email`
                FROM
                    " . $this->table_name . " 
                WHERE
                    manager_id= '".$this->manager_id."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create new manager
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`name`, `phone`, `email`)
                  VALUES
                        ('".$this->name."', '".$this->phone."', '".$this->email."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update a manager tuple
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', email='".$this->phone."', email='".$this->email."'
                WHERE
                    manager_id='".$this->manager_id."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete manager tuple
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    manager_id= '".$this->manager_id."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}

