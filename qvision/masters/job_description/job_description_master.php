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
                <h3 class="card-title"><font size="5">JOB DESCRIPTION LIST</font></h3>
			
                <a onclick="add_jd()" style="float: right;" data-toggle="modal" class="btn">ADD</a>
              </div>
              <div class="card-body">
       <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">


    <thead>
      <th>#</th>
      <th>Title</th>
     
      <th>Interview Round Level</th>
      <th>Status</th>
      <th>Tools</th>
      </thead>
      <tbody>
      <?php
      $emp_sql=$con->query("SELECT * FROM jobdescription_master");
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['tittle']; ?></td>

     

      <td>
        <?php if( $emp_res['interview_round_level']==1){
          echo "First Round";
        }else if($emp_res['interview_round_level']==2){
          echo "Second Round";
        }else if($emp_res['interview_round_level']==3){
          echo "Third Round";
        }else{
          echo "Round Not Selected";
        } 
        ?></td>

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
	  <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="jd_edit(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
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
</script>
<!-- <script>
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script> -->
<script>
		function add_jd()
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/job_description/new_jobdescription.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function jd_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/job_description/edit_jobdescription.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   
</script>