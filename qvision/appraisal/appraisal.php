<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$user_candid = $_SESSION['candidateid'];

$f_date = "01-04-".date("Y"); //d-m-Y
$t_date = "31-03-".date("Y",strtotime('+1 years')); //d-m-Y
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
<h3 class="card-title"><font size="5">ADD APPRAISAL DETAILS</font></h3>
 <a onclick="back_appraisal()" style="float: right;" data-toggle="modal" class="btn">Back</a>
</div>

<form method="POST" action="">

<input type="hidden" name="personid" id="personid" value="<?php echo $user_candid; ?>">
<input type="hidden" name="userrole" id="userrole" value="<?php echo $userrole; ?>">
<table class="table table-bordered">

<tr>
<td>Department Name</td>
<td colspan="2">
<select class="form-control" name="department" id="department" onchange="open_dep()">
		<option value="0">-- Select Department --</option>
		<?php
		$dep_sql=$con->query("SELECT id, dept_name, status FROM z_department_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
			<?php
		}
		?>
</select></td>
</tr>

<tr id="emp_view"> <!-- Employee list based on Department -->

</tr>

<tr id="date">
<td>  From date </td>
<td> <input type="text" id="from_date" name="from_date" class="form-control" value="<?php echo $f_date;?>" readonly> </td>
</tr>

<tr>
<td> To date </td>
<td> <input type="text" id="to_date" name="to_date" class="form-control" value="<?php echo $t_date;?>" readonly> </td>
</tr>

<table class="table table-bordered" id="self_appraisal_view">  <!--Self Appraisal view table, once the employee entered a data then only data are show here -->
 
</table>

<table class="table table-bordered" id="question_view"> <!-- Appraisal Question view against the department which is enter in appraisal master -->

</table>


<table class="table table-bordered">

<tr id="recommend">
	<td colspan="1">Would you like to recommend for 360* Appraisal?</td>
	<td colspan="3"><input type="checkbox"  name="appraisal_recommend" id="appraisal_recommend" onclick="hidereason()"></td>
</tr>
<tr id='reason'>
<td>Reason for 360* Appraisal</td>
<td colspan="2">
<textarea class="form-control" id="remark" name="remark"> </textarea></td>
</tr>
</table> 

</table>
<input type="button" name="submit" value="Submit" class="btn btn-primary" style="float:right;position: relative;width: 100px;" onclick="save_appraisal()">
</form>
<br>
</div>


<script>
$(document).ready(function(){
	$('#recommend').hide()
	$('#reason').hide()
})

function back_appraisal()
{
	appraisal();
}

function qstn_entered()
{
	var dep = $('#department').val();
	const personid = $('#personid').val();
	let employee_id = $('#emp_name').val();
	let  from = $('#from_date').val()
	let  to = $('#to_date').val()
	$.ajax({
            type: 'GET',
            url: '/ssinfo1/qvision/appraisal/appraisal_questions.php',
            data: "id=" + dep +"&person_id="+ personid +"&emp_id="+ employee_id +"&from_dates="+ from +"&to_dates="+ to,
            success: function (data)
            {
                $("#question_view").html(data);
            }
        })
 }
 
function open_dep()
 {
	const dept = $('#department').val();
	$.ajax({
            type: 'GET',
            url: '/ssinfo1/qvision/appraisal/appraisal_department.php',
            data: "id=" + dept,
            success: function (data)
            {
                $("#emp_view").html(data);
            }
        })
 }
 
 function self_appraisal()
 {
	 let emp_no = $('#emp_name').val()
	 let des = document.getElementById('emp_name')
	 let candid_id = des.options[des.selectedIndex].getAttribute('data-id')

	 $.ajax({
		 type:'GET',
		 data: "emp_id=" + emp_no +"&candidate_id=" +candid_id,
		 url:'/qvisionnew/qvision/appraisal/self_appraisal_view.php',
		 success: function(data)
		 {
			 $('#self_appraisal_view').html(data)
		 }
	 })
 }
 
function save_appraisal()
{    
    var data = $('form').serialize();
    $.ajax({
    type:'POST',
    data: data,
    url:"qvision/appraisal/appraisal_submit.php",
    success:function(data)
    {  
      if(data==0)
	  {
		alert("Submit Failed");
		appraisal(); 
	  }		  
      else{
		alert("Submitted Successfully");
		appraisal();  
	  }
    }       
    });
}

function hidereason(){
	let checkvalue = $("input:checkbox:checked").val()

	if(checkvalue == 'on'){
		$('#reason').show()
	}
	else if(checkvalue== null ){
       $('#reason').hide()
	}
}
</script>
