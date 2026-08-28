<?php
require '../../connect.php';
require '../../user.php';
 $candidateid=$_SESSION['candidateid'];
 
 $sql=$con->query("select * from candidate_form_details where id='$candidateid' and status !='1' and status !='20'");
 //echo "select * from candidate_form_details where id='$candidateid' and status !='1' and status !='20'";
$qn=$sql->fetch();
//$row_count = count($qn);  

 if($qn !='')
 {
	  $qnid=$qn['qn_name_id'];
 }
 
 else
 {
	 $qnid="";
	 $sql_status=$con->query("select status from candidate_form_details where id='$candidateid'");
	 $cand = $sql_status->fetch();
	 if($cand && $cand['status'] == 20) {
		 echo "<script>alert('You have already completed the test.');</script>";
	 } else {
		 echo "<script>alert('No test assigned to you currently.');</script>";
	 }
 }
 
?>
<div class="content-wrapper" style="padding-left: 50px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2>Aptitude and Logical</h2>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
	</section>
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-12">
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
	  <form method="POST" enctype="multipart/form-data">
    <table id="example1" class="table table-bordered">
   <thead>
<tr>
  <th style="width: 5%">S.No.</th>
  <th>Question</th>
</tr>
</thead>
<tbody>

<?php   
$dis=$con->query("SELECT section FROM question_master where qn_name='$qnid' and status=1 GROUP BY section");
$cnt=1;
while($dat= $dis->fetch(PDO::FETCH_ASSOC))
{
$sec=$dat['section'];
	$sql1=$con->query("SELECT * FROM section_master where id='$sec'");
$section=$sql1->fetch();
?>
<tr><td colspan="2"><h4><?php echo $section['name']; ?></h4></td></tr>
<?php
$sql1=$con->query("SELECT * FROM question_master where qn_name='$qnid' and section='$sec' and status=1");



while($row = $sql1->fetch(PDO::FETCH_ASSOC))
//echo "<pre>";print_r($row);exit();
{
	?>
		
<tr>
<td class="center"><?php echo $cnt;?>.</td>

<td style="font-size: 18px;">

<?php echo $row['Questions'];?>



<br>
<br>
 
 <input type="radio"  name="answer_value_<?php echo $cnt;?>" id="answer_1_<?php echo $cnt;?>" value="1">
 <input type="hidden"  name="question_value_<?php echo $cnt;?>" id="question_<?php echo $cnt;?>" value="<?php echo $row['id'];?>">
 <?php echo $row['Option_A'];?>

<br>

<input type="radio"  name="answer_value_<?php echo $cnt;?>" id="answer_2_<?php echo $cnt;?>" value="2">
<input type="hidden"  name="question_value_<?php echo $cnt;?>" id="question_<?php echo $cnt;?>" value="<?php echo $row['id'];?>">
<?php echo $row['Option_B'];?>

<br>

<input type="radio"  name="answer_value_<?php echo $cnt;?>" id="answer_3_<?php echo $cnt;?>" value="3">
<input type="hidden"  name="question_value_<?php echo $cnt;?>" id="question_<?php echo $cnt;?>" value="<?php echo $row['id'];?>">
<?php echo $row['Option_C'];?>

<br>

<input type="radio"  name="answer_value_<?php echo $cnt;?>" id="answer_4_<?php echo $cnt;?>" value="4">
<input type="hidden"  name="question_value_<?php echo $cnt;?>" id="question_<?php echo $cnt;?>" value="<?php echo $row['id'];?>">
<?php echo $row['Option_D'];?>
</td>



</tr>
<?php 
$cnt=$cnt+1;
 }
 ?>
  <?php
}?>
 </tbody>
      </table>
<input type="hidden" name="candidateid" value="<?php echo $candidateid;?>">
<input type="hidden" name="qnid" value="<?php echo $qnid;?>">
	  <input type="button" class="btn btn-o btn-primary" name="submit"  onclick="Answer_keys()" value="Submit">
	  </form>
<!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
</div>
</div>
 <script>
    function Answer_keys()
    {
		
    var id=0;
	//alert(id);
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data: data + "&" + "id="+id,
    url:'qvision/Question_Management/Answer_validation.php',
	
    success:function(data)
    {
		
     alert('Your  Answer  Updated Successfully');
         window.location='login/logout.php'
      
    }       
    });
    }
    </script>