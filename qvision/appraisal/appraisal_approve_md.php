<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
		   <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">APPRAISAL APPROVE</font></h3> 
              </div>
              <div class="card-body">
       <table class="table table-bordered display nowrap"  id="example1" style="width:100%">

   
     <thead>
      <th>S.No</th>
      <th>Department</th>
      <th>Employee</th>
      <th>Status</th>
      <th>Tools</th>
      </thead>
      <tbody>
      <?php
	   $f_date = "01-04-".date("Y"); //d-m-Y
       $t_date = "31-03-".date("Y",strtotime('+1 years')); //d-m-Y
	   
		$emp_sql=$con->query("SELECT  a.id as aid,a.emp_name as eid,a.dep_name,b.dept_name,c.emp_name,a.status,d.emp_name as person_name FROM appraisal_details a 
        LEFT JOIN z_department_master b ON a.dep_name=b.id  
        LEFT JOIN staff_master c ON a.emp_name=c.id 
        LEFT JOIN staff_master d ON a.person_id=d.id where (a.status=1 || a.status=5 || a.status=6) AND a.from_date='$f_date' AND a.to_date='$t_date' ");  
	
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['dept_name']; ?></td>
      <td><?php echo $emp_res['emp_name']; ?></td>  
      <td><?php if ($emp_res['status'] == 1) {
                  echo '<span style="color:red;"><b>Pending</b></span>';
                }  elseif ($emp_res['status'] == 5 || $emp_res['status'] == 3) {
                  echo '<span style="color:green;"><b> Approved </b></span>';
                } elseif ($emp_res['status'] == 6) {
                  echo '<span style="color:red;"><b> Rejected </b></span>';
                }
                ?> </td>
      <td>
	  <button class="btn btn-info btn-sm edit btn-flat" data-id="<?php echo $emp_res['aid']; ?>" onclick="mdview_approve(<?php echo $emp_res['aid']; ?>)"><i class="fa fa-edit"></i> view</button>
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

   function mdview_approve(v)
    {
    $.ajax({
    type:"POST",
    url:"/ssinfo1/qvision/appraisal/appraisal_approve_mdview.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
</script>