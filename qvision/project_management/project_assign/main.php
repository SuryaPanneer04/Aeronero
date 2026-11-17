<?php
require '../../../connect.php';
session_start();
?>

<div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Project Assign</font></h3>
			<button type="button" onclick="add_project_assign()" style="float: right;" class="btn btn-dark"><i class="fa fa-plus"></i>  Assign Employee</button></div><div class="card-body">
              
                            <!-- Legend for Deadline Highlight -->
              <div class="alert alert-light border shadow-sm mb-3" role="alert" style="border-left: 5px solid #009EE3; background-color: #fcfcfc;">
                  <h6 class="mb-2 font-weight-bold text-secondary" style="font-size: 14px;"><i class="fa fa-info-circle text-info"></i> How to read the deadline colors:</h6>
                  <div class="d-flex flex-wrap align-items-center" style="font-size: 13px;">
                      <div class="mr-4 mb-1">
                          <span class="badge badge-success p-2 mr-1" style="min-width: 70px;">Safe</span> <span class="text-muted">More than 2 days left</span>
                      </div>
                      <div class="mr-4 mb-1">
                          <span class="badge badge-warning p-2 mr-1" style="min-width: 70px;">Nearing</span> <span class="text-muted">2 days or less left</span>
                      </div>
                      <div class="mr-4 mb-1">
                          <span class="badge badge-danger p-2 mr-1" style="min-width: 70px;">Overdue</span> <span class="text-muted">Deadline has passed</span>
                      </div>
                      <div class="mr-4 mb-1">
                          <span class="badge badge-primary p-2 mr-1" style="min-width: 70px;">Completed</span> <span class="text-muted">Project is finished</span>
                      </div>
                  </div>
              </div>

			  <div class="table-responsive">
       <table class="dataTables-example table table-striped table-bordered table-hover" id="example2" style="width:100%;">
    
      <thead>
	   <th>ID</th>
<th>Project Name</th>
<th>Employee Code</th>
<th>Employee Name</th>
<th>Deadline (Date)</th>
<th>Documents</th>
<th>Action</th>
      </thead>
      <tbody>
      <?php
$emp_sql=$con->query("SELECT pe.id, pd.project_name, sm.emp_code, sm.emp_name, pe.deadline_date, pe.acceptance_status FROM y_project_employees pe JOIN y_project_details pd ON pe.project_id = pd.project_id JOIN staff_master sm ON pe.employee_id = sm.candid_id ORDER BY pe.id DESC"); if(!$emp_sql) { echo "<tr><td colspan=\"7\" style=\"color:red\">Database Error: " . print_r($con->errorInfo(), true) . "</td></tr>"; } else { $i=1; while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
          $pe_id = $emp_res['id'];
          $docs_html = '';
          $docs = $con->query("SELECT * FROM y_project_documents WHERE project_employee_id = $pe_id");
          if($docs !== false && $docs->rowCount() > 0) {
              while($d = $docs->fetch()) {
                  $docs_html .= "<a href='".$d['document_path']."' target='_blank' style='display:block; font-size:12px;'>".$d['document_name']."</a>";
              }
          } else {
              $docs_html = "-";
          }
          
          $deadline = $emp_res['deadline_date'];
          $deadline_str = ($deadline && $deadline != '0000-00-00') ? date('d-m-Y', strtotime($deadline)) : '-';
          
          $dl_badge = '';
          $dl_title = '';
          if($deadline && $deadline != '0000-00-00' && $emp_res['acceptance_status'] != 'Completed') {
              $today = new DateTime();
              $today->setTime(0,0,0);
              try {
                  $dl = new DateTime($deadline);
                  $diff = $today->diff($dl);
                  $days = $diff->invert ? -$diff->days : $diff->days;
              } catch (Exception $e) {
                  $days = 0;
              }
              
              if($days < 0) {
                  $dl_badge = 'badge badge-danger p-2';
                  $dl_title = 'Overdue by ' . abs($days) . ' day(s)';
              } else if($days <= 2) {
                  $dl_badge = 'badge badge-warning p-2';
                  $dl_title = 'Nearing Deadline: ' . $days . ' day(s) left';
              } else {
                  $dl_badge = 'badge badge-success p-2';
                  $dl_title = 'Safe: ' . $days . ' day(s) left';
              }
          } else if ($emp_res['acceptance_status'] == 'Completed') {
              $dl_badge = 'badge badge-primary p-2';
              $dl_title = 'Completed Project';
          }
       ?>
      <tr>
      <td><?php echo $i; ?></td>
	  <td><?php echo $emp_res['project_name']; ?></td>
      <td><?php echo $emp_res['emp_code']; ?></td>
      <td><?php echo $emp_res['emp_name']; ?></td>
      <td><span class="<?php echo $dl_badge; ?>" title="<?php echo $dl_title; ?>"><?php echo $deadline_str; ?></span></td>
      <td><?php echo $docs_html; ?></td>
      <td>
          <button class="btn btn-info btn-sm" onclick="edit_project_assign(<?php echo $pe_id; ?>)"><i class="fa fa-edit"></i> Edit</button>
          <?php if($emp_res['acceptance_status'] != 'Completed'): ?>
              <button class="btn btn-success btn-sm ml-1" onclick="mark_project_completed(<?php echo $pe_id; ?>)"><i class="fa fa-check"></i> Complete</button>
          <?php endif; ?>
      </td>
      </tr>
      <?php
	  $i++;
      }
      }
      ?>
      </tbody>
       </table>
       </div>
				
              </div>
            </div>
<script>
	$(document).ready(function() {
		$('#example2').DataTable({
				scrollX: true
		});
	});
</script>
<script>
		function add_project_assign() {
	console.log('Assign button clicked');
    $.ajax({
    type:"POST",
    url:"qvision/project_management/project_assign/new.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }

  function edit_project_assign(id) {
	console.log('Edit button clicked for ID:', id);
    $.ajax({
    type:"POST",
    url:"qvision/project_management/project_assign/edit.php",
    data: { id: id },
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }

  function mark_project_completed(id) {
    if(confirm('Are you sure you want to mark this project as Completed?')) {
        $.ajax({
            type: 'POST',
            url: 'qvision/project_management/project_assign/mark_completed.php',
            data: { id: id },
            success: function(response) {
                if(response.trim() == 'Success') {
                    alert('Project marked as completed successfully!');
                    project_assign();
                } else {
                    alert('Error: ' + response);
                }
            }
        });
    }
  }


</script>













