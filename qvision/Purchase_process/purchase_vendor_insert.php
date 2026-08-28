<?php
require '../../connect.php';
require '../../user.php';
$candidateid = $_SESSION['candidateid'];

$uploadDir = 'files/'; 
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 

// If form is submitted 
if(isset($_POST['cost_sheet_id'])|| isset($_POST['cost_sheet_no'])|| isset($_POST['vendor'])|| isset($_POST['specification']) || isset($_POST['qty'])|| isset($_POST['cost'])|| isset($_POST['price'])|| isset($_POST['log_per'])|| isset($_POST['log_amt'])|| isset($_POST['eng_per'])|| isset($_POST['eng_amt'])|| isset($_POST['com_per'])|| isset($_POST['com_amt'])|| isset($_POST['gst_per'])|| isset($_POST['col_item'])|| isset($_POST['total_item'])|| isset($_POST['gst_val'])|| isset($_POST['igst_per'])|| isset($_POST['igst_val'])|| isset($_POST['grand_total']) || isset($_POST['disc_per']) || isset($_POST['discount'])|| isset($_POST['image'])|| isset($_POST['so_number']))
{
    $cost_sheet_id = $_POST['cost_sheet_id'];   
    $cost_sheet_no = $_POST['cost_sheet_no'];   
    $specification = $_POST['specification'];    
    $Vendor_id = $_POST['vendor']; 
    $unit = $_POST['unit']; 
    $qty = $_POST['qty'];
    $cost = $_POST['cost'];
    $price = $_POST['price'];
    $log_per = $_POST['log_per'];
    $log_amt = $_POST['log_amt'];
    $eng_per = $_POST['eng_per'];
    $eng_amt = $_POST['eng_amt'];
    $com_per = $_POST['com_per'];
    $com_amt = $_POST['com_amt'];
    $gst_per = $_POST['gst_per'];
    $col_item = $_POST['col_item'];
    $total_item = $_POST['total_item'];
    $gst_val = $_POST['gst_val'];
    $igst_per = $_POST['igst_per'];
    $igst_val = $_POST['igst_val'];
    $grand_total = $_POST['grand_total'];
    $disc_per = $_POST['disc_per'];
    $discount = $_POST['discount'];
    $so_number = $_POST['so_number'];
    $purchase_type = 2;
    $status = 1;
    $row_count= count($price);

    for($i=0;$i<$row_count;$i++)
    {
            $Vendors = $Vendor_id[$i];
            $units = $unit[$i]; 
            $qtys = $qty[$i];
			$costs = $cost[$i];
			$prices = $price[$i];
			$log_pers = $log_per[$i];
			$log_amts = $log_amt[$i];
			$eng_pers = $eng_per[$i];
			$eng_amts = $eng_amt[$i];
			$com_pers = $com_per[$i];
			$com_amts = $com_amt[$i];
			$gst_pers = $gst_per[$i];
			$col_items= $col_item[$i];
			$total_items = $total_item[$i];
			$gst_vals = $gst_val[$i];
			$igst_pers = $igst_per[$i];
			$igst_vals = $igst_val[$i];
			$grand_totals = $grand_total[$i];
			$disc_pers = $disc_per[$i];
			$discounts = $discount[$i];
              $images = $_FILES["image"]["name"][$i];
            // echo  $filename;exit;
          $tempname = $_FILES["image"]["tmp_name"][$i];    
         
          $folder = "files/".$images;
          if (move_uploaded_file($tempname, $folder))  {
                $msg = "Image uploaded successfully";
            }else{
                $msg = "Failed to upload image";
          }
    
    
     $filesArr3 = $_FILES["image"];
    
    
    /* Resume upload */
            $fileNames = array_filter($filesArr3['name']); 
                 
             
            // Upload file 
            $uploadedFile = ''; 
            if(!empty($fileNames))
            {                          
                foreach($filesArr3['name'] as $key=>$val)
                {  
                    // File upload path  
                    $fileName = basename($filesArr3['name'][$key]);  
                    $targetFilePath = $uploadDir . $fileName;  
                      
                    // Check whether file type is valid  
                     $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);  
                    
                        // Upload file to server  
                        if(move_uploaded_file($filesArr3["tmp_name"][$key], $targetFilePath)){  
                            $uploadedFile .= $fileName; 
                         
                    }
                }  
            }    
        
  /* 	$stmt = $con->prepare("SELECT COUNT(*) as count FROM purchase_vendor_master where so_number='$so_number' and (purchase_type='2' or purchase_type='1') and specification='$specification'");
	echo "SELECT COUNT(*) as count FROM purchase_vendor_master where so_number='$so_number' and (purchase_type='2' or purchase_type='1') and specification='$specification'";
	$stmt->execute(); 
     $row = $stmt->fetch();
	 $count=$row['count'];
echo$count;

if($count==0)
{       */
    
         $insert_query=$con->query("insert into purchase_vendor_master(cost_sheet_id,cost_sheet_no,so_number,purchase_type,specification,
		 vendor_id,unit,unit_qty,unit_cost,price,gst_per,gst_val,igst_per,igst_val,grand_total,disc_per,discount,upload,status) 
      values('$cost_sheet_id','$cost_sheet_no','$so_number','$purchase_type','$specification','$Vendors','$units','$qtys','$costs','$prices','$gst_pers','$gst_vals','$igst_pers','$igst_vals','$grand_totals','$disc_pers','$discounts','$images',$status)");
      
/* echo "insert into purchase_vendor_master(cost_sheet_id,cost_sheet_no,so_number,purchase_type,specification,
		 vendor_id,warrenty,unit_qty,unit_cost,price,gst_per,gst_val,igst_per,igst_val,grand_total,upload,status) 
      values('$cost_sheet_id','$cost_sheet_no','$so_number','$purchase_type','$specification','$Vendors','$Warrentys','$qtys','$costs','$prices','$gst_pers','$gst_vals','$igst_pers','$igst_vals','$grand_totals','$images',$status)"; */
	  
    /* }else{
		echo"2";*/
		
		
	}
if($insert_query){
	echo"1";
}else{
	echo"2";
}	
	}


 

?>