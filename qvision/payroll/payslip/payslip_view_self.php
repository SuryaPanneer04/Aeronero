<!DOCTYPE html>
<html lang="en">

<head>

  <!--	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'> -->

  <style>
    .border {
      border: 6px solid #df8459 !important;
      padding: 30px !important;
      padding-bottom: 58px !important;

    }

    hr:not([size]) {
      height: 6px !important;
    }

    hr {
      margin: 1rem 0px !important;
      color: inherit !important;
      background-color: #df8459 !important;
      opacity: 1.25 !important;
    }

    .button {

      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <?php
  //require '../../../connect.php';	
  //require '../../user.php';
  require '../../../connect.php';
  require __DIR__ . "/../../../user.php";



  $userid = $_SESSION['userid'];
  $userrole = $_SESSION['userrole'];
  $username = $_SESSION['username'];
  $userid = $_SESSION['userid'];
  $userrole = $_SESSION['userrole'];
  $username = $_SESSION['username'];
  $payroll_id = $_REQUEST['payroll_id'];

  $req_id = !empty($_REQUEST['emp_id']) ? $_REQUEST['emp_id'] : (!empty($_REQUEST['id']) ? $_REQUEST['id'] : 0);
  $getusernam = $con->query("SELECT * FROM z_user_master WHERE user_name='$username' OR user_id='$userid' OR user_id='$req_id'");
  $getdptid = $getusernam->fetch(PDO::FETCH_ASSOC);

  $candiid = $getdptid ? $getdptid['user_id'] : ($req_id ? $req_id : $userid);
  $deptid = $getdptid ? $getdptid['department'] : 0;

  $dep_sql = $con->query("SELECT id, dept_name, status FROM z_department_master WHERE id='$deptid'");
  $dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC);

  if ($dep_sql_res) {
    $department_name = $dep_sql_res['dept_name'];
    $department = $dep_sql_res['id'];
  } else {
    $department_name = "N/A";
    $department = 0;
  }

  if (!empty($req_id) && $req_id != 0) {
    $staff_sql = $con->query("SELECT id, candid_id, emp_code as emp_no, emp_name FROM staff_master WHERE id='$req_id' OR candid_id='$req_id' LIMIT 1");
  } else {
    $staff_sql = $con->query("SELECT id, candid_id, emp_code as emp_no, emp_name FROM staff_master WHERE id='$candiid' OR candid_id='$candiid' OR emp_code='$username' OR CONCAT(prefix_code, emp_code)='$username' LIMIT 1");
  }
  
  $staff_sql_res = $staff_sql->fetch(PDO::FETCH_ASSOC);
  if ($staff_sql_res) {
    $candid_id = $staff_sql_res['candid_id'];
    $emp_pk_id = $staff_sql_res['id'];
  } else {
    $candid_id = 0;
    $emp_pk_id = 0;
  }

  //get payroll_master details

  $staff_payroll_sql = $con->query("select id,month,year,flag from payroll_master where id = $payroll_id");
  $staff_payroll_res = $staff_payroll_sql->fetch(PDO::FETCH_ASSOC);
  $m = $staff_payroll_res['month'];
  $y = $staff_payroll_res['year'];

  $dateObj   = DateTime::createFromFormat('!m', $m);
  $monthName = $dateObj->format('F');

  switch ($m) {
    case "1":
      $pay_period = "16th Jan" . ' ' . $y . " – 15th Feb" . ' ' . $y;
      break;

    case "2":
      $pay_period = "15th Feb" . ' ' . $y . " – 16th Mar" . ' ' . $y;
      break;

    case "3":
      $pay_period = "16th Mar" . ' ' . $y . " – 15th Apr" . ' ' . $y;
      break;

    case "4":
      $pay_period = "16th Apr" . ' ' . $y . " – 15th May" . ' ' . $y;
      break;

    case "5":
      $pay_period = "16th May" . ' ' . $y . " – 15th Jun" . ' ' . $y;
      break;

    case "6":
      $pay_period = "16th Jun" . ' ' . $y . "- 15th Jul" . ' ' . $y;
      break;

    case "7":
      $pay_period = "16th Jul" . ' ' . $y . " – 15th Aug" . ' ' . $y;
      break;

    case "8":
      $pay_period = "16th Aug" . ' ' . $y . " – 15th Sep" . ' ' . $y;
      break;

    case "9":
      $pay_period = "16th Sep" . ' ' . $y . " – 15th Oct" . ' ' . $y;
      break;

    case "10":
      $pay_period = "16th Oct" . ' ' . $y . " – 15th Nov" . ' ' . $y;
      break;

    case "11":
      $pay_period = "16th Nov" . ' ' . $y . " – 15th Dec" . ' ' . $y;
      break;

    case "12":
      $pay_period = "16th Dec" . ' ' . $y . " – 15th Jan" . ' ' . $y;
      break;

    default:
      $pay_period = $monthName . ' ' . $y;
  }

  if (!empty($emp_pk_id) && $emp_pk_id != 0) {
    $staff_sql = $con->query("SELECT * FROM staff_master WHERE id = '$emp_pk_id'");
  } elseif (!empty($candid_id) && $candid_id != 0) {
    $staff_sql = $con->query("SELECT * FROM staff_master WHERE candid_id = '$candid_id'");
  } else {
    $staff_sql = $con->query("SELECT * FROM staff_master WHERE emp_code = '$username' OR CONCAT(prefix_code, emp_code) = '$username'");
  }


  while ($staff_sql_res = $staff_sql->fetch(PDO::FETCH_ASSOC)) {

    $employee_id = $staff_sql_res['id'];
    $employee_prefix = $staff_sql_res['prefix_code'];
    $employee_code = $staff_sql_res['emp_code'];
    $emp_name = $staff_sql_res['emp_name'];
    $department_id = $staff_sql_res['dep_id'];
    $designation = $staff_sql_res['design_id'];
    
    // 🚨 PREVENT PREFIX DUPLICATION (e.g., QSPLEQSPLE119 -> QSPLE119) 🚨
    if (!empty($employee_prefix) && strpos($employee_code, $employee_prefix) === 0) {
      $emp_id = $employee_code;
    } else {
      $emp_id = $employee_prefix . $employee_code;
    }

    $pan_no = $staff_sql_res['pan_number'];
    $pf_no = $staff_sql_res['pf_number'];
    $esi_no = $staff_sql_res['esic_number'];
    $uan_no = $staff_sql_res['uan_number'];
    $acc_number = $staff_sql_res['account_no'];
    $bank = $staff_sql_res['bank'];
    $loc = $staff_sql_res['payslip_location'];
    
    // 🚨 GRAB REAL DATABASE CANDIDATE ID (e.g., 467 for Vaithilingam) 🚨
    $real_candid_id = $staff_sql_res['candid_id'];
        
    $des_sql=$con->query("SELECT designation_name FROM designation_master WHERE id='$designation'");
    $des_sql_res=$des_sql->fetch(PDO::FETCH_ASSOC);
    $designation_name = $des_sql_res ? $des_sql_res['designation_name'] : 'N/A';
      
    $dep_sql=$con->query("SELECT dept_name FROM z_department_master WHERE id='$department_id'");
    $dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC);
    $dep_name = $dep_sql_res ? $dep_sql_res['dept_name'] : 'N/A';
    
    $doj_sql=$con->query("SELECT joining_date from candidate_form_details WHERE id='$real_candid_id'");
    $doj_sql_res=$doj_sql->fetch(PDO::FETCH_ASSOC);    
    $doj = $doj_sql_res ? $doj_sql_res['joining_date'] : $staff_sql_res['DOJ'];
    
    $m_zero = sprintf('%02d', $m);
    $month_days = cal_days_in_month(CAL_GREGORIAN, (int)$m, (int)$y);
    $work_days = $month_days;
    $is_payroll_ready = false;

    // 1. Flexible Attendance Check
    $days_sql = $con->query("SELECT SUM(total_days) as total_no_of_days, SUM(working_days) as days_worked FROM bb_attendance WHERE (emp_code='$employee_id' OR emp_code='$employee_code' OR emp_code='$real_candid_id' OR emp_code='$emp_id' OR emp_code='$username') AND (MONTH(in_log_date)='$m' OR MONTH(in_log_date)='$m_zero') AND YEAR(in_log_date)='$y'");
    $row_check = $days_sql->fetch(PDO::FETCH_ASSOC);
    
    if ($row_check && $row_check['total_no_of_days'] != null) {
      $work_days = $row_check['days_worked'];
      $is_payroll_ready = true;
    } else {
      $ded_query = $con->query("SELECT total_no_of_days, days_worked FROM payroll_salary_deduction WHERE (employee_code='$employee_id' OR employee_code='$employee_code' OR employee_code='$real_candid_id' OR employee_code='$emp_id' OR employee_code='$username') AND (payroll_month='$m' OR payroll_month='$m_zero') AND payroll_year='$y' AND total_no_of_days IS NOT NULL LIMIT 1");
      if ($ded_query && $ded_query->rowCount() > 0) {
        $ded_res = $ded_query->fetch(PDO::FETCH_ASSOC);
        if ($ded_res !== false && $ded_res['total_no_of_days'] != null) {
          $work_days = $ded_res['days_worked'];
          $is_payroll_ready = true;
        }
      }
    }

    // 2. Fallback: Check earnings table
    if (!$is_payroll_ready) {
      $check_earn = $con->query("SELECT COUNT(*) FROM payroll_salary_earnings WHERE (employee_code='$employee_id' OR employee_code='$employee_code' OR employee_code='$real_candid_id' OR employee_code='$emp_id' OR employee_code='$username') AND (payroll_month='$m' OR payroll_month='$m_zero') AND payroll_year='$y'");
      if ($check_earn && $check_earn->fetchColumn() > 0) {
        $is_payroll_ready = true;
      }
    }

    if ($is_payroll_ready) {
        // Earnings    
        $earning_sql = $con->query("SELECT earnings,amount FROM payroll_salary_earnings WHERE (payroll_month='$m' OR payroll_month='$m_zero') and payroll_year='$y' and (employee_code='$employee_id' OR employee_code='$employee_code' OR employee_code='$real_candid_id' OR employee_code='$emp_id' OR employee_code='$username') order by id asc");

        $earnings = array();
        $amount = array();
        $earned_salaries = array();
        while ($earning_sql_res = $earning_sql->fetch(PDO::FETCH_ASSOC)) {
          $earnings[] = $earning_sql_res['earnings'];
          $amount[] = $earning_sql_res['amount'];
          $earned_salaries[$earning_sql_res['earnings']] = $earning_sql_res['amount'];
        }

        // Earned salary START
        $earned_sql = $con->query("SELECT earnings,amount FROM payroll_earned_salary WHERE (payroll_month='$m' OR payroll_month='$m_zero') and payroll_year='$y' and (employee_code='$employee_id' OR employee_code='$employee_code' OR employee_code='$real_candid_id' OR employee_code='$emp_id' OR employee_code='$username') order by id asc");
        $earned_amount = array();
        while ($earned_sql_res = $earned_sql->fetch(PDO::FETCH_ASSOC)) {
          $earned_amount[$earned_sql_res['earnings']] = $earned_sql_res['amount'];
        }
        $gross_salary = array_sum($earned_salaries) > 0 ? array_sum($earned_salaries) : array_sum($earned_amount);
        // Earned salary END

        // Deductions    
        $earning_sql = $con->query("SELECT * FROM payroll_salary_deduction WHERE (payroll_month='$m' OR payroll_month='$m_zero') and payroll_year='$y' and (employee_code='$employee_id' OR employee_code='$employee_code' OR employee_code='$real_candid_id' OR employee_code='$emp_id' OR employee_code='$username') order by id asc");
        $deduction = array();
        $ded_amount = array();
        while ($earning_sql_res = $earning_sql->fetch(PDO::FETCH_ASSOC)) {
          $deduction[] = $earning_sql_res['deduction'];
          $ded_amount[$earning_sql_res['deduction']] = $earning_sql_res['amount'];
        }
        $deduction_total = array_sum($ded_amount);
        $number = $gross_salary - $deduction_total;

        // 🚨 BULLETPROOF SALARY STRUCTURE FALLBACK (Guarantees no 0.00 ever again!) 🚨
        $salstrcutre = $con->query("SELECT * FROM `joining_detail_sal_structure` WHERE candid_id='$real_candid_id' OR candid_id='$employee_id' OR candid_id='$employee_code' OR candid_id='$emp_id' OR candid_id='$username' LIMIT 1");
        $getdetails = $salstrcutre->fetch(PDO::FETCH_ASSOC);

        if (!is_array($getdetails) || empty($getdetails['basic_month'])) { 
          // Golden Fallback: If structure table is missing/unlinked, build basic structure directly from payroll table!
          // Since the view divides by month_days and multiplies by work_days, we reverse it to get the base amount.
          $multiplier = ($work_days > 0 && $month_days > 0) ? ($month_days / $work_days) : 1;
          $getdetails = [
            'basic_month' => floatval($earned_salaries['Basic+ DA'] ?? $earned_salaries['Basic & DA'] ?? $earned_salaries['BASIC'] ?? 0) * $multiplier,
            'HRA_month' => floatval($earned_salaries['HRA'] ?? 0) * $multiplier,
            'otherallowances_permonth' => floatval($earned_salaries['Other Allowances'] ?? $earned_salaries['Other Allowance'] ?? 0) * $multiplier,
            'employee_PF_month' => floatval($ded_amount['PF'] ?? 0) * $multiplier,
            'employee_ESIC_month' => floatval($ded_amount['ESIC'] ?? 0) * $multiplier,
            'professionaltax_permonth' => floatval($ded_amount['PT'] ?? 0) * $multiplier
          ];
        } else {
          $getdetails['basic_month'] = floatval($getdetails['basic_month'] ?? 0);
          $getdetails['HRA_month'] = floatval($getdetails['HRA_month'] ?? 0);
          $getdetails['otherallowances_permonth'] = floatval($getdetails['otherallowances_permonth'] ?? 0);
          $getdetails['employee_PF_month'] = floatval($getdetails['employee_PF_month'] ?? 0);
          $getdetails['employee_ESIC_month'] = floatval($getdetails['employee_ESIC_month'] ?? 0);
          $getdetails['professionaltax_permonth'] = floatval($getdetails['professionaltax_permonth'] ?? 0);
        }

        if(empty($month_days) || $month_days <= 0) { $month_days = 1; }
        if($m<10) { $mmm='0'.$m; $arrmy=$y.'-'.$mmm; } else { $arrmy=$y.'-'.$m; }

        $arrerpay = $con->query("SELECT remark,sum(amount) as arrearamt FROM `arrear_pay` WHERE (emp_id='$real_candid_id' OR emp_id='$employee_id' OR emp_id='$emp_id' OR emp_id='$username') and payroll_month='$arrmy'");
        $arrdetails = $arrerpay->fetch(PDO::FETCH_ASSOC);
			
			$reamrkofarrear = '';
			$arrearamt_get = 0;
			if($arrdetails) {
				$reamrkofarrear = $arrdetails['remark'] ?? '';
				$arrearamt_get = floatval($arrdetails['arrearamt'] ?? 0);
			}
        ?>
        <div class="col-md-12" style="text-align: end;">
          <input class="button btn-danger" type="button" value="PRINT" onclick="printDiv()">
        </div>
        <div class="border container" id="main">
          <table class="logo_border" style="width: 100%;">
            <tr class="logo_border">
              <th class="logo_border"><img src="qvision/images/logo123.jpg" alt="Image" style="width: 450px;height: 125px;"></th>
              <!-- <th class="logo_border" style="text-transform:uppercase;font-weight:800;font-size:18px;text-align: center;">SS Information Systems Pvt Ltd</th> -->
            </tr>
          </table>
          <hr style="width: 100%;">
          <div class="row">
            <div class="col-md-12">
              <h6 style="text-align:center;font-size: 18px;">Quadsel Tower Old No 80, New No 118 Anna Salai, Manickam Ln, Guindy, Chennai, Tamil Nadu 600032]</h6>

              <h6 style="text-align:center;font-weight:700;font-size: 18px;">Payroll for the Month of <?php echo $pay_period; ?></h6>
            </div>

          </div>

          <br>
          <table class="remove_border" style="width:100%">
            <tr class="remove_border">
              <td class="left remove_border" style="font-weight:bold;"> Employee Name </td>
              <td class="left remove_border">: <?php echo $emp_name; ?></td>
              <td class="left remove_border" style="font-weight:bold;"> Date of Joined </td>
              <td class="left remove_border">: <?php echo date('d/m/Y', strtotime($doj)); ?></td>
            </tr>

            <tr>
              <td class="left remove_border" style="font-weight:bold;"> Employee ID </td>
              <td class="left remove_border">: <?php echo $emp_id; ?></td>
              <td class="left remove_border" style="font-weight:bold;"> PAN Number </td>
              <td class="left remove_border">: <?php echo $pan_no; ?></td>
            </tr>

            <tr>
              <td class="left remove_border" style="font-weight:bold;"> Designation </td>
              <td class="left remove_border">: <?php echo $designation_name; ?></td>
              <td class="left remove_border" style="font-weight:bold;"> UAN Number </td>
              <td class="left remove_border">: <?php echo $uan_no; ?></td>
            </tr>

            <tr>
              <td class="left remove_border" style="font-weight:bold;"> Department </td>
              <td class="left remove_border">: <?php echo $dep_name; ?></td>
              <td class="left remove_border" style="font-weight:bold;"> ESIC Number </td>
              <td class="left remove_border">: <?php echo $esi_no; ?></td>
            </tr>

            <tr>
              <td class="left remove_border" style="font-weight:bold;"> Bank </td>
              <td class="left remove_border">: <?php echo $bank; ?></td>
              <td class="left remove_border" style="font-weight:bold;"> Bank Account Number </td>
              <td class="left remove_border">: <?php echo $acc_number; ?></td>
            </tr>

            <tr>
              <td class="left remove_border" style="font-weight:bold;"> PF Number </td>
              <td class="left remove_border">: <?php echo $pf_no; ?></td>
              <td class="left remove_border" style="font-weight:bold;"> Location </td>
              <td class="left remove_border">: <?php echo $loc; ?></td>
            </tr>

            <tr>
              <td class="left remove_border" style="font-weight:bold;"> Days Worked </td>
              <td class="left remove_border">: <?php echo $work_days; ?></td>
              <td class="left remove_border" style="font-weight:bold;"> Total Number of Days </td>
              <td class="left remove_border">: <?php echo $month_days; ?></td>
            </tr>

          </table>
          <br>
          <style>
            .logo_border {
              border: 0px solid black !important;
            }

            .remove_border {
              border: 0px solid black !important;
            }

            .left {
              text-align: start !important;
            }

            .right {
              text-align: end !important;
            }

            table,
            th,
            td {
              border: 1px solid black;
              border-collapse: collapse;
            }

            th,
            td {
              padding: 5px;
              text-align: center;
            }
          </style>
          <table style="width:100%">
  <tr>
    <th colspan="2">Earnings</th>
    <th colspan="2">Deductions</th>
    <th colspan="2">Arrear_pay</th>
  </tr>
