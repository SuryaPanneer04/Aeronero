<?php
require '../../../connect.php';
include("../../../user.php");
$user_candid = $_SESSION['candidateid'];
 $id=$_REQUEST['id'];
 $dept_id=$_REQUEST['dept'];
$stmt = $con->prepare("SELECT a.id as aid,b.dept_name,c.div_name,d.designation_name,e.emp_name,a.employee_id FROM appraisal_master a LEFT JOIN z_department_master b ON a.dep_name=b.id LEFT JOIN division_master c ON a.div_name=c.id LEFT JOIN designation_master d ON a.dsgn_name=d.id LEFT JOIN staff_master e ON a.employee_id = e.id where a.id='$id'");

$stmt->execute(); 
$row = $stmt->fetch();
$employee_id = $row['employee_id'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
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

<div class="card card-primary">

<div class="card-header">

<h3 class="card-title"><font size="5">EDIT APPRAISAL DETAILS</font></h3>

<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>
<div class="card-body" id="printableArea">
<form role="form"  method="post" enctype="multipart/type">

<table class="table table-bordered">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>">

<tr>
<td>Department Name</td>
<td colspan="5">
<input type="text" class="form-control" id="department" name="department" value="<?php echo  $row['dept_name'];?>" readonly>
</td>
</tr>

<!-- tr>
<td>Round Name</td>
<td colspan="5">
<input type="text" class="form-control" id="round" name="round" value="<?php echo  $row['name'];?>" readonly>
</td>
</tr>

<tr>
<td>Division Name</td>
<td colspan="2">
<input type="text" class="form-control" id="division" name="division" value="<?php echo  $row['div_name'];?>" readonly>
</td>
</tr  -->

<tr>
<td>Designation Name</td>
<td colspan="2">
<input type="text" class="form-control" id="designation" name="designation" value="<?php echo  $row['designation_name'];?>" readonly>
</td>
</tr>

<tr>
<td>Employee Name</td>
<td colspan="2">
<input type="text" class="form-control" id="emp_name" name="emp_name" value="<?php echo  $row['emp_name'];?>" readonly>
</td>
</tr>


<table class="table table-bordered">
<h3><center>Appraisal Questions</center></h3>
<tbody>
<?php

$sql=$con->query("SELECT a.id as name_id,b.dept_name,a.question FROM appraisal_question a LEFT JOIN z_department_master b ON a.dep_name=b.id where a.appraisal_Master_id='$id'");


$cnt=0;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<input type="hidden" class="form-control" id="count" name="count[]"  value="<?php echo count(array($cnt));?>" readonly>
<input type="hidden" class="form-control" id="get_id" name="get_id<?php echo $cnt; ?>" value="<?php echo   $rows['name_id']; ?>">

<td><input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off"></td>

</tr>
<?php 
$cnt++;
 }?>
</tbody>
 </table>

</table>

<input type="button" name="submit" value="Update" class="btn btn-primary btn-md" style="float:right;" onclick="appraisal_update()">
<br>
<br>
</form>
</div>
</div>

<script>
function back()
{
	appraisal_master();
} 
</script>

<script>
 function appraisal_update()
    {
    var id=$('#id').val();
	var get_id=$('#get_id').val();
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id+"&get_id="+get_id,
    url:'qvision/masters/appraisal_master/update_appraisal_master.php',

    success:function(data)
    {
      if(data==0)
      { 
        alert('Not updated');
        appraisal_master()
      }
      else
      {
        alert("Updated Successfully");
		appraisal_master()
      }
      
    }       
    });
    }
</script>