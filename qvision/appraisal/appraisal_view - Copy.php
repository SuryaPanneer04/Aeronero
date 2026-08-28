<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole']; 
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id as aid,a.emp_name as emp_id,b.dept_name,c.div_name,d.designation_name,e.emp_name,a.remark, a.from_date,a.person_id as pid,f.name as rname,a.salary,e.salary_amount,a.status,s.emp_name as pname FROM appraisal_details a 
LEFT JOIN z_department_master b ON a.dep_name=b.id 
LEFT JOIN division_master c ON a.div_name=c.id 
LEFT JOIN designation_master d ON a.new_designation=d.id 
LEFT JOIN staff_master e ON a.emp_name=e.id  
LEFT JOIN staff_master s ON a.person_id=s.id  
LEFT JOIN appraisal_rounds f ON a.round_id=f.id  
where a.id='$id' "); //and a.person_id='$candidateid'


$stmt->execute(); 
$row = $stmt->fetch();
$per_id = $row['pid'];
$emp_id = $row['emp_id'];
$emp_new_salary = $row['salary'];
$emp_salary = $row['salary_amount'];
//echo $emp_new_salary; echo"<br>";
//echo $emp_salary; echo"<br>";
$per_salary = $emp_salary * $emp_new_salary / 100;
//echo $per_salary; echo"<br>";
$new_salary = $emp_salary + $per_salary;
//echo $new_salary;
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

<h3 class="card-title"><font size="5">VIEW APPRAISAL DETAILS</font></h3>

