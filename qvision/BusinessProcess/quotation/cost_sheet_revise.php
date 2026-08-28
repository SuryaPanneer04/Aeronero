<?php
require '../../../connect.php';
include("../../../user.php");
$costsheet_id=$_REQUEST['id'];
$userrole = $_SESSION['userrole'];
$candidateid=$_SESSION['candidateid'];
$stmt = $con->prepare("SELECT a.id as costsheet_id,a.*,b.*,e.*,f.*,g.*,b.org_name as company_name from cost_sheet_entry a 
		 inner join new_client_master b on(b.id=a.client_id) 
		 inner join product_services f on (f.id = a.business_id)
		INNER JOIN staff_master e ON e.candid_id=a.candid_id 
		inner join z_user_master g ON (g.candidate_id = e.id)
		where a.id='$costsheet_id' and a.status ='1' ");
 //echo "SELECT a.list,a.Product,a.Client,a.id as enquiry_id ,b.id as business_id, b.mapping_id,b.name FROM Enquiry a join `product/services` b on (b.mapping_id = a.Product) WHERE a.id='$enquiry_id'";

$stmt->execute(); 
$row = $stmt->fetch();
 // echo $row['Product'];

if($row['business_id'] =='1'){
	  $pro_ser_type = "Product";
   }else if($row['business_id'] =='2'){
	  $pro_ser_type = "Service";
   }else if($row['business_id'] =='3'){
	  $pro_ser_type = "Solution";
   }
 
$name = $row['name'];
 
$client_id  = $row['company_name'];
$quote_type = $row['quote_type'];
$vendor_id  = $row['vendor_id'];
$design_id  = $row['design_id'];
$cost_sheet_no = $row['cost_sheet_no'];
$row['emp_name'];
?>
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
</style>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
<section class="wage_content">
<div  class="card card-primary">
              <div class="card-header">
                <h3 style="float: left;">COST SHEET ENTRY DETAILS</h3>
		 		  <!--<a onclick=" add_client()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> ADD</a>-->
		<a onclick=" back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
              </div>
           

<!--
<div class="card card-info">
    <div class="card-header">
	 <h2 class="card-title"><font size="4"><b>Cost Sheet Entry Details</b></font> </h2></div><br/>-->
	
     
	<form action="" method="post" enctype="multipart/form-data">
	  <div class="card-body">
	 	 <div class="form-group row">
		    <div class="col-sm-3">
			    <b>Product / Service / Solution </b>
			   <input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="<?php echo $row['enquiry_id']; ?>" readonly>
	           <input type="text" class="form-control" id="pro_ser_id" name="pro_ser_id" value="<?php echo $pro_ser_type; ?>- <?php echo $name;?>" readonly>
			   <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value="<?php echo $row['mapping_id']; ?>" readonly>
			</div>
			
			<!--<div class="col-sm-4"> 
			    <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value=" <?php echo $row['mapping_id']; ?>" readonly>
				<select class="form-control" id="company_id" name="company_id" required> 
					<option value="0"> --- Select Company Name ---</option>
					<?php $query = $con->query("SELECT * FROM company_master");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['companyname']; ?> </option>
					<?php } ?>
				</select>
			</div>-->
			<div class="col-sm-3"><b>Client Name</b>
				<select class="form-control" id="client_id" name="client_id" readonly="readonly"> <!--onchange="showDiv(this)"-->
					
					<?php $query = $con->query("SELECT * FROM new_client_master where org_name ='$client_id'");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['org_name']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-3"><b>Client Contact Person Name</b>
				<select class="form-control" id="client_id" name="client_id" readonly required> <!--onchange="showDiv(this)"-->
					
					<?php $query = $con->query("SELECT *,p.id as id FROM new_client_master c join new_plant_master p on org_name=client_org_name where org_name ='$client_id'");
					//echo "SELECT * FROM client_master where client_name ='$client_name'";
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['contact_person']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-3"><b>Quote Type</b>
				<select class="form-control" id="quote_type" name="quote_type" readonly="readonly"> <!--onchange="showDiv(this)"-->
					
					<?php if($quote_type =='1'){ ?>
					<option value="1">INR</option>
					<?php }else{ ?>
					<option value="2">$</option>
					<?php } ?>
				</select>
			</div>
		  </div>
     
	                     <input type="button" class="delete-row btn btn-danger" value="Delete" style="float:right;" onclick="deleteRow('new_tab')"/>&nbsp;&nbsp;&nbsp;&nbsp;
	                 <input type="button" class="add-row btn btn-success" value="Add " onclick="check()" style="float:right;"><br/><br/>
 <div class="card-body">
 <table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:200%" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
	 <!--table class="table table-striped table-bordered table-hover display nowrap"  id="new_tab" style="width:100%"-->
	 	<tbody id="cost_sheett">
			
		  <tr>
		  <th>
			    <input type="checkbox" name="select-all" id="select-all" onclick="toggle(this); required">
		      </th>
		  <th style=" WIDTH: 11%;">SPECIFICATION</th>
		       <th style=" WIDTH: 6%;">QTY</th>
		       <!--th style=" WIDTH: 6%;">UNIT</th-->
		       <th style=" WIDTH: 8%;">UNIT RATE</th>
		       <Th style=" WIDTH: 10%;" formula="cost*qty" summary="sum" >Amount</th>
		       <th colspan='2' style=" WIDTH: 11%;">Logistics %</th>
		      <th colspan='2'  style=" WIDTH: 11%;">Service Cost %</th>
		       <th colspan='2' style=" WIDTH: 11%;">Overall Margin</th>
		       <th>Total Amount</th>
			   <th>Choose Vendor</th>
		       <th>Upload</th>  
		</tr>
		<?php  
		 $query= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join new_client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc"); 
		    /*  echo "SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='0' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc"; */
			   $cnt=1; 
		 while($cost = $query->fetch(PDO::FETCH_ASSOC)){ 
		    
			 /* echo "hi";
			 echo "SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' and a.cost_sheet_no='$cost_sheet_no'"; */
				 
				//echo  $cnt;  	
            				
		?>
		<tr>
		  <td>
			<input type="checkbox" name="chk[]">
		  </td>
		  <td>
		     <INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $cost['cost_sheet_no']; ?>" readonly="readonly">
			<input type="text" id="item<?php echo $cnt; ?>" name="item[]" class="form-control" value="<?php echo $cost['specification']; ?>"></td>
		  <td>
			<input type="text" id="qty<?php echo $cnt; ?>" name="qty[]" onchange="totalIt()" class="form-control" value="<?php echo $cost['qty']; ?>"></td>
		  <!--td>
			<input type="text" id="unit<?php echo $cnt; ?>" name="unit[]" class="form-control" placeholder="eg.Nos,Box" value="<!?php echo $cost['unit']; ?>"></td-->
		  <td>
			<input type="text" id="cost<?php echo $cnt; ?>" name="cost[]" onchange="totalIt()" class="form-control" value="<?php echo $cost['unit_rate']; ?>"></td>
		  <td>
			<input type="text" id="price<?php echo $cnt; ?>" name="price[]" onchange="totalIt()" readonly="readonly" value="<?php echo $cost['total_price']; ?>" class="form-control">
		</td>
		<td>
			<input type="text" id="log_per<?php echo $cnt; ?>" name="log_per[]" class="form-control log_per " onchange="totalIt()" placeholder="%"  value="<?php echo $cost['log_per']; ?>">
		</td>
		<td>
			<input type="text" id="log_amt<?php echo $cnt; ?>" name="log_amt[]" class="form-control"  placeholder="0.00" readonly value="<?php echo $cost['log_amt']; ?>">
		</td>
		
		<td> 
		    <INPUT type="text" id="eng_per<?php echo $cnt; ?>" name="eng_per[]" class="form-control eng_per"  onchange="totalIt()" placeholder="%" value="<?php echo $cost['eng_per']; ?>">
		</td>
		  
		<td>
		   <INPUT type="text" id="eng_amt<?php echo $cnt; ?>" name="eng_amt[]" class="form-control " placeholder="0.00" readonly value="<?php echo $cost['eng_amt']; ?>">
		</td>
		  
		<td >
		    <INPUT type="text" id="com_per<?php echo $cnt; ?>" name="com_per[]" class="form-control com_per"  onchange="totalIt()" placeholder="%" value="<?php echo $cost['com_per']; ?>">
		</td>
		<td >
		   <INPUT type="text" id="com_amt<?php echo $cnt; ?>" name="com_amt[]" class="form-control"  placeholder="0.00" readonly value="<?php echo $cost['com_amt']; ?>">
		</td>
		
		<td >
		   <INPUT type="text" id="col_item<?php echo $cnt; ?>" name="col_item[]" class="form-control"  placeholder="0.00" readonly value="<?php echo $cost['total_amt']; ?>">
		</td>
		  <td align="left">
		     <b><select class="form-control" id="vendor_name1" name="vendor_name[]" style="width:100%;" required>
    <option disabled selected>-- Select vendor --</option>
	
				
				 <?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor where status='1'");
				while ($row2 = $stmt->fetch()) {?>
				 <option value="<?php  echo $row2['id'];?>"> <?php echo $row2['vendor_name']; ?> </option>
			<?php } ?>
		</select> 

		  </td>
			  <td>
		         <INPUT type="file" id="image1" name="image[]" class="form-control">
		     </td>
		</tr>
		 <?php $cnt++; } ?>
		</table>
		</div>
	    <!--<table id="dataTable" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
			<tr>
			  <th colspan="5">Total Amount</th>
			  <th><INPUT type="text" id="total_item" name="total_item" class="form-control" style ="font: -webkit-control;"placeholder="0.00"></th>
			 
			</tr>
			<tr>
			  <th colspan="4">Logistics</th>
			  <th><INPUT type="text" id="log_per" name="log_per" class="form-control log_per" style ="font: -webkit-control;" placeholder="Margin %" required></th>
			  <th><INPUT type="text" id="log_amt" name="log_amt" class="form-control" style ="font: -webkit-control;" placeholder="0.00" readonly></th>
			</tr>
			<tr>
			  <td>
				<INPUT type="checkbox" name="chk[]" >
			  </td>
			  <td>
				<INPUT type="text" id="item1" name="item[]" class="form-control"></td>
			  <td>
				<INPUT type="text" id="qty1" name="qty[]" onchange="totalIt()" class="form-control"> </td>
			  <td>
				<INPUT type="text" id="unit1" name="unit[]" class="form-control"> </td>
				
			  <td>
				<INPUT type="text" id="cost1" name="cost[]" onchange="totalIt()" class="form-control"> </td>
			  <td>
				<INPUT type="text" id="price1" name="price[]" onchange="totalIt()" readonly="readonly" value="0.00" class="form-control"> </td>
			  
			</tr>
		</table-->
		<?php  $query1= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join new_client_master b on(b.id=a.client_id) 
				 inner join staff_master e ON e.candid_id=a.candid_id
				 where a.status ='1' and a.cost_sheet_no='$cost_sheet_no' order by a.id desc"); 
				 $query1->execute(); 
                 $row1 = $query1->fetch();
				  $costsheet_date_str  = $row1['costsheet_date'];
				 $com_per  = $row1['com_per'];
                  $costsheet_date = date('d-m-Y', strtotime($costsheet_date_str));
				 ?>
	   <table id="dataTable4" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	    <tr>
		  <td colspan="6" align="center"><b>Total Amount</b></td>
		 
		  <td colspan="6" align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['net_amt']; ?>" readonly>
		  </td>
		</tr>
		<tr>
         <td colspan="3"><b><label>GST Percentage</label></b></td>
		  <td colspan="3"><b><label>
		 <select class="form-control" id="gst_per" name="gst_per" onchange="grandtotal()" style="float:left; width: 100%" required>
		    <option value="<?php echo $row1['gst_per']; ?>"><?php echo $row1['gst_per']; ?></option>
			<option value="">----- Choose GST % -----</option>
			<option value="18">18 %</option>
			<option value="28">28 %</option>
		</select>
		</td>
	    <td colspan="6" align="right">
		  <INPUT type="text" id="gst_val" name="gst_val" class="form-control" onchange="grandtotal()" style="width:40% !important;" placeholder="0.00" value="<?php echo $row1['gst_amt']; ?>" readonly>
	   </td>
       </tr>
	    <tr>
             <td  colspan="3"><b>IGST</b></td>
             <td colspan="3"><input type="number" style="float:left; width: 35%" class="form-control"  onchange="grandtotal()"  name="igst_per" id="igst_per" value="<?php echo $row1['igst_per']; ?>"></td>
		     <td align="right"colspan="6">
		         <INPUT type="text" id="igst_val" name="igst_val" class="form-control" style="width:40% !important;" value="<?php echo $row1['igst_amount']; ?>" readonly>
	         </td>
         </tr>
	   
	   <!--tr>
         <td colspan="3"><b><label>IGST Percentage</label></b></td>
		  <td colspan="3"><b><label>
		 <input type="text" style="float:left; width: 100%" class="form-control"  onchange="grandtotal()"  name="igst_per" id="igst_per" required placeholder="Enter IGST Percentage"></td>
		 <td  colspan="6" align="right">
		  <INPUT type="text" id="igst_val" name="igst_val" class="form-control" style="width:40% !important;" placeholder="0.00" readonly>
	      </td>
       </tr-->
		<tr>
		  <td colspan="6" align="center"><b>Grand Total</b></td>
		  <td colspan="6" align="right">
		    <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:40% !important;" placeholder="0.00" readonly value="<?php echo $row1['grand_amt']; ?>">
		  </td>
		</tr>
		
	  </table>
	  
	   <table  id="singlevendor_view" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	 <thead>
	 <th>Vendor Name</th>
	 <th>Document</th>
	 <!--th>Cost Price</th-->
	 </thead>
	 <?php 
	 $vsel=$con->query("select * from costsheet_vendor_entries c join doller_vendor_mastor v on c.vendor_id=v.id where c.costsheet_no='$cost_sheet_no'");
	 //echo "select * from costsheet_vendor_details c join doller_vendor_mastor v on c.vendor_id=v.id where c.costsheet_no='$cost_sheet_no'";
	 while($vdis=$vsel->fetch())
	 {
		 ?>
		 <tr>
		  
		  <td align="left"><b>
		    <?php echo $vdis['vendor_name'];?>
		  </td>
		  <td align="left"><b>
		   <a href="qvision/BusinessProcess/quotation/uploads/<?php echo $vdis['document'];?>" target="_blank"><?php echo $vdis['document'];?>
		  </td>
		  <!--td align="left"><b>
		    <!?php echo $vdis['cost_price']; ?>
		  </td-->
		</tr>
		 <?php 
	 }
	 
	 ?>
	  </table>
	   <!--table class="table table-bordered">
	  <tr >
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
				while ($row1 = $stmt->fetch()) {?>
				 <option value="<!?php  echo $row1['id'];?>"> <!?php echo $row1['vendor_name']; ?> </option>
			<!?php } ?>
		</select> 
		  </td>
		</tr>
		<tr>
		  <td colspan="5"><b>Cost Price Upload</b></td>
		  <td align="left">
		     <b><input type="file" name="file1[]" id="file1" /></b>
		  </td>
		</tr>
		<tr>
		  <td colspan="5"><b>Cost Price Amount</b></td>
		  <td align="left">
		     <b><input type="text" name="amount1[]" id="amount1" class="form-control" style="width:40%;"/>
		  </td>
		</tr>		
	 </table-->
	 
	 <table id="multiplevendor" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	 
	 </table>
	  
	<table  id="dataTable2" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered">
		
	   <tr>
         <td><b>Cost Date</b></td>
         <td colspan="4">
		 <input type="date" style="float:left; width: 50%" class="form-control"  name="rev_cost_date" id="rev_cost_date" value="<?php echo $costsheet_date; ?>" ></td>
		 
       </tr>
	   
	    <tr>
		   <td><b> Employee Name </b></td>
		   <td><b> <?php echo $row['emp_name'];?></b></td>
		   
		</tr>
		<?php $query1=  $con->prepare("select designation_name from designation_master where id ='$design_id'");
         	$query1->execute(); 
            $row1 = $query1->fetch();
            $designation_name = $row1 ? $row1['designation_name'] : ''; // Added safe check here
		?>
	    <tr> 
		   <td><b>Designation </b></td>
		   <td colspan="4"> <b><?php echo $designation_name; ?></td>
		</tr>
		<tr> 
		   <td><b> Mobile No </b></td>
		   <td colspan="4"><b><?php echo $row['mobile_no'];?></td>
		</tr>
		<tr> 
		   <td><b> Email Id </b></td>
		   <td colspan="4"> <b><?php echo $row['email_id'];?>
			  <input type="hidden" id="candid_id" value ="<?php echo $row['candid_id'];?>" readonly></td>
		</tr>
		
		
        </table>
		<br/>
		<br/>
	   <!--<div class="form-group row">
			<div class="col-sm-12"><p><b> For QUADSEL SYSTEMS PVT. LTD.,</b></p></div> 
			
	  </div>-->
	 <div class="form-group col-sm-12">
		<input type="button" style="float:right !important;" class="btn btn-success" id="save" name="save" onclick="costsheet_insert()"  value="Save">
	</div>
	</div>
	</form>	  
	<!-- Sub Total: <input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">-->
  </div>		
		<script>
