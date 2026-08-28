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
	<th>PF Actuals</th>
	<th>PF Deductions</th>
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
		require '../../connect.php';	
		$payroll_id = $_REQUEST['payroll_id'];
		$department = $_REQUEST['department'];
		//get payroll_master details
			
		//$staff_payroll_sql=$con->query("select id,month,year,flag from payroll_master where id = $payroll_id");
		$staff_payroll_sql=$con->query("select id,month,year,flag from payroll_master where id = $payroll_id");
//echo "select id,month,year,flag from payroll_master where id = $payroll_id";
		$staff_payroll_res=$staff_payroll_sql->fetch(PDO::FETCH_ASSOC);
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
			$staff_sql=$con->query("SELECT a.* FROM staff_master a  join bb_attendance b on a.emp_code = b.emp_code where  a.status=1 group by b.emp_code ");	
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
	   //echo $getworkdaytype.'kokoko';
        $countgetworkingdays=$con->query("SELECT sum(working_days) as workdy_count,total_days FROM `bb_attendance` where emp_code='$employee_code' and year(in_log_date)='$y' and month(in_log_date) = '$m'");
		//echo "SELECT sum(working_days) as workdy_count,total_days FROM `bb_attendance` where emp_code='$employee_code' and year(in_log_date)='$y' and month(in_log_date) = '$m'";
    		$workdaystake=$countgetworkingdays->fetch(PDO::FETCH_ASSOC);
		

		
		$month_days = round($workdaystake['total_days']);//roundvalue 30
        if ($month_days!=0) {
		$work_days = $workdaystake['workdy_count'];
          ///$work_days=20;
		  
	
$saldetails = $con->query("SELECT * FROM `joining_detail_sal_structure` WHERE candid_id='$candid_id'");
$amtshow = $saldetails->fetch(PDO::FETCH_ASSOC);

// Convert all salary fields to numbers
$sal_amt   = (float)($amtshow['fixedgross_month'] ?? 0);
$pf_amt    = (float)($amtshow['employee_PF_month'] ?? 0);
$esic_amt  = (float)($amtshow['employee_ESIC_month'] ?? 0);
$basic_amt = (float)($amtshow['basic_month'] ?? 0);

// Also convert these because they are used later in calculations
$hra_month   = (float)($amtshow['HRA_month'] ?? 0);
$other_month = (float)($amtshow['otherallowances_permonth'] ?? 0);
$site_month  = (float)($amtshow['siteallowance_permonth'] ?? 0);

	
		if($work_days)
		{
			$work_days=$work_days;
		}
else{
	$work_days=0;
}		
	
    


if($month_days>$work_days)
{

	  $salacalc = $basic_amt / $month_days;
$basicdasal = $salacalc * $work_days;

$oacalc = $other_month / $month_days;
$otherallowance = $oacalc * $work_days;

$sacalc = $site_month / $month_days;
$siteallowance = $sacalc * $work_days;

$hraamountcalc = $hra_month / $month_days;
$HRA = $hraamountcalc * $work_days;
		 
}	
	else
	{
	$basicdasal = $basic_amt;
	$otherallowance = $other_month;
	$siteallowance = $site_month;
	$HRA = $hra_month;	
	}
	
	$claimmt=$con->query("SELECT sum(amount) as claimamt FROM `claim_request` WHERE candidate_id='$candid_id' and month(date)='$m' and year(date)='$y'");
    $claim_cals=$claimmt->fetch(PDO::FETCH_ASSOC);		
    if($claim_cals['claimamt'])
	{
		$claim_amount=$claim_cals['claimamt'];
	}
	else
	{
		$claim_amount=0;
	}
$leavedays=$month_days-round($work_days);

$lop=1;//defauflop
if($leavedays>1)
{
	$lopshow=$leavedays-$lop;
	
	$perdaysalary=$sal_amt/$month_days;//perday salary
	
    $minus_salry=$lopshow*$perdaysalary;
	
	$eraned_gross=$basicdasal-$minus_salry;
	
	if($eraned_gross){
		$eraned_gross=$eraned_gross;
	}
	else
	{
		$eraned_gross=$basicdasal;
	}
}
else{
	$lopshow=0;
	$eraned_gross=$basicdasal;
}


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
        $pfamount = $amtshow['employee_PF_month'];
    }
}




	 
  $gross_salary = $basicdasal + $HRA + $otherallowance;
$esicamount = 0; // Initialize esicamount to 0 by default.

if ($gross_salary <= 21000) {
    $esicamount = $amtshow['employee_ESIC_month'];
}


$month='0'.$m;
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
			<td><?php echo $basic_amt; ?></td>
			<td><?php echo $basicdasal; ?></td>
			<td><?php echo $HRA; ?></td>
			<td><?php echo $otherallowance; ?></td>
			<td><?php echo $siteallowance; ?></td>
			<td><?php echo 0;?></td>
			<td><?php echo $claim_amount;?></td>
			<td><?php echo $month_days;?></td>
			<td><?php echo round($work_days);?></td>
			<td><?php echo $lopshow; ?></td>
			<td><?php echo $eraned_gross;  ?></td>	
			<td><?php echo $pf_amt; ?></td>
			<td><?php echo $pfamount; ?></td>
			<td><?php echo $esic_amt; ?></td>
			<td><?php echo $esicamount; ?></td>
			<td><?php echo 0; ?></td>
			<td><?php echo $advance_sal; ?></td>
			<td><?php echo $netsalary;?></td>
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
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
	   
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('SS_Employee_Salary_details.' + (type || 'xlsx')));
    }
</script>
</body>
</html>