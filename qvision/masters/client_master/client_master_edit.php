<?php
require '../../../connect.php';
$id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.*,b.*,c.organization_type,d.dept_name,f.first_name FROM client_master a inner join company_master b on (a.company_id=b.id) inner join org_type_master c on(c.id=a.org_type) inner join z_department_master d on (d.id=a.department_id) inner join candidate_form_details f on (f.id=a.employee_id) where a.id='$id'");


$stmt->execute();  
$row = $stmt->fetch();
$sta = $row['status'];
$com_id = $row['company_id'];
$dept_id = $row['department_id'];
$emp_id = $row['employee_id'];
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Client DETAILS EDIT
<a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="HRMS/masters/client_master/client_master_update.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td><center><img src="../../Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
</tr>
<tr>
<td colspan="5">
<tr>
	<td>Company Name:</td>
	<input type="hidden" class="form-control" id="id" name="id" value="<?php echo  $id;?>"readonly>
	<td colspan="4">
	<select name="company_name" id="company_name" class="form-control">
	<option value="<?php echo $row['id'];?>"><?php echo $row['companyname'];?></option>
		<?php
		$sql=$con->query("SELECT * FROM company_master");
		$i=1;
		while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
		{
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['companyname'];?></option>
		  <?php
		}
		  ?>
	  </select>
	</td>
</tr>
</td>
</tr>

 <tr>
		<td>Department :</td>
		<td colspan="2">
		<select class="form-control" id="Department" name="Department" >
		<option value="<?php echo $row['id'];?>"><?php echo $row['dept_name'];?></option>
		
		<?php $stmt = $con->query("SELECT * FROM z_department_master ");
		while ($dept = $stmt->fetch()) {?>
		<option value="<?php echo $dept['id']; ?>"> <?php echo $dept['dept_name']; ?> </option>
		<?php } ?>
		</select></td>
        
		<td>Employee :</td>
		<td colspan="2">
		 <select class="form-control" name="employee" id="employee" required>
		 <option value="<?php echo $row['id'];?>"><?php echo $row['first_name'];?></option>
		 </select></td>
        </tr>


<tr>
   <td>Client Org Name:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_org_name" name="txt_org_name" value="<?php echo $row['org_name'];?>"></td>
   <td>Client Org Type:</td>
   <td colspan="2">
     <select name="client_type" id="client_type" class="form-control">
		<option value="<?php echo $row['id'];?>"><?php echo $row['organization_type'];?></option>
		<?php
		$sql=$con->query("SELECT * FROM org_type_master ");
		$i=1;
		while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
		{
		  ?>
		  <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['organization_type'];?></option>
		  <?php
		}
		  ?>
	  </select>
	</td>
</tr>
<tr>
   <td>Client Name:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_name" name="txt_client_name" value="<?php echo $row['client_name'];?>"></td>
   <td>Client Designation:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_client_desig" name="txt_client_desig" value="<?php echo $row['designation'];?>"></td>
</tr>
<tr> 
</tr>
<tr>

   <td>Mobile No1 : * </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile1" name="txt_mobile1" required value="<?php echo $row['mobile_no1'];?>"></td>
     <td>Mobile No2:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mobile2" name="txt_mobile2" value="<?php echo $row['mobile_no2'];?>"></td>
</tr>

<tr>
   <td>Land Line No :</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_landno" name="txt_landno" value="<?php echo $row['land_line_no'];?>"></td>
</tr>
<tr>
   <td>Email Id 1  : *</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id1" name="txt_mail_id1" required value="<?php echo $row['email_id1'];?>"></td>
    <td>Email Id 2:</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_mail_id2" name="txt_mail_id2" value="<?php echo $row['email_id2'];?>"></td>
</tr>

<tr>
   <td>Company Address</td>
   <td colspan="2"><input type="text" class="form-control " id="txt_address1" name="txt_address1" placeholder ="Enter Address 1" value="<?php echo $row['address1'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_address2" name="txt_address2" placeholder ="Enter Address 2" value="<?php echo $row['address1'];?>"></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control " id="txt_area" name="txt_area" placeholder ="Enter Area" value="<?php echo $row['area'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_town" name="txt_town" placeholder ="Enter Town / City" value="<?php echo $row['town_city'];?>"></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_pincode" name="txt_pincode" placeholder ="Enter Pincode" value="<?php echo $row['pincode'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_district" name="txt_district" placeholder ="Enter District" value="<?php echo $row['district'];?>"></td>
</tr>
<tr>
   <td></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_state" placeholder ="Enter State" value="<?php echo $row['state'];?>"></td>
   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_country" placeholder ="Enter Country" value="<?php echo $row['country'];?>"></td>
</tr>
<tr>
   <td>GST No</td>
   <td colspan="2"><input type="text" class="form-control" id="txt_gst_no" name="txt_gst_no" value="<?php echo $row['gst_no'];?>"></td>
<td>Status</td>
<td colspan="2">

<select class="form-control" name="status" id="status">
<?php

if($sta==0)
{
	?>
<option value="0">InActive</option>
<option value="1">Active</option>
<?php	
}
else{
	?>
	<option value="1">Active</option>
	<option value="0">InActive</option>
	<?php
}
?>

</select>
</td>
</tr>
<tr>
   <td>Website </td>
   <td colspan="2"><input type="text" class="form-control" id="txt_website" name="txt_website" value="<?php echo $row['website'];?>"></td>
   <td colspan="2"> </td>
</tr>
</table>

<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
</div>
</div>
<script>
function back_ctc()
{
  $.ajax({
    type:"POST",
    url:"qvision/masters/client_master/client_master.php",
    success:function(data){
      $("#main_content").html(data);
    }
  })
}
$(document).ready(function() {
	$('#Department').on('change', function() {
		var department_id = this.value;
		//alert(department_id);
		$.ajax({
		url: "qvision/masters/client_master/find_emp.php",
		type: "POST",
		data: {
		department_id: department_id
		},
		cache: false,
		success: function(result){
		$("#employee").html(result);
		}
		});
	});
});
</script>