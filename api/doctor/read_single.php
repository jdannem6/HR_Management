<?php 

// This file defines the operations used to read a specific doctor tuple

// Include the database and object files such that the objects within
// those files can be referenced here
include_once '../config/database.php';
include_once '../objects/doctor.php';

// Create database object
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new doctor object, using db connection handle to establish connection
// with our database
$doctor = new Doctor($db);

// Get the id of the doctor whose tuple is to be read
// If the id value has been set (not null or invalid), set the doctors
// id equal to the provided id. Otherwise, we there's no matching
// id, so we can't read anything: kill the function with die
$doctor->id = isset($_GET['id']) ? $_GET['id'] : die();


// select all doctor tuples matching this id
$stmt = $doctor->read_single();

// if there is a tuple with matching id, print its attributes to browser
if($stmt->rowCount()>0) {
    // get the selected row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Create an array containing the attributes of the selected tuple
    $doctor_arr = array(
        "id" => $row['id'],
        "name" => $row['name'],
        "email" => $row['email'],
        "password" => $row['password'],
        "phone" => $row['phone'],
        "gender" => $row['gender'],
        "specialist" => $row['specialist'],
        "created" => $row['created']
    );
}

// Print the json encoded doctor tuple to browser
print_r(json_encode($doctor_arr));

?>


