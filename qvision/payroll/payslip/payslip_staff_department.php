<?php
require '../../../connect.php';
require '../../../user.php';
$username=$_SESSION['username'];
 $dept=$_REQUEST['id'];
		//echo "SELECT id,candid_id,emp_code as emp_no, emp_name FROM staff_master WHERE dep_id='$dept'";

?>

<select class="form-control" name="employee">
    <option value="0">-- Select Employee --</option>
      <?php
	  //if($username!='hr@quadsel.in')
	 // {
		// $getcandi=$con->query("SELECT * FROM `z_user_master` WHERE user_name='$username'"); 
		 //$can_idfetch = $getcandi->fetch(PDO::FETCH_ASSOC);
		 //$candiid=$can_idfetch['user_id'];  
		 //$staff_sql = $con->query("SELECT id,candid_id,emp_code as emp_no, emp_name FROM staff_master WHERE dep_id='$dept' and id='$candiid'");
        //while ($staff_sql_res = $staff_sql->fetch(PDO::FETCH_ASSOC)) {
       ?>
    <!--<option value="<?php echo $staff_sql_res['candid_id']; ?>"><?php echo $staff_sql_res['emp_no'] . '-' . $staff_sql_res['emp_name']; ?></option>-->
    <?php
        //}
	  //}
	  //else
	 // {
		 $staff_sql = $con->query("SELECT id,candid_id,emp_code as emp_no, emp_name FROM staff_master WHERE dep_id='$dept'");
        while ($staff_sql_res = $staff_sql->fetch(PDO::FETCH_ASSOC)) {
       ?>
     <option value="<?php echo $staff_sql_res['candid_id']; ?>"><?php echo $staff_sql_res['emp_no'] . '-' . $staff_sql_res['emp_name']; ?></option>
    <?php 
	  //}
	  }
    ?>
</select>