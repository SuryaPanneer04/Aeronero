<?php
require '../../../connect.php';
include("../../../user.php");
$enquiry_id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT employee as acc_manager,Product,Client,id as enquiry_id 
					   ,Company_name as comapny_name FROM Enquiry WHERE id='$enquiry_id'");
					   
					   
					   /* echo "SELECT employee as acc_manager,Product,Client,id as enquiry_id 
					   ,Company_name as comapny_name FROM Enquiry WHERE id='$enquiry_id'";
					    */
					   
					   /* echo "SELECT a.employee as acc_manager,a.list,a.Product,a.Client,a.id as enquiry_id 
					   ,b.id as business_id, b.mapping_id,b.name,a.Company_name as comapny_name FROM Enquiry a join product_services b on (b.id = a.list) 
					   WHERE a.id='$enquiry_id'"; */
$stmt->execute(); 
$row = $stmt->fetch();

 $enq= $row['enquiry_id'];

/*  if($row['Product'] =='1'){
	$pro_ser_type = "Product";
 }else if($row['Product'] =='2'){
	$pro_ser_type = "Service";
 }else if($row['Product'] =='3'){
	$pro_ser_type = "Solution";
	
 } */
 //$pro_ser_type;
 
 //echo $row['list'];
// echo  $row['name'];
 
 /* if($row['list']==''){
    $name = $row['name'];
 }else{
	 $name =''; 
 } */
 $Acc_managerid=$row ['acc_manager'];
 $client_name = $row['comapny_name'];


?>
<style>

