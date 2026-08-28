<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}

.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>


<div  class="card card-primary">

 <div class="card-header">
  <h3 class="card-title"><font size="5"> Interview Rounds Mapping List </font></h3>
	 <a onclick=" add_interviewroundsmapping()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-plus"></i> ADD</a>
</div>

 <div class="card-body">
    <table id="example1" class="dataTables-example table table-bordered">
    <thead>
      <th>#</th>
	    <th>Round ID</th>
      <th>Person Name</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT s.emp_name,r.name,i.status AS istatus,i.id AS iid FROM `interview_rounds_mapping` i join staff_master s on i.person_name=s.id join interview_rounds r on i.round_id=r.id");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	  <td><?php echo $emp_res['name']; ?></td>
      <td><?php echo $emp_res['emp_name']; ?></td>
	  <td>
	  <?php
	  if($emp_res['istatus']==1)
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
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['iid']; ?>" onclick="interviewroundsmapping_edit(<?php echo $emp_res['iid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	  </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 
      </div>
<!-- /.card -->
      </div>
      <!-- /.col -->

 
<script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
		function add_interviewroundsmapping()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/interview_rounds_mapping/new_interview_rounds_mapping.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function interviewroundsmapping_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/interview_rounds_mapping/edit_interview_rounds_mapping.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   
</script>