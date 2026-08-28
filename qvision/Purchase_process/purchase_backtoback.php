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
      <font size="4"><b>Back to Back-Details</b></font>
    </h2>

    <a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
  </div>
  <form id="fupForm" method="POST" name="purchase" id="purchase">
    <table class="table table-bordered table-striped">
      <th>PRODUCT</th>
      <th>PRODUCT DESCRIPTION</th>
      <th>QTY</th>

      <!-- <th>UNIT</th> -->

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
        $cost_id = $dis['cost_sheet_no'];

        ?>
        <tr>
          <td>
            <input type="hidden" id="cost_sheet_id" name="cost_sheet_id" class="form-control" value="<?php echo $dis['id']; ?>" readonly="readonly">
            <input type="hidden" id="cost_sheet_no" name="cost_sheet_no" class="form-control" value="<?php echo $cost_id; ?>" readonly="readonly">
            <input type="hidden" id="specification" name="specification" class="form-control" value="<?php echo $dis['specification']; ?>" readonly="readonly">

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
        $sonum = $con->query("select id,so_number,cost_sheet_no from po_generate where cost_sheet_no='$cost_id'");

        $sonums = $sonum->fetch();


        $cost1 = $con->query("select sum(gst_amt + total_price ) as netAmnt from cost_sheet_entry where id='$cs_no'");
        $cfet = $cost1->fetch(); ?>
        <tr>
          <input type="hidden" id="so_number" name="so_number" class="form-control" value="<?php echo $sonums['so_number']; ?>" readonly="readonly">
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

    <div class="table-responsive" style=" max-height:300px;">
      <table id="new_tab" border="1" style="width:1500px;border-collapse:collapse;margin-bottom: 0px !important;overflow-x:auto!important" class="table table-striped table-bordered table-hover display nowrap">
        <tbody id="cost_sheett">

          <tr>
            <th>VENDOR</th>
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
            <!-- <th>Upload</th>   -->
          </tr>
          <tr>
            <td>
              <select class="form-control" id="vendor_name" name="vendor_name">
                <option value="">Choose Type</option>
                <?php $stmt = $con->query("SELECT * FROM doller_vendor_mastor ");
                while ($row = $stmt->fetch()) { ?>
                  <option value="<?php echo $row['id']; ?>"> <?php echo $row['vendor_name']; ?> </option>
                <?php } ?>
              </select>
            </td>
            <td><input type="text" name="unit" id="unit" class="form-control"></td>
            <td>
              <input type="text" id="qty1" name="qty[]" onchange="totalIt();grandtotal();" class="form-control" value="<?php echo $dis['qty']; ?>" readonly>
            </td>
            </td>

            <td>
              <input type="text" id="cost1" name="cost[]" onchange="totalIt();grandtotal();" class="form-control" value="<?php echo $dis['unit_rate']; ?>">
            </td>
            <td>
              <input type="text" id="price1" name="price[]" onchange="totalIt()" class="form-control" value="<?php echo $dis['total_price']; ?>" readonly>
            </td>

            <input type="hidden" id="log_per1" name="log_per[]" class="form-control log_per " onchange="totalIt()" placeholder="%">


            <input type="hidden" id="log_amt1" name="log_amt[]" class="form-control" placeholder="0.00" readonly>


            <INPUT type="hidden" id="eng_per1" name="eng_per[]" class="form-control eng_per" onchange="totalIt()" placeholder="%">


            <INPUT type="hidden" id="eng_amt1" name="eng_amt[]" class="form-control " placeholder="0.00" readonly>



            <INPUT type="hidden" id="com_per1" name="com_per[]" class="form-control com_per" onchange="totalIt()" placeholder="%">


            <INPUT type="hidden" id="com_amt1" name="com_amt[]" class="form-control" placeholder="0.00" readonly>


            <td>
              <input type="text" id="gst_per" name="gst_per" onchange="totalIt();grandtotal();" class="form-control" value="<?php echo $dis['gst_per']; ?>" readonly>
              <!-- <select class="form-control" id="gst_per" name="gst_per" onchange="grandtotal()" style="float:left; width: 100%" required>
			          <option value="">----- Choose GST % -----</option>
			          <option value="3">3 %</option>
			          <option value="5">5 %</option>
			          <option value="12">12 %</option>
			          <option value="18">18 %</option>
			          <option value="28">28 %</option>
		           </select> -->
              <INPUT type="hidden" id="col_item1" name="col_item[]" class="form-control" placeholder="0.00" readonly>
              <INPUT type="hidden" id="total_item" name="total_item" class="form-control" style="width:100% !important;" placeholder="0.00">
            </td>

            <td>
              <INPUT type="text" id="gst_val" name="gst_val" class="form-control" onchange="grandtotal()" style="width:100% !important;" value="<?php echo $dis['gst_amt']; ?>" readonly>
            </td>

            <td>
              <input type="number" style="float:left; width: 100%" class="form-control" onchange="grandtotal()" name="igst_per" id="igst_per" value="<?php echo $dis['igst_per']; ?>" readonly>
            </td>
            <td>
              <INPUT type="text" id="igst_val" name="igst_val" class="form-control" style="width:100% !important;" value="<?php echo $dis['igst_amount']; ?>" readonly>
            </td>

            <td>
              <input type="number" style="float:left; width: 100%" class="form-control" onchange="calcdiscnt()" name="disc_per" id="disc_per" placeholder="Enter Discount Percentage">
              <!-- onchange="grandtotal()" -->
            </td>
            <td>
              <INPUT type="text" id="discount" name="discount" class="form-control" style="width:100% !important;" placeholder="0.00">
            </td>

            <td>
              <INPUT type="text" id="grand_total" name="grand_total" class="form-control" style="width:100% !important;" value="<?php echo $cfet['netAmnt']; ?>" readonly>
            </td>

            <!-- <td>
		         <INPUT type="file" id="image1" name="image[]" class="form-control">
		     </td> -->

          </tr>
          <td colspan="6">
            <input type="submit" name="submit" id="submit" class="btn btn-success submitBtn" style="float: right;" value="SAVE">
          </td>
        </tbody>
      </table>
    </div>
    </table>
  </form>
