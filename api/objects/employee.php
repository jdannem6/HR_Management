<?php
class Employee{
 
    // database connection and table name
    private $conn;
    private $table_name = "employee";
 
    // object properties
    public $id;
    public $name;
    public $department;
    public $phone;
    public $email;
    public $salary;
    public $start_date;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all employee
    function read(){
        $query = "SELECT
        `emp_id`, `name`, `dept_name`, `phone`,`email`,`salary`,`start_date`
    FROM
        " . $this->table_name . " 
    ORDER BY
        emp_id DESC";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();
    return $stmt;
    }

    // get single employee data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `emp_id`, `name`, `dept_name`, `phone`,`email`,`salary`,`start_date`
                FROM
                    " . $this->table_name . " 
                WHERE
                    emp_id= '".$this->id."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create employee
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`name`, `dept_name`, `phone`,`email`,`salary`,`start_date`)
                  VALUES
                        ('".$this->name."', '".$this->department."', '".$this->phone."', '".$this->email."', '".$this->salary."', '".$this->start_date."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update employee 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', dept_name='".$this->department."', phone='".$this->phone."', email='".$this->email."', salary='".$this->salary."', start_date='".$this->start_date."'
                WHERE
                    emp_id='".$this->id."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete doctor
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    emp_id= '".$this->id."'";
        
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