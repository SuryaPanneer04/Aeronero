<?php
require '../../../connect.php';
$id = $_REQUEST['id'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>           
                        <div class="card card-primary ">
                            <div class="card-header">
                                <h3 class="card-title"><b> Engineer Allocation View</b></h3>
                                <a onclick="back()" style="float: right;color: #fff"
                                    data-toggle="modal" class="btn btn-danger">BACK</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group row">

                                    <?php

                                    $sql = $con->query("Select a.*,e.full_name,f.dept_name from po_ticket a LEFT JOIN z_user_master e ON (a.employee=e.candidate_id) LEFT JOIN z_department_master f ON (a.department=f.id)WHERE a.id='$id' ");
                                                       
                                    $sqls = $sql->fetch();
                                    ?>
                                </div>   
                                <form class="form-horizontal" method="POST" name="fupForm" enctype="multipart/form-data">                     
                                    <table class="table table-borderless" style="border:none;">
                                        <tbody>
                  
                                    <tr>
                                        <input type="hidden" name="ticket_id" value="<?php echo $sqls['id']; ?>">
                                            <th style="width: 7%;">SO Number:</th>
                                            <td>
                                                <input class="form-control" value="<?php echo $sqls['so_number']; ?>" name="so_no" readonly>
                                            </td>
                                            <td></td>
                                            <th style="width: 7%;">Cost&nbsp;Sheet&nbsp;No&nbsp;:</th>
                                            <td><input class="form-control" value="<?php echo $sqls['cost_sheet_no']; ?>" name="cost_sheet_no" readonly></td>
                                    </tr>
                                      
                                    <tr>
                                        <th style="width: 15%;">Remark :</th>
                                        <td colspan="4" > 
                                         <textarea class="form-control" name="remark" style="height: 120px;" readonly> <?php echo $sqls['po_invoice']; ?> </textarea> 
                                       </td>
                                        </tr>

                                    <tr>
                                                <th style="width: 7%;">Department&nbsp;:</th>
                                                <td><input class="form-control" value="<?php echo $sqls['dept_name']; ?>" readonly></td>
                                                <td></td>
                                                <th style="width: 7%;">Employee&nbsp;:</th>
                                                <td><input value="<?php echo $sqls['full_name']; ?>" class="form-control" readonly></td>
                                    </tr>

                                    <tr>
                                        <th style="width: 7%;">Task&nbsp;Status:</th>
                                        <td>
                                        <?php
                    if($sqls['status']==0){
                        echo '<span style="color: red;text-align:center;"><b> Pending </b></span> '; //Data Inserted.
                    }
                    else if($sqls['status']==1){
                        echo '<span style="color: blue;text-align:center;"><b> In Process </b></span>'; //Work Assign to Employee.
                    }
                    else if($sqls['status']==2){
                        echo '<span style="color: green;text-align:center;"><b> Customization Completed </b></span>'; //Work completed.
                    }
                    ?>
                                            
                                            </td> 
                                        <td></td>
                                    </tr>
                                  </tbody>
                                        
                                    </table>
                                    </form>
                            </div>
                   
                    </div>

<script>
    function back() {
        po_product_customization()
    }
</script>