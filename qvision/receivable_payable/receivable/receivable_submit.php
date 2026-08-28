<?php
require '../../../connect.php';
if(isset($_POST['txt_org_name']) || isset($_POST['plant'])  || isset($_POST['invoice_no'])  || isset($_POST['po_copy'])
|| isset($_POST['quotation']) || isset($_POST['pay_rec'])  || isset($_POST['pay_pen']) || isset($_POST['files']) || isset($_POST['files1']) || isset($_POST['files2']))
{
	 $client_name = $_POST['txt_org_name'];
     $plant   = $_POST['plant'];
	 $invoice_no  = $_POST['invoice_no'];
	 $po_copy  = $_POST['po_copy'];
	 $quotation= $_POST['quotation'];
	 $pay_rec=$_POST['pay_rec'];
	 $pay_pen=$_POST['pay_pen'];
	 $ff1=$_FILES['files'];
	 $ff2=$_FILES['files1'];
	 $ff3=$_FILES['files2'];
	$fileName = $_FILES['files']['name'];  
	$fileName1 = $_FILES['files1']['name'];  
	$fileName2 = $_FILES['files2']['name'];  
	$uploadDir="invoice/";
	$uploadDir1="po/";
	$uploadDir2="quotation/";

                $targetFilePath = $uploadDir ."". $fileName;
					
				$targetFilePath1 = $uploadDir1 ."". $fileName1;
			    $targetFilePath2 = $uploadDir2 ."".$fileName2;
				
               
                    // Upload file to server  
                    move_uploaded_file($ff1['tmp_name'], $targetFilePath);
					move_uploaded_file($ff2['tmp_name'], $targetFilePath1);
					move_uploaded_file($ff3['tmp_name'], $targetFilePath2);
	
	$sql=$con->query("select * from receivable_payment where client_id='$client_name'");
	$sqls=$sql->fetch();
	$ssql_client=$sqls['client_id'];
	$ssql_plant=$sqls['plant_id'];
	
	if($ssql_plant==$plant){
	?>
	
	<script>  alert("Already exists");</script>
	<?php
	}else{
		
	$insert_sql=$con->query("insert into receivable_payment(client_id,plant_id,invoice_no,invoice_upload,po_copy,po_upload,quotation,quotation_upload,payment_received,payment_pending)
	values('$client_name','$plant','$invoice_no','$fileName','$po_copy','$fileName1','$quotation','$fileName2','$pay_rec','$pay_pen')");

	if($insert_sql)
	{
		echo "1";
		
	}else{
	echo "2";
	}
	}
}
?>
