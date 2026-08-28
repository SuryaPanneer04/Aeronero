<?php
require '../../connect.php';
include('../../user.php');
 $id=$_REQUEST['id'];
$userid=$_SESSION['candidateid'];
$staf=$con->query("select * from staff_master where candid_id='$userid'");
$sfetch=$staf->fetch();
$staid=$sfetch['id'];

$stmt = $con->prepare("SELECT *,t.rating as overall_rating FROM candidate_form_details c left join `technical_team_details` t on c.id=t.candidate_id left join technical_team_commands m on t.id=m.technical_id left join z_department_master d on c.department=d.id left join jobdescription_master dm on c.position=dm.id
WHERE c.id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();
?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>
<div class="card card-primary">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> INTERVIEW FEEDBACK DETAILS EDIT
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">

<tr>
<td>Candidate Name:</td>
<td colspan="5">
<input type="hidden" class="form-control" id="user_id" name="user_id"  value="<?php echo  $staid;?>" readonly>
<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['first_name'].$row['last_name'];?>"readonly>
</td>
</tr>
<tr>
<td>POSITION:</td>
<td colspan="5"><input type="text" class="form-control" id="position" name="position" value="<?php echo  $row['tittle'];?>"readonly></td>
</tr>
</table>

<table class="table table-bordered">
<tr>
<td>Overall Rating:</td>
<td colspan="5"><input type="text" class="form-control" id="ratings" name="ratings" value="<?php echo  $row['overall_rating']; ?>" ></td>
</tr>
<tr>
<td>Remarks *:</td>
<td colspan="5"><input type="text" class="form-control" id="remarks" name="remarks" value="<?php echo  $row['remarks']; ?>" ></td>
</tr>


<tr>
<td>Status *:</td>
<td colspan="5">
<select class="form-control" id="status_recruiter" name="status_recruiters">
<option value="">CHOOSE TYPE</option>
<option value="5" >Select for Next Level</option>
<option value="7">Rejected</option></select></td>

</tr>
<tr id="statushide">



<!--table>

	 <?php

$sql=$con->query("SELECT *,s.emp_name as tech_person, c.candid_id as candid_id FROM candidate_round_details c join staff_master s on c.person_id=s.id where c.candid_id='$id' and c.person_id !=''");
$rows1 = $sql->fetch(PDO::FETCH_ASSOC);
/* 
echo "SELECT *,s.emp_name as tech_person, c.candid_id as candid_id FROM candidate_round_details c join staff_master s on c.person_id=s.id where c.candid_id='$id' and c.person_id !=''"; */

$cnt=1;
$k=0;
/* while($rows1 = $sql->fetch(PDO::FETCH_ASSOC))

{ */
	
		?>
	  <!--tr>
	  <input type="hidden" class="form-control" id="get_id1" name="get_id" value="<!?php echo $rows1['candid_id']; ?>">
	 
<td>Technical Person Name:</td>
<td colspan="5"><input type="text" class="form-control" id="head_name" name="head_name" value="<!?php echo  $rows1['tech_person']; ?>" readonly></td>
</tr-->
<!--?php
}
?-->

 <tr>
 <input type="hidden" class="form-control" id="get_id1" name="get_id" value="<?php echo $rows1['candid_id']; ?>">
	 
<td>Technical Person Name:</td>
<td colspan="5"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $rows1['tech_person']; ?>" readonly></td>
</tr>
</table>

 <table class="table table-bordered" id="recruiter_page">
<h3><center>Technical Skill</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  technical_team_commands where technical_id='$id'");
/* echo "SELECT * FROM  technical_team_commands where technical_id='$id'"; */


$cnt=1;
$k=0;
while($rows2 = $sql->fetch(PDO::FETCH_ASSOC))

{
?>

<tr>
 <input type="hidden" class="form-control" id="get_ids" name="get_ids<?php echo $k;?>" value="<?php echo $rows2['id']; ?>">

<td>Question</td>
<td colspan="1"><input type="text" class="form-control" id="technical_question" name="technical_question[]" value="<?php echo  $rows2['skill']; ?>"></td>

<td>Rating:</td><td colspan="5">
<?php if($rows2['rating']== 1)
{
	?>
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"   id="performance_1" value="1"  checked>
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>" id="performance_1" value="2"  onclick="RadioValue('2')">
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>

<?php } else if($rows2['rating']== 2){?>
<td colspan="5">
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"   id="performance_1" value="1" "RadioValue('1')" >
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="2"  onclick="RadioValue('2')" checked>
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>

<?php
} else if($rows2['rating']== 3){
?>
<td colspan="5">
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"  id="performance_1" value="1" "RadioValue('1')" >
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="2"  onclick="RadioValue('2')" >
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="3"  onclick="RadioValue('3')" checked>
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>

<?php
} else if($rows2['rating']== 4) {

?>
<td colspan="5">
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"   id="performance_1" value="1" "RadioValue('1')" >
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="2"  onclick="RadioValue('2')" >
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>" id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>" id="performance_1" value="4"  onclick="RadioValue('4')" checked>
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')">
<label for="performance"> 5</label></td>

<?php
} else if($rows2['rating']== 5) {
?>
<td colspan="5">
<input type="radio"  id="radio_1"  name="performances_<?php echo $k;?>"  id="performance_1" value="1" "RadioValue('1')" >
<label for="performance"> 1</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="2"  onclick="RadioValue('2')" >
<label for="performance"> 2</label>
<input type="radio" name="performances_<?php echo $k;?>" id="performance_1" value="3"  onclick="RadioValue('3')">
<label for="performance"> 3</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="4"  onclick="RadioValue('4')">
<label for="performance"> 4</label>
<input type="radio" name="performances_<?php echo $k;?>"  id="performance_1" value="5"  onclick="RadioValue('5')" checked>
<label for="performance"> 5</label></td>
<?php
}?>
<td>Response:</td><td colspan="1"><input type="text" class="form-control" id="technical_answer1" name="technical_answer[]" value="<?php echo  $rows2['response']; ?>" ></td>

</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="feedback_update()" value="Update"> 
</form>
</div>
</div>
</div>

<script>
	function back_ctc()
	{
		$.ajax({
		type:"POST",
		url:"qvision/interview_feedback/new.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
 function feedback_update()
    {
    var id=<?php echo $id; ?>;
	alert(id);
    var candidate_id=$('#get_ids').val();
//alert(candidate_id);
	//alert(candidate_id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id+"&candidate_id="+candidate_id,
	
    url:'qvision/interview_feedback/technical_update.php',
    success:function(data)
    {
      if(data==0)
      { 
        alert('Not Updated');
      
      }
      else
      {
        alert("Update Successfully");
		feedback()
      }
      
    }       
    });  
    }
    </script>