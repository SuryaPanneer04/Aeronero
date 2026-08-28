<?php
require'../../../connect.php';

$id=$_REQUEST['id'];
$staff_id=$_REQUEST['staff'];
$staff_code=$_REQUEST['staff_code'];
$staff_name=$_REQUEST['staff_name'];
$applied_date=$_REQUEST['applied_date'];
$relieve = $_REQUEST['relieve'];
$adate=date('d-M-Y',strtotime($applied_date));
$notice=$_REQUEST['notice'];
$ldate=date('d-M-Y',strtotime($notice));
$date=date('d-M-Y');

if($relieve){
	$releiveDate = Date('d-m-Y',strtotime($relieve)) ;
 } 
 else{
	 $releiveDate = $ldate;
 }
?>
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
	<div class="col-sm-12 row2"  style="text-align:right;">
	<a onclick="PrintDiv()"  data-toggle="modal" class="btn btn-danger"><b> PRINT</b></a>
	   &nbsp;<br/><br/>
	</div>
	<div class="col-sm-12 row2"  id="divToPrint">
	 <table width="1000px" class="col-md-12" style="font-size:30px;margin-top:100px;" > 
	    <tbody>
		
		<tr class="col-sm-12 row2"> 
		  <td class="col-sm-4"><b>REF : </b><?php echo $staff_code;?></td>
		  
		  <td class="col-sm-4" style="float: right;"><b>Date : </b><?php echo $date;?></td>
		</tr>
		</tbody>
		 </table>
		 <table width="1000px" class="col-md-12" style="font-size:30px;margin-top:100px;" >
		  <tbody>
		  
		<tr><td style="font-size:34px;"><h4 ><b><u><center>Relieving Letter</center></u></b></h4></td> </tr>		 
		<tr > 
		   <td><b>Dear <?php echo $staff_name;?> , </b><br /><br/> </td>
		 </tr>
		 <tr>
		  <td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp; We are in reciept of your mail dated  <?php echo $adate;?> and the same has been approved by our Management.Consequently,you are relieved from the service on the closing hours of <?php echo $releiveDate;?>.		 
		  </td>		   
		</tr>
		<tr>
		<td>
		By a copy of this letter,we are advising Accounts Department,to settle your accounts accordingly. <br/><br/><br/> 
		</td>
		</tr>
		<tr>
		<td>We wish you all the best in future endeavors.<br/><br/><br/></td>
		</tr>
		<tr>
		<td><b>SS Information Systems Pvt Ltd,<br/><br/></b></b></td>
		</tr>
		<tr>
		<td><b>MANAGER-HR.</b></td>
		</tr>
		<tbody>
		</table>
		</div>
		<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'height=1000,width=1500');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
       popupWin.document.close();
       popupWin.close();
            }
 </script>