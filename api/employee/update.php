<?php

// This file defines the operations used to update the attributes of a doctor
// tuple

// Include the database and object files so that the manager and database objects
// defined within those files can be referenced here
include_once '../config/database.php';
include_once '../objects/employee.php';

// Create a database object
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new manager object, using ds handle to create connection with database
$employee = new Employee($db);

// Get the new values of this manager's attributes
$employee->id = $_POST['emp_id'];
$employee->name = $_POST['name'];
$employee->department = $_POST['department'];
$employee->phone = $_POST['phone'];
$employee->email = $_POST['email'];
$employee->salary = $_POST['salary'];
$employee->start_date = $_POST['start_date'];

// Update the manager object with the specified values
// If update succeeds, give successful (status, message)
if ($employee->update()){
    $employee_arr = array(
        "status" => true,
        "message" => "Successfully updated!"
    );
}
// Otherwise, fi update fails, give failure (status, message)
else {
    $employee_arr = array(
        "status" => false,
        "message" => "Email already exists!"
    );
}

// Print the json encoded status, message to browser
print_r(json_encode($employee_arr));
?>

