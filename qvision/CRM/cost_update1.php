<?php

require '../config.php';
require '../user.php';
$candidateid = $_REQUEST['get_emp_id'];
$id = $_REQUEST['get_id'];
$row_query = "SELECT * FROM cost_sheet_entry ";

$query = $con->query($row_query);
$query->execute();
$count = $query->rowCount();

$row_val = $query->fetch();

if ($count == 0) {
    $char = 'BBCS';
	$char1 = 'QOT';
    //financial year	
    $month = 01;
    $current_month = date('m');
    if ($current_month >= '01' && $current_month < '04') {

        if ($month >= '01' && $month < '04') {
            $nextyear = substr(date('Y'), -2);
        }

        if ($month >= '04') {
            $nextyear = substr(date('Y') - 1, -2);
        }
    }

    if ($current_month >= '04') {
        if ($month >= '04') {
            $nextyear = substr(date('Y'), -2);
        }

        if ($month < '04') {
            $nextyear = substr(date('Y') + 1, -2);
        }
    }

    $nextyear;
    echo "<br/>";
    //current year
    $curyear = substr(date('Y'), -2);
    echo "<br/>";
    $finyear = $curyear . '-' . $nextyear;
    echo "<br/>";
    $char_str = 'A';
	$char_str1 = 'B';
    $seq = 00001;
    $costsheetno = sprintf("%05d", $seq);
    $cost_number = $char . '' . $costsheetno . '/' . $finyear . '/' . $char_str;
	$quote_no = $char1 . '' . $costsheetno . '/' . $finyear . '/' . $char_str1;
	
} else {
    $row_query = "SELECT * FROM  quotation ORDER BY id DESC ";

    $query2 = $con->query($row_query);
    $query2->execute();
    $count = $query2->rowCount();
    $row = $query2->fetch();
     $row['cost_sheet_number'];echo "<br/>";
    if (!empty($row['cost_sheet_number'])) {

        $splite_val = explode("/", $row['cost_sheet_number']);
        $no = $splite_val [0];
        echo "<br/>";
        $char = $splite_val [2];
        $newchar = $char;
		$char1 = 'B';
        $newchar1 = $char1;
        $month = 01;
        $current_month = date('m');
        if ($current_month >= '01' && $current_month < '04') {

            if ($month >= '01' && $month < '04') {
                $nextyear = substr(date('Y'), -2);
            }

            if ($month >= '04') {
                $nextyear = substr(date('Y') - 1, -2);
            }
        }

        if ($current_month >= '04') {
            if ($month >= '04') {
                $nextyear = substr(date('Y'), -2);
            }

            if ($month < '04') {
                $nextyear = substr(date('Y') + 1, -2);
            }
        }

        $nextyear;
        //current year
        $curyear = substr(date('Y'), -2);
        echo "<br/>";
        $finyear = $curyear . '-' . $nextyear;
        echo "<br/>";


        $find_f = substr($row['cost_sheet_number'], 0, 6);
        echo "<br/>";
        $find_fs = substr($row['cost_sheet_number'], 7, 4);
        echo "<br/>";
        $bussiness_type;
        echo "<br/>";
        // echo  $a = sprintf("%05d", $find_fs);echo "<br/>";
        $final_cost_no = str_pad($find_fs + 1, 5, 0, STR_PAD_LEFT);
        echo "<br/>";
        $cost_number = $char . '' . $final_cost_no . '/' . $finyear . '/' . $newchar;
		$quote_no = $char1 . '' . $final_cost_no . '/' . $finyear . '/' . $newchar1;
		echo " $cost_number";
	echo " $quote_no";
    }
}
//BBCS00001/21-22/A  -- > Cost sheet Number Example
	
//A00023/22-22/A  -- > Cost sheet Number Example

$proposal = $_REQUEST['proposal'];
$Client = $_REQUEST['Client'];
$date = $_REQUEST['date'];
//$Version = $_REQUEST['Version'];
$emp_id = $_REQUEST['emp_id'];
$email_id = $_REQUEST['email_id'];
$tel_no = $_REQUEST['tel_no'];
$scope = $_REQUEST['scope'];
$Proposal_statement = $_REQUEST['Proposal_statement'];
$Conditions = $_REQUEST['Conditions'];

$sql = $con->query("INSERT INTO `quotation`(`Enquire_id`,`quote_no`,`cost_sheet_number`, `proposal`, `Client`, `Date`,`emp_id`, `email_id`, `tel_no`, `scope`, `Proposal_statement`, `Conditions`,`created_by`) VALUES ('$id','$quote_no','$cost_number','$proposal','$Client','$date','$emp_id','$email_id','$tel_no','$scope','$Proposal_statement','$Conditions','$candidateid')");

echo "INSERT INTO `quotation`(`Enquire_id`,`quote_no`,`cost_sheet_number`, `proposal`, `Client`, `Date`, `emp_id`, `email_id`, `tel_no`, `scope`, `Proposal_statement`, `Conditions`,`created_by`) VALUES ('$id','$quote_no','$cost_number','$proposal','$Client','$date','$emp_id','$email_id','$tel_no','$scope','$Proposal_statement','$Conditions','$candidateid')";

$candidateid = $_REQUEST['get_emp_id'];
$phase = $_REQUEST['phases'];
$phase_count = count($phase);
$item = $_REQUEST['item'];
$cost = $_REQUEST['cost'];
$quote_type = $_REQUEST['quote_type'];

$price = $_REQUEST['price'];
for ($i = 0; $i < $phase_count; $i++) {
    $phases = $phase[$i];
    $items = $item[$i];
    $costs = $cost[$i];
	$quote_types = $quote_type[$i];
    $prices = $price[$i];
    $sql1 = $con->query("insert into `cost_sheet_entry`(`enquiry_id`, `Phases`, `Specification`, `day`, `amount_type`, `Amount`,`created_by`)  
values('$id','$phases','$items','$costs','$quote_types','$prices','$candidateid')");
    echo "insert into `cost_sheet_entry`(`enquiry_id`, `Phases`, `Specification`, `day`, `amount_type`, `Amount`,`created_by`)  
values('$id','$phases','$items','$costs','$quote_types','$prices','$candidateid')";
}
$priceTotal = $_REQUEST['priceTotal'];

$count_priceTotals = count($priceTotal);
for ($i = 0; $i < $count_priceTotals; $i++) {
   // $sd = $i + 1;
    $phases = $phase[$i];
	$quote_types = $quote_type[$i];
    $priceTotals = $priceTotal[$i];
    $sql2 = $con->query("INSERT INTO `cost_totl`(`enquiries_id`, `Phases`, `amount_type`, `total`) VALUES ('$id','$phases','$quote_types','$priceTotals')");
    echo "INSERT INTO `cost_totl`(`enquiry_id`, `Phases`, `amount_type`, `total`) VALUES ('$id','$phases','$quote_types','$priceTotals')";
}
$flag = 2;

//$update_sql = $con->query("UPDATE `enquiry` SET `flag`='$flag' WHERE id='$id'");
$update_sql = $con->query("UPDATE `crm_calls` SET `flag`='$flag' WHERE id='$id'");
?>






