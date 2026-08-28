<?php
require '../../connect.php';
require '../../user.php';
$userid = $_SESSION['userid'];
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
        <h3 class="card-title"><font size="5">Cost List</font></h3>


    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="dataTable" class="table table-bordered table-striped">
            <thead>
            <th>#</th>
            <th>Call</th>
            <th>Date</th>
            <th>Company Name</th>
            <th>Location</th>
            <th>Contact Number</th>

            <th>Follow Up Date </th>

            <th>Department</th>
            <th>Employee</th>
            <th width="15%">Status</th>
            <th width="20%">Action</th>
            </thead>
            <tbody>
                <?php
                $candidateid = $_SESSION['candidateid'];
		//		echo  $candidateid = $_SESSION['candidateid'];
                $userrole = $_SESSION['userrole'];
			//	echo $userrole = $_SESSION['userrole'];
				
                if ($userrole == 'R002' || $userrole == 'R007' ) {
                    $query = $con->query("SELECT b.name as name,a.created_on as date,a.client_org as Company_name,a.address as location,a.whatsapp as Mobile,e.date as Follup,c.dept_name as dept_name,d.first_name as first_name,a.status as enquiry_status,a.id as enquiry_id FROM `crm_calls` a LEFT JOIN crm_calls_feedback e on A.id = e.calls_id
	   LEFT JOIN calls_master b ON a.Call_type=b.id
	  LEFT join z_department_master c ON a.Department=c.id
	  LEFT JOIN candidate_form_details d ON a.employee=d.id  where a.created_by='$userid' and (a.status='3' or a.status='4' or a.status='5' or a.status='6' or a.status='7' or a.status='8') group by a.id order by a.id desc");
	  
	
	 
	  /* echo "SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   LEFT JOIN calls_master ON enquiry.Call_type=calls_master.id
	  LEFT join z_department_master ON enquiry.Department=z_department_master.id
	  LEFT JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id  where enquiry.created_by='$candidateid' and (enquiry.status='3' or 
	  enquiry.status='4' or enquiry.status='5' or enquiry.status='6' or enquiry.status='7' or enquiry.status='8')";  */
	/*   
	  echo  "SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   LEFT JOIN calls_master ON enquiry.Call_type=calls_master.id
	  LEFT join z_department_master ON enquiry.Department=z_department_master.id
	  LEFT JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id  where enquiry.employee='$candidateid' and (enquiry.status='3' or enquiry.status='4' or enquiry.status='5' or enquiry.status='6' or enquiry.status='7')"; */
	  
                }  else if ($userrole == 'R001') {
                    $query = $con->query("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   INNER JOIN calls_master ON enquiry.Call_type=calls_master.id
	  INNER join z_department_master ON enquiry.Department=z_department_master.id
	  INNER JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
	  where  enquiry.status='3' or enquiry.status='4' or enquiry.status='5' or enquiry.status='6' or enquiry.status='7' or enquiry.status='8'");
                } else if ($userrole == 'R002') {
                    $query = $con->query("SELECT enquiry.id as enquiry_id,enquiry.status as enquiry_status,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   INNER JOIN calls_master ON enquiry.Call_type=calls_master.id
	  INNER join z_department_master ON enquiry.Department=z_department_master.id
	  INNER JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id
	  where  enquiry.status='3' or enquiry.status='4' or enquiry.status='5' or enquiry.status='6' or enquiry.status='7' or enquiry.status='8'");
                } 


                $cnt = 1;
                while ($enquiry = $query->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td><?php echo $cnt; ?>.</td>
                        <td><?php echo $enquiry['name']; ?></td>
                        <td><?php echo $enquiry['date']; ?></td>
                        <td><?php echo $enquiry['Company_name']; ?></td>
                        <td><?php echo $enquiry['location']; ?></td>
                        <td><?php echo $enquiry['Mobile']; ?></td>

                        <td><?php echo $enquiry['Follup']; ?></td>


                        <td><?php echo $enquiry['dept_name']; ?></td>
                        <td><?php echo $enquiry['first_name']; ?></td>

                        <td><?php
                            if ($enquiry['enquiry_status'] == 1) {

                                echo '<span style="color:green;text-align:center;"><b>Enquiry Added</b></span>';
                            }
                            if ($enquiry['enquiry_status'] == 2) {

                                echo '<span style="color:brown;text-align:center;"><b>Generated Lead</b></span>';
                            }
                            if ($enquiry['enquiry_status'] == 3) {

                                echo '<span style="color:brown;text-align:center;"><b>Generated Cost Sheet</b></span>';
                            }
                            if ($enquiry['enquiry_status'] == 4) {
                                echo '<span style="color:brown;text-align:center;"><b>Generated For Cost Sheet Approval</b></span>';
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
							if ($enquiry['enquiry_status'] == 8) {
                                echo '<span style="color:green;text-align:center;"><b> PO Uploaded</b></span>';
                            }
                            ?></td>
                        <td>  
                           
                            <button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="proposal_view(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
                        </td>
                    </tr>
                    <?php
                    $cnt = $cnt + 1;
                }
                ?>
            </tbody>
        </table>

    </div>
    <!-- /.card-body -->
</div>
<script>
    $(document).ready(function () {
        $('.dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
<script>
  
    function proposal_view(v) {
        // alert(v);
        $.ajax({
            type: "POST",
            url:"qvision/CRM/Add_cost.php?id=" + v,
            success: function (data)
            {
                $("#main_content").html(data);
            }
        })
    }
    function back_ctc()
    {
        costsheet_add()
    }
</script>
</script>