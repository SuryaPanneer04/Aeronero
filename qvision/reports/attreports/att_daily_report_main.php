<?php
	require '../../../connect.php';
?>

<style>
.card-primary:not(.card-outline)>.card-header{
	background-color: #f1cc61 !important;
}
.card-primary:not(.card-outline)>.card-header a, 
.card-primary:not(.card-outline)>.card-header {
	color: black;
}
</style>	

<div class="card card-primary">
    <div class="card-header">
		<div class="col-lg-12">
			<h4>Daily Attendance Report</h4>
		</div>
    </div>
    <div class="panel-body">
		<form method="GET" name="att_reports" role="form">
			<div class="row">
				<!-- Department Name -->
				<div class="col-lg-2">
					<div class="form-group">
						<label>Department Name</label>
						<select class="form-control" name="dept_name" id="dept_name" onchange="fetchDivisions(this.value)">
    <option value="0">-- Select Department --</option>
    <option value="all">All</option> <!-- Added "All" option here -->
    <?php 
        $staff = $con->query("select id, dept_name from z_department_master where status='1'");
        while($staffView = $staff->fetch(PDO::FETCH_ASSOC)){    
    ?>
        <option value="<?php echo $staffView['id']; ?>"><?php echo $staffView['dept_name']; ?></option>
    <?php } ?>
</select>

					</div>
				</div>

				<!-- Division -->
				<div class="col-lg-2">
					<div class="form-group">
						<label>Division</label>
						<select class="form-control" name="division" id="division">
							<option value="0">-- Select Division --</option>
							<!-- Division options will be dynamically populated here -->
						</select>
					</div>
				</div>

				<!-- From Date -->
				<div class="col-lg-2">
					<div class="form-group">
						<label>From Date</label>
						<input type="date" name="from_date" class="form-control" required>  
					</div>
				</div>

				<!-- To Date -->
				<div class="col-lg-2">
					<div class="form-group">
						<label>To Date</label>
						<input type="date" name="to_date" class="form-control" required>  
					</div>
				</div>

				<!-- Attendance Type -->
				<div class="col-lg-2">
					<div class="form-group">
						<label for="attendance_type">Attendance Type</label>
						<select id="attendance_type" name="attendance_type" class="form-control">
							<option value="">Select Type</option>
							<option value="early_coming">Early Coming</option>
							<option value="late_coming">Late Coming</option>
							<option value="early_going">Early Going</option>
							<option value="late_going">Late Going</option>
						</select>
					</div>
				</div>

				<!-- Search Button -->
				<div class="col-lg-2 align-self-end">
					<div class="form-group">		
						<input type="button" class="btn btn-default" value="SEARCH" onclick="att_empview()">
					</div>
				</div>
			</div>
		</form>
	</div>
    <div class="card-body">
        <div id="att_details_view">
<?php
        
// Define the fixed office times
$fixed_in_time = strtotime("09:00:00");
$fixed_out_time = strtotime("18:00:00");

// Prepare the base SQL query
$sql = "SELECT a.*, b.emp_name AS name, c.designation_name AS design, d.dept_name AS dept, a.daily_in, a.daily_out 
        FROM attire_form a 
        JOIN staff_master b ON a.emp_no = b.candid_id 
        JOIN designation_master c ON a.design_id = c.id 
        JOIN z_department_master d ON a.dep_id = d.id 
        ";



$sql .= " GROUP BY a.id 
          ORDER BY a.date DESC";

// Prepare and execute the statement
$stmt = $con->prepare($sql);
// $stmt->bindParam(':from_date', $from_date);
// $stmt->bindParam(':to_date', $to_date);
// $stmt->bindParam(':dept_name', $dept_name);
// $stmt->bindParam(':division', $division);



$stmt->execute();

