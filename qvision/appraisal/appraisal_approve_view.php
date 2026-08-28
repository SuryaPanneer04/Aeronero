<?php
require '../../connect.php';
require '../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole']; 
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id as aid,a.emp_name as emp_id,a.dep_name, b.dept_name, e.emp_name,e.candid_id as emp_candidid,a.remark, a.from_date,a.to_date, a.person_id as pid,a.status as ad_status,d.designation_name,a.salary,a.appraisal_point,a.overall_points,f.emp_name as s_emp,a.recommend_full_appraisal FROM appraisal_details a 
LEFT JOIN z_department_master b ON a.dep_name=b.id 
LEFT JOIN designation_master d ON a.new_designation=d.id 
LEFT JOIN staff_master e ON a.emp_name=e.id
LEFT JOIN staff_master f ON a.person_id=f.id  where a.id='$id'");

$stmt->execute(); 
$row = $stmt->fetch();
$emp_id = $row['emp_id'];
$aid = $row['aid'];
$dep_id = $row['dep_name'];
$ad_status = $row['ad_status'];
$from_date = $row['from_date'];
$to_date = $row['to_date'];
$p_id = $row['pid'];
$personss_id = $row['s_emp'];
$candidate_id = $row['emp_candidid'];

$hikedesignation = $row['designation_name'];
$emp_new_salary = $row['salary'];

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

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}
/* .btn-danger {
    background-color: #1da348;
    border-color: #1da348;
} */
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 400px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: #bdbdbd;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 25px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
   
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
 
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}


</style>

<div class="card card-primary">
<div class="card-header">
<h3 class="card-title"><font size="5">VIEW APPRAISAL APPROVE</font></h3>
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>
<div class="card-body" id="printableArea">
<form role="form"  method="post" enctype="multipart/type">

<input type="hidden" class="form-control" id="aid" name="aid" value="<?php echo $id;?>">

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


 <!--  ======================================= Appraisal HOD view start  =====================================   -->

<table class="table table-bordered"> 
<tbody>
<tr>
<td> Manager Name </td>
<td colspan="2">
<input type="text" class="form-control" name="person" value="<?php echo  $personss_id; ?>" readonly></td>
</tr>

<?php
$sql=$con->query("SELECT a.question,b.rating FROM appraisal_question a  LEFT JOIN appraisal_rating b ON  a.id=b.question_id where b.emp_name='$emp_id' AND b.persons_id='$p_id' AND b.from_date ='$from_date' AND b.to_date ='$to_date'");

$counts=$sql->rowcount();

$cnt=0;
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
if($row['recommend_full_appraisal'] =='on'){

?>
<tr>
<td>Remarks</td>
<td colspan="2">
<input type="text" class="form-control" id="remark_hr" name="remark_hr" value="<?php echo  $row['remark'];?>" readonly>
</td>
</tr>
<?php } ?>

 
 <!--   ====================================== Appraisal By HOD END ====================================== -->


<?php 
/* if($ad_status==0){
	?>
<table class="table table-bordered">
<tr>
<td>Salary (In Percentage)</td>
<td colspan="2">
<select class="form-control" name="salary" id="salary">
		<option value="0">--- Select Percentage ---</option>
		<?php
		 foreach(range(5, 100, 5) as $percent) : ?>
			<option value="<?php echo $percent; ?>"> <?php echo $percent; ?> % </option>
		<?php endforeach; ?>
</select>
</td>
</tr>

<tr>
<td>Designation</td>
<td colspan="2">
<select class="form-control" name="new_designation" id="new_designation">
		<option value="">--- Select Designation ---</option>
		<?php
		$des_sql=$con->query("SELECT id, designation_name FROM designation_master WHERE status=1 AND id<>1");
		while($des_sql_res=$des_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $des_sql_res['id']; ?>"><?php echo $des_sql_res['designation_name']; ?></option>
			<?php
		}
		?>
</select>
</td>
</tr>
</table>

<?php }else{ ?>  */ ////// 
?>


<tr id="sal">
<td>Salary(In Percentage)</td>
<td colspan="2">
<input type="text" class="form-control" id="salary_percent" name="salary_percent" value="<?php echo $row['salary'].'%';?>" readonly>
</td>
</tr>

<tr id="desgn">
<td>Designation</td>
<td colspan="2">
<input type="text" class="form-control" id="designation" name="designation" value="<?php echo  $row['designation_name'];?>" readonly>
</td>
</tr>
</tbody>
 </table> 

<!-- < ?php } ?> --> 

</table>


<?php if($ad_status==0){
	?>
<input type="button" class="btn btn-danger" id="reject" name="reject"  style="float:right; margin-right: 10px;" onclick="openForm()"  value="Reject with Remark">

<input type="button" name="approve" value="Approve"  class="btn btn-primary" style="float:right; margin-right: 10px;" onclick="appraisal_approve()">

<?php
} 
/* if($ad_status==0){ ////
	?>
<input type="button" name="update" value="Update"  class="btn btn-info" style="float:right; margin-right: 10px;" onclick="appraisal_update()">

<?php }//// */ 

?>

</form>
</div>
</div>

<div class="form-popup" id="myForm">
    <form action="" class="form-container">
	<h3>Reject Remark</h3>
	<input type="text" placeholder="Enter Remark" name="rejectremark" id ="rejectremark" required>
          
	<button type="button" class="btn" id="popup" onclick="appraisal_reject()">Submit</button>
	<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
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
})

function back()
{
	appraisal_approval();
} 

function appraisal_approve()
{    
    var emp = $('#aid').val();	
	$.ajax({
    type:"POST",
    url:"/ssinfo1/qvision/appraisal/appraisal_approve_update.php?emp="+emp,
    success:function(data){
      if(data == 1){
        alert('Approved Successfully')
        appraisal_approval();
      }
      else{
        alert('Approve Failed')
      }

    }
    }) 
}

function appraisal_reject()
{
	var emp = $('#aid').val();
	let reject = $('#rejectremark').val()
	$.ajax({
    type:"POST",
    url:"/ssinfo1/qvision/appraisal/appraisal_approve_reject.php?emp="+emp+"&reject="+reject,
    success:function(data){
    $("#main_content").html(data);
	appraisal_approval();
    }
    })
}

function appraisal_update()
{
	var salary = $('#salary').val();
	var new_desgn = $('#new_designation').val();
	var emp = $('#emp').val();
	 //return; (Is to break the code). 
	$.ajax({
    type:"POST",
    url:"/ssinfo1/qvision/appraisal/appraisal_md_update.php?emp="+emp+"&salary="+salary+"&new_designation="+new_desgn,
	
    success:function(data){
	appraisal_approval();
    }
    }) 
}

function openForm() {
  document.getElementById("myForm").style.display = "block";
  $('#rejectremark').val('');
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
} 
</script>
