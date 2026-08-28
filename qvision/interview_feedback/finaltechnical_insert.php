<?php
require '../../connect.php';
include('../../user.php');

 $id=$_REQUEST['id'];
$userrole=$_SESSION['userrole'];
$userid=$_SESSION['candidateid'];
$staf=$con->query("select * from staff_master where candid_id='$userid'");
$sfetch=$staf->fetch();
$staid=$sfetch['id'];

$stmt = $con->prepare("select c.id as candidate_id,c.interview_round_level as round,c.*,d.*,dm.*,r.* from candidate_form_details c
left JOIN z_department_master d ON c.department = d.id left join jobdescription_master dm on c.position=dm.id left join candidate_round_details r on c.id=r.candid_id
where c.id='$id'
"); 
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
                
				              <center><h3 class="card-title"><b>INTERVIEW FEEDBACK DETAILS</b></h3></center>
		<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
              </div>

<form method="POST" action="qvision/interview_feedback/finalfeedback_submit.php">


<table class="table table-bordered">

<tr>
<td>Candidate Name:</td>

<td colspan="5">
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo   $id;?>"readonly>
<input type="hidden" class="form-control" id="user_id" name="user_id"  value="<?php echo  $staid;?>" readonly>
<input type="hidden" name="round" id="round" value="<?php echo $row['round']; ?>">
<input type="text" class="form-control" id="name" name="name" value="<?php echo  $row['first_name']." ". $row['last_name'];?>"readonly></td>

</tr>
<tr>
<td>Position:</td>
<td colspan="6"><input type="text" class="form-control" id="position" name="position" value="<?php echo  $row['tittle'];?>"readonly></td>
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
$checkAccept = $con -> query("select status,count(*)  as carrowcnt from candidate_accept_reject where candidateID='$id' && staff_id='$staid'");
$accept_reject = $checkAccept->fetch();
if($accept_reject['carrowcnt'] ==0){
?>

<!-- Manager Accept -->
<table class="table table-bordered">
<tr>	
  <td colspan="2">	  
    <input type="button" class="btn btn-success" id="approve" name="approve"  onclick="open_date()"  value="Accept">
		<input type="button" class="btn btn-danger" id="save1" name="save1[]"  onclick="openForm(<?php echo $id;?>)"  value="Reject with Remark">
	</td>
</tr>

<tr id="availability">
  <td>Date & Time</td>
  <td>
    <input type="date" name="accpet_date" id="accept_date" class="form-control" >
</td>
<td>
    <input type="time" name="accpet_time" id="accept_time" class="form-control" onchange="approve_candidate(this.value,<?php echo $id;?>)" >
  </td> 
</tr>
</table>
<!-- Manager Accept  END-->

<?php
} elseif($accept_reject['status']==2){ ?>

<table class="table table-bordered">
<h3><center>Interview Feedback</center></h3>
<tbody>
<?php
$sql=$con->query("SELECT interview_rounds.id AS interviewroundid,interview_round_name.id AS intername_id,candidate_round_details.*,interview_rounds.*,interview_round_name.* FROM `candidate_round_details` 
INNER JOIN interview_rounds ON candidate_round_details.round_id=interview_rounds.id 
INNER JOIN interview_round_name ON interview_rounds.id=interview_round_name.inter_id 
WHERE candidate_round_details.candid_id='$id' AND candidate_round_details.status='3'");
$cnt=0;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{
?>
<tr>
<input type="hidden" class="form-control" id="count" name="count[]"  value="<?php echo count(array($cnt));?>" readonly>
<input type="hidden" class="form-control" id="interviewroundid" name="interviewroundid<?php echo $cnt; ?>"  value="<?php echo $rows['interviewroundid'];?>" readonly>
<input type="hidden" class="form-control" id="intername_id" name="intername_id<?php echo $cnt; ?>"  value="<?php echo $rows['intername_id'];?>" readonly>
<td><?php echo  $rows['Sec_name']; ?></td>
<td><input type="text" class="form-control" id="section_name1<?php echo $cnt; ?>" name="section_name<?php echo $cnt; ?>" ></td>
</tr>
<?php 
$cnt++;
 }?>
 </tbody>
</table>

<table class="table table-bordered">	
<tr>
<td>Status *:</td>
<td colspan="5">
<select class="form-control" id="status_recruiter" name="status_recruiter">
<option value="">CHOOSE TYPE</option>
<option value="13" >Selected</option>
<!--option value="14" >Waiting List</option-->
<option value="15">Rejected</option></select></td>
</tr>
</table>
<input type="button" class="btn btn-primary btn-md"  style="float:right;" name="Update" onclick="round_update()" value="Update"> 
<?php } ?>
</form>
</div>



<div class="form-popup" id="myForm">
		  <form action="" class="form-container">
			<h3>Reject Remark</h3>
			
			<input type="text" placeholder="Enter Remark" name="remark" id ="remark" required>
          
			<button type="button" class="btn" id="popup" onclick="reject_candidate(<?php echo $id;?>)">Submit</button>
			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
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


function RadioValue(v) 
{

var check2=$('#performance_1').val();
var res2 = r.split("_");
var id2=res2[1];
if(check2=='1')
{
document.getElementById("recruiteranswer_'+v1+'").value = "Bad";
}
else if(v=='2')
{
document.getElementById("recruiteranswer_1").value = "Ok";
}
else if(v=='3')
{
document.getElementById("recruiteranswer_1").value = "Average";
}
else if(v=='4')
{
document.getElementById("recruiteranswer_1").value = "Good";
}
else 
{
document.getElementById("recruiteranswer_1").value = "Excellent";
} 
}  
function round_update()
    {
    var id=$('#id').val();
	var user_id=$('#user_id').val();
	var interviewroundid=$('#interviewroundid').val();
	var intername_id=$('#intername_id').val();
    var round = $('#round').val()

    var data = $('form').serialize();
    $.ajax({
    type:'GET',
  data: data + "&" + "id="+id+"&user_id="+user_id+"&interviewroundid="+interviewroundid+"&intername_id="+intername_id+"&round="+round,
    url:'qvision/interview_feedback/finalfeedback_submit.php',

    success:function(data)
    {
      if(data==0)
      { 
        alert('Not updated');
      
      }
      else
      {
        alert("Update Successfully");
		feedback()
      }
      
    }       
    });
    }


    function openForm() {
  document.getElementById("myForm").style.display = "block";
  $('#remark').val('');
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
} 

function reject_candidate(V)
{
	let remark = $('#remark').val()
  let staffId = $('#user_id').val() //Employee Staff Master id. 
	$.ajax({
	type:'POST',
  data: "candidateId=" + V +"&remark=" + remark +"&staff_id=" + staffId+"&id="+ 0,
  url:'qvision/interview_feedback/candidate_accept_reject.php',
	success:function(data)
	{      
		alert("Rejected");
    feedback()
	}       
	});
}

function approve_candidate(d,v)
{
  let staffId = $('#user_id').val() //Employee Staff Master id. 
	let accept_date =$('#accept_date').val()
  $.ajax({
	type:'POST',
  data: "candidateId=" + v +"&staff_id=" + staffId +"&id=" +1+"&accept_time="+d+"&accept_date="+accept_date,
  url:'qvision/interview_feedback/candidate_accept_reject.php',
	success:function(data)
	{      
		alert("Accepted");
    feedback()
	}       
	});
}

function open_date(){
  $('#availability').show()
}

$(document).ready(function(){
  $('#availability').hide()
})
</script>