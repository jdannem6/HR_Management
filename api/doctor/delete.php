<?php

// This files defines the operations used to delete a doctor tuple from the table

// Include the dataset and object files so that the objects they define can be used
include_once '../config/database.php';
include_once '../objects/doctor.php';

// Create new database object
$database = new Database();
// Get handle to connection with this database
$db = $database->getConnection();

// Create new doctor object using the ds connection handle to establish 
// connection between database and this object
$doctor = new Doctor($db);

// Get the id of the doctor tuple to delete
$doctor->id = $_POST['id'];

// Remove the corresponding doctor tuple
// If remove successful create a (status, message) pair describing
// deletion success
if($doctor->delete()){
    $doctor_arr = array(
        "status" => true,
        "message" => "Successfully removed!"
    );
}
// Otherwise if failure to delete, create corresponding (status, message) pair
else {
    $doctor_arr = array(
        "status" => false,
        "message" => "Doctor cannot be deleted; Maybe they are assigned to a patient!"
    );
}

// Print the json encoded result of the deletion attempt to browser
print_r(json_encode($doctor_arr));
?>


