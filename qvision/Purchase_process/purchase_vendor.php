<?php
require '../../connect.php';
require '../../user.php';
$candidateid = $_SESSION['candidateid'];
$cs_no = $_REQUEST['id'];

$cost = $con->query("select * from cost_sheet_entry where id='$cs_no'");

?>
<div class="card card-info">
    <div class="card-header">
        <h2 class="card-title">
            <font size="4"><b>Vendor Comparision</b></font>
        </h2>

        <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
    </div>
    <table class="table table-bordered table-striped">
        <th>PRODUCT</th>
        <th>PRODUCT DESCRIPTION</th>
        <th>QTY</th>

      
        
        <th>UNIT RATE</th>
        <th formula="cost*qty" summary="sum">AMOUNT</th>
        <th colspan="2">GST PERCENTAGE</th>
        <th>TOTAL AMOUNT</th>

        <!-- <th colspan='2'>Logistic</th>
        <th colspan='2'>Engineer</th>
        <th colspan='2'>Margin</th>
        <th>Total Items</th> -->

        <tbody>
            <?php
            $i = 1;
            $dis = $cost->fetch();
            $cost_sheet_no=$dis['cost_sheet_no'];
            ?>
                <tr>
                    <td>
                        <INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $dis['cost_sheet_no']; ?>" readonly="readonly">
                        <?php echo $dis['product_name']; ?>
                    </td>
                    <td><?php echo $dis['description']; ?></td>
                    <td><?php echo $dis['qty']; ?></td>

                    <!-- <td><?php echo $dis['unit']; ?></td> -->

                    <td><?php echo $dis['unit_rate']; ?></td>
                    <td><?php echo $dis['total_price']; ?></td>
                    <td><?php echo $dis['gst_per']; ?>% </td>
                    <td><?php echo $dis['gst_amt']; ?></td>
                    <td><?php echo $dis['total_price'] + $dis['gst_amt']; ?></td>

                    <!-- <td><?php echo $dis['log_per']; ?></td>
                    <td><?php echo $dis['log_amt']; ?></td>
                    <td><?php echo $dis['eng_per']; ?></td>
                    <td><?php echo $dis['eng_amt']; ?></td>
                    <td><?php echo $dis['com_per']; ?></td>
                    <td><?php echo $dis['com_amt']; ?></td>
                    <td><?php echo $dis['total_amt']; ?></td> -->

                </tr>
            <?php
             
            ?>

            <?php
            $sonum = $con->query("select id,so_number,cost_sheet_no from po_generate where cost_sheet_no='$cost_sheet_no'");

            $sonums = $sonum->fetch();

            $cost1 = $con->query("select *,sum(gst_amt + total_price ) as netAmnt from cost_sheet_entry where id='$cs_no'");
            $cfet = $cost1->fetch() 
			
			?>
            <tr>
            <input type="hidden" id="po_generate_id" name="po_generate_id" class="form-control" value="<?php echo $sonums['id']; ?>" readonly="readonly">
                <td colspan="6" align="center"> <b>Net Amount : </b></td>
                <td colspan="2" align="center"><?php echo $cfet['netAmnt']; ?> <br>
                </td>

                <!-- <td colspan="3" align="center"><b>Gst Percentage <?php echo $cfet['gst_per']; ?>%</b></td>
                <td colspan="3" align="center"><?php echo $cfet['gst_amt']; ?><br>
                </td> -->
            </tr>
            <!-- <tr>
                <td colspan="6" align="center"><b>Grand Total : </b></td>
                <td colspan="6" align="center"><?php echo $cfet['grand_amt']; ?><br>
                </td>
            </tr> -->


        </tbody>
    </table>
    <div>

    </div>
    <form id="fupForm" name="fupForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
        <input type="button" class="delete-row btn btn-danger" value="Delete" style="float:right;">&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" class="add-row btn btn-success" value="Add " onclick="check();" style="float:right;"><br /><br />

        <!-- <table id="new_tab" width="300px" border="1" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered table-striped"> -->
        <div class="table-responsive" style=" max-height:300px;">
	 <table id="new_tab"  border="1" style="width:1500px;border-collapse:collapse;margin-bottom: 0px !important;overflow-x:auto!important" class="table table-striped table-bordered table-hover display nowrap">
            <tbody id="cost_sheett">

                <tr>
                    <th>Sr. No.</th>
                    <th>Vendor</th>
                    <th>UNIT of Measure</th>
                    <th>QTY</th>
		       <th>UNIT RATE</th>
		       <Th formula="cost*qty" summary="sum">Amount</th>		      
		       <th>GST Percentage</th>
		       <th>GST Amount</th>
			   <th>IGST Percentage</th>
		       <th>IGST Amount</th>
		       <th>Discount Percentage</th>
		       <th>Discount</th>
		       <th>Total Amount</th>
                    <th>Upload</th>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" name="chk[]">
                    </td>
                    <td>
                    <select class="form-control" id="vendor1" name="vendor[]" >
							<option value="">Choose Type</option>
							<?php $stmt = $con->query("SELECT * FROM doller_vendor_mastor ");
							while ($row = $stmt->fetch()) {?>
							<option value="<?php echo $row['id']; ?>"> <?php echo $row['vendor_name']; ?> </option>
						<?php } ?>
						</select>
                        <INPUT type="hidden" id="cost_sheet_id" name="cost_sheet_id" class="form-control" value="<?php echo $cs_no; ?>" readonly="readonly">
                        <INPUT type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $cost_sheet_no; ?>" readonly="readonly">
                        <input type="hidden" id="specification" name="specification" class="form-control" value="<?php echo $dis['specification']; ?>" readonly="readonly">
                        <input type="hidden" id="so_number" name="so_number" class="form-control" value="<?php echo $sonums['so_number']; ?>" readonly="readonly">
                    </td>
                    <td>
                        <input type="text" id="unit1" name="unit[]" class="form-control">
                    </td>

                    <td>
			     <input type="text" id="qty1" name="qty[]" onchange="totalIt();grandtotal();" class="form-control"></td>
		     </td>

		     <td>
			     <input type="text" id="cost1" name="cost[]" onchange="totalIt();grandtotal();" class="form-control"></td>
		     <td>
			     <input type="text" id="price1" name="price[]" onchange="totalIt()" readonly value="0.00" class="form-control">
		     </td>
		     
			     <input type="hidden" id="log_per1" name="log_per[]" class="form-control log_per " onchange="totalIt()" placeholder="%">
		
		   
			     <input type="hidden" id="log_amt1" name="log_amt[]" class="form-control"  placeholder="0.00" readonly>
		  		
		   
		         <INPUT type="hidden" id="eng_per1" name="eng_per[]" class="form-control eng_per"  onchange="totalIt()" placeholder="%">
		 	  
		     
		         <INPUT type="hidden" id="eng_amt1" name="eng_amt[]" class="form-control " placeholder="0.00" readonly>

		  
		
		         <INPUT type="hidden" id="com_per1" name="com_per[]" class="form-control com_per"  onchange="totalIt()" placeholder="%">
		    
		
		         <INPUT type="hidden" id="com_amt1" name="com_amt[]" class="form-control"  placeholder="0.00" readonly>
		     
		
		     <td>
			 
			 <select class="form-control" id="gst_per1" name="gst_per[]" onchange="grandtotal()" style="float:left; width: 100%" required>
			          <option value="">----- Choose GST % -----</option>
			          <option value="3">3 %</option>
			          <option value="5">5 %</option>
			          <option value="12">12 %</option>
			          <option value="18">18 %</option>
			          <option value="28">28 %</option>
		           </select>
		         <INPUT type="hidden" id="col_item1" name="col_item[]" class="form-control"  placeholder="0.00" readonly>
				 <INPUT type="hidden" id="total_item1" name="total_item[]" class="form-control" style="width:100% !important;" placeholder="0.00">
		     </td>
		     <td>
			 <INPUT type="text" id="gst_val1" name="gst_val[]" class="form-control" onchange="grandtotal()" style="width:100% !important;" placeholder="0.00" value="0">
			  </td>
			  <td><input type="number" style="float:left; width: 100%" class="form-control"  onchange="grandtotal()"  name="igst_per[]" id="igst_per1" placeholder="Enter IGST Percentage"></td>
			  <td >
		         <INPUT type="text" id="igst_val1" name="igst_val[]" onchange="grandtotal()" class="form-control" style="width:100% !important;" placeholder="0.00">
	         </td>

             <td>
                <input type="number" style="float:left; width: 100%" class="form-control"  onchange="grandtotal()"  name="disc_per[]" id="disc_per1" placeholder="Enter Discount Percentage">
            </td>
             <td>
			   <INPUT type="text" id="discount1" name="discount[]" class="form-control" style="width:100% !important;" placeholder="0.00" >
			  </td>

			  <td>
			   <INPUT type="text" id="grand_total1" name="grand_total[]" class="form-control" style="width:100% !important;" placeholder="0.00" readonly>
			  </td>

                    <td>
                        <INPUT type="file" id="image1" name="image[]" class="form-control">
                    </td>

                </tr>
            </tbody>
        </table>
                            </div>
        <input type="submit" name="submit" id="submit" class="btn btn-success submitBtn" value="SAVE">
    </form>
