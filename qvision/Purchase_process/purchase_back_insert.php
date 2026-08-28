<?php
require '../../connect.php';
require '../../user.php';
$candidateid = $_SESSION['candidateid'];
$uploadDir = 'files/'; 

if (
    isset($_POST['cost_sheet_id']) || isset($_POST['cost_sheet_no']) || isset($_POST['vendor_name'])  || isset($_POST['qty'])
|| isset($_POST['cost']) || isset($_POST['price']) || isset($_POST['gst_per']) || isset($_POST['gst_val']) || isset($_POST['igst_per']) || isset($_POST['igst_val']) || isset($_POST['grand_total'])|| isset($_POST['disc_per']) || isset($_POST['discount']) || isset($_POST['so_number']) || isset($_POST['specification'])
) {


    $cs_id = $_POST['cost_sheet_id'];
    $cs_number = $_POST['cost_sheet_no'];
    $vendor_name = $_POST['vendor_name'];
    $unit = $_POST['unit']; 
    $unit_qty = $_POST['qty'];
    $unit_cost = $_POST['cost'];
    $price = $_POST['price'];
	$row_count= count($price);
    $gst_per = $_POST['gst_per'];
    $gst_val = $_POST['gst_val'];
    $igst_per = $_POST['igst_per'];
    $igst_val = $_POST['igst_val'];
    $grand_total = $_POST['grand_total'];
    $disc_per = $_POST['disc_per'];
    $discount = $_POST['discount'];
    $so_number = $_POST['so_number'];
    $specification = $_POST['specification'];
    $purchase_type = 1;
    $status = 2;

	    for($i=0;$i<$row_count;$i++)
    {
         $unit_qtys           = $unit_qty[$i];
         $unit_costs     = $unit_cost[$i];
         $prices     = $price[$i];
            //   $filesArr3 = $_FILES["image"];


/* Resume upload */
		// $fileNames = array_filter($filesArr3['name']); 
			 
         
        // // Upload file 
        // $uploadedFile = ''; 
        // if(!empty($fileNames))
		// {                          
        //     foreach($filesArr3['name'] as $key=>$val)
		// 	{  
        //         // File upload path  
        //         $fileName = basename($filesArr3['name'][$key]);  
        //         $targetFilePath = $uploadDir . $fileName;  
                  
        //         // Check whether file type is valid  
        //          $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                
        //             // Upload file to server  
        //             if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
        //                 $uploadedFile .= $fileName; 
                     
        //         }
        //     }  
        // }  

	$stmt = $con->prepare("SELECT COUNT(*) as count FROM purchase_vendor_master where so_number='$so_number' and (purchase_type='2' or purchase_type='1') and specification='$specification'");
	//echo "SELECT COUNT(*) as count FROM purchase_vendor_master where so_number='$so_number' and purchase_type='2' or '1' and specification='$specification'";
	$stmt->execute(); 
     $row = $stmt->fetch();
	 $count=$row['count'];


if($count==0)
{
    $sql = $con->query("insert into purchase_vendor_master(cost_sheet_id,cost_sheet_no,so_number,purchase_type,specification, vendor_id,unit,unit_qty,unit_cost,price,gst_per,gst_val,igst_per,igst_val,grand_total,disc_per,discount,status)
	values('$cs_id','$cs_number','$so_number','$purchase_type','$specification','$vendor_name','$unit','$unit_qtys','$unit_costs','$prices','$gst_per','$gst_val','$igst_per','$igst_val','$grand_total','$disc_per','$discount','$status')");
	
	/* echo "insert into purchase_vendor_master(cost_sheet_id,cost_sheet_no,so_number,purchase_type,specification, vendor_id,warrenty,unit_qty,unit_cost,price,gst_per,gst_val,igst_per,igst_val,grand_total,upload,status)
	values('$cs_id','$cs_number','$so_number','$purchase_type','$specification','$vendor_name','$warrenty','$unit_qtys','$unit_costs','$prices','$gst_per','$gst_val','$igst_per','$igst_val','$grand_total','$uploadedFile','$status')"; */

echo"1";
    //echo "insert into purchase_vendor_master(cost_sheet_id,so_number,purchase_type,specification, vendor_id,warrenty,price,upload,status) values('$cs_id','$so_number','$purchase_type','$specification','$vendor_name','$warrenty','$price','$filename','$status')";
}else{
	
	echo "2";
}
}
}
