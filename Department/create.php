<?php

// This file defines the structure of the form used to create a new manager
// as well as the function used to actually create that new entry

// Define the main content within the master.php file
$content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Deparment</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputName1">Department Name</label>
                                <input type="text" class="form-control" id="dept_name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Phone</label>
                                <input type="email" class="form-control" id="phone" placeholder="Enter Phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Building</label>
                                <input type="email" class="form-control" id="building" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Budget</label>
                                <input type="email" class="form-control" id="budget" placeholder="Enter email">
                        </div>
                        </div>
                        
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" onClick="AddDepartment()" value="Submit"></input>
                        </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>';
            
// Include the main layout for the page
include('../master.php');
?>
<script>
  function AddDepartment(){

        $.ajax(
        {
            type: "POST",
            url: '../api/department/create.php',
            dataType: 'json',
            data: {
                dept_name: $("#dept_name").val(),
                phone: $("#phone").val(),        
                building: $("#building").val(),
                budget: $("#budget").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Department!");
                    window.location.href = '/HR/department';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>