<?php
require '../../connect.php';
include("../../user.php");
$candidateid = $_SESSION['candidateid'];
$userrole = $_SESSION['userrole'];
?>
<style>
  .card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
  }

  .card-primary:not(.card-outline)>.card-header,
  .card-primary:not(.card-outline)>.card-header a {
    color: #e95a16 !important;
  }

  .card-primary:not(.card-outline)>.card-header,
  .card-primary:not(.card-outline)>.card-header a {
    color: #3c0808 !important;
    background-color: #ed5d00;
  }

  .btn-dark {
    border-color: #ed5d00;
  }

  .page-item.active .page-link {
    background-color: #d79475;
    border-color: #df8459;
  }

  .page-link:hover {
    color: #f1cc61;
  }

  .card-primary:not(.card-outline)>.card-header {
    background-color: #df8459 !important;
  }

  .btn-dark {
    background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
  }
</style>
<style>
  .card-info:not(.card-outline)>.card-header a {
    color: #3c0808 !important;
    background-color: #ed5d00;
  }

  .btn-dark {
    background-color: rgb(237, 93, 0);
    color: rgb(60, 8, 8) !important;
    border-color: rgb(237, 93, 0);
  }

  .card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
  }
</style>
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <font size="5">Enquiry List</font>
    </h3>
    <a onclick="add_enquree()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> New Enquiry</a>
  </div>

  <div class="card-body">
    <table id="example1" class="table table-bordered">
      <thead>
        <th>#</th>
        <th>Call</th>
        <th>Date</th>
        <th>Company Name</th>
        <th>Location</th>
        <th>Contact Number</th>
        <th>Mail Id</th>
        <th>Feedback</th>
        <th>Foll UP Date </th>
        <th>Department</th>
        <th>Employee</th>
        <th>Action</th>
      </thead>
      <tbody>
        <?php
        $candidateid = $_SESSION['candidateid'];
        $userrole = $_SESSION['userrole'];

        if ($userrole == 'ROLE-007') {
          $datas = $con->query("SELECT enquiry.id as enquiry_id,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,staff_master.*  FROM `enquiry`
	   LEFT JOIN calls_master ON enquiry.Call_type=calls_master.id
	  LEFT JOIN z_department_master ON enquiry.Department=z_department_master.id
	  LEFT JOIN staff_master ON enquiry.employee=staff_master.candid_id  where enquiry.employee='$candidateid' order by enquiry.id ASC");
        } else {
          $datas = $con->query("SELECT enquiry.id as enquiry_id,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,staff_master.*  FROM `enquiry`
	   LEFT JOIN calls_master ON enquiry.Call_type=calls_master.id
	  LEFT JOIN z_department_master ON enquiry.Department=z_department_master.id
	  LEFT JOIN staff_master ON enquiry.employee=staff_master.candid_id order by enquiry.id DESC");
          /* echo "SELECT enquiry.id as enquiry_id,enquiry.mail as enquiry_mailid,enquiry.*,calls_master.*,z_department_master.*,candidate_form_details.*  FROM `enquiry`
	   LEFT JOIN calls_master ON enquiry.Call_type=calls_master.id
	  LEFT JOIN z_department_master ON enquiry.Department=z_department_master.id
	  LEFT JOIN candidate_form_details ON enquiry.employee=candidate_form_details.id order by enquiry.id DESC"; */
        }
        $cnt = 1;
        while ($enquiry = $datas->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <tr>
            <td><?php echo $cnt; ?>.</td>
            <td><?php echo $enquiry['name']; ?></td>
            <td><?php echo $enquiry['date']; ?></td>
            <td><?php echo $enquiry['Company_name']; ?></td>
            <td><?php echo $enquiry['Location']; ?></td>
            <td><?php echo $enquiry['it_mob1']; ?></td>
            <td><?php echo $enquiry['it_mail1']; ?></td>
            <td><?php echo $enquiry['Feedback']; ?></td>
            <td><?php echo $enquiry['Follup']; ?></td>
            <td><?php echo $enquiry['dept_name']; ?></td>
            <td><?php echo $enquiry['emp_name']; ?></td>




            <td>
              <button class="btn btn-info" data-id="<?php echo $enquiry['enquiry_id']; ?>" onclick="ctc_view(<?php echo $enquiry['enquiry_id']; ?>)"><i class="fa fa-eye"></i></button>
            </td>

          </tr>
        <?php
          $cnt = $cnt + 1;
        }
        ?>
      </tbody>
    </table>

    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<script>
  function add_enquree() {
    $.ajax({
      type: "POST",
      url: "qvision/CRM/enquiry_add.php",
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }

  function ctc_view(v) {
    //alert(v);
    $.ajax({
      type: "POST",
      url: "qvision/CRM/enquiry_view.php?id=" + v,
      success: function(data) {
        $("#main_content").html(data);
      }
    })
  }

  function back_ctc() {
    enquiry()
  }
</script>

<script>
  $(document).ready(function() {
    $('#example1').DataTable();
  });
</script>