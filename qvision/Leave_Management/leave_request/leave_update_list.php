<?php
require '../../../connect.php';
$leavedate=$_REQUEST['leavedate'];

$leave=$con->query("SELECT candid_id,prefix_code,emp_code,emp_name,status FROM staff_master where status=1 ORDER BY emp_code ASC");
$cnt=1;

while($emp = $leave->fetch(PDO::FETCH_ASSOC))
{
 $date=date('Y-m-d');           //CURRENT DATE
 $code=$emp['prefix_code'];
 //$prefix=;
 $emp_code=$emp['emp_code'];
 $candid_id=$emp['candid_id'];

 $dat =date('Y-m-d',strtotime($date)); //CURRENT DATE CONVERT
 
 $leave_sts=$con->query("select count(*) as rowcnt,remark,date,halfday from daily_attendance where candid_id='$candid_id' && date='$leavedate' && status = 2 ");
 //echo "select count(*) as rowcnt,remark,date,halfday from daily_attendence where candid_id='$candid_id' && date='$leavedate' && status = 2";
 $sts = $leave_sts->fetch();
 $att_cnt = $sts['rowcnt'];
 $leave_remark = $sts['remark'];
 $daily_leave_date = $sts['date'];
$halfday_sts=$sts['halfday'];

 $approved_leave_sts=$con->query("select count(*) as rowcnt,b.leave_name,a.from_date,a.to_date from leave_apply_masters a left join master_leave b on a.leave_type=b.id where a.candid_id='$candid_id' and a.status= 2 and '$leavedate' BETWEEN from_date and to_date");


 $leavecount = $approved_leave_sts->fetch();
 $approve_cnt = $leavecount['rowcnt'];
 $leave_types = $leavecount['leave_name'];
 $from = $leavecount['from_date'];
 $to = $leavecount['to_date'];
 ?>
 <tr>
<td><?php echo $cnt;?>.</td>
<td><?php echo $emp_code; ?></td>
<td><?php echo $emp['emp_name']; ?></td>
<td><input type="text" class="form-control" id="date_leave_<?php echo $cnt ?>" name="date" readonly></td>
<td><?php 
if($leave_remark!=''){
     echo $leave_remark .'--'. $daily_leave_date;
 }
 else if($leave_types!=''){ 
    echo $leave_types.'<br>' .'('.$from.'---'.$to.')';
}
else{
    echo "---"; } 
    ?> </td>

<td>
<!-- <input type="button" class="btn btn-danger" id="save" name="save"  onclick="update_leave(<?php echo $candid_id;?>)"  value="Mark as Leave">  -->
<?php 
if(($att_cnt != 0 || $approve_cnt != 0) && ($halfday_sts!=1 || $halfday_sts!='')){
?>
<label for="leave" class="form-control" style="background: #6627e5;color: white;width: 145px;text-align: center;border-radius: 4px;">Leave </label>
<input type="button" class="btn btn-warning" id="save1" name="save1[]"  onclick='openForm("<?php echo $candid_id ?>","<?php echo $daily_leave_date ?>",<?php echo 1;?>)'  value="UnMark Leave">

<?php
}
if(($att_cnt != 0 || $approve_cnt != 0) && $halfday_sts==1){
    ?>
    <label for="leave" class="form-control" style="background: #6627e5;color: white;width: 145px;text-align: center;border-radius: 4px;">Leave </label>
<input type="button" class="btn btn-warning" id="save1" name="save1[]"  onclick='openForm("<?php echo $candid_id ?>","<?php echo $daily_leave_date ?>","<?php echo 2;?>")'  value="UnMark Leave">

    <?php

}


if($leave_types==''  && $att_cnt == 0 ){
?>
<input type="button" class="btn btn-danger" id="save1" name="save1[]"  onclick='openForm("<?php echo $candid_id ?>","<?php echo $daily_leave_date ?>","<?php echo 1;?>")'  value="Mark as Leave">
<input type="button" class="btn btn-danger"  style="background:orange;color:black;border:1px solid orange;" id="save1" name="save1[]"  onclick='openForm("<?php echo $candid_id ?>","<?php echo $daily_leave_date ?>","<?php echo 2;?>")'  value="HalfDay">

<?php 
}
?>

</td>
</tr>
<?php
$cnt=$cnt+1;
}
?>

<script>
    $(document).ready(function(){
        let leavedate = $('#l_date').val()
        let len = $('#leaveUpdateTable tr').length

        for(let i=1; i < len; i++ ){
        document.querySelector('#date_leave_'+i).value = leavedate
	}

		// $('#leaveUpdateTable').DataTable({
        //         retrieve: true,
		// 		responsive: true
		// });

//     if ( $.fn.dataTable.isDataTable( '#example' ) ) {
//        table = $('#example').DataTable();
//     }
//     else {
//        table = $('#example').DataTable({
//         paging: false
//     });
//    }
  
$('#leaveUpdateTable').DataTable({
     "retrieve": true,
      "paging":true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });

	});
</script>