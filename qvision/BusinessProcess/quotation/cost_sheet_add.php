<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
$user=$_SESSION['userid'];
$candidateid=$_SESSION['candidateid'];
$enquiry_id=$_REQUEST['id'];
$page_id = $_REQUEST['page_id']; //Cost_sheet_add from two page(customer List(enquiry.php), cost sheet(cost_sheet_list.php)) so fix back button based on the menu by using page_id ///// if page_id= 0 back to customer List else page_id= 1 back to cost sheet.
$stmt = $con->query("SELECT employee as acc_manager,Product,Call_type,it_name,employee,Client_id,id as enquiry_id 
					   ,Company_name as comapny_name FROM enquiry WHERE id='$enquiry_id'");
					   
		//echo "SELECT employee as acc_manager,Product,Client_id,id as enquiry_id 
					   //,Company_name as comapny_name FROM enquiry WHERE id='$enquiry_id'";			
$row = $stmt->fetch();

 $enq= $row['enquiry_id'];


  $Acc_managerid=$row ['acc_manager'];
 $client_name = $row['comapny_name'];
$product=$row['Product'];
$Call_type=$row['Call_type'];

?>

<style>
.form-control{
-webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 0%);
}
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
}
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
              <div class="card-header" style="background:#ff8b3d !important;">
                
				              <center><h3 class="card-title" style="color:white !important;"><font size="5">COST SHEET ENTRY DETAILS</font></h3></center>
<?php if($page_id == "0" ){ ?>
		<a onclick="costsheet_add()" style="float: right;color:hwhite !important;" data-toggle="modal" class="btn btn-dark"></i>BACK</a>
<?php }elseif($page_id == "1"){ ?>
	 <a onclick="costsheet_add()" style="float: right;color:hwhite !important;" data-toggle="modal" class="btn btn-dark"></i>BACK</a>
<?php } ?>
              </div>
              </div>
			  
			  
			  
 <form id="fupForm" name="fupForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="card-body">
	      <div class="form-group row">
		    <div class="col-sm-3"><b>Product/Service </b>
			     <input type="hidden" class="form-control" id="enquiry_idflow" name="enquiry_idflow" value="<?php echo $enq; ?>" >
                 <?php
				 if($product==1)
				 {
					 $name='Product';
				 }
			 else if($product==2)
			 {
				 $name="Service";
			 }
		 else if($product==3)
			 {
				 $name="Product&Service";
			 }
			 ?>				
				<select name="pro_ser_id" class="form-control" style="width: 94%;" id="pro_ser_id" onchange="typeofproduct(<?php echo $product;?>)" >
				<option value="nd">--Select Option--</option>
				<option value="<?php echo $name; ?>"><?php echo $name;?></option>
				
				</select>
				 
			     <!--<input type="text" class="form-control" id="pro_ser_id" name="pro_ser_id" value="< ?php echo $pro_ser_type; ?>- < ?php echo $row['name'];?>" readonly>-->
			     <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value="<?php echo $row['Product']; ?>" readonly>
				 <input type="hidden" class="form-control" id="mappings_id" name="mappings_id" value="1" readonly>
			     <input type="hidden" class="form-control" id="manager_id" name="manager_id" value="<?php echo $Acc_managerid; ?>" readonly>
			</div>
			<div class="col-sm-2 " style="max-width: 16%;margin-left: 0px;"><b>Call Type</b>
			<select class="form-control" id="Call_type" name="Call_type" disabled>
		
		<?php $stmt = $con->query("SELECT * FROM calls_master where id='$Call_type'");
		while ($rowx = $stmt->fetch()) {?>
		<option value="<?php echo $rowx['name']; ?>"> <?php echo $rowx['name']; ?> </option>
		<?php } ?>
		</select>
			</div>
			<div class="col-sm-2" style="max-width: 11%;"><b>Client Name</b>

