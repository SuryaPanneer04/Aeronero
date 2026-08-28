

    
$(document).on('click', '.reject-btn', function() {
    let id = $(this).data('id');
    let sta = $(this).data('sta');

    updatestatus(sta, id);
});

function updatestatus1(sta, id) {
    $.ajax({
        type: "GET",
        url: "qvision/Question_Management/status.php",
        data: 'sta=' + sta + '&id=' + id,
        success: function(data) {
            if (data == 1) {
                alert('Update Successfully');
                candicate_results();
            } else {
                alert("Update Failed");
                candicate_results();
            }
        }
    });
}

function updatestatus(sta, id) {
    $.ajax({
        type: "GET",
        url: "qvision/Question_Management/statusss.php",
        data: 'sta=' + sta + '&id=' + id,
        success: function(data) {
            if (data == 1) {
                alert('Update Successfully');
                candicate_results();
            } else {
                alert("Update Failed");
                candicate_results();
            }
        }
    });
}

$(document).ready(function() {
    $('#example1').DataTable({
        responsive: true
    });
});



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>