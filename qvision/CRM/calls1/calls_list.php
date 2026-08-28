

<?php
require '../../config.php';
include("../../user.php");

$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
 $user_id = $_SESSION['userid'];

?>

<div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Calls List</font></h3>
		<!-- <a onclick="call_upload()"  style="float: right;    background-color: #da542e;" data-toggle="modal" class="btn btn-default"><i class="fa fa-upload"></i> Upload</a>-->
		  <a onclick="feedbacks()" style="float: right;     background-color: #03182b;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-edit"></i> Feedbacks</a>
       <a onclick="add()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</a>

    </div>

    <div class="card-body">
<table class="table"  id="dt-basic-checkbox" cellspacing="0" width="100%">

          <tr>
                    <th>#</th>
                    <th> Organisation</th>
                    <th> Client</th>
                   
                    <th> Feedback</th>
                    <th> Feedback Date</th>
                    <th> Followup Date</th>
                  
					 <th>Status</th>
					 <th>Action</th>
					 <th>Edit</th>
					 <th>Delete</th>
                  </tr>
            <tbody>
               <?php

$sql=$con->query("SELECT a.id,a.client_org,a.client_name,b.feedback,b.feedback_date,b.date,a.status FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id) where a.created_by='$user_id' group by a.id  order by a.id desc");

$cnt=1;
 while($products_master = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $products_master['client_org'];?></td>
<td><?php echo $products_master['client_name'];?></td>
<td><?php echo $products_master['feedback'];?></td>
<td><?php echo $products_master['feedback_date'];?></td>
<td><?php echo $products_master['date'];?></td>
<td>
	  <?php 
	  if($products_master['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }
	   elseif($products_master['status'] ==2)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	   <?php }
	   elseif($products_master['status'] ==3)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
      <?php }?>
	 
	  
     </td>
     
<td>

							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_feedback(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Feedback</button>
</td>
    
<td>

							<button class="btn btn-default btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_edit(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
</td>

<td>

							<button class="btn btn-danger btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_delete(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> Delete</button>
</td>

</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>
                  
                </table>
	
    </div>
    <!-- /.card-body -->
</div>
<link rel="stylesheet" type="text/css" href="DataTables/css/jquery.dataTables.css"/>
				
				
				
 
<script type="text/javascript" src="DataTables/js/jquery.dataTables.min.js"></script>

		<script>
	$(document).ready(function () {
  $('#dt-basic-checkbox').dataTable({

    columnDefs: [{
      orderable: false,
      className: 'select-checkbox',
      targets: 0
    }],
    select: {
      style: 'os',
      selector: 'td:first-child'
    }
  });
});
</script>
<script>
 function call_upload(){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"CRM/Calls/call_upload.php",
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
 function feedbacks(){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"CRM/Calls/feedback_list.php",
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

 function calls_edit(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"CRM/Calls/calls_edit.php?id="+v,
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

   function calls_feedback(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"CRM/Calls/calls_feedback.php?id="+v,
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back()
	
	{
 calls()

	}
  
function add()
	{
		$.ajax({
		type:"POST",
		url:"CRM/Calls/calls_add.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
	 function calls_delete(v){
		//alert(v);
		//alert("Are you confirm to Delete");
	$.ajax({
	type:"POST",
	url:"CRM/Calls/calls_delete.php?id="+v,
	 
	success:function(data)
	{
		alert("Deleted Successfully");
		calls()
	}
	})
}
</script>