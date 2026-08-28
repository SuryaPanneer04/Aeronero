<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole']; 
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id as aid,a.emp_name as emp_id,b.dept_name,d.designation_name,e.emp_name,e.candid_id as emp_candidid,a.remark, a.from_date,a.to_date,a.person_id as pid, a.salary,e.salary_amount,a.status,s.emp_name as pname,a.new_salary_start_date as start_date,a.overall_points,a.appraisal_point,a.recommend_full_appraisal,a.full_appraisal_meet_date,a.reject_remark,a.md_reject__remark FROM appraisal_details a 
LEFT JOIN z_department_master b ON a.dep_name=b.id 
LEFT JOIN designation_master d ON a.new_designation=d.id 
LEFT JOIN staff_master e ON a.emp_name=e.id  
LEFT JOIN staff_master s ON a.person_id=s.id   
where a.id='$id' "); //and a.person_id='$candidateid'


$stmt->execute(); 
$row = $stmt->fetch();
$per_id = $row['pid'];
$candidate_id = $row['emp_candidid'];

$from_date = $row['from_date'];
$appfrom_date = date("d-M-Y",strtotime($from_date));

$to_date = $row['to_date'];
$appto_date = date("d-M-Y",strtotime($to_date));

$salarydate = $row['start_date'];
$saldate = date("d-M-Y",strtotime($salarydate));

$meet_date = $row['full_appraisal_meet_date'];
$app_meet_date = date('d-M-Y',strtotime($meet_date));

$emp_id = $row['emp_id'];
$emp_new_salary = $row['salary'];
$emp_salary = $row['salary_amount'];
//echo $emp_new_salary; echo"<br>";
//echo $emp_salary; echo"<br>";
$per_salary = $emp_salary * $emp_new_salary / 100;
//echo $per_salary; echo"<br>";
$new_salary = $emp_salary + $per_salary;

$hikedesignation = $row['designation_name'];

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
<input type="hidden" class="form-control" id="aid" name="aid" value="<?php echo $row['aid'];?>" >
<input type="hidden" class="form-control" id="recomend" name="recomend" value="<?php echo $row['recommend_full_appraisal'];?>" >

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

<tr>
<td>From Date</td>
<td colspan="2">
<input type="text" class="form-control" id="employee" name="employee" value="<?php echo  $appfrom_date;?>" readonly>
</td>
</tr>

<tr>
<td>To Date</td>
<td colspan="2">
<input type="text" class="form-control" id="employee" name="employee" value="<?php echo $appto_date;?>" readonly>
</td>
</tr>

<tr id="sal">
<td>Salary(In Percentage)</td>
<td colspan="2">
<input type="text" class="form-control" id="salary_percent" name="salary_percent" value="<?php echo $emp_new_salary.'%';?>" readonly>
</td>
</tr>

<tr id="desgn">
<td>Designation</td>
<td colspan="2">
<input type="text" class="form-control" id="designation" name="designation" value="<?php echo  $hikedesignation;?>" readonly>
</td>
</tr>
<?php 
if($row['status']==3){
?>
<tr>
<td>New salary Start Date</td>
<td colspan="2">
<input type="text" class="form-control" id="designation" name="designation" value="<?php echo  $saldate;?>" readonly>
</td>
</tr>
<?php } ?>

<!--tr >
<td>Salary </td>
<td colspan="2">
<input type="text" class="form-control" id="new_salary" name="new_salary" value="< ?php echo  $new_salary;?>" readonly>
</td>
</tr -->


<table class="table table-bordered" id="question_view"> <!--Self Appraisal Start -->
<tbody>
<tr> <td colspan='2'> <h3><center>Self Appraisal Review</center></h3> </td> </tr>
<?php
$maxappraisal_id = $con->query("SELECT max(id) as maxid FROM `self_appraisal_master` WHERE `person_id`='$candidate_id'");
$max_id = $maxappraisal_id->fetch();
$selfmaxid = $max_id['maxid'];

$sql=$con->query("SELECT a.id,a.dep_name,a.question,b.rating,b.emp_name,b.id as self_app_id FROM self_appraisal_question a left join self_appraisal_rating b on a.id=b.question_id where a.self_appraisal_id='$selfmaxid' ");
$count = $sql->rowCount();
$cnt=0;
if($count==0){
?>
<tr><td style="font-size: 20px;font-weight: 900;text-align: center; color:red;"> Employee not yet fill  </td> </tr>
<?php }else{ ?>
<tr> 
<td> Questions </td>
<td> Rating</td>
</tr>

<?php
$points = 0;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{ 
?>
<tr>
<td>
<input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly></td>

<td style="display: flex; justify-content: space-around; align-items: baseline;">
<label for="performance"> 1</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='1'){ echo "checked";} else{echo "disabled";} ?>>


<label for="performance"> 2</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='2'){ echo "checked";} else{echo "disabled";} ?>>


<label for="performance"> 3</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='3'){ echo "checked";} else{echo "disabled";} ?>>


<label for="performance"> 4</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='4'){ echo "checked";} else{echo "disabled";} ?>>


<label for="performance"> 5</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='5'){ echo "checked";} else{echo "disabled";} ?>>

</td>
</tr>
<?php 
$cnt++;
$per_point = $rows['rating'];
$points = $points + $per_point;
 }
?>

<tr>
<td><b>Sum of the Points(OUT OF 25)</b></td>
<td>
<input type="text" class="form-control" id="points_get_self" name="points_get_self" value="<?php echo  $points;?>" readonly>
</td>
</tr>

