<?php
require '../../../connect.php';
require '../../../user.php';
$userrole=$_SESSION['userrole'];

// Filter variables
$f_from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
$f_to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
$f_dept = isset($_POST['dept_id']) ? $_POST['dept_id'] : '';

?>
<div  class="card card-primary">
    <div class="card-header" style="background-color: #f1cc61;">
        <h3 class="card-title" ><font size="5">Time Sheet Report</font></h3>
    </div>
    
    <div class="card-body">
        <!-- Filter Form -->
        <form id="ts_filter_form" style="margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; background: #f9f9f9;">
            <div class="row">
                <div class="col-md-3">
                    <label>From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control" value="<?php echo $f_from_date; ?>">
                </div>
                <div class="col-md-3">
                    <label>To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control" value="<?php echo $f_to_date; ?>">
                </div>
                <div class="col-md-3">
                    <label>Department</label>
                    <select name="dept_id" id="filter_dept" class="form-control">
                        <option value="">-- All Departments --</option>
                        <?php
                        $dep_sql=$con->query("SELECT * FROM z_department_master");
                        while($dep_res = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
                            $sel = ($f_dept == $dep_res['id']) ? 'selected' : '';
                            echo '<option value="'.$dep_res['id'].'" '.$sel.'>'.$dep_res['dept_name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>&nbsp;</label><br>
                    <button type="button" class="btn btn-success" onclick="apply_ts_filter()">Filter</button>
                    <button type="button" class="btn btn-secondary" onclick="reset_ts_filter()">Reset</button>
                </div>
            </div>
        </form>

        <table class="table table-striped table-bordered table-hover" id="example1">
        <thead>
            <tr>
                <th>SL.No</th>
                <th>Emp Code</th>
                <th>Employee Name</th>
                <th>Reporting To</th>
                <th>Department</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
// Get logged-in user's staff details
$user_id = $_SESSION['userid'];
$logged_in_staff_id = 0;
$logged_in_dep_id = 0;
$logged_in_head_status = 0;

$staff_id_query = $con->query("SELECT s.id, s.dep_id, s.head_status FROM z_user_master u JOIN staff_master s ON u.candidate_id = s.candid_id WHERE u.user_id = '$user_id'");
if($row = $staff_id_query->fetch(PDO::FETCH_ASSOC)) {
    $logged_in_staff_id = $row['id'];
    $logged_in_dep_id = $row['dep_id'];
    $logged_in_head_status = $row['head_status'];
}

// 1. Build reporting tree for recursive lookup
$all_staff_q = $con->query("SELECT id, candid_id, reporting_person, emp_name FROM staff_master");
$direct_reports = [];
$manager_names = [];
while($st = $all_staff_q->fetch(PDO::FETCH_ASSOC)) {
    $rep_id = (int)$st['reporting_person'];
    $direct_reports[$rep_id][] = $st;
    $manager_names[$st['id']] = $st['emp_name'];
}

$allowed_candid_ids = [];

// Recursive function to get all descendant candid_ids
function get_all_descendants($manager_id, $direct_reports, &$allowed_candid_ids) {
    if(isset($direct_reports[$manager_id])) {
        foreach($direct_reports[$manager_id] as $staff) {
            if(!in_array($staff['candid_id'], $allowed_candid_ids)) {
                $allowed_candid_ids[] = $staff['candid_id'];
                get_all_descendants($staff['id'], $direct_reports, $allowed_candid_ids);
            }
        }
    }
}

// 2. Build Base Query and Apply Filters
$where_clauses = ["1=1"];

if($f_from_date != '') { $where_clauses[] = "a.date >= '$f_from_date'"; }
if($f_to_date != '') { $where_clauses[] = "a.date <= '$f_to_date'"; }
if($f_dept != '') { $where_clauses[] = "b.dep_id = '$f_dept'"; }

// Apply Role-based filtering (Head Status & Recursive Hierarchy)
if($userrole == 'R001' || $userrole == '1' || $userrole == 'Admin') {
    // Admin sees all
} else {
    // Manager/Head filtering
    get_all_descendants($logged_in_staff_id, $direct_reports, $allowed_candid_ids);
    $ids_str = empty($allowed_candid_ids) ? "-1" : implode(',', $allowed_candid_ids);
    
    if($logged_in_head_status == '1') {
        // Head sees all in their department OR their specific descendants
        $where_clauses[] = "(b.dep_id = '$logged_in_dep_id' OR a.staff_id IN ($ids_str))";
    } else {
        // Normal manager sees only their descendants
        $where_clauses[] = "a.staff_id IN ($ids_str)";
    }
}

$where_sql = implode(' AND ', $where_clauses);

$emp_sql = $con->query("
    SELECT a.id as emp_id, a.*, b.*, d.dept_name 
    FROM time_sheet a 
    LEFT JOIN staff_master b ON(a.staff_id=b.candid_id) 
    LEFT JOIN z_department_master d ON(b.dep_id=d.id) 
    WHERE $where_sql 
    ORDER BY b.reporting_person DESC, a.date DESC, a.id DESC
");

// 3. Display Data (Flat Table for perfect Pagination and Sorting)
$i=1;
while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
    $rep_id = (int)$emp_res['reporting_person'];
    $m_name = isset($manager_names[$rep_id]) ? $manager_names[$rep_id] : 'Direct / Admin';
?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $emp_res['emp_code']; ?></td>
        <td><?php echo $emp_res['emp_name']; ?></td>
        <td><?php echo $m_name; ?></td>
        <td><?php echo $emp_res['dept_name']; ?></td>
        <td><?php echo date('d-m-Y', strtotime($emp_res['date'])); ?></td>
        <td>	
            <button class="btn btn-primary btn-sm view btn-flat" data-id="<?php echo $emp_res['emp_id']; ?>" onclick="report_view(<?php echo $emp_res['emp_id']; ?>)"><i class="fa fa-eye"></i> View</button>
        </td> 
        </tr>
<?php
    $i++;
}

if($i == 1) {
    echo '<tr><td colspan="7" class="text-center">No timesheets found for your reportees matching the filters.</td></tr>';
}
?>
        </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#example1').DataTable({
        "ordering": false,
        "paging": true,
        "pageLength": 10,
        "info": true,
        "lengthChange": true,
        "columnDefs": [
            { "visible": false, "targets": 3 }
        ],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(3, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group" style="background-color: #d1ecf1;"><td colspan="6"><b style="color:#0c5460; font-size: 15px;">👤 Reportees under: '+group+'</b></td></tr>'
                    );
                    last = group;
                }
            } );
        }
    });
});

function apply_ts_filter() {
    $.ajax({
        type: "POST",
        url: "qvision/Recruitment/project_management/time_sheet_report.php",
        data: $("#ts_filter_form").serialize(),
        success: function(data){
            $("#main_content").html(data);
        }
    });
}

function reset_ts_filter() {
    $.ajax({
        type: "POST",
        url: "qvision/Recruitment/project_management/time_sheet_report.php",
        success: function(data){
            $("#main_content").html(data);
        }
    });
}

function report_view(v) {
    $.ajax({
        type:"POST",
        url:"qvision/Recruitment/project_management/view_time_sheet.php?id="+v,
        success:function(data){
            $("#main_content").html(data);
        }
    });
}
</script>