<?php

// This file defines the operations used to display all manager tuples onto the browser 

// Include the database and object fiels
include_once '../config/database.php';
include_once '../objects/employee.php';



// Create connection with database
$database = new Database();
// Get handle to connection with database
$db = $database->getConnection();

// Create new manager object using the ds connection handle to establish
// a connection with the database
$employee = new employee($db);
// Retrieve the select all manager statement by calling read() behavior
$stmt = $employee->read();
$num = $stmt->rowCount();
        // check if more than 0 record found
        if($num>0){
         
            // employee array
            $employee_arr=array();
            $employee_arr['employee']=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $employee_item=array(
                    "emp_id" => $emp_id,
                    "name" => $name,
                    "dept_name" => $dept_name,
                    "phone" => $phone,
                    "email" => $email,
                    "salary" => $salary,
                    "start_date" => $start_date,
                );
                array_push($employee_arr["employee"], $employee_item);
            }
            echo json_encode($employee_arr["employee"]);
        }
        else{
            echo json_encode(array());
        }
?>




