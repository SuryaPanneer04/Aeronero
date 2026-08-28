<?php
require'../../../connect.php';

$id=$_REQUEST['id'];
$staff_id=$_REQUEST['staff'];
$staff_code=$_REQUEST['staff_code'];
$staff_name=$_REQUEST['staff_name'];
$designation=$_REQUEST['designation'];
$dep=$_REQUEST['dep'];
$notice=$_REQUEST['notice'];
$relieve=date('d-M-Y',strtotime($notice));
$relieveDate = $_REQUEST['relieve'];

$date=date('d-M-Y');

if($relieveDate){
	$lastDate = Date('d-m-Y',strtotime($relieveDate)) ;
 } 
 else{
	 $lastDate = $relieve;
 }

$sta=$con->query("select * from staff_master s join candidate_form_details c on s.candid_id=c.id where s.id='$staff_id'");
$stafet=$sta->fetch();
$joining_date=$stafet['joining_date'];
$joining=date('d-M-Y',strtotime($joining_date));
$gen=$stafet['gender'];
if($gen=='female')
{
	$as="Mrs/Ms";
	$gend="She";
	$s="her";
}
else
{
	$as="Mr";
	$gend="He";
	$s="he";
}
$depart=$con->query("select * from z_department_master where id='$dep'");
$depfet=$depart->fetch();
$dep_name=$depfet['dept_name'];

$des=$con->query("select * from designation_master where id='$designation'");
$desfet=$des->fetch();
$des_name=$desfet['designation_name'];


?>
<html>
<style>


</style>

<section class="content" id="content">
	<div class="container-fluid">
	 <div class="row">
	  <div class="card-body">
     <form action="" method="post" enctype="multipart/form-data">   
    <div class="col-sm-12">
	<div class="col-sm-12"  style="text-align:left;">
	  
	</div>
	 
	 <div class="col-sm-12 row2"  style="text-align:right;" >
	 <a onclick="PrintDiv()"  data-toggle="modal" class="btn btn-danger"><b> PRINT</b></a>
	   &nbsp;<br/><br/>
	
	</div>
	 <div class="col-sm-12 row2"  id="divToPrint">
	<body>
	 <table width="1000px" class="col-md-12" style="font-size:30px;margin-top:100px;" > 
	    <tbody id="trid">
		
		<tr class="col-md-12"> 
		  <td class="col-md-4"><b>REF : </b><?php echo $staff_code;?></td>
		  
		  <td class="col-md-4" style="float: right;"><b>Date : </b><?php echo $date;?></td>
		</tr>
		</table>
		<table width="1000px" class="col-md-12" style="font-size:30px;margin-top:100px;" > 
		<tr><td style="font-size:34px;"><h4 ><b><u><center>Experience Certificate</center></u></b></h4></br></td> </tr>
		
		 <tr>
		  <td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;This is to certify that <b><?php echo $as;?>.<?php echo $staff_name;?></b> has worked as a <b><?php echo $des_name;?></b> in our <b><?php echo $dep_name;?></b> team from <b><?php echo $joining;?> to <?php echo $lastDate;?></b>.
		  </td>		   
		</tr>
		<tr>
		<td>
		<?php echo $gend;?> has resigned and left the organization on <?php echo $s;?> own accord.During <?php echo $s;?> tenure,<?php echo $s;?> services were found good,enthusiasm,spirit in learning new techniques and exhibited <?php echo $s;?> talent.<br/><br/> <br/><br/> 
		</td>
		</tr>
		<tr>
		<td>We wish <?php echo $s;?> all the best in future endeavors.<br/><br/><br/></td>
		</tr>
		<tr>
		<td><b>SS Information Systems Pvt Ltd,<br/><br/></b></b></b></td>
		</tr>
		<tr>
		<td><b> </b></td>
		</tr>
		<tr>
		<td><b>Managing Director</b></td>
		</tr>
		</tbody>
		</table>
		</body>
		</div>
		</html>
		
<script type="text/javascript">     
    function PrintDiv() 
	{    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank','height=1000,width=1500');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
	   popupWin.close();
    }
</script>


