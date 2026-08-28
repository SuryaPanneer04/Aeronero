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
	<th>Employee DOJ</th>
	<th>Employee Date of Confirmation(DOJ)</th>
	<th>Designation</th>
	<th>Employee DOB as per Aadhar</th>
	<th>Personal Contact No</th>
	<th>Emergency Contact No</th>
	<th>Present Address</th>
	<th>Permanent Address</th>
	<th>Pan No</th>
	<th>Aadhar No</th>
	<th>Driving License No</th>
	<th>Father Name With Initial</th>
	<th>Father DOB as per Aadhar</th>
	<th>Mother Name</th>
	<th>Mother DOB as per Aadhar</th>
	<th>First Child Name</th>
	<th>First Child DOB</th>
	<th>Second Child Name</th>
	<th>Second Child DOB</th>
	<th>Date</th>
</tr>
	</thead>
	<tbody>
	<?php
		require '../../../connect.php';	
     	$emp_id = $_REQUEST['emp_name'];

		 $empformmonth = $_REQUEST['empformmonth'];
		 
		 $fromDate = preg_split("/\-/",$empformmonth);
		 $from_year = $fromDate[0]; //Year
		 $from_month = $fromDate[1]; //Month

		//get payroll_master details
		
		if($emp_id){
		    $staff_sql=$con->query("SELECT * FROM employee_master_data where staff_id = '$emp_id' and status=1 and year(created_on)='$from_year' and month(created_on) = '$from_month'");	
			
			
		}else{
			$staff_sql=$con->query("SELECT * FROM employee_master_data where status=1 and year(created_on)='$from_year' and month(created_on) = '$from_month'");
			
		}
		$p = 1;
       while($staff_sql_res = $staff_sql->fetch()){
		
            $employee_id = $staff_sql_res['id'];
            $emp_codee = $staff_sql_res['emp_code'];
            $emp_name = $staff_sql_res['emp_name'];
            $emp_name = $staff_sql_res['emp_name'];
            $emp_doj = $staff_sql_res['emp_doj'];
            $emp_designation = $staff_sql_res['emp_designation'];
            $emp_dob_as_per_aadhar = $staff_sql_res['emp_dob_as_per_aadhar'];
            $personal_contact_no = $staff_sql_res['personal_contact_no'];
            $emergency_contact_no = $staff_sql_res['emergency_contact_no'];
            $present_address = $staff_sql_res['present_address'];
            $permanent_address = $staff_sql_res['permanent_address'];
            $pan_no = $staff_sql_res['pan_no'];
            $aadhar_no = $staff_sql_res['aadhar_no'];
            $driving_license_no = $staff_sql_res['driving_license_no'];
            $father_name_with_initial = $staff_sql_res['father_name_with_initial'];
            $father_dob_per_aadhar = $staff_sql_res['father_dob_per_aadhar'];
            $mother_name = $staff_sql_res['mother_name'];
            $mother_dob_per_aadhar = $staff_sql_res['mother_dob_per_aadhar'];
            $first_child = $staff_sql_res['first_child'];
            $first_child_dob = $staff_sql_res['first_child_dob'];
            $second_child_name = $staff_sql_res['second_child_name'];
            $second_child_dob = $staff_sql_res['second_child_dob'];
            $created_on = $staff_sql_res['created_on'];
            $employee_date_of_confirmation_doj = $staff_sql_res['employee_date_of_confirmation_doj'];
			
		
			?>
			<tr>
			<td><?php echo $p++?></td>
			<td><?php echo $emp_codee;?></td>
			<td><?php echo $emp_name;?></td>
			<td><?php echo $emp_doj;?></td>
			<td><?php echo $employee_date_of_confirmation_doj;?></td>
			<td><?php echo $emp_designation;?></td>
			<td><?php echo $emp_dob_as_per_aadhar;?></td>
			<td><?php echo $personal_contact_no;?></td>
			<td><?php echo $emergency_contact_no;?></td>
			<td><?php echo $present_address;?></td>
			<td><?php echo $permanent_address;?></td>
			<td><?php echo $pan_no;?></td>
			<td><?php echo $aadhar_no;?></td>
			<td><?php echo $driving_license_no;?></td>
			<td><?php echo $father_name_with_initial;?></td>
			<td><?php echo $father_dob_per_aadhar;?></td>
			<td><?php echo $mother_name;?></td>
			<td><?php echo $mother_dob_per_aadhar;?></td>
			<td><?php echo $first_child;?></td>
			<td><?php echo $first_child_dob;?></td>
			<td><?php echo $second_child_name;?></td>
			<td><?php echo $second_child_dob;?></td>
			<td><?php echo $created_on;?></td>
			

			
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
         XLSX.writeFile(wb, fn || ('SS_Employee_Master_Reports.' + (type || 'xlsx')));
    }
</script>
</body>
</html>