<?php

// This file defines the structure of the form used to create a new doctor
// as well as the function used to actually create that new entry

// Define the main content within the master.php file
$content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Doctor</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Phone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Enter Phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios1" value="0" checked="">
                                        Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios2" value="1">
                                        Female
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Specialist</label>
                                <input type="text" class="form-control" id="specialist" placeholder="Enter Specialization">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" onClick="AddDoctor()" value="Submit"></input>
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
    // Define the behavior of the function used to add new doctors to the table
    function AddDoctor(){
        $.ajax({
            type: "POST",
            url: '../api/doctor/create.php',
            datatype: 'json',
            data: {
                // Create a data element which contains all the attributes of a doctor tuple
                // the values for each attribute comes from the value inserted in the corresponding
                // textbox (form) on the browser
                name: $("#name").val(), 
                email: $("#email").val(),
                password: $("#password").val(),
                phone: $("#phone").val(),
                gender: $("input[name='gender']:checked").val(),
                specialist: $("#specialist").val()
            },
            // Give error message if POST request fails
            error: function(result) {
                alert(result.responseText);
            },
            // Otherwise if POST request is completed
            success: function(result) {
                // If update successfully performed, indicate such to browser
                if (result['status'] == true) {
                    alert("Successfully Added New Doctor");
                    window.location.href = '/medibed/doctor';
                }
                // Otherwise, if update could not be performed, give update 
                // update failure message
                else {
                    alert(result['message']);
                }
            }

        
        });
    }
</script>