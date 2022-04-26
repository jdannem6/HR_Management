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
                            <h3 class="box-title">Add Manager</h3>
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
                                <label for="exampleInputName1">Phone</label>
                                <input type="email" class="form-control" id="phone" placeholder="Enter Phone">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                        </div>
                        
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" onClick="AddManager()" value="Submit"></input>
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
  function AddManager(){

        $.ajax(
        {
            type: "POST",
            url: '../api/manager/create.php',
            dataType: 'json',
            data: {
                name: $("#name").val(),
                phone: $("#phone").val(),        
                email: $("#email").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Manager!");
                    window.location.href = '/HR/manager';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>