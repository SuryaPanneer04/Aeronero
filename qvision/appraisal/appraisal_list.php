<?php
require '../../connect.php';
include("../../user.php");
$userrole=$_SESSION['userrole'];
// print_r($userrole);
// die();
$candidateid=$_SESSION['candidateid'];
?>
<head>
    <link rel="stylesheet" href="Qvision\commonstyle.css">
<style>
.card-body > p{
	 font-weight: bold;
	 font-size: 20px;
	 text-align: center;
 }
</style>
    </head>
	
 <?php 
			date_default_timezone_set("Asia/Kolkata");

            $curDate = date('Y-m-d');
            $todayDate=date('Y-m-d', strtotime($curDate));
            $appraisal_start = date('Y-m-d', strtotime("02/15/".date("Y"))); //strtotime(m/d/y)
            $appraisal_end = date('Y-m-d', strtotime("03/25/".date("Y"))); //strtotime(m/d/y)
			
			//if($todayDate >= $appraisal_start and $todayDate <= $appraisal_end ){
		 if($todayDate >= $appraisal_start || $todayDate <= $appraisal_end ){
			?>
			
		   <div  class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><font size="5">APPRAISAL LIST</font></h3>
                
 <?php  if($userrole !='R003'){ ?>
            <a onclick="add_appraisal()" style="float: right;" data-toggle="modal" class="btn">ADD</a>
<?php } ?>
              </div>
              <div class="card-body">
       <table class="table table-bordered display nowrap"  id="example1" style="width:100%">

   
    <thead>
      <th>S.No</th>
      <th>Department</th>
      <th>Employee</th>
      <!--th>Person</th-->
      <th>Status</th>
      <th>Tools</th>
      </thead>
      <tbody>
      <?php
	$f_date = "01-04-".date("Y"); //d-m-Y
  $t_date = "31-03-".date("Y",strtotime('+1 years')); //d-m-Y

	if($userrole =='R003'){
    $emp_sql=$con->query("SELECT  a.id,a.emp_name as eid,a.dep_name,b.dept_name,c.emp_name,a.status,a.person_id,d.emp_name as pname FROM appraisal_details a 
    LEFT JOIN z_department_master b ON a.dep_name=b.id  
    LEFT JOIN staff_master c ON a.emp_name=c.id 
    LEFT JOIN staff_master d ON a.person_id=d.id 
    where a.from_date = '$f_date' and a.to_date = '$t_date' group by a.emp_name"); 
    // print_r($emp_sql);
    // die();

  }else{
      $emp_sql=$con->query("SELECT  a.id,a.emp_name as eid,a.dep_name,b.dept_name,c.emp_name,a.status,a.person_id,d.emp_name as pname FROM appraisal_details a 
      LEFT JOIN z_department_master b ON a.dep_name=b.id  
      LEFT JOIN staff_master c ON a.emp_name=c.id 
      LEFT JOIN staff_master d ON a.person_id=d.id 
      where a.from_date = '$f_date' and a.to_date = '$t_date' and a.person_id='$candidateid'  group by a.emp_name"); 
	  //where a.person_id='$candidateid'  DISTINCT
  }
      $i=1;
      while($emp_res = $emp_sql->fetch(PDO::FETCH_ASSOC))
      {
       ?>
      <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $emp_res['dept_name']; ?></td>
      <td><?php echo $emp_res['emp_name']; ?></td>
      <!--td>< ?php echo $emp_res['pname']; ?></td-->
	  
	   <td>
<?php 

if(($emp_res['status']==0) || ($emp_res['status']==4))  
{
echo '<span style="color:orange;text-align:center;"><b>Waiting For Approve</b></span>';
}
if(($emp_res['status']==1))  
{
echo '<span style="color:green;text-align:center;"><b>Approved by CEO</span><span style="color:blue; text-align:center;">/Waiting For MD Approve</b></span>';
}
if(($emp_res['status']==2))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected by CEO</b></span>';
}
if(($emp_res['status']==3))  
{
echo '<span style="color:green;text-align:center;"><b>Appraisal Approved</b></span>';
}
if(($emp_res['status']==5))  
{
echo '<span style="color:green;text-align:center;"><b>Approved by MD</span><span style="color:red; text-align:center;">/Waiting For Salary Date</b></span>';
}
if(($emp_res['status']==6))  
{
echo '<span style="color:red;text-align:center;"><b>Rejected by MD</b></span>';
}
?>
</td> 
	  
      <td>
 <?php  if(($emp_res['status']== 2 || $emp_res['status']==6) && ($userrole!='R003')){ ?>
	  <button class="btn btn-success btn-sm edit btn-flat" onclick="edit_appraisal(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> Edit</button>
<?php } ?>
	  <button class="btn btn-info btn-sm edit btn-flat" data-id="<?php echo $emp_res['id']; ?>" onclick="view_appraisal(<?php echo $emp_res['id']; ?>)"><i class="fa fa-edit"></i> view</button>

	  </td>
      </tr>
      <?php
	  $i++;
      }
      ?>
      </tbody>
      </table>
	 
</div>
</div>
<?php
}
else{
?>		
   <div  class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">APPRAISAL </font></h3>
    </div>
    <div class="card-body">
       <p>Appraisal Period is 15-Febuary-<?php echo date("Y");?> To 25-March-<?php echo date("Y");?></p>
   </div>
</div>				
			
<?php	 }  ?>


<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        "scrollX": true
    } );
});

function add_appraisal()
    {
    $.ajax({
    type:"POST",
    url:"qvision/appraisal/appraisal.php",
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  function edit_appraisal(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/appraisal/appraisal_edit.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
   function view_appraisal(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/appraisal/appraisal_view.php?id="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
  
</script>