<input type="text" class="form-control" style="margin-left: 8px;" id="org_name" value="<?php echo $row['it_name']; ?>" name="org_name" readonly>
					
			</div>
			<div class="col-sm-3" style="max-width: 20%;margin-left: 20px;"><b>Contact Person Name</b>
				<!--<select class="form-control" id="client_id" name="client_id" readonly required>-->
					
					<?php 
					//$querys = $con->prepare("SELECT *,c.id as id FROM new_client_master c join new_plant_master p on org_name=client_org_name where org_name ='$client_name'");
					//$querys->execute(); 
		                  // $con_row = $querys->fetch();
						  $id=$row['employee'];
						  $fetchname=$con->query("SELECT * FROM `candidate_form_details` WHERE id='$id'");
		  //echo "SELECT * FROM `candidate_form_details` WHERE id='$empid'";
		  $fetchemname=$fetchname->fetch(PDO::FETCH_ASSOC);



				   //echo $fetchemname['first_name'];
						?>
					<input type="text" class="form-control" id="client_ids" value="<?php echo $fetchemname['first_name']; ?>" name="client_ids" readonly>
					<input type="hidden" class="form-control" id="client_id" value="<?php echo $row['Client_id']; ?>" name="client_id" readonly>

			</div>
			<div class="col-sm-2" style="max-width: 234%;"><b>Quote Currency Type</b>
				<select class="form-control" style="width: 111%;" id="quote_type" name="quote_type" required> <!--onchange="showDiv(this)"-->
					<option value=""> --- Choose Currency---</option>
					<option value="1">INR</option>
					<option value="2">$</option>
				</select>
			</div>
		
		  </div>
		  </div>

                   
			<div id="productdivv">
					 <input type="button" class="delete-row btn btn-danger" value="Delete" style="float:right;" onclick="deleteRow('new_tab')"/>&nbsp;&nbsp;&nbsp;&nbsp;
	                 <input type="button" class="add-row btn btn-success" value="Add " onclick="appendfun()" style="float:right;"><br/><br/>
 <div class="card-body">
 <table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:380%" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
	 <!--table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:100%"-->
	 	<tbody id="cost_sheett">
			
		  <tr>
		  <th style="width: 2%;">
			    <input type="checkbox" name="select-all" id="select-all" onclick="toggle(this); required" >
		      </th>
		     
		       <th style=" WIDTH: 6%;">PRODUCT NAME</th>
		       <th style=" WIDTH: 6%;">PRODUCT ID</th>
			   <th style=" WIDTH: 3%;">DESCRIPTION</th>
		       <th style=" WIDTH: 3%;">QTY</th>
		       
		       <!--th style=" WIDTH: 6%;">UNIT</th-->
		       <th style=" WIDTH: 4%;">UNIT RATE</th>
		       <Th style=" WIDTH: 5%;" formula="cost*qty" summary="sum" >Purchase Amount</th>
			   <th colspan='2'  style=" WIDTH: 9%;">Dist Margin %</th>
			   <th colspan='2' style=" WIDTH: 8%;">Overall Margin</th>
			   <th  style=" WIDTH: 5%;">Selling Price</th>
			    
		       <th colspan='2' style=" WIDTH: 9%;">Logistics %</th>
		      <th colspan='2'  style=" WIDTH: 9%;">Service Cost %</th>
			  <th style="WIDTH:4%;">Total Amount</th>
		      <th colspan='2'  style=" WIDTH: 8%;">GST Cost %</th>
		      <th colspan='2'  style=" WIDTH: 7%;">IGST Cost %</th>
		       <th style="WIDTH:4%;">Total Amount With GST</th>
		       
			   <th style="WIDTH:4%;" >Choose Vendor</th>
		       <th style="WIDTH:85%;">Upload</th>  
		 </tr>
         <tr>
		     <td>
			     <input type="checkbox" name="chk[]">
		     </td>
			 <td>
			<select class="form-control" onchange="prodcutname(this.value); desname(1, this.value); hsncode(1, this.value)" id="product_name1" name="product_name[]">
        <option value="" disabled selected>Select Product Name</option>
        <?php 
        $query = $con->query("SELECT id, name, hsn_code FROM product_master");
        while ($row_fetch = $query->fetch()) {?>
            <option value="<?php echo $row_fetch['name'] . '-' . $row_fetch['id']; ?>"><?php echo $row_fetch['name']; ?></option>
        <?php } ?>
    </select>
	<input type="hidden" name="hsn_code[]" id="hsn_code1" >
					
				 </td>
		     <td>	
 <select name="product_id[]" id="product_id1" class="form-control">
					
					 </select>			 
				 </td>
				 <td>
					 <select name="description[]" id="description1" style="height: 200px; width:300px;white-space: normal;" class="form-control">
						
					 </select>
				 </td>
		     <td>
			     <input type="text" id="qty1" name="qty[]" style="width:77%" onchange="totalIt()" class="form-control" ></td>
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
		         <INPUT type="text" id="igst_per1" name="igst_per[]" style="width:100%" class="form-control"  onchange="grandtotal();totalIt();" placeholder="%" required>
		     </td>		  
		     <td>
		         <INPUT type="text" id="igst_amt1" name="igst_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly required>
		     </td>				 
		     <td>
		         <INPUT type="text" id="tot_item1" name="tot_item[]" style="width:106%" class="form-control"  placeholder="0.00" readonly>
		     </td>
			  <td align="left">
		     <b><select class="form-control" id="vendor_name1" name="vendor_name[]" style="width:76%;" required>
    <option disabled selected>-- Select vendor --</option>
	
				
				 <?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor");
				while ($row = $stmt->fetch()) {?>
				 <option value="<?php  echo $row['id'];?>"> <?php echo $row['vendor_name']; ?> </option>
			<?php } ?>
		</select> 

		  </td>
			  <td style="width:69%;">
		         <INPUT type="file" id="image1" name="image[]" class="form-control">
		     </td>
			 
	      </tr>	
		  </tbody>
      </table> 
	  </div>
      <table id="dataTable4" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	      <tr>
		     <td colspan="3" align="center"><b>Profit Percentage%</b></td>
		 
		     <td align="right">
		         <INPUT type="text" id="mar_pper" name="mar_pper" class="form-control" style="width:58% !important;" readonly>
		    </td>
			<td colspan="3" align="center"><b>Profit Amount</b></td>
		 
		     <td align="right">
		         <INPUT type="text" id="mar_aamt" name="mar_aamt" class="form-control" style="width:58% !important;" placeholder="0.00" readonly>
		    </td>
		  </tr>
		  <tr>
		     <td colspan="5" align="center"><b>Total Amount</b></td>
		 
		     <td colspan="3" align="right">
		         <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" readonly>
		    </td>
		  </tr>

		 <tr>
		     <td colspan="5" align="center"><b>Grand Total</b></td>
		     <td colspan="3" align="right">
		         <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" readonly>
		     </td>
		 </tr>

	 </table>
	 
	</div>
	 
	 <table id="dataTable2" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	          <tr>
                   <td><b>Cost Date</b></td>
                   <td colspan="5"><input type="date" style="float:left; width: 50%" class="form-control"  name="chost_date" id="chost_date" required></td>
		
             </tr>
	                   <?php
					    /*echo "select a.*,b.*,c.*,c.user_name as email_m,f.position as desig,f.phone as ccontact from staff_master a left join designation_master b on (b.id = a.design_id) left join z_user_master c on (c.candidate_id=a.id) left join candidate_form_details f on (a.candid_id=f.id) where a.id = '$Acc_managerid'";*/
					   
					   
	                      $stmt = $con->prepare("select a.*,b.*,c.*,c.user_name as email_m,f.position as desig,f.phone as ccontact from staff_master a left join designation_master b on (b.id = a.design_id) left join z_user_master c on (c.candidate_id=a.id) left join candidate_form_details f on (a.candid_id=f.id) where f.id = '$Acc_managerid' ");
						 /* echo "select a.*,b.*,c.*,c.user_name as email_m,f.position as desig,f.phone as ccontact from staff_master a left join designation_master b on (b.id = a.design_id) left join z_user_master c on (c.candidate_id=a.id) left join candidate_form_details f on (a.candid_id=f.id) where f.id = '$Acc_managerid' ";*/
						 

		                   $stmt->execute(); 
		                   $row_fetch = $stmt->fetch();
	                   ?>

	          <tr>
		           <td><b> Employee Name </b></td>
		           <td colspan="5"><?php

                     $fetchname=$con->query("SELECT * FROM `candidate_form_details` WHERE id='$candidateid'");
		  //echo "SELECT * FROM `candidate_form_details` WHERE id='$empid'";
		  $fetchemname=$fetchname->fetch(PDO::FETCH_ASSOC);



				   echo $fetchemname['first_name']; ?> </td>
		     </tr>
	          <tr> 
		           <td><b>Designation </b></td>
		           <td colspan="5"><?php echo $fetchemname['final_designation']; ?></td>
		     </tr>
		      <tr> 
		           <td><b> Mobile No </b></td>
		           <td colspan="5"> <?php echo $fetchemname['phone']; ?></td>
		     </tr>
		      <tr> 
		           <td><b> Email Id </b></td>
		           <td colspan="5"><?php echo $fetchemname['mail']; ?>
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
         <td colspan="4"><textarea name="payment" class="form-control" rows="2" cols="150">100% IN ADVANCE ALONG WITH FORMAL PURCHASE ORDER.PAYMENTS SHOULD BE MADE EITHER BY CHEQUE, DD, RTGS AND NEFT IN FAVOUR OF QUADSEL SYSTEMS PVT LTD, PAYABLE AT CHENNAI. CASH PAYMENTS WILL BE NULL & VOID</textarea></td>
		 
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
         <td colspan="4"><textarea name="important"  class="form-control" rows="2" cols="150">YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD, No.118, MANIKKAM LANE, ANNASALAI, GUINDY, CHENNAI - 600032.</textarea></td>
		 
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
	
 <script>
 function return_back()
 {
	 {
		$.ajax({
		type:"POST",
		url:"qvision/CRM/enquiry.php",
		success:function(data){
		$("#main_content").html(data);
		}
		})
	}
	
 }
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

