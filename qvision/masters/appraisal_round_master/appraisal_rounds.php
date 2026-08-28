<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div  class="card card-primary">
 <div class="card-header">
    <h3 class="card-title"><font size="5">APPRAISAL ROUNDS LIST</font></h3>
<a onclick="add_appraisalrounds()"  style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i>ADD</a>
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">

		 
    <table id="example1" class="dataTables-example table table-bordered">
    <thead>
      <th>#</th>
      <th>Name</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM appraisal_rounds");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['name']; ?></td>
	    
	  <td>
	  <?php
	  if($emp_res['status']==1)
	  {
		  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  }
	  else
	  {
		   echo '<span style="color:red;text-align:center;"><b>Inactive</b></span>';
	  }
	  ?>
	  </td>
	
      <td>
	  	  <!-- button class="btn btn-primary" data-id="< ?php echo $emp_res['id']; ?>" onclick="interviewrounds(< ?php echo $emp_res['id']; ?>)">interview Mapping</button -->
		  
	  <button class="btn btn-success" data-id="<?php echo $emp_res['id']; ?>" onclick="appraisalrounds_edit(<?php echo $emp_res['id']; ?>)"> Edit</button>
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
		function add_appraisalrounds()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/appraisal_round_master/new_appraisal_rounds.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function appraisalrounds_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/appraisal_round_master/edit_appraisal_rounds.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
 /*  function interviewrounds(v)
    {
    $.ajax({
    type:"POST",
    url:"/KerliERP/masters/interview_rounds/interview_rounds_name.php?id="+v,
    success:function(data){
   $("#main_content").html(data);
    }
    })
  } */
   
</script>