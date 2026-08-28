<?php
require '../../../connect.php';
$taskid = $_REQUEST['id'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>   
                   
                        <div class="card card-primary ">
                        <div id="salary_view"  style="font-family:'Times New Roman', Times, serif;width: 500px; height: 400px; position: absolute; left: 305px; top: 118px;"> </div>
                            <div class="card-header">
                                <h3 class="card-title"><b> Installation Details</b></h3>
                                <a onclick="install_material()" style="float: right;color: #fff" data-toggle="modal" class="btn btn-danger">BACK</a>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                        
                                    <?php
                                    $sql = $con->query("Select a.*,e.full_name  from initiate_installation a LEFT JOIN z_user_master e ON (a.employee = e.candidate_id) where a.id= '$taskid'");     
                                    $sqls = $sql->fetch();                                    
                                    ?>

                            <form class="form-horizontal" method="POST" name="fupForm" enctype="multipart/form-data">
                                <table class="table table-bordered">
                                    <tbody>
                                    <input type="hidden" name="taskid" value="<?php echo $taskid; ?>">
                                    <input type="hidden" name="csId" value="<?php echo $sqls['cost_id']; ?>">
                                    <tr>
                                            <th>SO Number </th>
                                            <td>
                                                <input class="form-control" value="<?php echo $sqls['so_number']; ?>" name="so_no" readonly>
                                            </td>
                                    </tr>
                                    <tr>
                                            <th >Invoice No </th>
                                            <td><input class="form-control" value="<?php echo $sqls['invoice_no']; ?>" name="cost_sheet_no" readonly></td>
                                    </tr>

                                    <tr>
                                        <th style="width: 15%;">Remark :</th>
                                        <td colspan="4" > 
                                         <textarea class="form-control" name="remark" style="height: 120px;" readonly> <?php echo $sqls['remarks']; ?> </textarea> 
                                        </td>
                                    </tr>

                                    <tr>
                                            <th> Assigned Date </th>
                                            <td>
                                                <input class="form-control" type="text" value="<?php echo date('d-m-Y', strtotime($sqls['created_on']));?>" readonly>
                                            </td>
                                    </tr>
 <?php if($sqls['status'] ==2 ){ ?>
                                    <tr>
                                            <th> sign off Report Upload </th>
                                            <td>
                                            <a href="qvision/Purchase_process/installation/installation_report/<?php echo  $sqls["report_upload_file"];?>" download="<?php echo  $sqls["report_upload_file"]; ?>"><?php echo  $sqls["report_upload_file"]; ?></a>
                                            </td>
                                    </tr>
<?php }  if($sqls['status'] !=2 ){ ?>
                                    <tr>
                                            <th> sign off Report Upload </th>
                                            <td>
                                                <input class="form-control" type="file" name="report_upload">
                                            </td>
                                    </tr>

                                    </tbody>
                                </table>
                     
                                <div class="float-right">
                                    <input type="submit" class="btn btn-info" value="Completed">
                                </div>
  <?php } ?>
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
                url: "qvision/Purchase_process/installation/update_ticket_status.php",
                method: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                        $('#salary_view').hide();
                        alert('Updated Successfully');
                        install_material()
                }
            });
        });


        function back() {
            ticket_assigned()
        }

</script>