<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$user_candid = $_SESSION['candidateid'];
$emp = $con->query("select s.id,s.emp_name,s.dep_id,z.dept_name from staff_master s LEFT JOIN z_department_master z ON s.dep_id=z.id where candid_id='$user_candid'");
$emp_no = $emp->fetch();
$emp_id = $emp_no['id'];
$emp_depid = $emp_no['dep_id'];
$emp_dep = $emp_no['dept_name'];
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
<h3 class="card-title"><font size="5">SELF APPRAISAL </font></h3>
</div>

<form method="POST" action="">

<input type="hidden" name="personid" id="personid" value="<?php echo $user_candid; ?>">
<input type="hidden" name="userrole" id="userrole" value="<?php echo $userrole; ?>">
<input type="hidden" name="emp_no" id="emp_no" value="<?php echo $emp_id; ?>">
<table class="table table-bordered">

<tr>
<td>Department Name</td>
<td colspan="2">
<input type="text" id="department" name="department" class="form-control" value="<?php echo $emp_dep; ?>" readonly> 
</td>
</tr>


<table class="table table-bordered" id="question_view">
<tbody>
<tr> <td colspan='2'> <h3><center>Appraisal Questions</center></h3> </td> </tr>
<?php

$sql=$con->query("SELECT a.id,a.question,a.dep_name FROM self_appraisal_question a where a.dep_name='$emp_depid' ");

$count = $sql->rowCount();
$cnt=0;
?>
<tr> 
<td> Questions </td>
<td> Rating</td>
<input type="hidden" name="count"  id="rate_totcnt" value="<?php echo $count; ?>">
</tr>
<?php
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{ 
?>
<tr>
<td>
<input type="hidden" name="qid<?php echo $cnt; ?>[]"  id="qid" value="<?php echo $qid=$rows['id']; ?>">
<input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly></td>

<td style="display: flex; justify-content: space-around; align-items: baseline;">
<label for="performance"> 1</label>
<input type="radio" name="rating<?php echo $cnt; ?>[]"   id="performance_1" value="1">

<label for="performance"> 2</label>
<input type="radio" name="rating<?php echo $cnt; ?>[]"  id="performance_1" value="2">

<label for="performance"> 3</label>
<input type="radio" name="rating<?php echo $cnt; ?>[]"  id="performance_1" value="3">

<label for="performance"> 4</label>
<input type="radio" name="rating<?php echo $cnt; ?>[]"  id="performance_1" value="4">

<label for="performance"> 5</label>
<input type="radio" name="rating<?php echo $cnt; ?>[]"  id="performance_1" value="5">
</td>

</tr>
<?php 
$cnt++;
 }?>
</tbody>
</table>


<!-- table class="table table-bordered">
<tr>
<td>Remarks</td>
<td colspan="2">
<textarea class="form-control" id="remark" name="remark"> </textarea></td>
</tr>
</table -->

</table>
<input type="button" name="submit" value="Submit" class="btn btn-primary" style="float:right;position: relative;width: 100px;right: 10px;" onclick="submit_appraisal()">

<!-- input type="button" name="save" value="Save" class="btn btn-primary" style="float:right;position: relative;width: 100px;right: 20px;" onclick="save_appraisal()" -->
</form>
<br>
</div>


<script>
function submit_appraisal()
{    
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data,
    url:"qvision/appraisal/self_appraisal/selfappraisal_submit.php",
    success:function(data)
    {  
      if(data==0)
	  {
		alert("Submit Failed");
		self_appraisal(); 
	  }		  
      else{
		alert("Submitted Successfully");
		self_appraisal();  
	  }
    }       
    });
}
</script>
