<?php
require '../../config.php';
$id=$_REQUEST['id'];
$stmt = $con->prepare("select * from staff_access_request where id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();

$sid=$row['staff_id'];
$access=$row['asset_master_id'];
$cug_status=$row['cug_status'];

$staff_mas=$con->query("select * from staff_master where id='$sid'");
$stafet=$staff_mas->fetch();
$dep=isset($stafet['dep_id']) ? $stafet['dep_id'] : 0;
?>
<div class="container-fluid">
<div class="card mb-3">
<div class="card-header">
<i class="fa fa-table"></i> Asset Access Edit
<a onclick="back_to_staff()" style="float: right;" data-toggle="modal" class="btn btn-primary">Back</a>
</div>
<div class="card-body" id="printableArea">
<form id="fupname" role="form" name="fupname" action="" method="post" enctype="multipart/form-data">

<table class="table table-bordered">
<tr>
<td><center><img src="/KerliERP/Recruitment/image/userlog/quadsel.png" alt="quadsel" style="width:100px;height:50px;"></center></td>
<td colspan="5"><center><b>Bluebase Software Services Private Limited</b></center></td>
</tr>
<tr>
<td>Employee Name:</td>
<td colspan="2">
<input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>">
<input type="hidden" name="reqid" id="reqid" value="<?php echo $id;?>">
<?php
$dep_sql1=$con->query("SELECT * FROM staff_master where id='$sid' ");
$fet=$dep_sql1->fetch();		
		?>
		<input type="text" name="emp_name" id="emp_name" class="form-control" value="<?php echo isset($fet['emp_name']) ? $fet['emp_name'] : '';?>" readonly>
		</td>
</tr>

<?php
$clean_access = trim($access, ',');
$asset_array = explode(',', $clean_access); 

foreach($asset_array as $ass_id) {
    $ass_id = trim($ass_id);
    if(!empty($ass_id)){
        // Step 1: Master table la irunthu Prefix Code edukkurom
        $mast_sql = $con->query("SELECT name, prefix_code FROM assets_master WHERE id='$ass_id'");
        $mast_fet = $mast_sql->fetch();
        
        if($mast_fet) {
            $m_name = $mast_fet['name'];
            $m_prefix = $mast_fet['prefix_code'];
?>
            <tr>
                <!-- Left side: Changed to exactly "Asset Name :" -->
                <td>Asset Name :</td>
                <td>
                    <!-- Right side: Showing the requested asset name as Readonly Text -->
                    <input type="text" class="form-control" value="<?php echo $m_name; ?>" readonly>
                    
                    <?php
                    // Step 2: Auto-fetching the first available physical asset ID for DB update
                    $avail_sql = $con->query("SELECT id FROM assets_form_detail WHERE prefix='$m_prefix' AND status=1 LIMIT 1");
                    
                    if($avail_fet = $avail_sql->fetch()) {
                        // Hidden input sends the physical ID to submit.php seamlessly
                        echo '<input type="hidden" name="asset_name[]" value="'.$avail_fet['id'].'">';
                    } else {
                        // Safety check: Shows error if no physical stock is available
                        echo '<span style="color:red; font-size:12px; font-weight:bold;">Out of Stock! No physical asset available to allocate.</span>';
                        echo '<input type="hidden" name="asset_name[]" value="0">';
                    }
                    ?>
                </td>
            </tr>
<?php
        }
    }
}
?>

<?php
if($cug_status=='Yes')
{
	
	?>
	<tr>
<td>CUG:</td>
<td>
<input type="hidden" name="cug_sta" id="cug_sta" value="<?php echo $cug_status;?>">
<select name="cug" id="cug" class="form-control">
<?php 
$selcug=$con->query("SELECT *,s.id as id FROM `sim_master` s join sim_mapping m on s.id=m.sim_id where m.department_id='$dep' and m.status=1");
while($simdis=$selcug->fetch())
{
	?>
	<option value="<?php echo $simdis['id']; ?>"><?php echo $simdis['phone_no']; ?></option>
	<?php
}
?>
</select> 
</td>
</tr>

	<?php
}
?>
<tr>
<td>Mail Id</td>
<td><input type="text" name="mail_id" id="mail_id" class="form-control" ></td>
</tr>
</table>

<input type="submit" name="submit" class="btn btn-primary btn-md" style="float:right;">
</form>
</div>
</div>
</div>
<script>
	function back_to_staff() {
		staff_asset_allocate();
	}

	$(document).ready(function() {  
		$(document).off("submit", "#fupname").on("submit", "#fupname", function(ev) {
			ev.preventDefault();
			var formData = new FormData(this);	  
			$.ajax({  
				url: 'qvision/Recruitment/staff_asset/staff_asset_allocate_submit.php',
				method: "POST",  
				data: formData, 
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {  
					alert("Entry Successfull");
					staff_asset_allocate(); // Back to list page
				}  
			});  
		});  
	});
</script>