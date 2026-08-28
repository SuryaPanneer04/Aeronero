<?php
require '../../../connect.php';
include("../../../user.php");
$enquiry_id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.employee as acc_manager,a.list,a.Product,a.Client,a.id as enquiry_id ,b.id as business_id, b.mapping_id,b.name FROM Enquiry a join product_services b on (b.id = a.list) WHERE a.id='$enquiry_id'");
// echo "SELECT a.list,a.Product,a.Client,a.id as enquiry_id ,b.id as business_id, b.mapping_id,b.name FROM Enquiry a join product_services b on (b.mapping_id = a.Product) WHERE a.id='$enquiry_id'";

$stmt->execute(); 
$row = $stmt->fetch();
 // echo $row['Product'];
 if($row['Product'] =='1'){
	$pro_ser_type = "Product";
 }else if($row['Product'] =='2'){
	$pro_ser_type = "Service";
 }else if($row['Product'] =='3'){
	$pro_ser_type = "Solution";
 }
 
 if($row['list']!==''){
    $name = $row['name'];
	//echo $name;exit;
 }else{
	 $name ='';
 }
 echo $Acc_managerid=$row ['acc_manager'];
$client_name = $row['Client'];
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
	padding: .4rem !important;
}
</style>
<div class="card card-info">
    <div class="card-header">
	 <h2 class="card-title"><font size="4"><b>Cost Sheet Entry Details</b></font> </h2></div><br/>
	
     
	<form action="" method="post" enctype="multipart/form-data">
	  <div class="card-body">
	 <div class="form-group row">
		    <div class="col-sm-4">
			    <b>Product/Service/Solution </b>
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
			<div class="col-sm-4"><b>Client Name</b>
				<select class="form-control" id="client_id" name="client_id" readonly required> <!--onchange="showDiv(this)"-->
					
					<?php $query = $con->query("SELECT * FROM client_master where client_name ='$client_name'");
					//echo "SELECT * FROM client_master where client_name ='$client_name'";
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['client_name']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-4"><b>Quote Type</b>
				<select class="form-control" id="quote_type" name="quote_type" required> <!--onchange="showDiv(this)"-->
					<option value=""> --- Choose Quote Type ---</option>
					<option value="1">INR</option>
					<option value="2">$</option>
				</select>
			</div>
		  </div>
     
	  <input type="button" class="btn btn-danger" value="Delete" style="float:right;" onclick="deleteRow('dataTable')"/>&nbsp;&nbsp;&nbsp;&nbsp;
	   <input type="button" class="btn btn-success" value="Add " style="float:right;" onclick="addRow('dataTable')" ><br/><br/>
	  <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
		<tr>
		  <th>
			<input type="checkbox" name="select-all" id="select-all" onclick="toggle(this); required">
		  </th>
		  <th>SPECIFICATION</th>
		  <th>QTY</th>
		  <th>UNIT</th>
		  <th>UNIT RATE</th>
		  <Th formula="cost*qty" summary="sum">Amount</th>
		  <th colspan='2'>Logistic</th>
		  <th colspan='2'>Engineer</th>
		  <th colspan='2'>Margin</th>
		  <th>Total Items</th>
		</tr>
		<tr>
		  <td>
			<input type="checkbox" name="chk[]">
		  </td>
		  <td>
			<input type="text" id="item1" name="item[]" class="form-control"></td>
		  <td>
			<input type="text" id="qty1" name="qty[]" onchange="totalIt()" class="form-control"></td>
		  <td>
			<input type="text" id="unit1" name="unit[]" class="form-control" placeholder="eg.Nos,Box"></td>
		  <td>
			<input type="text" id="cost1" name="cost[]" onchange="totalIt()" class="form-control"></td>
		  <td>
			<input type="text" id="price1" name="price[]" onchange="totalIt()" readonly="readonly" value="0.00" class="form-control">
		</td>
		<td>
			<input type="text" id="log_per1" name="log_per[]" class="form-control log_per " onchange="totalIt()" placeholder="%">
		</td>
		<td>
			<input type="text" id="log_amt1" name="log_amt[]" class="form-control"  placeholder="0.00" readonly>
		</td>
		
		<td> 
		    <INPUT type="text" id="eng_per1" name="eng_per[]" class="form-control eng_per"  onchange="totalIt()" placeholder="%">
		</td>
		  
		<td>
		   <INPUT type="text" id="eng_amt1" name="eng_amt[]" class="form-control " placeholder="0.00" readonly>
		</td>
		  
		<td >
		    <INPUT type="text" id="com_per1" name="com_per[]" class="form-control com_per"  onchange="totalIt()" placeholder="%">
		</td>
		<td >
		   <INPUT type="text" id="com_amt1" name="com_amt[]" class="form-control"  placeholder="0.00" readonly>
		</td>
		
		<td >
		   <INPUT type="text" id="col_item1" name="col_item[]" class="form-control"  placeholder="0.00" readonly>
		</td>
		
		</tr>
		</table>
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
			  
			</tr>-->
		</table>
	   <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
	    <tr>
		  <td colspan="5" align="center"><b>Total Amount</b></td>
		 
		  <td align="right">
		    <INPUT type="text" id="total_item" name="total_item" class="form-control" style="width:40% !important;" placeholder="0.00">
		  </td>
		</tr>
		<tr>
         <td><b>Gst Percentage</b></td>
         <td colspan="4">
		 <select class="form-control" id="gst_per" name="gst_per" onchange="grandtotal()" style="float:left; width: 50%" required>
			<option value="">----- Choose GST % -----</option>
			<option value="18">18 %</option>
			<option value="28">28 %</option>
		</select>
		</td>
	    <td align="right">
		  <INPUT type="text" id="gst_val" name="gst_val" class="form-control" onchange="grandtotal()" style="width:40% !important;" placeholder="0.00">
	   </td>
       </tr>
	   <tr>
         <td><b>IGST</b></td>
         <td colspan="4"><input type="text" style="float:left; width: 50%" class="form-control"  onchange="grandtotal()"  name="igst_per" id="igst_per" required placeholder="Enter IGST Percentage"></td>
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
	  </table>
	  </table>
	 <table class="table table-bordered">
	   <tr>
         <td><b>Cost Date</b></td>
         <td colspan="4"><input type="date" style="float:left; width: 50%" class="form-control"  name="chost_date" id="chost_date" required></td>
		 
       </tr>
	   <?php
	    $stmt = $con->prepare("select a.*,b.*,c.* from staff_master a inner join designation_master b on 
		(b.id = a.design_id) inner join z_user_master c on (c.candidate_id=a.id) where a.id = '$Acc_managerid' ");

		$stmt->execute(); 
		$row_fetch = $stmt->fetch();
	   ?>

	    <tr>
		   <td><b> Employee Name </b></td>
		   <td colspan="4"><?php echo $row_fetch['emp_name']; ?> </td>
		</tr>
	    <tr> 
		   <td><b>Designation </b></td>
		   <td colspan="4"><?php echo $row_fetch['designation_name']; ?></td>
		</tr>
		<tr> 
		   <td><b> Mobile No </b></td>
		   <td colspan="4"> <?php echo $row_fetch['mobile_no']; ?></td>
		</tr>
		<tr> 
		   <td><b> Email Id </b></td>
		   <td colspan="4"><?php echo $row_fetch['email_id']; ?>
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
         <td><b>BANK NAME :</b></td>
         <td colspan="4"><input type="text" style="float:left; width: 40%" name="bank_name" id="bank_name" class="form-control" ></td>
		 
       </tr>
	   
	   <tr>
         <td><b>CURRENT A/C NO:</b></td>
         <td colspan="4"><input type="text" style="float:left; width: 40%" name="account_no" id="account_no"class="form-control" ></td>
		 
       </tr>
	   <tr>
         <td><b>IFSC CODE :</b></td>
         <td colspan="4"><input type="text" style="float:left; width: 40%" name="ifsc_code"  id="ifsc_code" class="form-control" ></td>
		 
       </tr>
	   <tr>
         <td><b>IMPORTANT :</b></td>
         <td colspan="4"><textarea name="important"  class="form-control" rows="2" cols="150">YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “QUADSEL TOWERS”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA</textarea></td>
		 
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
	
		
	</div>
	</div>
	<input type="button" style="float:right;" class="btn btn-success" id="save" name="save" onclick="costsheet_insert()"  value="Save">
	</form>	  
	<!-- Sub Total: <input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">-->
  </div>
			
<script>
var date = new Date();
var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = year + "-" + month + "-" + day;

document.getElementById("chost_date").value = today;

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
			console.log(data);
		if(data != null){ 
			$.each(data, function(index, element) {
				$('#vendor_id').val(element.id);
				$('#bank_name').val(element.account_name);
				$('#account_no').val(element.account_no);
				$('#ifsc_code').val(element.ifsc_code);
			});
		}
		}
		
	})
	
});



