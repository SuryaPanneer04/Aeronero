<?php
require '../../../connect.php';
require '../../../user.php';
$user_id =$_SESSION['userid'];

/*  $max_quote ="SELECT * FROM quotation_entry ORDER BY id DESC";
 $query = $con->query($max_quote);
 $number = $query->fetch_assoc();


 if (!empty($number['quote_no'])) {
	
    print_r($splite_val = explode("-",$number['quote_no'])); 	
	echo $no   =  $splite_val [0];
	echo $char =  $splite_val [1];
	
  // $result = preg_split('/[-_]/', $number);
  $find_f = substr($number['quote_no'], 0, 7);
  $find_fs = substr($number['quote_no'], 0, 4);
  // echo "<pre>";  print_r($find_f);  exit;
  if($find_f=="QUAD626"){
    $last_bill_no = substr($number['Case_Number'], -8);
    
  }
  
  
   $quote1= ++$no;
   $quote2= ++$char;
   
   $case_number=$quote1 .$quote1;
      }else{
			$d = '1001-Z';
			for ($n=0; $n<26; $n++) {
			echo ++$d . PHP_EOL;
			}

      }
 */

/* $d = '1001-Z';
for ($n=0; $n<26; $n++) {
    echo ++$d . PHP_EOL;
} */
//Quote No Generated  Here
$row_query = "SELECT * FROM quotation_entry ";

 $query = $con->query($row_query);
 $query->execute();
 $count = $query->rowCount();

 $row_val = $query->fetch();
 
if($count == 0)
{   
    $char = 'QOT';
	$month =01;
	$current_month = date('m');
	if ($current_month >= '01' && $current_month < '04'){

	if ($month >= '01' && $month < '04'){
	   $nextyear = substr(date('Y'),-2);
	} 

	if ($month >= '04'){
	   $nextyear = substr(date('Y')-1,-2);
	}
	} 

	if ($current_month >= '04'){
	if ($month >= '04'){
	   $nextyear = substr(date('Y'),-2);
	}

	if ($month < '04'){
	   $nextyear = substr(date('Y')+1,-2);
	}
	}

	 $nextyear; 
	//current year
	 $curyear = substr(date('Y'),-2); echo "<br/>";
	 $finyear = $curyear.'-'.$nextyear; echo "<br/>";
	$char_str = 'A';
	//for($n=0; $n<26; $n++) {
       //echo +$char_str;
    //}
    $seq = 00001;
    $quoteno = sprintf("%05d", $seq);
    echo  $QUOTE_NO = $char.''.$finyear.''.$quoteno.'/'.$char_str;
	
}else{	 
$row_query = "SELECT * FROM quotation_entry ORDER BY id DESC ";

 $query2 = $con->query($row_query);
 $query2->execute();
 $count = $query2->rowCount();
 $row = $query2->fetch();
 //echo $row['quote_no'];
	 if (!empty($row['quote_no'])) {
		
		$splite_val = explode("/",$row['quote_no']); 	
		 $no   =  $splite_val [0];
		 //echo $char =  $splite_val [1];
		 echo $char = 'A';
		
	  // $result = preg_split('/[-_]/', $number);
	  $find_f = substr($row['quote_no'], 0, 7);echo "<br/>";
	  $find_fs = substr($row['quote_no'], 7, 5);echo "<br/>";
	  
	 // echo  $a = sprintf("%05d", $find_fs);echo "<br/>";
	  $final_quote_no = str_pad($find_fs + 1, 5, 0, STR_PAD_LEFT);echo "<br/>";
	  //echo $last_quote_no = $find_fs;echo "<br/>";
	 //echo  $final_quote_no = ++$final_no;echo "<br/>";
     echo $QUOTE_NO = $find_f .$final_quote_no.'/'.$char;
	 } 
}

// ... (Mela iruka Quote Generation logic apdiye irukatum, flow matha venam) ...

// Array error avoid panna isset() use pandrom
$specification = isset($_REQUEST['item']) ? $_REQUEST['item'] : []; 
$row_count   = count($specification);
$qty         = isset($_REQUEST['qty']) ? $_REQUEST['qty'] : [];
$unit        = isset($_REQUEST['unit']) ? $_REQUEST['unit'] : [];
$unit_rate   = isset($_REQUEST['cost']) ? $_REQUEST['cost'] : [];
$total       = isset($_REQUEST['price']) ? $_REQUEST['price'] : [];
$gst         = isset($_REQUEST['gst']) ? $_REQUEST['gst'] : 0;

// DB Integers-ku empty string ponal crash aagum, so 0 set pandrom
$client_id      = !empty($_REQUEST['client_id']) ? $_REQUEST['client_id'] : 0;
$company_id     = !empty($_REQUEST['company_id']) ? $_REQUEST['company_id'] : 0;
$cost_sheet_id  = !empty($_REQUEST['cost_sheet_id']) ? $_REQUEST['cost_sheet_id'] : 0;
$quote_date_str = !empty($_REQUEST['quote_date']) ? $_REQUEST['quote_date'] : date('d-m-Y');

$quote_date = date('Y-m-d', strtotime($quote_date_str));

$quote_type    = !empty($_REQUEST['quote_type']) ? $_REQUEST['quote_type'] : '';
$business_id   = !empty($_REQUEST['mapping_id']) ? $_REQUEST['mapping_id'] : 0;
$candid_id     = !empty($_REQUEST['candid_id']) ? $_REQUEST['candid_id'] : 0;
$vendor_id     = !empty($_REQUEST['vendor_id']) ? $_REQUEST['vendor_id'] : 0;

for($i=0; $i<$row_count; $i++)
{
    // Oruvela user "12' Laptop" nu single quote form la type panna DB crash aagama iruka addslashes()
    $specifications = addslashes($specification[$i]); 
    $qtys           = $qty[$i];
    $units          = $unit[$i];
    $unit_rates     = $unit_rate[$i];
    $totals         = $total[$i];

    // Single quote fix panniyaachu & syntax perfect ah iruku
    $insert_query = $con->query("insert into quotation_entry(quote_no,specification,qty,unit,unit_rate,amount,gst_percentage,company_id,client_id,quote_type,business_id,vendor_id,candid_id,cost_sheet_id,quote_date,status,flag,created_by,created_on) values('$QUOTE_NO','$specifications','$qtys','$units','$unit_rates','$totals','$gst','$company_id','$client_id','$quote_type','$business_id','$vendor_id','$candid_id','$cost_sheet_id','$quote_date','1','1','$user_id',NOW())");  
    
    // Debugging puriyurathukaga mattum intha echo (Insert error iruntha screen la kamika)
    if($insert_query) {
        echo "Row ".($i+1)." Saved successfully!<br>";
    } else {
        // Enna error nu exact ah screen la print panni kamikum
        echo "Error in Row ".($i+1).": "; 
        print_r($con->errorInfo()); 
        echo "<br>"; 
    }
}





?>






