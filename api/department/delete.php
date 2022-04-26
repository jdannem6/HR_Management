<?php

// This files defines the operations used to delete a manager tuple from the table

// Include the dataset and object files so that the objects they define can be used
include_once '../config/database.php';
include_once '../objects/department.php';

// Create new database object
$database = new Database();
// Get handle to connection with this database
$db = $database->getConnection();

// Create new manager object using the ds connection handle to establish 
// connection between database and this object
$department = new Department($db);

// Get the id of the manager tuple to delete
$department->dept_name = $_POST['dept_name'];

// Remove the corresponding manager tuple
// If remove successful create a (status, message) pair describing
// deletion success
if($department->delete()){
    $department_arr = array(
        "status" => true,
        "message" => "Successfully removed!"
    );
}
// Otherwise if failure to delete, create corresponding (status, message) pair
else {
    $department_arr = array(
        "status" => false,
        "message" => "Department cannot be deleted"
    );
}

// Print the json encoded result of the deletion attempt to browser
print_r(json_encode($department_arr));
?>

