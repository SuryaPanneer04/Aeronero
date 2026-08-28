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
	<th>Total Gross Wages</th>
	<th>No of Days worked for the month</th>
	<th>Actual ESIC Amount </th>
	<th>ESIC Amount after Deduction</th>
</tr>
	</thead>
	<tbody>
	<?php
		require '../../../connect.php';	
     	$emp_id = $_REQUEST['emp_name'];

		 $esicMonth = $_REQUEST['esicMonth'];

		 $fromempDate = preg_split("/\-/", $esicMonth);
		 $from_emp_year = $fromempDate[0]; //Year
		 $from_emp_month = $fromempDate[1]; //Month

		//get payroll_master details
		
		
		if($emp_id){
		    $staff_sql=$con->query("SELECT a.* FROM staff_master a  join payroll_salary_deduction p on p.employee_code = a.candid_id where a.id = '$emp_id' and  a.status=1 and  p.payroll_year='$from_emp_year' and p.payroll_month = '$from_emp_month' group by p.employee_code ");	

			
		}else{
			$staff_sql=$con->query("SELECT a.* FROM staff_master a  join payroll_salary_deduction p on p.employee_code = a.candid_id where  a.status=1 and  p.payroll_year='$from_emp_year' and p.payroll_month = '$from_emp_month' group by p.employee_code");
			
		}
		$p = 1;
		
		while($staff_sql_res = $staff_sql->fetch()){
$employee_id = $staff_sql_res['id'];
			$employee_code = $staff_sql_res['emp_code'];
			$emp_name = $staff_sql_res['emp_name'];
			$salary_amount = $staff_sql_res['salary_amount'];
			$deduct_id = $staff_sql_res['payroll_deduction_id'];
			$candid_id=$staff_sql_res['candid_id'];
			
			
			
			
			
			  
	   //echo $getworkdaytype.'kokoko';
        $countgetworkingdays=$con->query("SELECT total_no_of_days,days_worked FROM `payroll_salary_deduction` where employee_code='$candid_id' and payroll_year='$from_emp_year' and payroll_month = '$from_emp_month'");
		
//echo "SELECT sum(working_days) as workdy_count FROM `bb_attendance` where emp_code='$employee_code' and year(in_log_date)='$from_year' and month(in_log_date) = '$from_month'";		
		$workdaystake=$countgetworkingdays->fetch(PDO::FETCH_ASSOC);
		
		
		$month_days = round($workdaystake['total_no_of_days']);//roundvalue 30
        
		$work_days = $workdaystake['days_worked'];
          ///$work_days=20;
		  
	$saldetails=$con->query("SELECT * FROM `joining_detail_sal_structure` WHERE candid_id='$candid_id'");
	$amtshow=$saldetails->fetch(PDO::FETCH_ASSOC);
	$sal_amt=$amtshow['fixedgross_month'];
	
	
		if($work_days)
		{
			$work_days=$work_days;
		}
else{
	$work_days=0;
}		

$oapm = $amtshow['otherallowances_permonth'];
$oapms = str_replace(',', '', $oapm);

// $sapm = $amtshow['siteallowance_permonth'];
// $sapms = str_replace(',', '', $sapm);

$hram = $amtshow['HRA_month'];
$hrams = str_replace(',', '', $hram);

 if($month_days>$work_days)
{
	$salacalc=$amtshow['basic_month']/$month_days;
	   $basicdasal=$salacalc*$work_days;
		//echo round($basicdasal,2);
	
	$hraamountcalc=$hrams/$month_days;
	  $HRA=$hraamountcalc*$work_days;
	
	    // echo round($HRA,2);
		
		
		$oacalc=$oapms/$month_days;
	$otherallowance=$oacalc*$work_days;
}

else
{
	$basicdasal=$amtshow['basic_month'];
		//echo round($basicdasal,2);
		
		$HRA=$hrams;
		
			$otherallowance=$oapms;

}
 
$gross_salary=$basicdasal+$HRA+$otherallowance;
	// echo$basicdasal.'kokookiiiiiiiiiiiii'.$HRA.''.$otherallowance; 
  $gross_salary = $basicdasal + $HRA + $otherallowance;
$esicamount = 0; // Initialize esicamount to 0 by default.

if ($gross_salary <= 21000) {
    $esicamount = $amtshow['employee_ESIC_month'];
}

// Output the calculated $esicamount
//echo $esicamount;

		
			?>
			<tr>
			<td><?php echo $p++?></td>
			<td><?php echo $employee_code;?></td>
			<td><?php echo $emp_name;?></td>
			<td><?php echo $basicdasal ;?></td>
			<td><?php echo round($work_days);?></td>
			<td><?php echo number_format($amtshow['employee_ESIC_month'],2); ?></td>
			<td><?php echo number_format($esicamount,2); ?></td>
			</tr>
			<?php } ?>
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
         XLSX.writeFile(wb, fn || ('SS_Employee_ESIC_Reports.' + (type || 'xlsx')));
    }
