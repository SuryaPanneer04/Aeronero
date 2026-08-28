<?php
require '../../../connect.php';
$costsheet_id = $_REQUEST['id'];

$po_query = $con->query("select a.id as pvm_id,c.vendor_name,a.so_number,b.id,b.cost_sheet_no,b.client_id
from purchase_vendor_master a 
left join cost_sheet_entry b on (a.cost_sheet_id=b.id) 
left join doller_vendor_mastor c on (a.vendor_id=c.id)
left join z_user_master d on (b.created_by = d.candidate_id)
LEFT JOIN staff_master e on (b.created_by = e.candid_id)
LEFT JOIN designation_master f on (e.design_id = f.id)
where  b.id ='$costsheet_id' && a.status='2'  ");

$poVendorDetails  = $po_query->fetch();

$pvm_id           = $poVendorDetails['pvm_id'];
$vendorName       = $poVendorDetails['vendor_name'];
$so_number        = $poVendorDetails['so_number'];
$cost_sheet_no    = $poVendorDetails['cost_sheet_no']; 
$client_id        = $poVendorDetails['client_id']; 
?>
<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>
  <div class="card card-primary">
     <div class="card-header">
	    <h3 class="card-title"> <b> Shipping Address and Terms </b></h3>
		<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a> <br>
     </div>

   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
		
        <tr>
        <td> Costsheet Number </td>
        <td colspan="5">
			<input type="hidden" class="form-control" name="pvmid" value="<?php echo $pvm_id; ?>" readonly>
			<input type="text" class="form-control" name="costsheetno" value="<?php echo $cost_sheet_no; ?>" readonly>
		</td>
        </tr>
		
        <tr>
        <td>SO Number </td>
        <td colspan="5"><input type="text" class="form-control" name="so_num" value="<?php echo $so_number; ?>" readonly></td>
        </tr>
		
        <tr>
        <td> Vendor Name </td>
        <td colspan="5"><input type="text" class="form-control"  name="vendorName" value="<?php echo $vendorName; ?>" readonly></td>
        </tr>
		
		<tr>
        <td> Ship To </td>
        <td colspan="5">
			<select class="form-control" name="ship_to" onchange="shipaddress(this.value,<?php echo $client_id ; ?>)">
				<option>  -- Select -- </option>
				<option value="1"> SS </option>
				<option value="2">  Customer </option>
			</select>
		</td>
        </tr>

		<tr id="ship"></tr>
		<tr id="plant"></tr>

        <tr>
        <td> Mode/Terms of Payment </td>
        <td colspan="5">
			<!-- <select class="form-control" name="terms">
				<option>  -- Select -- </option>
				<option value="10 Days">  10 Days </option>
				<option value="20 Days">  20 Days </option>
				<option value="30 Days">  30 Days </option>
				<option value="40 Days">  40 Days </option>
				<option value="50 Days">  50 Days </option>
				<option value="60 Days">  60 Days </option>
			</select> -->
			<input type="text" class="form-control"  name="terms" >
		</td>
        </tr>

		<tr>
        <td> Other References </td>
        <td colspan="5">
			<input type="text" class="form-control"  name="other_reference" >
		</td>
        </tr>

		<tr>
        <td> Terms of delivery </td>
        <td colspan="5">
			<input type="text" class="form-control"  name="term_delivery" >
		</td>
        </tr>
						
     <tr>  
      <td colspan="6">
	   <input type="button" class="btn btn-success" name="save" onclick="shipto_update()" style="float:right;" value="Update"> </td>
     </tr>

 </table>
        <!-- /.post -->
    </form>
    </div>

<script>

	function shipaddress(v,c){
      
	if(v == 1){
		$('#plant').hide();
	}else{
		$('#plant').show();
	}
		$.ajax({
		type:'GET',
	    data:"shipTo=" + v +"&clientId= " + c , 	
		url: "qvision/Purchase_process/vendor_po_generate/shipAddress.php",
		success:function(data)
		{
		   $('#ship').html(data);
		}
		})

	}
	
	function plantAddress(v){

$.ajax({
type:'GET',
data:"plantid=" + v , 	
url: "qvision/Purchase_process/vendor_po_generate/plantAddress.php",
success:function(data)
{
   $('#plant').html(data);
}
})

}

	function shipto_update(){

		let data  = $('form').serialize();		
		$.ajax({
		type:'POST',
	    data: data, 	
		url: "qvision/Purchase_process/vendor_po_generate/update_ship.php",
		success:function(data)
		{
			if(data == 1){
				alert("Updated Successfully");
				vendor_po_generate()
			}
			else{
				alert("Update Failed");
      			vendor_po_generate()
			}
		}
		})
	} 

	function back()

	{
		vendor_po_generate()
	}
</script>