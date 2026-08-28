<?php
require '../../../connect.php';
require '../../../user.php';

// BUG FIX: Enable exact SQL Error Reporting
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $user_id = $_SESSION['userid'];
    $quote_no_old = $_REQUEST['quote_no'];

    $row_query = "SELECT * FROM quotation_entry WHERE quote_no='$quote_no_old' AND status='1'";
    $query2 = $con->query($row_query);
    $query2->execute();
    $row = $query2->fetch();

    if (!empty($row['quote_no'])) {
        $splite_val = explode("/", $row['quote_no']);
        $no   =  $splite_val[0];
        $char =  $splite_val[1];
        $quote2 = ++$char;
        $QUOTE_NO = $no.'/'.$quote2;
    } else {
        $QUOTE_NO = $quote_no_old . '/REV';
    }

if(!isset($_REQUEST['item']) || empty($_REQUEST['item'])) {
    die("SYSTEM ERROR: Quotation cannot be empty! Please add at least one product.");
}
$specification = $_REQUEST['item'];
    $row_count     = count($specification);

    $qty           = $_REQUEST['qty'];
    $unit          = $_REQUEST['unit'];
    $unit_rate     = $_REQUEST['cost'];
    $total         = $_REQUEST['price'];
    $gst           = $_REQUEST['gst'];
    $client_id     = !empty($_REQUEST['client_id']) ? $_REQUEST['client_id'] : 0;
    $company_id    = !empty($_REQUEST['company_id']) ? $_REQUEST['company_id'] : 0;
    $revise_date   = date('Y-m-d', strtotime($_REQUEST['revise_date']));
    $quote_type    = !empty($_REQUEST['quote_type']) ? $_REQUEST['quote_type'] : 0;
    $enquiry_id    = !empty($_REQUEST['enquiry_id']) ? $_REQUEST['enquiry_id'] : 0;
    $business_id   = !empty($_REQUEST['mapping_id']) ? $_REQUEST['mapping_id'] : 0;
    $candid_id     = !empty($_REQUEST['candid_id']) ? $_REQUEST['candid_id'] : 0;
    $vendor_id     = !empty($_REQUEST['vendor_id']) ? $_REQUEST['vendor_id'] : 0;

    for($i = 0; $i < $row_count; $i++) {
        $specifications = $specification[$i];
        $qtys           = $qty[$i];
        $units          = $unit[$i];
        $unit_rates     = $unit_rate[$i];
        $totals         = $total[$i];

       $sql = "INSERT INTO quotation_entry (quote_no, specification, qty, unit, unit_rate, amount, gst_percentage, enquiry_id, company_id, client_id, quote_type, business_id, vendor_id, candid_id, revise_date, status, flag, modified_by, modified_on) VALUES ('$QUOTE_NO', '$specifications', '$qtys', '$units', '$unit_rates', '$totals', '$gst', '$enquiry_id', '$company_id', '$client_id', '$quote_type', '$business_id', '$vendor_id', '$candid_id', '$revise_date', '1', '1', '$user_id', NOW())";
        $con->query($sql);
    }

    if ($row_count > 0) {
        $con->query("UPDATE quotation_entry SET status ='2', flag ='2' WHERE quote_no= '$quote_no_old'");
    }

    // Real Success Message
    echo "Quotation revised Successfully";

} catch (PDOException $e) {
    // Echoes the exact SQL Error back to the frontend
    echo "DATABASE ERROR: " . $e->getMessage();
} catch (Exception $e) {
    echo "SYSTEM ERROR: " . $e->getMessage();
}
?>