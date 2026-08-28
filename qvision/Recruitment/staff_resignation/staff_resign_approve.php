<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_REQUEST['cid'];
$resignid=$_REQUEST['id'];
$sql=$con->query("SELECT s.prefix_code,s.emp_code,s.emp_name as ename,r.candidate_id as cid,r.id as id,z.dept_name as depname,dm.div_name as divname,dd.designation_name as desname,r.status,rh.emp_name as reportPerson,r.* FROM `resignation_form_details` r left join staff_master s on r.candidate_id=s.candid_id left join z_department_master z on z.id=s.dep_id left join division_master dm on dm.id=s.div_id left join designation_master dd on dd.id=s.design_id left join staff_master rh on r.reporting_person = rh.id
where r.id='$resignid'");


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

<div class="card-primary">
<div class="card-header">
    <h3 class="card-title"><font size="5">Staff Resignation </font></h3>
	<a onclick="go_back()" style="float: right;" data-toggle="modal" class="btn btn-danger"> <i class="fa fa-plus"></i>Back</a>
  </div> 
  
<div class="card">
<div class="card-body">
<div class="tab-content">
    
<div id="salary_view"  style="font-family:'Times New Roman', Times, serif;float:left;width:100%;height:100%;position: absolute;top: 500px;left: 50px;">  </div>

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
			<textarea class="form-control textheight" id="remarks" name="remarks"> </textarea>
		</td>
        </tr>
		
   
	  <tr id="reasons">
        <td>Remarks:</td>
        <td colspan="5">
			<textarea class="form-control textheight" id="reason" name="reason"> </textarea>
		</td>
		
        </tr>
      
        <tr id="notice">
        <td>Notice Period ( Last Working Date ):</td>
        <td colspan="5"><input type="text" class="form-control" id="notice_period" name="notice_period" readonly></td>
        </tr>

        <tr id="notice_days">
        <td>Days of Notice Period:</td>
        <td colspan="5"><input type="text" class="form-control" id="notice_period_days" name="notice_period_days" readonly></td>
        </tr>
		
        <tr id="projct">
        <td>Projects to be handed over:</td>
        <td colspan="5">
			<textarea class="form-control textheight" id="projects" name="projects"> </textarea>
		</td>
        </tr>
  
        <tr>  
        <td colspan="6">
		<input type="hidden" name="cid" id="cid" value="<?php echo $candidateid;?>">
		<input type="button" class="btn btn-success" name="save" id="<?php echo $resignid; ?>" style="float:right;" onclick="staff_update(this.id)" value="Update"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
	
<script>
    $(document).ready(function(){
       $('#salary_view').hide();  //Initially Hide the loader
    })

	function staff_update(v)
	{
		var reason=$('#reason').val();
		var notice_period=$('#notice_period').val();
		var dayscount =$('#notice_period_days').val();
		var projects=$('#projects').val();
		var confirm=$('#confirm').val();
		var remarks=$('#remarks').val();
		var cid=$('#cid').val();
		var resignid=v;

        $('#salary_view').show();
        $("#salary_view").html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');//Loader

		 $.ajax({
			type:"GET",
			data: "reason=" + reason +"&notice_period=" + notice_period +"&cid=" + cid +"&projects=" +projects+"&confirm="+confirm+"&remarks="+remarks+"&resignid="+resignid +"&notice_days=" +dayscount ,
			url:"qvision/Recruitment/staff_resignation/resign_update.php",
			success:function(data)
			{ 
				alert("updated successfully")
                $('#salary_view').hide();
				staff_resignation_list()
			}
					
		 })
		
		}
		
function go_back()
{
	staff_resignation_list()
}

	function get_remarks(v)
	{
		if(v=="No")
		{
			$('#remark').show();
			
			$('#reasons').hide();
	        $('#notice').hide();
	        $('#notice_days').hide();
	        $('#projct').hide();
		}
		else if(v=="Yes")
		{
			$('#remark').hide();
			
			$('#reasons').show();
	        $('#notice').show();
	        $('#notice_days').show();
	        $('#projct').show();

	       const today = new Date();
           const tomorrow = new Date()

          // Add 1 Day
          tomorrow.setDate(today.getDate() + 60);
	      lastday = tomorrow.getDate() + '-' + (tomorrow.getMonth()+ 1) + '-' + tomorrow.getFullYear();
          document.querySelector('#notice_period').value = lastday ;
          document.querySelector('#notice_period_days').value = 60 ;

		}
	}
	
 $(document).ready(function(){
	 
	 $('#remark').hide();
	 
	 $('#reasons').hide();
	 $('#notice').hide();
	 $('#notice_days').hide();
	 $('#projct').hide();

 })
</script>
	