<?php
require '../../../connect.php';
include("../../../user.php");
$costsheet_id=$_REQUEST['id'];
$stmt = $con->prepare("SELECT a.id as costsheet_id,a.*,b.*,e.*,d.*,f.mapping_id from cost_sheet_entry a 
		 inner join client_master b on(b.id=a.client_id) 
		 
		 inner join company_master d on(d.id=a.company_id)
		 LEFT JOIN product_services f on (f.id = a.business_id)
		 inner join candidate_form_details e on(e.id=a.candid_id) where a.id='$costsheet_id'  and a.status ='1' "); 

$stmt->execute(); 
$row = $stmt->fetch();
if($row['business_id'] =='1'){
	  $pro_ser_type = "Product";
   }else if($row['business_id'] =='2'){
	  $pro_ser_type = "Service";
   }else if($row['business_id'] =='3'){
	  $pro_ser_type = "Solution";
   }


$company_id = $row['company_id'];
$client_id  = $row['client_id'];
$quote_type = $row['quote_type'];
$vendor_id  = $row['vendor_id'];
$position_id = $row['position'];


?>


<style>
.form-control{
-webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 0%);
}
.table>tbody>tr>td{
    padding: 4px !important;
}
.table {
        margin-bottom: 0px !important;
		vertical-align: middle !important;
}
</style>
<head>
<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #f1cc61 !important;
	}
	</style>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<div class="card card-info">
	  <div class="card-header">
	     <h3 class="card-title"><font size="5">QUOTE/PROPOSAL ENTRY DETAILS</font></h3>
		   <div class="form-group row">
		    <div class="col-sm-3">
			   <input type="hidden" class="form-control" id="cost_sheet_id" name="cost_sheet_id" value=" <?php echo $row['costsheet_id']; ?>" readonly>
	           <input type="text" class="form-control" id="pro_ser_id" name="pro_ser_id" value=" <?php echo $pro_ser_type; ?>" readonly>
			   <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value=" <?php echo $row['mapping_id']; ?>" readonly>
			</div>
			<div class="col-sm-4">
				<select class="form-control" id="company_id" name="company_id" readonly="readonly"> 
					
					<?php $query = $con->query("SELECT * FROM company_master where id='$company_id'");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['companyname']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-3">
				<select class="form-control" id="client_id" name="client_id" readonly="readonly"> 
					
					<?php $query = $con->query("SELECT * FROM client_master where id ='$client_id'");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['client_name']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-2">
				<select class="form-control" id="quote_type" name="quote_type" readonly="readonly"> 
					
					<?php if($quote_type =='1'){ ?>
					<option value="1">INR</option>
					<?php }else{ ?>
					<option value="2">$</option>
					<?php } ?>
				</select>
			</div>
		  
     </div>
	
	<form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

	  <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
		<tr>
		  <th>
			<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
		  </th> 
		  <th>SPECIFICATION</th>
		  <th>QTY</th>
		  <th>UNIT</th>
		  <th>UNIT RATE</th>
		  <TH formula="cost*qty" summary="sum">Amount</th>
		  <th>Action</th>
		  
		</tr>
		<?php  
				$query= $con->query("SELECT a.id as costsheet_id,a.*,b.*,e.* from cost_sheet_entry a 
				 inner join client_master b on(b.id=a.client_id) 
				 
				 inner join candidate_form_details e on(e.id =a.candid_id)
				 where a.status ='1' and a.id='$costsheet_id'"); 
				 $cnt=1;
					while($cost = $query->fetch(PDO::FETCH_ASSOC)){
						
						$costsheet_date_str  = $cost['costsheet_date'];

                        $costsheet_date = date('Y-m-d', strtotime($costsheet_date_str));
		?>
		<tr>
		  <td>
			<INPUT type="checkbox" name="chk[]">
		  </td>
		  <td>
			<INPUT type="text" id="item1" name="item[]" class="form-control" value="<?php echo $cost['specification']; ?>"> </td>
		  <td>
			<INPUT type="text" id="qty1" name="qty[]" onchange="totalIt()" class="form-control sumtotal" value ="<?php echo $cost['qty']; ?>"> </td>
		  <td>
			<INPUT type="text" id="unit1" name="unit[]" class="form-control" value="<?php echo $cost['unit']; ?>"> </td>
			
		  <td>
			<INPUT type="text" id="cost1" name="cost[]" onchange="totalIt()" class="form-control sumtotal" value="<?php echo $cost['unit_rate']; ?>"> </td>
		  <td>
			<INPUT type="text" id="price1" name="price[]" readonly="readonly" class="form-control sumtotal" value="<?php echo $cost['total_price']; ?>"> </td>
		  <td>
		    <INPUT type="button" class="btn btn-success" value="Add " onclick="addRow('dataTable')" />
	        <INPUT type="button" class="btn btn-danger" value="Delete" onclick="deleteRow('dataTable')" />
		   </td>
		</tr>
       </table>
	   <table id="dataTable" width="300px" border="1" style="border-collapse:collapse;" class="table table-bordered" >
			<tr>
		  <td colspan="5"><b>Logistics</b></td>
		 
		  <td colspan="3" align="right">
		    <INPUT type="text" id="logistics" name="logistics" class="form-control sumtotal" style="width:40% !important;"  value="<?php echo $cost['log_amt']; ?>">
		  </td>
		</tr>
		<tr>
		  <td colspan="5"><b>Engineer</b></td>
		   <td colspan="3" align="right">
		    <INPUT type="text" id="eng" name="eng" class="form-control sumtotal" style="width:40% !important;"  value="<?php echo $cost['eng_amt']; ?>">
		  </td>
		</tr>
		<tr>
		  <td colspan="5"><b>Margin</b>
		   <INPUT type="text" id="margin_per" name="margin_per" class="form-control" style="width:40% !important;"  value="<?php echo $cost['com_per']; ?>">
		</td>
		 <td colspan="3" align="right"> 
		    <INPUT type="text" id="margin_amt" name="margin_amt" class="form-control sumtotal" style="width:40% !important;" p value="<?php echo $cost['com_amt']; ?>">
		  </td>
		</tr>
		<tr>
		  <td colspan="5"><b>Total</b></td>
		  <td colspan="3" align="right">
		    <INPUT type="text" id="totalPrice" name="totalPrice" class="form-control" style="width:40% !important;" >
		  </td>
		</tr>
		<input type="hidden" readonly="readonly" id="costsheet_id1" name ="costsheet_id[]" value ="<?php echo $cost['costsheet_id'];?>">
		<?php $cnt=$cnt+1; } ?>
		<tr>
		 <td colspan="5"><b>Quotation date</b><input type="date" style="float:left;" class="form-control" name="quote_date" id="quote_date" >
         </td>
		 <td><b>GST</b>
		 <select class="form-control" id="gst" name="gst" required>
			<option value="">----- Choose GST % -----</option>
			<option value="18">18 %</option>
			<option value="28">28 %</option>
		</select>
		</td>
		  <td colspan="3" align="right"> <input type="button" class="btn btn-success" id="save" name="save" onclick="quotation_insert()"  value="Save"><br/><br/></td>
		</tr>
		
	  </table>	
	
	    <table class="table table-bordered">
		 <tr><th colspan="2"  style="text-align:center;">TERMS & CONDITIONS</th></tr>
		  <tr>
		    <th>VALIDITY</th>
			<th>ONE WEEK FROM THE DATE OF QUOTE. PRICES PREVAILING AT THE TIME OF SUPPLY & BILLING WILL ONLY APPLY.</th>
		  </tr>
		  <tr>
		    <th>PAYMENT</th>
			<td><b>100% IN ADVANCE ALONG WITH FORMAL PURCHASE ORDER.<br/></b>
			PAYMENTS SHOULD BE MADE EITHER BY CHEQUE, DD, RTGS AND NEFT IN FAVOUR OF QUADSEL SYSTEMS PVT LTD, PAYABLE AT CHENNAI. CASH PAYMENTS WILL BE NULL & VOID.<br/><br/>
			<?php 

             // ADD THIS TO FIX BANK DETAILS ERROR
             $bank_name = "";
             $account_no = "";
             $ifsc_code = "";
             $vender_id = "";

			if(($row['business_id'] == '1')OR($row['business_id'] =='2')){
				 if($quote_type =='1'){ 
					$stmt = $con->query("select * from doller_vendor_mastor where vendor_type = '$quote_type' ");
					 while ($row1 = $stmt->fetch()) {
						$bank_name = $row1['account_name'];
						$account_no = $row1['account_no'];
						$ifsc_code = $row1['ifsc_code'];
						$vender_id = $row1['id'];
						
					} 
				 }else{
					  $stmt = $con->query("select * from doller_vendor_mastor where vendor_type = '$quote_type' ");
					 while ($row1 = $stmt->fetch()) {
					} 
				 }
			}
			?>
			<b>BANK DETAILS FOR NEFT / RTGS / IMPS </b>
			<div class="form-group row" style="margin:0;">
			    <div class="col-sm-2">BANK NAME :</div>
				<div class="col-sm-4"><input type="text" id="bank_name" style="border: 1px solid #000;" value="<?php echo $bank_name;?>" >
				<input type="hidden" id="vendor_id" readonly value="<?php echo $vender_id;?>"></div>
			</div>
			<div class="form-group row" style="margin:0;">
			     <div class="col-sm-2">CURRENT A/C NO :</div>
				 <div class="col-sm-4"><input type="text" id="acc_no" style="border: 1px solid #000;" value="<?php echo $account_no;?>"></div>
			</div>
			<div class="form-group row" style="margin:0;">
			     <div class="col-sm-2">IFSC CODE :</div>
				 <div class="col-sm-4"><input type="text" id="ifsc_code" style="border: 1px solid #000;" value="<?php echo $ifsc_code;?>"></div>
			</div>
            </td>
		  </tr>
		  
		   <tr id="hidden_div2">
		    <th>IMPORTANT</th>
			<td>YOUR PO SHOULD BE IN FAVOUR OF SS INFORMATION SYSTEMS PVT LTD, No.1/102, First Floor, Periyar Pathai (West),100 Feet Road, Arumbakkam,Chennai-600 106. INDIA</td>
		  </tr>
		  <tr>
		    <th>DELIVERY</th>
			<td><b>AS FOR THE OME WITHIN ONE TO TWO WEEKS , WITHIN TWO TO THREE WEEKS , WITHIN THREE TO FOUR WEEKS, WITHIN FOUR TO FIVE WEEKS  FROM THE DATE OF RECEIPT OF PAYMENT.</b><br/>
			SHIPPING COSTS WILL BE LEVIED IN FINAL INVOICE AS MAY BECOME APPLICABLE.</td>
		  </tr>
		  <tr>
		    <th>WARRANTY</th>
			<td>AS MENTIONED ABOVE.<br/></td>
		  </tr>
		</table>
		
		<br/><br/>
	   <div class="form-group row">
			<div class="col-sm-12"><p><b> For SS INFORMATION SYSTEMS PVT LTD, </b></p></div> 
			
	  </div>
	   <div class="form-group row">
		<div class="col-sm-12"><b><?php echo $row['first_name'];?></b></div>
	  </div>
	<?php $query1=  $con->prepare("select designation_name from designation_master where id ='$position_id'");
         	$query1->execute(); 
            $row1 = $query1->fetch();
			?>
		    <div class="form-group row">
			    <div class="col-sm-12"><?php echo $row1['designation_name'];?></div>
			</div>
			 <div class="form-group row">
				  <div class="col-sm-12"><?php echo $row['phone'];?></div>
			</div>
			 <div class="form-group row">
				  <div class="col-sm-12"><?php echo $row['mail'];?>
				  <input type="hidden" id="candid_id" value ="<?php echo $row['candid_id'];?>" readonly></div>
				 
			</div>
            
        </div>
	</form>	  
  </div>
			
<script>

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




function quotation_insert()
{
	var field=1;
	var data = $('form').serialize();
	alert(data)
	var cost_sheet_id  = document.getElementById("cost_sheet_id").value;
	var company_id  = document.getElementById("company_id").value;
	var quote_date  = document.getElementById("quote_date").value;
	
	var quote_type    = document.getElementById("quote_type").value;
	var mapping_id  = document.getElementById("mapping_id").value;
	var candid_id   = document.getElementById("candid_id").value;
	var vendor_id   = document.getElementById("vendor_id").value;
	var client_id   = document.getElementById("client_id").value;
	
	$.ajax({
		type:'GET',
		//data: data + "&" + "field="+field,
		data:'field='+field+'&data='+data+'&quote_type='+quote_type+'&mapping_id='+mapping_id+'&candid_id='+candid_id+'&vendor_id='+vendor_id+'&client_id='+client_id+'&cost_sheet_id='+cost_sheet_id+'&company_id='+company_id+'&quote_date='+quote_date,
		url:'qvision/BusinessProcess/quotation/quotation_insert.php',
		success:function(data)
		{
			alert("Entry Successfully");
		    Quotation;
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
				$('#tel_no').val(element.phone);
				$('#email_id').val(element.mail);
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
  }

  function totalIt() {
    var qtys = document.getElementsByName("qty[]");
    var total = 0;
    for (var i = 1; i <= qtys.length; i++) {
      calc(i);
      var price = parseFloat(document.getElementById("price" + i).value);
      total += isNaN(price) ? 0 : price;
    }
    document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);
	
	
	
	
  }

  window.onload = function() {
    document.getElementsByName("qty[]")[0].onkeyup = function() {
      calc(1)
    };
    document.getElementsByName("cost[]")[0].onkeyup = function() {
      calc(1)
    };
  }


// we used jQuery 'keyup' to trigger the computation as the user type
$('.sumtotal').keyup(function () {
 
    // initialize the sum (total price) to zero
    var sum = 0;
     
    // we use jQuery each() to loop through all the textbox with 'price' class
    // and compute the sum for each loop
    $('.sumtotal').each(function() {
		
		
        sum += Number($(this).val());
    });
     
    // set the computed value to 'totalPrice' textbox
    $('#totalPrice').val(sum);
     
});



  var rowCount = 0;

  function addRow(tableID) {

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "checkbox";
    element1.name = "chk[]";
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
	element4.classList.add("form-control");
    element4.name = "qty[]";
    element4.id = "qty" + rowCount;
    element4.onkeyup = totalIt;
	
    cell4.appendChild(element4);

   
 
   var cell5 = row.insertCell(3);
    var element5 = document.createElement("input");
    element5.type = "text";
    element5.name = "unit[]";
	element5.classList.add("form-control");
    element5.id = "unit" + rowCount;
	
    cell5.appendChild(element5);

   
   

    var cell6 = row.insertCell(4);
    var element6 = document.createElement("input");
    element6.type = "text";
    element6.name = "cost[]";
	element6.classList.add("form-control");
    element6.id = "cost" + rowCount;
    element6.onkeyup = totalIt;
    cell6.appendChild(element6);

    var cell7 = row.insertCell(5);
    var element7 = document.createElement("input");
    element7.type = "text";
    element7.name = "price[]";
	element7.classList.add("form-control");
    element7.id = "price" + rowCount;
    element7.value = "0.00";
    $(element7).attr("readonly", "true");
    cell7.appendChild(element7);

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