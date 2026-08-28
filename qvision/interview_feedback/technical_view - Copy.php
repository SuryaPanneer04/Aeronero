<?php
require '../../connect.php';
 $id=$_REQUEST['id'];


$stmt2 = $con->prepare("SELECT * FROM candidate_form_details WHERE id='212'"); 

$stmt2->execute(); 
$row2 = $stmt2->fetch();


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
  <div class="card-header">
 <center><h3 class="card-title"><b>INTERVIEW FEEDBACK DETAILS VIEW</b></h3></center>
	<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
   </div>
			  

<form role="form" name="" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td>Candidate Name:</td>
<td colspan="5">
<input type="text" class="form-control" id="name" name="name"  value="<?php echo  $row['first_name'] . " ".$row['last_name'] ;?>"readonly ></td>

</tr>

<tr>
<td>Position:</td>
<td colspan="5"><input type="text" class="form-control" id="position" value="<?php echo  $row['position'];?>" name="position"readonly></td>
</tr>

 <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
        <tr>
        <td>First Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name'];?>" readonly ></td>
		<td>Last Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name'];?>" readonly></td>
        </tr>
		
	<tr>
	  <td>Gender:</td>
	   <td colspan="2"> 
		  <label> <input type="radio" name="gender" value="male" <?php if($row['gender']=="male"){ echo "checked";} else{echo "disabled";} ?> >
		  &nbsp;Male </label>  
	   </td>
		
	  <td colspan="2"> 
		  <label> <input type="radio" name="gender" value="female" <?php if($row['gender']=="female"){ echo "checked";} else{echo "disabled";}?> >
		  &nbsp;Female </label>
	  </td>
    </tr>
		
		
		<tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $row['father_name'];?>"readonly></td>
        </tr>
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $row['dob'];?>"readonly></td>
        </tr>
        <tr>
        <td>Address Communication: *</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address'];?>"readonly></td>
        </tr>
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $row['paddress'];?>" readonly></td>
        </tr>
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $row['phone'];?>" readonly></td>
        </tr>
       <tr>
        <td>Alternate Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="a_phone" name="a_phone" value="<?php echo $row['alternative_phone'];?>"readonly></td>
        </tr>
		 <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $row['mail'];?>"readonly></td>
        </tr>
        <tr>
        <td>Aadhar Number: *</td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $row['adharnumber'];?>"readonly></td>
        </tr>
        <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $row['pannumber'];?>"readonly></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $row['voternumber'];?>"readonly></td>
        </tr>
		<tr>
        <td>Educational Details: *</td>
        <td colspan="4"><input type="text" class="form-control" id="educationalDetails" name="educationalDetails" value="<?php echo $row['educationalDetails'];?>"readonly></td>
        </tr>
			<?php 
		if($row['EmployeeStatus']=="Fresher")
		{
			?>
			<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="empstats" name="empstats" value="<?php echo "Fresher";?>"readonly>
				
		</td>
        </tr>
		<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $row['year_of_pass'];?>"readonly></td>
        </tr>
			<?php 
		}
		else
		{
			?>
			<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="empstats" name="empstats" value="<?php echo "Experience";?>"readonly>
				
		</td>
        </tr>
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $row['companyname'];?>"readonly></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $row['no_of_year'];?>"readonly></td>
        </tr>
			<?php 
		} 
			?>
</table>



<table class="table table-bordered">
<h3><center>Department</center></h3>
<tr id="statushide">
<?php
$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$id' and c.status=5");
/* echo "SELECT s.emp_name as ename,c.candid_id,i.name as depname FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$id' and c.status=5"; */

$cnt=1;
$k=0;
$rows1 = $sql->fetch(PDO::FETCH_ASSOC)
?>
<td> Department </td>
<td colspan="2">
<input type="text" class="form-control" id="technical_department" name="technical_department" value="<?php echo  $rows1['depname']; ?>" readonly></td>
</tr>
<tr>
<td>Name</td>
<td colspan="2">
<input type="text" class="form-control" id="technical_department" name="technical_department" value="<?php echo  $rows1['ename']; ?>" readonly></td>

</tr>
</table>

 <table class="table table-bordered" id="recruiter_page">
<h3><center> Feedback </center></h3>
<tbody>

<?php

$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id 
JOIN domain_entries d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$id' and c.status=5");


$cnt=1;
$k=0;
while($rows2 = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>

<td><?php echo  $rows2['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $rows2['feedback']; ?>" readonly></td>

</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table>

 
	
	  
	  
	  
</form>
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

    </script>