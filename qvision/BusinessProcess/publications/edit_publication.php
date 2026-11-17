<?php
require '../../../connect.php';
$id = $_GET['id'];
$stmt = $con->prepare("SELECT * FROM publications_master WHERE id = :id");
$stmt->execute([':id' => $id]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 style="float: left;"><font size="5">EDIT PUBLICATION</font></h3>
        <a onclick="back_publication()" style="float: right;" class="btn btn-dark">BACK</a>
    </div>

    <form id="pub_edit_form" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
        
        <table class="table table-bordered">
            <tr>
                <td>Date</td>
                <td colspan="2"><input type="date" class="form-control" name="date" value="<?php echo $res['date']; ?>"></td>
            </tr>
            <tr>
                <td>Title of the Manuscript</td>
                <td colspan="2"><input type="text" class="form-control" name="title_of_manuscript" value="<?php echo $res['title_of_manuscript']; ?>"></td>
            </tr>
            <tr>
                <td>Prepared BY</td>
                <td colspan="2"><input type="text" class="form-control" name="prepared_by" value="<?php echo $res['prepared_by']; ?>"></td>
            </tr>
            <tr>
                <td>Journal Name</td>
                <td colspan="2"><input type="text" class="form-control" name="journal_name" value="<?php echo $res['journal_name']; ?>"></td>
            </tr>
            <tr>
    <td>Manuscript Attachments</td>

    <td colspan="2">

        <!-- EXISTING ATTACHMENTS -->
        <div id="existing_attachments">

            <?php

            $existingAttachments = [];

            if (!empty($res['attach_manuscript'])) {

                $decodedAttachments = json_decode(
                    $res['attach_manuscript'],
                    true
                );

                if (is_array($decodedAttachments)) {
                    $existingAttachments = $decodedAttachments;
                }
            }


            if (!empty($existingAttachments)) {

                foreach ($existingAttachments as $index => $attachment) {

                    if (empty($attachment)) {
                        continue;
                    }


                    /*
                     * Check whether this is an external link
                     * or an uploaded file.
                     */

                    $isLink = (
                        filter_var($attachment, FILTER_VALIDATE_URL)
                    );


                    if ($isLink) {

                        $displayName = $attachment;

                    } else {

                        $displayName = basename($attachment);
                    }

            ?>

                    <div class="existing-attachment"
                         id="attachment_<?php echo $index; ?>"
                         style="
                            display:flex;
                            align-items:center;
                            gap:10px;
                            padding:10px;
                            margin-bottom:8px;
                            border:1px solid #ddd;
                            border-radius:5px;
                            background:#f8f9fa;
                         ">

                        <span style="flex:1;">

                            <?php if ($isLink) { ?>

                                🔗

                            <?php } else { ?>

                                📎

                            <?php } ?>

                            <strong>
                                <?php
                                echo htmlspecialchars($displayName);
                                ?>
                            </strong>

                        </span>


                        <!-- VIEW -->
                        <a href="<?php echo htmlspecialchars($attachment); ?>"
                           target="_blank"
                           class="btn btn-info btn-sm">

                            View

                        </a>


                        <!-- DELETE -->
                        <button type="button"
                                class="btn btn-danger btn-sm"
                                onclick="deleteExistingAttachment(
                                    <?php echo $res['id']; ?>,
                                    <?php echo $index; ?>
                                )">

                            Delete

                        </button>

                    </div>

            <?php

                }

            } else {

            ?>

                <div id="no_existing_attachments"
                     class="text-muted"
                     style="margin-bottom:10px;">

                    No files uploaded.

                </div>

            <?php } ?>

        </div>


        <!-- ADD NEW ATTACHMENTS -->

        <hr>

        <label>
            <strong>Add More Attachments</strong>
        </label>


        <div id="new_attachments">

            <div class="attachment-row"
                 style="
                    display:flex;
                    gap:10px;
                    margin-bottom:10px;
                    align-items:center;
                 ">


                <!-- TYPE -->

                <select name="attachment_type[]"
                        class="form-control"
                        style="width:180px;"
                        onchange="changeAttachmentType(this)">

                    <option value="file">
                        File
                    </option>

                    <option value="link">
                        External Link
                    </option>

                </select>


                <!-- INPUT -->

                <div class="attachment-input"
                     style="flex:1;">

                    <input type="file"
                           class="form-control"
                           name="manuscript_files[]">

                </div>


                <!-- REMOVE -->

                <button type="button"
                        class="btn btn-danger"
                        onclick="removeAttachment(this)"
                        style="display:none;">

                    Remove

                </button>

            </div>

        </div>


        <!-- ADD ANOTHER -->

        <button type="button"
                class="btn btn-success btn-sm"
                onclick="addAttachment()">

            + Add Another

        </button>

    </td>
