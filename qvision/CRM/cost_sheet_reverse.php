<?php
require '../../connect.php';
require '../../user.php';
$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
?>
<style>
    #page-wrapper{
        margin-left: 117px !important;
    }
    .btn-warning{
        padding-top: 0px !important;
    }

    .btn-warning{
        background-color: #337ab7 !important;
        border-color: #337ab7 !important;
    }
    .btn-success{
        background-color: #5cb85c !important;
        border-color: #5cb85c !important;
    }
    .page-header{
        border-bottom: 3px solid #eee !important;
    }
</style>
<div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Sheet Revise List</font></h3>


    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <table id="dataTable" class="table table-bordered table-striped">
            <thead>
            <th>#</th>
            <th>Call Type</th>
            <th>Date</th>
            <th>Client</th>
            <th>Location</th>
            <th>Contact Number</th>


            <th>Foll UP Date </th>


            <th>Employee</th>
            <th width="20%">Status</th>
            <th width="20%">Action</th>
            </thead>
            <tbody>
                <?php
                $candidateid = $_SESSION['candidateid'];
                $userrole = $_SESSION['userrole'];

                if ($userrole == 'ROLE-007') {
                    $datas = $con->query("SELECT A.client_name as name,e.feedback_date as date,a.client_org as company_name,a.address as location,a.contact as mobile,e.date as follup,d.first_name as first_name,a.status as enquiry_status,a.id as enquiry_id FROM `Crm_calls` A INNER JOIN Calls_master B ON A.Call_type=B.Id INNER Join Z_department_master C ON A.Department=C.Id INNER JOIN Candidate_form_details D ON A.Employee=D.Id INNER JOIN crm_calls_feedback e on a.id=e.calls_id  where a.created_by='$candidateid' and a.status='6'");
                } else {
                    $datas = $con->query("SELECT A.client_name as name,e.feedback_date as date,a.client_org as company_name,a.address as location,a.contact as mobile,e.date as follup,d.first_name as first_name,a.status as enquiry_status,a.id as enquiry_id FROM `Crm_calls` A INNER JOIN Calls_master B ON A.Call_type=B.Id INNER Join Z_department_master C ON A.Department=C.Id INNER JOIN Candidate_form_details D ON A.Employee=D.Id INNER JOIN crm_calls_feedback e on a.id=e.calls_id where a.status='6'");
	
                }


                $cnt = 1;
                while ($enquiry = $datas->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $cnt; ?>.</td>
                        <td><?php echo $enquiry['name']; ?></td>
                        <td><?php echo $enquiry['date']; ?></td>
                        <td><?php echo $enquiry['company_name']; ?></td>
                        <td><?php echo $enquiry['location']; ?></td>
                        <td><?php echo $enquiry['mobile']; ?></td>


                        <td><?php echo $enquiry['follup']; ?></td>



                        <td><?php echo $enquiry['first_name']; ?></td>
                        <td><?php
                            if ($enquiry['enquiry_status'] == 1) {

                                echo '<span style="color:green;text-align:center;"><b>Enquiry Added</b></span>';
                            }
                            if ($enquiry['enquiry_status'] == 2) {

                                echo '<span style="color:Blue;text-align:center;"><b>Generated Lead</b></span>';
                            }
                            if ($enquiry['enquiry_status'] == 3) {

                                echo '<span style="color:brown;text-align:center;"><b>Generated Cost Sheet</b></span>';
                            }
                            if ($enquiry['enquiry_status'] == 4) {
                                echo '<span style="color:green;text-align:center;"><b>Generated For Cost Sheet Approval</b></span>';
                            }
                            if ($enquiry['enquiry_status'] == 5) {
                                echo '<span style="color:blue;text-align:center;"><b> Cost Sheet Approved</b></span>';
                            }
                            if ($enquiry['enquiry_status'] == 6) {
                                echo '<span style="color:red;text-align:center;"><b> Cost Sheet Rejected</b></span>';
                            }
                            if ($enquiry['enquiry_status'] == 7) {
                                echo '<span style="color:Green;text-align:center;"><b> Quotation Generated </b></span>';
                            }
                            ?></td>
                        <td>  
                            <button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="revise_view(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>
                    <?php
                    $cnt = $cnt + 1;
                }
                ?>
            </tbody>
        </table>

    </div>
    <!-- /.card -->
</div>


<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
<script>
  /*   function add_enquree()
    {
        $.ajax({
            type: "POST",
            url:"CRM/enquiry_add.php",
            success: function (data) {
                $("#main_content").html(data);
            }
        })
    }
    function proposal_edit(v) {
        // alert(v);
        $.ajax({
            type: "POST",
            url: base_url + "/CRM/proposal_edit.php?id=" + v,
            success: function (data)
            {
                $("#main_content").html(data);
            }
        })
    } */
    function revise_view(v) {
        //alert(v);
        $.ajax({
            type: "POST",
            url:"qvision/CRM/proposal_edit.php?id=" + v,
            success: function (data)
            {
                $("#main_content").html(data);
            }
        })
    }
    function back_ctc()
    {
        Quotation()
    }
</script>
</script>