function costsheet_insert()
{
	var field=1;
	var data = $('form').serialize();
	
	var enquiry_id  = document.getElementById("enquiry_id").value;
	//var company_id  = document.getElementById("company_id").value;
	var chost_date  = document.getElementById("chost_date").value;
	var gst_per  = document.getElementById("gst_per").value;
	var igst_per  = document.getElementById("igst_per").value;
	var quote_type  = document.getElementById("quote_type").value;
	var mapping_id  = document.getElementById("mapping_id").value;
	var candid_id   = document.getElementById("candid_id").value;
	
	var client_id   = document.getElementById("client_id").value;
	
	
	//alert(client_id)
	$.ajax({
		type:'GET',
		//data: data + "&" + "field="+field,
		data:'field='+field+'&data='+data+'&quote_type='+quote_type+'&mapping_id='+mapping_id+'&candid_id='+candid_id+'&client_id='+client_id+'&enquiry_id='+enquiry_id+'&chost_date='+chost_date+'&gst_per='+gst_per+'&igst_per='+igst_per,
		url:'qvision/BusinessProcess/quotation/costsheet_insert.php',
		success:function(data)
		{
			alert("Cost Sheet Added Successfully");
		    Cost_sheet();
		}       
	});
}

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
    ///document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);
	
  }
  function grandtotal() {
	
	   var gst_amt = parseFloat(document.getElementById("total_item").value) *
       parseFloat(document.getElementById("gst_per").value)/100;
	   
	 
	  document.getElementById("gst_val").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
	  
	  
	   var grand_amt = parseFloat(document.getElementById("total_item").value) +
       parseFloat(document.getElementById("gst_val").value);
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

   
 
   var cell5 = row.insertCell(3);
    var element5 = document.createElement("input");
    element5.type = "text";
    element5.name = "unit[]";
	element5.class = "form-control";
	element5.classList.add("form-control");
    element5.id = "unit" + rowCount;
	
    cell5.appendChild(element5);

   
   

    var cell6 = row.insertCell(4);
    var element6 = document.createElement("input");
    element6.type = "text";
    element6.name = "cost[]";
    element6.id = "cost" + rowCount;
	element6.classList.add("form-control");
    element6.onkeyup = totalIt;
    cell6.appendChild(element6);

    var cell7 = row.insertCell(5);
    var element7 = document.createElement("input");
    element7.type = "text";
    element7.name = "price[]";
    element7.id = "price" + rowCount;
	element7.classList.add("form-control");
    element7.value = "0.00";
    $(element7).attr("readonly", "true");
    cell7.appendChild(element7);
	
	var cell8 = row.insertCell(6);
    var element8 = document.createElement("input");
    element8.type = "text";
    element8.name = "log_per[]";
    element8.id = "log_per" + rowCount;
	element8.classList.add("form-control");
    element8.onchange = totalIt;
    cell8.appendChild(element8);

    var cell9 = row.insertCell(7);
    var element9 = document.createElement("input");
    element9.type = "text";
    element9.name = "log_amt[]";
    element9.id = "log_amt" + rowCount;
	element9.classList.add("form-control");
    element9.value = "0.00";
    $(element9).attr("readonly", "true");
    cell9.appendChild(element9);
  
    var cell10 = row.insertCell(8);
    var element10 = document.createElement("input");
    element10.type = "text";
    element10.name = "eng_per[]";
    element10.id = "eng_per" + rowCount;
	element10.classList.add("form-control");
	 element10.onchange = totalIt;
    cell10.appendChild(element10);
	
	var cell11 = row.insertCell(9);
    var element11 = document.createElement("input");
    element11.type = "text";
    element11.name = "eng_amt[]";
    element11.id = "eng_amt" + rowCount;
	element11.classList.add("form-control");
	element11.value = "0.00";
    $(element11).attr("readonly", "true");
    cell11.appendChild(element11);
	
	
	 var cell12 = row.insertCell(10);
    var element12 = document.createElement("input");
    element12.type = "text";
    element12.name = "com_per[]";
    element12.id = "com_per" + rowCount;
	element12.classList.add("form-control");
	 element12.onchange = totalIt;
    cell12.appendChild(element12);
	
	var cell13 = row.insertCell(11);
    var element13 = document.createElement("input");
    element13.type = "text";
    element13.name = "com_amt[]";
    element13.id = "com_amt" + rowCount;
	element13.classList.add("form-control");
	element13.value = "0.00";
    $(element13).attr("readonly", "true");
    cell13.appendChild(element13);
	
	var cell14 = row.insertCell(12);
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
    } catch (e) {
      alert(e);
    }
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