$(document).ready(function() {
    $('#dataTable').DataTable( {
         "scrollY": 500,
        "scrollX": true
    } );
} );
</script>	
<script>
function back_ctc()
	{
		Cost_sheet_revise();
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
	
	
	$('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" name="chk[]" id="chk_'+len+'" value="'+len+'"></td><td><input type="text"  name="item[]" id="item'+len+'" class="form-control"></td><td><input type="text" id="qty'+len+'" name="qty[]" onchange="totalIt()" class="form-control"></td><td><input type="text" id="cost'+len+'" name="cost[]" onchange="totalIt()" class="form-control"></td><td> <input type="text" id="price'+len+'" name="price[]" onchange="totalIt()" readonly value="0.00" class="form-control"></td><td> <input type="text"  id="log_per'+len+'" name="log_per[]" class="form-control log_per" onchange="totalIt()" placeholder="%"></td><td><input type="text"  id="log_amt'+len+'" name="log_amt[]" class="form-control"  placeholder="0.00" readonly></td><td><INPUT type="text"  id="eng_per'+len+'" name="eng_per[]" class="form-control eng_per"  onchange="totalIt()" placeholder="%"></td><td> <INPUT type="text"  id="eng_amt'+len+'" name="eng_amt[]" class="form-control" placeholder="0.00" readonly></td><td><INPUT type="text" id="com_per'+len+'"  name="com_per[]" class="form-control com_per"  onchange="totalIt()" placeholder="%"></td><td><INPUT type="text" id="com_amt'+len+'"  name="com_amt[]" class="form-control"  placeholder="0.00" readonly></td><td><INPUT type="text" id="col_item'+len+'"  name="col_item[]" class="form-control"  placeholder="0.00" readonly></td><td align="left"><b><select class="form-control" id="vendor_name'+len+'" name="vendor_name[]" style="width:100%;" required><option disabled selected>-- Select vendor --</option><?php $stmt = $con->query("SELECT id,vendor_name FROM doller_vendor_mastor");while ($row = $stmt->fetch()) {?><option value="<?php  echo $row['id'];?>"> <?php echo $row['vendor_name']; ?> </option><?php } ?></select></td><td><INPUT type="file"  id="image'+len+'" name="image[]" class="form-control"></td></tr>'); }
	</script>
