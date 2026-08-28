<?php
require '../../connect.php';
date_default_timezone_set("Asia/Kolkata");
$curdate=date("d-m-y");

$year = date("y");
$month = date("m");
$day = '30';

$current_date = new DateTime(date('Y-m-d'), new DateTimeZone('Asia/Kolkata'));
$end_date = new DateTime("$year-$month-$day", new DateTimeZone('Asia/Kolkata'));
$interval = $current_date->diff($end_date);
?>
<style>
table th {
    padding:8px;
}
.att-status > p{
    font-weight: bold;
    font-size: 14px;
}
</style>

<div class="col-12">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Attendance Upload</h3>
        </div>
        <div class="card-body">
            <a href="qvision/attendance/qvision_attendance.csv">Download Template</a>
            
            <!-- Form Tag Corrected -->
            <form id="uploadcsvform" name="uploadfile" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="exampleInputFile">File Upload</label>
                            <input type="file" name="file" id="file" size="150">
                            <p class="help-block">Only CSV File Import.</p>     
                        </div>
                        <!-- Button Type restored to 'submit' -->
                        <button type="submit" class="btn btn-default" id="Upload" name="Upload" value="Upload">Upload</button>
                    </div>
                
                    <div class="col-sm att-status">
                       <p>0 = Absent  = LOP </p> 
                       <p>1 = Present = Full Salary</p> 
                    </div>
                    <div class="col-sm att-status">
                       <p>2 = Casual Leave Present = Full Salary</p> 
                       <p>3 = Sick Leave Present   = Full Salary</p>        
                    </div>
                    <div class="col-sm att-status">
                       <p>4 = Earned Leave Present = Full Salary</p>
                       <p>5 = Half a day Absent    = ½ day LOP</p>
                       <p>6 = Half a day Present   = ½ Present Half Salary</p>      
                    </div>
                </div>
            </form>
        </div>
        
        <form role="form" id="attendanceListForm" name="area" method="post">
            <table class="table table-striped table-bordered" style="font-family:'Times New Roman', Times, serif">
                <tr> 
                    <th colspan='11'> 
                        <input type="button" class="btn btn-primary" value="Delete Attendance" name="submit" onclick="attendance_delete()"> 
                    </th>
                </tr>
                <tr>
                    <th><input type="checkbox" checked id="classaall"></th>
                    <th>Employee Code</th>
                    <th>Emp_Name</th>
                    <th>In_Log_Date</th>
                    <th>Log_Day</th>
                    <th>Punch_In_Time</th>    
                    <th>Punch_Out_Time</th>        
                    <th>Work Hours</th>    
                    <th>Status</th>        
                    <th>Total_Days</th>        
                    <th>Working_Days</th>        
                </tr>
                <?php
                $attendance_sql=$con->query("SELECT a.id as att_id,a.emp_code,a.emp_name,a.in_log_date,a.log_day,a.out_log_date,a.punch_in_time,a.punch_out_time,a.work_hours,a.status,a.total_days,a.working_days,b.id as sid,b.prefix_code,b.emp_code as ecode FROM bb_attendance a left join staff_master b on(a.emp_code=b.id) order by a.id ASC");

                $i=1;
                $total=0;
                while($attendance_data = $attendance_sql->fetch(PDO::FETCH_ASSOC))
                { 
                    ?>                    
                    <tr>
                        <td>
                            <input type="checkbox" name="attendance_id[]" class="classacheck" checked value="<?php echo $attendance_data['att_id'] ; ?>" >
                        </td>
                        <td><?php echo $attendance_data['ecode'] ; ?></td>
                        <td><?php echo $attendance_data['emp_name'] ; ?></td>
                        <td><?php echo $attendance_data['in_log_date'] ; ?></td>
                        <td><?php echo $attendance_data['log_day'] ; ?></td>
                        <td><?php echo $attendance_data['punch_in_time'] ; ?></td>
                        <td><?php echo $attendance_data['punch_out_time'] ; ?></td>
                        <td><?php echo $attendance_data['work_hours'] ; ?></td>
                        <td><?php echo $attendance_data['status'] ; ?></td>
                        <td><?php echo $attendance_data['total_days'] ; ?></td>
                        <td><?php echo $attendance_data['working_days'] ; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </form>
    </div>
</div>

<script>
// Delegated event to ensure it always fires even if the page is loaded via AJAX
$(document).off('submit', '#uploadcsvform').on('submit', '#uploadcsvform', function(e) {
    e.preventDefault(); // Prevents the blank page redirect
    
    if(confirm('Are you sure you want to submit this form?')) {
        let formData = new FormData(this);
        formData.append('Upload', 'Upload'); 

        $.ajax({
            url: 'qvision/attendance/attendance_data_insert.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                let res = response.trim();
                
                if(res.includes("SUCCESS")) {
                    let parts = res.split("|"); 
                    let att_month = parts[1];
                    let att_year = parts[2];

                    alert("Attendance Data Inserted! Generating Payroll please wait...");

                    // Automatic Payroll Generation
                    $.ajax({
                        type: "GET",
                        url: "qvision/payroll/payroll_process/payroll_insert.php", 
                        data: "month=" + att_month + "&year=" + att_year, 
                        success: function(pay_data) {
                            
                        }                       
                    });

                } else if(res.includes("Already Existed")) {
                    alert("Data Already Existed for these dates.");
                    attendance_upload(); 
                } else {
                    alert(res); 
                }
            },
            error: function() {
                alert('Upload Failed. Please try again.');
            }
        });
    }
});

$(document).ready(function () {
    $("#classaall").click(function () {
        $(".classacheck").prop('checked', $(this).prop('checked'));
    });
});

function attendance_delete() {
    let data = $('#attendanceListForm').serialize();
    $.ajax({
        type: 'POST',
        data: data,
        url: 'qvision/attendance/attendance_data_delete.php',
        success: function (data) {
            if(data == 1){
                alert('Successfully Deleted');
                attendance_upload();
            } else {
                alert('Failed');
                attendance_upload();
            }
        }
    });
}
</script>