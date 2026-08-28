<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<div class="col-md-12" style="text-align: end;margin: 5px;">
	<a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="ExportToExcel('xlsx')">
		<span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
	<!-- <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="tableToExcel('main', 'List User')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp; -->
</div>

<table class="dataTables-example table table-striped table-bordered table-hover" id="tbl_exporttable_to_xls">
	<thead>
		<tr>
			<th>S.No</th>
			<th>Employee Code</th>
			<th>Employee Name</th>
			<th>Department Name</th>
			<th>Present for the month</th>
			<th>Leave/Absent for the month</th>
			<th>LOP</th>
			<th>Total Working Days</th>


			<th>Permission Dates</th>
			<th>Late Dates</th>
			<th>Leave Dates</th>
			<th>Absent Dates</th>

			<th>Total Pay Days</th>

			<th>Late Salary Deduction Days</th>
			<th>No of Late</th>
			<th>Permission</th>
			<th>Weak Off</th>
			<th>Saturday</th>
			<th>Govt Holiday</th>
		</tr>
	</thead>
	<tbody>
		<?php
		require '../../../connect.php';

		$attFromDate = $_REQUEST['attFromDate'];
		$attToDate = $_REQUEST['attToDate'];

		$fromDate = preg_split("/\-/", $attFromDate);
		$from_year = $fromDate[0]; //Year
		$from_month = $fromDate[1]; //Month

		$toDate = preg_split("/\-/", $attToDate);
		$to_year = $toDate[0]; //Year 
		$to_month = $toDate[1]; //Month

		$in_log_date = $from_year . '-' . $from_month . '-01';
		$last_log_date = $to_year . '-' . $to_month . '-01';
		$out_log_date = date("Y-m-t", strtotime($last_log_date));

		$dateMonthYearArr = array();
		$in_log_dateTS = strtotime($in_log_date);
		$out_log_dateTS = strtotime($out_log_date);

		for ($currentDateTS = $in_log_dateTS; $currentDateTS <= $out_log_dateTS; $currentDateTS += (60 * 60 * 24)) {
			$currentDateStr = date("Y-m-d", $currentDateTS);
			$dateMonthYearArr[] = $currentDateStr;
		}

		$sundays  = 0;
		$saturday = 0;

		for ($i = 0; $i < sizeof($dateMonthYearArr); $i++) {
			$date = $dateMonthYearArr[$i];
			$day = date('D', strtotime($date));

			if (($day == "Sun")) {
				$sundays = $sundays + 1;
			}

			if ($day == "Sat") {
				$saturday = $saturday + 1;
			}
		}


		//get payroll_master details
		$staff_sql = $con->query("SELECT a.*,c.dept_name as dept_name FROM staff_master a  left join bb_attendance b on (a.id = b.emp_code) left join z_department_master c on (a.dep_id=c.id) where  a.status=1 and (( month(b.in_log_date) between '$from_month' and '$to_month') or ( year(b.in_log_date)  between '$from_year' and '$to_year')) group by b.emp_code ");

		$p = 1;
		while ($staff_sql_res = $staff_sql->fetch(PDO::FETCH_ASSOC)) {

			$employee_id = $staff_sql_res['id'];
			$employee_code = $staff_sql_res['prefix_code'] . $staff_sql_res['emp_code'];
			$emp_name = $staff_sql_res['emp_name'];
			$dept_name = $staff_sql_res['dept_name'];
			$salary_amount = $staff_sql_res['salary_amount'];
			$deduct_id = $staff_sql_res['payroll_deduction_id'];

			$absent_sql = $con->query("SELECT a.*,b.status as absent_status,b.in_log_date as in_log_date,b.emp_code as emp_code FROM staff_master a  left join bb_attendance b on (a.id = b.emp_code) where a.id = '$employee_id' and  a.status=1 and (b.status=0 OR b.status=5) and (( month(b.in_log_date) between '$from_month' and '$to_month') or ( year(b.in_log_date)  between '$from_year' and '$to_year'))");
			$absent_status = array();
			while ($absent_sql_res = $absent_sql->fetch(PDO::FETCH_ASSOC)) {

				$absent_status[] = $absent_sql_res['in_log_date'];
			}
			$absentList = implode(', ', $absent_status);

			/* leave dates */
			$leave_dates_sql = $con->query("SELECT a.*,b.status as absent_status,b.in_log_date as in_log_date,b.emp_code as emp_code FROM staff_master a  left join bb_attendance b on (a.id = b.emp_code) where a.id = '$employee_id' and  a.status=1 and (b.status=2 OR b.status=3 OR b.status=4 OR b.status=6) and (( month(b.in_log_date) between '$from_month' and '$to_month') or ( year(b.in_log_date)  between '$from_year' and '$to_year'))");

			$leave_dates_status = array();
			while ($leave_dates_sql_res = $leave_dates_sql->fetch(PDO::FETCH_ASSOC)) {

				$leave_dates_status[] = $leave_dates_sql_res['in_log_date'];
			}
			$leavedatesList = implode(', ', $leave_dates_status);

			/* end leave dates */


			$holiday_sql = $con->query("SELECT leave_date FROM holiday_master where (( month(leave_date) between '$from_month' and '$to_month') and ( year(leave_date)  between '$from_year' and '$to_year'))");

			$holiday_status = array();
			while ($holiday_sql_res = $holiday_sql->fetch(PDO::FETCH_ASSOC)) {

				$holiday_status[] = $holiday_sql_res['leave_date'];
			}
			$holidayList = implode(', ', $holiday_status);

			/* end holiday master */

			//Days of working		
			$days_sql = $con->query("SELECT total_no_of_days,days_worked FROM payroll_salary_deduction where (( payroll_month between '$from_month' and '$to_month') or ( payroll_year  between '$from_year' and '$to_year')) and employee_code='$employee_id' and total_no_of_days is not null limit 0,1");


			$days_sql_res = $days_sql->fetch(PDO::FETCH_ASSOC);
			$month_days = $days_sql_res['total_no_of_days'];
			$work_days = $days_sql_res['days_worked'];
			$leave = $month_days - $work_days;

			//Earnings
			$earning_sql = $con->query("SELECT earnings,amount FROM payroll_salary_earnings WHERE (( payroll_month between '$from_month' and '$to_month') or ( payroll_year between '$from_year' and '$to_year'))  and employee_code='$employee_id' order by id asc");

			$amount = array();

			while ($earning_sql_res = $earning_sql->fetch(PDO::FETCH_ASSOC)) {
				$ear_name = $earning_sql_res['earnings'];
				$amount[$ear_name] = $earning_sql_res['amount'];
			}

			//Earned salary START
			$earned_sql = $con->query("SELECT earnings,amount FROM payroll_earned_salary WHERE  ((payroll_month between '$from_month' and '$to_month') or (payroll_year  between '$from_year' and '$to_year'))  and employee_code='$employee_id' order by id asc");

			$earned_amount = array();

			while ($earned_sql_res = $earned_sql->fetch(PDO::FETCH_ASSOC)) {
				$earned_name = $earned_sql_res['earnings'];
				$earned_amount[$earned_name] = $earned_sql_res['amount'];
			}
			$gross_salary = array_sum($earned_amount);
			//Earned salary END

			//deductions		
			$earning_sql = $con->query("SELECT * FROM payroll_salary_deduction WHERE (( payroll_month between '$from_month' and '$to_month') or ( payroll_year  between '$from_year' and '$to_year')) and employee_code='$employee_id' order by id asc");

			$deduction = array();
			$ded_amount = array();

			while ($earning_sql_res = $earning_sql->fetch(PDO::FETCH_ASSOC)) {
				$deduction_name = $earning_sql_res['deduction'];
				$ded_amount[$deduction_name] = $earning_sql_res['amount'];
			}

			$deduction_total = array_sum($ded_amount);
			$number = $gross_salary - $deduction_total;

			if (array_key_exists("Loss Of Pay", $ded_amount)) {
				$lop_add = $ded_amount['Loss Of Pay'];
			} else {
				$lop_add = 0;
			}

			$ear_amount = $gross_salary - $lop_add;

			if (array_key_exists("PF", $ded_amount)) {
				$pfamt = $ded_amount['PF'];
			} else {
				$pfamt = 0;
			}

			if (array_key_exists("PT", $ded_amount)) {
				$ptamt = $ded_amount['PT'];
			} else {
				$ptamt = 0;
			}

			if (array_key_exists("Salary Advance", $ded_amount)) {
				$SalaryAdvanceamt = $ded_amount['Salary Advance'];
			} else {
				$SalaryAdvanceamt = 0;
			}

			if (array_key_exists("TDS", $ded_amount)) {
				$tdsamt = $ded_amount['TDS'];
			} else {
				$tdsamt = 0;
			}
			//$gross_amount= $salary_amount+$esiamt;  //+$clbamt

			//SAD 
			if (array_key_exists("SAD", $ded_amount)) {
				$sadamt = $ded_amount['SAD'];
			} else {
				$sadamt = 0;
			}

			//NET Salary
			if (array_key_exists("ESIC", $ded_amount)) {
				$ear_esi = round($ear_amount * 0.75 / 100);
			} else {

				$ear_esi = 0;
			}
			$net_amount = $ear_amount - $pfamt - $ear_esi - $tdsamt - $sadamt - $ptamt - $SalaryAdvanceamt; //-$clbamt

			////////////////////////////// Actual ESIC ///////////////////////////////////
			if (array_key_exists("ESIC", $ded_amount)) {
				$actual_asi = round($salary_amount * 0.75 / 100);
			} else {

				$actual_asi = 0;
			}

			//////////////////////////////// Actual PF /////////////////////////////////////

			$deduct_sql = $con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status FROM payroll_deduction_master where id in ($deduct_id)");

			while ($deduct_data = $deduct_sql->fetch(PDO::FETCH_ASSOC)) {

				$deduction = $deduct_data['name'];
				$deduct_amount = $deduct_data['amount'];
				$percentage = $deduct_data['percentage'];

				if ($deduct_amount == 0 && $deduction == 'PF') {
					if ($deduction == 'PF') {
						$PFamount = round($salary_amount * $percentage / 100);
					}
				} elseif ($deduct_amount > 0 && $deduction == 'PF') {
					$PFamount = $deduct_amount;   //When salary more than 15K the PF deduction is RS.1800/- as default;
				} else {
					$PFamount = 0;
				}
			}
		?>
			<tr>
				<td><?php echo $p++; ?></td>
				<td><?php echo $employee_code; ?></td>
				<td><?php echo $emp_name; ?></td>
				<td><?php echo $dept_name; ?></td>
				<td><?php echo $work_days; ?></td>
				<td><?php echo $leave; ?></td>
				<td><?php if (array_key_exists("Loss Of Pay", $ded_amount)) {
						echo number_format($ded_amount['Loss Of Pay'], 2);
					} else {
						echo 0;
					} ?></td>
				<td><?php echo $month_days; ?></td>
				<td>0</td>
				<td>0</td>
				<td><?php echo ($leavedatesList) ? $leavedatesList : 0; ?></td>
				<td><?php echo ($absentList) ? $absentList : 0 ; ?></td>
				<td><?php echo $work_days; ?></td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td><?php echo $sundays; ?></td>

				<td><?php echo $saturday; ?></td>
				<td><?php echo ($holidayList) ? $holidayList : 0; ?></td>

			</tr>
		<?php } ?>
	</tbody>
