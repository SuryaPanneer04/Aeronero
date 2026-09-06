<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require '../../connect.php';	
$payroll_id = isset($_REQUEST['payroll_id']) ? $_REQUEST['payroll_id'] : 0;
$department = isset($_REQUEST['department']) ? $_REQUEST['department'] : 0;
$approval_status = 0;
if($payroll_id != 0) {
	$staff_payroll_sql=$con->query("select id,month,year,flag,approval_status from payroll_master where id = $payroll_id");
	$staff_payroll_res=$staff_payroll_sql->fetch(PDO::FETCH_ASSOC);
	$approval_status = $staff_payroll_res['approval_status'];
}
$role = isset($_SESSION['userrole']) ? $_SESSION['userrole'] : '';
?>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<div class="col-md-12" style="text-align: end;margin: 5px;">
  <span id="approval_status_msg" style="float:left; font-weight:bold; font-size:18px; color: #d9534f;">
	<?php 
	if($approval_status == 1) echo "Move to Finance Department - Waiting for Finance Approval"; 
	elseif($approval_status == 2) echo "<span style='color:green;'>Approved by Finance</span>";
	elseif($approval_status == 3) echo "Rejected the salary structure";
	?>
	<!-- <br><small style="color:black;">(Debug Logged-in Role: "<?php echo htmlspecialchars($role); ?>")</small> -->
  </span>
  
  <?php if((strpos(strtoupper($role), 'R003') !== false || strtoupper($role) == 'R001' || strtoupper($role) == 'ADMIN') && ($approval_status == 0 || $approval_status == 3) && $payroll_id != 0) { ?>
	<button class="btn btn-primary" onclick="update_salary_approval(<?php echo $payroll_id; ?>, 'accept_r003')">Accept</button>&nbsp;&nbsp;
  <?php } ?>
  
  <?php if((strpos(strtoupper($role), 'R008') !== false || strtoupper($role) == 'R001' || strtoupper($role) == 'ADMIN') && $approval_status == 1 && $payroll_id != 0) { ?>
	<button class="btn btn-success" onclick="update_salary_approval(<?php echo $payroll_id; ?>, 'accept_finance')">Accept</button>&nbsp;&nbsp;
	<button class="btn btn-danger" onclick="update_salary_approval(<?php echo $payroll_id; ?>, 'reject_finance')">Reject</button>&nbsp;&nbsp;
  <?php } ?>

  <a href="#" id="1" style="font-size:20px;" class="excel btn btn-success" onclick="ExportToExcel('xlsx')">
  <span class="fa fa-download">&nbsp;Excel</a>&nbsp;&nbsp;
</div>

	<table class="dataTables-example table table-striped table-bordered table-hover" id="tbl_exporttable_to_xls" style="width:100%; white-space: nowrap;">
	<thead>
<tr>
	<th>S.No</th>
	<th>Name</th>
	<th>ID</th>
	<th>Dep</th>
	<th>Design</th>
	<th>DOJ</th>
	<th>Salary</th>
	<th>Basic</th>
	<th>HRA</th>
	<th>Other Allowance</th>
	<th>Site Allowance</th>
	<th>Conveyance</th>
	<th>Claim</th>
<!--	<th>Gross</th> -->
	<th>Days</th>
	<th>Days Worked</th>
	<th>LOP</th>
	<th>Earned Gross</th>
	<!-- <th>PF Actuals</th>
	<th>PF Deductions</th> -->
	<th>ESIC Actuals</th>
	<th>ESIC Deductions</th>
	<th>PT</th>
	<th>Salary Advance</th>
	<th>Net Salary</th>
	<th>A/C Number</th>
	<th>IFSC Code</th>
