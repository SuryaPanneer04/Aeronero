<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
<div class="card-header">
 <h3 class="card-title"><font size="5">APPRAISAL ROUND ADD</font></h3>
	<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
   </div>


<form method="POST" > <!--action="qvision/masters/appraisal_round_master/appraisalrounds_submit.php" -->
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<table class="table table-bordered">

<tr>
<td>Name:</td>
<td colspan="2"><input type="text" class="form-control" id="name" name="name" ></td>
</tr>

<tr>
<td>Status</td>
<td colspan="2">
<select class="form-control" name="status" id="status">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="0">InActive</option>
</select>
</td>
</tr>
</table>

<input type="button" class="btn btn-success" name="save" onclick="insert_round()" value="save">
</form>
</div>
<script>
function back()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/appraisal_round_master/appraisal_rounds.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
function insert_round()
    {
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data,
    url:'qvision/masters/appraisal_round_master/appraisalrounds_submit.php',	
    success:function(data)
	{ 
		alert("Entry Successfully");
		appraisal_round_master()
	  }
    });
   }
  </script>
