<?php
require '../../../connect.php';
include("../../../user.php");

 $id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT a.id as quote_id, a.*, b.*, c.*, e.* FROM quotation_entry a 
    LEFT JOIN client_master b ON (b.id = a.client_id)
    LEFT JOIN doller_vendor_mastor c ON (c.id = a.vendor_id)
    LEFT JOIN candidate_form_details e ON (e.id = a.candid_id) 
    WHERE a.status = '1' AND a.id = '$id'");

$stmt->execute();
$row = $stmt->fetch();

if($row['business_id'] =='1'){
	  $pro_ser_type = "Product";
   }else if($row['business_id'] =='2'){
	  $pro_ser_type = "Service";
   }else if($row['business_id'] =='2'){
	  $pro_ser_type = "Solution";
   }					   
$company_id = $row['company_id'];
$client_id  = $row['client_id'];
$quote_type = $row['quote_type'];
$vendor_id  = $row['vendor_id'];
$gst_per    = $row['gst_percentage'];
$position_id = $row['position'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	
 <div class="card card-info">
	  <div class="card-header">
	     <h3><center>QUOTE/PROPOSAL REVISE </center></h3>
		  <div class="form-group row">
		    <div class="col-sm-2">
			
			   <input type="hidden" class="form-control" id="enquiry_id" name="enquiry_id" value="<?php echo $row['enquiry_id']; ?>" readonly>
	           <input type="text" class="form-control" id="pro_ser_id" name="pro_ser_id" value="<?php echo $pro_ser_type; ?>" readonly>
			   <input type="hidden" class="form-control" id="mapping_id" name="mapping_id" value="<?php echo $row['business_id']; ?>" readonly>
			</div>
			<div class="col-sm-2">
				<input type="text" class="form-control" id="quote_no" name="quote_no" value="<?php echo $row['quote_no']; ?>" readonly>
			</div>
			<div class="col-sm-4">
				<select class="form-control" id="company_id" name="company_id" readonly> <!--onchange="showDiv(this)"-->
					
					<?php $query = $con->query("SELECT * FROM company_master where id='$company_id'");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['companyname']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-2">
				<select class="form-control" id="client_id" name="client_id"readonly> <!--onchange="showDiv(this)"-->
					
					<?php $query = $con->query("SELECT * FROM client_master where id ='$client_id'");
						  while ($row_fetch = $query->fetch()) {?>
					<option value="<?php echo $row_fetch['id']; ?>"><?php echo $row_fetch['client_name']; ?> </option>
					<?php } ?>
				</select>
			</div>
			<div class="col-sm-2">
				<select class="form-control" id="quote_type" name="quote_type" readonly> <!--onchange="showDiv(this)"-->
					<?php if($quote_type =='1'){ ?>
					<option value="1">INR</option>
					<?php }else{ ?>
					<option value="2">$</option>
					<?php } ?>
				</select>
			</div>
		  </div>
     </div>
	<form action="" method="post" enctype="multipart/form-data">

	  <TABLE id="dataTable" width="350px" border="1" style="border-collapse:collapse;" class="table table-bordered">
		<TR>
		  <TH>
			<INPUT type="checkbox" name="select-all" id="select-all" onclick="toggle(this);">
		  </TH> 
		  <th>SPECIFICATION</th>
		  <th>QTY</th>
		  <th>UNIT</th>
		  <th>UNIT RATE</th>
		  <TH formula="cost*qty" summary="sum">Amount</TH>
		  <TH>ACTION</TH>
		</TR>
		<?php  
				$query= $con->query("SELECT a.id as quote_id,a.*,b.*,c.*,e.* from quotation_entry a 
                LEFT JOIN client_master b on(b.id=a.client_id) 
                LEFT JOIN doller_vendor_mastor c on(c.id=a.vendor_id)
                LEFT JOIN candidate_form_details e on(e.id =a.candid_id)
                where a.status ='1' and a.id='$id'"); 
				 $cnt=1;
					while($quote = $query->fetch(PDO::FETCH_ASSOC)){
		?>
		<TR>
		  <TD>
			<INPUT type="checkbox" name="chk[]">
		  </TD>
		  <TD>
			<INPUT type="text" id="item1" name="item[]" class="form-control" value="<?php echo $quote['specification']; ?>"> </TD>
		  <TD>
			<INPUT type="text" id="qty1" name="qty[]" onchange="totalIt()" class="form-control" value ="<?php echo $quote['qty']; ?>"> </TD>
		  <TD>
			<INPUT type="text" id="unit1" name="unit[]" class="form-control" value="<?php echo $quote['unit']; ?>"> </TD>
			
		  <TD>
			<INPUT type="text" id="cost1" name="cost[]" onchange="totalIt()" class="form-control" value="<?php echo $quote['unit_rate']; ?>"> </TD>
		  <TD>
			<INPUT type="text" id="price1" name="price[]" readonly="readonly" class="form-control" value="<?php echo $quote['amount']; ?>"> </TD>
		<td>
	     <INPUT type="button" class="btn btn-success" value="Add " onclick="addRow('dataTable')" />
	     <INPUT type="button" class="btn btn-danger" value="Delete Item(s)" onclick="deleteRow('dataTable')" />
		</td>
		</TR>
		<?php $cnt=$cnt+1; } ?>
	  </TABLE>
      
    <!-- BUG FIX: Wrapper row added here -->
    <div class="form-group row" style="margin: 15px 0;">
        <div class="col-sm-6">
           <select class="form-control" id="gst" name="gst">
                <?php if($gst_per =='18'){?>
                <option value="18">18 %</option>
                <?php }else{ ?>
                <option value="28">28 %</option>
                <?php }?>
                <option value="18">18 %</option>
                <option value="28">28 %</option>
            </select>
        </div>
        <div class="col-sm-2">
          <input type="date" class="form-control" name="revise_date" id="revise_date" required>
        </div>
       <div class="col-sm-2">
         <input type="button" class="btn btn-success" id="save" name="save" onclick="quotation_update()" value="Save">
       </div>
    </div>
    

	  <div class="card-body">
	    <table class="table table-bordered">
		 <tr><th colspan="2"  style="text-align:center;">TERMS & CONDITIONS</th></tr>
		  <tr>
		    <th>VALIDITY</th>
			<th>ONE WEEK FROM THE DATE OF QUOTE. PRICES PREVAILING AT THE TIME OF SUPPLY & BILLING WILL ONLY APPLY.</th>
		  </tr>
		  <tr>
		    <th>PAYMENT</th>
			<td><b>100% IN ADVANCE ALONG WITH FORMAL PURCHASE ORDER.<br/></b>
			PAYMENTS SHOULD BE MADE EITHER BY CHEQUE, DD, RTGS AND NEFT IN FAVOUR OF QUADSEL SYSTEMS PVT LTD, PAYABLE AT CHENNAI. CASH PAYMENTS WILL BE NULL & VOID.<br/>
			<b>1BANK DETAILS FOR NEFT / RTGS / IMPS <div id="items">
			<div class="form-group row">
			    <div class="col-sm-2">BANK NAME :</div>
				<div class="col-sm-1"><input type="text" id="bank_name" style ="border:none;" value="<?php echo $row['account_name'];?>"readonly>
				<input type="hidden" id="vendor_id" value="<?php echo $row['vendor_id'];?>" readonly></div>
				
			</div>
			<div class="form-group row">
			     <div class="col-sm-2">CURRENT A/C NO :</div>
				 <div class="col-sm-1"><input type="text" id="acc_no" style ="border:none;" value="<?php echo $row['account_no'];?>" readonly></div>
			</div>
			
			<div class="form-group row">
			     <div class="col-sm-2">IFSC CODE :</div>
				 <div class="col-sm-1"><input type="text" id="ifsc_code" style ="border:none;" value="<?php echo $row['ifsc_code'];?>" readonly></div>
			</div>
			</div>
			</b>
            </td>
		  </tr>
		  <tr id="hidden_div1">
		    <th >IMPORTANT</th>
			<td>YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “QUADSEL TOWERS”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.</td>
		  </tr>
		   <tr id="hidden_div2">
		    <th>IMPORTANT</th>
			<td>YOUR PO SHOULD BE IN FAVOUR OF QUADSEL SYSTEMS PVT LTD., “BLUE BASE SOFTWARE”, Old No.80, New No.118, Manickam Lane, Anna Salai, Guindy, Chennai – 600 032. INDIA.</td>
		  </tr>
		  <tr>
		    <th>DELIVERY</th>
			<td><b>AS FOR THE OME WITHIN 1 - 2 WEEKS , WITHIN 2 - 3 WEEKS , WITHIN 3- 4 WEEKS, WITHIN 4 - 5 WEEKS  FROM THE DATE OF RECEIPT OF PAYMENT.</b><br/>
			SHIPPING COSTS WILL BE LEVIED IN FINAL INVOICE AS MAY BECOME APPLICABLE.</td>
		  </tr>
		  <tr>
		    <th>WARRANTY</th>
			<td>AS MENTIONED ABOVE.<br/></td>
		  </tr>
		</table>
		</div>
		<br/><br/>
	   <div class="form-group row">
			<div class="col-sm-12"><p><b> For QUADSEL SYSTEMS PVT. LTD.,</b></p></div> 
	  </div>
	  <div class="form-group row">
		<div class="col-sm-12"><b><input type="text" id="emp_name" style ="border:none;" value="<?php echo $row['first_name'];?>" readonly></div>
	  </div><b>
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
				 
			</div></b>
		
	</form>	  
	<input type="text" readonly="readonly" id="total"><br><input type="submit" value="Create Invoice">
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




function quotation_update() {
    var field = 1;
    var data = $('form').serialize(); 
    
    var enquiry_id  = document.getElementById("enquiry_id").value;
    var company_id  = document.getElementById("company_id").value;
    var revise_date = document.getElementById("revise_date").value;
    var quote_type  = document.getElementById("quote_type").value;
    var mapping_id  = document.getElementById("mapping_id").value;
    var candid_id   = document.getElementById("candid_id").value;
    var vendor_id   = document.getElementById("vendor_id").value;
    var client_id   = document.getElementById("client_id").value;
    var quote_no    = document.getElementById("quote_no").value;
    
    if(revise_date === "") {
        alert("Please select a Revise Date!");
        return;
    }
	var items = document.getElementsByName("item[]");
    if(items.length === 0) {
        alert("Quotation cannot be empty! Please add");
        return;
    }

    $.ajax({
    type: 'POST',
    // Ithu unga pazhaya data format thaan, apdiye vechuruken
    data: data + '&field='+field+'&quote_type='+quote_type+'&mapping_id='+mapping_id+'&candid_id='+candid_id+'&vendor_id='+vendor_id+'&client_id='+client_id+'&enquiry_id='+enquiry_id+'&company_id='+company_id+'&revise_date='+revise_date+'&quote_no='+quote_no,
    url: 'qvision/BusinessProcess/quotation/quotation_update.php',
    success: function(response) {
        // Ipo PHP la irunthu varum unmaiyana response ah alert la kaatum
        alert(response.trim()); 
        
        // Success aagiduchu na thevaiyana redirect function ah keela add pannikalam
        // Quotation_view(); 
    },
    error: function(xhr, status, error) {
        // Oruvela server block aana intha alert theliva kaatum
        alert("Server Error: " + error);
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
				$('#designation').val(element.position);
				$('#tel_no').val(element.mobile_num);
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

  var rowCount = 0;

  function addRow(tableID) {

    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var cell1 = row.insertCell(0);
    var element1 = document.createElement("input");
    element1.type = "checkbox";
    element1.name = "chk[]";
	element1.class = "form-control";
    cell1.appendChild(element1);


    var cell3 = row.insertCell(1);
    var element3 = document.createElement("input");
    element3.type = "text";
    element3.name = "item[]";
	element3.class = "form-control";
    element3.id = "item" + rowCount;
    cell3.appendChild(element3);
	
    var cell4 = row.insertCell(2);
    var element4 = document.createElement("input");
    element4.type = "text";
	element4.class = "form-control";
    element4.name = "qty[]";
    element4.id = "qty" + rowCount;
    element4.onkeyup = totalIt;
	
    cell4.appendChild(element4);

   
 
   var cell5 = row.insertCell(3);
    var element5 = document.createElement("input");
    element5.type = "text";
    element5.name = "unit[]";
	element5.class = "form-control";
    element5.id = "unit" + rowCount;
	
    cell5.appendChild(element5);

   
   

    var cell6 = row.insertCell(4);
    var element6 = document.createElement("input");
    element6.type = "text";
    element6.name = "cost[]";
    element6.id = "cost" + rowCount;
    element6.onkeyup = totalIt;
    cell6.appendChild(element6);

    var cell7 = row.insertCell(5);
    var element7 = document.createElement("input");
    element7.type = "text";
    element7.name = "price[]";
    element7.id = "price" + rowCount;
    element7.value = "0.00";
    $(element7).attr("readonly", "true");
    cell7.appendChild(element7);

  }

  function deleteRow(tableID) {
    try {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        var deletedCount = 0; // Item count panna pudhu variable

        for (var i = 1; i < rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].querySelector('input[type="checkbox"]');

            if (chkbox !== null && chkbox.checked === true) {
                table.deleteRow(i);
                rowCount--;
                i--;
                deletedCount++; // Delete aana count aagum
            }
        }

        // Response Alert
        if (deletedCount === 0) {
            // Tick pannama click panna intha alert varum
            alert("Bro, please tick at least one checkbox to delete an item!");
        } else {
            // Delete aanathuku apram select-all box ah uncheck pandrom
            var selectAll = document.getElementById("select-all");
            if(selectAll) selectAll.checked = false;
        }
    } catch (e) {
        alert("Delete Error: " + e.message);
    }
}

</script>
<script>
// Date field-a distrub pannama iruka not('[type="date"]') add panniruken
$("input").not('[type="date"]').blur(function() {
    if ($(this).attr("data-selected-all")) {
        $(this).removeAttr("data-selected-all");
    }
});

// Pazhaya line ah thookitu ithai podunga
$("input[type='text'], input[type='number']").click(function() {
    if (!$(this).attr("data-selected-all")) {
        try {
            this.selectionStart = 0;
            this.selectionEnd = this.value.length + 1;
            $(this).attr("data-selected-all", true);
        } catch (err) {
            $(this).select();
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

// Fixed HTML syntax error here
function showDiv(id){
   if(id.value == 2){
    document.getElementById('hidden_div2').style.display = "block";
    document.getElementById('hidden_div1').style.display = "none";
   } else{
    document.getElementById('hidden_div2').style.display = "none";
    document.getElementById('hidden_div1').style.display = "block";
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