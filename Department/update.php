<?php 

$content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Department</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputName1">Department Name</label>
                                    <input type="text" class="form-control" id="dept_name" placeholder="Enter Department Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Phone Number</label>
                                    <input type="email" class="form-control" id="phone" placeholder="Enter Phone">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Budget</label>
                                    <input type="text" class="form-control" id="budget" placeholder="Enter Budget">
                                </div>
                                <div class="form-group">
                                <label for="exampleInputName1">Building</label>
                                <input type="text" class="form-control" id="building" placeholder="Enter Building">
                            </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="button" class="btn btn-primary" onClick="UpdateDepartment()" value="Update"></input>
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
        $.ajax({
            type: "GET",
            url: "../api/department/read_single.php?dept_name=<?php echo $_GET['dept_name']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#dept_name').val(data['dept_name']);
                $('#phone').val(data['phone']);
                $('#budget').val(data['budget']);
                $('#building').val(data['building']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateDepartment(){
        $.ajax(
        {
            type: "POST",
            url: '../api/department/update.php',
            dataType: 'json',
            data: {
                dept_name: <?php echo $_GET['dept_name']; ?>,
                name: $("#phone").val(),
                phone: $("#budget").val(),
                email: $("#building").val()      

            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated Department!");
                    window.location.href = '/HR/department';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>