 <?php 
 require '../../connect.php';
include("../../user.php");

$type=$_REQUEST['cli_type'];
if($type==1)
{
	?>
	<td>Client *</td>
        <td colspan="3">
		 <input type="text" class="form-control"  list="client_name" autocomplete="off" id="Company_name" name="Company_name" placeholder="Enter Clients">
		 <datalist id="client_name">
        <?php 
		$query = $con->query("SELECT * FROM new_client_master where status=2 group by org_name");
		while ($row_fetch = $query->fetch()) {?>
		
		<option value="<?php echo $row_fetch['org_name']; ?>"> <?php echo $row_fetch['org_name']; ?> </option>
        <?php } ?>
    </datalist>
		</td>
        
		
		
<td>Location</td>
<td colspan="2"><select name="client_location" id="client_location" class="form-control">


</td>
		
	<?php 
}
else
{
	?>
	<td>Client *</td>
        <td colspan="5">
		 <input type="text" class="form-control"   autocomplete="off" id="Company_name" name="Company_name" placeholder="Enter Client">
		 
		</td>
        
		
	<?php 
}
 ?>
 
 
		<script>
		$('#Company_name').on('change', function() {

var Company_name = this.value;
 var Client_type=$('#Client_type').val();
alert(Company_name);
if(Client_type==1){
	 $.ajax({
		 type:"get",
		 url:"qvision/CRM/find_client_location.php?Company_name="+Company_name,
		 success:function(data)
		 {
			 $('#client_location').html(data);
		 }
	 })

}
});

		</script>
		<script>
$('#client_location').on('change', function() {

var Client_type=$('#Client_type').val();

if(Client_type==1)
{
var Company_name = $('#Company_name').val();
var client_location = this.value;
$.ajax({
	type:"get",
	url:"qvision/CRM/find_client.php",
	data:"org_name="+Company_name+"&client_location="+client_location,
	success:function(data)
	{
		//alert(data);
		var split=data.split("=");
		//alert(split[0]);
		//$('#Location').val(split[0]);
$('#Address').val(split[1]);
$('#Client').val(split[2]);
$('#Designation').val(split[3]);
$('#Number').val(split[4]);
$('#mail').val(split[5]);
//$('#Departments').val(split[6]);
//$('#employees').val(split[7]);
$('#Departments_id').val(split[6]);
$('#employees_id').val(split[7]);
$('#Location').val(split[8]);
$('#customer_id').val(split[9]);

$('#Address').attr('readonly', 'readonly');
$('#Client').attr('readonly', 'readonly');
$('#Designation').attr('readonly', 'readonly');
$('#Number').attr('readonly', 'readonly');
$('#mail').attr('readonly', 'readonly');
//$('#Departments').attr('readonly', 'readonly');
//$('#employees').attr('readonly', 'readonly');
$('#Departments_id').attr('readonly', 'readonly');
$('#employees_id').attr('readonly', 'readonly');
$('#Location').attr('readonly', 'readonly');
	}
})
};

});
</script>