<?php } ?>
</tbody>
</table>
<!-- Self appraisal END-->

<?php  // Appraisal by HOD
 $remar = $con->query("SELECT a.id,a.emp_name,a.person_id,a.status,b.emp_name as s_emp,c.dept_name as d_name FROM appraisal_details a LEFT JOIN staff_master b ON a.person_id=b.id LEFT JOIN z_department_master c ON b.dep_id=c.id where a.emp_name='$emp_id' AND from_date='$from_date' AND to_date='$to_date'");

$countt=1;
while($sample = $remar->fetch(PDO::FETCH_ASSOC)) 
 {
	$p_id = $sample['person_id'];
	$personn_id = $sample['s_emp'];
	$dept_name = $sample['d_name'];
 
?>

<table class="table table-bordered"> 
<tbody>
<tr>
<td> Manager Name </td>
<td colspan="2">
<input type="text" class="form-control" name="person<?php echo $countt; ?>" value="<?php echo  $personn_id; ?>" readonly></td>
</tr>

<?php  
 $remark = $con->query("SELECT id,remark,from_date FROM appraisal_details where emp_name='$emp_id' AND person_id='$p_id' AND from_date='$from_date' AND to_date='$to_date'");

 $remark_row = $remark->fetch();
?>


<?php
$sql=$con->query("SELECT a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id='$p_id' AND b.from_date ='$from_date' AND b.to_date ='$to_date'");

$counts=$sql->rowcount();
$countz=$counts+1;

$cnt=$countt;
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
$countt=$countz++;
}
?>

<tr>
<td><b>Sum of the Points(OUT OF 75)</b></td>
<td>
<input type="text" class="form-control" id="appraisal_score" name="appraisal_score" value="<?php echo $row['appraisal_point'];?>" readonly>
</td>
</tr>

<tr>
<td><b>Overall Points(OUT OF 100)</b></td>
<td>
<input type="text" class="form-control" id="overallmark" name="overallmark" value="<?php echo $row['overall_points'];?>" readonly>
</td>
</tr>
<?php
if($row['status']==2){ ?>
<tr>
<td>Reject Remark</td>
<td colspan="2">
<input type="text" class="form-control" id="remark1" name="remark1" value="<?php echo $row['reject_remark'];?>"  readonly/> </td>
</tr>

<?php
}
if($row['status']==6){
?>

<tr>
<td>MD Reject Remark</td>
<td colspan="2">
<input type="text" class="form-control" id="remark2" name="remark2" value="<?php echo $row['md_reject__remark'];?>"  readonly/> </td>
</tr>

<?php
}
if($row['recommend_full_appraisal'] =='on'){

?>
<tr>
<td>Remarks</td>
<td colspan="2">
<input type="text" class="form-control" id="remark_hr" name="remark_hr" value="<?php echo  $row['remark'];?>" readonly>
</td>
</tr>
<?php 
} 

if($row['status']==3 && $row['recommend_full_appraisal'] =='on'){
?>
<tr>
<td>360* Appraisal Meet Date</td>
<td colspan="2">
<input type="text" class="form-control" id="appraisal_meet_date" name="appraisal_meet_date" value="<?php echo  $app_meet_date;?>" readonly>
</td>
</tr>
<?php } ?>
</tbody>
 </table>
 
</table>

<?php 
if($userrole=='R003' && $row['status']==5){ 
	?>
<table class="table table-bordered">

<?php
if($row['recommend_full_appraisal'] =='on'){

?>	
<tr>
<td>360* Appraisal Meeting Date</td>
<td colspan="2">
<input type="date" class="form-control" id="meeting_date" name="meeting_date" /> </td>
</tr>

<?php } ?>

<tr>
<td>Salary Date</td>
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
$(document).ready(function(){
	var salary = <?php echo json_encode($emp_new_salary);?>; 
	var design = <?php echo json_encode($hikedesignation);?>; 
	
	if(salary==null){
	
	$('#sal').hide();
	}
	if(design==null){
		$('#desgn').hide();
	}

	let full = '<?php echo $row['recommend_full_appraisal']; ?>';
	let status = <?php echo $row['status']; ?>;

//Current Date  
var mintoday = new Date();
var mindd = mintoday.getDate();
var minmm = mintoday.getMonth()+1; //January is 0 so need to add 1 to make it 1!
var minyyyy = mintoday.getFullYear();
if(mindd<10){
  mindate='0'+mindd
}else{
  mindate=mindd
}
if(minmm<10){
  minmm='0'+minmm
}else{
  minmm=minmm
}	
mintoday = minyyyy+'-'+minmm+'-'+mindate;
// Set Minimum date
if(full=='on' && status == 5){
    document.getElementById("meeting_date").setAttribute("min", mintoday);	
 }
})

function back()
{
	appraisal();
} 

function salary_date()
{
	var id =$('#aid').val();
	var meetingdate =$('#meeting_date').val();
	var date =$('#sal_date').val();
	var empid =$('#emp').val();
	var recomend = $('#recomend').val()

		
	$.ajax({
    type:"POST",
	data: "id="+ id +"&date="+date +"&emp="+empid+"&meetdate="+meetingdate+"&recomend="+recomend,
	url:"/qvisionnew/qvision/appraisal/appraisal_salary_date_update.php",
    success:function(data){
    $("#main_content").html(data);
	appraisal();
    }
    })
}
</script>

 