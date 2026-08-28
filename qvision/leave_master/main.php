<?php
require '../../connect.php';
?>
<style>
#page-wrapper{
	margin-left: 117px !important;
}
.btn-warning{
	background-color: #337ab7 !important;
    border-color: #337ab7 !important;
}
.btn-danger{
	background-color: #5cb85c !important;
    border-color: #5cb85c !important;
}
.page-header{
	border-bottom: 3px solid #eee !important;
}
</style>
<div class="content-wrapper" id="page-wrapper">
<div class="container-fluid">
  <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Leave Master</h1>
                        </div>
                        </div>
						<div class="row">
						 <div class="col-lg-12">
						 <input type="button" style="float:right;" class="btn btn-warning" name="new" value="ADD" onclick="Leave_new()">
          </div>
                        <!-- /.col-lg-12 -->
                    </div>
					
					<br>
					
					
				<div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Leave 
                                </div>


								
 
    
    <div class="panel-body">
      <div class="table-responsive">
		 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
          <thead>
          <tr>
          <th>S.No</th>
          <th>Leave</th>
          <th>No of days</th>
          <th>Status</th>
          <th>Actions</th>
          </tr>
          </thead>
         
          <tbody>
          <?php

          $sql=$con->query("SELECT id,leave_name,no_of_days,status,case when status=1 then 'Active' else 'InActive' end as status FROM `master_leave`");
          $i=1;
          while($res = $sql->fetch(PDO::FETCH_ASSOC))
          {
          ?>
          <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $res['leave_name'] ; ?></td>
          <td><?php echo $res['no_of_days'] ; ?></td>
      
		  <td>
		   
	  <?php 
	  if($res['status'] =='Active')
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>'.$res['status'].'</b></span>';
	  ?>
	  <?php }else {
		  //echo $res['status'];
		 echo '<span style="color:red;text-align:center;"><b>'.$res['status'].'</b></span>';
		 ?>
      <?php }?>
	 
	  
     </td>
          <td>
          <!--button class="btn btn-primary"  value="<?php echo $res['id']; ?>" onclick="Leave_view(this.value)"> View</button-->
          <button class="btn btn-danger" value="<?php echo $res['id']; ?>" onclick="Leave_edit(this.value)">Edit</button>
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
  </div>
</div>
</div>
</div>
</div>

<script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>
<script>
function Leave_view(id)
{
	$.ajax({
    type:"GET",
    data:"ids="+id,
    url:"qvision/Leave_master/view.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Leave_edit(ids)
{
	$.ajax({
    type:"GET",
    data:"ids="+ids,
    url:"qvision/leave_master/edit.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
function Leave_new()
{
	$.ajax({
    type:"POST",
    url:"qvision/leave_master/new.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
</script>