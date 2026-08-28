<?php
require '../../../connect.php';
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
    <div class="card-header" style="background-color:#ff8b3d !important;color:white !important;">
        <h3 class="card-title">
            <font size="5">Salary Advance</font>
        </h3>
        <a onclick="return back()" style="float: right;color:white !important;" data-toggle="modal" class="btn btn-primary"><i class="fa fa-minus"></i>Back</a>

    </div>

    <div class="active tab-pane" id="for_employment">
        <form method="POST" name="fupForm" id="fupForm" action="">
            <table class="table table-bordered">
                <tr>
                    <td><label for="fname">Employee Name:</label></td>
                    <td><select name="emp_code" id="emp_code" class="form-control">
                            <option value="">Select Employee</option>
                            <?php
                            $emp_sql = $con->query("SELECT * FROM staff_master ");
                            $i = 1;
                            while ($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $emp_res['id']; ?>"> <?php echo $emp_res['emp_name']; ?> </option>
                            <?php
                            }
                            ?>
                        </select></td>
                </tr>

                <tr>
                    <td><label for="fname">Amount:</label></td>
                    <td><input type="text" id="amount" name="amount" class="form-control"></td>
                </tr>

                <!-- <tr id="cor2">
                    <td><label for="fname">EMI Status:</label></td>
                    <td><select name="emi_status" id="emi_status" class="form-control">
                            <option value="">Select EMI Status</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select></td>
                </tr> -->

                <tr id="ind1">
                    <td><label for="fname">EMI Period:</label></td>
                    <td>
                        <!-- <select name="emi_period" id="emi_period" class="form-control" onchange="emi_amount()">
                            <option value="">Select EMI Period</option>
                            <option value="1">1 Months</option>
                            <option value="2">2 Months</option>
                            <option value="3">3 Months</option>
                            <option value="4">4 Months</option>
                            <option value="5">5 Months</option>
                            <option value="6">6 Months</option>
                        </select> -->

                        <?php $month = range(1, 24); ?>

                         <select class="form-control" name="emi_period" id="emi_period" onchange="emi_amount()">
                         <option>-- Select EMI Period --</option>
                         <?php foreach($month as $mnth) : ?>
                         <option value="<?php echo $mnth; ?>"><?php echo $mnth; ?> Months</option>

                         <?php endforeach; ?>

                    </td>
                </tr>

                <tr>
                    <td><label for="fname">Start Date:</label></td>
                    <td><input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"></td>
                </tr>

                <tr id="end_date" name="end_date">   </tr>


                <tr>
                    <td><label for="fname">EMI Amount:</label></td>
                    <td>
                        <input type="text" id="no_emi" name="no_emi" class="form-control" readonly>
                    </td>
                </tr>

            </table>
            <div class="modal-footer">
                <input type="button" name="save" onclick="insert_role()" class="btn btn-primary" value="Save">
            </div>
        </form>
    </div>

    <script>
        function back() {
            Salary_advance()
        }

        function insert_role() {
            var data = $('form').serialize();
            $.ajax({
                type: 'GET',
                data: data,
                url: "qvision/payroll/salary_advance/add_insert.php",
                success: function(data) {
                    if (data == 1) {
                        alert('Entry Successfully');
                        Salary_advance()
                    } else {
                        alert("Entry Failed.");
                        Salary_advance()
                    }

                }
            });
        }

        $(document).ready(function() {
            $('#emi_period').on('change', function() {

                var emi_periods = this.value;
                //alert(emi_periods);
                $.ajax({
                    type: "POST",
                    url: "qvision/payroll/salary_advance/submit.php?id=" + emi_periods,
                    success: function(data) {
                        $("#end_date").html(data);
                    }
                })
            });
        });

        function emi_amount() {
            let amount = $('#amount').val()
            let month = $('#emi_period').val()

            monthly_emi = Math.round(amount / month)
            document.querySelector('#no_emi').value = monthly_emi
        }
    </script>