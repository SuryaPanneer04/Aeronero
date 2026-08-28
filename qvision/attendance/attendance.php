<?php
require '../../connect.php';
date_default_timezone_set("Asia/Kolkata");
$curdate = date("d-m-y");
?>

<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-body">
            <input class="btn btn-primary" type="button" value="Attendance Upload" onclick="attendance_upload()"> 
            <input class="btn btn-success" type="button" value="Attendance File Name" onclick="files_name()">
            <!-- <input class="btn btn-danger" type="button" value="Attendance Report" onclick="attendance_report()">
            <input class="btn btn-danger" type="button" value="In-Out Report" onclick="in_out_report()" -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card">
        <div class="card-body">
            <div id="attendance_view">
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>



<script>

    function attendance_upload()
    {
        $.ajax({
            type: 'GET',
            url: 'qvision/attendance/attendance_data_upload.php',
            data: "id=" + 1,
            success: function (data)
            {
                $("#attendance_view").html(data);
            }
        })
    }

    function files_name(){
        $.ajax({
            type: 'GET',
            url: 'qvision/attendance/attendance_file_name.php',
            success: function(data)
            {
              $("#attendance_view").html(data);
            }
        })
    }

    function attendance_daily_report()
    {
        $.ajax({
            type: 'GET',
            url: 'qvision/attendance/attendance_daily_report.php',
            data: "id=" + 1,
            success: function (data)
            {
                $("#attendance_view").html(data);
            }
        })
    }

    function attendance_report()
    {
        $.ajax({
            type: 'GET',
            url: 'qvision/attendance/attendance_attendance_report.php',
            data: "id=" + 1,
            success: function (data)
            {
                $("#attendance_view").html(data);
            }
        })
    }

    function in_out_report()
    {
        $.ajax({
            type: 'GET',
            url: 'qvision/attendance/attendance_In_out_report_page.php',
            data: "id=" + 1,
            success: function (data)
            {
                $("#attendance_view").html(data);
            }
        })
    }



</script>


