<?php
require '../../connect.php';
$cid=$_REQUEST['id'];

$sql=$con->query("select *,c.status as cstatus,c.interview_round_level as round from candidate_form_details c left join jobdescription_master d on c.position=d.id left join z_department_master dm on c.department=dm.id where c.id='$cid' order by c.id desc limit 1");
$fet=$sql->fetch();
$rid=$fet['resource_id'];
$status=$fet['cstatus'];
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
	     <h3 class="card-title"> <b>Candidate Details View</b></h3>
		<a onclick="to_list()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a> <br>
     </div>

   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">		
        <tr>
        <td colspan="6"><center><b>Application for Candidate</b></center></td>
        </tr>
	
	<?php
    $sql4=$con->query("select c.id,c.position,c.status as c_status, dm.designation_name as dsgn_name from candidate_form_details c  left join designation_master dm on c.position=dm.id where c.id='$cid'");
	
	$fet4=$sql4->fetch(PDO::FETCH_ASSOC);
    $status= $fet4['c_status'];
	 
	?>
       
	  <?php 
	  if($status == 40 || $status == 19 || $status ==20 || $status ==22 || $status ==23 ){
	?>
	     <tr>
        <td>Post Applied for: *</td>
        <td colspan="5">
		<input type="text" class="form-control" id="position" name="position" value="<?php echo $fet4['dsgn_name'];?>" readonly>
		</td>
        </tr>
		
	  <?php } else { ?>
	  
	    <tr>
        <td>Post Applied for: *</td>
        <td colspan="5">
		<input type="text" class="form-control" id="position" name="position" value="<?php echo $fet['tittle'];?>" readonly>
		</td>
        </tr>
		
	<?php } ?>
	<tr>
		    <td >Client Org Name</td>
			<td colspan="5">
			<input type="text" class="form-control" id="client_org_name" name="client_org_name"  value="<?php echo $fet['client_org_name']; ?>"readonly>
			</td>
        </tr> 
	  
		<tr>
		<td>Location</td>
        <td><input type="text" class="form-control" id="location" name="location" value="<?php echo $fet['location']; ?>"readonly></td>
		</tr>
	  
	    <tr>
			<td>Interview Round Level:</td>
			<td colspan="5">
				<input type="text" class="form-control" name="round" id="round" value="<?php echo $fet['round']; ?>"readonly >
			</td>	
        </tr>

        <tr>
        <td colspan="6"><center><b>Personal Details</b></center></td>
        </tr>
		
        <tr>
        <td>First Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $fet['first_name'];?>" readonly ></td>
		<td>Last Name: *</td>
        <td colspan="2"><input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $fet['last_name'];?>" readonly></td>
        </tr>
		
    <tr>
	  <td>Gender:</td>
	   <td colspan="2"> 
		  <label> <input type="radio" name="gender" value="male" <?php if($fet['gender']=="male"){ echo "checked";} else{echo "disabled";} ?> >
		  &nbsp;Male </label>  
	   </td>
		
	  <td colspan="2"> 
		  <label> <input type="radio" name="gender" value="female" <?php if($fet['gender']=="female"){ echo "checked";} else{echo "disabled";}?> >
		  &nbsp;Female </label>
	  </td>
    </tr>
		
        <!-- <tr>
        <td>Father's Name:</td>
        <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $fet['father_name'];?>"readonly></td>
        </tr>
		
        <tr>
        <td>Date of Birth:</td>
        <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $fet['dob'];?>"readonly></td>
        </tr>
		
        <tr>
        <td>Address Communication: *</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $fet['address'];?>"readonly></td>
        </tr>
		
        <tr>
        <td>Permanent Address:</td>
        <td colspan="5"><input type="text" class="form-control" id="paddress" name="paddress" value="<?php echo $fet['paddress'];?>" readonly></td>
        </tr> -->
		
		
        <tr>
        <td>Mobile Number: *</td>
        <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $fet['phone'];?>" readonly></td>
        </tr>
		
       <tr>
        <td>Alternate Mobile Number: </td>
        <td colspan="5"><input type="text" class="form-control" id="a_phone" name="a_phone" value="<?php echo $fet['alternative_phone'];?>"readonly></td>
        </tr>
		
        <tr>
        <td>Email ID : *</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['mail'];?>"readonly></td>
        </tr>
		
        <tr>
        <td>Aadhar Number: </td>
        <td colspan="4"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $fet['adharnumber'];?>"readonly></td>
        </tr>
		
        <!-- <tr>
        <td>Pan Number:</td>
        <td colspan="4"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $fet['pannumber'];?>"readonly></td>
        </tr>
		
        <tr>
        <td>Voter ID:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $fet['voternumber'];?>"readonly></td>
        </tr>
		
		<tr>
        <td>Driving License:</td>
        <td colspan="4"><input type="text" class="form-control" id="voternumber" name="voternumber" value="<?php echo $fet['driving_license'];?>"readonly></td>
        </tr> -->
		
		<tr>
        <td>Educational Details: *</td>
        <td colspan="4"><input type="text" class="form-control" id="educationalDetails" name="educationalDetails" value="<?php echo $fet['educationalDetails'];?>"readonly></td>
        </tr>
			
			<?php 
		if($fet['EmployeeStatus']=="Fresher")
		{
			?>
			
		<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="EmployeeStatus" name="EmployeeStatus" value="<?php echo "Fresher";?>" readonly>
				
		</td>
        </tr>
		
		<tr id='employee_new'>
		<td>Year of Passout </td>
        <td colspan="4"><input type="text" class="form-control" id="year_of_pass" name="year_of_pass" value="<?php echo $fet['year_of_pass'];?>" readonly></td>
        </tr>
		
			<?php 
		}
		else
		{
			?>
			
		<tr>
        <td>Employement Status:</td>
        <td colspan="4">	
			<input type="text" class="form-control" id="EmployeeStatus" name="EmployeeStatus" value="<?php echo "Experience";?>"readonly>
				
		</td>
        </tr>
		
		<tr id='employee_status'>
        <td>Company Name:</td>
        <td colspan="2"><input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $fet['companyname'];?>"readonly></td>
		<td>No of Year Experience:</td>
        <td colspan="2"><input type="number" class="form-control" id="no_of_year" name="no_of_year" value="<?php echo $fet['no_of_year'];?>"readonly></td>
        </tr>
		
			<?php 
		}
			?>
        
		<tr>
		<td>Resume:<td>
		<a href="/Qvisionnew/qvision/Resource/Resource_form/resume_upload/<?php echo $fet['resume'];?>" download="<?php echo $fet['resume']; ?>" style="font-weight: 900;"><?php echo $fet['resume']; ?></a>
		</tr>