<style>
.form-control{
-webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 0%);
.table>tbody>tr>td{
    padding: 4px !important;
	vertical-align: middle;
}
.table {
        margin-bottom: 0px !important;
}
.table td, .table th {
	padding: .8rem !important;
}
.card-primary:not(.card-outline)>.card-header {
	background-color: #f1cc61 !important;
	
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-body{
	max-width: 100% !important;
    overflow-x: scroll !important;

}
sbar {
  column-gap: 40px;
}
</style>	    
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	
<section class="wage_content">
<div class="card card-primary">
              <div class="card-header">
                
				              <center><h3 class="card-title"><font size="5">COST SHEET ENTRY DETAILS</font></h3></center>
		<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-dark"></i>BACK</a>
              </div>
              </div>
			  
			  
			  
 <form id="fupForm" name="fupForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="card-body">
	      <div class="form-group row">
		    <div class="col-sm-2"><b>Product/Service/Solution </b>
			     <input type="hidden" class="form-control" id="enquiry_idflow" name="enquiry_idflow" value="<?php echo $enq; ?>" readonly>
				 <select name="pro_ser_id" class="form-control" id="pro_ser_id"  onchange="productstatus(this.value)" required="true">
				<option value="">Select</option>
				<option value="1">Product</option>
				<option value="2">Service</option>
				<option value="3">Solution</option>
				</select>
				 
			     <!--<input type="text" class="form-control" id="pro_ser_id" name="pro_ser_id" value="< ?php echo $pro_ser_type; ?>- < ?php echo $row['name'];?>" readonly>-->
			     <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value="<?php echo $row['mapping_id']; ?>" readonly>
				 <input type="hidden" class="form-control" id="mappings_id" name="mappings_id" value="1" readonly>
			     <input type="hidden" class="form-control" id="manager_id" name="manager_id" value="<?php echo $Acc_managerid; ?>" readonly>
			</div>
			<div class="col-sm-3 sbar"><b>Type</b>
			<select class="form-control" name="services" id="services"></select>
			</div>
			<div class="col-sm-2"><b>Client Name</b>
				<select class="form-control" id="org_name" name="org_name" readonly required> <!--onchange="showDiv(this)"-->
					
					<?php $query = $con->query("SELECT * FROM new_client_master where org_name ='$client_name'");
					//echo "SELECT * FROM client_master where client_name ='$client_name'";
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['org_name']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-3"><b>Contact Person Name</b>
				<select class="form-control" id="client_id" name="client_id" readonly required> <!--onchange="showDiv(this)"-->
					
					<?php $query = $con->query("SELECT *,c.id as id FROM new_client_master c join new_plant_master p on org_name=client_org_name where org_name ='$client_name'");
					//echo "SELECT * FROM client_master where client_name ='$client_name'";
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['contact_person']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-2"><b>Quote Currency Type</b>
				<select class="form-control" id="quote_type" name="quote_type" required> <!--onchange="showDiv(this)"-->
					<option value=""> --- Choose Currency---</option>
					<option value="1">INR</option>
					<option value="2">$</option>
				</select>
			</div>
		
		  </div>
		  </div>

                    <input type="button" class="delete-row btn btn-danger" value="Delete" style="float:right;" onclick="deleteRow('new_tab')"/>&nbsp;&nbsp;&nbsp;&nbsp;
	                 <input type="button" class="add-row btn btn-success" value="Add " onclick="check()" style="float:right;"><br/><br/>
 <div class="card-body">
 <table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:300%" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
	 <!--table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:100%"-->
	 	<tbody id="cost_sheett">
			
		  <tr>
		  <th style="width: 2%;">
			    <input type="checkbox" name="select-all" id="select-all" onclick="toggle(this); required" >
		      </th>
		     
		       <th style=" WIDTH: 6%;">PRODUCT ID</th>
		       <th style=" WIDTH: 6%;">PRODUCT NAME</th>
			   <th style=" WIDTH: 3%;">DESCRIPTION</th>
		       <th style=" WIDTH: 4%;">QTY</th>
		       
		       <!--th style=" WIDTH: 6%;">UNIT</th-->
		       <th style=" WIDTH: 4%;">UNIT RATE</th>
		       <Th style=" WIDTH: 5%;" formula="cost*qty" summary="sum" >Purchase Amount</th>
			   <th colspan='2'  style=" WIDTH: 9%;">Dist Margin %</th>
			   <th colspan='2' style=" WIDTH: 8%;">Overall Margin</th>
			   <th  style=" WIDTH: 5%;">Selling Price</th>
			    
		       <th colspan='2' style=" WIDTH: 9%;">Logistics %</th>
		      <th colspan='2'  style=" WIDTH: 9%;">Service Cost %</th>
			  <th style="WIDTH:7%;">Total Amount</th>
		      <th colspan='2'  style=" WIDTH: 9%;">GST Cost %</th>
		      <th colspan='2'  style=" WIDTH: 9%;">IGST Cost %</th>
		       <th style="WIDTH:7%;">Total Amount With GST</th>
		       
			   <th style="WIDTH:6%;" >Choose Vendor</th>
		       <th>Upload</th>  
		 </tr>
         <tr>
		     <td>
			     <input type="checkbox" name="chk[]">
		     </td>
			 <td>
					 <select name="product_id[]" id="product_id1" class="form-control">
					 <option disabled selected>-- Select Product ID--</option>
						<?php
								$stmt2 = $con->prepare("SELECT id,product_id FROM product_master");		
								$stmt2->execute(); 										
								while($row2 = $stmt2->fetch()){
						?>
					<option value="<?php echo $row2['product_id']; ?>"><?php echo $row2['product_id']; ?></option>
						<?php 
							}
						?>
					 </select>
				 </td>
		     <td>
					 <select name="product_name[]" id="product_name1" class="form-control">
					 <option disabled selected>-- Select One--</option>
						<?php
								$stmt3 = $con->prepare("SELECT name,hsn_code FROM product_master");		
								$stmt3->execute(); 	
								while($row3 = $stmt3->fetch()){
						?>
					<option value="<?php echo $row3['name']; ?>"><?php echo $row3['name']; ?>-<?php echo $row3['hsn_code']; ?></option>
						<?php 
							}
						?>
					 </select>
				 </td>
				 <td>
					 <select name="description[]" id="description1" style="height: 200px; width:300px;white-space: normal;" class="form-control">
					 <option disabled selected>-- Select Description--</option>
						<?php
								$stmt4 = $con->prepare("SELECT id,description FROM product_master");	
								$stmt4->execute(); 	
								while($row4 = $stmt4->fetch()){
						?>
					<option value="<?php echo $row4['description']; ?>"><?php echo $row4['description']; ?></option>
						<?php 
							}
						?>
					 </select>
				 </td>
		     <td>
			     <input type="text" id="qty1" name="qty[]" style="width:100%" onchange="totalIt()" class="form-control" ></td>
		     <!--td>
			     <input type="text" id="unit1" name="unit[]" style="width:100%" class="form-control" placeholder="eg.Nos,Box "></td-->
		     <td>
			     <input type="text" id="cost1" name="cost[]" style="width:100%" onchange="totalIt()" class="form-control" ></td>
		     <td>
			     <input type="text" id="price1" name="price[]"  style="width:100%" onchange="totalIt()" readonly value="0.00" class="form-control">
		     </td>
			 <td>
		         <INPUT type="text" id="dist_per1" name="dist_per[]" style="width:100%" class="form-control dist_per"  onchange="totalIt()" placeholder="%">
		     </td>
		     <td>
		         <INPUT type="text" id="dist_amt1" name="dist_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>
			  <td>
		         <INPUT type="text" id="com_per1" name="com_per[]" style="width:100%" class="form-control com_per"  onchange="totalIt()" placeholder="%">
		     </td>
		     <td>
		         <INPUT type="text" id="com_amt1" name="com_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>
		     <td>
			 <INPUT type="text" id="sel_amt1" name="sel_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>

		     <td>
			     <input type="text" id="log_per1"  name="log_per[]" style="width:100%" class="form-control log_per " onchange="totalIt()" placeholder="%" >
		     </td>
		     <td>
			     <input type="text" id="log_amt1" name="log_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>		
		     <td> 
		         <INPUT type="text" id="eng_per1" name="eng_per[]" style="width:100%" class="form-control eng_per"  onchange="totalIt()" placeholder="%">
		     </td>		  
		     <td>
		         <INPUT type="text" id="eng_amt1" name="eng_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly>
		     </td>	
			<td>
		         <INPUT type="text" id="col_item1" name="col_item[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>
             <td> 
		         <!--<INPUT type="text" id="gst_per1" name="gst_per[]" style="width:100%" class="form-control"  onchange="grandtotal()" placeholder="%">-->
				  <select class="form-control" id="gst_per1" name="gst_per[]" onchange="grandtotal();totalIt();" style="float:left; width: 80%" required>
			          <option value="">----- Choose GST % -----</option>
			          <option value="3">3 %</option>
			          <option value="5">5 %</option>
			          <option value="12">12 %</option>
			          <option value="18">18 %</option>
			          <option value="28">28 %</option>
		           </select>
		     </td>		  
		     <td>
		         <INPUT type="text" id="gst_amt1" name="gst_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly>
		     </td>	
			<td> 
		         <INPUT type="text" id="igst_per1" name="igst_per[]" style="width:100%" class="form-control"  onchange="grandtotal();totalIt();" placeholder="%">
		     </td>		  
		     <td>
		         <INPUT type="text" id="igst_amt1" name="igst_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly>
		     </td>				 
		     <td>
		         <INPUT type="text" id="tot_item1" name="tot_item[]" style="width:100%" class="form-control"  placeholder="0.00" readonly>
		     </td>
			  <td align="left">
		     <b><select class="form-control" id="vendor_name1" name="vendor_name[]" style="width:100%;" required>
    <option disabled selected>-- Select vendor --</option>
	
				
				 <?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor");
				while ($row = $stmt->fetch()) {?>
				 <option value="<?php  echo $row['id'];?>"> <?php echo $row['vendor_name']; ?> </option>
			<?php } ?>
		</select> 

		  </td>
			  <td>
		         <INPUT type="file" id="image1" name="image[]" class="form-control">
		     </td>
			 
	      </tr>	
		  </tbody>
      </table> 
	  </div>
      <table id="dataTable4" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	      <tr>
		     <td colspan="5" align="center"><b>Total Amount</b></td>
		 
		     <td align="right">
		         <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00">
		    </td>
		  </tr>
		  <tr>
             <td><b>GST Percentage</b></td>
             <td colspan="4">
		           <select class="form-control" id="gst_per" name="gst_per" onchange="grandtotal()" style="float:left; width: 50%" required>
			          <option value="">----- Choose GST % -----</option>
			          <option value="3">3 %</option>
			          <option value="5">5 %</option>
			          <option value="12">12 %</option>
			          <option value="18">18 %</option>
			          <option value="28">28 %</option>
		           </select>
		     </td>
	         <td align="right">
		          <INPUT type="text" id="gst_val" name="gst_val" class="form-control" onchange="grandtotal()" style="width:40% !important;" placeholder="0.00">
	         </td>
         </tr>
	     <tr>
             <td><b>IGST Percentage</b></td>
             <td colspan="4"><input type="number" style="float:left; width: 50%" class="form-control"  onchange="grandtotal()"  name="igst_per" id="igst_per" placeholder="Enter IGST Percentage" required></td>
		     <td align="right">
		         <INPUT type="text" id="igst_val" name="igst_val" class="form-control" style="width:40% !important;" placeholder="0.00">
	         </td>
         </tr>
		 <tr>
		     <td colspan="5" align="center"><b>Grand Total</b></td>
		     <td colspan="3" align="right">
		         <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" readonly>
		     </td>
		 </tr>
		 
		 <!--tr >
		 <td ><b>Vendor type</b></td>
		<td colspan="4"> <select class="form-control" id="vendor_type" name="vendor_type" required onchange="change_type(this.value)"> <!--onchange="showDiv(this)"-->
					<!--option value="1">Single</option>
					<option value="2">Multiple</option>
				</select></td>
		 </tr>
		 </table>
		 <table id="singlevendor" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
		  <tr>
		  <td colspan="5"><b>Vendor name *</b></td>
		  <td align="left">
		     <b><select class="form-control" id="vendor_name1" name="vendor_name1[]" style="width:40%;" required></b>
    <option disabled selected>-- Select vendor --</option>
	
				
				 <!?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor");
				while ($row = $stmt->fetch()) {?>
				 <option value="<!?php  echo $row['id'];?>"> <!?php echo $row['vendor_name']; ?> </option>
			<!?php } ?>
		</select> 
		  </td>
		</tr>
		<tr>
		  <td colspan="5"><b>Cost Price Upload</b></td>
		  <td align="left">
		     <b><input type="file" name="file1[]" id="file1" /></b>
		  </td>
		</tr-->
		<!--tr>
		  <td colspan="5"><b>Cost Price Amount</b></td>
		  <td align="left">
		     <b><input type="text" name="amount1[]" id="amount1" class="form-control" style="width:40%;"/>
		  </td>
		</tr-->		
	 </table>
	 
	 <table id="multiplevendor" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	 
	 </table>
	 
	 <table id="dataTable2" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	          <tr>
                   <td><b>Cost Date</b></td>
                   <td colspan="5"><input type="date" style="float:left; width: 50%" class="form-control"  name="chost_date" id="chost_date" required></td>
		 
             </tr>
	                   <?php
	                      $stmt = $con->prepare("select a.*,b.*,c.* from staff_master a left join designation_master b on 
		                  (b.id = a.design_id) left join z_user_master c on (c.candidate_id=a.id) where a.id = '$Acc_managerid' ");

		                   $stmt->execute(); 
		                   $row_fetch = $stmt->fetch();
	                   ?>

	          <tr>
		           <td><b> Employee Name </b></td>
		           <td colspan="5"><?php echo $row_fetch['emp_name']; ?> </td>
		     </tr>
	          <tr> 
		           <td><b>Designation </b></td>
		           <td colspan="5"><?php echo $row_fetch['designation_name']; ?></td>
		     </tr>
		      <tr> 
		           <td><b> Mobile No </b></td>
		           <td colspan="5"> <?php echo $row_fetch['mobile_no']; ?></td>
		     </tr>
		      <tr> 
		           <td><b> Email Id </b></td>
		           <td colspan="5"><?php echo $row_fetch['email_id']; ?>
		                  <input type="hidden" id="candid_id" readonly value='<?php echo $row_fetch['candid_id']; ?>'></td>
		     </tr>
		
		
     </table>
	 <br>
		<div style="text-align:center;font-weight:bold;"><b><u>TERMS AND CONDITION</u></b></div><br/>
		
		<table class="table table-bordered">
	   <tr>
         <td><b>VALIDITY :</b></td>
         <td colspan="4"><textarea name="validity" class="form-control" rows="2" cols="150">ONE WEEK FROM THE DATE OF QUOTE. PRICES PREVAILING AT THE TIME OF SUPPLY & BILLING WILL ONLY APPLY</textarea></td>
		 
       </tr><tr>
         <td><b>PAYMENT :</b></td>
         <td colspan="4"><textarea name="payment" class="form-control" rows="2" cols="150">100% IN ADVANCE ALONG WITH FORMAL PURCHASE ORDER.PAYMENTS SHOULD BE MADE EITHER BY CHEQUE, DD, RTGS AND NEFT IN FAVOUR OF SS INFORMATION SYSTEMS PVT LTD, PAYABLE AT CHENNAI. CASH PAYMENTS WILL BE NULL & VOID</textarea></td>
		 
       </tr>
	   <tr>
         <td><b>ACCOUNT HOLDER NAME :</b></td>
         <td colspan="4"><input type="text" style="float:left; width: 40%" name="acc_hold_name" id="acc_hold_name" class="form-control" readonly></td>
		 
       </tr>
	   <tr>
         <td><b>BANK NAME :</b></td>
         <td colspan="4"><input type="text" style="float:left; width: 40%" name="bank_name" id="bank_name" class="form-control" readonly></td>
		 
       </tr>
	   <tr>
         <td><b>BRANCH NAME :</b></td>
         <td colspan="4"><input type="text" style="float:left; width: 40%" name="branch_name" id="branch_name" class="form-control" readonly></td>
		 
       </tr>
	   <tr>
         <td><b>CURRENT A/C NO:</b></td>
         <td colspan="4"><input type="text" style="float:left; width: 40%" name="account_no" id="account_no"class="form-control" readonly></td>
		 
       </tr>
	   <tr>
         <td><b>IFSC CODE :</b></td>
         <td colspan="4"><input type="text" style="float:left; width: 40%" name="ifsc_code"  id="ifsc_code" class="form-control" readonly></td>
		 
       </tr>
	   <tr>
         <td><b>IMPORTANT :</b></td>
         <td colspan="4"><textarea name="important"  class="form-control" rows="2" cols="150">YOUR PO SHOULD BE IN FAVOUR OF <br/> SS INFORMATION SYSTEMS PVT LTD, No.1/102, First Floor, Periyar Pathai (West),100 Feet Road, Arumbakkam,Chennai-600 106. INDIA</textarea></td>
		 
       </tr>
	   <tr>
         <td><b>DELIVERY :</b></td>
         <td colspan="4"><textarea name="delivery" class="form-control" rows="2" cols="150">AS FOR THE OEM WITHIN 1 - 2 WEEKS , WITHIN 2 - 3 WEEKS , WITHIN 3 - 4 WEEKS, WITHIN 4 - 5 WEEKS  FROM THE DATE OF RECEIPT OF PAYMENT.SHIPPING COSTS WILL BE LEVIED IN FINAL INVOICE AS MAY BECOME APPLICABLE.</textarea></td>
		 
       </tr>
	   <tr>
         <td><b>WARRANTY :</b></td>
         <td colspan="4"><textarea name="warrenty" class="form-control" rows="2" cols="150">AS PER OEM.</textarea></td>
		 
       </tr>
	  	  
        </table>
        		
		                  <input type="submit" name="submit" class="btn btn-success submitBtn" value="SAVE">
  </form>	  
	<!-- Sub Total: <input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">-->
 
 
  
 
 
 <script>
$(document).ready(function() {
    $('#dataTable').DataTable( {
         "scrollY": 500,
        "scrollX": true
    } );
} );
</script>
<script>
function back()
{
enquiry();	
}

$(document).ready(function(){
	
	$('#multiplevendor').hide();
})

function change_type(v)
{
	
	var rowCount = $('#dataTable tr').length;
	//alert(rowCount);
 	if(v == 1)
	{
		$('#singlevendor').show();
		$('#multiplevendor').hide();
		//$("#single").load(location.href + " #single");
	}
	else
	{
	$.ajax({
		type:"get",
		url:"qvision/BusinessProcess/quotation/vendor_type_multiple.php?rowCount="+rowCount,
		success:function(data)
		{
			$('#multiplevendor').html(data);
			$('#multiplevendor').show();
			$("#singlevendor").hide();
		}
	})	
	}
	 
	
	/* if(v == 1)
	{
		$('#single').show();
		$('#multiple').hide();
	}
	else if(v == 2)
	{
		$('#single').hide();
		$('#multiple').show();
	}
	 */
}
</script>


<script type="text/javascript">
// For Adding and Deleting New Row start -----------------------------------------------------------
function check()
    {  
	var len=$('#new_tab tr').length;	
    len=len+0; 
	//alert(len);
	
	
	$('#new_tab').append('<tr><td><input type="checkbox" name="chk[]"></td><td><select name="product_id[]" id="product_id'+len+'" class="form-control"><option disabled selected>-- Select Product ID--</option><?php $stmt2 = $con->prepare("SELECT id,product_id FROM product_master");$stmt2->execute();while($row2 = $stmt2->fetch()){?><option value="<?php echo $row2['product_id']; ?>"><?php echo $row2['product_id']; ?></option><?php }?></select></td><td><select name="product_name[]" id="product_name'+len+'" class="form-control"><option disabled selected>-- Select One--</option><?php $stmt3 = $con->prepare("SELECT name,hsn_code FROM product_master");$stmt3->execute();while($row3 = $stmt3->fetch()){?><option value="<?php echo $row3['name']; ?>"><?php echo $row3['name']; ?>-<?php echo $row3['hsn_code']; ?></option><?php }?> </select></td><td> <select name="description[]" id="description'+len+'" style="height: 200px; width:300px;white-space: normal;" class="form-control"><option disabled selected>-- Select Description--</option><?php $stmt4 = $con->prepare("SELECT id,description FROM product_master");$stmt4->execute();while($row4 = $stmt4->fetch()){?><option value="<?php echo $row4['description']; ?>"><?php echo $row4['description']; ?></option><?php }?></select></td><td><input type="text" id="qty'+len+'" name="qty[]" style="width:100%" onchange="totalIt()" class="form-control" ></td><td><input type="text" id="cost'+len+'" name="cost[]" style="width:100%" onchange="totalIt()" class="form-control" ></td><td><input type="text" id="price'+len+'" name="price[]"  style="width:100%" onchange="totalIt()" readonly value="0.00" class="form-control"></td><td><INPUT type="text" id="dist_per'+len+'" name="dist_per[]" style="width:100%" class="form-control dist_per"  onchange="totalIt()" placeholder="%"></td><td><INPUT type="text" id="dist_amt'+len+'" name="dist_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><INPUT type="text" id="com_per'+len+'" name="com_per[]" style="width:100%" class="form-control com_per"  onchange="totalIt()" placeholder="%"></td><td><INPUT type="text" id="com_amt'+len+'" name="com_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><INPUT type="text" id="sel_amt'+len+'" name="sel_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><input type="text" id="log_per'+len+'"  name="log_per[]" style="width:100%" class="form-control log_per " onchange="totalIt()" placeholder="%" ></td><td><input type="text" id="log_amt'+len+'" name="log_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><INPUT type="text" id="eng_per'+len+'" name="eng_per[]" style="width:100%" class="form-control eng_per"  onchange="totalIt()" placeholder="%"></td><td><INPUT type="text" id="eng_amt'+len+'" name="eng_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly></td><td><INPUT type="text" id="col_item'+len+'" name="col_item[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><select class="form-control" id="gst_per'+len+'" name="gst_per[]" onchange="grandtotal();totalIt();" style="float:left; width: 80%" required><option value="">----- Choose GST % -----</option><option value="3">3 %</option><option value="5">5 %</option><option value="12">12 %</option><option value="18">18 %</option><option value="28">28 %</option></select></td><td><INPUT type="text" id="gst_amt'+len+'" name="gst_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly></td><td><INPUT type="text" id="igst_per'+len+'" name="igst_per[]" style="width:100%" class="form-control"  onchange="grandtotal();totalIt();" placeholder="%"></td><td><INPUT type="text" id="igst_amt'+len+'" name="igst_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly></td><td><INPUT type="text" id="tot_item'+len+'" name="tot_item[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td align="left"><b><select class="form-control" id="vendor_name'+len+'" name="vendor_name[]" style="width:100%;" required><option disabled selected>-- Select vendor --</option><?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor");while ($row = $stmt->fetch()) {?><option value="<?php  echo $row['id'];?>"> <?php echo $row['vendor_name']; ?> </option><?php } ?></select></td><td><INPUT type="file" id="image'+len+'" name="image[]" class="form-control"></td></tr>'); }
	</script>
	<script>
 
    // Find and remove selected table rows
    /* $(".delete-row").click(function()
    {
		alert("hii");
        var row_count         = $("#cost_sheett").find('input[name="chk[]"]').length;
        var checked_row_count = $('[name="chk[]"]:checked').length;
 
        if(row_count != checked_row_count)
        {
			alert("hii");
            $("#cost_sheett").find('input[name="chk[]"]').each(function()
            {
                if($(this).is(":checked"))
                {
                    $(this).parents("#cost_sheett tr").remove();
               

			   }
            });
        }
        else
        {
            alert("All rows can't be deleted");
            return false;
        } 
    }); */
	

</script>


		<script>
		 $(document).ready(function(){  
		$("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
		 
		 
		 var igst_per = document.getElementById("igst_per").value;


//alert(services)
if(igst_per==""){
	alert("Please Enter igst Value")
	return false;
}
var formData = new FormData(this);
$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');	  
           $.ajax({  
                url: 'qvision/BusinessProcess/quotation/costsheet_insert.php',
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
					//CS_generated_mail();
                    alert('Cost Sheet Added Successfully'); 
                  // $('#fupForm')[0].reset();  
				  enquiry();
                }  
           });  
      });  
	   }); 
