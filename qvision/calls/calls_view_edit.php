
<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
  $user_id = $_SESSION['userid'];
  $candidate_id = $_SESSION['candidateid'];
$id=$_REQUEST['id'];

$sel=$con->query("select * from crm_calls where id='$id'");
$fet=$sel->fetch();
$call_type = $fet['call_type'];
 $client_org = $fet['client_org'];
 $client_type = $fet['client_type'];
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
Calls View
<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>

<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" name='name' enctype="multipart/form-data">
   
    <table class="table table-bordered">
     
         <?php
                        $stmt = $con->query("SELECT b.id as idc,b.name as name FROM crm_calls a 
						join calls_master b where b.id='$call_type'");
                       $row1 = $stmt->fetch(); 
					   $nid = $row1['idc'];
					   $name = $row1['name'];
					   
					   
					     $stmt1 = $con->query("SELECT b.id as id2,b.name as name2 
						 FROM crm_calls a join services b where b.id='$call_type'");
                       $row2 = $stmt1->fetch(); 
					   $id2 = $row2['id2'];
					   $name2 = $row2['name2'];
					   
                            ?>
        <tr>
        <td colspan="6"><center><b>Calls View</b></center></td>
        </tr>
		
        <tr>
		<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <td>Call Source</td>
        <td colspan="5"><input type="text" class="form-control" id="client_org" name="client_org" value="<?php echo $name;?>" readonly></td>
        </tr>
		
     
        <tr>
		<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
        <td>Client Organisation Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_org" name="client_org" value="<?php echo $fet['client_org'];?>" readonly></td>
        </tr>
		<tr>
        <td>Client Name</td>
        <td colspan="5"><input type="text" class="form-control" id="client_name" name="client_name" value="<?php echo $fet['client_name'];?>"readonly></td>
        </tr>
      <tr>
        <td>Contact Number</td>
        <td colspan="5"><input type="text" class="form-control"id="contact" name="contact" value="<?php echo $fet['contact'];?>"readonly></td>
        </tr>
		<tr>
        <td>Whatsapp Number</td>
        <td colspan="5"><input type="text" class="form-control"id="whatsapp" name="whatsapp" value="<?php echo $fet['whatsapp'];?>"readonly></td>
        </tr>
      <tr>
        <td>Email Id</td>
        <td colspan="5"><input type="text" class="form-control" id="email" name="email" value="<?php echo $fet['email'];?>"readonly></td>
        </tr>
		<tr>
        <td>Alternative Mail_id</td>
        <td colspan="5"><input type="text" class="form-control" id="mail" name="mail" value="<?php echo $fet['alternative_mail'];?>"readonly></td>
        </tr>
      <tr>
        <td>Website</td>
        <td colspan="5"><input type="text" class="form-control" id="website" name="website" value="<?php echo $fet['website'];?>"readonly></td>
        </tr>
      <tr>
        <td>Address</td>
        <td colspan="5"><input type="text" class="form-control" id="address" name="address"value="<?php echo $fet['address'];?>"readonly></td>
        </tr>
    
     <tr>
        <td>Product/Service</td>
		<?php
                 $Product=$fet['Product'];

				 if($Product=='1')
				 {
					 $Product_value="Product";
				 }elseif($Product=='2')
				 {
					 $Product_value="Services";
				 }elseif($Product=='3')
				 {
					 $Product_value="Solution";
				 }
				?>
        <td colspan="5"><input type="text" value="<?php echo $Product_value; ?>" name="Product" class="form-control" id="Product" readonly></td>
        </tr>
		<tr>
		<td></td>
		<?php
		$list=$fet['services'];
			$stmtl = $con->query("SELECT * FROM product_services where id='$list'");
							$rowl = $stmtl->fetch();?>
		 <td colspan="5"><input type="text" value="<?php echo $rowl ['name']; ?>" class="form-control" name="services" id="services" readonly>		
		</td>
        </tr>
     
    <tr>
                <td>File</td>
                <td colspan="5"><a href="/KerliERP/CRM/calls/uploads/<?php echo $fet['image']; ?>" download="<?php echo $fet['image']; ?>"><?php echo $fet['image']; ?></a>
                </td>
            </tr>
			<tr>
        <td>Remarks</td>
        <td colspan="5"><input type="text" class="form-control" id="remarks" name="remarks"value="<?php echo $fet['remarks'];?>"readonly></td>
        </tr>
      </table>
	   <?php
			$sel1=$con->query("select status from crm_calls where id='$id'");
$fet1=$sel1->fetch();
			if ($fet1['status'] == 2  || $fet1['status'] == 3 || $fet1['status'] == 5) {
                ?>
				<table class="table table-bordered">
<h3><center>Feedback  Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  crm_calls_feedback where calls_id='$id'");


$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['calls_id']; ?>">
<td>Feedback</td>
<td><input type="text" class="form-control" id="feedbacks" name="feedbacks[]" value="<?php echo  $rows['feedback']; ?>" readonly></td>
<td>Feedback Date:</td><td colspan="1"><input type="text" class="form-control" id="date_0" name="dates1[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>


<td>Followup Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['date']; ?>" readonly></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
<?php   } ?>
	   <br>
            <br>
            <?php
			$sel1=$con->query("select id,status,created_by,employee from crm_calls where id='$id'");
			
			
$fet1=$sel1->fetch();


			if ($fet1['status'] == 1 ) {
                ?>
		 <table class="table table-bordered">
<h3><center>Feedback  Details</center></h3>
<tbody>

<?php

$sql=$con->query("SELECT * FROM  crm_calls_feedback where calls_id='$id'");



$cnt=1;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))

{
	
		?>
<tr>
<input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo  $rows['calls_id']; ?>">
<td>Feedback</td>
<td><input type="text" class="form-control" id="feedbacks" name="feedbacks[]" value="<?php echo  $rows['feedback']; ?>" readonly></td>
<td>Feedback Date:</td><td colspan="1"><input type="text" class="form-control" id="date_0" name="dates1[]" value="<?php echo  $rows['feedback_date']; ?>" readonly></td>


<td>Followup Date:</td><td colspan="1"><input type="text" class="form-control" id="date_1" name="dates[]" value="<?php echo  $rows['date']; ?>" readonly></td>

</tr>
<?php 
$cnt=$cnt+1;
 }?>
 </tbody>
 
      </table>
 <?php
  }
 ?>

<script>
function back(){

calls_view()

	}
</script>

