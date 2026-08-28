<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #ff8b3d !important;
}
.card-primary:not(.card-outline)>.card-header{
color: white !important;
}
.btn-dark{
background-color: rgb(237, 93, 0) !important;
    color: rgb(60, 8, 8) !important;
    border-color: rgb(237, 93, 0) !important;
}
</style>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">


   <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5"><b>ADD RESOURCE</b></font></h3>
			
                <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger">BACK</a>
              </div>
			 
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
      
     
        <tr>
        <td>Resource Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Resource Name" id="resource" name="resource"></td>
        </tr>
      
		<tr>
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
       
		
        <td colspan="6"><input type="button" class="btn btn-dark" value="Save"  style="float:right;color:white !important;" name="submit" onclick="insert_resource()" value="save"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

<script>
function insert_resource() {
    var id = 0;

    var data = $('form').serialize() + "&id=" + id;

    $.ajax({
        type: 'POST',
        url: "qvision/masters/Resource_master/resource_submit.php",
        data: data,
        success: function(response) {
            if (response == 0) {
                alert("Record Created Successfully");
            } else {
                alert("Record Not Inserted");
            }
            resource_master();
        }
    });
}

function back() {
    resource_master();
}
</script>