</script>
<!--script>
	function CS_generated_mail(v)
	{
		 $.ajax({
			type: "POST",
            url:'qvision/businessprocess/costsheet_generated_mail.php?get_id='+v,
            success: function (data) {
                $("#main_content").html(data);
            }
        })
		
	}
	
	</script-->
<script>

$("#quote_type").change(function(e)
{
	 var Quote_type       = $(this).val();
	 var product_service  = document.getElementById("mappings_id").value;
	 //alert(product_service)
	$.ajax({
		type:'GET',
		data:'Quote_type='+Quote_type+'&product_service='+product_service,
		url:'qvision/BusinessProcess/quotation/getbank_details.php',
		dataType: 'json',
		success:function(data)
		{
			console.log(data);
		if(data != null){ 
			$.each(data, function(index, element) {
				$('#vendor_id').val(element.id);
				$('#bank_name').val(element.account_name);
				$('#account_no').val(element.account_no);
				$('#ifsc_code').val(element.ifsc_code);
				$('#branch_name').val(element.branch_name);
				$('#acc_hold_name').val(element.acc_holder_name);
			});
		}
		}
		
	})
	
});

</script>		
<script>
/* $(document).ready(function(e){
    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e){
		
		alert();
		
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/quotation/costsheet_insert.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(data){ //console.log(response);
			alert('hii");
                /* $('.statusMsg').html('');
                if(response.status == 1){
                    $('#fupForm')[0].reset();
                    $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
                }else{
                    $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
                }
                $('#fupForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled"); */
      /*       }
        });
    });
}); */ */
// File type validation
$("#file").change(function() {
    var file = this.files[0];
    var fileType = file.type;
    var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
    if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
        alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
        $("#file").val('');
        return false;
    }
});

