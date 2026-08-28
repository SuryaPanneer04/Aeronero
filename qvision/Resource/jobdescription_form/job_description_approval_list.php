<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
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
    <h3 class="card-title"><font size="5">JOB DESCRIPTION APPROVAL LIST</font></h3>
  </div> <br>
       <table class="dataTables-example table table-bordered" id="example1">		 
    <thead>
		<tr>
		  <th>ID</th>
		  <th>Job Title</th>
		  <th>JD CODE</th>
		  <th>Location</th>
		  <th>Initiate Date</th>
		  <th>Date to be closed</th>
		  <th>No Of Position</th>
		  <th>Status</th>
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j left join jobdescription_master m on j.jobdescription_id=m.id WHERE j.status=1 || j.status=6 || j.status=0 order by j.id desc");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['tittle']; ?></td>		 
		  <td><?php if($emp_res['jdcode']==''){
			echo '---';
		  }
		  else{ 
			echo $emp_res['jdcode']; 
		  }?>
		  </td>		  
		  <td><?php echo $emp_res['location']; ?></td>		  	  	  
		  <td><?php echo $emp_res['joining_date']; ?></td>		  
		  <td><?php echo $emp_res['closed_date']; ?></td>	 
		  <td><?php echo $emp_res['no_of_position']; ?></td>	
		  <td>
			<?php if($emp_res['status']==6 ){  
				echo '<span style="color:red;font-weight:bold;"> MD Level Approve Pending </span>';
			 }
			 else if($emp_res['status']==0){
                echo '<span style="color:red;font-weight:bold;"> Approval Pending </span>';
			 }
			 else{
				echo '<span style="color: green;font-weight:bold;"> Approved </span>';
			 }?>
		</td>

		   <td>
			  <?php 
			  if($emp_res['status']==1)
			  {
			  ?>
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_view(<?php echo $emp_res['jid']; ?>)"> View</button>
		  <button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_close(<?php echo $emp_res['jid']; ?>)"> Close </button>
		   <?php 
			  }
			  elseif($emp_res['status']==6)
			  {
				  ?>
<button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_view(<?php echo $emp_res['jid']; ?>)"> View</button>

				  <?php
			  }
			  else
			  {
				  ?>
		 
       <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_view(<?php echo $emp_res['jid']; ?>)"> View</button>
				  
				  <?php
			  }
			  ?>
		 </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 
      </div>
 </div>
 
<script>
function back()
	{
		resource_list();
	}
	
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
  </script>
 <script>
function jd_view(v)
{	
 	$.ajax({
	type:"POST",
	url:"/qvision/Qvision/Resource/jobdescription_form/job_description_approval_view.php?jid="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	}) 
}
	  
	  function jd_edit(v)
	  {		 
		  $.ajax({
	type:"POST",
	url:"Qvision/resource/jobdescription_form/jd_edit.php?jid="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
		  
	  }

	function jd_close(v)
	  {		 
		  $.ajax({
	type:"POST",
	url:"Qvision/resource/jobdescription_form/jd_close.php?jid="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
		  
	  }
	  
	  function insert_emp(v)
	  {
		  $.ajax({
	type:"POST",
	url:"Qvision/Recruitment/insert_employee.php?id="+v,
	success:function(data)
	{
		if(data==0)
		{
			alert("success");
			document_approve();
		}
		else{
			alert("Failed");
			document_approve();
		}
	}
	})
		  
	  }  
	  
	  </script>