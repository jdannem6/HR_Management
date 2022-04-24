<?php
class Doctor {

    // Each relational table must be able to connect to the database, so it 
    // must contain the connection to the database as well as the table its
    // tuples belong to
    private $conn;
    private $table_name = "doctors";

    // object properties
    public $id;
    public $name;
    public $email;
    public $password;
    public $phone;
    public $gender;
    public $specialist;
    public $created;

    // A constructor which creates a connection with the database as soon as 
    // Doctor object is created
    public function __construct($db){
        $this->conn=$db;
    
    }

    // read all tuples of doctors relation
    function read() {
        // select all doctors within relation
        $query = "SELECT
                    `id`, `name`, `email`, `password`, `phone`, `gender`, `specialist`, `created`
                    FROM
                    " . $this->table_name . "
                    ORDER BY 
                        id DESC";
        // Make the query statement a prepared statement
        $stmt = $this->conn->prepare($query);

        // Execute the query statement
        $stmt->execute();
        
        // Return the statement results so that the resulting tuples can be shown on screen
        return $stmt;

    }

    // Read a single doctor tuple
    function read_single(){

        // Select query where id matches this doctor object's id
        $query= "SELECT
                    `id`, `name`, `email`, `password`, `phone`, `gender`, `specialist`, `created`
                FROM 
                    ".$this->table_name."
                WHERE 
                    id='".$this->id."'";
        // Create a prepared statememt
        $stmt=$this->conn->prepare($query);

        // Execute the selection query and return the result
        $stmt->execute();
        return $stmt;

    }

    // Creation of doctor tuple
    function create(){

        // make sure the object doesn't already exist
        if ($this->isAlreadyExists()){
            return false;
        }

        // Otherwise, if the doctor tuple does not yet exist, create a new one
        $query = "INSERT INTO " . $this->table_name . "
                    (`name`, `email`, `password`, `phone`, `gender`, `specialist`, `created`)
                VALUES
                    ('".$this->name."', '".$this->email."', '".$this->password."', '".$this->phone."', '".$this->gender."', '".$this->specialist."', '".$this->created."')";
        
        // Create a prepared statement from this query
        $stmt = $this->conn->prepare($query);

        // Attempt to execute the query
        if ($stmt->execute()) {
            // We have defined our SQL to automatically increment an id variable.
            // Because of this we don't need to actually specify the ID of the 
            // doctor tuple when making the insertion. Within the backend, however,
            // the doctor object still needs that ID, so we obtain that ID value
            // from the SQL table and store it as this doctor object's ID attribute
            $this->id = $this->conn->lastInsertID();
            return true; // Report success of insertion
        }
        // If the statement fails, return false
        return false;
    }

    // Update doctor entry
    function update(){

        // query to update doctor tuple
        $query = "UPDATE 
                    ".$this->table_name."
                SET
                    name='".$this->name."', email='".$this->email."', password='".$this->phone."', gender='".$this->gender."', specialist='".$this->specialist."', created='".$this->created."'
                WHERE
                    id='".$this->id."'";

        // Create a prepare statement for the update query
        $stmt=$this->conn->prepare($query);

        // Attempt to execute the update query
        if ($stmt->execute()){
            return true;
        }
        // Return false if update failed
        return false;
    }

    
    // delete a doctor tuple within table
    function delete(){

        // Construct the query given the id of the doctor to be deleted
        $query = "DELETE 
            FROM
                " . $this->table_name ." 
            WHERE 
                id= '".$this->id."'";   

        // Create a prepared statement from the query
        $stmt=$this->conn->prepare($query);
        
        // Attempt to execute the deletion query
        if ($stmt->execute()) {
            return true;
        }
        // Return false if fail to delete
        return false;

    }

    // Auxillary function used to determine whether a doctor tuple is already
    // in the table
    function isAlreadyExists(){
        // We use a selection query on the email attribute, ensuring that each
        // tuple must have a unique email. The side effect of using email here
        // is that the same doctor can show up multiple times if they use different
        // emails

        // May want to change this
        $query= "SELECT 
            FROM
                ".$this->table_name."
            WHERE
                email='".$this->email."'";
        // Create prepared statement for the selection
        $stmt= $this->conn->prepare($query);

        // Execute the query
        $stmt->execute();
        // This doctor already exists in the table if there are any rows 
        // with the given email
        if ($stmt->rowCount() > 0 )
            return true;
        // Otherwise, this doctor has not yet been added
        return false;
    }


}

?>