// Check if any data is returned
if ($stmt->rowCount() > 0) {
    $cnt = 1;
    ?>
    <div class="table-responsive">
        <table id="summarySplitTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>In Time</th>
                    <th>Out Time</th>
                   
                    <th>Early Coming</th>
                   
                    <th>Late Coming</th>
                   
                    <th>Early Going</th>
                   
                    <th>Late Going</th>
                   
                </tr>
            </thead>
            <tbody>
            <?php
            while ($rep = $stmt->fetch()) {
                // Convert actual times to timestamps for comparison
                $actual_in_time = strtotime($rep['daily_in']);
                $actual_out_time = strtotime($rep['daily_out']);

                // Calculate Early Coming (before 9:00 AM)
                $earlyComing = $actual_in_time < $fixed_in_time ? gmdate("H:i", $fixed_in_time - $actual_in_time) : "-";

                // Calculate Late Coming (after 9:00 AM)
                $lateComing = $actual_in_time > $fixed_in_time ? gmdate("H:i", $actual_in_time - $fixed_in_time) : "-";

                // Calculate Early Going (before 6:00 PM)
                $earlyGoing = $actual_out_time < $fixed_out_time ? gmdate("H:i", $fixed_out_time - $actual_out_time) : "-";

                // Calculate Late Going (after 6:00 PM)
                $lateGoing = $actual_out_time > $fixed_out_time ? gmdate("H:i", $actual_out_time - $fixed_out_time) : "-";
                ?>
                <tr>
                    <td><?php echo $cnt; ?>.</td>
                    <td><?php echo $rep['date']; ?></td>
                    <td><?php echo $rep['name']; ?></td>
                    <td><?php echo $rep['design']; ?></td>
                    <td><?php echo $rep['dept']; ?></td>
                    <td><?php echo $rep['daily_in'].'(24hrs)'; ?></td>
                    <td><?php echo $rep['daily_out'].'(24hrs)'; ?></td>
                   
                    <td><?php echo ($earlyComing !== "-" ? $earlyComing . ' (HH:MM)' : '-'); ?></td>
<td><?php echo ($lateComing !== "-" ? $lateComing . ' (HH:MM)' : '-'); ?></td>
<td><?php echo ($earlyGoing !== "-" ? $earlyGoing . ' (HH:MM)' : '-'); ?></td>
<td><?php echo ($lateGoing !== "-" ? $lateGoing . ' (HH:MM)' : '-'); ?></td>





                   
                </tr>
                <?php
                $cnt++;
            }
            ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "<div>No records found for the selected criteria.</div>";
}
?>

        </div>
    </div>
</div>

<script>

function fetchDivisions(deptId) {
    debugger;
	$.ajax({
		type: 'GET',
		url: 'qvision/reports/attreports/fetch_divisions.php',
		data: { dept_id: deptId },
		success: function(response) {
			$('#division').html(response);
		}
	});
}
</script>
<script>
function att_empview() {
 debugger;
    var dept_name=$("#dept_name").val();
    var division=$("#division").val();
    var attendance_type=$("#attendance_type").val();
    if(dept_name=='all' && division=='0' && attendance_type=='')
    {

var data = $('form').serialize();
	$.ajax({
    type: 'GET',
    url: 'qvision/reports/attreports/att_daily_report_all.php',
    data: data,
    success: function(data) {
        console.log(data);  // Log response to console
        $("#att_details_view").html(data);
    },
    error: function(xhr, status, error) {
        console.error("AJAX Error: ", status, error); // Log any AJAX error
        alert("Failed to load data.");
    }
});
    }
    else if(dept_name!='all' && division!='0' && attendance_type=='')
    {
        var data = $('form').serialize();
	$.ajax({
    type: 'GET',
    url: 'qvision/reports/attreports/att_daily_report_dept_wise.php',
    data: data,
    success: function(data) {
        console.log(data);  // Log response to console
        $("#att_details_view").html(data);
    },
    error: function(xhr, status, error) {
        console.error("AJAX Error: ", status, error); // Log any AJAX error
        alert("Failed to load data.");
    }
});
    }
    else if(dept_name!='all' && division!='0' && attendance_type!='')
    {
// debugger;
var data = $('form').serialize();
	$.ajax({
    type: 'GET',
    url: 'qvision/reports/attreports/att_daily_report.php',
    data: data,
    success: function(data) {
        console.log(data);  // Log response to console
        $("#att_details_view").html(data);
    },
    error: function(xhr, status, error) {
        console.error("AJAX Error: ", status, error); // Log any AJAX error
        alert("Failed to load data.");
    }
});
    }
 
	
}
</script>
