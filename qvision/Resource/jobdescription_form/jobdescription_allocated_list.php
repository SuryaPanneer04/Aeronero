<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$consultantid=$_SESSION['consultantid'];
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
    <h3 class="card-title"><font size="5">Job description Allocated List</font></h3>
</div><br>
    
<?php 
if($consultantid=='')
{
?>
       <table class="dataTables-example table table-bordered" id="example1">		 
   
    <thead>
		<tr>
		  <th>Id</th>
		  <th>Job title</th>
		  <th>Location</th>
		  <!-- th>Experience</th-->
		  <th>Joining Date</th>
		  <th>Closing Date</th>
		  <th>Consultant Name</th>
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j left join jobdescription_master m on j.jobdescription_id=m.id left join new_client_master c on j.client_id=c.id left join jd_allocation jd on j.id=jd.jd_id left join consultant_master cm on jd.consultant_id=cm.consultant_id where j.status=2 order by j.id desc"); //or j.status=3

	  
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['tittle']; ?></td>		  
		  <td><?php echo $emp_res['location']; ?></td>		  	  
		  <!-- td>< ?php echo $emp_res['experience']; ?></td -->		  
		  <td><?php echo $emp_res['joining_date']; ?></td>		  
		  <td><?php echo $emp_res['closed_date']; ?></td>	 
		  <td><?php echo $emp_res['consultant_name']; ?></td>	 
		   <td>
			  <?php 
			  if($emp_res['status']==2)
			  {
			  ?>
		   <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_allocation_view(<?php echo $emp_res['jid']; ?>)"> View</button>
		   <button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_close(<?php echo $emp_res['jid']; ?>)"> Close </button>
		   <?php 
			  }
			  else
			  {
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
	 <?php
}
else
{
	?>
	<table class="dataTables-example table table-bordered" id="example1">	
    <thead>
		<tr>
		  <th>Id</th>
		  <th>Job title</th>
		  <th>Client</th>
		  <th>Location</th>
		  <th>Experience</th>
		  <th>Joining Date</th>
		  <th>Closing Date</th>
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,j.status as status,j.id as jid FROM `jobdescription_form_details` j left join jobdescription_master m on j.jobdescription_id=m.id left join new_client_master c on j.client_id=c.id left join jd_allocation jd on j.id=jd.jd_id left join consultant_master cm on jd.consultant_id=cm.consultant_id where jd.consultant_id='$consultantid' and j.status=2 order by j.id desc");
	  
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'];
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['tittle']; ?></td>		 
		  <td><?php echo $emp_res['client_name']; ?></td>		  
		  <td><?php echo $emp_res['location']; ?></td>		  	  
		  <td><?php echo $emp_res['experience']; ?></td>		  
		  <td><?php echo $emp_res['joining_date']; ?></td>		  
		  <td><?php echo $emp_res['closed_date']; ?></td>	 
		   <td>
			  <?php 
			  if($emp_res['status']==2)
			  {
			  ?>
		   <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_allocation_view(<?php echo $emp_res['jid']; ?>)"> View</button>
		   <button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['jid']; ?>" onclick="jd_close(<?php echo $emp_res['jid']; ?>)"> Close </button>
		   <?php 
			  }
			  else
			  {
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
	<?php
}
?>
      </div>
<script>
function back()
	{
		jobdescription_list();
	}
	
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
</script>

<script>
	 function jd_allocation_view(v)
	  {
 	$.ajax({
	type:"POST",
	url:"Qvision/resource/jobdescription_form/jd_allocation_view.php?jid="+v,
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
	url:"Qvision/resource/jobdescription_form/jd_allocate_close.php?jid="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
		  
	  }
</script>