</div>
<script>
  function back() {
    let id = $('#po_generate_id').val();
    purchse_order_edit(id)
    //purchase_order()
  }
</script>
<script>
  $(document).ready(function(e) {

    // Submit form data via Ajax
    $("#fupForm").on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: 'qvision/Purchase_process/purchase_back_insert.php',
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
          $('.submitBtn').attr("disabled", "disabled");
          $('#fupForm').css("opacity", ".5");
        },
        success: function(response) { //console.log(response);
          if (response == 1) {
            alert('Vendor Inserted successfully');
            purchase_order();
          } else if (response == 2) {
            alert("Vendor Already Inserted");
            purchase_order()
          } else {
            alert("Vendor Failed to Insert");
            purchase_order()
          }
        }
      });
    });
  });

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
</script>

<!-------Calculation Part JAVASCRIPT--------->
<script>
  function calc(idx) {
    var price = parseFloat(document.getElementById("cost" + idx).value) * parseFloat(document.getElementById("qty" + idx).value);

    //alert(idx+":"+price);  
    document.getElementById("price" + idx).value = isNaN(price) ? "0.00" : price.toFixed(2);
    //document.getElementById("total") = totalIt;


    var log_amt = parseFloat(document.getElementById("price" + idx).value) * parseFloat(document.getElementById("log_per" + idx).value) / 100;
    document.getElementById("log_amt" + idx).value = isNaN(log_amt) ? "0.00" : log_amt.toFixed(2);

    var eng_amt = parseFloat(document.getElementById("price" + idx).value) * parseFloat(document.getElementById("eng_per" + idx).value) / 100;
    document.getElementById("eng_amt" + idx).value = isNaN(eng_amt) ? "0.00" : eng_amt.toFixed(2);

    var com_amt = parseFloat(document.getElementById("price" + idx).value) * parseFloat(document.getElementById("com_per" + idx).value) / 100;
    document.getElementById("com_amt" + idx).value = isNaN(com_amt) ? "0.00" : com_amt.toFixed(2);


    var tol_price = parseFloat(document.getElementById("price" + idx).value);
    var log_amt = parseFloat(document.getElementById("log_amt" + idx).value);
    var eng_amt = parseFloat(document.getElementById("eng_amt" + idx).value);
    var com_amt = parseFloat(document.getElementById("com_amt" + idx).value);


    var items_total = tol_price + log_amt + eng_amt + com_amt;
    //alert(items_total);
    //$('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));

    document.getElementById("col_item" + idx).value = isNaN(items_total) ? "0.00" : items_total.toFixed(2);


    var sum = 0;
    var value = "";
    var names = document.getElementsByName('col_item[]');
    var sum = 0;
    for (var i = 0, iLen = names.length; i < iLen; i++) {

      //calc(i);
      sum += +names[i].value;
      document.getElementById("total_item").value = isNaN(sum) ? "0.00" : sum.toFixed(2);
      //document.getElementById("col_item").value = isNaN(sum) ? "0.00" : sum.toFixed(2);  
    }
    // alert(sum);


  }


  function totalIt() {

    var qtys = document.getElementsByName("qty[]");
    var total = 0;

    var qty_len = qtys.length;

    for (var i = 1; i <= qtys.length; i++) {
      calc(i);
      // alert(i);
      var price = parseFloat(document.getElementById("price" + i).value);
      total += isNaN(price) ? 0 : price;

    }

    var gst_check = document.getElementById("gst_per").value;

    if (gst_check != '') {
      var gst_amts = parseFloat(document.getElementById("total_item").value) *
        parseFloat(document.getElementById("gst_per").value) / 100;
      document.getElementById("gst_val").value = isNaN(gst_amts) ? "0.00" : gst_amts.toFixed(2);
    }

    var gst_amt = parseFloat(document.getElementById("total_item").value) *
      parseFloat(document.getElementById("gst_per").value) / 100;
    document.getElementById("gst_val").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);
    ///document.getElementById("total").value = isNaN(total) ? "0.00" : total.toFixed(2);

    var grand_amt = parseFloat(document.getElementById("total_item").value) +
      parseFloat(document.getElementById("gst_val").value);
    document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);

  }

  function grandtotal() {

    var gst_amt = parseFloat(document.getElementById("total_item").value) *
      parseFloat(document.getElementById("gst_per").value) / 100;

    document.getElementById("gst_val").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);


    var igst_amt = parseFloat(document.getElementById("total_item").value) *
      parseFloat(document.getElementById("igst_per").value) / 100;
    document.getElementById("igst_val").value = isNaN(igst_amt) ? "0.00" : igst_amt.toFixed(2);

    var disc_amt = parseFloat(document.getElementById("total_item").value) *
      parseFloat(document.getElementById("disc_per").value) / 100;
    document.getElementById("discount").value = isNaN(disc_amt) ? "0.00" : disc_amt.toFixed(2);

    var grand_amt = parseFloat(document.getElementById("total_item").value) +
      parseFloat(document.getElementById("igst_val").value) + parseFloat(document.getElementById("gst_val").value) - parseFloat(document.getElementById("discount").value);
    document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);
  }

  function calcdiscnt() {
    let totalAmt = parseFloat(document.getElementById("price1").value) +
      parseFloat(document.getElementById("gst_val").value) + parseFloat(document.getElementById("igst_val").value);

    let disc_amt = parseFloat(totalAmt) * parseFloat(document.getElementById("disc_per").value) / 100;
    document.getElementById("discount").value = isNaN(disc_amt) ? "0.00" : disc_amt.toFixed(2);

    let grandAmt = parseFloat(totalAmt) - parseFloat(disc_amt);
    document.getElementById("grand_total").value = isNaN(grandAmt) ? "0.00" : grandAmt.toFixed(2);

  }



  $('.log_per').keyup(function() {


    var margin_amt = parseFloat(document.getElementById("total_item").value) * parseFloat(document.getElementById("log_per").value) / 100;
    //var margin_amt = parseFloat(document.getElementById("total_item").value);
    //alert(margin_amt)
    //alert(idx+":"+margin_amt);  

    $('#log_amt').val(isNaN(margin_amt) ? "0.00" : margin_amt.toFixed(2));
    //cclculation _changes-items wise
    var total_amt = parseFloat(document.getElementById("total_item").value);
    var log_amt = parseFloat(document.getElementById("log_amt").value);

    //alert(total_amt);
    //alert(log_amt);
    var items_total = total_amt + log_amt;
    //alert(items_total);
    $('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));

  });

  $('.eng_per').keyup(function() {


    var margin_amt = parseFloat(document.getElementById("total_item").value) * parseFloat(document.getElementById("eng_per").value) / 100;
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
    var items_total = total_amt + log_amt + eng_amt;
    //alert(items_total);
    $('#col_item').val(isNaN(items_total) ? "0.00" : items_total.toFixed(2));
    //cclculation _changes-items wise end


    var total_amt = parseFloat(document.getElementById("total_item").value);
    var log_amt = parseFloat(document.getElementById("log_amt").value);
    var eng_amt = parseFloat(document.getElementById("eng_amt").value);

    var log_eng_total = total_amt + log_amt + eng_amt;
    $('#log_eng_total').val(isNaN(log_eng_total) ? "0.00" : log_eng_total.toFixed(2));
    //$('#grand_total').val(isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2));
  });

  $('.com_per').keyup(function() {

    var margin_amt = parseFloat(document.getElementById("total_item").value) * parseFloat(document.getElementById("com_per").value) / 100;
    $('#com_amt').val(isNaN(margin_amt) ? "0.00" : margin_amt.toFixed(2));


    //cclculation _changes-items wise
    var total_amt = parseFloat(document.getElementById("total_item").value);
    var log_amt = parseFloat(document.getElementById("log_amt").value);
    var eng_amt = parseFloat(document.getElementById("eng_amt").value);
    var com_amt = parseFloat(document.getElementById("com_amt").value);

    var items_total = total_amt + log_amt + eng_amt + com_amt;
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


    var grand_amt = total_amt + com_amt + log_amt + eng_amt;
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
      for (var j = 1; j < tabCount; j++) {
        var tota = $('#col_item' + j).val();
        var tot1 = parseFloat(tota);
        //alert(tot1);
        if (isNaN(tot1)) tot1 = 0.00;
        //alert('#col_item' + j);
        finalamount = finalamount + tot1;
        var finalamount1 = parseFloat(finalamount).toFixed(2);

      }
      //alert(finalamount1); 
      $('#total_item').val(finalamount1);
      //gst and grad total calculation
      var gst_amt = parseFloat(document.getElementById("total_item").value) *
        parseFloat(document.getElementById("gst_per").value) / 100;
      document.getElementById("gst_val").value = isNaN(gst_amt) ? "0.00" : gst_amt.toFixed(2);

      var grand_amt = parseFloat(document.getElementById("total_item").value) +
        parseFloat(document.getElementById("gst_val").value);
      document.getElementById("grand_total").value = isNaN(grand_amt) ? "0.00" : grand_amt.toFixed(2);

    } catch (e) {
      alert(e);
    }






  }
</script>

<style>
  #hidden_div2 {
    display: none;
  }
</style>