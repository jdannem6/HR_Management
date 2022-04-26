<?php 

// This file defines the operations used to create new manager tuples within
// our tables in mySQL from the input on the browser

// include the database and all object files
include_once '../config/database.php';
include_once '../objects/department.php';

// Get connection with the database using database object
$database = new Database();
// db serves as our handle to the connection to our database
$db = $database->getConnection(); 


// Create new manager object using the db connection handle to establish 
// the connection between this object and the db
$department = new Department($db);

// Set attribute values of manager object using information retrieved from
// user input thorugh POST request
$department->dept_name= $_POST['dept_name'];
$deptartment->budget = $_POST['budget'];
$department->phone = $_POST['phone'];
$department->building = $_POST['building'];


// Now that all (except id which is automatically assigned) attributes are
// assigned, create manager object
if ($department->create()){
    // If creation successful, create an array storing the attributes and a
    // status and message describing the fate of the creation
    $department_arr=array(
        "status" => true,
        "message" => "Successfully Created New Department!",
        "dept_name" => $department->dept_name,
        "budget" => $deptartment->budget,
        "phone" => $department->phone,
        "building" => $department->building
     );
}
// Otherwise, if the manager tuple can not be added (in which case a tuple with
// that email already exists), created an array with a failure status and message
else {
    $department_arr=array(
        "status" => false,
        "message"=> "Department with that name already exists!"

    );
}

// Print the array to manager array to screen in json format
print_r(json_encode($department_arr));

?>