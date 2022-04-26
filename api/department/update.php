<?php

// This file defines the operations used to update the attributes of a doctor
// tuple

// Include the database and object files so that the manager and database objects
// defined within those files can be referenced here
include_once '../config/database.php';
include_once '../objects/manager.php';

// Create a database object
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new manager object, using ds handle to create connection with database
$manager = new Manager($db);

// Get the new values of this manager's attributes
$manager->id = $_POST['manager_id'];
$manager->name = $_POST['name'];
$manager->phone = $_POST['phone'];
$manager->email= $_POST['email'];

// Update the manager object with the specified values
// If update succeeds, give successful (status, message)
if ($manager->update()){
    $manager_arr = array(
        "status" => true,
        "message" => "Successfully updated!"
    );
}
// Otherwise, fi update fails, give failure (status, message)
else {
    $manager_arr = array(
        "status" => false,
        "message" => "Email already exists!"
    );
}

// Print the json encoded status, message to browser
print_r(json_encode($manager_arr));
?>

