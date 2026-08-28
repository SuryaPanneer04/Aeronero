<?php
require '../../../connect.php';
include("../../../user.php");
$userrole = isset($_SESSION['userrole']) ? $_SESSION['userrole'] : '';
$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT m.name,s.asset_master_id as asset_master_id,s.cug_status as cug_status,sm.status as sim_status,s.*,a.*,f.*,m.*,sm.* FROM `staff_access_request` s left join staff_asset_list a on s.id=a.asset_request_id left join assets_form_detail f on a.asset_id=f.id left join assets_master m on f.asset_name=m.name left join sim_master sm on a.sim_id=sm.id where s.id='$id'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$sid = isset($row['staff_id']) ? $row['staff_id'] : '';
$access = isset($row['asset_master_id']) ? $row['asset_master_id'] : '';
$cug_status = isset($row['cug_status']) ? $row['cug_status'] : '';
$phone_no = isset($row['phone_no']) ? $row['phone_no'] : '';
$mail_id = isset($row['mail_id']) ? $row['mail_id'] : '';
$sim_id = isset($row['sim_id']) ? $row['sim_id'] : '';

$sim_status = '';
if(!empty($sim_id)){
    $sim_map = $con->query("select * from sim_mapping where sim_id='$sim_id' ");
    if($sim_map){
        $simfe = $sim_map->fetch(PDO::FETCH_ASSOC);
        $sim_status = isset($simfe['status']) ? $simfe['status'] : '';
    }
}

$dep = '';
$staff_name = '';
if(!empty($sid)){
    $staff_mas = $con->query("select * from staff_master where id='$sid'");
    if($staff_mas){
        $stafet = $staff_mas->fetch(PDO::FETCH_ASSOC);
        $dep = isset($stafet['dep_id']) ? $stafet['dep_id'] : '';
        $staff_name = isset($stafet['emp_name']) ? $stafet['emp_name'] : '';
    }
}

$access_clean = trim($access);
$access_clean = rtrim($access_clean, ',');
?>

<head>
	<link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">

	<form method="POST" name="fupname" action="">
		<input type="hidden" name="userrole" id="userrole" value="<?php echo  $userrole; ?>">
		<input type="hidden" name="reqid" id="reqid" value="<?php echo  $id; ?>">
		<input type="hidden" name="simid" id="simid" value="<?php echo  $sim_id; ?>">
		<input type="hidden" name="cugsta" id="cugsta" value="<?php echo $cug_status; ?>">
		<table class="table table-bordered">
			<tr>
				<td colspan="4">
					<div class="row">
						<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-arrow-left"></i> BACK</a>
					</div>
				</td>
			</tr>

			<tr>
				<td>Employee Name:</td>
				<td colspan="3"><input type="text" class="form-control" name="emp_name" value="<?php echo htmlspecialchars($staff_name); ?>" readonly>
				</td>
			</tr>
            <?php
            // Query for pending assets
            $isel = $con->query("SELECT DISTINCT m.id AS id, m.name, a.Serial_no 
                                 FROM staff_asset_list s
                                 JOIN assets_form_detail a ON s.asset_id = a.id 
                                 JOIN assets_master m ON a.asset_name = m.name 
                                 WHERE s.staff_id = '$sid' AND s.status = 1");
            
            $has_assets = false;
            $is_first = true;

            if($isel){
                while ($dfet = $isel->fetch(PDO::FETCH_ASSOC)) {
                    $has_assets = true;
                ?>
                <tr>
                    <!-- First row-la mattum Given Assets heading varum, next row ku empty aagidum -->
                    <td style="font-weight:bold;"><?php echo $is_first ? 'Given Assets:' : ''; ?></td>
                    <td><?php echo $dfet['name']; ?></td>
                    <td colspan="2"><?php echo $dfet['Serial_no']; ?></td>
                </tr>
                <?php
                    $is_first = false;
                }
            }

            if (!$has_assets) {
                ?>
                <tr>
                    <td>Given Assets:</td>
                    <td colspan="3"></td>
                </tr>
                <?php
            }
            ?>
			<tr>
				<?php
				if ($sim_status == 2) {
				?>
					<td>Mobile No:</td>
					<td><?php echo $phone_no; ?></td>
					<td>Mail Id:</td>
					<td><?php echo htmlspecialchars($mail_id); ?></td>
				<?php
				} else {
				?>
					<td>Mail Id:</td>
					<td colspan="3"><?php echo htmlspecialchars($mail_id); ?></td>
				<?php
				}
				?>
			</tr>
			<tr>
				<td colspan="4" style="font-weight:bold;">Return:</td>
			</tr>
		</table>
		
		<table class="dataTables-example table table-striped table-bordered table-hover" id="example1">
            <tr>
                <td>
                    <?php
                    // FIX: Direct fetch from staff_asset_list for return checkboxes
                    $isel = $con->query("SELECT DISTINCT m.id as id, m.name as name, a.Serial_no as Serial_no, a.id as aid 
                                         FROM staff_asset_list s
                                         JOIN assets_form_detail a ON s.asset_id = a.id 
                                         JOIN assets_master m ON a.asset_name = m.name 
                                         WHERE s.staff_id = '$sid' AND s.status = 1");

                    if($isel){
                        $i = 1;
                        while ($dfet = $isel->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <div style="width:100%;float:left;padding: 5px 0px;">
                                <div style="width:15%;float:left;margin-left: 113px;">
                                    <input type="checkbox" name="View[]" id="View<?php echo $i; ?>" value="<?php echo $dfet['aid']; ?>" />&emsp;<?php echo $dfet['name']; ?>
                                </div>
                            </div>
                        <?php
                            $i++;
                        }
                    }
                    ?>
                </td>
            </tr>
        </table>
		<table class="table table-bordered">
			<tr>
				<?php
				if ($sim_status == 2) {
				?>
					<td>CUG</td>
					<td colspan="2">
						<select class="form-control" name="cug" id="cug">
							<option value="Yes">Yes</option>
							<option value="No">No</option>
						</select>
					</td>
				<?php
				}
				?>
			</tr>
		</table>
		<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
	</form>
</div>

<script>
	function back() {
		staff_assets_return();
	}

	$(document).ready(function() {
		$("form[name='fupname']").on("submit", function(ev) {
			ev.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: 'qvision/Recruitment/staff_asset/asset_return_submit.php',
				method: "POST",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {
					alert("Return Entry Successful!");
					staff_assets_return();
				}
			});
		});
	});
</script>