var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;

document.getElementById("chost_date").value = today;



$("#emp_id").change(function(e){
	var value = $(this).val();
	//alert(value);
	//$('#designation').val('');
	$.ajax({
		
		type:"POST",
		url:"qvision/BusinessProcess/quotation/getemp_details.php?id=" +value, 
		dataType: 'json',
		success:function(data)
		{
		if(data != null){ //alert(data);
			$.each(data, function(index, element) {
				$('#designation').val(element.designation_name);
				$('#tel_no').val(element.mobile_no);
				$('#email_id').val(element.email_id);
			    $('#candid_id').val(element.candid_id);
			});
		}
		}
	})
	
});


	
		
 function change_status()
    {
    var id=$('#get_id').val();
	
    var data = $('form').serialize();
		$.ajax({
		type:'GET',
		data: data + "&" + "id="+id,
		url:'qvision/CRM/change_status.php',
		success:function(data)
		{
		  if(data==1)
		  { 
			alert('Not');
		  }
		  else
		  {
			alert("Update Successfully");
		 enquiry()
		  }
		  }           
		});
    }
	
	</script>

<!-------Calculation Part JAVASCRIPT--------->
<script>
  function calc(idx) {
    var price = parseFloat(document.getElementById("cost" + idx).value) *
      parseFloat(document.getElementById("qty" + idx).value);
    //alert(price);  
    document.getElementById("price" + idx).value = isNaN(price) ? "0.00" : price.toFixed(2);
    //document.getElementById("total") = totalIt;
	
	var com_amt = parseFloat(document.getElementById("price" + idx).value)* parseFloat(document.getElementById("com_per"+ idx).value)/100;
	document.getElementById("com_amt" + idx).value = isNaN(com_amt) ? "0.00" : com_amt.toFixed(2);
	
	var dist_amt = parseFloat(document.getElementById("price" + idx).value)* parseFloat(document.getElementById("dist_per"+ idx).value)/100;
	document.getElementById("dist_amt" + idx).value = isNaN(dist_amt) ? "0.00" : dist_amt.toFixed(2);
	
	
	 var pricees = parseFloat(document.getElementById("price" + idx).value) +
      parseFloat(document.getElementById("dist_amt" + idx).value);
	  //alert(pricees)
	  document.getElementById("sel_amt" + idx).value = isNaN(pricees) ? "0.00" : pricees.toFixed(2);
	  
	 var pricez = parseFloat(document.getElementById("price" + idx).value) +
      parseFloat(document.getElementById("com_amt" + idx).value) + parseFloat(document.getElementById("dist_amt" + idx).value);;
    //alert(idx+":"+price);  
    document.getElementById("sel_amt" + idx).value = isNaN(pricez) ? "0.00" : pricez.toFixed(2);
	
	
	var log_amt = parseFloat(document.getElementById("sel_amt" + idx).value)* parseFloat(document.getElementById("log_per"+ idx).value)/100;
	document.getElementById("log_amt" + idx).value = isNaN(log_amt) ? "0.00" : log_amt.toFixed(2);

	var eng_amt = parseFloat(document.getElementById("sel_amt" + idx).value)* parseFloat(document.getElementById("eng_per"+ idx).value)/100;
	document.getElementById("eng_amt" + idx).value = isNaN(eng_amt) ? "0.00" : eng_amt.toFixed(2);
	
	var gst_amt = parseFloat(document.getElementById("gst_amt" + idx).value)* parseFloat(document.getElementById("gst_per"+ idx).value)/100;
	document.getElementById("gst_amt" + idx).value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
	
	var igst_amt = parseFloat(document.getElementById("igst_amt" + idx).value)* parseFloat(document.getElementById("igst_per"+ idx).value)/100;
	document.getElementById("igst_amt" + idx).value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);
	
    
	
	
	    var tol_price = parseFloat(document.getElementById("price"+ idx).value);
	    var log_amt = parseFloat(document.getElementById("log_amt"+ idx).value);
		var eng_amt = parseFloat(document.getElementById("eng_amt"+ idx).value);
		var com_amt = parseFloat(document.getElementById("com_amt"+ idx).value);
		var dist_amt = parseFloat(document.getElementById("dist_amt"+ idx).value);
		var gst_amt = parseFloat(document.getElementById("gst_amt"+ idx).value);
		var igst_amt = parseFloat(document.getElementById("igst_amt"+ idx).value);

		
		var items_total = tol_price+log_amt+eng_amt+com_amt+dist_amt;
		alert(items_total)
		//alert(items_total);
	    //$('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));
		
		document.getElementById("col_item" + idx).value = isNaN(items_total) ? "0.00" : items_total.toFixed(2);
	
	
	 var sum = 0;
	var value = "";
    var names = document.getElementsByName('tot_item[]');


	   var sum = 0;
        for (var i = 0, iLen = names.length; i < iLen; i++) 
            {
				alert("anto")
				//calc(i);
              sum += +names[i].value;
			  alert(sum)
			   document.getElementById("total_item").value = isNaN(sum) ? "0.00" : sum.toFixed(2);  
			   //document.getElementById("col_item").value = isNaN(sum) ? "0.00" : sum.toFixed(2);  
            }
          // alert(sum);
	
	
  }

