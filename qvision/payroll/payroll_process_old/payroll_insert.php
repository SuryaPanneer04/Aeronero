<?php

require '../../../connect.php';

		$month = $_REQUEST['month'];
		$year = $_REQUEST['year'];

		//payroll update

		$payroll_update=$con->query("update payroll_master set flag=2 where month='$month' and year='$year' and flag=1");

		if($payroll_update)
		{
		//payroll for Onroll EmployeeCode

		    $in_log_date = $year.'-'.$month.'-01'; 
			$out_log_date = date("Y-m-t", strtotime($in_log_date));

			$dateMonthYearArr = array();
			$in_log_dateTS = strtotime($in_log_date);
			$out_log_dateTS = strtotime($out_log_date);

			for($currentDateTS = $in_log_dateTS; $currentDateTS <= $out_log_dateTS; $currentDateTS += (60 * 60 * 24)) 
			{
			$currentDateStr = date("Y-m-d",$currentDateTS);
			$dateMonthYearArr[] = $currentDateStr;
			}

		//Holiday start here 
			$datequery=$con->query("select leave_date from holiday_master where year=year('$in_log_date')");			
			while($result_query = $datequery->fetch(PDO::FETCH_ASSOC))	
			{
				$GOV_HOLIDAY[]=$result_query['leave_date'];
			}	

		//employee start loop here  
			$inndate1=$con->query("select emp_code from (SELECT distinct emp_code FROM `bb_attendance` WHERE year(in_log_date)='$year' AND month(in_log_date)='$month' union  select distinct emp_code from manual_att where year(date)='$year' AND month(date)='$month') a");

			while($att_result_query=$inndate1->fetch(PDO::FETCH_ASSOC))
			{
				$emp_no=$att_result_query['emp_code'];  
				$day_count=0;
				$sundays = 0;
				$saturday_count=0;
                $att_count=0;
				for($i=0;$i<sizeof($dateMonthYearArr);$i++)
				{
					$date=$dateMonthYearArr[$i];
					
					$day=date('D',strtotime($date));
					$xx=count($dateMonthYearArr);
					$dayquery=$con->query("SELECT COUNT(*) FROM bb_attendance WHERE emp_code='$emp_no' and in_log_date='$date'");		
					$count = $dayquery->fetchColumn(); 
					$att_count=$att_count+$count; 
					if($count>0)
					{
						$day=$con->query("select working_days from bb_attendance WHERE emp_code='$emp_no' and in_log_date='$date'");
						$days=$day->fetch();
						$working=$days['working_days'];
						if($working == 1.0){
						$day_count=$day_count+1; 
						}
						elseif($working == 0.5){
							$day_count=$day_count+0.5;
						}
					}
					else
					{
						$dayquery=$con->query("SELECT count(*) FROM manual_att where date='$date' and emp_code='$emp_no'");						
						$count = $dayquery->fetchColumn();
						if($count>0)
						{
							$day_count=$day_count+1;
						}
					}
					/* if($count>0)
					{ */
						
						//if(($day=="Sun")||(in_array($date, $GOV_HOLIDAY)))	
							if(($day=="Sun"))
						{
							$sundays =$sundays +1;  
						}
				
						if($day=="Sat")
						{
						 	$saturday_count=$saturday_count+1;
							if($saturday_count == 2)
							{
							  $day_count=$day_count+1;
							}
						}
					//}
				}
				
				if($att_count>0){
					$days_worked = $day_count+$sundays; 
				}else{
					  $days_worked = 0;
				}

				$total_working_days = sizeof($dateMonthYearArr);				
				$lop = $total_working_days - $days_worked;	 
				
				$staff_data_sql=$con->query("SELECT  id as emp_no, emp_name,dep_id as department_id,design_id as designation_id, scale_master_id, payroll_deduction_id,salary_amount,varaible_pay,status,candid_id FROM staff_master where status=1 and id='$emp_no'");	
				while($sm_data = $staff_data_sql->fetch(PDO::FETCH_ASSOC))
				{					
					$emp_code = $sm_data['emp_no']; 
					$emp_name = $sm_data['emp_name'];
					$scale_id = $sm_data['scale_master_id'];
					$salary_amount = $sm_data['salary_amount'];
					$deduct_id = $sm_data['payroll_deduction_id'];
					$candidate_id=$sm_data['candid_id'];

				//Appraisal salary 
				$salary=$con->query("select emp_name,salary,new_salary_start_date from `appraisal_details` WHERE emp_name='$emp_no' and new_salary_start_date=(select mAX(new_salary_start_date) as hike_sal_date FROM `appraisal_details` WHERE emp_name='$emp_no' and `new_salary_start_date` <= CURDATE())");
				$appraisalrowcount = $salary->rowCount();
				$staff_sal=$salary->fetch();
                $app_salary_date = $staff_sal['new_salary_start_date'];
                $app_salary = $staff_sal['salary'];

				if($appraisalrowcount > 0){
                    $monthly_salary = (($salary_amount * ($app_salary / 100)) + $salary_amount);

				} else {
					$monthly_salary = $salary_amount;
				}

					$scale_head_sql = $con->query("SELECT a.payroll_master_id, a.payroll_master_name, a.salary_structure_id, a.salary_structure_name,b.amount,b.percentage,a.status FROM payroll_scale_details a join  payroll_structure b on a.salary_structure_id=b.id where a.payroll_master_id='$scale_id'");
				
			//earnings Part
				$amount =0;
					while($scale_head_data = $scale_head_sql->fetch(PDO::FETCH_ASSOC))
					{
						$salary_structure_id=$scale_head_data['salary_structure_id'];
						$earnings=$scale_head_data['salary_structure_name'];
						$struct_amount=$scale_head_data['amount'];

						if($struct_amount==0)
						{
							$percentage=$scale_head_data['percentage'];
							
							if($earnings=='Basics'){
								$amount = ($monthly_salary*$percentage/100);
							}
							else if($earnings=='House Rent Allowance'){
								$basic = ($monthly_salary*35/100);
								$amount=($basic*70/100);
							}else{
								$amount = ($monthly_salary*$percentage/100); 
							}
						}
						else
						{
							$amount = $struct_amount;
						}
						
						$data = array($date,$month,$year,$emp_code,$emp_name,$earnings,$amount,1,1,$date);
						$stmt = $con->prepare("INSERT INTO payroll_salary_earnings(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
						
						$stmt->execute($data);		
					}
					
			//Earnings Special_Allowance
					$earns = $con->query("SELECT *,count(*) as earn FROM `salary_monthly_earning` WHERE status = 1 && payroll_month='$month' && payroll_year='$year' && candid_id='$candidate_id'"); 
					$earnings_add = $earns->fetch(PDO::FETCH_ASSOC);
					$earn_count = $earnings_add['earn'];
					if($earn_count>0){
						$sa = $earnings_add['Special_Allowance'];
						
						$earned = $con->query("INSERT INTO payroll_salary_earnings(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES ('$date','$month','$year','$emp_code','$emp_name','Special Allowance','$sa',1,1,'$date')");
				    }
					
			//Earnings LTA		
					$earn = $con->query("SELECT *,count(*) as earn FROM `salary_monthly_earning` WHERE status = 1 && payroll_month='$month' && payroll_year='$year' && candid_id='$candidate_id'"); 
					$earning_add = $earn->fetch(PDO::FETCH_ASSOC);
					$earns_count = $earning_add['earn'];
					if($earns_count>0){
						$lta = $earning_add['LTA'];
						
						$earned = $con->query("INSERT INTO payroll_salary_earnings(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES ('$date','$month','$year','$emp_code','$emp_name','LTA','$lta',1,1,'$date')");
				    }
						
                //Claim Amount insert into payroll_salary_earnings
                     $claims = $con->query("SELECT *,count(*) as claimcnt FROM `claim_request` WHERE status = 6 && MONTH(created_on)='$month'&& YEAR(created_on)='$year' && candidate_id='$candidate_id'"); 
						$claimadd = $claims->fetch(PDO::FETCH_ASSOC);
				     	$claim_count = $claimadd['claimcnt'];
						
						if($claim_count>0){
						$claim_amount = $claimadd['amount'];
						
						$stmt = $con->query("INSERT INTO payroll_salary_earnings(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES ('$date','$month','$year','$emp_code','$emp_name','claim','$claim_amount',1,1,'$date')");
						}

  //Start earned salary payroll
		$fixed_gross=$con->query("select sum(amount) as fixed_gross from payroll_salary_earnings where employee_code='$emp_code' and payroll_month='$month' and payroll_year='$year'");
		$fix_gross=$fixed_gross->fetch(PDO::FETCH_ASSOC);
		$fgross=$fix_gross['fixed_gross'];

		if($lop>0){
			$perday_amounts = ($monthly_salary/$total_working_days);
			$total_lops = ($perday_amounts*$lop);
			$earned_gross=$fgross-$total_lops;
		}else{
			$earned_gross=$monthly_salary;
		}
		
		$scale_head_sqls = $con->query("SELECT a.payroll_master_id, a.payroll_master_name, a.salary_structure_id, a.salary_structure_name,b.amount,b.percentage,a.status FROM payroll_scale_details a join  payroll_structure b on a.salary_structure_id=b.id where a.payroll_master_id='$scale_id' && b.status =1");
					
					while($scale_head_datas = $scale_head_sqls->fetch(PDO::FETCH_ASSOC))
					{
						$salary_structure_ids=$scale_head_datas['salary_structure_id'];
						$earned_earnings=$scale_head_datas['salary_structure_name'];
						$struct_amounts=$scale_head_datas['amount'];

						if($struct_amounts==0)
						{
							$percentage=$scale_head_datas['percentage'];

							if($earned_earnings=='Basics'){
								$earned_amount = ($earned_gross*$percentage/100);
							}
							else if($earned_earnings=='House Rent Allowance'){
								$basic = ($earned_gross*35/100);
								$earned_amount=($basic*70/100);
							}else{
								$earned_amount = ($earned_gross*$percentage/100); 
							}
						}
							else
						{
							$perday_amt = ($struct_amounts/$total_working_days);
					        $lop_amt = ($perday_amt*$lop);
						    $earned_amount=$struct_amounts-$lop_amt;
						}

						$data = array($date,$month,$year,$emp_code,$emp_name,$earned_earnings,$earned_amount,1,1,$date);
						$stmt = $con->prepare("INSERT INTO payroll_earned_salary(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
					   $stmt->execute($data);		
					}

				//Earnings Special_Allowance
						$spl_allwnce = $con->query("INSERT INTO payroll_earned_salary(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES ('$date','$month','$year','$emp_code','$emp_name','Special Allowance','$sa',1,1,'$date')");
				//Earnings LTA
					    $earned_lta = $con->query("INSERT INTO payroll_earned_salary(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES ('$date','$month','$year','$emp_code','$emp_name','LTA','$lta',1,1,'$date')");
				//Claim Amount insert into payroll_earned_salary
				     if($claim_count>0){     
				        $earned_claims = $con->query("INSERT INTO payroll_earned_salary(date, payroll_month, payroll_year, employee_code, employee_name, earnings, amount, status, created_by, created_on) VALUES ('$date','$month','$year','$emp_code','$emp_name','claim','$claim_amount',1,1,'$date')"); 
					 }
	// end earned salary payroll


				//deductions part
					$deduct_sql = $con->query("SELECT id, name, from_date, amount, percentage, min_amount, max_amount, status FROM payroll_deduction_master where id in ($deduct_id)");
					while($deduct_data = $deduct_sql->fetch(PDO::FETCH_ASSOC))
					{
						$id=$deduct_data['id'];
						$deduction=$deduct_data['name'];
						$from_date=$deduct_data['from_date'];
						$deduct_amount=$deduct_data['amount'];
						$percentage=$deduct_data['percentage'];
						$min_amount=$deduct_data['min_amount'];
						$max_amount=$deduct_data['max_amount'];
				
                //ESI(0.75% employee)=>Basic + Conveyance + S A +HRA except LTA  				
					$esisql=$con->query("select sum(amount) as esi_amount from payroll_earned_salary where employee_code='$emp_no' and payroll_month='$month' and payroll_year='$year' and  earnings!='LTA'");
					$esiquery=$esisql->fetch(PDO::FETCH_ASSOC);	
					$esi_amt=$esiquery['esi_amount'];
					$perday_amntesi = ($monthly_salary/$total_working_days);
					$final_lopesi = round($perday_amntesi*$lop);
						if($deduction == 'ESIC'){
							 $esi_amnt = $esi_amt - $final_lopesi;
							 $amount = round($esi_amnt*$percentage/100);
						}
				
//PF (12% both employee  & employer =Total 24% by SSINFO)=>Basic + Conveyance + S A * 12 % ==> Salary < 15K  OR 1800 ==> salary >15K
//here we deduct for only employee				
					$sqll=$con->query("select sum(amount) as pf_amount from payroll_earned_salary where employee_code='$emp_no' and payroll_month='$month' and payroll_year='$year' and earnings!='House Rent Allowance' and earnings!='LTA'");
							
							$queryy=$sqll->fetch(PDO::FETCH_ASSOC);
							$pf_amt=$queryy['pf_amount'];
							$perday_amnt = ($monthly_salary/$total_working_days);
					        $final_lop = round($perday_amnt*$lop);
							
					if($deduct_amount == 0 && $deduction == 'PF'){
				
							$pf_final = $pf_amt - $final_lop;
							$amount = round($pf_final*$percentage/100);
					
					}elseif($deduct_amount > 0 && $deduction == 'PF'){
						   // $amount = $deduct_amount;   //When salary more than 15K the PF deduction is RS.1800/- as default;
						    $amount = round($deduct_amount *($days_worked/$total_working_days));   //When salary more than 15K the PF deduction is RS.1800/- as default;
					}else{
						$amount = 0;
					}
						try
						{
							$data = array($date,$month,$year,$emp_code,$emp_name,$deduction,$amount,$total_working_days,$days_worked,1,1,$date);
							$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount,total_no_of_days,days_worked, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
							$stmt->execute($data);
						}
						catch(Exception $e)
						{
							//echo "Failed: " . $e->getMessage();
						}
					}			
					if($lop>0)
					{
						$perday_amount = ($monthly_salary/$total_working_days);
					    $total_lop = round($perday_amount*$lop);
						$data = array($date,$month,$year,$emp_code,$emp_name,'Loss Of Pay',$total_lop,1,1,$date);
						$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?)");
						$stmt->execute($data);
					}
                //Deduction TDS		
					$deduct = $con->query("SELECT *,count(*) as deduction FROM `salary_monthly_deduction` WHERE status = 1 && payroll_month='$month' && payroll_year='$year' && candid_id='$candidate_id'"); 
					$deduct_add = $deduct->fetch(PDO::FETCH_ASSOC);
					$deduct_count = $deduct_add['deduction'];
					if($deduct_count>0){
						$tds = $deduct_add['TDS'];
						
						$deduction = $con->query("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on) VALUES ('$date','$month','$year','$emp_code','$emp_name','TDS','$tds',1,1,'$date')");
				    }	
					
                // //Deduction SAD	
				// 	$deduct_sad = $con->query("SELECT *,count(*) as deduction FROM `salary_monthly_deduction` WHERE status = 1 && payroll_month='$month' && payroll_year='$year' && candid_id='$candidate_id'"); 
				// 	$deduction_add = $deduct_sad->fetch(PDO::FETCH_ASSOC);
				// 	$deduction_count = $deduction_add['deduction'];
				// 	if($deduction_count>0){
				// 		$sad = $deduction_add['SAD'];
						
				// 		$deduct_insert = $con->query("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount, status, created_by, created_on) VALUES ('$date','$month','$year','$emp_code','$emp_name','SAD','$sad',1,1,'$date')");
				//     }					
				}

			// Salary Advance
			$advance_sql = $con->query("SELECT * FROM salary_advance where MONTH(start_date) <= $month and MONTH(end_date) >= $month and emp_id='$emp_no'");	
			$count = $advance_sql->rowCount();

			if ($count > 0) {
				$advance_data = $advance_sql->fetch(PDO::FETCH_ASSOC);

				$emp_id = $advance_data['emp_id'];
				$advance_amount = $advance_data['advance_amount'];
				$emi_period = $advance_data['emi_period'];
				$start_date = $advance_data['start_date'];
				$end_date = $advance_data['end_date'];
				$emi_amount = $advance_data['emi_amount'];

				$amount6 = $emi_amount;
                
				$data = array($date, $month, $year, $emp_code, $emp_name, 'Salary Advance', $amount6,$total_working_days,$days_worked, 1, 1, $date);
				$stmt = $con->prepare("INSERT INTO payroll_salary_deduction(date, payroll_month, payroll_year, employee_code, employee_name, deduction, amount,total_no_of_days,days_worked, status, created_by, created_on) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
				$stmt->execute($data);
			} 

			}
			if($stmt){
				echo 1;
			}
		}

//payroll for Onroll EmployeeCode close here 		
