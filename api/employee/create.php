<?php 

// This file defines the operations used to create new manager tuples within
// our tables in mySQL from the input on the browser

// include the database and all object files
include_once '../config/database.php';
include_once '../objects/employee.php';
include_once '../objects/department.php';

// Get connection with the database using database object
$database = new Database();
// db serves as our handle to the connection to our database
$db = $database->getConnection(); 


// Create new manager object using the db connection handle to establish 
// the connection between this object and the db

// Set attribute values of manager object using information retrieved from
// user input thorugh POST request

if(isset($_POST["action"]))
{
    $database = new Database();
    $db = $database->getConnection();
    if($_POST["action"] == "getDept")
    {
        
        $department = new Department($db);
        $stmt = $department->read();
        $num = $stmt->rowCount();
        // check if more than 0 record found
        if($num>0){
         
            // employee array
            $dept_arr=array();
            $dept_arr['dept']=array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $dept_item=array(
                    "dept_name" => $dept_name,
                );
                array_push($dept_arr["dept"], $dept_item);
            }
            echo json_encode($dept_arr["dept"]);
        }
        else{
            echo json_encode(array());
        }


    }
    else if($_POST["action"] == "create")
    {
        $employee = new Employee($db);
        $employee->name = $_POST['name'];
        $employee->department = $_POST['department'];
        $employee->phone = $_POST['phone'];
        $employee->email = $_POST['email'];
        $employee->salary = $_POST['salary'];
        $employee->start_date = date('Y-m-d H:i:s');

        // create the doctor
        if($employee->create()){
            $employee_arr=array(
                "status" => true,
                "message" => "Successfully added!",
            
                "name" => $employee->name,
                "department" => $employee->department,
                "phone" => $employee->phone,
                "email" => $employee->email,
                "salary" => $employee->salary,
                "start_date" => $employee->start_date
            );
        }
        else{
            $employee_arr=array(
                "status" => false,
                "message" => "Email already exists!"
            );
            }
        print_r(json_encode($employee_arr));
    }
}

?>