<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$user_candid = $_SESSION['candidateid'];

$staffid = $con -> query("SELECT id FROM staff_master WHERE candid_id='$user_candid'");
$staff = $staffid->fetch();
$employee_id = $staff['id'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
		   <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">KRA APPROVE LIST</font></h3>
              </div>
              <div class="card-body">
       <table class="table table-bordered display nowrap"  id="example1" style="width:100%">
    <thead>
      <th>S.No</th>
      <th>Department</th>
      <th>Created Date</th>
      <th>Status</th>
      <th>Tools</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("select a.id as aid,a.dep_name as dept,b.dept_name,a.person_id,a.created_on,a.status as app_master_sts from appraisal_master a left join z_department_master b on a.dep_name=b.id where a.employee_id='$employee_id' "); //&& a.status=0
	 
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['dept_name']; ?></td>
      <td><?php echo date('d-m-Y',strtotime($emp_res['created_on'])); ?></td>
      <td>
<?php 
if($emp_res['app_master_sts'] == 0){ 
    echo '<span style="color:red;"><b>Pending</b></span>';
} elseif($emp_res['app_master_sts'] == 2){ 
    echo '<span style="color:darkorange;"><b>Rejected</b></span>';
} else { 
    echo '<span style="color:green;"><b>Accepted</b></span>';
} 
?>
</td>
      <td>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['aid']; ?>" onclick="kra_view(<?php echo $emp_res['aid']; ?>,<?php echo $emp_res['dept']; ?>)"><i class="fa fa-eye"></i> view</button>
	 
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
    $('#example1').DataTable( {
        "scrollX": true
    } );
} );


  function kra_view(v,e)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/appraisal_master/kra_view.php?id="+v+"&dept="+e,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   
</script>