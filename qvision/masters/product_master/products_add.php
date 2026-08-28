<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
?>
<div class="card card-info">
    <div class="card-header" style="background-color:#ff8b3d;">

        <center>
            <h3 class="card-title"><b>PRODUCTS ADD</b></h3>
        </center>
        <a onclick="back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>
    </div>

    <form method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
        <table class="table table-bordered">
            <tr>
               
            </tr>
            <tr>
                <td>Product ID</td>
                <td colspan="2"><input type="text" class="form-control" id="product_id" name="product_id" placeholder="Enter Product ID" required></td>
				<td>Product Name</td>
				 <td colspan="2">
                    <select required aria-required="true" class="form-control" name="product_name" id="product_name" required>
                       <option disabled selected>-- Select Product Name--</option>
						<?php
								$stmt2 = $con->prepare("SELECT Product_id,Product_name FROM products_master");		
								$stmt2->execute(); 										
								while($row2 = $stmt2->fetch()){
						?>
					<option value="<?php echo $row2['Product_name']; ?>"><?php echo $row2['Product_name']; ?></option>
						<?php 
							}
						?>
                    </select>
                </td>
                
               
            </tr>
            <tr>
			 <td>Model Name</td>
               <td colspan="2"><input type="text" class="form-control" id="model_name" name="model_name" placeholder="Enter Model Name" required></td>
                
               
			 <td>Product Type</td>
                <td colspan="2">
                    <select required aria-required="true" class="form-control" name="product_type" id="product_type" required>
                        <option value="">Select Type</option>
                        <option value="1">It Asset</option>
                        <option value="2">Non It Asset</option>
                    </select>
                </td>
                
               
            </tr>
            <tr>
			<td>Description</td>
			<td colspan="5"><textarea id="description" name="description" class="form-control"  style="height:50px"></textarea> </td>
			<td>HSN Code</td>
                <td colspan="2"><input type="text" class="form-control" id="hsn_code" name="hsn_code" placeholder="Enter HSN Code" required></td>
            </tr>
            <tr>
			
			 <td>GST Code</td>
                <td colspan="2"><input type="text" class="form-control" id="gst_code" name="gst_code" placeholder="Enter GST Code" required></td>
			 <td>Status*</td>
                <td colspan="2">
                    <select required aria-required="true" class="form-control" name="statusz" id="statusz" required>
                        <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="2">InActive</option>
                    </select>
                </td>
            </tr>

        </table>
        <div style="text-align:left;">
            <input type="button" name="save" value="SAVE" onclick="products_insert(event)" class="btn btn-primary btn-md">
            <br />
        </div>
    </form>
</div>
<script>
    function back_ctc() {
        Product_master()
    }
</script>
<script>
    function products_insert(event) {

        var data = $('form').serialize();
		var product_id = document.getElementById("product_id").value;
        if (product_id == '') {
            alert("Please Enter Product ID")
            event.preventDefault();
        }
var description = document.getElementById("description").value;
        if (product_id == '') {
            alert("Please Enter description")
            return false;
        } 		
        var product_name = document.getElementById("product_name").value;
        if (product_name == '') {
            alert("Please Enter Product Name")
            event.preventDefault();
        } else {
            var hsn_code = document.getElementById("hsn_code").value;
            if (hsn_code == '') {
                alert("Please Enter HSN Code")
                event.preventDefault();
            } else {
                var product_type = document.getElementById("product_type").value;
                if (product_type == '') {
                    alert("Please Select Product Type")
                    event.preventDefault();
                } else {
                    var status = document.getElementById("statusz").value;
                    if (status == '') {
                        alert("Please Select Status")
                        event.preventDefault();
                    } else {
                        $.ajax({
                            type: 'GET',
                            data: data,
                            url: "qvision/masters/product_master/products_submit.php",
                            success: function(result) {
                                //alert(result)
                                if (result == '1') {
                                    alert("Product Added Successfully")
                                    product_master()
                                } else {
                                    event.preventDefault();

                                }


                            }
                        });

                    }
                }
            }
        }
    }
</script>