</div>
<script>
    function back() {
        let id = $('#po_generate_id').val();
        purchse_order_edit(id)
       // purchase_order()
    }
</script>
<script>
    $(document).ready(function() {
        // Submit form data via Ajax
        /* $("#fupForm").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "/qvision/Purchase_process/purchase_vendor_insert.php",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {
                    if (response == 0) {
                        alert('Uploaded failed');
                        po_upload();
                    } else(response == 1) {
                        alert("Uploaded successfully");
                        po_upload();
                    }

                }
            });
        }); */

        // File type validation
        var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
        $("#file").change(function() {
            for (i = 0; i < this.files.length; i++) {
                var file = this.files[i];
                var fileType = file.type;

                if (!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))) {
                    alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                    $("#file").val('');
                    return false;
                }
            }
        });
    });
</script>
<script type="text/javascript">
    // For Adding and Deleting New Row start -----------------------------------------------------------
    function check() {
        var len = $('#new_tab tr').length;
        len = len + 0;
        if(len==2)
		{
			var checks = document.getElementById("gst_per1").value;
			var gr_ttl = document.getElementById("grand_total1").value;
			if(checks=='' || gr_ttl =='' || gr_ttl ==0.00)
			{
				alert("Please Fill the First Field");
				return false;
			}
		}else if(len==3)
		{
			var checkz = document.getElementById("gst_per2").value;
			var gr_ttls = document.getElementById("grand_total2").value;
			if(checkz=='' || gr_ttls =='' || gr_ttls ==0.00)
			{
				alert("Please Fill the Second Field");
				return false;
			}
		}else if(len==4)
		{
			var checkd = document.getElementById("gst_per3").value;
			var gr_ttld = document.getElementById("grand_total3").value;
			if(checkd=='' || gr_ttld =='' || gr_ttld ==0.00)
			{
				alert("Please Fill the Third Field");
				return false;
			}
		}else if(len==5)
		{
			var checkc = document.getElementById("gst_per4").value;
			var gr_ttlc = document.getElementById("grand_total4").value;
			if(checkc=='' || gr_ttlc =='' || gr_ttlc ==0.00)
			{
				alert("Please Fill the Fourth Field");
				return false;
			}
		}
 
 

        $('#new_tab').append('<tr class="row_' + len + '"><td><input type="checkbox" name="chk[]" id="chk_' + len + '" value="' + len + '"></td><td><select class="form-control" id="vendor' + len + '" name="vendor[]" ><option value="">Choose Type</option><?php $stmt = $con->query("SELECT * FROM doller_vendor_mastor ");while ($row = $stmt->fetch()) {?><option value="<?php echo $row['id']; ?>"> <?php echo $row['vendor_name']; ?> </option><?php } ?></select></td><td><input type="text" id="unit' + len + '" name="unit[]" class="form-control"></td><td><input type="text" id="qty' + len + '" name="qty[]" onchange="totalIt();" class="form-control"></td><td><input type="text" id="cost' + len + '" name="cost[]" onchange="totalIt()" class="form-control"></td><td><input type="text" id="price' + len + '" name="price[]" onchange="totalIt()" readonly value="0.00" class="form-control"></td><input type="hidden" id="log_per' + len + '" name="log_per[]" class="form-control log_per " onchange="totalIt()" placeholder="%"><input type="hidden" id="log_amt' + len + '" name="log_amt[]" class="form-control"  placeholder="0.00" readonly><INPUT type="hidden" id="eng_per' + len + '" name="eng_per[]" class="form-control eng_per"  onchange="totalIt()" placeholder="%"><INPUT type="hidden" id="eng_amt' + len + '" name="eng_amt[]" class="form-control " placeholder="0.00" readonly><INPUT type="hidden" id="com_per' + len + '" name="com_per[]" class="form-control com_per"  onchange="totalIt()" placeholder="%"><INPUT type="hidden" id="com_amt' + len + '" name="com_amt[]" class="form-control"  placeholder="0.00" readonly><td><select class="form-control" id="gst_per' + len + '" name="gst_per[]" onchange="grandtotal()" style="float:left; width: 100%" required><option value="">----- Choose GST % -----</option><option value="3">3 %</option><option value="5">5 %</option><option value="12">12 %</option><option value="18">18 %</option><option value="28">28 %</option></select><INPUT type="hidden" id="col_item' + len + '" name="col_item[]" class="form-control"  placeholder="0.00" readonly><INPUT type="hidden" id="total_item' + len + '" name="total_item[]" class="form-control" style="width:100% !important;" placeholder="0.00"></td><td><INPUT type="text" id="gst_val' + len + '" name="gst_val[]" class="form-control" onchange="grandtotal()" style="width:100% !important;" placeholder="0.00" value="0"></td><td><input type="number" style="float:left; width: 100%" class="form-control"  onchange="grandtotal()"  name="igst_per[]" id="igst_per' + len + '" placeholder="Enter IGST Percentage"></td><td ><INPUT type="text" id="igst_val' + len + '" name="igst_val[]" class="form-control" style="width:100% !important;" placeholder="0.00"></td><td><input type="number" style="float:left; width: 100%" class="form-control"  onchange="grandtotal()"  name="disc_per[]" id="disc_per' + len + '" placeholder="Enter Discount Percentage"></td><td><INPUT type="text" id="discount'+ len + '" name="discount[]" class="form-control" style="width:100% !important;" placeholder="0.00"></td><td><INPUT type="text" id="grand_total' + len + '" name="grand_total[]" class="form-control" style="width:100% !important;" placeholder="0.00" readonly></td><td><INPUT type="file"  id="image' + len + '" name="image[]" class="form-control"></td></tr>');

    }
