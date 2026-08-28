<?php
require '../../connect.php';
include("../../user.php");
/* $candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole']; */
$userrole=$_SESSION['userrole'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #f1cc61 !important;
	}
	</style>
<div  class="card card-primary">
              <div class="card-header" style="background-color:#ff8b3d !important;">
                <h3 class="card-title"><font size="5">CONSULTANT LIST</font></h3>
				<?php
				if($userrole!='R001')
				{
				?>
			<a onclick="return add_consultant()"  style="float: right;" data-toggle="modal" class="btn btn-dark">ADD</a>
				<?php }
				?>
              </div>
              <div class="card-body">
       <!-- <table class="dataTables-example table table-striped table-bordered table-hover"  id="example1"> -->
       <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">

       <thead>
	<th>S.NO</th>
      <th>Consultant Name</th>
	   <th>Cosultant Organiztion</th>
	   <th>Cosultant Phone No</th>
	   <th>Cosultant Email</th>
	   <th>Percentage</th>
<th>Status</th>				        
<th>Action</th>
 
     
      <!--th>Tools</th-->
      </thead>
      <tbody>
      <?php
	  
      $assets_sql=$con->query("SELECT * FROM `consultant_master` order by consultant_id desc");
	   $i=1;
      while($assets_res = $assets_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	  <td><?php echo  $assets_res['consultant_name']; ?></td>
	   <td><?php echo  $assets_res['con_org']; ?></td>
	    <td><?php echo  $assets_res['phn_no']; ?></td>
		 <td><?php echo  $assets_res['email']; ?></td>
		 <td><?php echo  $assets_res['percentage']; ?></td>
		
		 	 <td>
<?php if(($assets_res['status']==1))  
{

echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
}
if(($assets_res['status']==2))  
{
echo '<span style="color:red;text-align:center;"><b>In Active</b></span>';
}

?></td>
     <td>
	 <?php
				if($userrole!='R001')
				{
				?>
	 <button class="btn btn-success" data-id="<?php echo $assets_res['consultant_id']; ?>" onclick="consultant_edit(<?php echo $assets_res['consultant_id']; ?>)"><i class="fa fa-edit"></i> EDIT</button>
   <?php
				}
?>				
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
		function add_consultant()
    {
    $.ajax({
    type:"POST",
	  url:"qvision/consultant_master/consultant_add.php",
	success:function(data){
   $("#main_content").html(data);
    }
    })
  }
  
   function consultant_edit(v){
	 // alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/consultant_master/consultant_edit.php?id="+v,
    success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
     
        
</script>