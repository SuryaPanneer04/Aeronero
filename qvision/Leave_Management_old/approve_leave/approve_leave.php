<?php 
require '../../../connect.php';
$id=$_REQUEST['data'];
$data=$con->query("SELECT lds.id,me.user_name,ml.leave_name,lds.no_of_days,lds.from_date,lds.to_date,lds.reason,lds.approver_name,lds.month,lds.year,case when lds.status=1 then 'Waiting For Approval' when lds.status=3 then 'Rejected' else 'Approved' end as status FROM leave_details lds join masters_employee me on lds.employee_name=me.id join master_leave ml on lds.leave_type=ml.id where lds.id=$id");
$datas=$data->fetch(PDO::FETCH_ASSOC);
?>

<div class="content-wrapper" id="main_content">
<div class="container-fluid">
<div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-table"></i>Apply Leave Master
	  <input type="button" style="float:right;" class="btn btn-warning" name="back" value="BACK" onclick="leave_approve()">
	  </div>
    <div class="card-body">
	<h2><b> Add Leave Request - Employee </b></h2>
	 <form method="POST">
		  <div class="form-group row">
			<label for="employee" class="col-sm-2 col-form-label">Employee Name</label>
			<div class="col-sm-4">
			  <input type="hidden" class="form-control" id="id" name="id"  value="<?php echo $id;?>">
			  <input type="text" class="form-control" id="employee" name="employee"  value="<?php echo $datas['user_name'];?>" readonly>
			</div>
			<label for="type" class="col-sm-2 col-form-label">Leave Counts</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="count" name="count" placeholder="Type.." value="<?php echo $datas['no_of_days'];?>" readonly>
			</div>
		  </div>
		  <div class="form-group row">
			<label for="balance_leave" class="col-sm-2 col-form-label">Leave Type</label>
			<div class="col-sm-4">
			  <input type="text" class="form-control" id="balance_leave" name="balance_leave" placeholder="No of Days.." value="<?php echo $datas['leave_name'];?>" readonly>
			</div>
			<label for="Reason" class="col-sm-2 col-form-label">Reason For Leave : </label>
			  <div class="col-sm-4">
			   <input type="text" class="form-control" name="reason" placeholder="Reason for Leave" value="<?php echo $datas['reason'];?>" readonly>
			  </div>
		  </div>
		  <div class="form-group row">
			  <label for="from" class="col-sm-2 col-form-label">From Date</label>
				  <div class="col-sm-4">
					<input type="date" class="form-control" name="from_date" value="<?php echo $datas['from_date'];?>" readonly>
				  </div>
			  <label for="to" class="col-sm-2 col-form-label">To Date</label>
				  <div class="col-sm-4">
					<input type="date" class="form-control" name="to_date" value="<?php echo $datas['to_date'];?>" readonly>
				  </div>
		  </div>
		  <div class="form-group row">
		   <label for="Reason" class="col-sm-2 col-form-label">Approver Name : </label>
		  <div class="col-sm-10">
		   <input type="text" class="form-control" name="approver_name" placeholder="Approver Name" value="<?php echo $datas['approver_name']; ?>" readonly>
		  </div>
		  </div>
		  <div class="form-group row">
		   <label for="Reject Reason" class="col-sm-2 col-form-label">Reject Reason : </label>
		  <div class="col-sm-10">
		   <input type="text" class="form-control" name="reject_reason" id="reject_reason" placeholder="Reject Reason">
		  </div>
		  </div>
		  <br>
		  <div class="form-group row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			  <input type="button" class="btn btn-primary btn-md" id="<?php echo $id; ?>" onclick="Leave_approve(this.id)" value="Approve" title="Approve">
			  <input type="button" class="btn btn-danger btn-md" id="<?php echo $id; ?>"  onclick="Leave_reject(this.id)" value="Reject" title="Reject">
			</div>
		  </div>
	</form>
    </div>
  </div>
    </div>
    </div>
	<script>
	function Leave_approve(id)
	{
		$.ajax({
		type:"POST",
		data:"ids="+id,
		url:"/Frontdesk/HR_Management/leave_management/approve_leave/approve.php",
		success:function(data){
		 if(data == "1")
		 {
			 alert("Leave Approved");
			 leave_approve();
		 }
		 else
		 {
			alert("Leave Not Approved");
			leave_approve();
		 }
		}
		});
	}
	function Leave_reject(ids)
	{
		var reject=$('#reject_reason').val();
		$.ajax({
		type:"POST",
		data:"id="+ids+"&reject="+reject,
		url:"/Frontdesk/HR_Management/leave_management/approve_leave/reject.php",
		success:function(data){
		 if(data == "1")
		 {
			 alert("Leave Rejected");
			 leave_approve();
		 }
		 else
		 {
			alert("Leave Not Reject");
			leave_approve();
		 }
		}
		});
	}
	</script>