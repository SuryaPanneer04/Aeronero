<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];

?>

<div class="card card-primary">
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="card">

<div class="card-body">
<div class="tab-content">
    <div class="active tab-pane" id="for_employment">
	
	 <form method="POST" name="fupForm" id="fupForm" enctype="multipart/form-data">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td colspan="6"><center><b>Payable Payment</b></center></td>
        </tr>
        <tr>
        <td>Vendor Name</td>
        <td colspan="5">
		<select required aria-required="true" class="form-control" id="vendor_name" name="vendor_name"> 
			<option value="">Choose Vendor Name</option>
			<?php $stmt3 = $con->query("SELECT * FROM doller_vendor_mastor");
			while ($row3 = $stmt3->fetch()) { ?>
			<option value="<?php echo $row3['id']; ?>"> <?php echo $row3['vendor_name']; ?></option>
			<?php }  ?>
		</select>
		</td>
        </tr>
       
        
	    <tr>
        <td>Invoice Number</td>
		<td colspan="4"><input type="text" class="form-control" id="invoice_no" name="invoice_no"  ></td>
        <td colspan="4"><input type="file" class="form-control file" id="file" name="files"  /></td>
        </tr>
		<tr>
        <td>PO Copy</td>
        <td colspan="4"><input type="text" class="form-control" id="po_copy" name="po_copy"></td>
        <td colspan="4"><input type="file" class="form-control file" id="file1" name="files1"  /></td>
	   </tr>
	   
	   <tr>
        <td>Quotation</td>
        <td colspan="4"><input type="text" class="form-control" id="quotation" name="quotation"></td>
        <td colspan="4"><input type="file" class="form-control file" id="file2" name="files2" /></td>
		</tr>
		<tr>
        <td>Payment Paid</td>
        <td colspan="5"><input type="text" class="form-control" id="pay_rec" name="pay_rec"></td>
        </tr>
	  	<tr>
        <td>Payment Pending</td>
        <td colspan="5"><input type="text" class="form-control" id="pay_pen" name="pay_pen"></td>
        </tr>
        <tr>  
        <td colspan="6"> 
		<input type="submit" name="submit" class="btn btn-success submitBtn" value="SUBMIT"/>
		</td>
		</tr>

        </table>
        <!-- /.post -->
    </form>
    </div>
	

    </div>
    <!-- /.tab-content -->
    </div><!-- /.card-body -->
    </div>
    <!-- /.nav-tabs-custom -->
    
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div><!-- /.container-fluid -->
    </section>
	</div>
	
<script>
$(document).ready(function(){  
		$("form[name='fupForm']").on("submit", function(ev) {
		 ev.preventDefault();
		var formData = new FormData(this);
  
           $.ajax({  
                 url:"qvision/receivable_payable/payable/payable_submit.php",
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Entry Successfully'); 
                  payable_list()
				  //calls()
                }  
           });  
      });  
	   });  
	   
		
</script>

	
	



