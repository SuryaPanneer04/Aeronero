<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
.card-body.box-profile
{
	/*max-width: 252vh; */
    /* display: flex; */
    /* margin-left: 33vh;*/
}
</style>
		<div id="table_view">
		<div  class="card card-primary">
		<div class="card-header">
		
		 <h3 class="card-title"><font size="5">STAFF LIST</font></h3>
		 
		<!--button type="submit" class="button" name="myButtonControlID" id="myButtonControlID" target="_blank" value="" style="float:right;margin-right: 50px;background-color: #1bcfb4 !important">EXCEL</button-->
		</div>
		<!-- Main content -->
		<!-- <section class="content"> -->
		<div class="container-fluid">
		<div class="row" >
		<div class="col-md-12">
		<!-- Profile Image -->
		<div class="card  card-outline">
		<div class="card-body box-profile" >
		<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
		<thead>
		<tr>
		<th>Sl.No</th>
		<th>EmpCode</th>
		<th>Staff Name</th>
		<th>Department</th>
		<th>Status</th>

		<th class="all">Action</th>
		</tr>
		</thead>
		<tbody>
		  <?php
$emp_sql = $con->query("SELECT *, s.id as id, s.status as status FROM staff_master s LEFT JOIN z_department_master d ON s.dep_id = d.id WHERE s.status = 1 ORDER BY s.id DESC");
		  //"SELECT *,s.id as id,s.status as status FROM staff_master s left join z_department_master d on s.dep_id=d.id where s.status=1"
//echo "SELECT *,s.id as id,s.status as status FROM staff_master s left join z_department_master d on s.dep_id=d.id  where s.status=1";		 
		 $i=1;
		  while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
		  {
		  $emp_id = $emp_res['id'] ;
		  
		  ?>
		  <tr>
			  <td><?php echo $i; ?></td>
			  <td><?php echo $emp_res['emp_code']; ?></td>
			  <td><?php echo $emp_res['emp_name']; ?></td>		 
			  <td><?php echo $emp_res['dept_name']; ?></td>		  
				 
			  <td>
			  <?php 
			  if($emp_res['status'] == 1)
			  {
				  ?>
			<span style="color:orange;text-align:center;"><b>Active</b></span>
			  <?php
			  }
			  ?>		   
			  </td>
			  
			   <td><?php if($emp_res['status'] == 1)
			   {
				  ?>
			  <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="edit(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-mail">Edit</i></button>
			 <!-- <button class="btn btn-primary btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="staff_mail(<?php echo $emp_res['id']; ?>)"> Send Mail</button>-->
			  <?php 
			  
			  }  ?>
			  
			  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="staff_view(<?php echo $emp_res['id']; ?>)"> View</button>
			  
			  
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
	  <script>
	$(document).ready(function() {
		$('.dataTables-example').DataTable({
				responsive: true
		});
	});
		
	</script>
 
	  <script>
	  
	   function staff_mail(v)
	  {
		$.ajax({
			type:"POST",
			url:"qvision/Recruitment/staff/send_mail.php?id="+v,
			success:function(data)
			{
				alert("Mail Sended Successfully")
			}
		})
	  }
	  
	  
	  function staff_view(v)
	  {
	$.ajax({
	type:"POST",
	url:"qvision/Recruitment/staff/document_view.php?id="+v,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	  
	  function edit(v)
	  {
		 
		  $.ajax({
	type:"POST",
	url:"qvision/Recruitment/staff/staff_edit.php?id="+v,
	success:function(data)
	{
		$('#table_view').html(data);
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
			alert("success");
			document_approve();
		}
		else{edi
			alert("Failed");
			document_approve();
		}
	}
	})  
	  }
	  </script>