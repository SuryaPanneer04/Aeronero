	<?php
	require '../../connect.php';
	?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a {
	color: black;
}
.card-primary:not(.card-outline)>.card-header{
	color: black !important;
}
</style>	
	<div  class="card card-primary">
    <div class="card-header" style="background-color:#ff8b3d !important;color:white !important;">
	<div class="col-lg-12">
	<h4>Salary Details View</h4>
	</div>
    <div class="panel-body">
	<form method="GET" id="payslip_inputs_form" name="payslip_inputs" role="form">
		<div class="row">
		
		<div class="col-lg-3">
		<div class="form-group">
		<select class="form-control" name="payroll_id">
		<option value="0">-- Select Month --</option>
		<?php
		$staff_payroll_sql=$con->query("select id,month,year,flag from payroll_master where flag in (2,3)");
		while($staff_payroll_res=$staff_payroll_sql->fetch(PDO::FETCH_ASSOC))
		{
			$m = $staff_payroll_res['month'];
			$year = $staff_payroll_res['year'];

			switch ($m) {
    case "1":
        $endOfMonth = date('t', strtotime("$year-01-01"));
        $pay_period = "1st Jan".' '.$year." – $endOfMonth"."th Jan".' '.$year;
        break;
        
    case "2":
        // Check if it's a leap year
        $isLeapYear = date('L', strtotime("$year-01-01"));
        if ($isLeapYear) {
            $endOfMonth = 29; // February has 29 days in a leap year
        } else {
            $endOfMonth = 28; // February has 28 days in a non-leap year
        }
        $pay_period = "1st Feb".' '.$year." – $endOfMonth"."th Feb".' '.$year;
        break;
        
    case "3":
        $endOfMonth = date('t', strtotime("$year-03-01"));
        $pay_period = "1st Mar".' '.$year." – $endOfMonth"."th Mar".' '.$year;
        break;
        
    case "4":
        $endOfMonth = date('t', strtotime("$year-04-01"));
        $pay_period = "1st Apr".' '.$year." – $endOfMonth"."th Apr".' '.$year;
        break;
        
    case "5":
        $endOfMonth = date('t', strtotime("$year-05-01"));
        $pay_period = "1st May".' '.$year." – $endOfMonth"."th May".' '.$year;
        break;
        
    case "6":
        $endOfMonth = date('t', strtotime("$year-06-01"));
        $pay_period = "1st Jun".' '.$year." – $endOfMonth"."th Jun".' '.$year;
        break;
        
    case "7":
        $endOfMonth = date('t', strtotime("$year-07-01"));
        $pay_period = "1st Jul".' '.$year." – $endOfMonth"."th Jul".' '.$year;
        break;
        
    case "8":
        $endOfMonth = date('t', strtotime("$year-08-01"));
        $pay_period = "1st Aug".' '.$year." – $endOfMonth"."th Aug".' '.$year;
        break;
        
    case "9":
        $endOfMonth = date('t', strtotime("$year-09-01"));
        $pay_period = "1st Sep".' '.$year." – $endOfMonth"."th Sep".' '.$year;
        break;
        
    case "10":
        $endOfMonth = date('t', strtotime("$year-10-01"));
        $pay_period = "1st Oct".' '.$year." – $endOfMonth"."th Oct".' '.$year;
        break;
        
    case "11":
        $endOfMonth = date('t', strtotime("$year-11-01"));
        $pay_period = "1st Nov".' '.$year." – $endOfMonth"."th Nov".' '.$year;
        break;
        
    case "12":
        $endOfMonth = date('t', strtotime("$year-12-01"));
        $pay_period = "1st Dec".' '.$year." – $endOfMonth"."th Dec".' '.$year;
        break;


			   default:
				 $pay_period = $staff_payroll_res['month'].'-'.$staff_payroll_res['year'];
			  }
		?>
		<!-- <option value="<?php echo $staff_payroll_res['id']; ?>"><?php echo $staff_payroll_res['month'].'-'.$staff_payroll_res['year']; ?></option> -->
		<option value="<?php echo $staff_payroll_res['id']; ?>"><?php echo $pay_period; ?></option>
		<?php
		} 
		?>
		</select>
		</div>
		</div>
		
		<div class="col-lg-3">
		<div class="form-group">
		<select class="form-control" name="department">
		<option value="0">-- Select Department --</option>
		<option value="0"> All </option>
		<?php
		$dep_sql=$con->query("SELECT id, dept_name, status FROM z_department_master");
		while($dep_sql_res=$dep_sql->fetch(PDO::FETCH_ASSOC))
		{
		?>
		<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
		<?php
		}
		?>
		</select>
		</div>		
		</div>
		
		<div class="col-lg-3">
		<div class="form-group">		
		<input  type="button" class="btn btn-default" value="search" onclick="payslip_view()">
		</div>
		</div>
		
		</div>
	</form>
	</div>
    </div>
  <!-- /.card-header -->
    <div class="card-body">
      <div id="salary_details_view">
      </div>
    </div>
    <!-- /.card-body   style="overflow-x: scroll !important;"-->
  </div>

	
<script>
function payslip_view()
{
	var data = $('#payslip_inputs_form').serialize();
	$.ajax({
	type: "GET",
	url: "qvision/salary_details/salary_details_view.php",
	data: data,
	success: function(data)
	{
	$("#salary_details_view").html(data);		
	}				
	});	
}
</script>