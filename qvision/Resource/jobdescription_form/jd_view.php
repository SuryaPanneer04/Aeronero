<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$jid=$_REQUEST['jid'];
$sql=$con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j left join jobdescription_master m on j.jobdescription_id=m.id where j.id='$jid'");
$sfet=$sql->fetch();
?>
   <div class="card card-primary">
   <div class="card-header">
   <center><h3 class="card-title"><b>Job Description</b></h3></center>
	<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a>
   </div>
			
   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
	   <tr>
		    <td >JD Title</td>
			<td colspan="5">
			<input type="text" class="form-control" id="jd_title" name="jd_title" value="<?php echo $sfet['tittle']; ?>"readonly >
			</td>
      </tr>

	  <!---<tr>
		    <td >Approval Level</td>
			<td colspan="5">
			<input type="text" class="form-control" id="approve" name="approve" value="<?php echo $sfet['approval_level']; ?>"readonly >
			</td>
      </tr>-->
<!-- 
	  <tr>
		    <td >Interview Round Level</td>
			<td colspan="5">
			<input type="text" class="form-control" id="round" name="round" value="<?php echo $sfet['interview_round_level']; ?>"readonly >
			</td>
      </tr> -->

		<tr>
		    <td >Client Org Name</td>
			<td colspan="5">
			<input type="text" class="form-control" id="client_org_name" name="client_org_name"  value="<?php echo $sfet['client_org_name']; ?>"readonly>
			</td>
      </tr> 
	  
		<tr>
		<td>Location</td>
        <td><input type="text" class="form-control" id="location" name="location" value="<?php echo $sfet['location']; ?>"readonly></td>
		</tr>
		<!-- <tr>
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
		<tr>
		<td>Roles & Responsibilities</td>
        <td><input type="text" class="form-control" id="roles" name="roles" style="height: 176px;" value="<?php echo $sfet['roles']; ?>"readonly></td>
		</tr>
		<tr>
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
		
		if($person != ''){
		?>
     
	 <input type="text" class="form-control" id="replacement" name="replacement" value="<?php echo $sfet['replacement']; ?>" readonly>
       
	   <?php
		}else{
		$replace1=$con->query("SELECT emp_name FROM `staff_master` where id='$person'");
		$refet=$replace1->fetch();
		?>
		<input type="text" class="form-control" id="replacement" name="replacement" value="<?php echo $refet['emp_name']; ?>" readonly>
	    <?php } ?> </td>
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
	   		$approved_by=$sfet['flag'];
		if($approved_by){
		    $test = explode(',',$sfet['flag']);
		?> -->
	   <tr>
		<td>Approved by</td>
        <td colspan="2">
		<?php
		for($i=0;$i<count($test);$i++){
		$approval=$con->query("SELECT id,emp_name FROM staff_master where candid_id='$test[$i]'");
		$jd_approval_by=$approval->fetch();
		$by_approved[]= $jd_approval_by['emp_name'];
		}
		?>
		<input type="text" class="form-control" id="approve_by" name="approve_by" value="<?php foreach($by_approved as $key => $value) {  echo  $value,' ,  '; } ?>" readonly></td>
       </tr>
<?php } ?>
        </table>
        <!-- /.post -->
    </form>
    </div>



<script>
function back()
	{
		jobdescription_form();
	}
</script>