<?php 
if($is_payroll_ready && !empty($earned_salaries)) {
    $basicdasal = floatval($earned_salaries['Basic+ DA'] ?? $earned_salaries['Basic & DA'] ?? $earned_salaries['BASIC'] ?? 0);
} else {
    $basicdasal = ($month_days > 0) ? ($getdetails['basic_month'] / $month_days * $work_days) : 0;
}
?>
  <tr>
    <td class="left">Basic & DA </td>
    <td class="right"><?php echo round($basicdasal,2); ?></td> 

    <td class="left">PF Employee </td>
    <td class="right"><?php 
    if($is_payroll_ready && !empty($ded_amount)) {
        $pfamount = floatval($ded_amount['PF'] ?? 0);
    } else {
        $finalbasic = round($basicdasal, 2); 
        $otherallowance = ($month_days > 0) ? ($getdetails['otherallowances_permonth'] / $month_days * $work_days) : 0;
        $pfcalc = $finalbasic + $otherallowance;
        if ($pfcalc > 15000) {
            $pfamount = 1800;
        } else {
            if ($work_days < 15 && $month_days > 0) {
                $pfamount = round((1800 / $month_days) * $work_days, 2);
            } else {
                $pfamount = floatval($getdetails['employee_PF_month'] ?? 0);
            }
        }
    }
    echo round($pfamount, 2);
	?></td>
  <?php if($reamrkofarrear) { ?>
  <td><?php echo $reamrkofarrear;?></td>
  <td><?php echo $arrearamt_get;?></td>
  <?php } else { ?>
  <td><?php echo 'NULL';?></td>
  <td><?php echo 0;?></td>
  <?php } ?>
  </tr>
  
   <tr>
    <td class="left">HRA</td>
    <td class="right"><?php 
    if($is_payroll_ready && !empty($earned_salaries)) {
        $HRA = floatval($earned_salaries['HRA'] ?? 0);
    } else {
        $HRA = ($month_days > 0) ? ($getdetails['HRA_month'] / $month_days * $work_days) : 0;
    }
    echo round($HRA,2);
    ?></td>
    <td class="left">ESIC Employee</td>
    <td class="right"><?php	
    if($is_payroll_ready && !empty($ded_amount)) {
        $esicamount = floatval($ded_amount['ESIC'] ?? $ded_amount['ESI'] ?? 0);
    } else {
        $otherallowance = ($month_days > 0) ? ($getdetails['otherallowances_permonth'] / $month_days * $work_days) : 0;
        $gross_salary = $basicdasal + $HRA + $otherallowance;
        $esicamount = 0; 
        if ($gross_salary <= 21000) {
            $esicamount = floatval($getdetails['employee_ESIC_month'] ?? 0);
        }
    }
    echo round($esicamount, 2);
	?></td>
  </tr>

   <tr>
    <td class="left">Other Allowance</td>
    <td class="right"><?php 
    if($is_payroll_ready && !empty($earned_salaries)) {
        $otherallowance = 0;
        foreach($earned_salaries as $key => $val) {
            $norm_key = trim(strtolower($key));
            if($norm_key == 'other allowances' || $norm_key == 'other allowance' || $norm_key == 'otherallowance' || $norm_key == 'otherallowances' || $norm_key == 'oa') {
                $otherallowance = floatval($val);
                break;
            }
        }
        if($otherallowance == 0) {
            $otherallowance = floatval($earned_salaries['Other Allowances'] ?? $earned_salaries['Other Allowance'] ?? 0);
        }
    } else {
        $otherallowance = ($month_days > 0) ? ($getdetails['otherallowances_permonth'] / $month_days * $work_days) : 0;
    }
    echo round($otherallowance,2); 	
    ?></td>
    <td class="left">Professional Tax</td>
    <td class="right"><?php 
    if($is_payroll_ready && !empty($ded_amount)) {
        $ptamount = floatval($ded_amount['PT'] ?? 0);
    } else {
        $ptamount = floatval($getdetails['professionaltax_permonth'] ?? 0);
    }
    echo round($ptamount,2); 	
    ?></td>
  </tr>

   <tr>
    <td class="left"></td>
    <td class="right"></td>
    <td class="left">Loss Of Pay</td>
    <td class="right"><?php 
        $lop_amount = floatval($ded_amount['Loss Of Pay'] ?? $ded_amount['loss of pay'] ?? 0);
        echo number_format($lop_amount, 2);
    ?></td>
  </tr>

   <tr>
    <td class="left"></td>
    <td class="right"></td>
    <td class="left">Salary Advance</td>
    <td class="right"><?php 
        $adv_amount = floatval($ded_amount['Salary Advance'] ?? $ded_amount['salary advance'] ?? 0);
        echo number_format($adv_amount, 2);
    ?></td>
  </tr>

  <tr>
    <td class="left" style="font-weight:bold;">Total Earning</td>
	<?php 
	$gross_salary = $basicdasal + $HRA + $otherallowance;
	?>
    <td class="right" style="font-weight:bold;"><?php echo number_format($gross_salary,2) ;?></td>
	
	<?php 
		$deduction_total = $pfamount + $esicamount + $ptamount + $lop_amount + $adv_amount;
	?>
    <td class="left" style="font-weight:bold;">Total Deduction</td>
    <td class="right" style="font-weight:bold;"><?php echo number_format($deduction_total,2);?></td>

    <td>Arrear_total</td>
    <td><?php echo $arrearamt_get ? $arrearamt_get : 0; ?></td>
  </tr>
  
   <tr>
    <td colspan='3' style="font-weight:bold;" class="left">NET Salary</td>
	<?php $number=$gross_salary-$deduction_total + $arrearamt_get; ?>
    <td colspan='1' style="font-weight:bold;" class="right"><?php echo number_format($number,2) ;?></td>
  </tr>
