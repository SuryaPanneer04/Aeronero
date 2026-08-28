<?php
require '../../connect.php';
include'../../user.php';
$userrole=$_SESSION['userrole']; 
$userid=$_SESSION['candidateid'];

$id=$_REQUEST['id'];

$stmt = $con->prepare("select c.status as candidate_status,c.id as candidate_id,c.*,d.*,dm.*,dg.designation_name from candidate_form_details c left JOIN z_department_master d ON c.department = d.id left join jobdescription_master dm on c.position=dm.id left join candidate_round_details r on c.id=r.candid_id left join designation_master dg on c.position=dg.id where c.id='$id'"); 
$stmt->execute(); 
$row = $stmt->fetch();
$position = $row['position'];
$dsgn_name = $row['designation_name'];
$status = $row['candidate_status'];
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
<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">INTERVIEW FEEDBACK DETAILS VIEW</font></h3>
				<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"></i>Back</a>
              </div>

<form role="form" name="" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">

<tr>
<td>Candidate Name:</td>
<td colspan="5"><input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['first_name']." ". $row['last_name'];?>"readonly></td>

</tr>
<tr>


<?php
    $sql4=$con->query("select c.id,c.position,c.status as c_status, dm.designation_name as dsgn_name from candidate_form_details c  left join designation_master dm on c.position=dm.id where c.id='$id'");
	
	$fet4=$sql4->fetch(PDO::FETCH_ASSOC);
    $status= $fet4['c_status'];
	 
	?>
       
	  <?php 
	  if($status == 16|| $status == 19 || $status ==20 || $status ==22 || $status ==23 ){
	?>
	     <tr>
        <td>Position:</td>
        <td colspan="5">
		<input type="text" class="form-control" id="position" name="position" value="<?php echo $fet4['dsgn_name'];?>" readonly>
		</td>
        </tr>
		
	  <?php } else { ?>



<tr>
<td>Position:</td>
<td colspan="5"><input type="text" class="form-control" id="position" name="position" value="<?php echo  $row['tittle'];?>"readonly></td>
</tr>

<?php } ?>

  
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
		<?php 
		if($row['gender']=="female")
		{
			?>
			<td colspan="5"> 
		
		<label>
		<input type="radio" name="gender" value="female" checked="true">&nbsp;Female</label>
		</td>
		<?php
		}
		else
		{
			?>
			<td colspan="5"> 
		<label>
		<input type="radio" name="gender" value="male" checked>&nbsp;Male</label>
		
		</td>
		<?php
		}
		?>
		
		</tr>
        <!-- <tr>
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
        </tr> -->
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
        <td>Aadhar Number: </td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $row['adharnumber'];?>"readonly></td>
        </tr>
        <!-- <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $row['pannumber'];?>"readonly></td>
        </tr>
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $row['voternumber'];?>"readonly></td>
        </tr>
		<tr>
        <td>Driving License:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $row['driving_license'];?>"readonly></td>
        </tr> -->
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
        </tr><tr id='employee_new'>
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
    
       <tr>
		<td>Resume:<td>
		<a href="qvision/Resource/Resource_form/resume_upload/<?php echo $row['resume'];?>" download="<?php echo $row['resume']; ?>"><?php echo $row['resume']; ?></a>
		</tr>

</table>


<?php
$sqll=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,count(*) as hrow FROM candidate_round_details c left join staff_master s on c.person_id=s.id left join interview_rounds i on c.round_id=i.id where c.candid_id='$id' and c.status='35'");
$cnt=1;
$k=0;
$hrows11 = $sqll->fetch(PDO::FETCH_ASSOC);
if($hrows11['hrow']!=0){
?>

<table class="table table-bordered" id="hr">
<h3><center>HR Department</center></h3>
<tr> 
<td>HR Name</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $hrows11['ename']; ?>" readonly></td>
</tr>
</table>


<table class="table table-bordered" id="recruiter_page_hr">
<h3><center>HR Round Feedback Details</center></h3>
<tbody>
<?php
$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 
JOIN hr_domain_entries d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$id' and c.status='35'");
$cnt=1;
$k=0;
while($hrows2 = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo  $hrows2['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $hrows2['feedback']; ?>" readonly></td>
</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table> 
<?php
}
?>

 
 
<?php
$sqll=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,count(*) as servicerow FROM candidate_round_details c join staff_master s on c.person_id=s.id join interview_rounds i on c.round_id=i.id where c.candid_id='$id' and c.status='13' and c.person_id='$userid'");
$cnt=1;
$k=0;
while($servicerows = $sqll->fetch(PDO::FETCH_ASSOC))
if($servicerows['servicerow']!=0){
?>
<table class="table table-bordered">
<h3><center>Service Department</center></h3>
<tr>	 
<td>Manager Name</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $servicerows['ename']; ?>" readonly></td>
</tr>
</table>

<table class="table table-bordered" id="recruiter_page">
<h3><center>Service Round Feedback Details</center></h3>
<tbody>

<?php
$sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 
JOIN domain_entries_hod d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$id' and c.status='13' and c.person_id='$userid' and d.hire_id='$userid'");
$cnt=1;
$k=0;
while($ser_rows2 = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo  $ser_rows2['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $ser_rows2['feedback']; ?>" readonly></td>
</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }?>
 </tbody>
  </table>
<?php
}
?>
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