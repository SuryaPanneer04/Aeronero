<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require('../connect.php');

try {
    $payroll_id = $_REQUEST['payroll_id'];
    $department = $_REQUEST['department'];
    $candid_id = $_REQUEST['employee'];

    $staff_payroll_sql = $con->query("select id,month,year,flag from payroll_master where id = $payroll_id");
    $staff_payroll_res = $staff_payroll_sql->fetch(PDO::FETCH_ASSOC);
    $m = $staff_payroll_res['month'];
    $y = $staff_payroll_res['year'];

    $dateObj   = DateTime::createFromFormat('!m', $m);
    $monthName = $dateObj->format('F');

    switch ($m) {
        case "1":
            $pay_period = "16th Jan" . ' ' . $y . " - 15th Feb" . ' ' . $y;
            break;

        case "2":
            $pay_period = "15th Feb" . ' ' . $y . " - 16th Mar" . ' ' . $y;
            break;

        case "3":
            $pay_period = "16th Mar" . ' ' . $y . " - 15th Apr" . ' ' . $y;
            break;

        case "4":
            $pay_period = "16th Apr" . ' ' . $y . " - 15th May" . ' ' . $y;
            break;

        case "5":
            $pay_period = "16th May" . ' ' . $y . " - 15th Jun" . ' ' . $y;
            break;

        case "6":
            $pay_period = "16th Jun" . ' ' . $y . " - 15th Jul" . ' ' . $y;
            break;

        case "7":
            $pay_period = "16th Jul" . ' ' . $y . " - 15th Aug" . ' ' . $y;
            break;

        case "8":
            $pay_period = "16th Aug" . ' ' . $y . " - 15th Sep" . ' ' . $y;
            break;

        case "9":
            $pay_period = "16th Sep" . ' ' . $y . " - 15th Oct" . ' ' . $y;
            break;

        case "10":
            $pay_period = "16th Oct" . ' ' . $y . " - 15th Nov" . ' ' . $y;
            break;

        case "11":
            $pay_period = "16th Nov" . ' ' . $y . " - 15th Dec" . ' ' . $y;
            break;

        case "12":
            $pay_period = "16th Dec" . ' ' . $y . " - 15th Jan" . ' ' . $y;
            break;

        default:
            $pay_period = $monthName . ' ' . $y;
    }

    if ($department != 0  && $candid_id == 0) {
        $staff_sql = $con->query("SELECT * FROM staff_master where dep_id='$department'");
    } else if ($department == 0  && $candid_id != 0) {
        //get employee details
        $staff_sql = $con->query("SELECT * FROM staff_master where candid_id = '$candid_id'");
    } else if ($department != 0  && $candid_id != 0) {
        $staff_sql = $con->query("SELECT * FROM staff_master where dep_id='$department' and candid_id = '$candid_id'");
    }


    while ($staff_sql_res = $staff_sql->fetch(PDO::FETCH_ASSOC)) {

        $employee_id = $staff_sql_res['id'];
        $employee_prefix = $staff_sql_res['prefix_code'];
        $employee_code = $staff_sql_res['emp_code'];
        $emp_name = $staff_sql_res['emp_name'];
        $department_id = $staff_sql_res['dep_id'];
        $designation = $staff_sql_res['design_id'];
        $emp_id = $employee_prefix . $employee_code;
        $pan_no = $staff_sql_res['pan_number'];
        $pf_no = $staff_sql_res['pf_number'];
        $esi_no = $staff_sql_res['esic_number'];
        $uan_no = $staff_sql_res['uan_number'];
        $acc_number = $staff_sql_res['account_no'];
        $bank = $staff_sql_res['bank'];
        $loc = $staff_sql_res['payslip_location'];

        //Designation		
        $des_sql = $con->query("SELECT designation_name FROM designation_master WHERE id='$department_id'");
        $des_sql_res = $des_sql->fetch(PDO::FETCH_ASSOC);
        $designation_name = $des_sql_res['designation_name'];

        //Department		
        $dep_sql = $con->query("SELECT dept_name FROM z_department_master WHERE id='$department_id'");
        $dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC);
        $dep_name = $dep_sql_res['dept_name'];

        //DOJ 
        $doj_sql = $con->query("SELECT joining_date from candidate_form_details WHERE id='$candid_id'");
        $doj_sql_res = $doj_sql->fetch(PDO::FETCH_ASSOC);
        $doj = $doj_sql_res['joining_date'];

        //Account details
        $acc_sql = $con->query("SELECT acc_number,ifsc,acc_holder_name FROM emp_personal_details where emp_id='$candid_id'");
        $acc_sql_res = $acc_sql->fetch(PDO::FETCH_ASSOC);

        //Days of working		
        $days_sql = $con->query("SELECT total_no_of_days,days_worked FROM payroll_salary_deduction where employee_code='$employee_id' and payroll_month='$m' and payroll_year='$y' and total_no_of_days is not null limit 0,1");

        $dates = explode("-", $pay_period);

        // Trim whitespace and convert date strings to standard format
        $start_date_str = trim($dates[0]);
        $end_date_str = trim($dates[1]);

        // Convert date strings to standard format
        $start_date = date("Y-m-d", strtotime($start_date_str));
        $end_date = date("Y-m-d", strtotime($end_date_str));

        if ($days_sql) {
            if ($days_sql->rowCount() > 0) {
                while ($days_sql_res = $days_sql->fetch(PDO::FETCH_ASSOC)) {
                    if ($days_sql_res != '') {
                        $month_days = (float) $days_sql_res['total_no_of_days']; //float value like30.0

                        $work_days = (float) $days_sql_res['days_worked']; //working days
                    } else {
                        echo json_encode([
                            "status" => 'error',
                            'message' => 'Payslip Generation is Pending'
                        ]);
                        exit();
                    }
                }

                //Earnings		
                $earning_sql = $con->query("SELECT earnings,amount FROM payroll_salary_earnings WHERE payroll_month='$m' and payroll_year='$y' and employee_code='$employee_id' order by id asc");

                $earnings = array();
                $amount = array();

                while ($earning_sql_res = $earning_sql->fetch(PDO::FETCH_ASSOC)) {
                    $earnings[] = $earning_sql_res['earnings'];
                    $amount[] = $earning_sql_res['amount'];
                }

                //Earned salary START
                $earned_sql = $con->query("SELECT earnings,amount FROM payroll_earned_salary WHERE payroll_month='$m' and payroll_year='$y' and  employee_code='$employee_id' order by id asc");

                $earned_amount = array();

                while ($earned_sql_res = $earned_sql->fetch(PDO::FETCH_ASSOC)) {
                    $earned_name = $earned_sql_res['earnings'];
                    $earned_amount[$earned_sql_res['earnings']] = $earned_sql_res['amount'];
                }
                //Earned salary END

                $gross_salary = array_sum($earned_amount);

                //deductions		
                $earning_sql = $con->query("SELECT * FROM payroll_salary_deduction WHERE payroll_month='$m' and payroll_year='$y' and employee_code='$employee_id' order by id asc");

                $deduction = array();
                $ded_amount = array();

                while ($earning_sql_res = $earning_sql->fetch(PDO::FETCH_ASSOC)) {
                    $deduction[] = $earning_sql_res['deduction'];
                    $ded_amount[$earning_sql_res['deduction']] = $earning_sql_res['amount'];
                }
                $deduction_total = array_sum($ded_amount);
                $number = $gross_salary - $deduction_total;

                $salstrcutre = $con->query("SELECT * FROM `joining_detail_sal_structure` where candid_id='$candid_id'");
                $getdetails = $salstrcutre->fetch(PDO::FETCH_ASSOC);


                if ($m < 10) {
                    $mmm = '0' . $m;
                    $arrmy = $y . '-' . $mmm;
                } else {
                    $arrmy = $y . '-' . $m;
                }

                $month_days = (float)$month_days;
                $work_days  = (float)$work_days;

                $basic_month = (float)($getdetails['basic_month'] ?? 0);
                $hra_month   = (float)($getdetails['HRA_month'] ?? 0);
                $oa_month    = (float)($getdetails['otherallowances_permonth'] ?? 0);
                $pt_month    = (float)($getdetails['professionaltax_permonth'] ?? 0);

                if ($month_days > $work_days) {

                    //basic & DA
                    $basic_per_day = $basic_month / $month_days;
                    $basicDA = $basic_per_day * $work_days;

                    //HRA
                    $hra_per_day   = $hra_month / $month_days;
                    $hra     = $hra_per_day * $work_days;

                    // Other allowance
                    $oa_per_day    = $oa_month / $month_days;
                    $oa      = $oa_per_day * $work_days;
                } else {

                    //basic DA
                    $basicDA = $basic_month;

                    //HRA
                    $hra     = $hra_month;

                    // Other allowance
                    $oa      = $oa_month;
                }

                $pfcalc = $basicDA + $oa;
                $defaultpf = 1800;
                if ($pfcalc > 15000) {
                    $pfamount = $defaultpf;
                } else {
                    //$work_days1 = 12;
                    if ($work_days < 15) {
                        $pfcal = $defaultpf / $month_days;
                        $pfemp = $pfcal * $work_days;
                        $pfamount = (float)($pfemp);
                    } else {
                        $pfamount   = (float)($getdetails['pfamount'] ?? 0);
                    }
                }

                $arrerpay = $con->query("SELECT remark,sum(amount) as arrearamt FROM `arrear_pay` WHERE emp_id='$candid_id' and payroll_month='$arrmy'");
                $arrdetails = $arrerpay->fetch(PDO::FETCH_ASSOC);

                if ($arrdetails) {
                    $reamrkofarrear = $arrdetails['remark'];
                    $arrearamt_get = $arrdetails['arrearamt'];
                }

                $gross_salary = $basicDA + $hra + $oa;
                $esicamount = 0; // Initialize esicamount to 0 by default.

                $deduction_total = $pfamount + $esicamount + $pt_month;


                if ($gross_salary <= 21000) {
                    $esicamount = (float)($getdetails['employee_ESIC_month'] ?? 0);
                }

                //Net salary
                $net_salary   = $gross_salary - $deduction_total;

                // $number = $gross_salary - $deduction_total + $arrearamt_get;

                // $netSalary = number_format($number, 2);

                $formatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                $words = $formatter->format($net_salary);

                $stringNumber = ucfirst($words) . " Rupees Only";

                // if ($month_days > $work_days) {

                //     //basic & DA
                //     $salacalc = $getdetails['basic_month'] / $month_days;
                //     $basicdasal = $salacalc * $work_days;
                //     $basicdasalRoundOff =  round($basicdasal, 2);

                //     //PF Employee
                //     $salacalc = $getdetails['basic_month'] / $month_days;
                //     $basicdasal = $salacalc * $work_days;
                //     $finalbasic = round($basicdasal, 2); // basic+DA

                //     $oacalc = $getdetails['otherallowances_permonth'] / $month_days;
                //     $otherallowance = $oacalc * $work_days;
                //     $finaloa = round($otherallowance, 2); // Other allowance

                //     //HRA
                //     $hraamountcalc = (float)($getdetails['HRA_month'] ?? 0) / $month_days;
                //     $HRA = $hraamountcalc * $work_days;

                //     $hraRoundOff = round($HRA, 2);

                //     //Other Allowances
                //     $oacalc = (float)($getdetails['otherallowances_permonth'] ?? 0) / $month_days;
                //     $otherallowance = $oacalc * $work_days;
                //     $otherallowanceRoundOff = round($otherallowance, 2);

                //     //Professional Tax
                //     $professionaltaxPermonth = $getdetails['professionaltax_permonth'] != '' ? round($getdetails['professionaltax_permonth'], 2) : '';
                // } else {



                //     //basic DA
                //     $basicdasalRoundOff = $getdetails['basic_month'];

                //     //PF Employee
                //     $basicdasal = $getdetails['basic_month'];
                //     $finalbasic = round($basicdasal, 2); // basic+DA

                //     $otherallowance = (float)($getdetails['otherallowances_permonth'] ?? 0);
                //     $finaloa = round($otherallowance, 2); // Other allowance

                //     //HRA
                //     $HRA = (float)($getdetails['HRA_month'] ?? 0);
                //     $hraRoundOff = round($HRA, 2);

                //     //Other Allowances
                //     $otherallowance = $getdetails['otherallowances_permonth'];
                //     $otherallowanceRoundOff = round($otherallowance, 2);

                //     //Professional Tax
                //     $professionaltaxPermonth = $getdetails['professionaltax_permonth'] != '' ? round($getdetails['professionaltax_permonth'], 2) : '';
                // }

                // $pfcalc = $finalbasic + $finaloa;
                // $defaultpf = 1800;
                // if ($pfcalc > 15000) {
                //     $pfamount = $defaultpf;
                // } else {
                //     //$work_days1 = 12;
                //     if ($work_days < 15) {
                //         $pfcal = $defaultpf / $month_days;
                //         $pfemp = $pfcal * $work_days;
                //         $pfamount = round($pfemp, 2);
                //     } else {
                //         $pfamount = $getdetails['employee_PF_month'];
                //     }
                // }

                // $arrerpay = $con->query("SELECT remark,sum(amount) as arrearamt FROM `arrear_pay` WHERE emp_id='$candid_id' and payroll_month='$arrmy'");
                // $arrdetails = $arrerpay->fetch(PDO::FETCH_ASSOC);

                // if ($arrdetails) {
                //     $reamrkofarrear = $arrdetails['remark'];
                //     $arrearamt_get = $arrdetails['arrearamt'];
                // }

                // $gross_salary = $basicdasal + $HRA + $otherallowance;
                // $gross_salary = $basicdasal + $HRA + $otherallowance;
                // $esicamount = 0; // Initialize esicamount to 0 by default.

                // $gross_salary = $basicdasal + $HRA + $otherallowance;
                // $deduction_total = $pfamount + $esicamount + (float)($getdetails['professionaltax_permonth'] ?? 0);


                // if ($gross_salary <= 21000) {
                //     $esicamount = $getdetails['employee_ESIC_month'];
                // }

                // //Net salary
                // $number = $gross_salary - $deduction_total + $arrearamt_get;

                // $netSalary = number_format($number, 2);

                // $formatter = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                // $words = $formatter->format($number);

                // $stringNumber = ucfirst($words) . " Rupees Only";
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'You Not Upload Attendace For This Candidate!...'
                ]);
                exit();
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Candidate!...'
            ]);
        }
    }

    echo json_encode([

        "status" => 'success',
        'pay_period' => $pay_period,

        //Employee Details
        'emp_name' => $emp_name,
        'doj' => $doj,
        'emp_id' => $emp_id,
        'pan_no' => $pan_no,
        'designation_name' => $designation_name,
        'uan_no' => $uan_no,
        'dep_name' => $dep_name,
        'esi_no' => $esi_no,
        'bank' => $bank,
        'acc_number' => $acc_number,
        'pf_no' => $pf_no,
        'loc' => $loc,
        'month_days' => $month_days,
        'work_days' => $work_days,

        //Earnings
        // 'basicDA' => $basicdasalRoundOff,
        // 'hra' => $hraRoundOff,
        // 'otherallowanceRoundOff' => $otherallowanceRoundOff,

        // //total earning
        // 'salary' => $gross_salary,

        // //Deductions
        // 'pfamount' => $pfamount,
        // 'esicamount' => $esicamount,
        // 'professionaltax_permonth' => $professionaltaxPermonth,
        // 'deduction_total' => $deduction_total,

        'basicDA'                  => round($basicDA, 2),
        'hra'                      => round($hra, 2),
        'otherallowanceRoundOff'   => round($oa, 2),
        'salary'                   => round($gross_salary, 2),
        'pfamount'                 => round($pfamount, 2),
        'esicamount'               => round($esicamount, 2),
        'professionaltax_permonth' => round($pt_month, 2),
        'deduction_total'          => round($deduction_total, 2),
        'net_salary'               => round($net_salary, 2),

        //Arrear_pay
        'reamrkofarrear' => $reamrkofarrear,
        'arrearamt_get' => $arrearamt_get,

        //Net Salary
        // 'net_salary' => $netSalary,
        'string_number' => $stringNumber,



        // 'earnings' => $earnings,
        // 'amount' => $amount,
        // 'earned_name' => $earned_name,
        // 'earned_amount' => $earned_amount,
        // 'deduction_total' => $deduction_total,
        // 'number' => $number,
    ]);
} catch (Exception $e) {
    echo json_encode([
        "status" => 'error',
        'message' => 'DB Error' . $e
    ]);
}