/* 
 function calcmar(idx) {
    var margin_amt = parseFloat(document.getElementById("total_item" + idx).value)* parseFloat(document.getElementById("log_per").value)/100;
    //alert(idx+":"+margin_amt);  
	alert(margin_amt)
	$('#log_amt').val(isNaN(margin_amt) ? "0.00" : margin_amt.toFixed(2));
   // document.getElementById("margin_amt" + idx).value = isNaN(margin_amt) ? "0.00" : margin_amt.toFixed(2);
    //document.getElementById("total") = totalIt;
	
  }
 */


  function totalIt() {
	  /*  var logistics = document.getElementById('logistics').value;
	   var engn = document.getElementById('eng').value;
	  
	   var margin_amt = document.getElementById('margin_amt').value;
	   var result = parseInt(sum);
	    var result2 = parseInt(logistics)+parseInt(engn)+parseInt(margin_amt);
		alert(result2)
	   
	    document.getElementById("totalPrice").value = isNaN(result) ? "0.00" : result.toFixed(2); */
	  
	  
    var qtys = document.getElementsByName("qty[]");
    var total = 0;
    for (var i = 1; i <= qtys.length; i++) {
      calc(i);
      var price = parseFloat(document.getElementById("price" + i).value);
      total += isNaN(price) ? 0 : price;
	  alert(i)
	
   
	
	
	//alert(sgst_amt)
	var gst_amt = parseFloat(document.getElementById("col_item"+i).value) *
       parseFloat(document.getElementById("gst_per" + i).value)/100;
	   
	  document.getElementById("gst_amt"+i).value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
    ///document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);
	var igst_amt = parseFloat(document.getElementById("col_item"+i).value) *
       parseFloat(document.getElementById("igst_per"+i).value)/100;	  
	  document.getElementById("igst_amt"+i).value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);
    ///document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);
	}
	
	
	var grand_amt = parseFloat(document.getElementById("total_item").value);
	  document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);
	  
	 /*  var grand_amt = parseFloat(document.getElementById("total_item").value) +
       parseFloat(document.getElementById("gst_amt").value) +  parseFloat(document.getElementById("igst_amt").value);
	  document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2); */
	  
	
  }
  function grandtotal() {
	
	  var qtys = document.getElementsByName("qty[]");
     var total = 0;
	
	


	var i=qtys.length;
 
	      var gst_amt = parseFloat(document.getElementById("col_item"+i).value) *
       parseFloat(document.getElementById("gst_per"+i).value)/100;	   

	 document.getElementById("gst_amt"+i).value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2); 
	
	 var igst_amt = parseFloat(document.getElementById("col_item"+i).value) *
       parseFloat(document.getElementById("igst_per"+i).value)/100;
	   
	   
	    document.getElementById("igst_amt"+i).value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);
	
	  
	   var grand_amt = parseFloat(document.getElementById("col_item"+i).value) +
       parseFloat(document.getElementById("igst_amt"+i).value) + parseFloat(document.getElementById("gst_amt"+i).value);
	   //alert(grand_amt)
	  document.getElementById("tot_item"+i).value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2); 
	  
	  //document.getElementById("tot_item"+i).value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2); 

  }




