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
	<th>PF No</th>
	<th>UAN NO</th>
	<th>ESIC No</th>
	<th>Employee No</th>
	<th>DOJ</th>
	<th>DOMC</th>
	<th>Experience</th>
	<th>Location</th>
	<th>Name</th>
	<th>Department</th>
	<th>Designation</th>
	<th>Total Gross Salary</th>
<!--	<th>Gross</th> -->
	<th>N.O. Leave Taken (Eligible)</th>
	<th>NOA</th>
	<th>LOP/Late</th>
	<th>Prorrata Salary Deduction</th>
	<th>Working Days</th>
	<th>Paid Days Salary</th>
	<th>Basic </th>
	<th>HRA </th>
	<th>LTA</th>
	<!-- <th>SAD</th> -->
	<th>Conveyance</th>
	<th>Spl Allowance</th>
	<th>Bas,Con,Spl Allw</th>
	<th>GrossTotal</th>
	<th>PF</th>
	<th>ESI</th>
	<th>PF working days Deduction</th>
	<th>ESI Working days Deduction</th>
	<th>PT Deduction</th>
	<th>Advance/Laptop Deduction/Others</th>
	<th>TDS Deduction</th>
	<th>E-claim reimbursement</th>
	<th>Total Deduction</th>
	<th>Net Amount</th>
	<th>ESIC Employer</th>
</tr>
	</thead>
	<tbody>
	<?php
		require '../../../connect.php';	

		$srFromDate = $_REQUEST['sr_FromDate'];
		$srToDate = $_REQUEST['sr_ToDate']; 
		
		$fromDate = preg_split("/\-/",$srFromDate);
		$from_year = $fromDate[0]; //Year
		$from_month = $fromDate[1]; //Month
	
		$toDate = preg_split("/\-/",$srToDate);
		$to_year = $toDate[0]; //Year 
		$to_month = $toDate[1]; //Month
		//get payroll_master details
			

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
			$pf_number = $staff_sql_res['pf_number'];
			$uan_number = $staff_sql_res['uan_number'];
			$esic_number = $staff_sql_res['esic_number'];
			$location = $staff_sql_res['location'];
		
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
			$days_sql=$con->query("SELECT total_no_of_days,days_worked FROM payroll_salary_deduction where employee_code='$employee_id' and (( pa