
<?php

require '../config.php';
include("../user.php");



$id = $_REQUEST['get_id'];
//$product = $_REQUEST['product'];
//$proposal = $_REQUEST['proposal'];
//$status = 2;

$proposal = $_REQUEST['proposal_for'];
 $Client = $_REQUEST['Client'];
$date = $_REQUEST['date'];
//$Version = $_REQUEST['Version'];
//echo$emp_id = $_REQUEST['emp_id'];
$email_id = $_REQUEST['email_id'];
$tel_no = $_REQUEST['tel_no'];
$scope = $_REQUEST['scope'];
$Proposal_statement = $_REQUEST['proposal'];
$Conditions = $_REQUEST['conditions']; 

$candidateid = $_REQUEST['get_emp_id'];
$phases = $_REQUEST['phases'];
//$phase_count = count($phase);
$items = $_REQUEST['Task'];
$costs = $_REQUEST['unit'];
$quote_types = $_REQUEST['amount_type'];
$prices = $_REQUEST['amt'];
	$quote_types = $_REQUEST['amount_type'];
    $priceTotals = $_REQUEST['amt'];
	
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
echo     $row['cost_sheet_number'];echo "<br/>";
    if (($row['cost_sheet_number'])!=null) {

        $splite_val = explode("/", $row['cost_sheet_number']);
        $no = $splite_val [0];
        echo "<br/>";
        $char = $splite_val [2];
        $newchar = $char;
		$char1 = 'C';
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
   echo     $cost_number = $char . '' . $final_cost_no . '/' . $finyear . '/' . $newchar;
	echo	$quote_no = $char1 . '' . $final_cost_no . '/' . $finyear . '/' . $newchar1;
		echo " $cost_number";
	echo " $quote_no";
    }
}


exit;
 $update_sql = $con->query("UPDATE `quotation` SET `Enquire_id` ='$id',`quote_no`= '$quote_no',`cost_sheet_number`= '$cost_number', `proposal`='$proposal',`Client`='$Client',`Date`='$date'
,`email_id`='$email_id',`tel_no`='$tel_no',`scope`='$scope',`Proposal_statement`='$Proposal_statement',`Conditions`='$Conditions' WHERE Enquire_id='$id'"); 


//$sql2 = $con->query("Update quotation set status='$status' where id='$id'");
echo "UPDATE `quotation` SET `proposal`='$proposal',`Client`='$Client',`Date`='$date'
,`email_id`='$email_id',`tel_no`='$tel_no',`scope`='$scope',`Proposal_statement`='$Proposal_statement',`Conditions`='$Conditions' WHERE Enquire_id='$id'";




 $sql1 = $con->query("UPDATE`cost_sheet_entry` SET `enquiry_id` = '$id', `Phases` = '$phases', `Specification` = '$items',
 `day` = '$costs', `amount_type` = '$quote_types', `Amount` = '$prices',`created_by` = '$candidateid' WHERE Enquiry_id='$id'"); 
    echo "UPDATE`cost_sheet_entry` SET `enquiry_id` = '$id', `Phases` = '$phases', `Specification` = '$items',
 `day` = '$costs', `amount_type` = '$quote_types', `Amount` = '$prices',`created_by` = '$candidateid' WHERE Enquiry_id='$id'";
 
 
  

    $sql2 = $con->query("UPDATE `cost_totl` SET `enquiries_id` = '$id', `Phases` = '$phases', `amount_type` = '$quote_types', `total` = '$priceTotals' WHERE Enquiries_id='$id'");
    echo "UPDATE `cost_totl` SET `enquiries_id` = '$id', `Phases` = '$phases', `amount_type` = '$quote_types', `total` = '$priceTotals' WHERE Enquiries_id='$id'";
 $status = 4;
 $flag = 2;

$update_sql = $con->query("UPDATE `crm_calls` SET `status` = '$status', `flag`='$flag' WHERE id='$id'");
//echo "UPDATE `enquiry` SET `status` = '$status', `flag`='$flag' WHERE id='$id'";
 
?>



















