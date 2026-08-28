<?php
require '../../../connect.php';
$id = $_REQUEST['id'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

                        <div class="card card-primary ">
                        <div id="salary_view"  style="font-family:'Times New Roman', Times, serif;width: 500px; height: 400px; position: absolute; left: 305px; top: 118px;"> </div>
                            <div class="card-header">
                                <h3 class="card-title"> <font size="5"> Engineer Allocation for Installation </font> </h3>
                                <a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>&nbsp;BACK</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group row">

                                <?php
                                    $sql = $con->query("Select a.* from initiate_installation a WHERE a.id='$id' ");
                                    $sqls = $sql->fetch();
                                ?>

                               </div>
                               <form class="form-horizontal" method="POST" name="fupForm" enctype="multipart/form-data">
                                <table class="table" style="border: none;">
                                    <tbody>
                                        <tr>
                                            <th style="width: 7%;">SO Number:</th>
                                            <td>
                                                <input type="hidden" name="ticket_id" class="form-control" value="<?php echo $sqls['id']; ?>">
                                                <input class="form-control" value="<?php echo $sqls['so_number']; ?>" name="so_no" readonly>
                                            </td>
                                            <td></td>
                                            <th style="width: 7%;">Invoice &nbsp;No&nbsp;:</th>
                                            <td><input class="form-control" value="<?php echo $sqls['invoice_no']; ?>" name="cost_sheet_no" readonly></td>
                                        </tr>
                                      
                                        <tr>
                                        <th style="width: 15%;">Remark :</th>
                                        <td colspan="4" > 
                                         <textarea class="form-control" name="remark" style="height: 120px;" readonly> <?php echo $sqls['remarks']; ?> </textarea> 
                                       </td>
                                        </tr>

                                        <tr>
                                            <th style="width: 7%;">Department&nbsp;:</th>
                                            <td>
                                                <select name="department" class="form-control" onchange="select_dep(this.value)">
                                                    <option value=""> -- Select department -- </option>
                                                    <?php
                                                    $emp = $con->query("SELECT * FROM z_department_master");
                                                    while ($emp_det = $emp->fetch()) {
                                                    ?>
                                                        <option value="<?php echo $emp_det['id']; ?>"><?php echo $emp_det['dept_name']; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <th style="width: 7%;">Employee&nbsp;:</th>
                                            <td>
                                                <select name="employee" id="employee" class="form-control"></select>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                                <div class="float-right">
                                    <input type="submit" class="btn btn-info" value="Assign">
                                </div>
                            </form>
                            </div>
                        </div>                    
                
<script>
    $(document).ready(function(){
        $('#salary_view').hide();
    })

    $("form[name='fupForm']").on("submit", function(ev) {
        ev.preventDefault();
        var formData = new FormData(this);

        $('#salary_view').show();
        $("#salary_view").html('<br><div style="text-align: center;"><img src="/ssinfo1/qvision/images/images/load3.gif"></div>');

        $.ajax({
            url: "qvision/Purchase_process/installation/ticket_assign_insert.php",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                
                alert('Assigned Successfully');
                $('#salary_view').hide();
                installation()
            }
        });
    });

    function select_dep(department) {

        $.ajax({
            url: "qvision/Purchase_process/installation/find_emp.php?department="+department,
            type: "GET",
            success: function(data) {
                $("#employee").html(data);
            }
        });
    }

    function back() {
        installation()
    }
</script>