<?php
require '../../../connect.php';
$id = $_REQUEST['id'];

// Smart origin tracking to prevent routing collisions
$from_page = isset($_REQUEST['from']) ? $_REQUEST['from'] : '';
 
$stmt = $con->prepare("SELECT name, s.asset_master_id as asset_master_id, s.cug_status as cug_status, s.status as req_status, s.*, a.*, f.*, m.*, sm.* FROM `staff_access_request` s left join staff_asset_list a on s.id=a.asset_request_id left join assets_form_detail f on a.asset_id=f.id left join assets_master m on f.asset_name=m.name left join sim_master sm on a.sim_id=sm.id where s.id='$id'");
$stmt->execute(); 
$row = $stmt->fetch();

$sid = isset($row['staff_id']) ? $row['staff_id'] : '';
$access = isset($row['asset_master_id']) ? $row['asset_master_id'] : '';
$cug_status = isset($row['cug_status']) ? $row['cug_status'] : '';
$phone_no = isset($row['phone_no']) ? $row['phone_no'] : '';
$mail_id = isset($row['mail_id']) ? $row['mail_id'] : '';

// Capturing exact asset status for intelligent back navigation
$status = isset($row['req_status']) && $row['req_status'] != '' ? $row['req_status'] : (isset($row['status']) ? $row['status'] : 0);

$staff_mas = $con->query("select * from staff_master where id='$sid'");
$stafet = $staff_mas->fetch();
$dep = isset($stafet['dep_id']) ? $stafet['dep_id'] : '';
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
</head>

<div class="card card-primary">
<div class="card-header">
<i class="fa fa-table"></i> Allocated Assets
<!-- Intelligent Back Button -->
<a onclick="smart_back_navigation()" style="float: right; background-color: #d9534f; border-color: #d43f3a; color: white; cursor: pointer;" class="btn btn-sm">Back</a>
</div>
<div class="card-body" id="printableArea">
<form role="form" name="" action="qvision/Recruitment/staff_asset/staff_asset_accept_submit.php" method="post" enctype="multipart/type">

<table class="table table-bordered">
<tr>
<td>Employee Name:</td>
<td colspan="2">
<input type="hidden" name="sid" id="sid" value="<?php echo $sid;?>">
<input type="hidden" name="reqid" id="reqid" value="<?php echo $id;?>">
<?php
$dep_sql1 = $con->query("SELECT * FROM staff_master where id='$sid' ");
$fet = $dep_sql1->fetch();		
?>
<input type="text" name="emp_name" id="emp_name" class="form-control" value="<?php echo isset($fet['emp_name']) ? $fet['emp_name'] : '';?>" readonly>
</td>
</tr>

<?php
$isel = $con->query("select distinct m.id as id,name,a.Serial_no as Serial_no from assets_form_detail a join assets_master m on a.asset_name=m.name where a.asset='Internal Asset' and m.name in('$access') and a.id in(select asset_id from staff_asset_list where staff_id='$sid')");

$i = 0;
$s = 1;
if($isel){
    while($dfet = $isel->fetch())
    {
        $mid = $dfet['id'];
?>
<tr>	 
    <td><?php echo $dfet['name'];?></td>
    <td><?php echo $dfet['Serial_no'];?></td>
</tr>
<?php		 
        $i++;
        $s++;
    }
}
?>
<?php 
if($cug_status == 'Yes')
{
?>
<tr>
<td>CUG:</td>
<td>
<input type="hidden" name="cug_sta" id="cug_sta" value="<?php echo $cug_status;?>">
<input type="text" class="form-control" name="cug" id="cug" value="<?php echo $phone_no;?>" readonly>
</td>
</tr>
<?php 
}
?>
<tr>
<td>Mail Id</td>
<td><input type="text" name="mail_id" id="mail_id" class="form-control" value="<?php echo $mail_id;?>" readonly></td>
</tr>
</table>

</form>
</div>
</div>

<script>
  // MNC Enterprise Smart Back Routing Controller
  function smart_back_navigation() {
    var from_source = "<?php echo $from_page; ?>";
    var asset_status = <?php echo (int)$status; ?>;

    // 1. If employee came from their custom My Assets dashboard
    if (from_source === 'my_assets') {
      if (typeof my_assets === "function" || typeof window.my_assets === "function") {
        typeof window.my_assets === "function" ? window.my_assets() : my_assets();
      } else {
        $.ajax({
          type: "POST",
          url: "qvision/Recruitment/staff_asset/my_assets.php",
          success: function(data) { $("#main_content").html(data); }
        });
      }
      return;
    }

    // 2. If HR is viewing a Head Approved asset (Status 4 or above), route strictly to Staff Asset List!
    // Exactly fixing what we found in your Network Tab screenshot!
    if (asset_status >= 4) {
      $.ajax({
        type: "POST",
        url: "qvision/Recruitment/staff_asset/staff_asset_list_md.php",
        success: function(data) {
          $("#main_content").html(data);
        }
      });
      return;
    }

    // 3. Fallback for pending/allocated acceptance items
    $.ajax({
      type: "POST",
      url: "qvision/Recruitment/staff_asset/staff_asset_accept_list.php",
      success: function(data) {
        $("#main_content").html(data);
      }
    });
  }
</script>