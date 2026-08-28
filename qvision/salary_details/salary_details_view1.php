	<div class="col-md-12" style="text-align: end;">
	<input class="button" type="button" value="PRINT"onclick="printDiv()"> 
	</div>
	<table class="dataTables-example table table-striped table-bordered table-hover" id="main">
	<thead>
	<th>#</th>
	<th>Name</th>
	<th>ID</th>
	<th>Dep</th>
	<th>Design</th>
	<th>DOJ</th>
	<th>Salary</th>
	<th>Basic</th>
	<th>HRA</th>
	<th>Other Allowance</th>
	<th>Gross</th>
	<th>Days</th>
	<th>Days Worked</th>
	<th>LOP</th>
	<th>Earned Gross</th>
	<!--<th>Gross</th>-->
	<th>ESI</th>
	<th>CLUB</th>
	<th>Net Salary</th>
	<th>A/C Number</th>
	<th>IFSC Code</th>
	</thead>
	<tbody>
	<?php
		require '../../connect.php';	
		$payroll_id = $_REQUEST['payroll_id'];
		$department = $_REQUEST['department'];
		//get payroll_master details
			
		$staff_payroll_sql=$con->query("select id,month,year,flag from payroll_master where id = $payroll_id");
		$staff_payroll_res=$staff_payroll_sql->fetch(PDO::FETCH_ASSOC);
		$m=$staff_payroll_res['month'];
		$y=$staff_payroll_res['year'];
		
		if($department != 0)
		{
			$staff_sql=$con->query("SELECT * FROM staff_master where  dep_id='$department' and status=1");	
		}
		else
		{
			$staff_sql=$con->query("SELECT * FROM staff_master where  status=1");	
		}
		
		
	
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
			
			//Department		
			$dep_sql=$con->query("SELECT dept_name FROM z_department_master WHERE id='$department'");
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
			$days_sql=$con->query("SELECT total_no_of_days,days_worked FROM payroll_salary_deduction where employee_code='$employee_id' and payroll_month='$m' and payroll_year='$y' and total_no_of_days is not null limit 0,1");
			 //echo "SELECT total_no_of_days,days_worked,employee_code,payroll_month,payroll_year FROM payroll_salary_deduction where employee_code='$employee_id' and payroll_month='$m' and payroll_year='$y' and total_no_of_days is not null limit 0,1";"</br>";
			
			$days_sql_res=$days_sql->fetch(PDO::FETCH_ASSOC);		
			$month_days = $days_sql_res['total_no_of_days'];
			$work_days = $days_sql_res['days_worked'];
			
			//Earnings
			$earning_sql=$con->query("SELECT earnings,amount FROM payroll_salary_earnings WHERE payroll_month='$m' and payroll_year='$y' and 
			employee_code='$employee_id' order by id asc");
			
			$amount=array();
			
			while($earning_sql_res=$earning_sql->fetch(PDO::FETCH_ASSOC))
			{	
				$ear_name = $earning_sql_res['earnings'];
				$amount[$ear_name] = $earning_sql_res['amount'];
			}			
			 $gross_salary = array_sum($amount);
			
			//deductions		
			$earning_sql=$con->query("SELECT * FROM payroll_salary_deduction WHERE payroll_month='$m' and payroll_year='$y' and employee_code='$employee_id' order by id asc");
			
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
			//echo $lop_add;echo "<br/>";
			$ear_amount=$gross_salary-$lop_add;
			  
			  
			   //gross amount
			 if (array_key_exists("ESIC",$ded_amount)) { 
			    $esiamt= $ded_amount['ESIC'];
			 }else{
				 $esiamt=0;
			 }
			 if (array_key_exists("CLUB",$ded_amount)) { 
			    $clbamt= $ded_amount['CLUB'];
			 }else{
				$clbamt=0;
			 }
			//echo $salary_amount;echo "<br/>";
			  $gross_amount= $salary_amount+$esiamt+$clbamt;
			  if (array_key_exists("ESIC",$ded_amount)) { 
			    $ear_esi=round($ear_amount*0.75/100);
				
			  }else{
				  
			    $ear_esi=0;
			  }
			  $net_amount=$ear_amount-$ear_esi-$clbamt;
			?>
			<tr>
			<td><?php echo $p++;?></td>
			<td><?php echo $emp_name;?></td>
			<td><?php echo $employee_code;?></td>
			<td><?php echo $dept_name;?></td>
			<td><?php echo $designation_names;?></td>
			<td><?php echo date('d/m/Y',strtotime($doj));?></td>
			<td><?php echo number_format($salary_amount,2) ;?></td>
			<td><?php if (array_key_exists("Basics",$amount)) { echo number_format($amount['Basics'],2); }else { echo 0;} ?></td>
			<td><?php if (array_key_exists("House Rent Allowance",$amount)) { echo number_format($amount['House Rent Allowance'],2); }else { echo 0;} ?></td>
			<td><?php if (array_key_exists("Other Allowance",$amount)) { echo number_format($amount['Other Allowance'],2); }else { echo 0;} ?></td>
			<td><?php echo $gross_amount;?></td>
			<td><?php echo $month_days;?></td>
			<td><?php echo $work_days;?></td>
			<td><?php if (array_key_exists("Loss Of Pay",$ded_amount)) { echo number_format($ded_amount['Loss Of Pay'],2); }else { echo 0;} ?></td>
			<td><?php echo number_format($ear_amount,2);  ?></td>	
			<td><?php echo round($ear_esi); //if (array_key_exists("ESIC",$ded_amount)) { echo number_format($ded_amount['ESIC'],2); }else { echo 0;} ?></td>
			<td><?php if (array_key_exists("CLUB",$ded_amount)) { echo number_format($ded_amount['CLUB'],2); }else { echo 0;} ?></td>
			<td><?php echo number_format($net_amount,2);?></td>
			<td><?php echo $ac_number;?></td>
			<td><?php echo $ifsc;?></td>
			</tr>
			<?php
		}
		exit;
		?>
		</tbody>
		</table>
  <script>
        function printDiv() {
            var divContents = document.getElementById("main").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
</body>
</html>