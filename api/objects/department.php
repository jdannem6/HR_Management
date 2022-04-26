<?php
class Department{
 
    // database connection and table name
    private $conn;
    private $table_name = "department";
 
    // object properties
    public $dept_name;
    public $budget;
    public $phone;
    public $building;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all doctors
    function read(){
    
        // select all query
        $query = "SELECT
                    `dept_name`, `budget`, `phone`, `builidng`
                FROM
                    " . $this->table_name . " " // this empty quote might throw and error
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single dept data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `dept_name`, `budget`, `phone`, `building`
                FROM
                    " . $this->table_name . " 
                WHERE
                    dept_name= '".$this->dept_name."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create department
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`dept_name`, `budget`, `phone`, `building`)
                  VALUES
                        ('".$this->dept_name."', '".$this->budget."', '".$this->phone."', '".$this->building."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update dept 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    dept_name='".$this->dept_name."', budget='".$this->budget."', building='".$this->building."'
                WHERE
                    dept_name='".$this->dept_name."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete dept
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    dept_name= '".$this->dept_name."'";
        
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
                dept_name='".$this->dept_name."'";

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