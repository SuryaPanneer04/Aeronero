<?php
require '../../../connect.php';
include('../../../user.php');
$userrole=$_SESSION['userrole'];
?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
.btn-warning{
	padding-top: 0px !important;
}

.btn-warning{
	background-color: #337ab7 !important;
    border-color: #337ab7 !important;
}
.btn-success{
	background-color: #5cb85c !important;
    border-color: #5cb85c !important;
}
.page-header{
	border-bottom: 3px solid #eee !important;
}
</style>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.btn-danger{
	background-color: #ed5d00;
    border-color: #ed5d00;
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
    <h3 class="card-title"><font size="5">Resource List</font></h3>
	
</div>
	<!-- <div class="row content"> -->
      <div class="col-lg-12">
        <div class="panel panel-default">
					
   <!-- /.card-header -->
   <div class="card-body">
       <table class="dataTables-example table table-bordered" id="example1">		 
   
    <thead>
		<tr>
		  <th>Id</th>
		  <th>Date</th>
		  <th>Name</th>
		  <th>Designation</th>
		  <th>Remark</th>
	      <th>Next Followup Date </th> 
		  <th>Resource Type</th>
		  <th>Status</th>
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id where s.old_status=0 group by s.id order by s.id desc");
//echo "SELECT *,s.status as status,s.id as sid FROM resource_form_detail s left join jobdescription_master m on s.position=m.id join source_master sm on s.source=sm.id left join resource_feedback rf on s.id=rf.resource_id where s.old_status=0 order by s.id desc";
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['date']; ?></td>		 
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>		  
		  <td><?php echo $emp_res['tittle']; ?></td>		  
		  <td><?php echo $emp_res['feedback']; ?></td>		  
          <td><?php echo $emp_res['next_followup_date']; ?></td>	  
		  <td><?php echo $emp_res['employement_status']; ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
			  ?>
		<span style="color:green;text-align:center;"><b>Active</b></span>
		<?php
		  } else if($emp_res['status'] == 2)
		  {
		  ?>
		  <span style="color:orange;text-align:center;"><b>Mail Sent</b></span>
		  <?php
		  } else if($emp_res['status'] == 0 or $emp_res['status'] == 3)
		  {
		  ?>
		  <span style="color:red;text-align:center;"><b>InActive</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>
		  
		   <td>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_view(<?php echo $emp_res['sid']; ?>)"> View</button>
		  
		 <?php if($emp_res['status'] == 1){
			  ?> 
		  <button class="btn btn-danger btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="resource_edit(<?php echo $emp_res['sid']; ?>)"> Edit</button>
		   
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['sid']; ?>" onclick="schedule(<?php echo $emp_res['sid']; ?>)"> <i class="fa fa-mail">Schedule</i>
		  <?php }  ?>
		  </button>
		 </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 
      </div>
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

<!-- /.content -->
</div>

<script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
			"paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
		});
	});
  </script>
 <script>
	  function resource_view(v)
	  {
		
 	$.ajax({
	type:"POST",
	url:"qvision/Resource/Resource_form/resource_view.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	}) 

	  }
	  
	  function schedule(v)
	  {		 
		  $.ajax({
	type:"POST",
	url:"qvision/Resource/Resource_form/interview_schedule.php?id="+v,
	success:function(data)
	{
		$('#main_content').html(data);
	}
	})
		  
	  }
	  
	  function resource_edit(v)
	  {
	$.ajax({
	type:"POST",
	url:"qvision/Resource/Resource_form/resource_edit.php?id="+v,
	success:function(data)
	{
		$('#main_content').html(data);
			
	}
	  })
	}
</script>