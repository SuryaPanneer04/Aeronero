<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];

$client_id=$_REQUEST['client'];
$plant_id=$_REQUEST['plant'];

$sql=$con->query("SELECT r.*,c.org_name,p.location from receivable_payment r left join new_client_master  c on c.id=r.client_id left join new_plant_master p on p.id=r.plant_id where r.client_id='$client_id' and r.plant_id='$plant_id'");
$sqls=$sql->fetch();
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
	 <a onclick="back()" style="float: right;background-color:black;border:1px solid black;color:white;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-minus"></i>BACK</a>
	 <form method="POST" name="fupForms" id="fupForms">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td colspan="6"><center><b>Receivable Payment</b></center></td>
        </tr>
        <tr>
        <td>Client Name</td>
        <td colspan="5">
		<input type="text" class="form-control" id="invoice_no" name="invoice_no"  value="<?php echo $sqls['org_name'];?>" readonly></td>
		</td>
        </tr>
        <tr>
        <td>Plant Location</td>
        <td colspan="5">
		<input type="text" class="form-control" id="plant" name="plant"  value="<?php echo $sqls['location'];?>" readonly>
		</td>
        </tr>
        
	    <tr>
        <td>Invoice Number</td>
		<td colspan="4"><input type="text" class="form-control" id="invoice_no" name="invoice_no"  value="<?php echo $sqls['invoice_no'];?>" readonly></td>
		</tr>
		<tr>
		<td>Invoice Document</td>
        <td colspan="4">
		<a href="qvision/receivable_payable/receivable/invoice/<?php echo $sqls['invoice_upload']; ?>" download="<?php echo $sqls['invoice_upload']; ?>"><?php echo $sqls['invoice_upload']; ?></a>
             
		</td>
        </tr>
		<tr>
        <td>PO Copy</td>
        <td colspan="4">
		<input type="text" class="form-control" id="po_copy" name="po_copy" value="<?php echo $sqls['po_copy'];?>" readonly>
		</td>
		</tr>
		<tr>
		<td>PO Document</td>
	   
        <td colspan="4">
			<a href="qvision/receivable_payable/receivable/po/<?php echo $sqls['po_upload']; ?>" download="<?php echo $sqls['po_upload']; ?>"><?php echo $sqls['po_upload']; ?></a>
     
		</td>
	   </tr>
	   
	   <tr>
        <td>Quotation</td>
        <td colspan="4"><input type="text" class="form-control" id="quotation" name="quotation" value="<?php echo $sqls['quotation'];?>" readonly></td>
		</tr>
		<tr>
		<td>Quotation Document</td>
        <td colspan="4">
		<a href="qvision/receivable_payable/receivable/quotation/<?php echo $sqls['quotation_upload']; ?>" download="<?php echo $sqls['quotation_upload']; ?>"><?php echo $sqls['quotation_upload']; ?></a>
		</td>
		</tr>
		<tr>
        <td>Payment Received</td>
        <td colspan="5">
		<input type="text" class="form-control" id="pay_rec" name="pay_rec" value="<?php echo $sqls['payment_received'];?>" readonly></td>
        </tr>
	  	<tr>
        <td>Payment Pending</td>
        <td colspan="5"><input type="text" class="form-control" id="pay_pen" name="pay_pen" value="<?php echo $sqls['payment_pending'];?>" readonly></td>
        </tr>
        
        </table>
        <!-- /.post -->
    </form>
    </div>
	<form method="POST" name="fupForm" id="fupForm">
    <!-- Post -->
    <table class="table table-bordered">
        <tr>
        <td colspan="6"><center><b>Payment Pending</b></center></td>
        </tr>
        <tr>
		<input type="hidden" name="client_id" id="client_id" value="<?php echo $sqls['client_id'];?>" />
		<input type="hidden" name="plant_id" id="plant_id" value="<?php echo $sqls['plant_id'];?>" />
        <td>Amount</td>
        <td colspan="5">
		<input type="text" class="form-control" id="amount" name="amount" onblur="validateamount()"></td>
        </tr>
        <tr>
        <td>Bank</td>
        <td colspan="5">
		<input type="text" class="form-control" id="bank" name="bank"  />
		</td>
        </tr>
        
	    <tr>
        <td>Source</td>
		<td colspan="5"><input type="text" class="form-control" id="source" name="source" /></td>
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
                 url:"qvision/receivable_payable/receivable/pending_submit.php",
                method:"POST",  
                data:formData, 
				cache: false,
				contentType: false,
				processData: false,
                success:function(data)  
                {  
                    alert('Entry Successfully'); 
                     receivable_list()

                }  
           });  
      });  
	   });  
	   
</script>
<script>
function validateamount(v){
	
		var pay_pen=Number(document.getElementById("pay_pen").value);
		var amount=Number(document.getElementById("amount").value);
		if(amount > pay_pen){
			alert("Your amount is greater than pending amount..");
						$('#amount').val('')

		}
		else{
			alert("Now you are paying Rs" +amount);
		}
	
	
}
</script>
<script>
		function back()
    {
   receivable_list()
  }
  </script>
	



