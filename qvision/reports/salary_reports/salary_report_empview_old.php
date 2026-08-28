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
	<th>OtherAllowance</th>
	<th>SiteAlloowance</th>
	<th>GrossTotal</th>
	<th>PF</th>
	<th>ESI</th>
	<th>PF working days Deduction</th>
	<th>ESI Working days Deduction</th>
	<th>PT Deduction</th>
	<th>Advance</th>
	<th>TDS Deduction</th>
	<th>E-claim reimbursement</th>
	<th>Net Amount</th>
	
</tr>
	</thead>
	<tbody>
	<?php
		require '../../../connect.php';	

		$emp_id = $_REQUEST['emp_name'];

		$sr_month = $_REQUEST['sr_month'];
		 
		$fromDate = preg_split("/\-/",$sr_month);
		$from_year = $fromDate[0]; //Year
		$from_month = $fromDate[1]; //Month

	
		//get payroll_master details
			
			if($emp_id){
		    $staff_sql=$con->query("SELECT a.* FROM staff_master a  join bb_attendance b on a.emp_code = b.emp_code where  a.id = '$emp_id' and a.status=1 and year(b.in_log_date)='$from_year' and month(b.in_log_date) = '$from_month' group by b.emp_code ");	
			
		}else{
			 $staff_sql=$con->query("SELECT a.* FROM staff_master a  join bb_attendance b on a.emp_code = b.emp_code wherea.status=1 and year(b.in_log_date)='$from_year' and month(b.in_log_date) = '$from_month' group by b.emp_code ");	
		} 
		
		$p = 1;
		while($staff_sql_res=$staff_sql->fetch(PDO::FETCH_ASSOC))
		{					
	$employee_id = $staff_sql_res['id'];
			$candid_id = $staff_sql_res['candid_id'];
			$employee_code =$staff_sql_res['emp_code'];
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
			$doj_sql=$con->query("SELECT * from candidate_form_details WHERE id='$candid_id'");
			$doj_sql_res=$doj_sql->fetch(PDO::FETCH_ASSOC);		
			$doj = $doj_sql_res['joining_date'];
			$Experience=$doj_sql_res['no_of_year'];
		



 //echo $getworkdaytype.'kokoko';
        $countgetworkingdays=$con->query("SELECT sum(working_days) as workdy_count,total_days FROM `bb_attendance` where emp_code='$employee_code' and year(in_log_date)='$from_year' and month(in_log_date) = '$from_month'");
		//echo "SELECT sum(working_days) as workdy_count,tota