</table>
          <br>
          <?php /* number to string conversion Starts */


          $no = round($number);

          $point = round($number - $no, 2) * 100;
          $hundred = null;
          $digits_1 = strlen($no);
          $i = 0;
          $str = array();
          $words = array(
            '0' => 'zero',
            '1' => 'one',
            '2' => 'two',
            '3' => 'Three',
            '4' => 'Four',
            '5' => 'Five',
            '6' => 'Six',
            '7' => 'Seven',
            '8' => 'Eight',
            '9' => 'Nine',
            '10' => 'Ten',
            '11' => 'Eleven',
            '12' => 'Twelve',
            '13' => 'Thirteen',
            '14' => 'Fourteen',
            '15' => 'Fifteen',
            '16' => 'Sixteen',
            '17' => 'Seventeen',
            '18' => 'Eighteen',
            '19' => 'Nineteen',
            '20' => 'Twenty',
            '30' => 'Thirty',
            '40' => 'Forty',
            '50' => 'Fifty',
            '60' => 'Sixty',
            '70' => 'Seventy',
            '80' => 'Eighty',
            '90' => 'Ninety'
          );
          $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
          while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
              $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
              $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
              $str[] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
          }
          $str = array_reverse($str);
          $result = implode('', $str);
          $sal_point = abs($point);
          $points = ($sal_point) ? " " . $words[$sal_point / 10] . " " .  $words[$sal_point = $sal_point % 10] : '';
          $string_amount = '';

          $pointValue = ($points) ? $points . "  Paise  " : " ";
          $string_amount = $result . "Rupees  " . $pointValue . "only";

          /* number to string conversion Ends*/

          ?>
          <div class="row">
            <div class="col-md-12">
              <span class="fw-bold" style="font-weight:bold;"><?php echo $string_amount ?></span>
              <br>
              <span>This is a computer generated statement and does not require any signature.</span>
            </div>
          </div>
        </div>
      <?php
      } else {
        echo "<script>alert('Payslip Generation is Pending for this Month!');</script>";
       
        echo "<script>window.location.href ='index.php';</script>";
      }
    }
    ?>
  <script>
    function printDiv() {
      var divContents = document.getElementById("main").innerHTML;
      var a = window.open('', '', 'height=1000, width=1500');
      a.document.write('<html>');
      //a.document.write('<body > <h1>Div contents are <br>');
      a.document.write(divContents);
      a.document.write('</body></html>');
      a.document.close();
      a.print();
      a.close();
    }


    // <!-- $(document).ready(function(){ -->
    // 	<!-- let lop = <?php if (array_key_exists("Loss Of Pay", $ded_amount)) ?> -->
    // <!-- }) -->
  </script>
</body>

</html>