function backToCostsheet()
{
	Cost_sheet();	
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
	
}
</script>

<!--<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>-->

<script>
// For Adding and Deleting New Row start -----------------------------------------------------------
function appendfun()
    {  

	var lenz=$('#new_tab tr').length;
    len=lenz+0; 
	
	
	$('#new_tab').append('<tr><td><input type="checkbox" name="chk[]"></td><td><input type="text" class="form-control" onchange="prodcutname('+len+',this.value);desname('+len+',this.value);hsncode('+len+',this.value)"  list="clientz_name" autocomplete="off" id="product_name'+len+'" name="product_name[]" placeholder="select Prodcut Name"><datalist id="clientz_name'+len+'"><?php $query = $con->query("SELECT name,hsn_code FROM product_master");while ($row_fetch = $query->fetch()) { ?><option value="<?php echo $row_fetch['name']; ?>"><?php echo $row_fetch['name']; ?></option><?php } ?></datalist><input type="hidden" name="hsn_code[]" id="hsn_code'+len+'" ></td><td><select name="product_id[]" id="product_id'+len+'" class="form-control"></select></td><td><select name="description[]" id="description'+len+'" style="height:200px;width:300px;white-space:normal;"class="form-control"></select></td><td><input type="text" id="qty'+len+'" name="qty[]" style="width:77%" onchange="totalIt()" class="form-control" ></td><td><input type="text" id="cost'+len+'" name="cost[]" style="width:100%" onchange="totalIt()" class="form-control" ></td><td><input type="text" id="price'+len+'" name="price[]"  style="width:100%" onchange="totalIt()" readonly value="0.00" class="form-control"></td><td><INPUT type="text" id="dist_per'+len+'" name="dist_per[]" style="width:100%" class="form-control dist_per"  onchange="totalIt()" placeholder="%"></td><td><INPUT type="text" id="dist_amt'+len+'" name="dist_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><INPUT type="text" id="com_per'+len+'" name="com_per[]" style="width:100%" class="form-control com_per"  onchange="totalIt()" placeholder="%"></td><td><INPUT type="text" id="com_amt'+len+'" name="com_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><INPUT type="text" id="sel_amt'+len+'" name="sel_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><input type="text" id="log_per'+len+'"  name="log_per[]" style="width:100%" class="form-control log_per " onchange="totalIt()" placeholder="%" ></td><td><input type="text" id="log_amt'+len+'" name="log_amt[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><INPUT type="text" id="eng_per'+len+'" name="eng_per[]" style="width:100%" class="form-control eng_per"  onchange="totalIt()" placeholder="%"></td><td><INPUT type="text" id="eng_amt'+len+'" name="eng_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly></td><td><INPUT type="text" id="col_item'+len+'" name="col_item[]" style="width:100%" class="form-control"  placeholder="0.00" readonly></td><td><select class="form-control" id="gst_per'+len+'" name="gst_per[]" onchange="grandtotal();totalIt();" style="float:left; width: 80%" required><option value="">----- Choose GST % -----</option><option value="3">3 %</option><option value="5">5 %</option><option value="12">12 %</option><option value="18">18 %</option><option value="28">28 %</option></select></td><td><INPUT type="text" id="gst_amt'+len+'" name="gst_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly></td><td><INPUT type="text" id="igst_per'+len+'" name="igst_per[]" style="width:100%" class="form-control"  onchange="grandtotal();totalIt();" placeholder="%" required></td><td><INPUT type="text" id="igst_amt'+len+'" name="igst_amt[]" style="width:100%" class="form-control " placeholder="0.00" readonly required></td><td><INPUT type="text" id="tot_item'+len+'" name="tot_item[]" style="width:106%" class="form-control"  placeholder="0.00" readonly></td><td align="left"><b><select class="form-control" id="vendor_name'+len+'" name="vendor_name[]" style="width:76%;" required><option disabled selected>-- Select vendor --</option><?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor");while ($row = $stmt->fetch()) { ?><option value="<?php  echo $row['id'];?>"> <?php echo $row['vendor_name']; ?> </option><?php } ?></select></td><td style="width:69%;"><INPUT type="file" id="image'+len+'" name="image[]" class="form-control"></td></tr>'); } 
