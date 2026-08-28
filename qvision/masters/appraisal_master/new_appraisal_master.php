<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$cid =$_SESSION['candidateid'];
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
<h3 class="card-title"><font size="5">ADD APPRAISAL DETAILS</font></h3>
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
</div>

<form method="POST" action="">
<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
<input type="hidden" name="cid" id="cid" value="<?php echo  $cid; ?>">
<table class="table table-bordered">

<tr>
<td>Department Name</td>
<td colspan="2">
<select class="form-control" name="department" id="department" onchange="open_designation()">
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

<tr id="designation">   </tr>


<tr id="employee_view">   </tr>

<table class="table table-bordered" id="new_tab">
  
    <tr>
      <th>S.No</th>
      <th>Questions</th>
      <!-- <th>Action</th> -->
    </tr>
    
<?php
 for($i=1;$i<=5;$i++){
?>     
    <tr>
      <td><label for="name_<?php echo $i;?>"> <?php echo $i; ?> </label></td>
    
      <td><input type="text" class="form-control" id="question_<?php echo $i;?>" name="question[]" autocomplete="off"></td>
  
    </tr>
<?php } ?>

</table>

</table>
<input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="save_appraisal()">
</form>
<br>
</div>

<script>

function back_ctc()
{
	appraisal_master();
} 

function open_designation()
 {
	const dept = $('#department').val();
	$.ajax({
            type: 'GET',
            url: 'qvision/masters/appraisal_master/designation_appraisal_master.php',
            data: "id=" + dept,
            success: function (data)
            {
                $("#designation").html(data);
            }
        })
 }


 
/*  function open_division()
 {
	const dept = $('#department').val();
	$.ajax({
            type: 'GET',
            url: 'qvision/masters/appraisal_master/division_appraisal_master.php',
            data: "id=" + dept,
            success: function (data)
            {
                $("#division").html(data);
            }
        })
 } */

function save_appraisal()
{
  let dep = $('#department').val()
  if(dep == 0){
    alert('Kindly select Department Before Submit.');
  }
  else{
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data,
    url:"qvision/masters/appraisal_master/appraisal_master_submit.php",
    success:function(data)
    {  
      if(data==0)
	  {
		alert("Submit Failed");
		appraisal_master(); 
	  }		  
      else{
		alert("Submitted Successfully");
		appraisal_master();  
	  }
		          
    }       
    });
  }
}


</script>