<?php
require '../../../connect.php';
$costsheet_id = $_REQUEST['id'];

$po_query = $con->query("select a.id as pvm_id,c.vendor_name,a.so_number,b.id,b.cost_sheet_no
from purchase_vendor_master a 
left join cost_sheet_entry b on (a.cost_sheet_id=b.id) 
left join doller_vendor_mastor c on (a.vendor_id=c.id)
left join z_user_master d on (b.created_by = d.candidate_id)
LEFT JOIN staff_master e on (b.created_by = e.candid_id)
LEFT JOIN designation_master f on (e.design_id = f.id)
where a.status='4' && b.id ='$costsheet_id'   ");

$poVendorDetails  = $po_query->fetch();

$pvm_id           = $poVendorDetails['pvm_id'];
$vendorName       = $poVendorDetails['vendor_name'];
$so_number     = $poVendorDetails['so_number'];
$cost_sheet_no           = $poVendorDetails['cost_sheet_no']; 
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
	    <h3 class="card-title"> <b> Update EDD </b></h3>
		<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-danger"><i class="fa fa-minus"> </i>Back</a> <br>
     </div>

   <form method="POST" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
		
        <tr>
        <td> Costsheet Number </td>
        <td colspan="5"><input type="text" class="form-control" name="costsheetno" value="<?php echo $cost_sheet_no; ?>" readonly></td>
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
        <td> EDD </td>
        <td colspan="5"><input type="date" class="form-control" name="edd_date" id="edd_date" ></td>
        </tr>
						
     <tr>  
      <td colspan="6">
	   <input type="button" class="btn btn-success" name="save" onclick="edd_update(<?php echo $pvm_id; ?>)" style="float:right;" value="Update"> </td>
     </tr>

 </table>
        <!-- /.post -->
    </form>
    </div>

<script>

	function edd_update(id){
		let edd  = document.querySelector('#edd_date').value;		
		$.ajax({
		type:'GET',
	    data:"date=" + edd +"&id= " +id , 	
		url: "qvision/Purchase_process/vendor_po_generate/update_edd_date.php",
		success:function(data)
		{
			if(data == 1){
				alert("EDD Updated Successfully");
				vendor_po_generate()
			}
			else{
				alert("EDD Update Failed");
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