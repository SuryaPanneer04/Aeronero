<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$user_candid = $_SESSION['candidateid'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
		   <div  class="card card-primary">
              <div class="card-header"style="background-color:#ff8b3d !important;">
                <h3 class="card-title"><font size="5">APPRAISAL LIST</font></h3>
			
                <a onclick="add_appraisal()" style="float: right;" data-toggle="modal" class="btn">ADD</a>
              </div>
              <div class="card-body">
       <table class="table table-bordered display nowrap"  id="example1" style="width:100%">
    <thead>
      <th>S.No</th>
      <th>Department</th>
      <th>Employee Name</th>
      <th>Tools</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("select a.id as aid,a.dep_name as dept,b.dept_name,a.person_id,c.emp_name from appraisal_master a left join z_department_master b on a.dep_name=b.id left join staff_master c on a.employee_id=c.id where a.person_id='$user_candid'");
	 
      // print_r($emp_sql);
      // die();
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['dept_name']; ?></td>
      <td><?php echo $emp_res['emp_name']; ?></td>
      <td>
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['aid']; ?>" onclick="question_edit(<?php echo $emp_res['aid']; ?>,<?php echo $emp_res['dept']; ?>)"><i class="fa fa-edit"></i> Edit</button>
	 
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

		function add_appraisal()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/appraisal_master/new_appraisal_master.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function question_edit(v,e)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/appraisal_master/edit_appraisal_master.php?id="+v+"&dept="+e,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   
</script>