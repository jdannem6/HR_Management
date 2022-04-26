<?php 

// This file defines the operations used to read a specific manager tuple

// Include the database and object files such that the objects within
// those files can be referenced here
include_once '../config/database.php';
include_once '../objects/department.php';

// Create database object
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new manager object, using db connection handle to establish connection
// with our database
$department = new Department($db);

// Get the id of the manager whose tuple is to be read
// If the id value has been set (not null or invalid), set the managers
// id equal to the provided id. Otherwise, we there's no matching
// id, so we can't read anything: kill the function with die
$department->dept_name = isset($_GET['dept_name']) ? $_GET['dept_name'] : die();


// select all manager tuples matching this id
$stmt = $department->read_single();

// if there is a tuple with matching id, print its attributes to browser
if($stmt->rowCount()>0) {
    // get the selected row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Create an array containing the attributes of the selected tuple
    $department_arr = array(
        "dept_name" => $row['dept_name'],
        "budget" => $row['budget'],
        "phone" => $row['phone'],
        "building" => $row['building']
    );
}

// Print the json encoded manager tuple to browser
print_r(json_encode($department_arr));

?>