<?php
if($status!='37' AND $status!='23' AND $status!='22' AND $status!='16' AND $status!='19' AND $status!='40')
{
 ?>
     <tr>
      <td>Round </td>
       <td colspan="2">
		<select class="form-control" id="round_type" name="round_type" onchange="get_qn(this.value)" >
		<option value="">Select round</option>
		<?php $stmt22 = $con->query("SELECT * FROM interview_rounds where status=1");
		while ($row22 = $stmt22->fetch()) 
		{
		?>
		<option value="<?php echo $row22['id'];?>"> <?php echo $row22['name'];?></option>
		<?php 
		}
		?>
		</select>
	  </td>
    </tr>
	
	   <tr id="assessment_round">

	  </tr>
				
     <tr>  
      <td colspan="6">
	   <input type="hidden" name="cid" id="cid" value="<?php echo $cid; ?>">
	   <input type="hidden" name="rid" id="rid" value="<?php echo $rid; ?>">
	   <input type="button" class="btn btn-success" name="save" onclick="candidate_update()" style="float:right;" value="Save"> </td>
     </tr>
	<?php
}
else
{
	
}
?>
 </table>
        <!-- /.post -->

<?php
 /////////////////////////// HR FEEDBACK START ///////////////////////////////////////////////
///// status = 35 --> Selected //  status = 37 --> Rejected. /////