//sumof toatl value
// we used jQuery 'keyup' to trigger the computation as the user type
 /* $('.sumtotal').keyup(function () {
    var sum = 0;
	var value = "";
    var names = document.getElementsByName('price[]');
	   var sum = 0;
        for (var i = 0, iLen = names.length; i < iLen; i++) 
            {
              sum += +names[i].value;
            }
            //alert(sum);
	  
	   var logistics = document.getElementById('logistics').value;
	   var eng = document.getElementById('eng').value;
	   var margin_amt = document.getElementById('margin_amt').value;
	   var result = parseInt(sum)+parseInt(logistics) + parseInt(eng) + parseInt(margin_amt);
	   document.getElementById('totalPrice').value = result;
    
     
});  */



/* 
function calcmar(idx) {
    var margin = parseFloat(document.getElementById("price" + idx).value) +
      parseFloat(document.getElementById("margin_per" ).value)/100;
    alert(idx+":"+margin);  
	alert(margin);
    document.getElementById("margin_amt").value = isNaN(margin) ? "0.00" : margin.toFixed(2);
    //document.getElementById("total") = totalIt;
	// $('#margin_amt').val(margin);
  }


//margin amount
$('.mar_amt').keyup(function () {
    var values = 0;
    $('.mar_amt').each(function() {
		
        //sum += Number($(this).val());
		//var items_amt  = document.getElementById("price1").value;
		 // var values = parseFloat(document.getElementById("price" + idx).value);
      //parseFloat(document.getElementById("margin_per").value)/100;
      var tol_price = document.getElementsByName("price[]");
	  var tot_mar_amt = 0;
    for (var i = 1; i <= tol_price.length; i++) {
      calcmar(i);
      //var price = parseFloat(document.getElementById("price" + i).value);
      //tot_mar_amt += isNaN(price) ? 0 : price;
    }
    //document.getElementById("margin_amt").value = isNaN(tot_mar_amt) ? "0.00" : tot_mar_amt.toFixed(2);
	  
		
    });
     
   // $('#margin_amt').val(margin);
     
});
 */
