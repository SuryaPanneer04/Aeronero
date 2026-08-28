<?php
require '../../../connect.php';
require '../../../user.php';
$candidateid=$_SESSION['candidateid'];
$userrole=$_SESSION['userrole'];

$sql = $con->query("
    SELECT *
    FROM staff_master
    WHERE candid_id='$candidateid'
    AND head_status IN (1,2)
");

$count = $sql->rowCount();

if($count > 0)
{
    $quote = $con->query("
        SELECT DISTINCT
            a.cost_sheet_no,
            a.approved_by,
            a.status AS cs_status,
            a.enquiry_id,
            a.business_id,
            c.*,
            p.*,
            e.*
        FROM cost_sheet_entry a
        LEFT JOIN new_client_master c
            ON a.client_id = c.id
        LEFT JOIN new_plant_master p
            ON c.id = p.client_id
        LEFT JOIN po_generate e
            ON a.cost_sheet_no = e.cost_sheet_no
        WHERE e.po_upload_status IN ('1','2')
        ORDER BY e.id DESC
    ");
}
else
{
    $quote = false;
}
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
    </head>
	<style>
	.card-primary:not(.card-outline)>.card-header{
		background-color: #f1cc61 !important;
	}
	</style>
<div  class="card card-primary">
              <div class="card-header">
                <h3 style="float: left;">QUOTE LIST</h3>
		 		  <!--a onclick=" back_ctc()" style="float: right;" data-toggle="modal" class="btn btn-dark"><i class="fa fa-plus"></i> Back</a-->
		
              </div>
           
<!--
<div  class="card card-primary">
     <div class="card-header">
	<h2 class="card-title"><font size="5"><b>Quote List</b></font> </h2></div>
	<div class="card-body">-->
    <table id="example1" class="table table-bordered table-striped">
      <thead>
		   <th>#</th>
		  <th>Company Name</th>
		  <th>Client Name</th>
		  <th>Quote Number</th>
		  <th>Cost Sheet Number</th>
		  <th>SO Number</th>
		  <th>Status</th>
		  <th>Action</th>
      </thead>
      <tbody>
      <?php
//$candidateid=$_SESSION['candidateid'];
//$userrole=$_SESSION['userrole'];
	
     $cnt=1;
	 if($count==1)
{
	//$quote=$con->query("select * from po_generate where po_upload_status='1' order by id desc ");
	$quote=$con->query("SELECT distinct a.cost_sheet_no,a.approved_by,a.status as cs_status,a.enquiry_id,a.business_id,c.*,p.*,e.* FROM cost_sheet_entry a 
	left join new_client_master c on (a.client_id=c.id)left join new_plant_master p on (c.id=p.client_id) left join po_generate e on(a.cost_sheet_no=e.cost_sheet_no)
	where (e.po_upload_status ='1' || e.po_upload_status ='2') order by e.id desc");
	/* echo "SELECT distinct a.cost_sheet_no,a.approved_by,a.status as cs_status,a.enquiry_id,a.business_id,c.*,p.*,e.* FROM cost_sheet_entry a 
	left join new_client_master c on (a.client_id=c.id)left join new_plant_master p on (c.id=p.client_id) left join po_generate e on(a.cost_sheet_no=e.cost_sheet_no)
	where e.po_upload_status ='1' order by e.id desc"; */
      while($quote_list = $quote->fetch(PDO::FETCH_ASSOC))
	  {
		  ?>
      <tr>
	  <td><?php echo $cnt;?>.</td>
      <td><?php echo $quote_list['org_name']; ?></td>
      <td><?php echo $quote_list['contact_person']; ?></td>
      <td><?php echo $quote_list['quote_no']; ?></td>
      <td><?php echo $quote_list['cost_sheet_no']; ?></td>	
      <td><?php echo $quote_list['so_number']; ?></td>	
<td><?php  
$mstatus = $quote_list['marketing_status'];

$market_emp_name = "";

if ($mstatus != 0) {

    $m_approved_id = $quote_list['marketing_approved_by'];

    $mtmtf = $con->prepare("SELECT emp_name FROM staff_master WHERE candid_id = ?");
    $mtmtf->execute([$m_approved_id]);

    $rowm = $mtmtf->fetch(PDO::FETCH_ASSOC);

    if ($rowm) {
        $market_emp_name = $rowm['emp_name'];
    } else {
        $market_emp_name = "Unknown";
    }
}

$mdstatus = $quote_list['md_status'];

$md_emp_name = "";

if ($mdstatus != 0) {

    $md_approved_id = $quote_list['md_approved_by'];

    $mdtmtf = $con->prepare("SELECT emp_name FROM staff_master WHERE candid_id = ?");
    $mdtmtf->execute([$md_approved_id]);

    $rowmd = $mdtmtf->fetch(PDO::FETCH_ASSOC);

    if ($rowmd) {
        $md_emp_name = $rowmd['emp_name'];
    } else {
        $md_emp_name = "Unknown";
    }
}
$fstatus=$quote_list['finance_status'];

if($fstatus==0){}
else{
	$f_approved_id = $quote_list['finance_approved_by']; 
$stmtf = $con->prepare("SELECT emp_name from staff_master where candid_id ='$f_approved_id' "); 	
		
		 $stmtf->execute(); 
		 $rowf = $stmtf->fetch();
		 $finance_emp_name = $rowf['emp_name'];	
}

$serstatus=$quote_list['service_status'];

if($serstatus==0){}
else{
$s_approved_id = $quote_list['service_approved_by'];
$stmts = $con->prepare("SELECT emp_name from staff_master where candid_id ='$s_approved_id' "); 	
	
		 $stmts->execute(); 
		 $rows = $stmts->fetch();
		 $service_emp_name = $rows['emp_name'];
}


 if($fstatus==1)
{


	echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;

	echo '<span style="color:green;text-align:center;"><b>&  Marketing Level-2 Approved By <b/></span>';
	echo $md_emp_name;
	echo '<span style="color:red;text-align:center;"><b>&  Finance Approved By <b/></span>';
	echo $finance_emp_name;
}

elseif($fstatus ==2)
{
		echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;

	echo '<span style="color:green;text-align:center;"><b>&  Marketing Level-2 Approved By<b/></span>';
	echo $md_emp_name;
	echo '<span style="color:red;text-align:center;"><b>& Finance Rejected By<b/></span>';
    echo $finance_emp_name;
	}
elseif($fstatus ==0)
{
	if($mdstatus==2 && $mstatus==1 && $fstatus ==0)
	{
	echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;

	echo '<span style="color:green;text-align:center;"><b>&  Marketing Level-2 Rejected By<b/></span>';
	echo $md_emp_name;

}elseif($mdstatus==1 && $mstatus==1 && $fstatus ==0)
{
		echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;

	echo '<span style="color:green;text-align:center;"><b>&  Marketing Level-2 Approved By <b/></span>';
	echo $md_emp_name;
	echo '<span style="color:red;text-align:center;"><b>& Waiting For Finance Approval<b/></span>';

	}elseif($mdstatus==0 && $mstatus==0 && $fstatus ==0)
{
		echo '<span style="color:red;text-align:center;"><b>Waiting For Marketing Level-1 Approval<b/></span>';

	}
	elseif($mdstatus==0 && $mstatus==1 && $fstatus ==0)
{
		echo '<span style="color:green;text-align:center;"><b>Marketing Level-1 Approved By <b/></span>';
	echo $market_emp_name;
   echo '<span style="color:red;text-align:center;"><b>& Waiting For Marketing Level-2 Approval<b/></span>';
	}
	elseif($mstatus==2)
{
		echo '<span style="color:green;text-align:center;"><b> Marketing Level-1 Rejected By<b/></span>';
	echo $market_emp_name;
	}
	elseif($mstatus==1 && $mdstatus==2 )
{
		echo '<span style="color:green;text-align:center;"><b> Marketing Level-1 Approved By<b/></span>';
	echo $market_emp_name;
	echo '<span style="color:green;text-align:center;"><b>& Marketing Level-2 Rejected By<b/></span>';
	echo $md_emp_name;
	}
}

?></td>	  

	<td>  
	<?php //if($fstatus =='0'){ ?>
	<button class="btn btn-info" data-id="<?php echo $quote_list['id']; ?>" onclick="po_view(<?php echo $quote_list['id']; ?>)"><i class="fa fa-eye"></i></button>
	<?php //} ?>	
	</td>

      </tr>
      <?php
	  $cnt=$cnt+1;
      }
}
      ?>
      </tbody>
      </table>

     
     </div>


<script>


function po_view(v)
{
	  //alert(v);
	$.ajax({
	type:"POST",
	url:"qvision/BusinessProcess/po_approval/po_approve.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}
function back_ctc()
	{
		finance_po_approve()
	}
	
	$(function () 
	{
     $(document).ready(function() {
    $('#dataTable').DataTable( {
        "scrollY": 400,
        "scrollX": true
    } );
	} );
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

	
    </script>
