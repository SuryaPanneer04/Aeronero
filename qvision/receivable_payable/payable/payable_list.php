<?php
require '../../../connect.php';

?>
<!DOCTYPE html>
<html>
<head>
 <style>
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
.btn-danger {
    background-color: #1da348;
    border-color: #1da348;
}
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 400px;
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
  padding: 25px;
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
<div id="table_view">
     </div>
<div  class="card card-primary">
       <div class="card-header" style="background-color:#ff8b3d;">
<h3 class="card-title"><font size="5">Payable List</font></h3>
</div>

<div class="card-body">
<div class="table-responsive">
<form method="POST" id="fupform" autocomplete="off">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
	<th>SL.No</th>
	<th>Vendor Name</th>
	<th>Vendor Location </th>
	<th>Payable Pending </th>
	<th>Action</th>
	
	</thead>
 <tbody>
        
     
      
 <?php
	$sql=$con->query("SELECT p.*,d.vendor_name as vendor,d.town_city from payable_payment p left join doller_vendor_mastor  d on d.id=p.vendor_name ");
	$cnt=1;
	while($data = $sql->fetch(PDO::FETCH_ASSOC))
	{
     $vendor_name=$data['vendor'];
	 $location=$data['town_city'];
	 $balance_total=$data['pending_payment'];
	 ?>
	 <tr>
	<td><?php echo $cnt;?>.</td>
	<td><?php echo $vendor_name; ?></td>
	<td><?php echo $location; ?></td>
	<td><?php echo $balance_total; ?></td>
	<td>
	<input type="button" class="btn btn-primary" id="save1" name="save1" onclick="openForm(<?php echo $data['id']; ?>)"  value="View">
	</td>
	</tr>
	<?php
	$cnt=$cnt+1;
	}
	?>
	</tbody>
	</table>
	</form>
     </div>
              <!-- /.card-body -->
     </div>


<script>


function openForm(v){
	
	$.ajax({
	type:"GET",
	data:'id='+v,
	url:"qvision/receivable_payable/payable/payable_view.php",
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})

	  }
</script>
