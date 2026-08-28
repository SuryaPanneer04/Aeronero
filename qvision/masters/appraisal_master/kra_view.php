<?php
require '../../../connect.php';
include("../../../user.php");
$user_candid = $_SESSION['candidateid'];
 $id=$_REQUEST['id'];
 $dept_id=$_REQUEST['dept'];
$stmt = $con->prepare("SELECT a.id as aid,b.dept_name,c.div_name,d.designation_name,e.emp_name,a.status as app_master_sts FROM appraisal_master a 
LEFT JOIN z_department_master b ON a.dep_name=b.id 
LEFT JOIN division_master c ON a.div_name=c.id 
LEFT JOIN designation_master d ON a.dsgn_name=d.id 
LEFT JOIN staff_master e ON a.employee_id=e.id where a.id='$id'");

$stmt->execute(); 
$row = $stmt->fetch();
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
.card-primary:not(.card-outline)>.card-header{
background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.btn-dark{
	background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black !important;
}
</style>

<div class="card card-primary">

<div class="card-header">

<h3 class="card-title"><font size="5">KRA DETAILS</font></h3>

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

<tr>
<td>Designation Name</td>
<td colspan="2">
  <input type="text" class="form-control" id="design" name="design" value="<?php echo  $row['designation_name'];?>" readonly>
</td>
</tr>

<tr>
<td>Employee Name</td>
<td colspan="2">
  <input type="text" class="form-control" id="employeeName" name="employeeName" value="<?php echo  $row['emp_name'];?>" readonly>
</td>
</tr>

<table class="table table-bordered">
<h3><center>Appraisal Questions</center></h3>

<tbody>
    <tr>
      <th>S.No</th>
      <th>Questions</th>
    </tr>
<?php

$sql=$con->query("SELECT a.id as name_id,b.dept_name,a.question FROM appraisal_question a LEFT JOIN z_department_master b ON a.dep_name=b.id where a.appraisal_Master_id='$id'");


$cnt=0;
$sno = 1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<input type="hidden" class="form-control" id="count" name="count[]"  value="<?php echo count(array($cnt));?>" readonly>
<input type="hidden" class="form-control" id="get_id" name="get_id<?php echo $cnt; ?>" value="<?php echo   $rows['name_id']; ?>">


<td><label for="name_<?php echo $sno;?>"> <?php echo $sno; ?> </label></td>

<td><input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly></td>

</tr>
<?php 
$cnt++;
$sno++;
 }?>
</tbody>
 </table>

</table>

<?php if($row['app_master_sts'] == 0){ ?>
<input type="button" name="reject" value="KRA Reject" class="btn btn-danger " style="float:right;" onclick="kra_reject()">

<input type="button" name="submit" value="KRA Accept" class="btn btn-primary " style="float:right;margin-right: 10px;" onclick="kra_approve()">

<?php } ?>
<br>
<br>
</form>
</div>
</div>

<script>
function back()
{
	kra_approve_emp()
} 

 function kra_approve()
    {
    var id=<?php echo $id; ?>;
    var get_id=$('#get_id').val();
    var data = $('form').serialize();

    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id+"&get_id="+get_id, 
    url:'qvision/masters/appraisal_master/kra_update.php',

    success:function(data)
    {
      if(data==0)
      { 
        alert('Not updated');
        kra_approve_emp()
      }
      else
      {
        alert("Updated Successfully");
		kra_approve_emp()
      }
      
    }       
    });
    }

    function kra_reject()
    {
    var id=<?php echo $id; ?>;
    var get_id=$('#get_id').val();
    var data = $('form').serialize();

    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id+"&get_id="+get_id,
    url:'qvision/masters/appraisal_master/kra_reject.php',

    success:function(data)
    {
      if(data==0)
      { 
        alert('Not updated');
        kra_approve_emp()
      }
      else
      {
        alert("Rejected");
		kra_approve_emp()
      }
      
    }       
    });
    }
</script>