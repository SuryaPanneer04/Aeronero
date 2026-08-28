<?php
require '../../../connect.php';
include("../../../user.php");
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
                <h3 class="card-title"><font size="5">VENDOR LIST</font></h3>
				<?php
				if($userrole!='R001')
				{
				?>
			<a onclick="add()" style="float: right;" data-toggle="modal" class="btn">ADD</a>
			<?php
				}
			?>
              </div>
              <div class="card-body">
			  <table class="table table-striped table-bordered table-hover display nowrap"  id="example1" style="width:100%">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Vendor NAME</th>
					<th>Bank NAME</th>
					<th>Account No</th>
					<th>Swift Code</th>
					<th>IFSC Code</th>
					<th>STATUS</th>
					 <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
<?php

$sql=$con->query("SELECT * FROM `doller_vendor_mastor`");
$cnt=1;
 while($doller_vendor = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>
<tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $doller_vendor['vendor_name'];?></td>
<td><?php echo $doller_vendor['account_name'];?></td>
<td><?php echo $doller_vendor['account_no'];?></td>
<td><?php echo $doller_vendor['swift_code'];?></td>
<td><?php echo $doller_vendor['ifsc_code'];?></td>
<td>
	  <?php 
	  if($doller_vendor['status'] ==1)
	  {
		  
	  echo '<span style="color:green;text-align:center;"><b>Active</b></span>';
	  ?>
	  <?php }else {
		  
		 echo '<span style="color:red;text-align:center;"><b>INActive</b></span>';
		 ?>
      <?php }?>
	 
	  
     </td>
<td>
<?php
				if($userrole!='R001')
				{
				?>
	<button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $doller_vendor['id']; ?>" onclick="vendor_edit(<?php echo $doller_vendor['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
				<?php
				}
				?>
</td>

</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>
                  
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
			<script>
  
//     $("#example1").DataTable({
//       "responsive": true,
//       "autoWidth": false,
//     });
//     $('#example2').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": false,
//       "ordering": true,
//       "info": true,
//       "autoWidth": false,
//       "responsive": true,
//     });
//   });

   function vendor_edit(v){
		//alert(v);
	$.ajax({
	type:"POST",
	url:"/bbvision/qvision/BusinessProcess/doller_vendor_master/vendor_edit.php?id="+v,
	 
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

  

</script>
<script>
function add()
	{
		$.ajax({
		type:"POST",
		url:"qvision/BusinessProcess/doller_vendor_master/vendor_add.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
</script>