</tr>
            <tr>
                <td>Communication Date</td>
                <td colspan="2"><input type="date" class="form-control" name="communication_date" value="<?php echo $res['communication_date']; ?>"></td>
            </tr>
            <tr>
    <td>Status</td>

    <td colspan="2">

        <select class="form-control"
                name="status"
                required>

            <option value="Processing"
                <?php
                echo ($res['status'] == 'Processing')
                    ? 'selected'
                    : '';
                ?>>
                Processing
            </option>

            <option value="Pending"
                <?php
                echo ($res['status'] == 'Pending')
                    ? 'selected'
                    : '';
                ?>>
                Pending
            </option>

            <option value="Complete"
                <?php
                echo ($res['status'] == 'Complete')
                    ? 'selected'
                    : '';
                ?>>
                Complete
            </option>

        </select>

    </td>
</tr>
        </table>
        <input type="button" value="Update" class="btn btn-primary btn-md" style="float:right;" onclick="update_publication()">
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


/* ==========================================
   CHANGE FILE / EXTERNAL LINK
========================================== */

function changeAttachmentType(select) {

    var row = $(select).closest('.attachment-row');

    var inputDiv = row.find('.attachment-input');


    if (select.value === "file") {

        inputDiv.html(
            '<input type="file" ' +
            'class="form-control" ' +
            'name="manuscript_files[]">'
        );

    } else {

        inputDiv.html(
            '<input type="url" ' +
            'class="form-control" ' +
            'name="manuscript_links[]" ' +
            'placeholder="https://...">'
        );

    }

}


/* ==========================================
   ADD ANOTHER ATTACHMENT
========================================== */

function addAttachment() {

    var row = `
        <div class="attachment-row"
             style="
                display:flex;
                gap:10px;
                margin-bottom:10px;
                align-items:center;
             ">

            <select name="attachment_type[]"
                    class="form-control"
                    style="width:180px;"
                    onchange="changeAttachmentType(this)">

                <option value="file">
                    File
                </option>

                <option value="link">
                    External Link
                </option>

            </select>


            <div class="attachment-input"
                 style="flex:1;">

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


    $('#new_attachments').append(row);

}


/* ==========================================
   REMOVE NEW ATTACHMENT ROW
========================================== */

function removeAttachment(button) {

    $(button)
        .closest('.attachment-row')
        .remove();

}


/* ==========================================
   DELETE EXISTING ATTACHMENT
========================================== */

function deleteExistingAttachment(id, attachmentIndex) {

    if (!confirm("Are you sure you want to delete this attachment?")) {
        return;
    }

    $.ajax({

        type: "POST",

        url: "qvision/BusinessProcess/publications/publication_attachment_delete.php",

        data: {
            id: id,
            index: attachmentIndex
        },

        success: function(response) {

            response = response.trim();

            console.log("Delete response:", response);

            if (response === "Success") {

                alert("Attachment deleted successfully.");

                $("#attachment_" + attachmentIndex).fadeOut(
                    300,
                    function() {
                        $(this).remove();
                    }
                );

            } else {

                alert(response);

            }
        },

        error: function(xhr, status, error) {

            console.log("AJAX Status:", status);

            console.log("AJAX Error:", error);

            console.log("Server Response:", xhr.responseText);

            alert(
                "Unable to delete attachment.\n\n" +
                "Server response: " +
                xhr.responseText
            );

        }

    });
}


/* ==========================================
   UPDATE PUBLICATION
========================================== */

function update_publication() {

    var form = $('#pub_edit_form')[0];

    var data = new FormData(form);


    $.ajax({

        type: "POST",

        enctype: "multipart/form-data",

        url:
        "qvision/BusinessProcess/publications/publication_update.php",

        data: data,

        processData: false,

        contentType: false,


        success: function(response) {

            if (response.trim() === "Success") {

                alert("Updated Successfully");

                back_publication();

            } else {

                alert(response);

            }

        },


        error: function(xhr) {

            alert("Error while updating publication.");

            console.log(xhr.responseText);

        }

    });

}

</script>
