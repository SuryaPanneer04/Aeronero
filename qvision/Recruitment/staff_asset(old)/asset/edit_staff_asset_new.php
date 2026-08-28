<?php
require '../../connect.php';
 $id=$_REQUEST['id'];
$stmt = $con->prepare("select * from staff_asset where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();
$sid=$row['emp_name'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> DEPARTMENT DETAILS EDIT
<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"> </i>Back</a>
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
<input type="hidden" name="userman" id="userman" value="<?php echo  $id; ?>">
<td colspan="2"><select class="form-control" name="emp_name">
<?php
$dep_sql1=$con->query("SELECT * FROM staff_master where id='$sid' ");
$fet=$dep_sql1->fetch();
?>
				<option value="<?php echo $fet['id'];?>"><?php echo $fet['emp_name'];?></option>
		<?php
		$dep_sql=$con->query("SELECT * FROM staff_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['emp_name']; ?></option>
			<?php
		}
		?>
		</select></td>
</tr>
<tr>
<td>Stationaries:</td>

<td>
								<input type="checkbox" name="stationaries" value="Office Stationary[]" <?php echo $row['stationaries']=='Office Stationary[]'?' checked="checked" ':''; ?>/>&nbsp;
									<label>Office Stationary[]</label>&nbsp;
								</td>
								<td>
								<input type="checkbox" name="stationaries" value="Visiting Cards[]" <?php echo $row['stationaries']=='Visiting Cards[]'?' checked="checked" ':''; ?>/>&nbsp;
									<label>Visiting Cards[]</label>&nbsp;
								</td>
								<td>
								<input type="checkbox" name="stationaries" value="Keys[]" <?php echo $row['stationaries']=='Keys[]'?' checked="checked" ':''; ?>/>&nbsp;
									<label>Keys[]</label>&nbsp;
								</td>
								<td>
								<input type="checkbox" name="stationaries" value="Files[]" <?php echo $row['stationaries']=='Files[]'?' checked="checked" ':''; ?>/>&nbsp;
									<label>Files[]</label>&nbsp;
								</td></tr>
<tr>
<td>System Or LapTop:</td>
<td>
								<input type="checkbox" name="system_or_laptop" value="System[]" <?php echo $row['system_or_laptop']=='System[]'?' checked="checked" ':''; ?>/>&nbsp;
									<label>System[]</label>&nbsp;
								</td>
								<td>
								<input type="checkbox" name="system_or_laptop" value="LapTop[]" <?php echo $row['system_or_laptop']=='LapTop[]'?' checked="checked" ':''; ?>/>&nbsp;
									<label>LapTop[]</label>&nbsp;
								</td>

</tr>
<tr>
<td>ID Card:</td>
<td colspan="2">
<input type="text" class="form-control" id="id_card" name="id_card" value="<?php echo $row['id_card'];?>"></td>
</td>
</tr><tr>
<td>CUG:</td>
<td colspan="2">
<input type="text" class="form-control" id="cug" name="cug" value="<?php echo $row['cug'];?>"></td>
</td>
</tr>
<tr>
<td>Access Card:</td>
<td colspan="2">
<input type="text" class="form-control" id="access_card" name="access_card" value="<?php echo $row['access_card'];?>"></td>
</td>
</tr>
<tr>
<td>ERP Access:</td>
<td colspan="2">
<input type="text" class="form-control" id="erp_access" name="erp_access" value="<?php echo $row['erp_access'];?>"></td>
</td>
</tr>
<tr>
<td>Mail ID:</td>
<td colspan="2">
<input type="text" class="form-control" id="mail_id" name="mail_id" value="<?php echo $row['mail_id'];?>"></td>
</td>
</tr>
</table>

<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
</div>
</div>
<script>
		function back()
    {
   /*  $.ajax({
    type:"POST",
    url:"/KerliERP/Recruitment/staff_asset/staff_asset.php",
    success:function(data){
    $("#main_content).html(data);
    }
    }) */
	
	staff_asset()
  }
  </script>
<script>
   
		 $(document).ready(function(){  
		
		$("form[name='fupname']").on("submit", function(ev) {
		 ev.preventDefault();
var formData = new FormData(this);	  
           $.ajax({  
                url:'Recruitment/staff_asset/update_staff_asset.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
    processData: false,
                success:function(data)  
                {  
                     alert("Entry Successfull");
		staff_asset()
                }  
           });  
      });  
	   });
</script>