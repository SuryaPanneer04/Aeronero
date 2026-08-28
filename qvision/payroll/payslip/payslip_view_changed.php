<?php
require '../../../connect.php';

$month = $_REQUEST['month'];
$year = $_REQUEST['year'];

// echo $month;

$add_zero = sprintf('%08d', $month);
$remove = substr($add_zero, -2);    //To add prefix zero for month becuase the DOJ and Payroll Month data mismatch when not zero.  
$currentYearMonth = $year . "-" . $remove;  //To find the Employee DOJ is same as Payroll Month.

//payroll update
$payroll_update = $con->query("update payroll_master set flag=2 where month='$month' and year='$year' and flag=1");

if ($payroll_update) {
	//payroll for Onroll EmployeeCode

	$in_log_date = $year . '-' . $month . '-01';
	$out_log_date = date("Y-m-t", strtotime($in_log_date));

	$dateMonthYearArr = array();
	$in_log_dateTS = strtotime($in_log_date);
	$out_log_dateTS = strtotime($out_log_date);
/////////////////// Count the days in Current Month using payroll MONTH and YEAR  ///////////////////////////
	for ($currentDateTS = $in_log_dateTS; $currentDateTS <= $out_log_dateTS; $currentDateTS += (60 * 60 * 24)) {
		$currentDateStr = date("Y-m-d", $currentDateTS);
		$dateMonthYearArr[] = $currentDateStr;
	}
/////////////////// Month Days Count End /////////////////////////

	//Holiday start here 
	$datequery = $con->query("select leave_date from holiday_master where year=year('$in_log_date')");
	while ($result_query = $datequery->fetch(PDO::FETCH_ASSOC)) {
		$GOV_HOLIDAY[] = $result_query['leave_date'];
	}

//employee start loop here  

	//$inndate1=$con->query("SELECT id as emp_no FROM staff_master WHERE status=1  and prefix_code in ('QSPLO','QSPLE','QSPLC')");

	//$inndate1=$con->query("select emp_code from (SELECT distinct emp_code FROM `qds_attendance` WHERE year(in_log_date)='$year' AND month(in_log_date)='$month' union  select distinct emp_code from manual_att where year(date)='$year' AND month(date)='$month') a");

	$inndate1 = $con->query("SELECT id,candid_id,DOJ,DOE FROM `staff_master` WHERE status=1");
	while ($att_result_query = $inndate1->fetch(PDO::FETCH_ASSOC)) {
		$emp_no = $att_result_query['id'];
		$candid = $att_result_query['candid_id'];
		$DOJ = $att_result_query['DOJ'];
		$dateOfJoining  = strtotime($DOJ); //Date format for calculate working days count using for loop.
		$check_doj = date('Y-m', strtotime($DOJ)); // To check the DOJ and CurrentYEARMONTH are same for Generate Payroll from that date.
		$DOE = $att_result_query['DOE'];    //Date Of Exit.
		$dateOfExit  = strtotime($DOE); //Date format for calculate working days count using for loop.
		$check_doe = date('Y-m', strtotime($DOE)); // To check the DOE and CurrentYEARMONTH are same for Generate Payroll from that date.

		$day_count = 0;
		$sundays = 0;
		$saturday_count = 0;
		$att_count = 0;
		$leave_count = 0; //LOP count
		$approvecount = 0; //Approved Leave count

		$DateFromDOJ = []; // Initialize $DateFromDOJ as an empty array

// counting days from the JOINING DATE
if ($currentYearMonth != $check_doj) { // Checks if the DOJ and Payroll Month are the same to calculate the working days
    $DateFromDOJ = []; // Ensure $DateFromDOJ is empty before populating it

    // Loop through each day from $dateOfJoining to $out_log_dateTS
    for ($empDOJ = $dateOfJoining; $empDOJ <= $out_log_dateTS; $empDOJ += (60 * 60 * 24)) {
        $currentDateStr = date("Y-m-d", $empDOJ);
        $DateFromDOJ[] = $currentDateStr; // Add each date to the $DateFromDOJ array
    }

    $DOJcount = count($DateFromDOJ); // Count the number of dates in $DateFromDOJ
    $leaveCheckDate = $DateFromDOJ; // Optionally assign $DateFromDOJ to $leaveCheckDate if needed
}

		elseif ($currentYearMonth != $check_doe) //Checks the DOE[Date Of Exit] and Payroll Month are same to calculate the working days.
		{
			$DateTillDOE = []; // Initialize the array


			array_splice($DateTillDOE, 0);

			for ($empDOE = $in_log_dateTS; $empDOE <= $dateOfExit; $empDOE += (60 * 60 * 24)) {
				$TillExitDate = date("Y-m-d", $empDOE);
				$DateTillDOE[] = $TillExitDate;
			}

			$DOJcount = count($DateTillDOE);
			$leaveCheckDate = $DateTillDOE;
		}
		else {    //if the employee joining date or exit date is not in Payroll Month Then date count from the month starting.
			$DOJcount = sizeof($dateMonthYearArr);
			$leaveCheckDate = $dateMonthYearArr;
		}
		//// Days counting loop end //// 


          //$monthssss= sprintf('%02d', $month);
		  $monthssss='0'.$month;

		for ($i = 0; $i < $DOJcount; $i++) {
			$date = $leaveCheckDate[$i];
			$day = date('D', strtotime($date));


			$dayquery = $con->query("SELECT COUNT(*) ,count(date) as leave_count FROM `daily_attendence` WHERE candid_id='$candid' and month='$monthssss' and year='$year' and status=2");
			//echo "SELECT COUNT(*) ,count(date) as leave_count FROM `daily_attendence` WHERE candid_id='$candid' and month='$monthssss' and year='$year' and status=2";
			$count = $dayquery->fetchColumn();
			$getleavecnt = $dayquery->fetch();
			if($getleavecnt)
			{
				$leavecntt=$getleavecnt['leave_count']; //dailyatt_leavecnt

			}
			
			else
			{
				 $leavecntt=0; //dailyatt_leavecnt

			}



			$halfdayquery = $con->query("SELECT COUNT(*) ,count(date) as leave_count FROM `daily_attendence` WHERE candid_id='$candid' and month='$monthssss' and year='$year' and status=2 and halfday=1");
			//echo "SELECT COUNT(*) ,count(date) as leave_count FROM `daily_attendence` WHERE candid_id='$candid' and month='$monthssss' and year='$year' and status=2 and halfday=1";			//$halfcount = $halfdayquery->fetchColumn();
			$halfgetleavecnt = $halfdayquery->fetch();
			if($halfgetleavecnt)
			{
				$halfleave_get=$halfgetleavecnt['leave_count']; //dailyatt_leavecnt
                $halfleavecntt=$halfleave_get * 0.5;
           //   echo $halfleave_get.'**';

			}
			
			else
			{
				$halfleavecntt=0; //dailyatt_leavecnt

			}





		
				//echo 'esle';
				$approveleave = $con->query("SELECT count(*) as leavecntng,leave_type,no_of_days FROM `leave_apply_masters` WHERE candid_id='$candid' and status=2 and req_date='$date'");
				$leavecount = $approveleave->fetch();

				$leave_type = $leavecount['leave_type'];

				$getleavecount=$con->query("SELECT count(no_of_days) As leavecnt
				FROM leave_apply_masters 
				WHERE  candid_id='$candid' AND status=2 AND YEAR(from_date) = '$year' AND MONTH(from_date) ='$month' 
				  AND YEAR(to_date) = '$year' AND MONTH(to_date) = '$month'");
				 /* echo "SELECT round(no_of_days) As leavecnt
				  FROM leave_apply_masters 
				  WHERE  candid_id='$candid' AND status=2 AND YEAR(from_date) = '$year' AND MONTH(from_date) ='$month' 
					AND YEAR(to_date) = '$year' AND MONTH(to_date) = '$month'";*/

				  $appylleavecnt = $getleavecount->fetch();

				if($appylleavecnt){
				
				$total_leave_taken = round($appylleavecnt['leavecnt']);//leave apply days cnt

				}
				else
				{
					$total_leave_taken=0;
				}
		  $totaltleave= $total_leave_taken + $leavecntt +$halfleavecntt;

			if ($leavecount['leavecntng'] > 0) {

					if ($leave_type == 4) {

						$leave_count = $leave_count + $total_leave_taken;
						 $leave_count;
					} else {
						$approvecount = $approvecount + $total_leave_taken;
						$approvecount;
					}
				
			}


			$dayquerys = $con->query("SELECT count(*) FROM manual_att where date='$date' and emp_code='$emp_no'");
			$count = $dayquery->fetchColumn();
			if ($count > 0) {
				$day_count = $day_count + 1;
			}


			if (($day == "Sun")) {
				$sundays = $sundays + 1;
			}

			if ($day == "Sat") {
				$saturday_count = $saturday_count + 1;
				if ($saturday_count % 2 == 0) {
					$day_count = $day_count + 1;
				}
			}

		}  // For Loop END


		
//echo $totaltleave;
		if ($totaltleave>1) {
			//$Sat_sun =$day_count+$sundays; 	

			$total_leave_count =$totaltleave-1;
			$month_count = $DOJcount;

			$days_worked = $month_count - $total_leave_count;
		} else {
			$days_worked = $DOJcount;
		}
//echo $days_worked.'kjhgfdfghjkl';
        $totalDaysFromjoining = $DOJcount;
		$total_working_days = sizeof($dateMonthYearArr);
		//$lop = $total_working_days - $days_worked;
		$lop = $leave_count;

		if ($lop == 1) {
		} else if ($lop == 2) {
		} else if ($lop == 3) {
		} else {
		}
//echo $leave_count.'&&';
		$staff_data_sql = $con->query("SELECT  id as emp_no, prefix_code as pcode,emp_name,dep_id as department_id,design_id as designation_id, scale_master_id, payroll_deduction_id,salary_amount,varaible_pay,(salary_amount*varaible_pay/100) as final_pay,status FROM staff_master where status=1 and id='$emp_no'");

		while ($sm_data = $staff_data_sql->fetch(PDO::FETCH_ASSOC)) {
			$pcode = $sm_data['pcode'];
			$emp_code = $sm_data['emp_no'];
			$emp_name = $sm_data['emp_name'];
			$scale_id = $sm_data['scale_master_id'];
			$salary_amount = $sm_data['final_pay'];
			$deduct_id = $sm_data['payroll_deduction_id'];
			$scale_head_sql = $con->query("SELECT a.payroll_master_id, a.payroll_master_name, a.salary_structure_id, a.salary_structure_name,b.amount as amttt,b.percentage,a.status FROM payroll_scale_details a join  payroll_structure b on a.salary_structure_id=b.id where a.payroll_master_id='$scale_id'");
//echo "SELECT a.payroll_master_id, a.payroll_master_name, a.salary_structure_id, a.salary_structure_name,b.amount as amttt,b.percentage,a.status FROM payroll_scale_details a join  payroll_structure b on a.salary_structure_id=b.id where a.payroll_master_id='$scale_id'";
			////////////////////////////////////////////////////////////////////////////////////////////////////////
						$earned_gross = $salary_amount * ($days_worked / $total_working_days);
			////////////////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////////// EARNINGS PART //////////////////////////////////////////////////////////

			while ($scale_head_data = $scale_head_sql->fetch(PDO::FETCH_ASSOC)) {
				$salary_structure_id = $scale_head_data['salary_structure_id'];
				$earnings = $scale_head_data['salary_structure_name'];
				$struct_amount = $scale_head_data['amttt'];

				if ($struct_amount == 0) {
					$percentage = $scale_head_data['percentage'];
					$amount = $earned_gross * $percentage / 100;
				} else {
					$amount = $struct_amount;
				}

				$data = array($date, $month, $year, $emp_code, $emp_name, $earnings, $amount, 1, 1, $date); //payroll Initial Status = 1.
				$stmt = $con->prepare("INSERT INTO payroll_salary_earnings(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");

				if($month<=9){

					$mon = '0'.$month;
				}else{
				
					$mon = $month;
				}
				$levqry =  $con->prepare("SELECT *,COUNT(date) as lev FROM `daily_attendence` WHERE month ='$mon' group  by emp_code ");
				
				while($row =  $levqry->fetch(PDO::FETCH_ASSOC)){

					$emp_idcode = $row['emp_code'];
				echo  $emp_idcode;
				

				}
				

				
		// 		echo "<pre>";
		// echo "INSERT INTO payroll_salary_earnings(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)";
		// echo "</pre>";

				$stmt->execute($data);
			}

			/////////////////////////////////////// ARREAR PAY //////////////////////////////////////////////////

			$arrear_sql = $con->query("SELECT amount FROM arrear_pay where payroll_month = '$currentYearMonth' &&  emp_id = '$emp_no' && status =1 ");	

			$count = $arrear_sql->rowCount();
			if ($count > 0) {

				$arrear_data = $arrear_sql->fetch(PDO::FETCH_ASSOC);

				$arrear_amnt = $arrear_data['amount'];
               
				$data = array($date, $month, $year, $emp_code, $emp_name,'ARREAR PAY', $arrear_amnt, 1, 1, $date);
				$stmt = $con->prepare("INSERT INTO payroll_salary_earnings(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
				$stmt->execute($data);
			} 




 ///////////////////////////////////////////////////////// DEDUCTIONS PART ///////////////////////////////////////////////////
            if($deduct_id != '')
			{
			$deduct_sql = $con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status FROM payroll_deduction_master where id in ($deduct_id)");

			while ($deduct_data = $deduct_sql->fetch(PDO::FETCH_ASSOC)) {
				$id = $deduct_data['id'];
				$deduction = $deduct_data['name'];
				$from_date = $deduct_data['from_date'];
				$amount = $deduct_data['amount'];
				$percentage = $deduct_data['percentage'];
				$min_amount = $deduct_data['min_amount'];
				$max_amount = $deduct_data['max_amount'];

				if ($deduction == 'ESI') {

					$amount1 = $earned_gross * $percentage / 100;
				} else {
					$amount1 = 0;
				}

				$sqll = $con->query("SELECT sum(amount) as pf_amount from payroll_earned_salary where employee_code='$emp_no' and payroll_month='$month' and payroll_year='$year' and earnings!='HRA' and earnings!='Advance Amount' and earnings!='Advance Bonus' ");

				$queryy = $sqll->fetch(PDO::FETCH_ASSOC);
				$pf_amt = $queryy['pf_amount']; //Earned salary without HRA & Advance Bonus for PF.

				if (($deduction == 'PF') && ($pf_amt >= 15000)) {

			     $amount2 = '1800'; //If earned salary Greater than 15k then PF amount Rs.1800 is default. 

				} elseif (($deduction == 'PF') && ($pf_amt < 15000)) {

			     $amount2 = $pf_amt * 12 / 100; 
				} else {

				 $amount2 = 0; 
				}

				if ($deduction == 'CLUB') {
					$amount3 = $amount;
				} else {

					$amount3 = 0;
				}
				if ($deduction == 'TDS') {

					$amount4 = $earned_gross * $percentage / 100;

				} else {
					$amount4 = 0;
				}

				if(($deduction == 'PT') && ($earned_gross <= 3500)){ //3.5k
					$amount5 = 0;

				} elseif(($deduction == 'PT') && ($earned_gross > 3500 && $earned_gross <= 5000)){ //3.5k - 5k
					$amount5 = '22.5';

				} elseif(($deduction == 'PT') && ($earned_gross >= 5001 && $earned_gross <= 7500)){ //5.1k - 7500k
					$amount5 = '52.5';

				} elseif(($deduction == 'PT') && ($earned_gross >= 7501 && $earned_gross <= 10000)){ //7.6k - 10k
                    $amount5 = '115';

				} elseif(($deduction == 'PT') && ($earned_gross >= 10001 && $earned_gross <= 12500)){ //10.1k - 12.5k
                    $amount5 = '171';

				} elseif(($deduction == 'PT') && ($earned_gross > 12500)){ // Above 12.5k
                    $amount5 = '208';

				} else{
					$amount5 = 0;
				}

				

				$amount = $amount1 + $amount2 + $amount3 + $amount4 + $amount5;
			
					echo "<pre>";
		echo "3";
		echo "</pre>";
					$data = array($date, $month, $year, $emp_code, $emp_name, $deduction, $amount, $totalDaysFromjoining, $days_worked, 1, 1, $date);
					$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount,total_no_of_days,days_worked, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

					$stmt->execute($data);
				
			}
		}

/////////////////////////////////////// SALARY ADVANCE //////////////////////////////////////////////////

			$advance_sql = $con->query("SELECT * FROM salary_advance where MONTH(start_date) <= $month and MONTH(end_date) >= $month and emp_id='$emp_no'");

			// echo "SELECT * FROM salary_advance where MONTH(start_date) <= $month and MONTH(end_date) >= $month and YEAR(start_date)  <= $year and YEAR(end_date) >= $year and emp_id='$emp_no'";			

			$count = $advance_sql->rowCount();
			if ($count > 0) {
				//echo 'joooooo';
				$advance_data = $advance_sql->fetch(PDO::FETCH_ASSOC);

				$emp_id = $advance_data['emp_id'];
				$advance_amount = $advance_data['advance_amount'];
				$emi_period = $advance_data['emi_period'];
				$start_date = $advance_data['start_date'];
				$end_date = $advance_data['end_date'];
				$emi_amount = $advance_data['emi_amount'];

				$amount6 = $emi_amount;

				echo "<pre>";
		echo "4";
		echo "</pre>";
                
				$data = array($date, $month, $year, $emp_code, $emp_name, 'Salary Advance', $amount6, 1, 1, $date);
				$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
				$stmt->execute($data);
			} 
			
			if ($lop > 0) {

				echo "<pre>";
		echo "5";
		echo "</pre>";
				//echo 'jiiiii';
 				//$perday_amount = ($earned_gross / $total_working_days);
				$salaryForOneDay = $salary_amount/$total_working_days;
				$totalDaysOflop = $salaryForOneDay * $lop;
				$data = array($date, $month, $year, $emp_code, $emp_name, 'Loss Of Pay', $totalDaysOflop, 1, 1, $date);
				$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
				$stmt->execute($data);

				
			}
			else
			{
		// 		echo "<pre>";
		// echo "6";
		// echo "</pre>";
				$salaryForOneDay = $salary_amount/$total_working_days;
				$totalDaysOflop = $salaryForOneDay * $lop;
				$data = array($date, $month, $year, $emp_code, $emp_name, 'Loss Of Pay', $totalDaysOflop, 1, 1, $date);
				$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
				$stmt->execute($data);

				if($month<=9){

					$mon = '0'.$month;
				}else{
				
					$mon = $month;
				}
				$levqry =  $con->prepare("SELECT *,COUNT(date) as lev FROM `daily_attendence` WHERE month ='$mon' group  by emp_code ");
				
				// echo "SELECT *,COUNT(date) as lev FROM `daily_attendence` WHERE month ='$mon' group  by emp_code ";

				while($row =  $levqry->fetch(PDO::FETCH_ASSOC)){

				echo "SELECT *,COUNT(date) as lev FROM `daily_attendence` WHERE month ='$mon' group  by emp_code ";
				

				}
			}
		}
	}
	
	echo 1;
}

//////////////////////////// PAYROLL FOR ONROLL EMPLOYEECODE CLOSE HERE  ////////////////////////////////////////////////////// 		
