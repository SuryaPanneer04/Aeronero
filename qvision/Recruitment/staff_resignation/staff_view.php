<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_REQUEST['cid'];
$resignid=$_REQUEST['id'];
$sql=$con->query("SELECT s.prefix_code,s.emp_code,s.emp_name as ename,r.candidate_id as cid,r.id as id,z.dept_name as depname,dm.div_name as divname,dd.designation_name as desname,r.status,rh.emp_name as reportPerson,r.* FROM `resignation_form_details` r left join staff_master s on r.candidate_id=s.candid_id left join z_department_master z on z.id=s.dep_id left join division_master dm on dm.id=s.div_id left join designation_master dd on dd.id=s.design_id left join staff_master rh on r.reporting_person = rh.id where r.id='$resignid'");

$data=$sql->fetch();
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">

 <style>
    /* .textheight{
        height: 300px !important;

    } */
</style>

</head>

<div class="card card-primary">
<div class="card-header">
            <h4 class="card-title"><font size="5">Staff Resignation view </font></h4>
			<input type="button" name="back" id="back" data-toggle="tab" style="float: right;" class="btn btn-primary" value="Back" onclick="go_back()">
    </div>
<div class="card-body">
<div class="tab-content">
    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
	
    <table class="table table-bordered">
      
        <tr>
        <td colspan="6"><center><b> Employee Detail</b></center></td>
        </tr>

        <tr>
        <td>Employee Code:</td>
        <td colspan="5"><input type="text" class="form-control" id="candidate_code" name="candidate_code" value="<?php echo $data['prefix_code'].$data['emp_code'];?>" readonly></td>
        </tr>

       <tr>
        <td>Name of the Employee:</td>
        <td colspan="5">
            <input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?php echo $data['ename'];?>" readonly >
        </td>
        </tr>

       <tr>
        <td>Department:</td>
        <td colspan="5">
		<input type="text" class="form-control" id="dep_id" name="dep_id" value="<?php echo $data['depname'];?>" readonly>
		</td>
        </tr>
     
        <tr>
        <td>Designation:</td>
        <td colspan="5"><input type="text" class="form-control" id="designation" name="designation" value="<?php echo $data['desname'];?>" readonly>
		</td>
        </tr>
		
        <tr>
		<td> Reporting Person :</td>
        <td>
            <input type="text" class="form-control" id="report_to" name="report_to" value="<?php echo $data['reportPerson']; ?>" readonly>
        </td>
		</tr>

        <tr>
		<td> Date of Resignation :</td>
        <td>
            <input type="text" class="form-control" id="dor" name="dor" value="<?php echo date('d-m-Y',strtotime($data['applied_date'])); ?>" readonly>
        </td>
		</tr>

		<tr>
		<td>Reason of Relieving :</td>
        <td>
            <textarea class="form-control textheight" id="relieve_reason" name="relieve_reason" readonly> <?php echo $data['reason']; ?> </textarea>
        </td>
		</tr>
		
        <tr>
          <td>Resignation Letter :</td>
          <td>
		      <a href="qvision/Recruitment/staff_resignation/resignation_file_upload/<?php echo $data['remarks'];?>" download="<?php echo $data['remarks']; ?>"><?php echo $data['remarks']; ?></a>
		  </td>
        </tr>


		<?php 
		$sta=$data['hod_accept_status'];
		if($sta=="Yes")
		{
		?>
        	<tr><td colspan="6"> <center><h3>HOD Feedback</h3> </center></td></tr>
       <tr>
        <td>HOD Remark:</td>
        <td colspan="5">
            <textarea class="form-control textheight" id="reason" name="reason" readonly> <?php echo $data['hod_reason'];?> </textarea>
		</td>
        </tr>
      
        <tr>
        <td>Notice Period ( Last Working Date ):</td>
        <td colspan="5"><input type="text" class="form-control" id="notice_period" name="notice_period" value="<?php echo date('d-m-Y',strtotime($data['notice_period']));?>" readonly></td>
        </tr>

        <tr>
        <td>Days of Notice Period:</td>
        <td colspan="5"><input type="text" class="form-control" id="notice_period_days" name="notice_period_days" value="<?php echo $data['notice_days'];?>" readonly></td>
        </tr>
		
        <tr>
        <td>Projects to be handed over:</td>
        <td colspan="5">
            <textarea class="form-control textheight" id="projects" name="projects" readonly> <?php echo $data['handling_projects'];?> </textarea>
        </td>
        </tr>
		
		
	   <tr>
        <td>Confirm Status</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="Accepted" readonly></td>
        </tr>
		
		
			<?php 
		}
		else if($sta=="No")
		{
			?>
            	<tr><td colspan="6"> <center><h3>HOD Feedback</h3> </center></td></tr>
	     <tr>
        <td>Confirm Status</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="Rejected" readonly></td>
        </tr>
		<tr>
        <td>Remarks</td>
        <td colspan="5">
            <textarea class="form-control textheight" id="confirm" name="confirm" readonly> <?php echo $data['hod_rejoin_remark'];?> </textarea>
        </td>
        </tr>
			<?php
		}
		?>
		<?php 
		$sta=$data['status'];
		if($sta==4 or $sta==5)
		{
			?>
			
		<tr><td colspan="2"><center> <h3>HR Feedback</h3> </center> </td></tr>
        
		<?php 
		$sta=$data['hr_accept_status'];
		if($sta=="Yes")
		{
            if($data['relieving_date']){
                $releiveDate = Date('d-m-Y',strtotime($data['relieving_date'])) ;
                $releiveDays = $data['relieve_days_count'];
             } 
             else{
                 $releiveDate = $data['notice_period'];
                 $releiveDays = $data['notice_days'];
             }

			?>
			<tr>
        <td>Confirm Status</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="Accepted" readonly></td>
        </tr>
		
        <tr>
         <td>Relieving Date:</td>
         <td colspan="5">
           <input type="text" class="form-control" id="last_date" name="last_date" value="<?php echo $releiveDate;?>" readonly>
         </td>
        </tr>

        <tr>
        <td>Days of Notice Period:</td>
        <td colspan="5"><input type="text" class="form-control" id="relieve_days" name="relieve_days" value="<?php echo $releiveDays;?>" readonly></td>
        </tr>

		
			<?php 
		}
		else
		{
			?>
			<tr>
        <td>Confirm Status</td>
        <td colspan="5"><input type="text" class="form-control" id="confirm" name="confirm" value="Rejected" readonly></td>
        </tr>
		<tr>
        <td>Remarks</td>
        <td colspan="5">
            <textarea class="form-control textheight" id="projects" name="projects" readonly> <?php echo $data['hr_rejoin_remark'];?> </textarea>
        </td>
        </tr>
			<?php
		}
		 
		}
		?>

        </table>
        <!-- /.post -->
    </form>
    </div>
    </div>
    </div>

<script>
function go_back()
{
	staff_resignation_list();
}
</script>