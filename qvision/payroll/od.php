<!--
initial status = 0 is before OD approve;
After approve status= 1;
till view done to do approve for OD
-->

<?php
require '../../connect.php';
include '../../user.php';
$userrole=$_SESSION['userrole'];
//echo $userrole;
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
<?php 

?>
		   <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">Claim Master</font></h3>
			
                <a onclick="return add_od()"  style="float: right;" data-toggle="modal" class="btn">ADD</a>
              </div>
              <div class="card-body">
       <table class="table table-bordered display nowrap"  id="example1" style="width:100%">

   
    <thead>
      <th>S.No</th>
      <th>Emp Code</th>
      <th>Emp Name</th>
      <th>Date </th>
      <th>Customer Name</th>
      <th>Location</th>
      <th>Purpose</th>
      <th>Option</th>
      </thead>
      <tbody>
      <?php
       $holiday = $con->query("SELECT *,a.id as mid,a.location as c_loc FROM claim_request a left JOIN staff_master b on a.candidate_id=b.candid_id");
	   
//echo "SELECT *,a.id as mid,a.location as c_loc FROM manual_att a left JOIN staff_master b on a.emp_code=b.id";
        $cnt = 1;
        while ($holiday_master = $holiday->fetch(PDO::FETCH_ASSOC)) {
      ?>
	  
       <tr>
        <td><?php echo $cnt; ?></td>
        <td><?php echo $holiday_master['emp_code']; ?></td>
        <td><?php echo $holiday_master['emp_name']; ?></td>
        <td><?php echo $holiday_master['date']; ?></td>
        <td><?php echo $holiday_master['customer_name'];?></td>
        <td><?php echo $holiday_master['c_loc']; ?></td>
        <td><?php echo $holiday_master['purpose']; ?></td>
        <td>				
         <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $holiday_master['mid']; ?>"  onclick="od_edit(<?php echo $holiday_master['mid']; ?>)"><i class="fa fa-edit"></i> Edit</button>
		 
        </td>
    </tr>
	
	 <?php
            $cnt = $cnt + 1;
          }
      ?>
     
      </tbody>
      </table>
	 
</div>
</div>


     
      </tbody>
      </table>
	 
</div>
</div>



<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        "scrollX": true
    } );
} );
</script>

<script>
        function add_od()
        {
            $.ajax({
                type: "POST",
                url:  "qvision/payroll/od_add.php",
                success: function (data) {
                    $("#main_content").html(data);
                }
            })
        }
        function od_edit(v) {
            $.ajax({
                type: "POST",
                url: "qvision/payroll/od_edit.php?id="+v,
                success: function (data)
                {
                    $("#main_content").html(data);
                }
            })
        }
		  function od_view(v) {
            $.ajax({
                type: "POST",
                url: "qvision/payroll/od_view.php?id="+v,
                success: function (data)
                {
                    $("#main_content").html(data);
                }
            })
        }
    </script>