$('.dist_per').keyup(function () {
var margin_amt = parseFloat(document.getElementById("total_item").value);
var margin_amts = parseFloat(document.getElementById("dist_per").value);

		var margin_amt = parseFloat(document.getElementById("total_item").value)* parseFloat(document.getElementById("dist_per").value)/100;
		//var margin_amt = parseFloat(document.getElementById("total_item").value);

		$('#dist_amt').val(isNaN(margin_amt) ? "0.00" : margin_amt.toFixed(2));
		 //cclculation _changes-items wise
		var total_amt = parseFloat(document.getElementById("total_item").value);
	    var log_amts = parseFloat(document.getElementById("dist_amt").value);
		var items_total = total_amt+log_amts;
	    $('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));
		
		});

$('.log_per').keyup(function () {
		
		var margin_amt = parseFloat(document.getElementById("total_item").value)* parseFloat(document.getElementById("log_per").value)/100;
		//var margin_amt = parseFloat(document.getElementById("total_item").value);
		//alert(margin_amt)
		//alert(idx+":"+margin_amt);  
		
		$('#log_amt').val(isNaN(margin_amt) ? "0.00" : margin_amt.toFixed(2));
		 //cclculation _changes-items wise
		var total_amt = parseFloat(document.getElementById("total_item").value);
	    var log_amt = parseFloat(document.getElementById("log_amt").value);
		
		//alert(total_amt);
		//alert(log_amt);
		var items_total = total_amt+log_amt;
		//alert(items_total);
	    $('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));
		
		}); 

$('.eng_per').keyup(function () {
	
	
	var margin_amt = parseFloat(document.getElementById("total_item").value)* parseFloat(document.getElementById("eng_per").value)/100;
	//var margin_amt = parseFloat(document.getElementById("total_item").value);
	//alert(margin_amt)
	//alert(idx+":"+margin_amt);  
	$('#eng_amt').val(isNaN(margin_amt) ? "0.00" : margin_amt.toFixed(2));
	
	   //cclculation _changes-items wise
	    var total_amt = parseFloat(document.getElementById("total_item").value);
	    var log_amt = parseFloat(document.getElementById("log_amt").value);
		var eng_amt = parseFloat(document.getElementById("eng_amt").value);
		/* var gst_amt = parseFloat(document.getElementById("total_item").value) *
       parseFloat(document.getElementById("gst_per").value)/100;	  
	  document.getElementById("gst_val").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
		 */
		//alert(total_amt);
		//alert(log_amt);
		alert("hiiii");
		var items_total = total_amt+log_amt+eng_amt;
		//alert(items_total);
	    $('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));
	   //cclculation _changes-items wise end
	
	
	var total_amt = parseFloat(document.getElementById("total_item").value);
	var log_amt = parseFloat(document.getElementById("log_amt").value);
	var eng_amt = parseFloat(document.getElementById("eng_amt").value);
	
	var log_eng_total = total_amt+log_amt+eng_amt;
	$('#log_eng_total').val(isNaN(log_eng_total) ? "0.00" : log_eng_total.toFixed(2));
	//$('#grand_total').val(isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2));
}); 
		
$('.com_per').keyup(function () {	

       var margin_amt = parseFloat(document.getElementById("total_item").value)* parseFloat(document.getElementById("com_per").value)/100;
       $('#com_amt').val(isNaN(margin_amt) ? "0.00" : margin_amt.toFixed(2));
		
		
		//cclculation _changes-items wise
	    var total_amt = parseFloat(document.getElementById("total_item").value);
	    var log_amt = parseFloat(document.getElementById("log_amt").value);
		var eng_amt = parseFloat(document.getElementById("eng_amt").value);
		var com_amt = parseFloat(document.getElementById("com_amt").value);
		
		var items_total = total_amt+log_amt+eng_amt+com_amt;
		//alert(items_total);
	    $('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));
	   //cclculation _changes-items wise end
		
		
		
	//var company_amt = parseFloat(document.getElementById("log_eng_total").value)* parseFloat(document.getElementById("com_per").value)/100;
	//$('#com_amt').val(isNaN(company_amt) ? "0.00" : company_amt.toFixed(2));
	var total_amt = parseFloat(document.getElementById("total_item").value);
	var com_amt = parseFloat(document.getElementById("com_amt").value);
	//var log_eng_total = parseFloat(document.getElementById("log_eng_total").value);
	var log_amt = parseFloat(document.getElementById("log_amt").value);
	var eng_amt = parseFloat(document.getElementById("eng_amt").value);
	
	
	var grand_amt = total_amt+com_amt+log_amt+eng_amt;
	$('#grand_total').val(isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2));
}); 

  window.onload = function() {
    document.getElementsByName("qty[]")[0].onkeyup = function() {
      calc(1)
    };
    document.getElementsByName("cost[]")[0].onkeyup = function() {
      calc(1)
    };

  }
//single vendor
  var rowCount = 0;

  function addRow(tableID) 
  {
    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "checkbox";
	//element1.source = "checked";
    element1.name = "chk[]";
	element1.class = "form-control";
	element1.classList.add("form-control");
    cell1.appendChild(element1); 



    var cell3 = row.insertCell(1);
    var element3 = document.createElement("input");
    element3.type = "text";
    element3.name = "item[]";
	element3.classList.add("form-control");
    element3.id = "item" + rowCount;
    cell3.appendChild(element3);
	
    var cell4 = row.insertCell(2);
    var element4 = document.createElement("input");
    element4.type = "text";
	element4.class = "form-control";
	element4.classList.add("form-control");
    element4.name = "qty[]";
    element4.id = "qty" + rowCount;
    element4.onchange = totalIt(rowCount);
	
    cell4.appendChild(element4);

   
/*  
   var cell5 = row.insertCell(3);
    var element5 = document.createElement("input");
    element5.type = "text";
    element5.name = "unit[]";
	element5.class = "form-control";
	element5.classList.add("form-control");
    element5.id = "unit" + rowCount;
	
    cell5.appendChild(element5);
 */
   
   

    var cell6 = row.insertCell(3);
    var element6 = document.createElement("input");
    element6.type = "text";
    element6.name = "cost[]";
    element6.id = "cost" + rowCount;
	element6.classList.add("form-control");
    element6.onkeyup = totalIt;
    cell6.appendChild(element6);

    var cell7 = row.insertCell(4);
    var element7 = document.createElement("input");
    element7.type = "text";
    element7.name = "price[]";
    element7.id = "price" + rowCount;
	element7.classList.add("form-control");
    element7.value = "0.00";
    $(element7).attr("readonly", "true");
    cell7.appendChild(element7);
	
	var cell8 = row.insertCell(5);
    var element8 = document.createElement("input");
    element8.type = "text";
    element8.name = "log_per[]";
    element8.id = "log_per" + rowCount;
	element8.classList.add("form-control");
    element8.onchange = totalIt;
    cell8.appendChild(element8);

    var cell9 = row.insertCell(6);
    var element9 = document.createElement("input");
    element9.type = "text";
    element9.name = "log_amt[]";
    element9.id = "log_amt" + rowCount;
	element9.classList.add("form-control");
    element9.value = "0.00";
    $(element9).attr("readonly", "true");
    cell9.appendChild(element9);
  
    var cell10 = row.insertCell(7);
    var element10 = document.createElement("input");
    element10.type = "text";
    element10.name = "eng_per[]";
    element10.id = "eng_per" + rowCount;
	element10.classList.add("form-control");
	 element10.onchange = totalIt;
    cell10.appendChild(element10);
	
	var cell11 = row.insertCell(8);
    var element11 = document.createElement("input");
    element11.type = "text";
    element11.name = "eng_amt[]";
    element11.id = "eng_amt" + rowCount;
	element11.classList.add("form-control");
	element11.value = "0.00";
    $(element11).attr("readonly", "true");
    cell11.appendChild(element11);
	
	
	 var cell12 = row.insertCell(9);
    var element12 = document.createElement("input");
    element12.type = "text";
    element12.name = "com_per[]";
    element12.id = "com_per" + rowCount;
	element12.classList.add("form-control");
	 element12.onchange = totalIt;
    cell12.appendChild(element12);
	
	var cell13 = row.insertCell(10);
    var element13 = document.createElement("input");
    element13.type = "text";
    element13.name = "com_amt[]";
    element13.id = "com_amt" + rowCount;
	element13.classList.add("form-control");
	element13.value = "0.00";
    $(element13).attr("readonly", "true");
    cell13.appendChild(element13);
	var cell14 = row.insertCell(11);
	
    var element14 = document.createElement("input");
    element14.type = "text";
    element14.name = "col_item[]";
    element14.id = "col_item" + rowCount;
	element14.classList.add("form-control");
	element14.value = "0.00";
    $(element14).attr("readonly", "true");
    cell14.appendChild(element14);



  }

  function deleteRow(new_tab) {
    try {
		
      var table = document.getElementById(new_tab);
      var rowCount = table.rows.length;
      var tabCount = table.rows.length;

      document.getElementById("select-all").checked = false;

      for (var i = 1; i < rowCount; i++) {
		 
        var row = table.rows[i];
        var chkbox = row.cells[0].childNodes[0];
        if (null != chkbox && true == chkbox.checked) {
          table.deleteRow(i);

         rowCount--;
          i--;
        }

      }
	  
	  //alert(tabCount);
	  var finalamount = 0;
		for (var j = 1; j < tabCount; j++) 
		{
			 var tota=$('#col_item' + j).val();
			 var tot1=parseFloat(tota);
		//alert(tot1);
			if(isNaN(tot1)) tot1=0.00;
			//alert('#col_item' + j);
			finalamount = finalamount +tot1;
			var finalamount1=parseFloat(finalamount).toFixed(2);  

		}  
	//alert(finalamount1); 
	$('#total_item').val(finalamount1);
	//gst and grad total calculation
	  var gst_amt = parseFloat(document.getElementById("total_item").value) *
       parseFloat(document.getElementById("gst_per").value)/100;	  
	  document.getElementById("gst_amt").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
	   var igst_amt = parseFloat(document.getElementById("total_item").value) *
       parseFloat(document.getElementById("igst_per").value)/100;	  
	  document.getElementById("igst_amt").value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);
	  
	  
	  
	   var grand_amt = parseFloat(document.getElementById("total_item").value) +
       parseFloat(document.getElementById("gst_amt").value) +  parseFloat(document.getElementById("igst_amt").value)    ;
	  document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);
	  
    } 
	catch (e) {
      alert(e);
    }

	
  }

</script>
<script>
$(document).ready(function() {
$('#pro_ser_id').on('change', function() {

var Product = this.value;
//alert(Product);
$.ajax({
url: "qvision/CRM/find_services.php",
type: "POST",
data: {
Product: Product
},
cache: false,
success: function(result){
$("#services").html(result);

}
});
});
});

function productstatus(value)
{
if(value=='3')
{
document.getElementById('services').style.visibility = "hidden";

}
else
{
document.getElementById('services').style.visibility = "visible";
}
}
</script>









<script type="text/javascript">
function showDiv(id){
	alert()
   if(id.value==2){
    document.getElementById('hidden_div2').style.display = "block";
	document.getElementById('hidden_div1').style.display = "none";
   } else{
    //document.getElementById('hidden_div1').style.display = "block";
	document.getElementById('hidden_div2').style.display = "none";
   }
} 
</script>
<style>
#hidden_div2 {
  display: none;
}
</style>
<script>
$("#gst").change(function(e){
	var value = $(this).val();
	alert(value);
	//$('#designation').val('');
	
	$.ajax({
		
		type:"POST",
		url:"qvision/BusinessProcess/quotation/getemp_details.php?id=" +value, 
		dataType: 'json',
		success:function(data)
		{
		if(data != null){ //alert(data);
			$.each(data, function(index, element) {
				$('#designation').val(element.position);
				$('#tel_no').val(element.mobile_num);
				$('#email_id').val(element.email_id);
			});
		}
		}
		
	})
	
});
</script>

