<?php
require '../config.php';
include("../user.php");
$userrole=$_SESSION['userrole'];

?>
  <div class="card card-info">
    <div class="card-header">
       <h3 class="card-title"><b>New Stock</b></h3>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>Back</a>
      </div>


<form method="POST" action="/KerliERP/AssetsQ/assets_form_submit.php" enctype="multipart/form-data">
<table class="table table-bordered">
        <tr>
        <td><center><img src="/KerliERP/Recruitment/image/userlog/quadsel.png"  style="width:100px;height:50px;"></center></td>
      <td colspan="5"><center><h2><b>New Stock</b></h2></center></td> 
        </tr>
     
		<tr>
        <td>Stock </td>
        <td colspan="5">
		<select class="form-control" id="asset" name="asset" onchange="sub_type(this.value)">
		<option value="">Choose Stock</option>
		<option value="Spare Asset">Spare Stock</option>
		<option value="New Products">New Products</option>
		
        </select> </td>  
		</tr>	
		
		<tr id="assets_type">
        <td>Stock Type</td>
        <td colspan="5">
		<select class="form-control" id="asset_type" name="asset_type" onchange="get_asset(this.value)">
		<option value="">Choose Stock Type</option>
		<option value="It Asset">It Stock</option>
		<option value="NonIt Asset">NonIt Stock </option>
        </select> 
		</td>		
		</tr>
		
    <tr id="inter_asset">
    </tr>
	
		<tr id="asset_nme">
        <td>Stock Name</td>
        <td colspan="5"><select class="form-control" id="asset_name" name="asset_name" onchange="get_asset_no(this.value)">
		<option value="">Choose Stock</option>
		<?php $stmt = $con->query("SELECT * FROM assets_master where type='It Asset'");
		while ($row = $stmt->fetch()) {?>
		<option value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?> </option>
		<?php } ?>
		</select></td>
        </tr>
		
        <tr>
       <td>Stock Number</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter your Asset Number" id="assets_no" name="assets_no" readonly></td>
        </tr>
       
        
         <tr>
        <td>Brand Name</td>
        <td colspan="5"><input type="text" class="form-control" placeholder="Enter Brand "  name="brand" id="brand"></td>
        </tr>
		<tr>
        <td>Vendor Name</td>
        <td colspan="5"><!--input type="text" class="form-control" placeholder="Vendor "  name="vendor" id="vendor"-->
		<select  class="form-control" placeholder="Vendor "  name="vendor" id="vendor">
		<?php 
		$ven=$con->query("select * from doller_vendor_mastor where status=1");
		while($venfet=$ven->fetch())		
		{
			?>
			<option value="<?php echo $venfet['id']; ?>"><?php echo $venfet['vendor_name']; ?></option>
			<?php 
		}
		?>
		</select>
		</td>
        </tr>
		
		<tr>
        <td>Purchase Date</td>
        <td colspan="5"><input type="date" class="form-control"  id="pdate" name="pdate" ></td>
        </tr>
		
		 <tr>
        <td>Serial Number</td>
        <td colspan="5">
			<input type="text"  id="serial" name="serial" class="form-control"  placeholder="Enter serial No">
		</td>
        </tr>
			<tr>
		<td>Configuraton:</td>
		<td colspan="5">
		<input type="text"  id="config" name="config" placeholder="Enter config" class="form-control"  >
		</td>
        </tr> 
		 <tr>
        <td>Warranty</td>
        <td colspan="5">
			<input type="date"  id="Warranty" name="Warranty" class="form-control"  placeholder="Enter Warranty ">
		</td>
        </tr>
		  <tr>
        <td>HSN Code</td>
        <td colspan="5">
			<input type="text"  id="hsn_code" name="hsn_code" class="form-control"  readonly>
		</td>
        </tr><tr>
        <td>GST Code</td>
        <td colspan="5">
			<input type="text"  id="gst_code" name="gst_code" class="form-control"  readonly>
		</td>
        </tr>
		
		 <tr>
        <td>Part Number</td>
        <td colspan="5">
			<input type="text"  id="part_no" name="part_no" class="form-control"  placeholder="">
		</td>
        </tr>
		 <!--tr>
        <td>Stock in hand</td>
        <td colspan="5">
			<input type="text"  id="in_hand" name="in_hand" class="form-control"  placeholder="">
		</td>
        </tr>
		
		  <tr>
        <td>Stock new</td>
        <td colspan="5">
			<input type="text"  id="new" name="new" class="form-control"  placeholder="">
		</td>
        </tr-->
		<tr>
        <td>Stock Value</td>
        <td colspan="5">
			<input type="text"  id="asset_value" name="asset_value" class="form-control"  placeholder="">
		</td>
        </tr>
		<tr>
        <td>Invoice Number</td>
        <td colspan="5">
			<input type="text"  id="invoice_no" name="invoice_no" class="form-control"  placeholder="">
		</td>
        </tr>
		<tr>
        <td>Location</td>
        <td colspan="5">
			<input type="text"  id="location" name="location" class="form-control"  placeholder="">
		</td>
        </tr>
		 <tr>
        <td>Invoice </td>
        <td colspan="5">
			<input type="file" class="form-control" id="file3" name="file3[]" />
		</td>
        </tr>
		 <tr>
        <td>Description </td>
        <td colspan="5">
			 <select class="form-control" name="des" id="des" required></select>	</td>
        </tr>
		<tr>
        <td colspan="6">
		<input type="submit" class="btn btn-success" name="save"  value="save"></td>
        </tr>
        </table>
