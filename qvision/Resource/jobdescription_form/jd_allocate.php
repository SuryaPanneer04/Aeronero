<?php
require '../../../connect.php';
$jid=$_REQUEST['jid'];
$sql=$con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j left join jobdescription_master m on j.jobdescription_id=m.id left join new_client_master c on j.client_id=c.id where j.id='$jid'");
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
	<h3 class="card-title"><b>Job description Allocate</b></h3>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"> <i class="fa fa-minus"> </i>Back</a>
   </div>
			
   <form method="POST" enctype="multipart/form-data">
   <input type="hidden" name="jid" id="jid" value="<?php echo $jid;?>">
    <!-- Post -->
    <table class="table table-bordered">
        
	   <tr>
		    <td >JD Title</td>
			<td colspan="5">
			<input type="text" class="form-control" id="jd_title" name="jd_title" value="<?php echo $sfet['tittle']; ?>"readonly >
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
		<td>Date of Joining</td>
        <td colspan="2"><input type="text" class="form-control" id="date_joining" name="date_joining" value="<?php echo $sfet['joining_date']; ?>"readonly></td>
        </tr>
		
		<tr>
		<td>Date to be Closed</td>
        <td colspan="2"><input type="text" class="form-control" id="date_close" name="date_close" value="<?php echo $sfet['closed_date']; ?>"readonly></td>
        </tr>
		
		<tr>
		<td>CTC PA (In Lakhs)</td>
        <td colspan="2"><input type="text" class="form-control" id="ctc" name="ctc" value="<?php echo $sfet['ctc']; ?>" readonly></td>
        </tr>
		
		<tr>
		<td>No Of Position</td>
        <td colspan="2"><input type="text" class="form-control" id="no_of_postion" name="no_of_postion" value="<?php echo $sfet['no_of_postion']; ?>" readonly></td>
       </tr>
		 
		 <tr>
		 <td>Allocate (Consultant)</td>
		 <td>
		 <select name="allocate[]" class="form-control" multiple>
		 <?php 
		 $consl=$con->query("select * from consultant_master where status='1'");
		 while($cfet=$consl->fetch())
		 {
		 ?>
          <option value="<?php echo $cfet['consultant_id'];?>"><?php echo $cfet['consultant_name'];?></option>
          <?php
		 }
		 ?>
         </select>
		 </td>
		 </tr>
		 
        <tr>  
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="jd_consult()" style="float:right;" value="Allocate"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>



<script>
function back()
	{
		job_description_approve_list();
	}
 function jd_consult()
{
	var field=1;
	var data = $('form').serialize();
	$.ajax({
		type:'GET',
		data: data + "&" + "field="+field,
		url:'qvision/Resource/jobdescription_form/jd_allocation_submit.php',
		success:function(data)
		{
			data = $.trim(data);
			if(data==0)
			{
				alert("JD has not been Allocated");
				job_description_approve_list();
			}
			else
			{
			    alert("JD has been Allocated");
				job_description_approve_list();
			}	
		},
		error:function(xhr, status, error) {
			alert("Server Error: " + error);
		}
	});
} 
</script>
