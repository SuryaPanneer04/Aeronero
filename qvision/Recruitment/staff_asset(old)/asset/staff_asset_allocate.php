<?php
require '../../config.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from staff_access_request where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();

$sid=$row['staff_id'];
$access=$row['asset_master_id'];
$cug_status=$row['cug_status'];

$staff_mas=$con->query("select * from staff_master where id='$sid'");
$stafet=$staff_mas->fetch();
$dep=$stafet['dep_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Asset Access Edit
<a onclick="back_to_staff()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="fupname" action="" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="/KerliERP/Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
</tr>
<tr>
<td>Employee Name:</td>
<td colspan="2">
<input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>">
<input type="hidden" name="reqid" id="reqid" value="<?php echo $id;?>">
<?php
$dep_sql1=$con->query("SELECT * FROM staff_master where id='$sid' ");
$fet=$dep_sql1->fetch();		
		?>
		<input type="text" name="emp_name" id="emp_name" class="form-control" value="<?php echo $fet['emp_name'];?>" readonly>
		</td>
</tr>


<?php
$isel=$con->query("select distinct m.id as id,a.asset_name as name from assets_form_detail a join assets_master m on a.asset_name=m.name where a.asset='Internal Asset' and m.name ='$access'");

$i=0;
$s=1;
while($dfet=$isel->fetch())
{
	$mid=$dfet['name'];
		 ?>
	<tr>	 
<td><?php echo $dfet['name'];?></td>
<td>
<select name="asset_name" id="asset_name" class="form-control">
<?php 
$asset_form=$con->query("select id,Serial_no from assets_form_detail where asset_name='$mid' and asset='Internal Asset' and status=1");
//echo "select id,Serial_no from assets_form_detail where asset_name='$mid' and asset='Internal Asset' and status=1";
while($disp=$asset_form->fetch())
{
	?>
	
	<option value="<?php echo $disp['id'];?>"><?php echo $disp['Serial_no'] ;?></option>
	
	<?php
}
?>
</select >
</td>
</tr>

</div>
 
 <?php		 
 
 	$i++;
	$s++;
}

?>
<?php
if($cug_status=='Yes')
{
	
	?>
	<tr>
<td>CUG:</td>
<td>
<input type="hidden" name="cug_sta" id="cug_sta" value="<?php echo $cug_status;?>">
<select name="cug" id="cug" class="form-control">
<?php 
$selcug=$con->query("SELECT *,s.id as id FROM `sim_master` s join sim_mapping m on s.id=m.sim_id where m.department_id='$dep' and m.status=1");
//echo "SELECT *,s.id as id FROM `sim_master` s join sim_mapping m on s.id=m.sim_id where m.department_id='$dep' and m.status=1";
while($simdis=$selcug->fetch())
{
	?>
	<option value="<?php echo $simdis['id']; ?>"><?php echo $simdis['phone_no']; ?></option>
	<?php
}
?>

</td>
</tr>

	<?php
}
?>
<tr>
<td>Mail Id</td>
<td><input type="text" name="mail_id" id="mail_id" class="form-control" ></td>
</tr>
</table>


<!--table class="table table-bordered">
<tr>
<td>Status:</td>
<td>
 
<select name="status" id="status" class="form-control">
<option value="1">Active</option>
<option value="2">In-Active</option>
</select>

</td>
</tr>
</table-->
<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
</div>
</div>
<script>
		function back_to_staff()
    {
   staff_asset_allocate()
  }
 </script>
<script>
   
		 $(document).ready(function(){  
		
		$("form[name='fupname']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
           $.ajax({  
                url:'Recruitment/staff_asset/staff_asset_allocate_submit.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
                     alert("Entry Successfull");
		staff_asset_allocate()
                }  
           });  
      });  
	   });
</script>