</form>
</div>
<script>
		function back()
    {
  stock_form()
  }
  </script>
  <script>


$(document).ready(function() {

$('#asset_nme').hide();
$('#assets_type').hide();
});

function sub_type(v)
{
	var value=v;
	//alert(v);
	if(value=="Internal Asset")
	{
		$('#assets_type').show();
		$('#asset_nme').hide();		
		$('#inter_asset').show();
		//document.getElementById('assets_type').style.visibility = "visible";
       //document.getElementById('asset_nme').style.visibility = "hidden";
	}
	else if(value !=="Internal Asset")
	{
		$('#assets_type').hide();
		$('#asset_nme').show();
		$('#inter_asset').hide();
		//document.getElementById('assets_type').style.visibility = "hidden";		
       //document.getElementById('asset_nme').style.visibility = "visible";
	}
	
	/* else
	{
		document.getElementById('asset_nme').style.visibility = "visible";
document.getElementById('assets_type').style.visibility = "hidden";
	} */
}

function get_asset(v)
{
	$.ajax({
		
		type:"post",
		url:"/KerliERP/AssetsQ/get_assets.php?type="+v,
		success:function(data)
		{
			$('#inter_asset').html(data);
		}
	})
}

 function get_asset_no(v)
{
	var id=v;
	var asset=$('#asset').val();
	var asset_type=$('#asset_type').val();
	
	
	$.ajax({
		
		type:"post",
		url:"/KerliERP/AssetsQ/asset_number.php?id="+v+"&asset="+asset+"&asset_type="+asset_type,
		success:function(data)
		{
			$('#assets_no').val(data);
		}
	})
	$.ajax({
		
		type:"post",
		url:"/KerliERP/AssetsQ/get_hsn1.php?id="+v,
		success:function(data)
		{
			$('#hsn_code').val(data);
		}
	})
	$.ajax({
		
		type:"post",
		url:"/KerliERP/AssetsQ/get_gst.php?id="+v,
		success:function(data)
		{
			$('#gst_code').val(data);
		}
	})
	$.ajax({
url: "/KerliERP/AssetsQ/get_des.php",
type: "POST",
data: {
id: id
},
cache: false,
success: function(result){
$("#des").html(result);

}
})
	
/* function get_hsn1(v)
{
	var id=v;
	
	 var get_asset_name= document.getElementById('asset_name').value;
	
	$.ajax({
		
		type:"post",
		url:"/KerliERP/AssetsQ/get_gst.php?id="+v+"&get_asset_name="+get_asset_name,
		success:function(result)
		{
			
			$('#gst_code').html(result);
		}
	}) */
}


</script>
