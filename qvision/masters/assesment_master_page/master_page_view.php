<?php
require '../../../connect.php';
include("../../../user.php");


$stmt->execute(); 
$row = $stmt->fetch();
?>
?>
<head>
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
<div  class="card card-primary">
    <div class="card-header">
	<div class="col-lg-12">
	<h4>QUESTIONS</h4>
	<a onclick="back_Assesment_master_page()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
	</div>
</div>
</div>
<form method="GET" >
<table class="table table-bordered">
<thead>
    <tr>
        <th style="width: 10%"> sno </th>
        <th><center> Questions </center></th>
    </tr>
    
</thead>

<tbody>
<?php


$asses_sql=$con->query("SELECT * FROM master_page ");
$i=1;
while($asses_res = $asses_sql->fetch(PDO::FETCH_ASSOC))
{
 ?>
<tr>
<td><?php  echo $i; ?></td>
<td><?php echo $asses_res['name']; ?></td>
<td><?php echo $asses_res['logical']; ?></td>
<td><?php echo $asses_res['Reasoning']; ?></td>
<td><?php echo $asses_res['aptitude']; ?></td>
<td><?php echo $asses_res['programming']; ?></td>
<td><?php echo $asses_res['verbal']; ?></td>
  
  <?php
$i++;
}

?> 

<tr>
<td>