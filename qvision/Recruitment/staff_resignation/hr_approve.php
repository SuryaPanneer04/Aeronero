<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_REQUEST['cid'];
$resignid=$_REQUEST['id'];
$sql=$con->query("SELECT s.prefix_code,s.emp_code,s.emp_name as ename,r.candidate_id as cid,r.id as id,z.dept_name as depname,dm.div_name as divname,dd.designation_name as desname,r.status,rh.emp_name as reportPerson,r.* FROM `resignation_form_details` r left join staff_master s on r.candidate_id=s.candid_id left join z_department_master z on z.id=s.dep_id left join division_master dm on dm.id=s.div_id left join designation_master dd on dd.id=s.design_id left join staff_master rh on r.reporting_person = rh.id where r.id='$resignid'");

$data=$sql->fetch();
?>

<div class="card-primary">
  <div class="card-header">
    <h3 class="card-title"><font size="5">Staff Resignation Approval</font></h3>
	<a onclick="go_back()" style="float: right;" data-toggle="modal" class="btn btn-danger"> <i class="fa fa-plus"></i>Back</a>
  </div> 
<div class="card">
<div class="card-body">
<div class="tab-content">

<div id="salary_view"  style="font-family:'Times New Roman', Times, serif;float:left;width:100%;height:100%;position: absolute;top: 1000px;left: 50px;">  </div>

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
        <td colspan="5"><input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?php echo $data['ename'];?>" readonly ></td>
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
            <tr><td colspan="6"><center><h3>HOD Feedback</h3> </center></td></tr>
       <tr>
        <td>HOD Remark:</td>
        <td colspan="5">
        <textarea class="form-control textheight" id="reason" name="reason" readonly> <?php echo $data['hod_reason'];?> </textarea>
		</td>
        </tr>
      
        <tr>
        <td>Notice Period ( Last Working Date ):</td>
        <td colspan="5">
            <input type="text" class="form-control" id="notice_period" name="notice_period" value="<?php echo date('d-m-Y',strtotime($data['notice_period']));?>" readonly>
            <input type="hidden" class="form-control" id="notice_date" name="notice_date" value="<?php echo $data['notice_period'];?>" >
        </td>
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
        <td>HOD Status</td>
        <td colspan="5"><input type="text" class="form-control" id="hod_confirm" name="hod_confirm" value="Accepted" readonly> </td>
        </tr>

        <tr>
        <td>Approved Date:</td>
        <td colspan="5"><input type="text" class="form-control" id="approved_date" name="approved_date" value="<?php echo date('d-m-Y',strtotime($data['approved_date']));?>" readonly></td>
        </tr>
		
		
			<?php 
		}
		else
		{
			?>
            <tr><td colspan="6"><center><h3>HOD Feedback</h3> </center></td></tr>
			<tr>
        <td>HOD Status</td>
        <td colspan="5">
            <input type="text" class="form-control" id="hod_confirm" name="hod_confirm" value="Rejected" readonly> 
        </td>
        </tr>

		<tr>
        <td>Remarks</td>
        <td colspan="5">
        <textarea class="form-control textheight" id="reason" name="reason" readonly> <?php echo $data['hod_rejoin_remark'];?> </textarea>
        </td>
        </tr>
			<?php
		}
		?>

		<tr><td colspan="6"><center><h3>HR Feedback</h3> </center></td></tr>

       <tr>
        <td>Confirm:</td>
        <td colspan="5"><select class="form-control" name="confirm" id="confirm" onchange="get_remarks(this.value)">
		<option value="">Select</option>
		<option value="Yes">Yes</option>
		<option value="No">No</option>
		</select>
		</td>
      </tr>
		
        <tr id="remark">
        <td>Remarks:</td>
        <td colspan="5">
            <textarea class="form-control" id="remarks" name="remarks" >  </textarea>
        </td>
        </tr>

        <tr id="lastdate">
        <td>Relieving Date:</td>
        <td colspan="5">
           <input type="date" class="form-control" id="last_date" name="last_date" onchange="validateage()">
        </td>
        </tr>

        <tr id="noticeDays"> 
        <td>Days Of Notice Period:</td>
        <td colspan="5">
           <input type="text" class="form-control" id="donp" name="donp" readonly>
        </td>
        </tr>
    
        <tr>  
        <td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<input type="button" class="btn btn-success" name="save" id="<?php echo $resignid; ?>"onclick="hr_update(this.id)" value="Update"></td>
        </tr>
        </table>

    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
	
<script>
	function hr_update(v)
	{
		
		var confirm=$('#confirm').val();
		var last_date=$('#last_date').val();
		var remarks=$('#remarks').val();
		var notice_period=$('#notice_date').val();
		var notice_days=$('#notice_period_days').val();
		var donp=$('#donp').val();
		var cid=$('#cid').val();
		var resignid=v;
        
        $('#salary_view').show();
        $("#salary_view").html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');

		 $.ajax({
			type:"POST",
			data: "&cid=" + cid +"&confirm="+ confirm +"&remarks="+ remarks +"&resignid="+ resignid +"&lastDate="+ last_date +"&notice_days="+ notice_days + "&relieve_dasyscount="+ donp +"&notice_date="+ notice_period,
			url:"qvision/Recruitment/staff_resignation/hr_update.php",
			success:function(data)
			{
		        alert("Updated successfully")
                $('#salary_view').hide();
				hr_resignation_approve()
			}	
		 })
		
	}
		
function go_back()
{
	hr_resignation_approve();
}
	
	function get_remarks(v)
	{
		if(v=="No")
		{
			$('#remark').show();
			$('#lastdate').hide();
			$('#noticeDays').hide();
		}
		else
		{
			$('#remark').hide();
			$('#lastdate').show();
			$('#noticeDays').show();
		}
	}
	
  $(document).ready(function(){
	$('#remark').hide();
	$('#lastdate').hide();
	$('#noticeDays').hide();
    $('#salary_view').hide();

 })


 function validateage(){ //After select Relieve date to Calc the count of days of notice period by subtraction ( relieve date - currentDate ) and set the value to the dayscount input.

    let dor = $('#last_date').val()
    let dorDate = new Date(dor)
    let currentDate = new Date()

    var finalDate =   dorDate.getTime() - currentDate.getTime()
    var daysCount = finalDate / (1000 * 3600 * 24);

    document.querySelector('#donp').value = Math.round(daysCount); 
    $('#donp').attr('readonly',true);
}

</script>
	