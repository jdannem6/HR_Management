<?php
// Define the content which is displayed within the master.php file
  $content = '<div class="row">
                <div class="col-xs-12">
                  <div class="box">
                    <div class="box-header">
                     <h3 class="box-title">Department List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="department" class="table table-bordered table-hover">
                        <thead>
                          <tr> 
                              <th>Department Name</th>
                              <th>Phone</th>
                              <th>Building</th>
                              <th>Budget</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Department Name</th>
                            <th>Phone</th>
                            <th>Building</th>
                            <th>Budget</th>
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
      url: "../api/department/read.php",
      dataType: 'json',
      // upon success, this function creates tuples for each manager in the table 
      // and appends them to the response variable
      success: function(data) {
        var response="";
        for(var user in data){
          response += 
          //console.log(data[user].manager_id);
            "<tr>"+
              "<td>"+data[user].dept_name+"</td>"+
              "<td>"+data[user].phone+"</td>"+
              "<td>"+data[user].building+"</td>"+
              "<td>"+data[user].budget+"</td>"+
              "<td><a href='update.php?dept_name="+data[user].dept_name+"'>Edit</a> | <a href='#' onClick=Remove('"+data[user].dept_name+"')>Remove</a></td>"+
            "</tr>"
    
        }
        // appends the response to the the table whose id=manager
        $(response).appendTo($("#department"));
      }

    });
  });

  // This function takes a parameter named id and updates the database by 
  // removing the manager record with the corresponding id
  function Remove(dept_name){
    var result= confirm("Are you sure you want to delete the Department Record?");
    if (result == true) {
      $.ajax({
        // Post request used to update server's database
        type: "POST",
        // delete.php specifies how to perform the delete operation
        url: '../api/department/delete.php',
        dataType: 'json',
        data: {
          dept_name: dept_name
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
            alert("Successfully Removed Department!");
            window.location.href = '/HR/department';

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