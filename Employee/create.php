<?php
$content = '

            <style>
            </style>

                <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Employee</h3>
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
                        <label for="exampleInputName1">Department</label>
                        <select id = "dept_opt" class="form-select" aria-label="Default select example">
                            <option selected>None</option>
                        </select>                   
                    </div>
                    





                        <div class="form-group">
                          <label for="exampleInputphone">Phone</label>
                          <input type="text" class="form-control" id="phone" placeholder="Enter Phone">
                        </div>



                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Salary</label>
                          <input type="text" class="form-control" id="salary" placeholder="Enter salary">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddEmployee()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
     $(document).ready(function(){
        $.ajax(
            {
                type: "POST",
                url:'../api/employee/create.php',
                dataType: 'json',
                data:{
                    action: "getDept"
                },
                success: function(data){
                    var response = "";
                    for (var dep in data)
                    {
                        response+= 
                        "<option value="+ data[dep].dept_name +">" + data[dep].dept_name + "</option>";
                    }
                    $(response).appendTo($("#dept_opt"));
                }

            }
        )
 
    
    });


 function getTodayDate() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;
    return today;
  }




  function AddEmployee(){
        $.ajax(
        {
            type: "POST",
            url: '../api/employee/create.php',
            dataType: 'json',
            data: {
                action: "create",
                name: $("#name").val(),
                department: $("#dept_opt").val(),
                phone: $("#phone").val(),
                email: $("#email").val(),      
                salary: $("#salary").val(),
                start_date: getTodayDate()
            },
            error: function (result) {
                alert("heeii");
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Manager!");
                    window.location.href = '/HR_Management/Employee';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>