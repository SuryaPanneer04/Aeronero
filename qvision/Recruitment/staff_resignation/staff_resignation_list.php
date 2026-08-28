<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid = $_SESSION['candidateid'];
$hod_dep='';
$reporting_per = $con->query("select dep_id from staff_master where candid_id='$candidateid' && head_status = 1"); //To find HOD.

$report = $reporting_per->fetch();
if($report){
$hod_dep = $report['dep_id']; 
}
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
	<div id="table_view">
<div  class="card card-primary">
    <div class="card-header">
        <h3> <font size="5"> Staff Resignation List </font></h3>        
    </div>
       
	<div class="card-header">
	<center><h6>  <b>Resignation has to be confirmed within 7 working days or else it will auto approved by the system.</b> </h6> </center>     
    </div>
	
       
    <!-- Main content -->
  
    <!-- Profile Image -->
    <div class="card card-primary ">
    <div class="card-body ">

<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
	   <thead>
		<tr>
		  <th>Id</th>
		  <th>Name</th>
		  <th>Reason</th>
		  <th>Upload Resignation Letter</th>
		  <th>Date</th>
		  <th>Status</th>		  
		  <th>Action</th>
		</tr>
      </thead>
      <tbody>
      <?php
	 
if($candidateid==2 && $userrole =='R010'){
	$emp_sql=$con->query("SELECT *,s.emp_name as name,r.candidate_id as cid,r.id as id,r.status as status FROM `resignation_form_details` r left join staff_master s on r.candidate_id=s.candid_id where r.reporting_person = 2 order by r.id desc"); 

}elseif($candidateid==1 && $userrole =='R001'){
	$emp_sql=$con->query("SELECT *,s.emp_name as name,r.candidate_id as cid,r.id as id,r.status as status FROM `resignation_form_details` r left join staff_master s on r.candidate_id=s.candid_id where r.reporting_person = 1 order by r.id desc"); 

}
else{
	//  print_r($userrole);
	//   die();
	$emp_sql=$con->query("SELECT *,s.emp_name as name,r.candidate_id as cid,r.id as id,r.status as status FROM `resignation_form_details` r left join staff_master s on r.candidate_id=s.candid_id where r.candidate_dep_id = '$hod_dep' order by r.id desc");  //where s.dep_id='$candidateid'
}

	
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
      $emp_id = $emp_res['id'] ;
      ?>
      <tr>
		  <td><?php echo $i; ?></td>
		  <td><?php echo $emp_res['name']; ?></td>
		  <td><?php echo $emp_res['reason']; ?></td>		 
		  <td>
		     <a href="qvision/Recruitment/staff_resignation/resignation_file_upload/<?php echo $emp_res['remarks'];?>" download="<?php echo $emp_res['remarks']; ?>"><?php echo $emp_res['remarks']; ?></a>
		  </td>		  
		  <td><?php echo date('d-m-Y',strtotime($emp_res['applied_date'])); ?></td>		  
		  <td>
		  <?php 
		  if($emp_res['status'] == 1)
		  {
		  ?>
		<span style="color:orange;text-align:center;"><b>Waiting</b></span>
		  <?php
		  } else if($emp_res['status'] == 3)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Rejected</b></span>
		  <?php
		  }  
		  		  
		  else if($emp_res['status'] == 2)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>Accepted</b></span>
		  <?php
		  }  
		 else if($emp_res['status'] == 4)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>HR Accepted</b></span>
		  <?php
		  }  
		  else if($emp_res['status'] == 5)
		  {
		  ?>
		  <span style="color:green;text-align:center;"><b>HR Rejected</b></span>
		  <?php
		  }  
		  ?>		   
		  </td>
		  
   	   <td>
		  
		  <button class="btn btn-success btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="staff_view(<?php echo $emp_res['id']; ?>)"> View</button>
		  
		  <?php if($emp_res['status'] == 1)
		   {
			  ?>
		  <button class="btn btn-info btn-sm" data-id="<?php echo $emp_res['id']; ?>" onclick="approve(<?php echo $emp_res['id']; ?>)"> <i class="fa fa-mail">Action</i></button> <?php }  ?>
		  
		  
		  <input type="hidden" name="canid" id="canid_<?php echo $emp_res['id']; ?>" value="<?php echo $emp_res['cid']; ?>">
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
		// $('.dataTables-example').DataTable({
		// 		responsive: true
		// });
		$('#example1').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
	});
  </script>
	  <script>
	  
	  function staff_view(v)
	  {
		  var cid=$('#canid_'+v).val();
	$.ajax({
	type:"POST",
	url:"qvision/Recruitment/staff_resignation/staff_view.php?id="+v+"&cid="+cid,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	 
	  function approve(v)
	  {
		  var cid=$('#canid_'+v).val();
	$.ajax({
	type:"POST",
	url:"qvision/Recruitment/staff_resignation/staff_resign_approve.php?id="+v+"&cid="+cid,
	success:function(data)
	{
		$("#table_view").html(data);
	}
	})

	  }
	  </script>