</script>
<script>


	</script>
	<script>
		 $(document).ready(function(){  
		 
		$("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
		 
		 
		/* var igst_per = document.getElementById("igst_per1").value;


//alert(services)
if(igst_per==""){
	alert("Please Enter igst Value")
	return false;
}*/
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
				  Cost_sheet_revise();
                }  
           });  
      });  
	   }); 
</script>
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

<!-------Calculation Part JAVASCRIPT------->
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
	
	
	var log_amt = parseFloat(document.getElementById("price" + idx).value)* parseFloat(document.getElementById("log_per"+ idx).value)/100;
	document.getElementById("log_amt" + idx).value = isNaN(log_amt) ? "0.00" : log_amt.toFixed(2);

	var eng_amt = parseFloat(document.getElementById("price" + idx).value)* parseFloat(document.getElementById("eng_per"+ idx).value)/100;
	document.getElementById("eng_amt" + idx).value = isNaN(eng_amt) ? "0.00" : eng_amt.toFixed(2);
	
	var gst_amt = parseFloat(document.getElementById("gst_amt" + idx).value)* parseFloat(document.getElementById("gst_per"+ idx).value)/100;
	document.getElementById("gst_amt" + idx).value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
	
	var igst_amt = parseFloat(document.getElementById("igst_amt" + idx).value)* parseFloat(document.getElementById("igst_per"+ idx).value)/100;
	document.getElementById("igst_amt" + idx).value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);
	
	
		 var pricez = parseFloat(document.getElementById("price" + idx).value) +
      parseFloat(document.getElementById("com_amt" + idx).value) + parseFloat(document.getElementById("dist_amt" + idx).value) ;
    //alert(idx+":"+price);  
    document.getElementById("sel_amt" + idx).value = isNaN(pricez) ? "0.00" : pricez.toFixed(2);
    
	
	
	    var tol_price = parseFloat(document.getElementById("price"+ idx).value);
	    var log_amt = parseFloat(document.getElementById("log_amt"+ idx).value);
		var eng_amt = parseFloat(document.getElementById("eng_amt"+ idx).value);
		var com_amt = parseFloat(document.getElementById("com_amt"+ idx).value);
		var dist_amt = parseFloat(document.getElementById("dist_amt"+ idx).value);
		var gst_amt = parseFloat(document.getElementById("gst_amt"+ idx).value);
		var igst_amt = parseFloat(document.getElementById("igst_amt"+ idx).value);
		var ss_amt = parseFloat(document.getElementById("sel_amt"+ idx).value);


		var items_total = tol_price+com_amt+log_amt+eng_amt+dist_amt;
		var ite = tol_price+ss_amt;
		//alert(ite)
		//alert(items_total);
	    //$('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));
		
		document.getElementById("col_item" + idx).value = isNaN(items_total) ? "0.00" : items_total.toFixed(2);

	
	
	 var sum = 0;
	var value = "";
    var names = document.getElementsByName('tot_item[]');
    var namep = document.getElementsByName('price[]');
    var namez = document.getElementsByName('sel_amt[]');
    var namex = document.getElementsByName('dist_amt[]');
	var namel = document.getElementsByName('eng_amt[]');
	var namey = document.getElementsByName('log_amt[]');
	var namem = document.getElementsByName('com_amt[]');
	   var sum = 0;
	   var sum1 = 0;
	   var sum2 = 0;
	   var sum3 = 0;
	   var sum4 = 0;
	   var sum5 = 0;
	   var sum6 = 0;
			
        for (var i = 0, iLen = names.length; i < iLen; i++) 
            {

              sum += +names[i].value;

			
			   document.getElementById("total_item").value = isNaN(sum) ? "0.00" : sum.toFixed(2);  

			 sum1 += +namep[i].value;
				//alert(sum1)
			 sum2 += +namez[i].value;
			 sum3 += +namex[i].value;
		     sum4 += +namel[i].value;
             sum6 += +namey[i].value;
             sum5 += +namem[i].value;   			 
//alert(sum2)

var margi=(sum5)/iLen;	

var margix = sum3 + sum5 ;

let profitVal =  margix;
//alert(margix)	
var profit=(profitVal/sum1);
//alert(profit)
	 var profits=(profit)*100;
	 
	 //alert(profits)
	 
	 var margi_per=margi/100;
	 document.getElementById("mar_aamt").value = isNaN(profitVal) ? "0.00" : profitVal.toFixed(2); 
	 document.getElementById("mar_pper").value = isNaN(profits) ? "0.00" : profits.toFixed(2); 
            }
          // alert(sum);
	
	
  }



  function totalIt() {
	 
    var qtys = document.getElementsByName("qty[]");
    var total = 0;
    for (var i = 1; i <= qtys.length; i++) {
      calc(i);
      var price = parseFloat(document.getElementById("price" + i).value);
      total += isNaN(price) ? 0 : price;
	  //alert(i)
	
   
	
	
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
	   
	   var we_amt = parseFloat(document.getElementById("price"+i).value) -
       parseFloat(document.getElementById("sel_amt"+i).value);
	   
	   
	  document.getElementById("tot_item"+i).value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2); 
	  
	  //document.getElementById("tot_item"+i).value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2); 
	  
	  
  }


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

    function typeofproduct(val){
		debugger;
        var product = val; // Corrected variable name from Product to product

        if(product == '2') {
            $.ajax({
                url: "qvision/CRM/find_services.php",
                type: "POST",
                data: {
                    Product: product // Corrected variable name from Product to product
                },
                cache: false,
                success: function(result) {
                    $("#productdivv").html(result);
                }
            });
        } else if(product == '3') {
            $.ajax({
                url: "qvision/CRM/find_productandservice.php",
                type: "POST",
                data: {
                    Product: product // Corrected variable name from Product to product
                },
                cache: false,
                success: function(result) {
                    $("#productdivv").html(result);
                }
            });
        }
		else if(product == '1')
		{
			$.ajax({
                url: "qvision/CRM/find_product.php",
                type: "POST",
                data: {
                    Product: product // Corrected variable name from Product to product
                },
                cache: false,
                success: function(result) {
                    $("#productdivv").html(result);
                }
            });
		}
    }




</script>
<script>
function prodcutname(c){

//alert(v)
$.ajax({
				  url: "qvision/BusinessProcess/quotation/quotation_productid.php?name="+c,
                   type: "GET",
					success: function(data){
                    var datas=data.split("||");
				
					var select = $('#product_id1');
					var select1 = $('#description1');
					  select.empty();
										  select1.empty();
							select.append($('<option value="' + datas[0] + '">' + datas[0] + '</option>'));
							select1.append($('<option value="' + datas[1] + '">' + datas[1] + '</option>'));
					}
					});

}

function hsncode(v,c){
//alert(v)
$.ajax({
				  url: "qvision/BusinessProcess/quotation/find_hsn.php?product="+c,
                   type: "GET",
					success: function(result){
						$("#hsn_code"+v).val(result);
					}
					});

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