</script>
</body>
</html><script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
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
	<th>Total Gross Wages</th>
	<th>No of Days worked for the month</th>
	<th>Actual ESIC Amount </th>
	<th>ESIC Amount after Deduction</th>
</tr>
	</thead>
	<tbody>
	<?php
		require '../../../connect.php';	
     	$emp_id = $_REQUEST['emp_name'];

		 $esicMonth = $_REQUEST['esicMonth'];

		 $fromempDate = preg_split("/\-/", $esicMonth);
		 $from_emp_year = $fromempDate[0]; //Year
		 $from_emp_month = $fromempDate[1]; //Month

		//get payroll_master details
		
		
		if($emp_id){
		    $staff_sql=$con->query("SELECT a.* FROM staff_master a  join payroll_salary_deduction p on p.employee_code = a.candid_id where a.id = '$emp_id' and  a.status=1 and  p.payroll_year='$from_emp_year' and p.payroll_month = '$from_emp_month' group by p.employee_code ");	

			
		}else{
			$staff_sql=$con->query("SELECT a.* FROM staff_master a  join payroll_salary_deduction p on p.employee_code = a.candid_id where  a.status=1 and  p.payroll_year='$from_emp_year' and p.payroll_month = '$from_emp_month' group by p.employee_code");
			
		}
		$p = 1;
		
		while($staff_sql_res = $staff_sql->fetch()){
$employee_id = $staff_sql_res['id'];
			$employee_code = $staff_sql_res['emp_code'];
			$emp_name = $staff_sql_res['emp_name'];
			$salary_amount = $staff_sql_res['salary_amount'];
			$deduct_id = $staff_sql_res['payroll_deduction_id'];
			$candid_id=$staff_sql_res['candid_id'];
			
			
			
			
			
			  
	   //echo $getworkdaytype.'kokoko';
        $countgetworkingdays=$con->query("SELECT total_no_of_days,days_worked FROM `payroll_salary_deduction` where employee_code='$candid_id' and payroll_year='$from_emp_year' and payroll_month = '$from_emp_month'");
		
//echo "SELECT sum(working_days) as workdy_count FROM `bb_attendance` where emp_code='$employee_code' and year(in_log_date)='$from_year' and month(in_log_date) = '$from_month'";		
		$workdaystake=$countgetworkingdays->fetch(PDO::FETCH_ASSOC);
		
		
		$month_days = round($workdaystake['total_no_of_days']);//roundvalue 30
        
		$work_days = $workdaystake['days_worked'];
          ///$work_days=20;
		  
	$saldetails=$con->query("SELECT * FROM `joining_detail_sal_structure` WHERE candid_id='$candid_id'");
	$amtshow=$saldetails->fetch(PDO::FETCH_ASSOC);
	$sal_amt=$amtshow['fixedgross_month'];
	
	
		if($work_days)
		{
			$work_days=$work_days;
		}
else{
	$work_days=0;
}		

$oapm = $amtshow['otherallowances_permonth'];
$oapms = str_replace(',', '', $oapm);

// $sapm = $amtshow['siteallowance_permonth'];
// $sapms = str_replace(',', '', $sapm);

$hram = $amtshow['HRA_month'];
$hrams = str_replace(',', '', $hram);

 if($month_days>$work_days)
{
	$salacalc=$amtshow['basic_month']/$month_days;
	   $basicdasal=$salacalc*$work_days;
		//echo round($basicdasal,2);
	
	$hraamountcalc=$hrams/$month_days;
	  $HRA=$hraamountcalc*$work_days;
	
	    // echo round($HRA,2);
		
		
		$oacalc=$oapms/$month_days;
	$otherallowance=$oacalc*$work_days;
}

else
{
	$basicdasal=$amtshow['basic_month'];
		//echo round($basicdasal,2);
		
		$HRA=$hrams;
		
			$otherallowance=$oapms;

}
 
$gross_salary=$basicdasal+$HRA+$otherallowance;
	// echo$basicdasal.'kokookiiiiiiiiiiiii'.$HRA.''.$otherallowance; 
  $gross_salary = $basicdasal + $HRA + $otherallowance;
$esicamount = 0; // Initialize esicamount to 0 by default.

if ($gross_salary <= 21000) {
    $esicamount = $amtshow['employee_ESIC_month'];
}

// Output the calculated $esicamount
//echo $esicamount;

		
			?>
			<tr>
			<td><?php echo $p++?></td>
			<td><?php echo $employee_code;?></td>
			<td><?php echo $emp_name;?></td>
			<td><?php echo $basicdasal ;?></td>
			<td><?php echo round($work_days);?></td>
			<td><?php echo number_format($amtshow['employee_ESIC_month'],2); ?></td>
			<td><?php echo number_format($esicamount,2); ?></td>
			</tr>
			<?php } ?>
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
         XLSX.writeFile(wb, fn || ('SS_Employee_ESIC_Reports.' + (type || 'xlsx')));
    }
</script>
</body>
</html>