<?php
require '../../connect.php';
$id = $_REQUEST['id'];
$user_id = $_REQUEST['person_id'];
$emp_id = $_REQUEST['emp_id'];

$from = $_REQUEST['from_dates'];
$from_date = date('Y-m-d', strtotime($from));

$to = $_REQUEST['to_dates'];
$to_date = date('Y-m-d', strtotime($to));
?>
<table class="table table-bordered">
    <tbody>
        <tr>
            <td colspan='2'>
                <h3>
                    <center>Appraisal Questions</center>
                </h3>
            </td>
        </tr>
        <?php
        $ratting = $con->query("SELECT count(*) as ratecount FROM appraisal_rating WHERE persons_id='$user_id' && emp_name='$emp_id'");
        $rate = $ratting->fetch();
        $rating_row_count = $rate['ratecount'];

        $sql = $con->query("SELECT a.id,a.question,a.dep_name FROM appraisal_question a  where (a.dep_name='$id') AND (a.person_id='$user_id') AND (a.emp_id='$emp_id' AND a.status=1) && (a.created_on BETWEEN '$from_date' AND '$to_date')");

        $count = $sql->rowCount();
        $cnt = 0;
        if ($count == 0) {
        ?>
            <tr>
                <td style="font-size: 20px;font-weight: 900;text-align: center; color:red;"> Kindly Complete Appraisal Master Before Appraisal </td>
            </tr>
        <?php
        } else if ($rating_row_count > 0) {
        ?>
            <tr>
                <td style="font-size: 20px;font-weight: 900;text-align: center; color:red;"> Already Appraisal Done </td>
            </tr>

        <?php
        } else { ?>
            <tr>
                <td> Questions </td>
                <td> Rating</td>
                <input type="hidden" name="count" id="rate_totcnt" value="<?php echo $count; ?>">
            </tr>
            <?php
            while ($rows = $sql->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td>
                        <input type="hidden" name="qid<?php echo $cnt; ?>[]" id="qid" value="<?php echo $qid = $rows['id']; ?>">
                        <input type="text" class="form-control" id="question_1" name="question<?php echo $cnt; ?>" value="<?php echo  $rows['question']; ?>" autocomplete="off" readonly>
                    </td>

                    <td style="display: flex; justify-content: space-around; align-items: baseline;">
                        <label for="performance"> 1</label>
                        <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="1" onclick="get_appraisal_point()">

                        <label for="performance"> 2</label>
                        <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="2" onclick="get_appraisal_point()">

                        <label for="performance"> 3</label>
                        <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="3" onclick="get_appraisal_point()">

                        <label for="performance"> 4</label>
                        <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="4" onclick="get_appraisal_point()">

                        <label for="performance"> 5</label>
                        <input type="radio" class="calc" name="rating<?php echo $cnt; ?>[]" id="performance_<?php echo $cnt; ?>" value="5" onclick="get_appraisal_point()">
                    </td>
                </tr>
            <?php
                $cnt++;
            }

            if ($count > 0) {
            ?>
                <tr>
                    <td><b>Sum of the Points(OUT OF 75)</b></td>
                    <td>
                        <input type="text" class="form-control" id="appraisal_score" name="appraisal_score" readonly>
                    </td>
                </tr>

                <tr>
                    <td><b>Overall Points(OUT OF 100)</b></td>
                    <td>
                        <input type="text" class="form-control" id="overallmark" name="overallmark" readonly>
                    </td>
                </tr>

            <?php } ?>
            <tr>
                <td>Salary (In Percentage)</td>
                <td colspan="2" id="percentageView">
                    <!-- <select class="form-control" name="salary" id="salary">
                        <option value="0">--- Select Percentage ---</option>
                        <?php
                        foreach (range(5, 100, 5) as $percent) : ?>
                            <option value="<?php echo $percent; ?>"> <?php echo $percent; ?> % </option>
                        <?php endforeach; ?>
                    </select> -->
                    <input type="text" class="form-control" id="salary" name="salary" readonly>
                </td>
            </tr>

            <tr>
                <td>Designation</td>
                <td colspan="2">
                    <select class="form-control" name="new_designation" id="new_designation">
                        <option value="">--- Select Designation ---</option>
                        <?php
                        $des_sql = $con->query("SELECT id, designation_name FROM designation_master WHERE status=1 AND id<>1");
                        while ($des_sql_res = $des_sql->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <option value="<?php echo $des_sql_res['id']; ?>"><?php echo $des_sql_res['designation_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
        <?php  } ?>

    </tbody>
</table>


<script>
    function get_appraisal_point() {

        var score = 0;
        $(".calc:checked").each(function() {
            score += parseInt($(this).val(), 10) * 3;
        });

        $('#appraisal_score').val(score)

        let selftotal = $('#points_get_self').val()
        let overall = parseInt(selftotal) + parseInt(score)

        $('#overallmark').val(overall)

        if (overall >= 100) {
            $('#recommend').show()
        } else {
            $('#recommend').hide()
        }

        var dep = $('#department').val();
        $.ajax({
            type: 'GET',
            url: '/ssinfo1/qvision/appraisal/find_percentage.php',
            data: "depId=" + dep + "&total=" + overall,
            success: function (data)
            {
                $("#percentageView").html(data);
            }
        })
    }
</script>