</table>

<script type="text/javascript">
	var tableToExcel = (function() {
		var uri = 'data:application/vnd.ms-excel;base64,',
			template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
			base64 = function(s) {
				return window.btoa(unescape(encodeURIComponent(s)))
			},
			format = function(s, c) {
				return s.replace(/{(\w+)}/g, function(m, p) {
					return c[p];
				})
			}
		return function(table, name) {
			if (!table.nodeType) table = document.getElementById(table)
			var ctx = {
				worksheet: name || 'Worsheet',
				table: table.innerHTML
			}

			window.location.href = uri + base64(format(template, ctx))
		}
	})()

	$(function() {

		$('#tbl_exporttable_to_xls').DataTable({
			//   "paging": true,
			//   "lengthChange": true,
			//   "searching": true,
			//   "ordering": true,
			//   "info": true,
			//   "responsive": true,
			//   "autoWidth": true,
			"scrollX": true,
			"scrollY": 200,
		});
	});

	function ExportToExcel(type, fn, dl) {
		var elt = document.getElementById('tbl_exporttable_to_xls');
		var wb = XLSX.utils.table_to_book(elt, {
			sheet: "sheet1"
		});
		return dl ?
			XLSX.write(wb, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			}) :
			XLSX.writeFile(wb, fn || ('SS_Employee_Attendance_Reports.' + (type || 'xlsx')));
	}
</script>
</body>

</html>