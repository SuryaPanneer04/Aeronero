<?php
require '../../../connect.php';
$id = $_REQUEST['id'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>           
                        <div class="card card-primary ">
                            <div class="card-header">
                                <h3 class="card-title"><b> Warranty View</b></h3>
                                <a onclick="warrenty()" style="float: right;color: #fff"
                                    data-toggle="modal" class="btn btn-danger">BACK</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-group row">

                                    <?php

                                    $sql = $con->query("Select a.*,b.*,a.id as wid from warranty_support a left join purchase_vendor_master b on a.pvm_id = b.id WHERE a.id='$id' ");
                                                       
                                    $sqls = $sql->fetch();
                                    ?>
                                </div>   
                                <form class="form-horizontal" method="POST" name="fupForm" enctype="multipart/form-data">                     
                                    <table class="table table-borderless" style="border:none;">
                                        <tbody>
                  
                                    <tr>
                                        <input type="hidden" name="war_id" value="<?php echo $sqls['wid']; ?>">
                                            <th style="width: 7%;">SO Number:</th>
                                            <td>
                                                <input class="form-control" value="<?php echo $sqls['so_number']; ?>" name="so_no" readonly>
                                            </td>
                                            <td></td>
                                            <th style="width: 7%;">Invoice&nbsp;No&nbsp;:</th>
                                            <td><input class="form-control" value="<?php echo $sqls['invoice_no']; ?>" name="cost_sheet_no" readonly></td>
                                    </tr>

                                    <tr>
                                            <th style="width: 7%;">Product:</th>
                                            <td>
                                                <input class="form-control" value="<?php echo $sqls['specification']; ?>" name="pro" readonly>
                                            </td>
                                            <td></td>
                                            <th style="width: 7%;">Qty :</th>
                                            <td><input class="form-control" value="<?php echo $sqls['unit_qty']; ?>" name="qty" readonly></td>
                                    </tr>

                                    <tr>
                                            <th style="width: 7%;">Costsheet No :</th>
                                            <td>
                                                <input class="form-control" value="<?php echo $sqls['cost_sheet_no']; ?>" name="pro" readonly>
                                            </td>
                                            <!-- <td></td>
                                            <th style="width: 7%;">Qty :</th>
                                            <td><input class="form-control" value="<?php echo $sqls['unit_qty']; ?>" name="qty" readonly></td> -->
                                    </tr>

                                  </tbody>
                                        
                                    </table>
                                    </form>
                            </div>
                   
                    </div>

<script>
    function back() {
        installation()
    }
</script>