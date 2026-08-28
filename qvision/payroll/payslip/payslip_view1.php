<!DOCTYPE html>
<html lang="en">
<head>
    
<!--	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'> -->

<style>
.border{
	 border: 6px solid #df8459 !important;
	 padding: 30px !important;
	 padding-bottom: 58px !important;
	 
}
hr:not([size]){
	height: 6px !important;
}
hr{
	margin: 1rem 0px !important;
    color: inherit !important;
    background-color: #df8459 !important;
    opacity: 1.25 !important;
}
td{
	
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
	require '../../../connect.php';	
	$payroll_id = $_REQUEST['payroll_id'];
	$department = $_REQUEST['department'];
	$candid_id = $_REQUEST['employee'];
	//get payroll_master details
		
	$staff_payroll_sql=$con->query("select id,month,year,flag from payroll_master where id = $payroll_id");
	$staff_payroll_res=$staff_payroll_sql->fetch(PDO::FETCH_ASSOC);
	$m=$staff_payroll_res['month'];
	$y=$staff_payroll_res['year'];
	
	if($department != 0  && $candid_id == 0 )
	{
		$staff_sql=$con->query("SELECT * FROM staff_master where dep_id='$department'");		
	}
	else if($department == 0  && $candid_id != 0 )
	{
		//get employee details
		$staff_sql=$con->query("SELECT * FROM staff_master where candid_id = '$candid_id'");
		
	}
	else if($department != 0  && $candid_id != 0 )
	{
		$staff_sql=$con->query("SELECT * FROM staff_master where dep_id='$department' and candid_id = '$candid_id'");
		//echo "SELECT * FROM staff_master where dep_id='$department' and candid_id = '$candid_id'";
	}
	
	
	
	while($staff_sql_res=$staff_sql->fetch(PDO::FETCH_ASSOC))
	{
		
					
		$employee_id = $staff_sql_res['id'];
		$employee_code = $staff_sql_res['emp_code'];
		$emp_name = $staff_sql_res['emp_name'];
		$department_id = $staff_sql_res['dep_id'];
		$designation = $staff_sql_res['design_id'];
		
		//Designation		
		$des_sql=$con->query("SELECT designation_name FROM designation_master WHERE id='$designation'");
		$des_sql_res=$des_sql->fetch(PDO::FETCH_ASSOC);
		$designation_name = $des_sql_res['designation_name'];
		
		//DOJ 
		$doj_sql=$con->query("SELECT joining_date from candidate_form_details WHERE id='$candid_id'");
		$doj_sql_res=$doj_sql->fetch(PDO::FETCH_ASSOC);		
		$doj = $doj_sql_res['joining_date'];
		
		//Account details
		$acc_sql=$con->query("SELECT acc_number,ifsc,acc_holder_name FROM emp_personal_details where emp_id='$candid_id'");
		$acc_sql_res=$acc_sql->fetch(PDO::FETCH_ASSOC);		
		$ac_number = $acc_sql_res['acc_number'];
		
		//Days of working		
		$days_sql=$con->query("SELECT total_no_of_days,days_worked FROM payroll_salary_deduction where employee_code='$employee_id' and payroll_month='$m' and payroll_year='$y' and total_no_of_days is not null limit 0,1");
		$days_sql_res=$days_sql->fetch(PDO::FETCH_ASSOC);		
		$month_days = $days_sql_res['total_no_of_days'];
		$work_days = $days_sql_res['days_worked'];
		
		//Earnings		
		$earning_sql=$con->query("SELECT earnings,amount FROM payroll_salary_earnings WHERE payroll_month='$m' and payroll_year='$y' and employee_code='$employee_id' order by id asc");
		
		//echo "SELECT earnings,amount FROM payroll_salary_earnings WHERE payroll_month='$m' and payroll_year='$y' and employee_code='$employee_id' order by id asc";
		
		$earnings=array();
		$amount=array();
		
		while($earning_sql_res=$earning_sql->fetch(PDO::FETCH_ASSOC))
		{		
			$earnings[] = $earning_sql_res['earnings'];
			$amount[] = $earning_sql_res['amount'];
		}
		//print_r($earnings);
		//print_r($amount);
		$gross_salary = array_sum($amount);
		
		//deductions		
		$earning_sql=$con->query("SELECT * FROM payroll_salary_deduction WHERE payroll_month='$m' and payroll_year='$y' and employee_code='$employee_id' order by id asc");
		
		
		
		$deduction=array();
		$ded_amount=array();
		
		while($earning_sql_res=$earning_sql->fetch(PDO::FETCH_ASSOC))
		{		
			$deduction[] = $earning_sql_res['deduction'];
			$ded_amount[$earning_sql_res['deduction']] = $earning_sql_res['amount'];
		}
		//print_r($deduction);
		//print_r($ded_amount);
		$deduction_total = array_sum($ded_amount);
		$number=$gross_salary-$deduction_total;
		?>


			<div class="col-md-12" style="text-align: end;">
		     <input class="button btn-danger" type="button" value="PRINT"onclick="printDiv()"> 
		</div>
		<div class="border container" id="main">
		<table class="logo_border" style="width: 100%;">
		<tr class="logo_border">
		<th class="logo_border" style="width:20%"><img src="/ssinfo1/images/04.png" alt="Image"  style="width: 245px;height: 140px;"></th>
		<th class="logo_border" style="text-transform:uppercase;font-weight:800;font-size:16px;text-align: start;">SS Information Systems Pvt Ltd</th>
		</tr>
		</table>
		<hr style="width: 100%;">
		<div class="row">
		<div class="col-md-12">
		<h6 style="text-align:center;font-size: 18px;">[No.1/102 , Periyar Pathai West, 100 Feet Road, Arumbakkam,Chennai - 600106.]</h6>
		
		<h6 style="text-align:center;font-weight:700;font-size: 18px;"><?php $dateObj   = DateTime::createFromFormat('!m', $m);
		$monthName = $dateObj->format('F');
		echo $monthName .' '. $y ; 
		
		?></h6>
		</div>
		
		</div>
		
	<br>
				<table class="remove_border" style="width:100%">
  <tr class="remove_border">
    <td class="left remove_border" style="font-weight:bold;">Employee Name : <?php echo $emp_name;?></td>
    <td class="left remove_border"></td>
    <td class="left remove_border" style="font-weight:bold;">Date of Joined &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo date('d/m/Y',strtotime($doj));?></td>
    <td class="left remove_border"></td>
  </tr>
   <tr>
    <td class="left remove_border" style="font-weight:bold;">Designation  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $designation_name;?></td>
    <td class="left remove_border"></td>
    <td class="left remove_border" style="font-weight:bold;">Bank Account Number &nbsp&nbsp&nbsp: <?php echo $ac_number;?></td>
    <td class="left remove_border"></td>
  </tr>
  <tr>
    <td class="left remove_border"></td>
    <td class="left remove_border"></td>
    <td class="left remove_border" style="font-weight:bold;"> Total Number of Days &nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $month_days;?></td>
    <td class="left remove_border"></td>
  </tr>
  <tr>
    <td class="left remove_border"></td>
    <td class="left remove_border"></td>
    <td class="left remove_border" style="font-weight:bold;">Days Worked 	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp			: <?php echo $work_days;?></td>
    <td class="left remove_border"></td>
  </tr>
</table>
	<br>				
<style>
.logo_border{
	border: 0px solid black !important;
}
.remove_border{
	border: 0px solid black !important;
}
.left{
	text-align: start !important;
}
.right{
	text-align: end !important;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: center;    
}
</style>
 <table style="width:100%">
  <tr>
    <th colspan="2">Earnings</th>
    <th colspan="2">Deductions</th>
  </tr>
  <tr>
    <td class="left">Basic </td>
    <td class="right"><?php echo number_format($amount[0],2);?></td>
    <td class="left">Provident Fund </td>
    <td class="right">-</td>
  </tr>
   <tr>
    <td class="left">HRA</td>
    <td class="right"><?php echo number_format($amount[1],2);?></td>
    <td class="left"></td>
    <td class="right"></td>
  </tr>
   <tr> 
    <td class="left">Conveyance</td>
    <td class="right"><?php echo number_format($amount[2],2);?></td>
    <td class="left"> E.S.I.</td>
    <td class="right"><?php 
	
		if(array_key_exists("ESIC",$ded_amount))
		{
			echo number_format($ded_amount["ESIC"],2);
		}
		else
		{
			echo 0.00;
		}
	?></td>
  </tr>
   <tr>
    <td class="left">Special Allowance</td>
    <td class="right"><?php echo number_format($amount[3],2);?></td>
    <td class="left">Loan</td>
    <td class="right"></td>
  </tr>
  <tr>
    <td class="left">LTA</td>
    <td class="right"><?php echo number_format($amount[4],2);?></td>
    <td class="left">Profession Tax</td>
    <td class="right"></td>
  </tr>
  <tr>
    <td class="left">Pf Additional</td>
    <td class="right"><?php echo number_format(0,2);?></td>
    <td class="left">club</td>
    <td class="right"><?php 
	
		if(array_key_exists("CLUB",$ded_amount))
		{
			echo number_format($ded_amount["CLUB"],2);
		}
		else
		{
			echo 0.00;
		}
	?></td>
  </tr>
  <tr>
    <td class="left">Statutory Bonus</td>
    <td class="right"><?php echo number_format(0,2);?></td>
    <?php 
	
		if(array_key_exists("Loss Of Pay",$ded_amount))
		{
			?>
			<td class="left">Loss Of Pay</td>
			<td class="right">
			<?php
			echo number_format($ded_amount["Loss Of Pay"],2);
			?>
			</td>
			<?php
		}
		else
		{
			?>
			<td class="left"></td>
			<td class="right"></td>
			<?php
		}
	?>
  </tr>
  <tr>
    <td class="left"></td>
    <td class="right"></td>
    <td class="left">Total Deduction</td>
    <td class="right"><?php echo number_format($deduction_total,2);?></td>
  </tr>
   <tr>
    <td class="left" style="font-weight:bold;">Total</td>
    <td style="font-weight:bold;" class="right"><?php echo number_format($gross_salary,2) ;?></td>
    <td style="font-weight:bold;"  class="left">NET Salary</td>
    <td style="font-weight:bold;" class="right"><?php echo number_format($number,2) ;?></td>
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
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
		  $string_amount='';
   $string_amount=$result . "Rupees  " . $points . " Paise only";
   
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

	}
?>
  <script>
        function printDiv() {
            var divContents = document.getElementById("main").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            //a.document.write('<body > <h1>Div contents are <br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
</body>
</html>