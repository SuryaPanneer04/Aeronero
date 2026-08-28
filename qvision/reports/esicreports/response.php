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
	$esicFromDate = $_REQUEST['esicFromDate'];
	$esicToDate = $_REQUEST['esicToDate']; 
    
	$fromDate = preg_split("/\-/",$esicFromDate);
	$from_year = $fromDate[0]; //Year
	$from_month = $fromDate[1]; //Month

	$toDate = preg_split("/\-/",$esicToDate);
	$to_year = $toDate[0]; //Year 
	$to_month = $toDate[1]; //Month

		//get payroll_master details

		// $m=$staff_payroll_res['month'];
		// $y=$staff_payroll_res['year'];
		

	$staff_sql=$con->query("SELECT a.* FROM staff_master a  join bb_attendance b on a.id = b.emp_code where  a.status=1 group by b.emp_code ");	
		
	
		$p = 1;
		while($staff_sql_res=$staff_sql->fetch(PDO::FETCH_ASSOC))
		{					
		 	$employee_id = $staff_sql_res['id'];
			$candid_id = $staff_sql_res['candid_id'];
			$employee_code = $staff_sql_res['prefix_code'].$staff_sql_res['emp_code'];
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
			$designation_names = $des_sql_res['designation_name'];
		
			//DOJ 
			$doj_sql=$con->query("SELECT joining_date from candidate_form_details WHERE id='$candid_id'");
			$doj_sql_res=$doj_sql->fetch(PDO::FETCH_ASSOC);		
			$doj = $doj_sql_res['joining_date'];
			
			//Account details
			$acc_sql=$con->query("SELECT acc_number,ifsc,acc_holder_name FROM emp_personal_details where emp_id='$candid_id'");
			$acc_sql_res=$acc_sql->fetch(PDO::FETCH_ASSOC);		
			$ac_number = $acc_sql_res['acc_number'];
			$ifsc = $acc_sql_res['ifsc'];
			
			//Days of working		
			$days_sql=$con->query("SELECT total_no_of_days,days_worked FROM payroll_salary_deduction where employee_code='$employee_id' and (( payroll_month between '$from_month' and '$to_month') or ( payroll_year  between '$from_year' and '$to_year')) and total_no_of_days is not null limit 0,1");

			//echo "SELECT total_no_of_days,days_worked FROM payroll_salary_deduction where employee_code='$employee_id' and (( payroll_month between '$from_month' and '$to_month') or ( payroll_year  between '$from_year' and '$to_year')) and total_no_of_days is not null limit 0,1";
			
			$days_sql_res=$days_sql->fetch(PDO::FETCH_ASSOC);		
			$month_days = $days_sql_res['total_no_of_days'];
			$work_days = $days_sql_res['days_worked'];
			
			//Earnings
			$earning_sql=$con->query("SELECT earnings,amount FROM payroll_salary_earnings WHERE ((payroll_month between '$from_month' and '$to_month') or (payroll_year  between '$from_year' and '$to_year')) and employee_code='$employee_id' order by id asc");

			//echo "SELECT earnings,amount FROM payroll_salary_earnings WHERE (payroll_month between '$from_month' and '$to_month') and (payroll_year  between '$from_year' and '$to_year') and employee_code='$employee_id' order by id asc";
			
			$amount=array();
			
			while($earning_sql_res=$earning_sql->fetch(PDO::FETCH_ASSOC))
			{	
				$ear_name = $earning_sql_res['earnings'];
				$amount[$ear_name] = $earning_sql_res['amount'];
			}			
		    //$gross_salary = array_sum($amount); 
			
		//Earned salary START
			$earned_sql=$con->query("SELECT earnings,amount FROM payroll_earned_salary WHERE ((payroll_month between '$from_month' and '$to_month') or (payroll_year  between '$from_year' and '$to_year')) and  employee_code='$employee_id' order by id asc");

			//echo "SELECT earnings,amount FROM payroll_earned_salary WHERE (payroll_month between '$from_month' and '$to_month') and (payroll_year  between '$from_year' and '$to_year') and  employee_code='$employee_id' order by id asc";
			
			$earned_amount=array();
			
			while($earned_sql_res=$earned_sql->fetch(PDO::FETCH_ASSOC))
			{	
				$earned_name = $earned_sql_res['earnings'];
				$earned_amount[$earned_name] = $earned_sql_res['amount'];
			}			
		     $gross_salary = array_sum($earned_amount); 	
		//Earned salary END
			
			//deductions		
			$earning_sql=$con->query("SELECT * FROM payroll_salary_deduction WHERE ((payroll_month between '$from_month' and '$to_month') or (payroll_year  between '$from_year' and '$to_year')) and employee_code='$employee_id' order by id asc");

			//echo "SELECT * FROM payroll_salary_deduction WHERE (payroll_month between '$from_month' and '$to_month') and (payroll_year  between '$from_year' and '$to_year') and employee_code='$employee_id' order by id asc";
			
			$deduction=array();
			$ded_amount=array();
			
			while($earning_sql_res=$earning_sql->fetch(PDO::FETCH_ASSOC))
			{		
				$deduction_name = $earning_sql_res['deduction'];
				$ded_amount[$deduction_name] = $earning_sql_res['amount'];
			}
			//print_r($ded_amount);echo "<br/>";
			
			$deduction_total = array_sum($ded_amount);
			//print_r ($deduction_total);
			$number=$gross_salary-$deduction_total;
			//echo $number;
			if (array_key_exists("Loss Of Pay",$ded_amount)) { 
			    $lop_add= $ded_amount['Loss Of Pay']; 	
				
			}else { 
			    $lop_add= 0;
			}
			$ear_amount=$gross_salary-$lop_add;
			  
			  
			//Gross amount
			//  if (array_key_exists("ESIC",$ded_amount)) { 
			//     $esiamt= $ded_amount['ESIC'];
			//  }else{
			// 	 $esiamt=0;
			//  }
			 
			  if (array_key_exists("PF",$ded_amount)) { 
			    $pfamt= $ded_amount['PF'];
			 }else{
				 $pfamt=0;
			 }
			 
			 if (array_key_exists("PT",$ded_amount)) { 
			    $ptamt= $ded_amount['PT'];
			 }else{
				 $ptamt=0;
			 }
			 
			 if (array_key_exists("Salary Advance",$ded_amount)) { 
			    $SalaryAdvanceamt= $ded_amount['Salary Advance'];
			 }else{
				 $SalaryAdvanceamt=0;
			 }

			 if (array_key_exists("TDS",$ded_amount)) { 
			    $tdsamt= $ded_amount['TDS'];
			 }else{
				$tdsamt=0;
			 }
			//$gross_amount= $salary_amount+$esiamt;  //+$clbamt
		
		//SAD 
			if (array_key_exists("SAD",$ded_amount)) { 
			    $sadamt= $ded_amount['SAD'];
			 }else{
				$sadamt=0;
			 }
			 
			//NET Salary
			  if (array_key_exists("ESIC",$ded_amount)) { 
		     $ear_esi=round($ear_amount * 0.75/100); 
				
			  }else{
				  
			    $ear_esi=0;
			  }
			  $net_amount=$ear_amount-$pfamt-$ear_esi-$tdsamt-$sadamt-$ptamt-$SalaryAdvanceamt; //-$clbamt

	////////////////////////////// Actual ESIC ///////////////////////////////////
			  if (array_key_exists("ESIC",$ded_amount)) { 
				$actual_asi = round($salary_amount * 0.75/100); 
				   
				 }else{
					 
				   $actual_asi=0;
				 }

    //////////////////////////////// Actual PF /////////////////////////////////////

	$deduct_sql = $con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status FROM payroll_deduction_master where id in ($deduct_id)");
	while($deduct_data = $deduct_sql->fetch(PDO::FETCH_ASSOC)) {

					$deduction=$deduct_data['name'];
					$deduct_amount=$deduct_data['amount'];
					$percentage=$deduct_data['percentage'];

					if($deduct_amount == 0 && $deduction == 'PF'){
						if($deduction == 'PF'){
						  $PFamount = round($salary_amount * $percentage/100);
						}
					}
					elseif($deduct_amount > 0 && $deduction == 'PF'){
						 $PFamount = $deduct_amount;   //When salary more than 15K the PF deduction is RS.1800/- as default;
						}
					else{
						$PFamount = 0;
					}
				}
			?>
			<tr>
			<td><?php echo $p++;?></td>
			<td><?php echo $employee_code;?></td>
			<td><?php echo $emp_name;?></td>
			<td><?php echo number_format($salary_amount,2) ;?></td>
			<td><?php echo $work_days;?></td>
			<td><?php echo number_format($actual_asi,2); ?></td>
			<td><?php echo number_format($ear_esi,2); ?></td>
			</tr>
			<?php
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
         XLSX.writeFile(wb, fn || ('SS_Employee_ESIC_Reports.' + (type || 'xlsx')));
    }
</script>
</body>
</html>