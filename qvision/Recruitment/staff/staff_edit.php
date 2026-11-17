<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid = $_REQUEST['id'];

// Added s.status as emp_status and s.candid_id as candid_id to avoid column conflict
$sql = $con->query("select *, s.id as staff_id, s.status as emp_status, s.candid_id as candid_id from staff_master s left join candidate_form_details c on c.id=s.candid_id left join z_department_master z on z.id=s.dep_id where s.id='$candidateid'");
$data = $sql->fetch();
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">EMPLOYEE DETAIL</font></h3>
        <input type="button" name="back" style="float: right;" id="back" data-toggle="tab" class="btn btn-danger" value="BACK" onclick="go_back()">
    </div>

    <form method="POST" enctype="multipart/form-data">
        <table class="table table-bordered">
            <tr>
                <td>Employee Code</td>
                <td colspan="5"><input type="text" class="form-control" id="candidate_code" name="candidate_code" value="<?php echo $data['emp_code']; ?>"></td>
            </tr>
            <tr>
                <td>Name Of The Employee</td>
                <td colspan="5"><input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?php echo $data['emp_name']; ?>"></td>
            </tr>
            
            <!-- NEW FIELDS FOR candidate_form_details -->
            <tr>
                <td>Father's Name</td>
                <td colspan="5"><input type="text" class="form-control" id="father_name" name="father_name" value="<?php echo $data['father_name']; ?>"></td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td colspan="5"><input type="date" class="form-control" id="dob" name="dob" value="<?php echo $data['dob']; ?>"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td colspan="5"><input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address']; ?>" maxlength="96"></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td colspan="5"><input type="text" class="form-control" id="phone" name="phone" value="<?php echo $data['phone']; ?>" maxlength="10"></td>
            </tr>
            <tr>
                <td>Aadhar Number</td>
                <td colspan="5"><input type="text" class="form-control" id="adharnumber" name="adharnumber" value="<?php echo $data['adharnumber']; ?>" maxlength="15"></td>
            </tr>
            <tr>
                <td>PAN Number</td>
                <td colspan="5"><input type="text" class="form-control" id="pannumber" name="pannumber" value="<?php echo $data['pannumber']; ?>" maxlength="10"></td>
            </tr>
            <!-- END NEW FIELDS -->

            <tr>
                <td>Department</td>
                <td colspan="5">
                    <?php 
                    $depid = $data['dep_id'];
                    if ($depid == '') {
                    ?>
                        <select class="form-control" name="department" id="department">
                            <option value="0">---------</option>
                            <?php
                            $dep = $con->query("select * from z_department_master");
                            while ($dep_sql_res = $dep->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php 
                    } else {
                    ?>
                        <select class="form-control" name="department" id="department">
                            <?php 
                            $dep1 = $con->query("select * from z_department_master where id='$depid'");
                            $fet = $dep1->fetch();
                            ?>
                            <option value="<?php echo $fet['id']; ?>"><?php echo $fet['dept_name']; ?></option>
                            <option value="0">---------</option>
                            <?php
                            $dep = $con->query("select * from z_department_master");
                            while ($dep_sql_res = $dep->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['dept_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php 	
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Division</td>
                <td colspan="5">
                    <?php 
                    $divid = $data['div_id'];
                    if ($divid != 0) {
                    ?>
                        <select class="form-control" name="division" id="division">
                            <?php 
                            $div1 = $con->query("select * from division_master where id='$divid'");
                            $divs = $div1->fetch();
                            ?>
                            <option value="<?php echo $divs['id']; ?>"><?php echo $divs['div_name']; ?></option>
                            <option value="0">---------</option>
                            <?php
                            $div_sql = $con->query("select * from division_master");
                            while ($div_sql_res = $div_sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['div_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php 
                    } else {
                    ?>
                        <select class="form-control" name="division" id="division">
                            <option value="0">---------</option>
                            <?php
                            $div_sql = $con->query("select * from division_master");
                            while ($div_sql_res = $div_sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['div_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php 
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Designation</td>
                <td colspan="5">
                    <?php 
                    $desid = $data['design_id'];
                    if (!empty($desid)) {
                    ?>
                        <select class="form-control" name="designation" id="designation">
                            <?php 
                            $des1 = $con->query("select * from designation_master where id='$desid'");
                            $des = $des1->fetch();
                            ?>
                            <option value="<?php echo $des['id']; ?>"><?php echo $des['designation_name']; ?></option>
                            <option value="0">---------</option>
                            <?php
                            $div_sql = $con->query("select * from designation_master");
                            while ($div_sql_res = $div_sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['designation_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php 
                    } else {
                    ?>
                        <select class="form-control" name="designation" id="designation">
                            <option value="0">---------</option>
                            <?php
                            $div_sql = $con->query("select * from designation_master");
                            while ($div_sql_res = $div_sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['designation_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php 
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Reporting Person</td>
                <td colspan="5">
                    <?php 
                    $reportingper_id = $data['reporting_person'];
                    if (!empty($reportingper_id)) {
                    ?>
                        <select class="form-control" name="reporting_to" id="reporting_to">
                            <?php
                            $psel = $con->query("select * from staff_master where id='$reportingper_id'");
                            $pfet = $psel->fetch(PDO::FETCH_ASSOC);
                            $person_name = $pfet['emp_name'];
                            ?>
                            <option value="<?php echo $reportingper_id; ?>"><?php echo $person_name; ?></option>
                            <option value="0">---------</option>
                            <?php
                            $div_sql = $con->query("select * from staff_master");
                            while ($div_sql_res = $div_sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['emp_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php 
                    } else {
                    ?>
                        <select class="form-control" name="reporting_to" id="reporting_to">
                            <option value="0">---------</option>
                            <?php
                            $div_sql = $con->query("select * from staff_master");
                            while ($div_sql_res = $div_sql->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <option value="<?php echo $div_sql_res['id']; ?>"><?php echo $div_sql_res['emp_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    <?php 
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Head Status</td>
                <?php 
                $heads = $data['head_status'];
                if ($heads == 0) {
                ?>
                    <td>
                        <input type="radio" name="head_status" id="no" value="0" checked>
                        <label for="no">no</label>
                    </td>
                    <td>
                        <input type="radio" name="head_status" id="yes" value="1">
                        <label for="yes">Yes</label>
                    </td>
                <?php		 
                } elseif ($heads == 1) {
                ?>
                    <td>
                        <input type="radio" name="head_status" id="no" value="0">
                        <label for="no">no</label>
                    </td>
                    <td>
                        <input type="radio" name="head_status" id="yes" value="1" checked>
                        <label for="yes">Yes</label>
                    </td>
                <?php
                } else {
                ?>
                    <td>
                        <input type="radio" name="head_status" id="no" value="0">
                        <label for="no">no</label>
                    </td>
                    <td>
                        <input type="radio" name="head_status" id="yes" value="1">
                        <label for="yes">Yes</label>
                    </td>
                <?php
                }
                ?>
            </tr>
            <?php
            $status = $data['emp_status'];	  
            if ($status == 1) {
            ?>
                <tr>
                    <td>Status</td>	  
                    <td>	  
                        <input type="radio" name="status" id="status_active" value="1" checked>
                        <label for="status_active">Active</label>
                    </td>
                    <td>
                        <input type="radio" name="status" id="status_inactive" value="2">
                        <label for="status_inactive">Inactive</label>
                    </td>
                </tr>
            <?php
            } else {
            ?>
                <tr>
                    <td>Status</td>	  
                    <td>	  
                        <input type="radio" name="status" id="status_active" value="1">
                        <label for="status_active">Active</label>
                    </td>
                    <td>
                        <input type="radio" name="status" id="status_inactive" value="2" checked>
                        <label for="status_inactive">Inactive</label>
                    </td>
                </tr>
            <?php  
            }
            ?>
            <tr>  
                <td colspan="6">
                    <input type="hidden" name="cid" id="cid" value="<?php echo $candidateid; ?>">
                    <input type="hidden" name="candid_id" id="candid_id" value="<?php echo $data['candid_id']; ?>">
                    <input type="button" class="btn btn-danger" style="float:right;" name="save" id="<?php echo $candidateid; ?>" onclick="staff_update(this.id)" value="Update">
                </td>
            </tr>
        </table>
    </form>
</div>

<script>
function staff_update(v)
{		
    var cname = $('#candidate_name').val();
    var ccode = $('#candidate_code').val();
    
    // Extract letters and numbers separately
    var lettersMatch = ccode.match(/[A-Za-z]+/g);
    var letters = lettersMatch ? lettersMatch.join('') : '';
    var numbersMatch = ccode.match(/\d+/g);
    var numbers = numbersMatch ? numbersMatch.join('') : '';
    var empcodesend = letters + "**" + numbers + "**" + ccode;

    var deprt = $('#department').val();
    var div = $('#division').val();
    var desig = $('#designation').val();
    var reporing = $('#reporting_to').val();
    var cid = $('#cid').val();
    var candid_id = $('#candid_id').val();
    var radioValue = $("input[name='head_status']:checked").val();
    var status = $("input[name='status']:checked").val();

    // New fields for candidate_form_details
    var father_name = $('#father_name').val();
    var dob = $('#dob').val();
    var address = $('#address').val();
    var phone = $('#phone').val();
    var adharnumber = $('#adharnumber').val();
    var pannumber = $('#pannumber').val();

    $.ajax({
        type: "GET",
        url: "qvision/Recruitment/staff/staff_update.php",
        data: {
            cname: cname,
            ccode: empcodesend,
            deprt: deprt,
            div: div,
            desig: desig,
            cid: cid,
            candid_id: candid_id,
            reporting: reporing,
            head_status: radioValue,
            status: status,
            father_name: father_name,
            dob: dob,
            address: address,
            phone: phone,
            adharnumber: adharnumber,
            pannumber: pannumber
        },
        success: function(data)
        {
            if (data.trim() == "0")
            {
                alert("Updated successfully");
                staff_list();
            }
            else
            {
                alert("Update failed! Server says: " + data);
            }
        }
    });
}
	
function go_back()
{
    staff_list();
}

function get_location(v)
{
    $('#hiddend').hide();
    $.ajax({
        type: "GET",
        url: "qvision/Recruitment/staff/get_location.php?site=" + v,
        success: function(data)
        {
            $('#location_dis').html(data);
        }
    });
}

function change_location(v)
{
    $.ajax({
        type: "GET",
        url: "qvision/Recruitment/staff/change_location.php?site=" + v,
        success: function(data)
        {
            $('#location_chng').html(data);
        }
    });
}
</script>