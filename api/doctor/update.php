<?php

// This file defines the operations used to update the attributes of a doctor
// tuple

// Include the database and object files so that the doctor and database objects
// defined within those files can be referenced here
include_once '../config/database.php';
include_once '../objects/doctor.php';

// Create a database object
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new doctor object, using ds handle to create connection with database
$doctor = new Doctor($db);

// Get the new values of this doctor's attributes
$doctor->id = $_POST['id'];
$doctor->name = $_POST['name'];
$doctor->email = $_POST['email'];
// encode the password for security
$doctor->password = base64_encode($_POST['password']); 
$doctor->phone = $_POST['phone'];
$doctor->gender = $_POST['gender'];
$doctor->specialist = $_POST['specialist'];
// No updating of created because the time this tuple was created will
// never change

// Update the doctor object with the specified values
// If update succeeds, give successful (status, message)
if ($doctor->update()){
    $doctor_arr = array(
        "status" => true,
        "message" => "Successfully updated!"
    );
}
// Otherwise, fi update fails, give failure (status, message)
else {
    $doctor_arr = array(
        "status" => false,
        "message" => "Email already exists!"
    );
}

// Print the json encoded status, message to browser
print_r(json_encode($doctor_arr));
?>

