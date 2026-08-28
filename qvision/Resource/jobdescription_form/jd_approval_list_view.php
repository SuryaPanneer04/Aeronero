<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$jid=$_REQUEST['jid'];
$sql=$con->query("SELECT j.*,j.status as status,j.id as jid,j.created_by,s.emp_name as firstApprove,m.tittle,sm.emp_name as secondApprove FROM `jobdescription_form_details` j left join jobdescription_master m on j.jobdescription_id=m.id left join staff_master s on j.flag=s.candid_id left join staff_master sm on j.created_by=sm.candid_id where j.id='$jid'");

$sfet=$sql->fetch();
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
   <center><h3 style="color:black;" class="card-title"><b>Job Description Approval View</b></h3></center>
	<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a>
   </div>
			
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
	   <tr>
		    <td>JD Title</td>
			<td colspan="5">
			<input type="text" class="form-control" id="jd_title" name="jd_title" value="<?php echo $sfet['tittle']; ?>"readonly >
			</td>
      </tr>

	  <tr>
		    <td>Approval Level</td>
			<td colspan="5">
			<input type="text" class="form-control" id="approve" name="approve" value="<?php echo $sfet['approval_level']; ?>"readonly >
			</td>
      </tr>

	  <tr>
		    <td>Interview Round Level</td>
			<td colspan="5">
			<input type="text" class="form-control" id="round" name="round" value="<?php echo $sfet['interview_round_level']; ?>"readonly >
			</td>
      </tr>
		
		<tr>
		    <td>JD CODE</td>
			<td colspan="5">
			<input type="text" class="form-control" id="jdcode" name="jdcode"  value="<?php echo $sfet['jdcode']; ?>"readonly>
			</td>
      </tr>

		<tr>
		<td>Location</td>
        <td><input type="text" class="form-control" id="location" name="location" value="<?php echo $sfet['location']; ?>"readonly></td>
		</tr>

		<tr>
		<td>Experience</td>
        <td><input type="text" class="form-control" id="experience" name="experience" value="<?php echo $sfet['experience']; ?>"readonly></td>
		</tr>

		<tr>
		<td>Education Qualification</td>
        <td><input type="text" class="form-control" id="education" name="education" value="<?php echo $sfet['education']; ?>"readonly></td>
		</tr>

		<tr>
		<td>Certification</td>
        <td><input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo $sfet['certifications']; ?>"readonly></td>
		</tr>


		<tr>
		<td>Roles & Responsibilities</td>
        <td><input type="text" class="form-control" id="roles" name="roles" style="height: 176px;" value="<?php echo $sfet['roles']; ?>"readonly></td>
		</tr>

		<tr>
		<td>Skills Required</td>
        <td><input type="text" class="form-control" id="skills" name="skills" style="height: 176px;" value="<?php echo $sfet['skills']; ?>"readonly></td>
		</tr>

		<tr>
		<td>Initiate Date</td>
        <td colspan="2"><input type="text" class="form-control" id="date_joining" name="date_joining" value="<?php echo $sfet['joining_date']; ?>"readonly></td>
        </tr>

		<tr>
		<td>Date To Be Closed</td>
        <td colspan="2"><input type="text" class="form-control" id="date_close" name="date_close" value="<?php echo $sfet['closed_date']; ?>"readonly></td>
        </tr>

		<tr>
		<td>Replacement For</td>
        <td colspan="2">
		<?php
		$person=$sfet['replacement'];
		$replace1=$con->query("SELECT id,emp_name FROM staff_master where id='$person'");
		$refet=$replace1->fetch();
		?>
		<input type="text" class="form-control" id="replacement" name="replacement" value="<?php echo $refet['emp_name']; ?>" readonly></td>
        </tr>
		
		<tr>
		<td>CTC PA (In Lakhs)</td>
        <td colspan="2"><input type="text" class="form-control" id="ctc" name="ctc" value="<?php echo $sfet['ctc']; ?>" readonly></td>
        </tr>
		
	  <tr>
		<td>No Of Position</td>
        <td colspan="2"><input type="text" class="form-control" id="no_of_postion" name="no_of_postion" value="<?php echo $sfet['no_of_position']; ?>" readonly></td>
       </tr>

<?php 
if($sfet['status']==6){
?>
   <tr>
		<td>Approved by</td>
        <td colspan="2">
		<?php
		$approved_by=$sfet['flag'];
		$approval=$con->query("SELECT id,emp_name FROM staff_master where candid_id='$approved_by'");
		$jd_approval_by=$approval->fetch();
		?>
		<input type="text" class="form-control" id="approve_by" name="approve_by" value="<?php echo $jd_approval_by['emp_name']; ?>" readonly></td>
       </tr>

<?php }else{ ?>

	   <tr>
		<td>Approved by</td>
        <td colspan="2">
		<!-- <?php
		$approved_by=$sfet['created_by'];
		$approval=$con->query("SELECT id,emp_name FROM staff_master where candid_id='$approved_by'");
		$jd_approval_by=$approval->fetch();
		?> -->
		<input type="text" class="form-control" id="approve_by" name="approve_by" value="<?php echo $sfet['firstApprove'],'    ',$sfet['secondApprove']; ?>" readonly></td>
       </tr>

<?php } ?>

        </table>
        <!-- /.post -->
    </form>
    </div>



<script>
function back()
	{
		job_description_approve_list()
	}
</script>