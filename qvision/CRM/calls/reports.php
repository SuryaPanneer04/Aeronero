<?php
require '../../../connect.php';
include("../../../user.php");

$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
?>

<div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Feedback List</font></h3>
		 <a onclick="reports()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back </a>
      

    </div>

    <div class="card-body">

 <table id="examp" class="display nowrap" style="width:100%">
          <tr>
                    <th>#</th>
                    <th> Call Type</th>
                    <th> Call Source</th>
                    <th> Client Type</th>
					<th> Company Name</th>
                    <th> Client Name</th>
                    <th> Contact No</th>
                    <th> Whatsapp No</th>
                    <th> Email Id</th>
                    <th> Alternative Email Id</th>
                    <th> Address</th>
                    <th> Website</th>
                   
                    <th> Product/Service</th>
                    <th>File</th>
                    <th>Remarks</th>
                    <th>Created by</th>
                   
                  </tr>
				  
				   <tbody>
               <?php

$sql=$con->query("SELECT * FROM crm_calls a join z_user_master b on (a.created_by=b.user_id) ORDER BY a.id DESC");

$cnt=1;
 while($products_master = $sql->fetch(PDO::FETCH_ASSOC))
{
	
	$ser = $products_master['services'];

	$sqla=$con->query("SELECT b.name as name FROM crm_calls a join product_services b on (a.services=b.id) where b.id='$ser'");
	
$bb = $sqla->fetch();
 $services = $bb['name'] ?? null; 
	
	 if($products_master['Product'] ==1)
	  {
		  
	  $product = 'Corporate';
	  }
	   elseif($products_master['Product'] ==2)
	  {
		  
	  $product = 'Services';
	  }
	  elseif($products_master['Product'] ==3)
	  {
		  
	  $product = 'Solution';
	  }
	  $service = $product.'/'.$services;
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php 
 if($products_master['cust_type'] ==1)
	  {
		  
	  echo 'Corporate';
	  ?>
	  <?php }
	   elseif($products_master['cust_type'] ==2)
	  {
		  
	  echo 'Individual';
	  ?>
	   <?php } ?></td>
	   <td><?php 
 if($products_master['call_type'] ==1)
	  {
		  
	  echo 'Incoming';
	  ?>
	  <?php }
	   elseif($products_master['call_type'] ==2)
	  {
		  
	  echo 'Outgoing';
	  ?>
	   <?php }elseif($products_master['call_type'] ==3)
	  {
		  
	  echo 'Direct';
	  ?>
	   <?php }elseif($products_master['call_type'] ==6)
	  {
		  
	  echo 'By Mail';
	  ?>
	   <?php } ?></td>
	    <td><?php 
 if($products_master['client_type'] ==1)
	  {
		  
	  echo 'New Client';
	  ?>
	  <?php }
	   elseif($products_master['client_type'] ==2)
	  {
		  
	  echo 'Existing Client';
	  ?>
	   <?php }elseif($products_master['client_type'] ==3)
	  {
		  
	  echo 'New Individual Customer';
	  ?>
	   <?php }elseif($products_master['client_type'] ==4)
	  {
		  
	  echo 'Existing Individual Customer';
	  ?>
	   <?php } ?></td>
	   <td><?php echo $products_master['client_org'];?></td>
	   <td><?php echo $products_master['client_name'];?></td>
	   <td><?php echo $products_master['contact'];?></td>
	   <td><?php echo $products_master['whatsapp'];?></td>
	   <td><?php echo $products_master['email'];?></td>
	   <td><?php echo $products_master['alternative_mail'];?></td>
	   <td><?php echo $products_master['address'];?></td>
	   <td><?php echo $products_master['website'];?></td>
	   <td><?php echo $service;?></td>
	   <td><?php echo $products_master['image'];?></td>
	   <td><?php echo $products_master['remarks'];?></td>
	   <td><?php echo $products_master['full_name'];?></td>
</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>
                  
                </table>
				 

				   </div>
    <!-- /.card-body -->
</div>

  
		<script>

function reports()
	
	{
 calls_view()

	}
  
</script>

