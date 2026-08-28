<?php
require '../../../connect.php';
?>

<div class="card card-info">
<div class="card-header">
  <h3 class="card-title">Staff Asset Detail</h3>
</div>

<form class="form-horizontal" method="POST">
<table class="table table-bordered">
      <tr>
           <td>Employee Name:</td>
           <td colspan="2">
           <select class="form-control" name="emp_name" onchange="emp_assts_view(this.value)">
			<option value="0">-- Select Employee Name --</option>
			<?php
			$dep_sql = $con->query("SELECT * FROM staff_master");
			while ($dep_sql_res = $dep_sql->fetch(PDO::FETCH_ASSOC)) {
			?>
			<option value="<?php echo $dep_sql_res['id']; ?>"><?php echo $dep_sql_res['emp_name']; ?></option>
			<?php
			}
			?>
		</select>
           </td>
      </tr>

 </table>
</form>  
</div>

<div class="card">
   <div id="adminAssetView">  </div>
</div>

<script>
    function emp_assts_view(v)
    {
        $.ajax({
            type: "POST",
            url: "qvision/Recruitment/staff_asset/asset_admin_view.php?id="+v,
            success: function (data) {
                $("#adminAssetView").html(data);
            }
        })
    }
</script>