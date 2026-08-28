<?php
require '../../../connect.php';
include("../../../user.php");

$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
?>
<!DOCTYPE html>
<html lang="en">

<div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Feedback List</font></h3>
		 <a onclick="feeback()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back </a>
      

    </div>

    <div class="card-body">

 <table id="example" class="display nowrap" style="width:100%">
          <tr>
                    <th>#</th>
                    <th> Organization</th>
                   
                    <th> Contact</th>
                    <th> Feedback</th>
                    <th> Feedback Date</th>
                   
                    <th> Follwup Date</th>
                    <th>Created by</th>
                   
                  </tr>
				  
				   <tbody>
               <?php

$sql=$con->query("SELECT cc.id as id,cc.client_org as client_org,cc.client_name as client_name,cc.contact as contact,cf.feedback as feedback,cf.feedback_date as feedback_date,cf.date as date,cf.employee as emp,u.full_name as name FROM `crm_calls_feedback` cf join crm_calls cc on (cf.calls_id=cc.id) join z_user_master u on (cf.created_by=u.user_id) ORDER BY id DESC");

$cnt=1;
 while($products_master = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $products_master['client_org'];?></td>

<td><?php echo $products_master['contact'];?></td>
<td><?php echo $products_master['feedback'];?></td>
<td><?php echo $products_master['feedback_date'];?></td>
<td><?php echo $products_master['date'];?></td>
<td><?php echo $products_master['name'];?></td>


</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>
                  
                </table>

				   </div>
    <!-- /.card-body -->
</div>

  
		<script>

function feeback()
	
	{
 calls_view()

	}
  
</script>
</html>