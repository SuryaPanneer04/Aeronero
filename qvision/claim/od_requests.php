<!--
initial status = 0 is before OD approve;
After approve status= 1;

OD request 

Anto ajith
-->

<?php
require '../../config.php';
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
                <h3 class="card-title"><font size="5">Claim Requests</font></h3>
			
                <a onclick="return add_od()"  style="float: right;" data-toggle="modal" ></a>
              </div>
              <div class="card-body">
       <table class="table table-bordered display nowrap"  id="example1" style="width:100%">

   
    <thead>
      <th>S.No</th>
      <th>Emp Name</th>
      <th>Date </th>
      <th>Customer Name</th>
      <th>Location</th>
      <th>Purpose</th>
      <th>Option</th>
      </thead>
      <tbody>
      <?php
       $holiday = $con->query("SELECT * FROM manual_att where status=1");
	   
//echo "SELECT *,a.id as mid,a.location as c_loc FROM manual_att a left JOIN staff_master b on a.emp_code=b.id";
        $cnt = 1;
        while ($req_master = $holiday->fetch(PDO::FETCH_ASSOC)) 
		{
$date_cce=$req_master['date'];			
$date_chge=date("d-m-Y",strtotime($date_cce));	

	$candidate_id=$req_master['candidate_id'];	
$stmtr = $con->prepare("SELECT user_id,full_name,candidate_id FROM z_user_master where candidate_id='$candidate_id'");
									
											   $stmtr->execute(); 
                                               $rowr = $stmtr->fetch();
											   $empz_name=$rowr['full_name'];	
      ?>
	  
       <tr>
        <td><?php echo $cnt; ?></td>
        <td><?php echo $empz_name; ?></td>
        <td><?php echo $date_chge; ?></td>
        <td><?php echo $req_master['customer_name'];?></td>
        <td><?php echo $req_master['location']; ?></td>
        <td><?php echo $req_master['purpose']; ?></td>
        <td>				
         <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $req_master['id']; ?>"  onclick="view_rqsts(<?php echo $req_master['id']; ?>)"><i class="fa fa-edit"></i> View</button>
		 
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

		  function view_rqsts(v) {
            $.ajax({
                type: "POST",
                url: "qvision/payroll/view_od_detail.php?id="+v,
                success: function (data)
                {
                    $("#main_content").html(data);
                }
            })
        }
    </script>