<?php 
require '../../connect.php';
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
<div class="card-body">
	<div class="row col-sm-12">
		<div class="col-sm-12"> <h3><center><b>Leave Applied Details</b></center></h3>
		
		 <div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			  <thead>
				  <tr>
					  <th>#</th>
					  <th colspan="1">Name</th>
					  <th colspan="1">Leave Type</th>
					  <th colspan="1">No of Days</th>
					  <th colspan="1">From Date</th>
					  <th colspan="1">Reason</th>
					  <th colspan="1">Approver Name</th>
					  <th colspan="1">Month - Year</th>
					  <th colspan="1">Status of Applied</th>
					  <th colspan="1">Action</th>
				  <tr>
			  </thead>
			  <tbody>
			  <?php 
			  $id=1;
			  $data=$con->query("SELECT lds.id,me.user_name,ml.leave_name,lds.no_of_days,lds.from_date,lds.reason,lds.approver_name,lds.month,lds.year,case when lds.status=1 then 'Waiting For Approval' when lds.status=3 then 'Rejected' else 'Approved' end as status FROM leave_details lds join masters_employee me on lds.employee_name=me.id join master_leave ml on lds.leave_type=ml.id order by lds.created_on desc");
			  while($datas=$data->fetch(PDO::FETCH_ASSOC))
			  {?>
				<tr>
					<td><?php echo $id++; ?></td> 
					<td><?php echo $datas['user_name']; ?></td> 
					<td><?php echo $datas['leave_name']; ?></td> 
					<td><?php echo $datas['no_of_days']; ?></td> 
					<td><?php echo date('d-m-Y',strtotime($datas['from_date'])); ?></td> 
					<td><?php echo $datas['reason']; ?></td> 
					<td><?php echo $datas['approver_name']; ?></td> 
					<td><?php echo $datas['month'].'-'.$datas['year']; ?></td> 
					<td><?php echo $datas['status']; ?></td> 
					<td><?php if($datas['status'] == 'Waiting For Approval')
					{?>
					<input type="button" class="btn btn-success" name="approve" value="Approve" id="<?php echo $datas['id']; ?>" onclick="approve_leave(this.id)"><?php }else{ ?>
					<input type="button" class="btn btn-primary" name="status" value="View"  id="<?php echo $datas['id']; ?>" onclick="view_approved_leave(this.id)"><?php }?>
					</td> 
				</tr>
			  <?php } ?>
			   </tbody>
			</table> 
		</div>
		</div>
	</div>
    </div>
    </div>
    </div>
	<script>
	function approve_leave(id)
	{
		$.ajax({
    type:"POST",
	data:"data="+id,
    url:"/Frontdesk/HR_Management/leave_management/approve_leave/approve_leave.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
	}
	function view_approved_leave(id)
	{
	  $.ajax({
		type:"POST",
		data:"data="+id,
		url:"/Frontdesk/HR_Management/leave_management/view/view.php",
		success:function(data){
		  $("#main_content").html(data);
		}
	  })
	}
	</script>