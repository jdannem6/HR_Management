<?php 

$content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Manager</h3>
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
                                    <label for="exampleInputEmail11">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Enter Email">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="button" class="btn btn-primary" onClick="UpdateManager()" value="Update"></input>
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
            url: "../api/doctor/read_single.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#name').val(data['name']);
                $('#email').val(data['email']);
                $('#password').val(data['password']);
                $('#phone').val(data['phone']);
                $('#gender'+data['gender']).prop("checked", true);
                $('#specialist').val(data['specialist']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateManager(){
        $.ajax(
        {
            type: "POST",
            url: '../api/manager/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                name: $("#name").val(),
                phone: $("#phone").val(),
                email: $("#email").val()      

            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated Managed!");
                    window.location.href = '/HR/manager';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>