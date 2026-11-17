<?php
require '../../connect.php';
include("../../user.php");

$login_candidate_id = $_SESSION['candidateid'] ?? '';
$login_user_id = $_SESSION['userid'] ?? '';
$search_id = !empty($login_candidate_id) ? $login_candidate_id : $login_user_id;
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<style>
    .card-primary:not(.card-outline)>.card-header{
        background-color: #009EE3 !important;
        color: white;
    }
</style>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">My Tasks </font></h3>
   </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="myTasksTable" style="width:100%">
            <thead>
                <th>#</th>
                <th>Date</th>
                <th>Company Name</th>
                <th>Contact Person</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php
            $cnt = 1;
            
            // BUG FIX: LEFT JOIN panni software_quotation_flow table la irundhu scope_text edukurom
            $query = "SELECT e.*, s.scope_text 
                      FROM enquiry e 
                      LEFT JOIN software_quotation_flow s ON e.id = s.enquiry_id 
                      WHERE (e.employee = '$login_candidate_id' OR e.employee = '$login_user_id') 
                      AND e.status >= 30 
                      ORDER BY e.id DESC";
                      
            $tasks = $con->query($query);
            
            while($row = $tasks->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $cnt; ?>.</td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['Company_name']; ?></td>
                    <td><?php echo $row['it_name']; ?></td>
                    <td>
                        <?php 
                        if($row['status'] == 30) {
                            echo '<span style="color:red;font-weight:bold;">Waiting for Scope Addition</span>';
                        } elseif($row['status'] == 31) {
                            echo '<span style="color:orange;font-weight:bold;">Scope Added / Waiting for Approval</span>';
                        } else {
                            echo '<span style="color:green;font-weight:bold;">In Progress / Flow Created</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <!-- Hidden input to store scope text safely -->
                        <input type="hidden" id="scope_val_<?php echo $row['id']; ?>" value="<?php echo htmlspecialchars($row['scope_text'] ?? 'No scope added yet.'); ?>">
                        
                        <!-- Pop-up open pandra button -->
                        <button class="btn btn-info" onclick="view_scope(<?php echo $row['id']; ?>)">
                            <i class="fa fa-eye"></i> View Scope
                        </button>
                    </td>
                </tr>
                <?php
                $cnt++;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Custom Vanilla JS Modal for Viewing Scope -->
<div id="customScopeModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background-color:rgba(0,0,0,0.6);">
  <div style="background-color:#fff; margin:10% auto; padding:20px; width:50%; min-width:300px; border-radius:5px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
    <h4 style="color:#009EE3; margin-top:0;">Software Scope Details</h4>
    <textarea id="custom_modal_text" class="form-control" style="width:100%; height:200px; margin-top:15px; padding:10px;" readonly></textarea>
    <div style="text-align:right; margin-top:15px;">
        <button type="button" class="btn btn-secondary" onclick="close_scope_modal()">Close</button>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#myTasksTable').DataTable({
        "scrollY": 400,
        "scrollX": true
    });
});

// Custom function to show popup without Bootstrap JS
function view_scope(enquiry_id) {
    var scopeText = document.getElementById('scope_val_' + enquiry_id).value;
    document.getElementById('custom_modal_text').value = scopeText;
    document.getElementById('customScopeModal').style.display = 'block';
}

function close_scope_modal() {
    document.getElementById('customScopeModal').style.display = 'none';
}
</script>