<?php

// This file defines the operations used to display all manager tuples onto the browser 

// Include the database and object fiels
include_once '../config/database.php';
include_once '../objects/department.php';



// Create connection with database
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new manager object using the ds connection handle to establish
// a connection with the database
$department = new Department($db);

// Retrieve the select all manager statement by calling read() behavior
$stmt = $department->read();

$num= $stmt->rowCount();

// If the number of manager tuples within the table is not zero, print the
// tuples
if ($num > 0) {
    // Push all manager tuples into this array
    // Keep fetching rows until there is no rows left to fetch within the table
    // produced by stmt

    // Create a manager array to store all attributes of all managers in table
    $department_arr = array();
    $department_arr["department"]=array();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row); // take row from table within stmt so that its attributes
                    // can be stored in manager_item
        $department_item = array(
            "dept_name" => $dept_name,
            "budget" => $budget,
            "phone" => $phone,
            "building" => $building
        );
        // Add each manageritem to the manager array
        array_push($department_arr["department"], $department_item);
    }

    // Print the json encoded version of each row to the browser
    echo json_encode($department_arr["department"]);
}
// Otherwise, if no managers tuples in table, print the empty array
else {
    // Consider adding message along the lines "No tuples to print"
    echo json_encode(array());
}
?>




