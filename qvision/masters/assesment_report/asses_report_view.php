<?php
require '../../../connect.php';
require '../../../user.php';
?>
<head>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script></head>
</div>

	<table class="dataTables-example table table-striped table-bordered table-hover" id="tbl_exporttable_to_xls">
	<thead>
<tr>
	<th>S.No</th>
	<th style="width: 50%">question</th>
	<th>options A</th>
	<th>options B</th>
	<th>options C</th>
	<th>options D</th>
	<th>answers</th>
</tr>
</thead>

<tbody>
    <?php

	$varr = $_REQUEST['name'];

	//print_r($varr);

	
	
    $asses_sql = $con->query("SELECT * FROM asses_question Where question_type='$varr'");
    $i = 1;
   
    while ($asses_res = $asses_sql->fetch(PDO::FETCH_ASSOC)) {
    ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $asses_res['question']; ?></td>
        
        <td><?php echo $asses_res['option_a']; ?></td>
        <td><?php echo $asses_res['option_b']; ?></td>
        <td><?php echo $asses_res['option_c']; ?></td>
        <td><?php echo $asses_res['option_d']; ?></td>
        <td><?php echo $asses_res['answer']; ?></td>
        <th colspan="6"><input type="button" class="btn btn-success" name="edit" onclick="question_edit(<?php echo $asses_res['question_no']; ?>)" value="edit" style="float:right;"></th>
      </tr>
    <?php
      $i++;
    }
    ?>
  </tbody>
</table> 
<script>
	function question_edit(v)
    {
    $.ajax({
    type:"POST",
    url:"qvision/masters/assesment_report/asses_report_edit.php?question_no="+v,
    success:function(data){
    $("#main_content").html(data);
    }
    })
  }
</script>