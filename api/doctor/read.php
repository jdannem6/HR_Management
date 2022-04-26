<?php

// This file defines the operations used to display all doctor tuples onto the browser 

// Include the database and object fiels
include_once '../config/database.php';
include_once '../objects/doctor.php';

// Create connection with database
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new doctor object using the ds connection handle to establish
// a connection with the database
$doctor = new Doctor($db);

// Retrieve the select all doctors statement by calling read() behavior
$stmt = $doctor->read();

$num= $stmt->rowCount();



// If the number of doctor tuples within the table is not zero, print the
// tuples
if ($num > 0) {
    // Push all doctor tuples into this array
    // Keep fetching rows until there is no rows left to fetch within the table
    // produced by stmt

    // Create a doctors array to store all attributes of all doctors in table
    $doctors_arr = array();
    $doctors_arr["doctors"]=array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row); // take row from table within stmt so that its attributes
                    // can be stored in doctor_item
        $doctor_item = array(
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "password" => $password,
            "phone" => $phone,
            "gender" => $gender,
            "specialist" => $specialist,
            "created" => $created
        );
        // Add each doctor item to the doctor array
        array_push($doctors_arr["doctors"], $doctor_item);
    }

    // Print the json encoded version of each row to the browser
    echo json_encode($doctors_arr["doctors"]);
}
// Otherwise, if no doctor tuples in table, print the empty array
else {
    // Consider adding message along the lines "No tuples to print"
    echo json_encode(array());
}
?>




