<?php 
Session_start();
require '../../../connect.php';
$user_id = $_SESSION['userid'];

if( isset($_POST['emp_name']) || isset($_POST['doj']) || isset($_POST['leave_type']) || isset($_POST['candid_id']) ) 
{
    // 1. Get candid_id and emp_name cleanly from dropdown string (e.g. "467-Vaithilingam S")
    $org_type   = $_POST['emp_name'];
    $str_arr    = preg_split ("/\-/", $org_type, 2); 
    $candid_id  = (isset($str_arr[0]) && !empty($str_arr[0])) ? trim($str_arr[0]) : $_POST['candid_id'];
    $emp_name   = isset($str_arr[1]) ? trim($str_arr[1]) : '';

    // 2. Safe Date Conversion (Prevents 01-01-1970 crash)
    $doj  = !empty($_POST['doj']) ? $_POST['doj'] : date("Y-m-d");
    $dojs = date("Y-m-d", strtotime($doj));
    if($dojs == "1970-01-01" || empty($dojs) || $dojs == "0000-00-00") {
        $dojs = date("Y-m-d");
    }

    $leave_type = $_POST['leave_type'];
    $time = strtotime("$dojs");

    $curnt_date = date("Y-m-d");
    $cl_from    = date("Y-m-d", strtotime("+1 month", $time));
     
    $pl_from    = date("Y-m-d", strtotime("+6 month", $time));
    $pl_year    = date('y', strtotime($pl_from));

    $pl_month     = date('m', strtotime($pl_from));
    $yearstrt     = date('Y-m-d', strtotime('1/1'));
    $yearEnd      = date('Y-m-d', strtotime('12/31'));
    $year_month   = date('m', strtotime($yearEnd));
    $cur_year_end = date('y', strtotime($yearEnd));

    $new_yr_last_date = date("Y-m-d", strtotime( '+1 year', strtotime($yearEnd)));

    if($leave_type == 2)
    {
        if($pl_year == $cur_year_end) {		
          $datetime1 = date_create("$pl_from");
          $datetime2 = date_create("$yearEnd");
          $interval  = date_diff($datetime1, $datetime2);
          $leave_balance = $interval->format('%m');		
        } elseif($pl_year < $cur_year_end) {		
          $datetime1 = date_create("$yearstrt");
          $datetime2 = date_create("$yearEnd");
          $interval  = date_diff($datetime1, $datetime2);
          $leave_balances = $interval->format('%m');
          $leave_balance  = $leave_balances + 1;  
        } elseif($pl_year > $cur_year_end) {
          $datetime1 = date_create("$pl_from");
          $datetime2 = date_create("$new_yr_last_date");
          $interval  = date_diff($datetime1, $datetime2);
          $leave_balances = $interval->format('%m');
          $leave_balance  = $leave_balances + 1;
        } else {
          $leave_balance = "0";	
        }
    } elseif($leave_type == 3) {
        $leave_balance = "1";
    } elseif($leave_type == 4) {
        $leave_balance = "0";
    } elseif($leave_type == 1) {
        $leave_balance = "0";
    }

    // Check if record already exists
    $stmt = $con->prepare("SELECT COUNT(*) as count FROM leave_masters WHERE candid_id='$candid_id' AND leave_type='$leave_type'");
    $stmt->execute(); 
    $row   = $stmt->fetch();
    $count = $row['count'];
    
    echo "-";
    
    if($count == 0 && !empty($candid_id))
    {	
        try {
            // BYPASS AUTO_INCREMENT BUG: Calculate next ID explicitly for leave_masters
            $stmt_max1 = $con->query("SELECT MAX(id) as max_id FROM leave_masters");
            $row_max1  = $stmt_max1->fetch();
            $next_id1  = (isset($row_max1['max_id']) && $row_max1['max_id'] !== "" && $row_max1['max_id'] !== null) ? ($row_max1['max_id'] + 1) : 1;

            // 1. Insert into Leave Master table with explicit ID
            $insert_sql = $con->query("INSERT INTO leave_masters (id, candid_id, emp_name, doj, cl_from, pl_from, leave_type, total_leave, balance_leave, status, created_by, created_on) VALUES ('$next_id1', '$candid_id', '$emp_name', '$dojs', '$cl_from', '$pl_from', '$leave_type', '$leave_balance', '$leave_balance', '1', '$user_id', NOW())");

            // 2. Fetch Employee Code dynamically
            $stmt_code = $con->prepare("SELECT emp_code FROM staff_master WHERE candid_id='$candid_id'");
            $stmt_code->execute();
            $row_code = $stmt_code->fetch();
            $emp_code = (isset($row_code['emp_code']) && !empty($row_code['emp_code'])) ? $row_code['emp_code'] : 'NA';

            // BYPASS AUTO_INCREMENT BUG: Calculate next ID explicitly for leave_apply_masters
            $stmt_max2 = $con->query("SELECT MAX(id) as max_id FROM leave_apply_masters");
            $row_max2  = $stmt_max2->fetch();
            $next_id2  = (isset($row_max2['max_id']) && $row_max2['max_id'] !== "" && $row_max2['max_id'] !== null) ? ($row_max2['max_id'] + 1) : 1;

            // 3. Insert into Leave Apply Masters for Janani Mam Approval List with explicit ID & reporting_person_id=0
            $insert_approval = $con->query("INSERT INTO leave_apply_masters (id, reporting_person_id, candid_id, emp_code, emp_name, leave_type, req_date, leave_date, from_date, to_date, no_of_days, leave_reason, sick_doc, status, created_by, created_on) VALUES ('$next_id2', '0', '$candid_id', '$emp_code', '$emp_name', '$leave_type', '$curnt_date', '$dojs', '$dojs', '$dojs', '1', 'Leave Master Allocation', '', '1', '$user_id', NOW())");
        } catch (Exception $e) {
            // Handled silently to preserve UI flow
        }
    }
    else
    {
        echo "1";
    }
}
?>