</script>
<script>
    $(document).ready(function() {
        // Find and remove selected table rows
        $(".delete-row").click(function() {
            var row_count = $("#cost_sheett").find('input[name="chk[]"]').length;
            var checked_row_count = $('[name="chk[]"]:checked').length;

            if (row_count != checked_row_count) {
                $("#cost_sheett").find('input[name="chk[]"]').each(function() {
                    if ($(this).is(":checked")) {
                        $(this).parents("#cost_sheett tr").remove();
                    }
                });
            } else {
                alert("All rows can't be deleted");
                return false;
            }
        });



        $("form[name='fupForm']").on("submit", function(ev) {
            ev.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "qvision/Purchase_process/purchase_vendor_insert.php",
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {

                   if(result==1)
						{	
                           alert("Vendor inserted Successfully")					
						  purchase_order()
						}else{
							alert("Sorry!! Vendor Not Inserted")
							event.preventDefault();
				 
			}
                }
            });
        });
    });
</script>
<!-------Calculation Part JAVASCRIPT--------->
<script>
  function calc(idx) {
    var price = parseFloat(document.getElementById("cost" + idx).value) * parseFloat(document.getElementById("qty" + idx).value);
    var gprice = parseFloat(document.getElementById("cost" + idx).value) * parseFloat(document.getElementById("qty" + idx).value);

    //alert(idx+":"+price);  
    document.getElementById("price" + idx).value = isNaN(price) ? "0.00" : price.toFixed(2);
    document.getElementById("grand_total" + idx).value = isNaN(gprice) ? "0.00" : price.toFixed(2);
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
			   document.getElementById("total_item"+iLen).value = isNaN(sum) ? "0.00" : sum.toFixed(2);  
			   //document.getElementById("col_item").value = isNaN(sum) ? "0.00" : sum.toFixed(2);  
            }
          // alert(sum);
	
	
  }


  function totalIt() {
    var qtys = document.getElementsByName("qty[]");
    var total = 0;
	
	var qty_len=qtys.length;
	calc(qty_len);
    // for (var i = 1; i <= qtys.length; i++) {
    //   calc(i);
	//  // alert(i);
    //   var price = parseFloat(document.getElementById("price" + i).value);
    //   total += isNaN(price) ? 0 : price;
	  
    
	// }
	var gst_check = document.getElementById("gst_per" + qty_len).value;
	
	if(gst_check!=''){
		var gst_amts = parseFloat(document.getElementById("price"+ qty_len).value) *
       parseFloat(document.getElementById("gst_per"+ qty_len).value)/100;	
	  document.getElementById("gst_val"+ qty_len).value = isNaN(gst_amts) ? "0.00" : gst_amts.toFixed(2);
	}
	
	// var gst_amt = parseFloat(document.getElementById("total_item").value) *
    //    parseFloat(document.getElementById("gst_per").value)/100;	
	//   document.getElementById("gst_val").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);.

    ///document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);
	
    let gstValue = (document.getElementById("gst_val"+ qty_len).value) ? "0.00" : document.getElementById("gst_val"+ qty_len).value;
	var grand_amt = parseFloat(document.getElementById("price"+ qty_len).value) + parseFloat(gstValue);

	  document.getElementById("grand_total"+ qty_len).value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);
	
  }
  function grandtotal() {
	  var qtys = document.getElementsByName("qty[]");
     var total = 0;
	


	var i=qtys.length;

	      var gst_amt = parseFloat(document.getElementById("price"+i).value) *
       parseFloat(document.getElementById("gst_per"+i).value)/100;	   

 
	 document.getElementById("gst_val"+i).value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2); 
	 // alert("gst_val"+i);
	
	 var igst_amt = parseFloat(document.getElementById("price"+i).value) *
       parseFloat(document.getElementById("igst_per"+i).value)/100;
	document.getElementById("igst_val"+i).value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);
    
     var disc_amt = parseFloat(document.getElementById("price"+i).value) *
       parseFloat(document.getElementById("disc_per"+i).value)/100;
     document.getElementById("discount"+i).value = isNaN(disc_amt) ? "0.00" : disc_amt.toFixed(2);	   
	  
	   var grand_amt = parseFloat(document.getElementById("price"+i).value) +
       parseFloat(document.getElementById("igst_val"+i).value) + parseFloat(document.getElementById("gst_val"+i).value) - parseFloat(document.getElementById("discount"+i).value);
	  document.getElementById("grand_total"+i).value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2); 
 
  }



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

  var rowCount = 0;

  

  function deleteRow(tableID) 
  {
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
	  
	   var grand_amt = parseFloat(document.getElementById("total_item").value) +
       parseFloat(document.getElementById("gst_val").value);
	  document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);
	  
    } 
	catch (e) {
      alert(e);
    }
	


	
	
	
  }

</script>

<style>
#hidden_div2 
{
  display: none;
}
</style>