

<?php
require '../../config.php';
include("../../user.php");

$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
?>

<div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Feedback List</font></h3>
		 <a onclick="feeback()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back </a>
      

    </div>

    <div class="card-body">

  <table id="dt-basic-checkbox" class="table table-bordered table-striped ">
          <tr>
                    <th>#</th>
                    <th> Organization</th>
                   
                    <th> Contact</th>
                    <th> Feedback</th>
                    <th> Feedback Date</th>
                   
                    <th> Follwup Date</th>
                   
                  </tr>
				  
				   <tbody>
               <?php

$sql=$con->query("SELECT cc.id as id,cc.client_org as client_org,cc.client_name as client_name,cc.contact as contact,cf.feedback as feedback,cf.feedback_date as feedback_date,cf.date as date FROM `crm_calls_feedback` cf join crm_calls cc on (cf.calls_id=cc.id) ORDER BY id DESC");

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


</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>
                  
                </table>
				   </div>
    <!-- /.card-body -->
</div>
<link rel="stylesheet" type="text/css" href="DataTables/css/jquery.dataTables.css"/>
				
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.bootstrap.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.bootstrap.min.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.bootstrap4.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.bootstrap5.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.bootstrap5.min.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.bulma.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.bulma.min.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.dataTables.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.dataTables.min.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.foundation.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.foundation.min.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.jqueryui.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.jqueryui.min.css"/>
				<link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.semanticui.css"/>
 
<script type="text/javascript" src="DataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="DataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="DataTables/js/dataTables.bootstrap.js"></script>
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

function feeback()
	
	{
 calls()

	}
  
</script>