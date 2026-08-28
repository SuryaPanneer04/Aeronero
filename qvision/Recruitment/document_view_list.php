<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}

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
/* .btn-danger {
    background-color: #1da348;
    border-color: #1da348;
} */
/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 513px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 400px;
  width:500px;
  padding: 10px;
  background-color: #ffffff;
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

/* Add height to Textarea */
.area{
	height: 305px !important;
}
</style>
	<div id="table_view">
<div class="card card-primary">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Candidate Document List</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
	</section>
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">

<table id="example1" class="table table-bordered">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Candidate Name</th>
		  <th>Position</th>
		  <th>Head Status</th>
		  <th>Status</th>
		   <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT *,d.dept_name,dm.designation_name as desname,c.id as id,c.status as status FROM `candidate_form_details` c left join z_department_master d on c.department=d.id left join designation_master dm on c.position=dm.id where  c.status=20 or c.status=22 order by c.id desc ");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
	
      ?>
      <tr>
	  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['first_name']." ".$emp_res['last_name']; ?></td>
		 
		  <td><?php echo $emp_res['desname']; ?></td>
		  
		    <td>
		  
			  <?php
		 echo '<span style="color:brown;text-align:center;"><b>Selected</b></span>';
		  ?>
		 
		  </td>
		     <td>
		  <?php 
		  if($emp_res['status'] == 20)
		  {
			  ?>
		<span style="color:orange;text-align:center;"><b>PENDING</b></span>
		  <?php
		  } else if($emp_res['status'] == 13){
		  ?>
		  <span style="color:green;text-align:center;"><b>Selected for Fourth Level</b></span>
		  <?php
		  }  else if($emp_res['status'] == 8){
		  ?>
		   <span style="color:blue;text-align:center;"><b>Waiting List</b></span>
		  <?php
		  } else if($emp_res['status'] == 9){
		  ?>
		    <span style="color:Red;text-align:center;"><b>Rejected</b></span>
			<?php
		  }
		  else if($emp_res['status'] == 19){
		  ?>
		    <span style="color:green;text-align:center;"><b>Mail Sent</b></span>
			<?php
		  }
		  else if($emp_res['status'] == 20){
		  ?>
		    <span style="color:green;text-align:center;"><b>Document Submited</b></span>
			<?php
		  }
		  else if($emp_res['status'] == 22){
		  ?>
		    <span style="color:green;text-align:center;"><b>Document Approved</b></span>
			<?php
		  }
		   else if($emp_res['status'] == 19){
		  ?>
		    <span style="color:green;text-align:center;"><b>Freezed</b></span>
			<?php
		  } 
		  ?>
		  </td>
		  
		   <td>
		   <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_id; ?>" onclick="view(<?php echo $emp_id; ?>)"> View</button>
		   
		   <?php if($emp_res['status'] == 20){
			  ?>
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_id; ?>" onclick="approve(<?php echo $emp_id; ?>)"> <i class="fa fa-mail">Approve</i></button> 
		  <button class="btn btn-danger btn-sm" onclick="openForm()"> Reject</button>
		  <?php }  ?>
		  <?php if($emp_res['status'] == 18){
			  ?>			  
		  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_id; ?>" onclick="insert_emp(<?php echo $emp_id; ?>)"> <i class="fa fa-mail">Freeze</i><?php }  ?></button>
		  
		  
		   
		 </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	  </div>
	  </div>
	  
	  <div class="form-popup" id="myForm">
		  <form action="" class="form-container">
			<h3>Reject Remark</h3>
			
		<!--	<input type="text" placeholder="Enter Remark" name="remark" id ="remark" required> -->
		<textarea class="form-control area" placeholder="Enter Remark" name="remark" id ="remark" required> </textarea> <br>
          
			<button type="button" class="btn" id="popup" onclick="reject_doc(<?php echo $emp_id; ?>)">Sent Mail</button>
			<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
		  </form>
		</div>
		
	  <script>
	  function view(v)
	  {
	$.ajax({
	type:"POST",
	url:"qvision/Recruitment/document_view.php?id="+v,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	  
	  function approve(v)
	  {
	$.ajax({
	type:"POST",
	url:"qvision/Recruitment/document_approve.php?id="+v,
	success:function(data)
	{
		if(data==0)
		{
			alert("Failed");
			document_approve();
		}
		else{
			alert("Approved");
			document_approve();
		}
	}
	})		  
}
	  
	  function insert_emp(v)
	  {
		  $.ajax({
	type:"POST",
	url:"qvision/Recruitment/insert_employee.php?id="+v,
	success:function(data)
	{
		if(data==0)
		{
			alert("Failed");
			document_approve();
		}
		else
		{
			alert("success");
			document_approve();
			
		}
	}
	})
	
	  }	 

function reject_doc(e)
{
	let reject = $('#remark').val();
	$.ajax({
	type:"POST",
	url:"qvision/Recruitment/document_reject.php?id="+e+"&reject_remark="+reject,
	success:function(data)
	{
		if(data==0)
		{
			alert("Mail Sent Successfully")
			document_approve()
		}
		else{
			alert("Failed")
			document_approve()
		}
	}
  })		  
}

 function openForm() {
  document.getElementById("myForm").style.display = "block";
  $('#remark').val('');
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}	  
</script>