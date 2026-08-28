<?php
require '../../connect.php';
include("../../user.php");

$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
 $user_id = $_SESSION['userid'];

?>
<div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Calls View List</font></h3>
		 <a onclick="feedbacks()" style="float: right;     background-color: #03182b;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-edit"></i> Feedbacks</a>
		  <a onclick="reports()" style="float: right;     background-color: #03182b;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-edit"></i> Reports</a>
	</div>

    <div class="card-body">
<table id="example" class="display nowrap" style="width:100%">
        <thead>
           <tr>
                    <th>#</th>
                    <th> Date</th>
                    <th> Organisation</th>
                    <th> Client</th>
                   
                    <th> Feedback</th>
                    <th> Feedback Date</th>
                    <th> Followup Date</th>
                    <th>Created By</th>
					<th>Status</th>
					 <th>Action</th>
				</tr>
        </thead>
       <tbody>
               <?php
if($candidateid == '209' || $candidateid == '10' || $candidateid == '6' || $candidateid == '20'){

$sql=$con->query("SELECT a.id,a.client_org,a.created_by as created_by,a.created_on as created_on,a.client_name,b.feedback,b.feedback_date,b.date,a.status FROM `crm_calls` a left join `crm_calls_feedback` b on  (a.id=b.calls_id) group by a.id  order by a.id desc");

$cnt=1;
 while($products_master = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $products_master['created_on'];?></td>
<td><?php echo $products_master['client_org'];?></td>
<td><?php echo $products_master['client_name'];?></td>
<td><?php echo $products_master['feedback'];?></td>
<td><?php echo $products_master['feedback_date'];?></td>
<td><?php echo $products_master['date'];?></td>
<td><?php  $created_by = $products_master['created_by'];
$cc = $con->query("select * from z_user_master where user_id='$created_by'");
$cc1 = $cc->fetch();
echo $cc1['full_name'];?></td>

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
<?php } ?>
	 
	  
     </td>
     
<td>

							<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $products_master['id']; ?>" onclick="calls_feed(<?php echo $products_master['id']; ?>)"><i class="fa fa-edit"></i> View</button>
</td>
 
</tr>
<?php 
$cnt=$cnt+1;
 }

}
?>
</tbody>
        
    </table>
  <script>
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           
            'excelHtml5'
           
            
        ]
    } );
} );

  </script>

 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
  
<script>
 function calls_feed(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"CRM/Calls/calls_view_edit.php?id="+v,
	 
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
function reports(){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"CRM/Calls/reports.php",
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
</script>