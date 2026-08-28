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
			<th>Present Dates</th>

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
		$emp_id = $_REQUEST['emp_name'];


		$attempFromDate = $_REQUEST['attempFromDate'];

		$fromempDate = preg_split("/\-/", $attempFromDate);
		$from_emp_year = $fromempDate[0]; //Year
		$from_emp_month = $fromempDate[1]; //Month



		$in_log_date = $from_emp_year . '-' . $from_emp_month . '-01';
		$out_log_date = date("Y-m-t", strtotime($in_log_date));

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


if($emp_id)
{
		    $staff_sql=$con->query("SELECT a.*,c.dept_name as dept_name FROM staff_master a  left join bb_attendance b on (a.emp_code = b.emp_code) left join z_department_master c on (a.dep_id=c.id) where a.id = '$emp_id' and  a.status=1 and year(b.in_log_date)='$from_emp_year' and month(b.in_log_date) = '$from_emp_month' group by b.emp_code ");	
			//echo "SELECT a.*,c.dept_name as dept_name FROM staff_master a  left join bb_attendance b on (a.emp_code = b.emp_code) left join z_department_master c on (a.dep_id=c.id) where a.id = '$emp_id' and  a.status=1 and year(b.in_log_date)='$from_emp_year' and month(b.in_log_date) = '$from_emp_month' group by b.emp_code";
		}else{
			 $staff_sql=$con->query("SELECT a.*,c.dept_name as dept_name FROM staff_master a  left join bb_attendance b on (a.emp_code = b.emp_code) left join z_department_master c on (a.dep_id=c.id) where a.status=1 and year(b.in_log_date)='$from_emp_year' and month(b.in_log_date) = '$from_emp_month' group by b.emp_code ");	
		}
		$p = 1;
		
		//get payroll_master details
		while($staff_sql_res = $staff_sql->fetch()){
		$employee_id = $staff_sql_res['id'];
		$employee_code = $staff_sql_res['emp_code'];
		$emp_name = $staff_sql_res['emp_name'];
		$dept_name = $staff_sql_res['dept_name'];
		$salary_amount = $staff_sql_res['salary_amount'];
		$deduct_id = $staff_sql_res['payroll_deduction_id'];
		$candid_id=$staff_sql_res['candid_id'];

// echo $deduct_id."lolo";

		$present_sql = $con->query("SELECT a.*,b.status as absent_status,b.in_log_date as in_log_date,b.emp_code as emp_code FROM staff_master a  left join bb_attendance b on (a.emp_code = b.emp_code) where a.id = '$employee_id' and  a.status=1 and  b.status=1 and year(b.in_log_date)='$from_emp_year' and month(b.in_log_date) = '$from_emp_month'");
		//echo "SELECT a.*,b.status as absent_status,b.in_log_date as in_log_date,b.emp_code as emp_code FROM staff_master a  left join bb_attendance b on (a.emp_code = b.emp_code) where a.id = '$employee_id' and  a.status=1 and  b.status=1 and year(b.in_log_date)='$from_emp_year' and month(b.in_log_date) = '$from_emp_month'";
		//echo "SELECT a.*,b.status as absent_status,b.in_log_date as in_log_date,b.emp_code as emp_code FROM staff_master a  left join bb_attendance b on (a.emp_code = b.emp_code) where a.id = '$employee_id' and  a.status=1 and (b.status=1 OR b.status=5) and year(b.in_log_date)='$from_emp_year' and month(b.in_log_date) = '$from_emp_month'";
		$present_status = array();
		while ($present_sql_res = $present_sql->fetch(PDO::FETCH_ASSOC)) {

			$present_status[] = $present_sql_res['in_log_date'];
			//print_r($present_status);
			$presentList = implode(', ', $present_status);
		}
		

		/* leave dates */
		$leave_dates_sql = $con->query("SELECT a.*,b.status as absent_status,b.in_log_date as in_log_date,b.emp_code as emp_code FROM staff_master a  left join bb_attendance b on (a.emp_code = b.emp_code) where a.id = '$employee_id' and  a.status=1 and (b.status=2 OR b.status=3 OR b.status=4 OR b.status=6) and year(b.in_log_date)='$from_emp_year' and month(b.in_log_date) = '$from_emp_month'");

		$leave_dates_status = array();
		$leavedatesList='';
		while ($leave_dates_sql_res = $leave_dates_sql->fetch(PDO::FETCH_ASSOC)) {

			$leave_dates_status[] = $leave_dates_sql_res['in_log_date'];
					$leavedatesList = implode(', ', $leave_dates_status);

		}
           if($leavedatesList)
		   {
			   $leavedatesList=$leavedatesList;
			   
		   }
		   else
		   {
			   $leavedatesList=0;
		   }

		$holiday_sql = $con->query("SELECT leave_date FROM holiday_master where year(leave_date) = '$from_emp_year' and month(leave_date)='$from_emp_month' ");

		$holiday_status = array();
		$holidayList='';
		while ($holiday_sql_res = $holiday_sql->fetch(PDO::FETCH_ASSOC)) {

			$holiday_status[] = $holiday_sql_res['leave_date'];
			$holidayList = implode(', ', $holiday_status);
		}
		

		$countgetworkingdays=$con->query("SELECT sum(working_days) as workdy_count,total_days FROM `bb_attendance` where emp_code='$employee_code' and year(in_log_date)='$from_emp_year' and month(in_log_date) = '$from_emp_month'");
		
//echo "SELECT sum(working_days) as workdy_count FROM `bb_attendance` where emp_code='$employee_code' and year(in_log_date)='$from_year' and month(in_log_date) = '$from_month'";		
		$workdaystake=$countgetworkingdays->fetch(PDO::FETCH_ASSOC);
		
		
		$month_days = round($workdaystake['total_days']);//roundvalue 30
        
		$work_days = $workdaystake['workdy_count'];

        $leavedays=$month_days-$work_days;

$lop=1;//defauflop
if($leavedays>1)
{
	$lopshow=$leavedays-$lop;
	
}
else{
	$lopshow=0;
}
$permision_status = array();
$permision_resone = array();
$permisionList_get='';
$permision_reason_get='';
$permision=$con->query("SELECT * FROM `permission_apply` WHERE candid_id='$candid_id' and year(per_date)='$from_emp_year' and month(per_date) = '$from_emp_month'");
//echo "SELECT * FROM `permission_apply` WHERE candid_id='$candid_id'";
while($permision_dates=$permision->fetch(PDO::FETCH_ASSOC))
{
	$permision_status[] = $permision_dates['per_date'];
	$permision_resone[] = $permision_dates['reason'];
	$permisionList_get = implode(', ', $permision_status);
    $permision_reason_get = implode(', ', $permision_resone);

}

if($permisionList_get)
{
	$permisionList=$permisionList_get;
}
else{
	$permisionList=0;
}
if($permision_reason_get)
{
	$permision_ress=$permision_reason_get;
}
else{
	$permision_ress=0;
}

$attiredate_status = array();
$attiredateList_get='';
$attiredate=$con->query("SELECT * FROM `attire_form` WHERE emp_no='$candid_id' and year(date)='$from_emp_year' and month(date) = '$from_emp_month'");
while($attiredate_dates=$attiredate->fetch(PDO::FETCH_ASSOC))
{
	$daily_in_hrs=$attiredate_dates['daily_in'];
	if($daily_in_hrs>'09:00')
	{
		//echo 'hi';
	$attiredate_status[] = $attiredate_dates['date'];
	$attiredate_count = count($attiredate_status);
   $attiredateList_get = implode(', ', $attiredate_status);

	}
	
	
}

if($attiredateList_get)
{
	$attiredateList=$attiredateList_get;
}
else
{
	$attiredateList=0;
}

		?>
		<tr>
			<td><?php echo $p++; ?></td>
			<td><?php echo $employee_code; ?></td>
			<td><?php echo $emp_name; ?></td>
			<td><?php echo $dept_name; ?></td>
			<td><?php echo round($work_days); ?></td>
			<td><?php echo round($leavedays); ?></td>
			<td><?php echo $lopshow; ?></td>
			<td><?php echo $month_days; ?></td>
			<td><?php echo $permisionList;?></td>
			<td><?php echo $attiredateList;?></td>
			<td><?php echo $leavedatesList; ?></td>
			<td><?php echo $presentList; ?></td>
			<td><?php echo $work_days; ?></td>
			<td>0</td>
			<td><?php echo $attiredate_count;?></td>
			<td><?php echo $permision_ress;?></td>
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