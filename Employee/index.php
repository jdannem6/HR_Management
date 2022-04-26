<?php
// Define the content which is displayed within the master.php file
  $content = '<div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                     <h3 class="box-title">Manager List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="employee" class="table table-bordered table-hover">
                        <thead>
                          <tr> 
                              <th>ID</th>
                              <th>Name</th>
                              <th>Department name</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Salary</th>
                              <th>Start day</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Department name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Salary</th>
                          <th>Start day</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
                <!-- /.box -->
                </div>
              </div>';

  include('../master.php');
?>

<!-- Start of page script -->
<script>
  $(document).ready(function(){
    // On document load, perform get request to load all tuples in database
    $.ajax({
      // Type specifies type of request: in this case, we are using a get request
      // to get data from a database
      type: "GET",
      // url of file which specifies how to ge the data
      url: "../api/employee/read.php",
      dataType: 'json',
      // upon success, this function creates tuples for each manager in the table 
      // and appends them to the response variable
      success: function(data) {
        var response="";
        for(var user in data){
          response += 
                "<tr>"+
                "<td>"+data[user].emp_id+"</td>"+
                "<td>"+data[user].name+"</td>"+
                "<td>"+data[user].dept_name+"</td>"+
                "<td>"+data[user].phone+"</td>"+
                "<td>"+data[user].email+"</td>"+
                "<td>"+data[user].salary+"</td>"+
                "<td>"+data[user].start_date+"</td>"+
                "<td><a href='update.php?id="+data[user].emp_id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].emp_id+"')>Remove</a></td>"+
                "</tr>";
        }
        // appends the response to the the table whose id=manager
        $(response).appendTo($("#employee"));
      }

    });
  });

  // This function takes a parameter named id and updates the database by 
  // removing the manager record with the corresponding id
  function Remove(id){
    var result= confirm("Are you sure you want to delete this Employee Record?");
    if (result == true) {
      $.ajax({
        // Post request used to update server's database
        type: "POST",
        // delete.php specifies how to perform the delete operation
        url: '../api/employee/delete.php',
        dataType: 'json',
        data: {
          id: id
        },
        // if POST request fails
        error: function(result) {
          alert(result.responseText);
        },
        // If POST request succeeds
        success: function(result) {
          // if manager record was successfully removed, send message to browser
          // indicating such
          if (result['status'] == true) {
            alert("Successfully Removed Employee!");
            window.location.reload();

          }
          // Otherwise, if it could not be deleted, print the message contained within
          // the deletion failure message
          else {
            alert(result['message']);
          }
        }
      });
    }
  }
</script>