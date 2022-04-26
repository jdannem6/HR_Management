<?php

// This file defines the operations used to update the attributes of a doctor
// tuple

// Include the database and object files so that the manager and database objects
// defined within those files can be referenced here
include_once '../config/database.php';
include_once '../objects/department.php';

// Create a database object
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new manager object, using ds handle to create connection with database
$department = new Department($db);

// Get the new values of this manager's attributes
$department->dept_name = $_POST['dept_name'];
$department->budget = $_POST['budget'];
$department->phone = $_POST['phone'];
$department->building= $_POST['building'];

// Update the manager object with the specified values
// If update succeeds, give successful (status, message)
if ($department->update()){
    $department_arr = array(
        "status" => true,
        "message" => "Successfully updated!"
    );
}
// Otherwise, fi update fails, give failure (status, message)
else {
    $department_arr = array(
        "status" => false,
        "message" => "Email already exists!"
    );
}

// Print the json encoded status, message to browser
print_r(json_encode($department_arr));
?>