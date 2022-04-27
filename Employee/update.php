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

                        <div class="form-group">
                          <label for="exampleInputName1">Start date</label>
                          <input type="text" class="form-control" id="start_date" placeholder="">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateEmployee()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('../master.php');
?>
<script>
    var id = "";
    id = <?php echo $_GET['id']; ?> ;
    $(document).ready(function(){



   
        $.ajax({
            type: "POST",
            url:'../api/employee/read_single.php',
            dataType: 'json',
            data:{
                emp_id: id 
            },
            success: function(data) {
                $('#name').val(data['name']);
                $('#phone').val(data['phone']);
                $('#email').val(data['email']);
                $('#salary').val(data['salary']);
                $('#start_date').val(data['start_date']);
                $.ajax(
                    {
                        type: "POST",
                        url:'../api/employee/create.php',
                        dataType: 'json',
                        data:{
                            action: "getDept"
                        },
                        success: function(data2){
                            
                            var response = "";
                            var dept = "";
                            dept = data['dept_name'];
                            for (var dep in data2)
                            {
                                var dateDept ="";
                                dataDept = data2[dep].dept_name;
                                response+= 
                                "<option " + (dataDept == dept? "selected ":"") + "value="+ dataDept +">" + dataDept + "</option>";
                            }
                            $(response).appendTo($("#dept_opt"));
                        }

                    }
                )               
            },
            error: function (result) {
                console.log(result);
            },
        });


        
 


});





    function UpdateEmployee(){
        $.ajax(
        {
            type: "POST",
            url: '../api/employee/update.php',
            dataType: 'json',
            data: {
                emp_id: id,
                name: $("#name").val(),
                department: $("#dept_opt").val(),
                phone: $("#phone").val(),
                email: $("#email").val(),      
                salary: $("#salary").val(),
                start_date: $("#start_date").val(),     

            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated Managed!");
                    window.location.href = '/HR_Management/Employee';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>