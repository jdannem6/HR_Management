<?php

// This files defines the operations used to delete a manager tuple from the table

// Include the dataset and object files so that the objects they define can be used
include_once '../config/database.php';
include_once '../objects/manager.php';

// Create new database object
$database = new Database();
// Get handle to connection with this database
$db = $database->getConnection();

// Create new manager object using the ds connection handle to establish 
// connection between database and this object
$manager = new Manager($db);

// Get the id of the manager tuple to delete
$manager->manager_id = $_POST['manager_id'];

// Remove the corresponding manager tuple
// If remove successful create a (status, message) pair describing
// deletion success
if($manager->delete()){
    $manager_arr = array(
        "status" => true,
        "message" => "Successfully removed!"
    );
}
// Otherwise if failure to delete, create corresponding (status, message) pair
else {
    $manager_arr = array(
        "status" => false,
        "message" => "Manager cannot be deleted; Maybe they are assigned to a patient!"
    );
}

// Print the json encoded result of the deletion attempt to browser
print_r(json_encode($manager_arr));
?>


