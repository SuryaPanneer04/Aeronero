<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole']; 
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id as aid,a.emp_name as emp_id, b.dept_name, c.div_name, d.designation_name, e.emp_name,a.remark, a.from_date,a.person_id,f.name as rname,a.salary FROM appraisal_details a 
LEFT JOIN z_department_master b ON a.dep_name=b.id 
LEFT JOIN division_master c ON a.div_name=c.id 
LEFT JOIN designation_master d ON a.dsgn_name=d.id 
LEFT JOIN staff_master e ON a.emp_name=e.id  
LEFT JOIN appraisal_rounds f ON a.round_id=f.id  
where a.emp_name='$id'");


$stmt->execute(); 
$row = $stmt->fetch();
$emp_id = $row['emp_id'];
$aid = $row['aid'];
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

<h3 class="card-title"><font size="5">VIEW APPRAISAL APPROVE</font></h3>

<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>
<div class="card-body" id="printableArea">
<form role="form"  method="post" enctype="multipart/type">

<?php 
if($userrole=='R001'){
?>

<table class="table table-bordered">

<input type="hidden" class="form-control" id="aid" name="aid" value="<?php echo $row['aid'];?>" readonly>
<!--tr>
<td> Round ID </td>
<td colspan="2"> 
<input type="text" class="form-control" id="round" name="round" value="<?php echo $row['rname'];?>" readonly>
</td>
</tr -->
<tr>
<td>Division Name</td>
<td colspan="2">
<input type="text" class="form-control" id="division" name="division" value="<?php echo  $row['div_name'];?>" readonly>
</td>
</tr>

<tr>
<td>Employee Name</td>
<td colspan="2">
<input type="hidden" class="form-control" id="emp" name="emp" value="<?php echo  $row['emp_id'];?>" readonly>
<input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $row['emp_name'];?>" readonly>
</td>
</tr>

<tr>
<td>Salary (In Percentage)</td>
<td>
<input type="text" class="form-control" id="month_type" name="month_type" value="<?php echo $row['salary'];?>" readonly>
</td>
</tr>

<table class="table table-bordered"> 
<div class="hrheader">
<h4><center>Appraisal By HR</center></h4> 
</div>
<tbody>

<?php   //HR Appraisal view
 $remark = $con->query("SELECT id,remark,from_date FROM appraisal_details where emp_name='$emp_id' AND person_id='53'");
 while($remark_row = $remark->fetch(PDO::FETCH_ASSOC)) 
 {

?>


<tr>
<td>Remarks</td>
<td colspan="2">
<input type="text" class="form-control" id="remark_hr" name="remark_hr" value="<?php echo  $remark_row['remark'];?>" readonly>
</td>
</tr>
<?php
 }
?>


<?php
$sql=$con->query("SELECT a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id='53' ");

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
<div class="hod">
<h4><center>Appraisal By HOD</center></h4>
</div>
<tbody>

<?php   //HOD Appraisal view
 $remark = $con->query("SELECT id,remark,from_date FROM appraisal_details where emp_name='$emp_id' AND person_id='48'");
 while($remark_row = $remark->fetch(PDO::FETCH_ASSOC)) 
 {

?>


<tr>
<td>Remarks</td>
<td colspan="2">
<input type="text" class="form-control" id="remark_hod" name="remark_hod" value="<?php echo  $remark_row['remark'];?>" readonly>
</td>
</tr>
<?php
 }
?>


<?php
$sql=$con->query("SELECT a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id='48' ");

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
<div class="hod1">
<h4><center>Appraisal By HOD</center></h4>
</div>
<tbody>

<?php   //HOD Appraisal view
 $remark = $con->query("SELECT id,remark,from_date FROM appraisal_details where emp_name='$emp_id' AND person_id='4'");
 while($remark_row = $remark->fetch(PDO::FETCH_ASSOC)) 
 {

?>


<tr>
<td>Remarks</td>
<td colspan="2">
<input type="text" class="form-control" id="remark_hod1" name="remark_hod1" value="<?php echo  $remark_row['remark'];?>" readonly>
</td>
</tr>
<?php
 }
?>


<?php
$sql=$con->query("SELECT a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id='4' ");

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
 
<!--table class="table table-bordered">
<tr>
<td>Salary (In Percentage)</td>
<td colspan="2">
<input type="text" class="form-control" id="salary" name="salary" autocomplete="off"/> </td>
</tr>
<tr>
<td>Designation</td>
<td colspan="2">
<select class="form-control" name="new_designation" id="new_designation">
		<option value="">--- Select Designation ---</option>
		< ?php
		$des_sql=$con->query("SELECT id, designation_name FROM designation_master WHERE status=1");
		while($des_sql_res=$des_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="< ?php echo $des_sql_res['id']; ?>">< ?php echo $des_sql_res['designation_name']; ?></option>
			< ?php
		}
		?>
</select>
</td>
</tr>
</table  -->
</table>

<input type="button" name="reject" value="Reject" class="btn btn-primary" style="float:right;" onclick="appraisal_reject()">

<input type="button" name="approve" value="Approve"  class="btn btn-primary" style="float:right; margin-right: 10px;" onclick="appraisal_approve()">

<?php } 
?>

</form>
</div>
</div>

<script>
function back()
{
	appraisal_approval();
} 

function appraisal_approve()
{    
    var data = $('form').serialize();	
	$.ajax({
    type:"POST",
	data: data,
    url:"/ssinfo1/qvision/appraisal/appraisal_approve_update.php",
    success:function(data){
	appraisal_approval();
    }
    }) 
}

function appraisal_reject()
{
	var id = <?php echo $aid; ?>;
	$.ajax({
    type:"POST",
	data: "id="+id,
    url:"/ssinfo1/qvision/appraisal/appraisal_approve_reject.php",
    success:function(data){
    $("#main_content").html(data);
	appraisal_approval();
    }
    })
}

 $(document).ready(function(){
	var type_hr = $('#remark_hr').val();
	var type_hod = $('#remark_hod').val();
	var type_hod1 = $('#remark_hod1').val();
	
	if(type_hr==null){
	$('.hrheader').hide();
	}
	if(type_hod==null){
	$('.hod').hide();
	}
	if(type_hod1==null){
	$('.hod1').hide();
	}
}) 
</script>