<script>
var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;

document.getElementById("rev_cost_date").value = today;

$("#quote_type").change(function(e){
	 var Quote_type       = $(this).val();
	 var product_service  = document.getElementById("mapping_id").value;
	$.ajax({
		type:'GET',
		data:'Quote_type='+Quote_type+'&product_service='+product_service,
		url:'qvision/BusinessProcess/quotation/getbank_details.php',
		dataType: 'json',
		success:function(data)
		{
		if(data != null){ //alert(data);
			$.each(data, function(index, element) {
				$('#vendor_id').val(element.id);
				$('#bank_name').val(element.account_name);
				$('#acc_no').val(element.account_no);
				$('#ifsc_code').val(element.ifsc_code);
			});
		}
		}
		
	})
	
});


function costsheet_insert()
{
	var field=1;
	var form = $('form')[0];
	var formData = new FormData(form);
	formData.set('field', field);
	formData.set('enquiry_id', document.getElementById("enquiry_id").value);
	formData.set('chost_date', document.getElementById("rev_cost_date").value);
	formData.set('quote_type', document.getElementById("quote_type").value);
	formData.set('mapping_id', document.getElementById("mapping_id").value);
	formData.set('candid_id', document.getElementById("candid_id").value);
	formData.set('client_id', document.getElementById("client_id").value);
	
    var safe_cost_sheet_no = document.getElementById("cost_sheet_no").value;
	formData.set('cost_sheet_no', safe_cost_sheet_no);
    
	$('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
    
	$.ajax({
		type:'POST',
		data: formData,
		processData: false,
		contentType: false,
		url:'qvision/BusinessProcess/quotation/costsheet_revise_insert.php',
		success:function(data)
		{ 
            // Only show success if PHP actually inserted the data
            if(data.trim() === "Success") {
			    revisecost_sheet_mail(safe_cost_sheet_no);
			    alert("Cost Sheet Updated Successfully");
		        Cost_sheet_revise();
            } else {
                // If SQL fails, show the exact error message from PHP
                alert("Database Error: " + data);
                $('.wage_content').html('<b style="color:red;">Error inserting data. Please check logic!</b>');
            }
		},
		error: function(xhr, status, error) {
			alert("AJAX Error: " + error + " / " + xhr.responseText);
			$('.wage_content').html('Error occurred.');
		}
	});
}

function revisecost_sheet_mail(cost_sheet_no)
{
	$.ajax({
	    type:"POST",
	    url:"qvision/BusinessProcess/quotation/revisecost_sheet_mail.php?cost_sheet_no="+cost_sheet_no,
	    success:function(data){
	        $("#main_content").html(data);
	    }
	})
}
	</script>
<script>
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
	alert(id);
    var data = $('form').serialize();
	// $('.wage_content').html('<br><div style="text-align: center;"><img src="qvision/images/images/load3.gif"></div>');
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
    //alert(idx+":"+price);  
    document.getElementById("price" + idx).value = isNaN(price) ? "0.00" : price.toFixed(2);
    //document.getElementById("total") = totalIt;
	
	
	var log_amt = parseFloat(document.getElementById("price" + idx).value)* parseFloat(document.getElementById("log_per"+ idx).value)/100;
	document.getElementById("log_amt" + idx).value = isNaN(log_amt) ? "0.00" : log_amt.toFixed(2);

	var eng_amt = parseFloat(document.getElementById("price" + idx).value)* parseFloat(document.getElementById("eng_per"+ idx).value)/100;
	document.getElementById("eng_amt" + idx).value = isNaN(eng_amt) ? "0.00" : eng_amt.toFixed(2);
	
    var com_amt = parseFloat(document.getElementById("price" + idx).value)* parseFloat(document.getElementById("com_per"+ idx).value)/100;
	document.getElementById("com_amt" + idx).value = isNaN(com_amt) ? "0.00" : com_amt.toFixed(2);
	
	
	    var tol_price = parseFloat(document.getElementById("price"+ idx).value);
	    var log_amt = parseFloat(document.getElementById("log_amt"+ idx).value);
		var eng_amt = parseFloat(document.getElementById("eng_amt"+ idx).value);
		var com_amt = parseFloat(document.getElementById("com_amt"+ idx).value);

		
		var items_total = tol_price+log_amt+eng_amt+com_amt;
		//alert(items_total);
	    //$('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));
		
		document.getElementById("col_item" + idx).value = isNaN(items_total) ? "0.00" : items_total.toFixed(2);
	
	
	 var sum = 0;
	var value = "";
    var names = document.getElementsByName('col_item[]');
	   var sum = 0;
        for (var i = 0, iLen = names.length; i < iLen; i++) 
            {
				
				//calc(i);
              sum += +names[i].value;
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
	  
    }
	
	var gst_amt = parseFloat(document.getElementById("total_item").value) *
       parseFloat(document.getElementById("gst_per").value)/100;	  
	  document.getElementById("gst_val").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
    ///document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);
	var igst_amt = parseFloat(document.getElementById("total_item").value) *
       parseFloat(document.getElementById("igst_per").value)/100;	  
	  document.getElementById("igst_val").value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);
    ///document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);
	
	
	
	var grand_amt = parseFloat(document.getElementById("total_item").value) +
       parseFloat(document.getElementById("gst_val").value) +  parseFloat(document.getElementById("igst_val").value);
	  document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);
	
  }
 function grandtotal() {
	
	   var gst_amt = parseFloat(document.getElementById("total_item").value) *
       parseFloat(document.getElementById("gst_per").value)/100;	   
	 
	  document.getElementById("gst_val").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
	  
	  var igst_amt = parseFloat(document.getElementById("total_item").value) *
       parseFloat(document.getElementById("igst_per").value)/100;
	   
	    document.getElementById("igst_val").value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);
	  
	  
	   var grand_amt = parseFloat(document.getElementById("total_item").value) +
       parseFloat(document.getElementById("igst_val").value) + parseFloat(document.getElementById("gst_val").value);
	  document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);
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
		//alert(total_amt);
		//alert(log_amt);
		//alert(eng_amt);
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

  var rowCount = 0;

  function addRow(tableID) {
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

   
 
  /*  var cell5 = row.insertCell(3);
    var element5 = document.createElement("input");
    element5.type = "text";
    element5.name = "unit[]";
	element5.class = "form-control";
	element5.classList.add("form-control");
    element5.id = "unit" + rowCount;
	
    cell5.appendChild(element5); */

   
   

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

  function deleteRow(tableID) {
    try {
		
      var table = document.getElementById(tableID);
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
	  document.getElementById("gst_val").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
	   var igst_amt = parseFloat(document.getElementById("total_item").value) *
       parseFloat(document.getElementById("igst_per").value)/100;	  
	  document.getElementById("igst_val").value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);
	  
	  
	  
	   var grand_amt = parseFloat(document.getElementById("total_item").value) +
       parseFloat(document.getElementById("gst_val").value) +  parseFloat(document.getElementById("igst_val").value)    ;
	  document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);
	  
    } 
	catch (e) {
      alert(e);
    }
	


	
	/* alert("hii");
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
	
	
	grandtotal();
totalIt(); */
	
  }

</script>
<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<script>
  $("input").blur(function() {
    if ($(this).attr("data-selected-all")) {
      //Remove atribute to allow select all again on focus        
      $(this).removeAttr("data-selected-all");
    }
  });
  
   $("input").click(function() {
    if (!$(this).attr("data-selected-all")) {
      try {
        $(this).selectionStart = 0;
        $(this).selectionEnd = $(this).value.length + 1;
        //add atribute allowing normal selecting post focus
        $(this).attr("data-selected-all", true);
      } catch (err) {
        $(this).select();
        //add atribute allowing normal selecting post focus
        $(this).attr("data-selected-all", true);
      }
    }
  });

  function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] != source)
        checkboxes[i].checked = source.checked;
    }
  }

</script> --->
<script>

<script type="text/javascript">
function showDiv(id){
	//alert()
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