</tr>
	</thead>
	<tbody>
	<?php
		$m=$staff_payroll_res['month'];
		$y=$staff_payroll_res['year'];
		
		if($department != 0)
		{
			//echo "0";
			$staff_sql=$con->query("SELECT * FROM staff_master where  dep_id='$department' and status=1");	
		   // echo "SELECT * FROM staff_master where  dep_id='$department' and status=1";	
		}
		else
		{
			//echo "1";
			$staff_sql=$con->query("SELECT a.* FROM staff_master a  join bb_attendance b on a.id = b.emp_code where  a.status=1 group by b.emp_code ");	
		     //echo "SELECT a.* FROM staff_master a  join bb_attendance b on a.id = b.emp_code where  a.status=1 group by b.emp_code";
		}
		
		
	
		$p = 1;
		while($staff_sql_res=$staff_sql->fetch(PDO::FETCH_ASSOC))
		{					
		 	$employee_id = $staff_sql_res['id'];
			$candid_id = $staff_sql_res['candid_id'];
			$employee_code = $staff_sql_res['emp_code'];
			$emp_name = $staff_sql_res['emp_name'];
			$department_id = $staff_sql_res['dep_id'];
			$designation = $staff_sql_res['design_id'];
			$salary_amount = $staff_sql_res['salary_amount'];
			$deduct_id = $staff_sql_res['payroll_deduction_id'];
		
		    //Account Number && IFSC code
			$account_num = $staff_sql_res['account_no'];
			$ifsc_code = $staff_sql_res['ifsc_code'];
			
			//Department		
			$dep_sql=$con->query("SELECT dept_name FROM z_department_master WHERE id='$department_id'");
			$dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC);
			$dept_name = $dep_sql_res['dept_name'];
		
			//Designation	
			
			$des_sql=$con->query("SELECT designation_name FROM designation_master WHERE id='$designation'");
			$des_sql_res=$des_sql->fetch(PDO::FETCH_ASSOC);
			if($des_sql_res){
			$designation_names = $des_sql_res['designation_name'];
			}
			else{
				$designation_names=NULL;
			}
			//DOJ 
			$doj_sql=$con->query("SELECT joining_date from candidate_form_details WHERE id='$candid_id'");
			$doj_sql_res=$doj_sql->fetch(PDO::FETCH_ASSOC);		
			$doj = $doj_sql_res['joining_date'];
			
			
			?>
			

    <?php 
        $countgetworkingdays=$con->query("SELECT sum(working_days) as workdy_count FROM `bb_attendance` where emp_code='$employee_id' and year(in_log_date)='$y' and month(in_log_date) = '$m'");
        $workdaystake=$countgetworkingdays->fetch(PDO::FETCH_ASSOC);
		
		$month_days = cal_days_in_month(CAL_GREGORIAN, $m, $y); // Correctly calculate days in month
        if ($month_days!=0) {
		$work_days = $workdaystake['workdy_count'];
          ///$work_days=20; 
		  
	
$saldetails = $con->query("SELECT * FROM `joining_detail_sal_structure` WHERE candid_id='$candid_id'");
$amtshow = $saldetails->fetch(PDO::FETCH_ASSOC);
$sal_amt = isset($amtshow['fixedgross_month']) ? (float)$amtshow['fixedgross_month'] : 0;
$pf_amt = isset($amtshow['employee_PF_month']) ? (float)$amtshow['employee_PF_month'] : 0;
$esic_amt = isset($amtshow['employee_ESIC_month']) ? (float)$amtshow['employee_ESIC_month'] : 0;

$basic_amt = isset($amtshow['basic_month']) ? (float)$amtshow['basic_month'] : 0;
$hra_month = isset($amtshow['HRA_month']) ? (float)$amtshow['HRA_month'] : 0;
$other_month = isset($amtshow['otherallowances_permonth']) ? (float)$amtshow['otherallowances_permonth'] : 0;
$site_month = isset($amtshow['siteallowance_permonth']) ? (float)$amtshow['siteallowance_permonth'] : 0;

$work_days = $work_days ? round($work_days) : 0;
$leavedays = $month_days - $work_days;

// FIX: Previously, 1 day leave was ignored (default lop = 1). 
// Now, exact leave days will be considered as LOP.
$lopshow = $leavedays; 
/* Old logic:
$lop = 1; // default lop
if($leavedays > 1) {
	$lopshow = $leavedays - $lop;
} else {
	$lopshow = 0;
}
*/

if ($month_days > 0) {
    $paid_days = $month_days - $lopshow;
    if ($paid_days < 0) $paid_days = 0;
    
    $basicdasal = ($basic_amt / $month_days) * $paid_days;
    $otherallowance = ($other_month / $month_days) * $paid_days;
    $siteallowance = ($site_month / $month_days) * $paid_days;
    $HRA = ($hra_month / $month_days) * $paid_days;
} else {
    $basicdasal = $basic_amt;
    $otherallowance = $other_month;
    $siteallowance = $site_month;
    $HRA = $hra_month;
}

$claimmt=$con->query("SELECT sum(amount) as claimamt FROM `claim_request` WHERE candidate_id='$candid_id' and month(date)='$m' and year(date)='$y'");
$claim_cals=$claimmt->fetch(PDO::FETCH_ASSOC);		
if($claim_cals['claimamt']) {
	$claim_amount=$claim_cals['claimamt'];
} else {
	$claim_amount=0;
}

$eraned_gross = $basicdasal + $HRA + $otherallowance + $siteallowance;


$basicdasal    = (float)$basicdasal;
$otherallowance = (float)$otherallowance;
$HRA            = (float)$HRA;
$pfcalc = $basicdasal + $otherallowance;
$defaultpf = 1800;
if ($pfcalc > 15000) {
    $pfamount = $defaultpf;
} else {
    //$work_days1 = 12;
	//echo $month_days;
    if (round($work_days) < 15) {
        $pfcal = $defaultpf /$month_days;
        $pfemp = $pfcal * round($work_days);
        $pfamount = round($pfemp, 2);
    } else {
        $pfamount = $pf_amt;
    }
}




	 
  $gross_salary = $basicdasal + $HRA + $otherallowance;
$esicamount = 0; // Initialize esicamount to 0 by default.

if ($gross_salary <= 21000) {
    $esicamount = $esic_amt;
}


$month = sprintf('%02d', $m);
$salaryadvance=$con->query("SELECT sum(advance_amount) as advance_amt FROM `salary_advance` WHERE emp_id='$candid_id' AND DATE_FORMAT(created_on, '%Y-%m') = '$y-$month'");
 $saladvance_cals=$salaryadvance->fetch(PDO::FETCH_ASSOC);
if($saladvance_cals['advance_amt'])
{
	$advance_sal=$saladvance_cals['advance_amt'];
	
	$netsalary=$eraned_gross-round($advance_sal);
	if($netsalary)
	{
		$netsalary=$netsalary;
	}
	else
	{
		$netsalary=$eraned_gross;
	}
}	
else
{
	$advance_sal=0;
	$netsalary=$eraned_gross;
}

?>

           <tr>
			<td><?php echo $p++;?></td>
			<td><?php echo $emp_name;?></td>
			<td><?php echo $employee_code;?></td>
			<td><?php echo $dept_name;?></td>
			<td><?php echo $designation_names;?></td>
			<td><?php echo date('d/m/Y',strtotime($doj));?></td>
			<!-- <td><?php echo $basic_amt; ?></td> -->
			 <td><?php echo round((float)$sal_amt, 2); ?></td>
			<td><?php echo round((float)$basicdasal, 2); ?></td>
			<td><?php echo round((float)$HRA, 2); ?></td>
			<td><?php echo round((float)$otherallowance, 2); ?></td>
			<td><?php echo round((float)$siteallowance, 2); ?></td>
			<td><?php echo 0;?></td>
			<td><?php echo round((float)$claim_amount, 2);?></td>
			<td><?php echo $month_days;?></td>
			<td><?php echo round((float)$work_days);?></td>
			<td><?php echo round((float)$lopshow, 2); ?></td>
			<td><?php echo round((float)$eraned_gross, 2);  ?></td>	
			<!-- <td><?php echo round((float)$pf_amt, 2); ?></td>
			<td><?php echo round((float)$pfamount, 2); ?></td> -->
			<td><?php echo round((float)$esic_amt, 2); ?></td>	
			<td><?php echo round((float)$esicamount, 2); ?></td>
			<td><?php echo 0; ?></td>
			<td><?php echo round((float)$advance_sal, 2); ?></td>
			<td><?php echo round((float)$netsalary);?></td>
			<td><?php echo $account_num;?></td>
			<td><?php echo $ifsc_code;?></td>
			</tr>
			<?php
		}
		
		}
		?>
		</tbody>
		</table>
	
<script type="text/javascript">
 var tableToExcel = (function() {
var uri = 'data:application/vnd.ms-excel;base64,'
, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
return function(table, name) {
if (!table.nodeType) table = document.getElementById(table)
var ctx = {worksheet: name || 'Worsheet', table: table.innerHTML}

window.location.href = uri + base64(format(template, ctx))
}
})() 

 $(function () {
        $('#tbl_exporttable_to_xls').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "scrollX": true
        });
      });
	  
	  function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
	   
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('SS_Employee_Salary_details.' + (type || 'xlsx')));
    }

	function update_salary_approval(payroll_id, action) {
		if(confirm("Are you sure you want to perform this action?")) {
			$.ajax({
				type: "POST",
				url: "qvision/salary_details/salary_approval_action.php",
				data: { payroll_id: payroll_id, action: action },
				success: function(response) {
					if(response == 1) {
						alert("Status updated successfully.");
						payslip_view(); // Reload the view
					} else {
						alert("Error updating status.");
					}
				}
			});
		}
	}
</script>
</body>
</html>