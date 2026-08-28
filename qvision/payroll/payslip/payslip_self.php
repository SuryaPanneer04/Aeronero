<?php

require '../../../connect.php';
require '../../../user.php';


$username = $_SESSION['username'];
$userid = $_SESSION['userid'];

 $emp_query = $con->query("SELECT id FROM staff_master WHERE id='$userid' OR candid_id='$userid' OR emp_code='$username' OR CONCAT(prefix_code, emp_code)='$username' OR emp_name='$username' LIMIT 1");
 $emp_data = $emp_query->fetch(PDO::FETCH_ASSOC);
 $logged_emp_id = $emp_data ? $emp_data['id'] : $userid;
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<body>
    <div class="card card-primary">
        <div class="card-header">
            <div class="col-lg-12">
                <h4>PAYSLIP VIEW & DOWNLOAD</h4>
            </div>
            <div class="panel-body">
                <form method="GET" name="payslip_inputs" role="form">
                    <div class="row">

                        <div class="col-lg-2">
                            <div class="form-group">
                                <select class="form-control" name="payroll_id">
                                    <option value="0">--Select Month--</option>
                                    <?php
								
                                    $staff_payroll_sql = $con->query("select id,month,year,flag from payroll_master where flag in (2,3)");
                                    while ($staff_payroll_res = $staff_payroll_sql->fetch(PDO::FETCH_ASSOC)) 
                                    {
                                        $m = $staff_payroll_res['month'];
                                        $y = $staff_payroll_res['year'];

                                        switch ($m) {
                                            case "1":
                                                $pay_period = "1st Jan" . ' ' . $y . " – 31th Jan" . ' ' . $y;
                                                break;

                                            case "2":
                                                $pay_period = "1st Feb" . ' ' . $y . " – 28th Feb" . ' ' . $y;
                                                break;

                                            case "3":
                                                $pay_period = "1st Mar" . ' ' . $y . " – 31th Mar" . ' ' . $y;
                                                break;

                                            case "4":
                                                $pay_period = "1st Apr" . ' ' . $y . " – 30th Apr" . ' ' . $y;
                                                break;

                                            case "5":
                                                $pay_period = "1st May" . ' ' . $y . " – 31th May" . ' ' . $y;
                                                break;

                                            case "6":
                                                $pay_period = "1st Jun" . ' ' . $y . "- 30th Jun" . ' ' . $y;
                                                break;

                                            case "7":
                                                $pay_period = "1st Jul" . ' ' . $y . " – 31th Jul" . ' ' . $y;
                                                break;

                                            case "8":
                                                $pay_period = "1st Aug" . ' ' . $y . " – 31th Aug" . ' ' . $y;
                                                break;

                                            case "9":
                                                $pay_period = "1st Sep" . ' ' . $y . " – 30th Sep" . ' ' . $y;
                                                break;

                                            case "10":
                                                $pay_period = "1st Oct" . ' ' . $y . " – 31st Oct" . ' ' . $y;
                                                break;

                                            case "11":
                                                $pay_period = "1st Nov" . ' ' . $y . " – 30th Nov" . ' ' . $y;
                                                break;

                                            case "12":
                                                $pay_period = "1st Dec" . ' ' . $y . " – 31th Dec" . ' ' . $y;
                                                break;
                                            default:
                                                $pay_period = $staff_payroll_res['month'] . '-' . $staff_payroll_res['year'];
                                        }
                                    ?>
                                        <option value="<?php echo $staff_payroll_res['id']; ?>"><?php echo $pay_period; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                       

                        <div class="col-lg-2">
                            <div class="form-group" id="staff_list">

                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="button" class="btn btn-default" value="Search" onclick="payslip_view()">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="salary_view">
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <script>
        function change_dept() {
            let id = $('#department').val();
            $.ajax({
                type: "POST",
                url: "qvision/payroll/payslip/payslip_staff_department.php?id=" + id,
                success: function(outputs) {
                    $("#staff_list").html(outputs);
                }
            });
        }

       function payslip_view() {
            var data = $('form').serialize();
            var empId = "<?php echo $logged_emp_id; ?>";
            
            if(empId == 0) {
                alert("Employee ID not found for this user account!");
                return;
            }

            $.ajax({
                type: "GET",
                url: "qvision/payroll/payslip/payslip_view_self.php",
             
                data: data + "&emp_id=" + empId + "&id=" + empId, 
                success: function(response) {
                    $("#salary_view").html(response);
                },
                error: function() {
                    alert("Failed to load payslip. Please check network or file path.");
                }
            });
        }
    </script>
</body>
</html>