<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_SESSION['candidateid'];
?>

<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">

<style>
.card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
}
</style>
</head>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title" style="float: left;">
            <font size="5">Warranty Support </font>
        </h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover display nowrap" id="example1" style="width:100%">
            <thead>
                <th> S.No</th>
                <th>Invoice No</th>
                <th>Action</th>
            </thead>
            <?php
                if($candidateid==101){
            ?>
            <tbody>
                <?php      
                    $roll_query =$con->prepare("Select a.*,b.*,a.id as wid from warranty_support a left join purchase_vendor_master b on a.pvm_id = b.id order by  a.id desc");
                    $roll_query->execute(); 
                    $i = 1;
                    while($row = $roll_query->fetch()){
                ?>
                <tr>
                    <td> <?php echo $i++ ;?> </td>
                    <td><?php echo $row['invoice_no'];?></td>
                    <td>
                         <button class="btn btn-info" onclick="warrentySupport(<?php echo $row['wid'];?>)"> <i class="fa fa-eye"> </i> </button>                     
                    </td>
                </tr>
                <?php 
                    } 
                ?>
            </tbody>
            <?php
                }
            ?>
        </table>
    </div>
</div>

<script>

function warrentySupport(v) {
    $.ajax({
        type: "POST",
        url: "qvision/Purchase_process/installation/warrantyView.php?id=" + v,
        success: function(data) {
            $("#main_content").html(data);
        }
    })
}

$(document).ready(function() {
    $('#example1').DataTable({
        "scrollY": 400,
        "scrollX": true
    });
});
</script>
<script>
$(function() {
    $("#dataTable").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('#dataTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});




function quote_proposal_view(v) {
    //alert(v);
    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/quotation/quotation_send_view.php?id=" + v,
        success: function(data) {
            $("#main_content").html(data);
        }
    })
}

function back_ctc() {
    Quotation_view()
}
</script>