<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$candidid=$_SESSION['candidateid'];
?>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color:#009EE3 !important;
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
    <h3 class="card-title"><font size="5">JOB DESCRIPTION APPROVAL</font></h3>
   </div>
    <!-- /.card-header -->
     <div class="card-body">
       <table class="dataTables-example table table-bordered table-hover" id="example1">		 
    <thead>
		<tr>
		  <th>ID</th>
		  <th>Job Title</th>
		  <th>Location</th>
		  <!-- <th>Joining Date</th>
		  <th>Closing Date</th> -->
		  <th>Status </th>
		 <th>Action</th>
		 <th></th>
		</tr>
      </thead>
      <tbody>
      <?php  
	  if($candidid==1){
		$emp_sql=$con->query("SELECT *,j.status as status,j.id as jid FROM jobdescription_form_details j LEFT JOIN jobdescription_master m on j.jobdescription_id = m.id WHERE m.status=1 and j.jdcode IS NULL ORDER BY j.id DESC"); //j.status=6

	  } else{
		// print_r('1');

		// die();
$emp_sql=$con->query("SELECT *,j.status as status,j.id as jid FROM jobdescription_form_details j LEFT JOIN jobdescription_master m on j.jobdescription_id = m.id where m.status=1 and  j.jdcode IS NULL ORDER BY j.id DESC"); //WHERE j.status='0' || j.status=6	
  } 
	 
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['tittle']; ?></td>		 
		  <td><?php echo $emp_res['location']; ?></td>		  	  
		  <!-- <td><?php echo $emp_res['joining_date']; ?></td>		  
		  <td><?php echo $emp_res['closed_date']; ?></td>	  -->
		  <td> <?php 
		   if($emp_res['status']==0){
			echo '<span style="color:red; font-weight:bold;"> Pending</span>';

		   } elseif($emp_res['status']==3){
			echo '<span style="color:orange; font-weight:bold;"> JD Closed </span>';

		   } elseif($emp_res['status']==4){
			echo '<span style="color:blue; font-weight:bold;"> JD Rejected </span>';
			
		   } elseif($emp_res['status']==5){
			echo '<span style="color:green; font-weight:bold;"> Approved </span>';

		   } elseif($emp_res['status']==6){
			echo '<span style="color:red; font-weight:bold;"> Waiting for  MD  Approval </span>';

		   } 

		  ?> </td>
		   <td>
			  <?php 
			//   if($emp_res['status']==0 || $emp_res['status']==6)
			//   {
			  ?>
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_approval_view(<?php echo $emp_res['jid']; ?>)"> View</button>
		  
		  <?php  //} ?>
		  
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
	
	 function jd_approval_view(v)
	  {
		
 	$.ajax({
	type:"POST",
	url:"qvision/Resource/jobdescription_form/job_description_approval_view.php?jid="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	}) 
  }    
 </script>