<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>
<div class="card-body" id="printableArea">
<form role="form"  method="post" enctype="multipart/type">
<input type="hidden" class="form-control" id="aid" name="aid" value="<?php echo $row['aid'];?>" readonly>
<?php 
if(($userrole=='R001')){
?>

<table class="table table-bordered">

<tr>
<td>Department Name</td>
<td colspan="2">
<input type="text" class="form-control" id="division" name="division" value="<?php echo  $row['dept_name'];?>" readonly>
</td>
</tr>

<tr>
<td>Employee Name</td>
<td colspan="2">
<input type="hidden" class="form-control" id="emp" name="emp" value="<?php echo  $row['emp_id'];?>" readonly>
<input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $row['emp_name'];?>" readonly>
</td>
</tr>

<tr id="desgn">
<td>Designation</td>
<td colspan="2">
<input type="text" class="form-control" id="designation" name="designation" value="<?php echo  $row['designation_name'];?>" readonly>
</td>
</tr>

<tr id="sal">
<td>Salary(In Percentage)</td>
<td colspan="2">
<input type="text" class="form-control" id="salary_percent" name="salary_percent" value="<?php echo $emp_new_salary;?>" readonly>
</td>
</tr>

<!-- tr id="sal">
<td>Salary </td>
<td colspan="2">
<input type="text" class="form-control" id="new_salary" name="new_salary" value="<?php echo  $new_salary;?>" readonly>
</td>
</tr -->



<table class="table table-bordered">
<div class="hrheader"> 
<h4><center>Appraisal </center></h4-->
</div>
<tbody>

<?php   // Appraisal view
 $remark = $con->query("SELECT id,remark,from_date FROM appraisal_details where emp_name='$emp_id' AND person_id='$per_id'");
 while($remark_row = $remark->fetch(PDO::FETCH_ASSOC)) 
 {

?>
<tr>
<td>Month</td>
<td>
<input type="text" class="form-control" id="month_type_hr" name="month_type" value="<?php echo $remark_row['from_date'];?>" readonly>
</td>
</tr>

<tr>
<td>Remarks</td>
<td colspan="2">
<input type="text" class="form-control" id="remark" name="remark" value="<?php echo  $remark_row['remark'];?>" readonly>
</td>
</tr>
<?php
 }
?>


<?php
$sql=$con->query("SELECT a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id='$per_id' ");

/* echo "SELECT a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id='53'"; */

$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>

<td><input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly></td>

<td style="display: flex; justify-content: space-around; align-items: baseline;">

<label for="performance"> 1</label>
<input type="radio" name="rating<?php echo $cnt; ?>"   id="rate_<?php echo $cnt; ?>" value="1" 
<?php if($rows['rating']=='1'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 2</label>
<input type="radio" name="rating<?php echo $cnt; ?>"  id="rate_<?php echo $cnt; ?>" value="2"
<?php if($rows['rating']=='2'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 3</label>
<input type="radio" name="rating<?php echo $cnt; ?>"  id="rate_<?php echo $cnt; ?>" value="3"
<?php if($rows['rating']=='3'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 4</label>
<input type="radio" name="rating<?php echo $cnt; ?>"  id="rate_<?php echo $cnt; ?>" value="4"
<?php if($rows['rating']=='4'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 5</label>
<input type="radio" name="rating<?php echo $cnt; ?>"  id="rate_<?php echo $cnt; ?>" value="5"
<?php if($rows['rating']=='5'){ echo "checked";} else{echo "disabled";} ?>>
</td>

</tr>
<?php 
$cnt++;
}
?>
</tbody>
 </table>




<table class="table table-bordered"> 
<div class="mdheader">
<h4><center>Appraisal By MD</center></h4>
</div>
<tbody>
<?php
 $remark1 = $con->query("SELECT id,remark,from_date FROM appraisal_details where emp_name='$emp_id' AND person_id='$candidateid'");
 while($remark_row1 = $remark1->fetch(PDO::FETCH_ASSOC)) 
 {

?>
<tr>
<td>Month</td>
<td>
<input type="text" class="form-control" id="month_type_md" name="month_type_md" value="<?php echo $remark_row1['from_date'];?>" readonly>
</td>
</tr>

<tr>
<td>Remarks</td>
<td colspan="2">
<input type="text" class="form-control" id="remark_md" name="remark" value="<?php echo  $remark_row1['remark'];?>" readonly>
</td>
</tr>
<?php
 }
?>


<?php
$sql2=$con->query("SELECT a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id=1 ");

$count =$sql2->rowcount();
$cnt1=1;
while($rows1 = $sql2->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<input type="hidden" id="count" name="count" value="<?php echo  $count; ?>">
<td><input type="text" class="form-control" id="question_11" name="questions<?php echo $cnt1; ?>" value="<?php echo  $rows1['question']; ?>" autocomplete="off" readonly></td>

<td style="display: flex; justify-content: space-around; align-items: baseline;">

<label for="performance"> 1</label>
<input type="radio" name="ratings<?php echo $cnt1; ?>"   id="rates_<?php echo $cnt1; ?>" value="1" 
<?php if($rows1['rating']=='1'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 2</label>
<input type="radio" name="ratings<?php echo $cnt1; ?>"  id="rates_<?php echo $cnt1; ?>" value="2"
<?php if($rows1['rating']=='2'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 3</label>
<input type="radio" name="ratings<?php echo $cnt1; ?>"  id="rates_<?php echo $cnt1; ?>" value="3"
<?php if($rows1['rating']=='3'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 4</label>
<input type="radio" name="ratings<?php echo $cnt1; ?>"  id="rates_<?php echo $cnt1; ?>" value="4"
<?php if($rows1['rating']=='4'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 5</label>
<input type="radio" name="ratings<?php echo $cnt1; ?>"  id="rates_<?php echo $cnt1; ?>" value="5"
<?php if($rows1['rating']=='5'){ echo "checked";} else{echo "disabled";} ?>>
</td>

</tr>
<?php 
$cnt1++;
}
?>
</tbody>
 </table>

</table>




<?php } else{
?>


<table class="table table-bordered">

<tr>
<td>Department Name</td>
<td colspan="5">
<input type="text" class="form-control" id="department" name="department" value="<?php echo  $row['dept_name'];?>" readonly>
</td>
</tr>

<tr>
<td>Employee Name</td>
<td colspan="2">
<input type="hidden" class="form-control" id="emp" name="emp" value="<?php echo  $row['emp_id'];?>" readonly>
<input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $row['emp_name'];?>" readonly>
</td>
</tr>

<tr id="sal">
<td>Salary(In Percentage)</td>
<td colspan="2">
<input type="text" class="form-control" id="salary_percent" name="salary_percent" value="<?php echo $emp_new_salary;?>" readonly>
</td>
</tr>

<tr id="desgn">
<td>Designation</td>
<td colspan="2">
<input type="text" class="form-control" id="designation" name="designation" value="<?php echo  $row['designation_name'];?>" readonly>
</td>
</tr>

<!--tr >
<td>Salary </td>
<td colspan="2">
<input type="text" class="form-control" id="new_salary" name="new_salary" value="< ?php echo  $new_salary;?>" readonly>
</td>
</tr -->

<?php
$remark2 = $con->query("SELECT id,remark,from_date FROM appraisal_details where id='$id' AND person_id='$per_id'");
 
 while($remark_row2 = $remark2->fetch(PDO::FETCH_ASSOC)) 
 {
?>
<tr>
<td>Month</td>
<td>
<input type="text" class="form-control" id="month_type" name="month_type" value="<?php echo $remark_row2['from_date'];?>" readonly>
</td>
</tr>

<tr>
<td>Remarks</td>
<td colspan="2">
<input type="text" class="form-control" id="remark" name="remark" value="<?php echo  $remark_row2['remark'];?>" readonly>
</td>
</tr>
<?php
 }
?>

<table class="table table-bordered">
<h3><center>Appraisal Questions</center></h3>
<tbody>
<?php
$sql=$con->query("SELECT a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id='$per_id' "); 

$cnt3=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>

<td><input type="text" class="form-control" id="question_2" name="question2<?php echo $cnt3; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly></td>

<td style="display: flex; justify-content: space-around; align-items: baseline;">

<label for="performance"> 1</label>
<input type="radio" name="rating2<?php echo $cnt3; ?>"   id="rate2_<?php echo $cnt3; ?>" value="1" 
<?php if($rows['rating']=='1'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 2</label>
<input type="radio" name="rating2<?php echo $cnt3; ?>"  id="rate2_<?php echo $cnt3; ?>" value="2"
<?php if($rows['rating']=='2'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 3</label>
<input type="radio" name="rating2<?php echo $cnt3; ?>"  id="rate2_<?php echo $cnt3; ?>" value="3"
<?php if($rows['rating']=='3'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 4</label>
<input type="radio" name="rating2<?php echo $cnt3; ?>"  id="rate2_<?php echo $cnt3; ?>" value="4"
<?php if($rows['rating']=='4'){ echo "checked";} else{echo "disabled";} ?>>

<label for="performance"> 5</label>
<input type="radio" name="rating2<?php echo $cnt3; ?>"  id="rate2_<?php echo $cnt3; ?>" value="5"
<?php if($rows['rating']=='5'){ echo "checked";} else{echo "disabled";} ?>>
</td>
</tr>
<?php 
$cnt3++;
}
?>
</tbody>
 </table>
</table>

<?php
}
?>
<?php 
if($userrole=='R003' && $row['status']==1){ 
	?>
<table class="table table-bordered">
<tr>
<td>Date</td>
<td colspan="2">
<input type="date" class="form-control" id="sal_date" name="sal_date" /> </td>
</tr>
</table>

<input type="button" name="update" value="Update" class="btn btn-primary" style="float:right;" onclick="salary_date()">
<?php } ?>

</form>
</div>
</div>

<script>
function back()
{
	appraisal();
} 

function salary_date()
{
	var id =$('#aid').val();
	var date =$('#sal_date').val();
	var empid =$('#emp').val();
		
	$.ajax({
    type:"POST",
	data: "id="+ id +"&date="+date +"&emp="+empid,
	url:"/qvisionnew/qvision/appraisal/appraisal_salary_date_update.php",
    success:function(data){
    $("#main_content").html(data);
	appraisal();
    }
    })
}

$(document).ready(function(){
	var type = $('#count').val();
	var type_hr = $('#month_type_hr').val();
	//var salary = <?php echo $emp_new_salary;?>;
	var salary = <?php echo json_encode($emp_new_salary);?>; 
	
	if(type==null){
	$('.mdheader').hide();
	}
	if(type_hr==null){
	$('.hrheader').hide();
	}
	if(salary==null){
	$('#desgn').hide();
	$('#sal').hide();
	}
	
})
</script>

 