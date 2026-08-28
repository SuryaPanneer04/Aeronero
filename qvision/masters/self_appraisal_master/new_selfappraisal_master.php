<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = $_SESSION['userrole'];
$cid = $_SESSION['candidateid'];

$emp = $con->query("select s.id,s.emp_name,s.dep_id,z.dept_name from staff_master s LEFT JOIN z_department_master z ON s.dep_id=z.id where candid_id='$cid'");
$emp_no = $emp->fetch();
$emp_dep = $emp_no['dept_name'];
$depID = $emp_no['dep_id'];
?>

<head>
  <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>
<style>
  .card-primary:not(.card-outline)>.card-header {
    background-color: #f1cc61 !important;
  }

  .card-primary:not(.card-outline)>.card-header {
    color: black !important;
  }

  .btn-dark {
    background-color: #ed5d00 !important;
    border-color: #ed5d00 !important;
  }

  .card-primary:not(.card-outline)>.card-header a {
    color: black !important;
  }
</style>

<div class="card card-primary">
  <div class="card-header" style="background-color:#ff8b3d !important;">
    <h3 class="card-title">
      <font size="5">ADD SELF APPRAISAL DETAILS</font>
    </h3>
    <a onclick="return back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark">BACK</a>
  </div>

  <form method="POST" action="">
    <input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
    <input type="hidden" name="cid" id="cid" value="<?php echo  $cid; ?>">
    <table class="table table-bordered">

      <tr>
        <td>Department Name</td>
        <td colspan="2">
          <!-- <select class="form-control" name="department" id="department" >
		<option value="0">-- Select Department --</option>
		<?php
    $dep_sql = $con->query("SELECT id, dept_name, status FROM z_department_master");
    while ($dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
    ?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
			<?php
    }
      ?>
</select> -->

          <input type="text" id="department" name="department" class="form-control" data-id="<?php echo $depID; ?> " value="<?php echo $emp_dep; ?>" readonly>
        </td>
      </tr>

      <table class="table table-bordered" id="new_tab">

        <tr>
          <th>S.No</th>
          <th>Questions</th>
          <!-- <th>Action</th> -->
        </tr>

        <?php
        $i = 1;
        for ($i = 1; $i <= 5; $i++) {
        ?>
          <tr>
            <td> <label for="name_<?php echo $i; ?>"> <?php echo $i; ?> </label> </td>

            <td><input type="text" class="form-control" id="question_<?php echo $i; ?>" name="question_[]" autocomplete="off" required></td>


            <!-- <td>
	  <input type="button" class="btn btn-success" id="new_row" name="new_row" onclick="check()" value="Add">
      <input type="button" class="btn btn-danger" id="row_remove"  value="Remove">
    </td> -->
          </tr>
        <?php } ?>
      </table>

    </table>
    <input type="button" name="submit" value="Submit" class="btn btn-primary btn-md" style="float:right;position: relative;left: -5px;" onclick="save_selfappraisal()">
  </form>
  <br>
</div>


<script>
  function back_ctc() {
    self_appraisal_master();
  }

  function save_selfappraisal() {
    let dep_id = $('#department').attr('data-id');

    var data = $('form').serialize();
    $.ajax({
      type: 'GET',
      data: data,
      url: "qvision/masters/self_appraisal_master/selfappraisal_master_submit.php?depid=" + dep_id,
      success: function(data) {
        if (data == 0) {
          alert("Submit Failed");
          self_appraisal_master();
        } else {
          alert("Submitted Successfully");
          self_appraisal_master();
        }

      }
    });
  }

  // function check() // add_rows
  // {
  // var len=$('#new_tab tr').length;	
  // len=len+1; 
  // $('#new_tab').append('<tr class="row_'+len+'"><td><input type="checkbox" class="chk" name="chk[]" id="chk_'+len+'" value="'+len+'"</td><td><input type="text" class="form-control" id="question_'+len+'" name="question[]" autocomplete="off"></td></tr>'); 
  // }

  // $('#row_remove').click(function(){
  // $('input:checkbox:checked.chk').map(function(){
  // var id=$(this).val();
  // var le=$('#new_tab tr').length;

  // if(le==1)
  // {
  // alert("You Can't Delete All the Rows");
  // }
  // else
  // {
  // $('.row_'+id).remove();
  // }
  // });
  // });
</script>