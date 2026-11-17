<?php
require '../../../connect.php';
include("../../../user.php");
$userrole=$_SESSION['userrole'];
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 style="float: left;"><font size="5">ADD PUBLICATION DETAILS</font></h3>
        <a onclick="back_publication()" style="float: right;" class="btn btn-dark">BACK</a>
    </div>

    <form id="pub_form" enctype="multipart/form-data">
        <input type="hidden" name="userrole" value="<?php echo $userrole; ?>">
        <table class="table table-bordered">
            <tr>
                <td>Date</td>
                <td colspan="2"><input type="date" class="form-control" name="date"></td>
            </tr>
            <tr>
                <td>Title of the Manuscript</td>
                <td colspan="2"><input type="text" class="form-control" name="title_of_manuscript"></td>
            </tr>
            <tr>
                <td>Manuscript Prepared BY</td>
                <td colspan="2"><input type="text" class="form-control" name="prepared_by"></td>
            </tr>
            <tr>
                <td>Journal Name</td>
                <td colspan="2"><input type="text" class="form-control" name="journal_name"></td>
            </tr>
            <tr>
                <td>Attach Manuscript</td>
                <td colspan="2">
                <div id="manuscript_attachments">

                    <div class="attachment-row" style="display:flex; gap:10px; margin-bottom:10px; align-items:center;">

                        <select name="attachment_type[]" class="form-control attachment-type"
                                style="width:180px;" onchange="changeAttachmentType(this)">
                            <option value="file">File</option>
                            <option value="link">External Link</option>
                        </select>

                        <div class="attachment-input" style="flex:1;">
                            <input type="file"
                                class="form-control"
                                name="manuscript_files[]">
                        </div>

                        <button type="button"
                                class="btn btn-danger"
                                onclick="removeAttachment(this)"
                                style="display:none;">
                            Remove
                        </button>

                    </div>

                </div>

                <button type="button"
                        class="btn btn-success btn-sm"
                        onclick="addAttachment()">
                    + Add Another
                </button>

            </td>
            </tr>

            <tr>
                <td>Communication Date</td>
                <td colspan="2"><input type="date" class="form-control" name="communication_date"></td>
            </tr>
            <tr>
                <td>Status</td>
                <td colspan="2">
                    <select class="form-control" name="status" required>
                        <option value="">-- Select Status --</option>
                        <option value="Processing">Processing</option>
                        <option value="Pending">Pending</option>
                        <option value="Complete">Complete</option>
                    </select>
                </td>
            </tr>

        </table>
        <input type="button" value="Submit" class="btn btn-primary btn-md" style="float:right;" onclick="save_publication()">
        <br><br>
    </form>
</div>

<script>

function back_publication() {

    $.ajax({
        type: "POST",
        url: "qvision/BusinessProcess/publications/publications_list.php",

        success: function(data) {
            $("#main_content").html(data);
        }
    });

}


/* Change File / External Link */

function changeAttachmentType(select) {

    var row = $(select).closest('.attachment-row');
    var inputDiv = row.find('.attachment-input');

    if (select.value === "file") {

        inputDiv.html(
            '<input type="file" class="form-control" name="manuscript_files[]">'
        );

    } else {

        inputDiv.html(
            '<input type="url" class="form-control" name="manuscript_links[]" placeholder="https://...">'
        );

    }

}


/* Add another attachment */

function addAttachment() {

    var row = `
        <div class="attachment-row"
             style="display:flex; gap:10px; margin-bottom:10px; align-items:center;">

            <select name="attachment_type[]"
                    class="form-control attachment-type"
                    style="width:180px;"
                    onchange="changeAttachmentType(this)">

                <option value="file">File</option>
                <option value="link">External Link</option>

            </select>

            <div class="attachment-input" style="flex:1;">

                <input type="file"
                       class="form-control"
                       name="manuscript_files[]">

            </div>

            <button type="button"
                    class="btn btn-danger"
                    onclick="removeAttachment(this)">

                Remove

            </button>

        </div>
    `;

    $('#manuscript_attachments').append(row);

    updateRemoveButtons();

}


/* Remove attachment */

function removeAttachment(button) {

    $(button).closest('.attachment-row').remove();

    updateRemoveButtons();

}


/* Show Remove button only when there is more than one row */

function updateRemoveButtons() {

    var rows = $('#manuscript_attachments .attachment-row');

    if (rows.length > 1) {

        rows.find('.btn-danger').show();

    } else {

        rows.find('.btn-danger').hide();

    }

}


/* Save publication */

function save_publication() {

    var form = $('#pub_form')[0];

    var data = new FormData(form);

    $.ajax({

        type: "POST",

        enctype: 'multipart/form-data',

        url: "qvision/BusinessProcess/publications/publication_submit.php",

        data: data,

        processData: false,

        contentType: false,

        success: function(response) {

            alert("Submitted Successfully");

            back_publication();

        },

        error: function(xhr) {

            alert("Error while submitting the publication.");

            console.log(xhr.responseText);

        }

    });

}

</script>
