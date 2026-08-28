<?php
 require '../../connect.php';
 $empid = $_REQUEST['emp_id'];
 $candidate_id = $_REQUEST['candidate_id'];
?>
<table class="table table-bordered" id="question_view">
<tbody>
<tr> <td colspan='2'> <h3><center>Self Appraisal Review</center></h3> </td> </tr>
<?php
$maxappraisal_id = $con->query("SELECT max(id) as maxid FROM `self_appraisal_master` WHERE `person_id`='$candidate_id'");
$max_id = $maxappraisal_id->fetch();
$selfmaxid = $max_id['maxid'];

$sql=$con->query("SELECT a.id,a.dep_name,a.question,b.rating,b.emp_name,b.id as self_app_id FROM self_appraisal_question a left join self_appraisal_rating b on a.id=b.question_id where a.self_appraisal_id='$selfmaxid' ");
$count = $sql->rowCount();
$cnt=0;
if($count==0){
?>
<tr><td style="font-size: 20px;font-weight: 900;text-align: center; color:red;"> Employee not yet fill  </td> </tr>
<?php }else{ ?>
<tr> 
<td> Questions </td>
<td> Rating</td>
</tr>

<?php
$points = 0;
while($rows = $sql->fetch(PDO::FETCH_ASSOC))
{ 
?>
<tr>
<td>
<input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly></td>

<td style="display: flex; justify-content: space-around; align-items: baseline;">
<label for="performance"> 1</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='1'){ echo "checked";} else{echo "disabled";} ?>>


<label for="performance"> 2</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='2'){ echo "checked";} else{echo "disabled";} ?>>


<label for="performance"> 3</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='3'){ echo "checked";} else{echo "disabled";} ?>>


<label for="performance"> 4</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='4'){ echo "checked";} else{echo "disabled";} ?>>


<label for="performance"> 5</label>
<input type="radio" name="rating_<?php echo $cnt; ?>[]"   id="performance<?php echo $cnt; ?>" value="<?php echo $rows['rating']; ?>" <?php if($rows['rating']=='5'){ echo "checked";} else{echo "disabled";} ?>>

</td>
</tr>
<?php 
$cnt++;
$per_point = $rows['rating'];
$points = $points + $per_point;
 }
?>

<tr>
<td><b>Sum of the Points(OUT OF 25)</b></td>
<td>
<input type="text" class="form-control" id="points_get_self" name="points_get_self" value="<?php echo  $points;?>" readonly>
</td>
</tr>

<?php } ?>
</tbody>
</table>