$sqll=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,count(*) as hrow FROM candidate_round_details c left join staff_master s on c.person_id=s.id left join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and c.status='35'");
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
<!-- <h3><center>HR Round Feedback Details</center></h3> -->
<tbody>
<?php
$hrsql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 
JOIN hr_domain_entries d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and c.status='35'");
$cnt=1;
$k=0;
while($hrows2 = $hrsql->fetch(PDO::FETCH_ASSOC))
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
 }
 ?>
 
 </tbody>
  </table> 
<?php
}   /////////////////////////// HR FEEDBACK END ///////////////////////////////////////////////
?>


<?php
 /////////////////////////// SALES FEEDBACK START ///////////////////////////////////////////////
///// status = 5 --> Selected //  status = 7 --> Rejected. /////

$salessql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,count(*) as saleRow FROM candidate_round_details c left join staff_master s on c.person_id=s.id left join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and (c.status='5' || c.status='7')");
$cnt=1;
$k=0;
$srows = $salessql->fetch(PDO::FETCH_ASSOC);
if($srows['saleRow']!=0){
?>

<table class="table table-bordered" id="sales">
<h3><center>Sales Department</center></h3>
<tr> 
<td>Manager Name</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $srows['ename']; ?>" readonly></td>
</tr>
</table>


<table class="table table-bordered" id="recruiter_page_sales">
<tbody>
<?php
$Sales_sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 
JOIN domain_entries d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and (c.status='5' || c.status='7')");
$cnt=1;
$k=0;
while($salesrows = $Sales_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo  $salesrows['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $salesrows['feedback']; ?>" readonly></td>
</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }
 ?>
 
 </tbody>
  </table> 
<?php
}  /////////////////////////// SALES FEEDBACK END ///////////////////////////////////////////////
?>


<?php
 /////////////////////////// SERVICE FEEDBACK START ///////////////////////////////////////////////
///// status = 13 --> Selected //  status = 15 --> Rejected. /////

$servicesql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,count(*) as serviceRow FROM candidate_round_details c left join staff_master s on c.person_id=s.id left join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and (c.status='13' || c.status='15')");
$cnt=1;
$k=0;
$servicerows = $servicesql->fetch(PDO::FETCH_ASSOC);
if($servicerows['serviceRow']!=0){
?>

<table class="table table-bordered" id="service">
<h3><center>Service Department</center></h3>
<tr> 
<td>Manager Name</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $servicerows['ename']; ?>" readonly></td>
</tr>
</table>


<table class="table table-bordered" id="recruiter_page_service">
<tbody>
<?php
$Service_sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 
JOIN domain_entries_hod d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and (c.status='5' || c.status='7')");
$cnt=1;
$k=0;
while($service_row = $Service_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo  $service_row['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $service_row['feedback']; ?>" readonly></td>
</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }
 ?>
 
 </tbody>
  </table> 
<?php
}  /////////////////////////// SERVICE FEEDBACK END ///////////////////////////////////////////////
?>

<?php
 /////////////////////////// ACCOUNTS FEEDBACK START ///////////////////////////////////////////////
///// status = 8 --> Selected //  status = 9 --> Rejected. /////

$Accountsql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,count(*) as accntRow FROM candidate_round_details c left join staff_master s on c.person_id=s.id left join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and (c.status='8' || c.status='9')");
$cnt=1;
$k=0;
$accountsrows = $Accountsql->fetch(PDO::FETCH_ASSOC);
if($accountsrows['accntRow']!=0){
?>

<table class="table table-bordered" id="account">
<h3><center>Accounts Department</center></h3>
<tr> 
<td>Manager Name</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $accountsrows['ename']; ?>" readonly></td>
</tr>
</table>


<table class="table table-bordered" id="recruiter_page_accounts">
<tbody>
<?php
$account_sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 
JOIN accounts_domain_entries d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and (c.status='8' || c.status='9')");
$cnt=1;
$k=0;
while($accntrows = $account_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo  $accntrows['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $accntrows['feedback']; ?>" readonly></td>
</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }
 ?>
 
 </tbody>
  </table> 
<?php
}  /////////////////////////// ACCOUNT FEEDBACK END ///////////////////////////////////////////////
?>



<?php
 /////////////////////////// HOD FEEDBACK START ///////////////////////////////////////////////
///// status = 16 --> Selected //  status = 18 --> Rejected. /////
$MDsql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,count(*) as mdRow FROM candidate_round_details c left join staff_master s on c.person_id=s.id left join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and (c.status='60' || c.status='70')");
$cnt=1;
$k=0;
$mdrows = $MDsql->fetch(PDO::FETCH_ASSOC);
if($mdrows['mdRow']!=0){
?>

<table class="table table-bordered" id="md">
<h3><center>HOD Feedback</center></h3>
<tr> 
<td>HOD Name</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $mdrows['ename']; ?>" readonly></td>
</tr>
</table>


<table class="table table-bordered" id="recruiter_page_md">
<tbody>
<?php
$md_sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 
JOIN domain_entries_hod d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and (c.status='60' || c.status='70')");
$cnt=1;
$k=0;
while($md_row = $md_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo $md_row['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $md_row['feedback']; ?>" readonly></td>
</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }
 ?>
 
 </tbody>
  </table> 
<?php
}  /////////////////////////// HOD FEEDBACK END ///////////////////////////////////////////////
?>





<?php
 /////////////////////////// MD FEEDBACK START ///////////////////////////////////////////////
///// status = 16 --> Selected //  status = 18 --> Rejected. /////
$MDsql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,count(*) as mdRow FROM candidate_round_details c left join staff_master s on c.person_id=s.id left join interview_rounds i on c.round_id=i.id where c.candid_id='$cid' and (c.status='16' || c.status='18' || c.status='3')");
$cnt=1;
$k=0;
$mdrows = $MDsql->fetch(PDO::FETCH_ASSOC);
if($mdrows['mdRow']!=0){
?>

<table class="table table-bordered" id="md">
<h3><center>MD Feedback</center></h3>
<tr> 
<td>MD Name</td>
<td colspan="2"><input type="text" class="form-control" id="head_name" name="head_name" value="<?php echo  $mdrows['ename']; ?>" readonly></td>
</tr>
</table>


<table class="table table-bordered" id="recruiter_page_md">
<tbody>
<?php
$md_sql=$con->query("SELECT s.emp_name as ename,c.candid_id,i.name as depname,c.*,s.*,i.*,d.*,r.* FROM candidate_round_details c 
join staff_master s on c.person_id=s.id 
join interview_rounds i on c.round_id=i.id 
JOIN domain_entries_md d ON c.candid_id=d.candids_id
join interview_round_name r on d.round_name_id=r.id where c.candid_id='$cid' and (c.status='16' || c.status='18' || c.status='3')");
$cnt=1;
$k=0;
while($md_row = $md_sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<td><?php echo $md_row['Sec_name']; ?></td>
<td colspan="2">
<input type="text" class="form-control" id="section_name1" name="section_name1" value="<?php echo  $md_row['feedback']; ?>" readonly></td>
</tr>
<?php 
$k++;
$cnt=$cnt+1;
 }
 ?>
 
 </tbody>
  </table> 
<?php
}  /////////////////////////// MD FEEDBACK END ///////////////////////////////////////////////
?>



    </form>
    </div>

<script>
function candidate_update()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data: data + "&" + "field=" +field,
		url:'qvision/candidate/candidate_question_allocate.php',
		success:function(data)
		{
			if(data==0)
			{
				alert("Form Data has not been Submitted");
				interview_candidate_list();
			}
			else
			{
				alert("Form Data has been Submitted");
				interview_candidate_list();
			}	
		}       
	});
}
</script>

<script>
function get_qn(v)
{
	var id=v;
	$.ajax({
		type:"GET",
		url:"qvision/candidate/get_qn.php?id=" +v,
		success:function(data)
		{
		$('#assessment_round').html(data);	
		}
		
	})
}
</script>

<script>
 function to_list()
 {
	 interview_candidate_list(); 
 }
</script>