<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];

?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
<div  class="card card-primary">
 <div class="card-header" style="background-color:#ff8b3d !important;">
            <h3 class="card-title"><font size="5">ADD DOLLER VENDOR</font></h3>
			<!--<a onclick="insert_vendor()" style="float: right;" data-toggle="modal" class="btn btn-primary">ADD</a>-->
			<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary">BACK</a>
	</div>
<div class="card-body">
<div class="tab-content">

    <div class="active tab-pane" id="for_employment">
    <form method="POST" enctype="multipart/form-data" autocomplete="off">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td colspan="6"><center><b>Add Vendor</b></center></td>
        </tr>
		
       
        <tr>
        <td>Vendor Name</td>
        <td colspan="2"><input type="text" class="form-control" placeholder="Enter Vendor Name" id="txt_vendor_name" name="txt_vendor_name"></td>
		
        <td colspan="2">
		    <select id="vendor_type" name="vendor_type" class="form-control"  placeholder="select vendor type" >
			<option value='0'>----- select quote type -------</option>
			<option value='1'>INR</option>
			<option value='2'>$</option>
		    </select>
		</td>
        </tr>

		<tr>
        <td>Vendor GSTIN/UN</td>
        <td colspan="2"><input type="text" class="form-control" placeholder="Enter Vendor GSTIN/UN" id="gst_number" name="gst_number"></td>
        
		<td colspan="2"><input type="text" class="form-control " id="phoneno" name="phoneno" placeholder ="Phone_No"></td>

	</tr>

      
	    <tr>
		   <td>Vendor Address</td>
		   <td colspan="2"><input type="text" class="form-control " id="txt_address1" name="txt_address1" placeholder ="Address 1"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_address2" name="txt_address2" placeholder ="Address 2"></td>
		</tr>
		<tr>
		   <td></td>
		   <td colspan="2"><input type="text" class="form-control " id="txt_area" name="txt_area" placeholder ="Area"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_town" name="txt_town" placeholder ="Town / City"></td>
		</tr>
		<tr>
		   <td></td>
		   
		   <td colspan="2"><input type="text" class="form-control" id="txt_district" name="txt_district" placeholder ="District"></td>
		    <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_state" placeholder ="State"></td>
		</tr>
		<tr>
		   <td></td>
		   
		   <td colspan="2"><input type="text" class="form-control" id="txt_country" name="txt_country" placeholder ="Country"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_pincode" name="txt_pincode" placeholder ="Pincode"></td>
		</tr>
       
		
		<tr>
		   <td>Bank Details</td>
		   <td colspan="2"><input type="text" class="form-control " id="txt_account_name" name="txt_account_name" placeholder ="Bank Account Name"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_account_no" name="txt_account_no" placeholder ="Bank Account No"></td>
		</tr>
		<tr>
		   <td></td>
		   <td colspan="2"><input type="text" class="form-control " id="txt_swift_code" name="txt_swift_code" placeholder ="Swift Code"></td>
		   <td colspan="2"><input type="text" class="form-control" id="txt_ifsc_code" name="txt_ifsc_code" placeholder ="IFSC Code"></td>
		</tr>
		<tr>
		   <td></td>
		   <td colspan="2"><input type="email" class="form-control" id="txt_mailid" name="txt_mailid" placeholder ="Mail Id"></td>
		    <td ><select class="form-control" name="status" id="status">
			<option value="">Select Status</option>
			<option value="1">Active</option>
			<option value="0">InActive</option>
			</select>
			</td>
		</tr>
		
		
		
        <td colspan="6"><input type="button" class="btn btn-success" name="save" onclick="insert_vendor()" value="save" style="float:right;"></td>
        </tr>
        </table>
        <!-- /.post -->
    </form>
    </div>

<script>
function insert_vendor()
	{
	var id=0;
	//alert(id);
	var data = $('form').serialize();
	//alert(data);
	$.ajax({
	type:'GET',
	data: data + "&" + "id="+id,
	url:"qvision/BusinessProcess/doller_vendor_master/vendor_submit.php",
	success:function(data)
	{      
		alert("Entry Successfully");
		vendor_master()
				  
	}       
	});
	}
	function back()

	{
		vendor_master()

	}
</script>