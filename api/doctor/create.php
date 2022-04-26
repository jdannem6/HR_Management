<?php 

// This file defines the operations used to create new doctor tuples within
// our tables in mySQL from the input on the browser

// include the database and all object files
include_once '../config/database.php';
include_once '../objects/doctor.php';

// Get connection with the database using database object
$database = new Database();
// db serves as our handle to the connection to our database
$db = $database->getConnection(); 


// Create new doctor object using the db connection handle to establish 
// the connection between this object and the db
$doctor = new Doctor($db);

// Set attribute values of doctor object
$doctor->name= $_POST['name'];
$doctor->email = $_POST['email'];
// Encode the password for security
$doctor->password = base64_encode($_POST['password']);
$doctor->phone = $_POST['phone'];
$doctor->gender = $_POST['gender'];
$doctor->specialist = $_POST['specialist'];
$doctor->created = date('Y-m-d H:i:s'); // Date obtained from server using 
                                        // the format specified here

// Now that all (except id which is automatically assigned) attributes are
// assigned, create doctor object
if ($doctor->create()){
    // If creation successful, create an array storing the attributes and a
    // status and message describing the fate of the creation
    $doctor_arr=array(
        "status" => true,
        "message" => "Successfully Signup!",
        "id" => $doctor->id,
        "name" => $doctor->name,
        "email" => $doctor->email,
        "phone" => $doctor->phone,
        "gender" => $doctor->gender,
        "specialist" => $doctor->specialist
     );
}
// Otherwise, if the doctor entry can not be added (in which case a tuple with
// that email already exists), created an array with a failure status and message
else {
    $doctor_array=array(
        "status" => false,
        "message"=> "Doctor with that email already exists!"

    );
}

// Print the array to doctor array to screen in json format
print_r(json_encode($doctor_arr));

?>