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
    <h3 class="card-title"><font size="5">APPRAISAL ROUNDS MAPPING LIST</font></h3>
<a onclick=" add_appraisalroundsmapping()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i> ADD</a>
			
              </div>
              <!-- /.card-header -->
              <div class="card-body">

		 
    <table id="example1" class="dataTables-example table table-bordered">
    <thead>
      <th>S.No</th>
	  <th>Round ID</th>
      <th>Person Name</th>
      <th>Status</th>
      <th>Action</th>
      </thead>
   <tbody>
      <?php
      $emp_sql=$con->query("SELECT s.emp_name,r.name,i.status AS istatus,i.id AS iid FROM `appraisal_rounds_mapping` i left join staff_master s on i.person_name=s.id left join appraisal_rounds r on i.round_id=r.id");
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
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['iid']; ?>" onclick="appraisalroundsmapping_edit(<?php echo $emp_res['iid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
		function add_appraisalroundsmapping()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/appraisal_round_mapping/new_appraisal_rounds_mapping.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function appraisalroundsmapping_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/appraisal_round_mapping/edit_appraisal_rounds_mapping.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   
</script>