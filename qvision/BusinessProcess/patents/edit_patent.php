<?php

require '../../../connect.php';

$id = $_GET['id'];

$stmt = $con->prepare("SELECT * FROM patents_master WHERE id = :id");

$stmt->execute([
    ':id' => $id
]);

$res = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="card card-primary">

    <div class="card-header">

        <h3 style="float: left;">
            <font size="5">EDIT PATENT/DESIGN</font>
        </h3>

        <a onclick="back_patent()"
           style="float: right;"
           class="btn btn-dark">
            BACK
        </a>

    </div>


    <form id="patent_edit_form" enctype="multipart/form-data">

        <input type="hidden"
               name="id"
               value="<?php echo $res['id']; ?>">


        <table class="table table-bordered">


            <!-- DATE -->

            <tr>

                <td>Date</td>

                <td colspan="2">

                    <input type="date"
                           class="form-control"
                           name="date"
                           value="<?php echo htmlspecialchars($res['date']); ?>"
                           required>

                </td>

            </tr>


            <!-- TITLE -->

            <tr>

                <td>Title of the Patent/Design</td>

                <td colspan="2">

                    <input type="text"
                           class="form-control"
                           name="title_of_patent"
                           value="<?php echo htmlspecialchars($res['title_of_patent']); ?>"
                           required>

                </td>

            </tr>


            <!-- APPLIED BY -->

            <tr>

                <td>Applied by</td>

                <td colspan="2">

                    <input type="text"
                           class="form-control"
                           name="applied_by"
                           value="<?php echo htmlspecialchars($res['applied_by']); ?>"
                           required>

                </td>

            </tr>


            <!-- ======================================
                 EXISTING + NEW ATTACHMENTS
            ======================================= -->

            <tr>

                <td>Patent Document Attachments</td>

                <td colspan="2">


                    <!-- EXISTING ATTACHMENTS -->

                    <div id="existing_patent_attachments">

                        <?php

                        $existingAttachments = [];


                        if (!empty($res['attach_document'])) {

                            $decodedAttachments =
                                json_decode(
                                    $res['attach_document'],
                                    true
                                );


                            if (is_array($decodedAttachments)) {

                                $existingAttachments =
                                    $decodedAttachments;

                            }

                        }


                        if (!empty($existingAttachments)) {


                            foreach (
                                $existingAttachments
                                as $index => $attachment
                            ) {


                                if (empty($attachment)) {
                                    continue;
                                }


                                /*
                                 * Check whether attachment
                                 * is an external link.
                                 */

                                $isLink =
                                    filter_var(
                                        $attachment,
                                        FILTER_VALIDATE_URL
                                    );


                                if ($isLink) {

                                    $displayName =
                                        $attachment;

                                } else {

                                    $displayName =
                                        basename($attachment);

                                }

                        ?>

                            <div class="existing-patent-attachment"
                                 id="patent_attachment_<?php echo $index; ?>"
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
                                        echo htmlspecialchars(
                                            $displayName
                                        );
                                        ?>

                                    </strong>

                                </span>


                                <!-- VIEW -->

                                <a href="<?php
                                    echo htmlspecialchars(
                                        $attachment
                                    );
                                ?>"
                                   target="_blank"
                                   class="btn btn-info btn-sm">

                                    View

                                </a>


                                <!-- DELETE -->

                                <button type="button"
                                        class="btn btn-danger btn-sm"
                                        onclick="deleteExistingPatentAttachment(
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

                            <div id="no_existing_patent_attachments"
                                 class="text-muted"
                                 style="margin-bottom:10px;">

                                No files uploaded.

                            </div>

                        <?php } ?>

                    </div>


                    <hr>


                    <!-- ADD MORE -->

                    <label>
                        <strong>Add More Attachments</strong>
                    </label>


                    <div id="new_patent_attachments">


                        <!-- FIRST NEW ATTACHMENT -->

                        <div class="patent-attachment-row"
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
                                    onchange="changePatentAttachmentType(this)">

                                <option value="file">
                                    File
                                </option>

                                <option value="link">
                                    External Link
                                </option>

                            </select>


                            <!-- INPUT -->

                            <div class="patent-attachment-input"
                                 style="flex:1;">

                                <input type="file"
                                       class="form-control"
                                       name="patent_files[]">

                            </div>


                            <!-- REMOVE -->

                            <button type="button"
                                    class="btn btn-danger"
                                    onclick="removePatentAttachment(this)"
                                    style="display:none;">

                                Remove

                            </button>

                        </div>


                    </div>


                    <!-- ADD ANOTHER -->

                    <button type="button"
                            class="btn btn-success btn-sm"
                            onclick="addPatentAttachment()">

                        + Add Another

                    </button>


                </td>

            </tr>


            <!-- STATUS -->

            <tr>

                <td>Status</td>

                <td colspan="2">

                    <select class="form-control"
                            name="status"
                            required>

                        <option value="Processing"
                            <?php
                            echo (
                                $res['status'] == 'Processing'
                            )
                            ? 'selected'
                            : '';
                            ?>>
                            Processing
                        </option>


                        <option value="Pending"
                            <?php
                            echo (
                                $res['status'] == 'Pending'
                            )
                            ? 'selected'
                            : '';
                            ?>>
                            Pending
                        </option>


                        <option value="Complete"
                            <?php
                            echo (
                                $res['status'] == 'Complete'
                            )
                            ? 'selected'
                            : '';
                            ?>>
                            Complete
                        </option>

                    </select>

                </td>

            </tr>


        </table>


        <!-- UPDATE -->

        <input type="button"
               value="Update"
               class="btn btn-primary btn-md"
               style="float:right;"
               onclick="update_patent()">


        <br>
        <br>


    </form>

</div>


<script>


/* ==========================================
   BACK
========================================== */

function back_patent() {

    $.ajax({

        type: "POST",

        url:
        "qvision/BusinessProcess/patents/patents_list.php",

        success: function(data) {

            $("#main_content").html(data);

        }

    });

}


/* ==========================================
   CHANGE FILE / LINK
========================================== */

function changePatentAttachmentType(select) {

    var row =
        $(select).closest(
            '.patent-attachment-row'
        );


    var inputDiv =
        row.find(
            '.patent-attachment-input'
        );


    if (select.value === "file") {

        inputDiv.html(
            '<input type="file" ' +
            'class="form-control" ' +
            'name="patent_files[]">'
        );

    } else {

        inputDiv.html(
            '<input type="url" ' +
            'class="form-control" ' +
            'name="patent_links[]" ' +
            'placeholder="https://...">'
        );

    }

}


/* ==========================================
   ADD ANOTHER
========================================== */

function addPatentAttachment() {

    var row = `

        <div class="patent-attachment-row"
             style="
                display:flex;
                gap:10px;
                margin-bottom:10px;
                align-items:center;
             ">


            <select name="attachment_type[]"
                    class="form-control"
                    style="width:180px;"
                    onchange="changePatentAttachmentType(this)">

                <option value="file">
                    File
                </option>

                <option value="link">
                    External Link
                </option>

            </select>


            <div class="patent-attachment-input"
                 style="flex:1;">

                <input type="file"
                       class="form-control"
                       name="patent_files[]">

            </div>


            <button type="button"
                    class="btn btn-danger"
                    onclick="removePatentAttachment(this)">

                Remove

            </button>


        </div>

    `;


    $('#new_patent_attachments').append(row);

}


/* ==========================================
   REMOVE NEW ROW
========================================== */

function removePatentAttachment(button) {

    $(button)
        .closest(
            '.patent-attachment-row'
        )
        .remove();

}


/* ==========================================
   DELETE EXISTING ATTACHMENT
========================================== */

function deleteExistingPatentAttachment(
    id,
    attachmentIndex
) {


    if (
        !confirm(
            "Are you sure you want to delete this attachment?"
        )
    ) {

        return;

    }


    $.ajax({

        type: "POST",

        url:
        "qvision/BusinessProcess/patents/patent_attachment_delete.php",

        data: {

            id: id,

            index: attachmentIndex

        },


        success: function(response) {

            if (
                response.trim() === "Success"
            ) {

                alert(
                    "Attachment deleted successfully."
                );


                $(
                    "#patent_attachment_" +
                    attachmentIndex
                ).remove();


            } else {

                alert(response);

            }

        },


        error: function(xhr) {

            alert(
                "Unable to delete attachment."
            );

            console.log(
                xhr.responseText
            );

        }

    });

}


/* ==========================================
   UPDATE PATENT
========================================== */

function update_patent() {

    var form =
        $('#patent_edit_form')[0];


    var data =
        new FormData(form);


    $.ajax({

        type: "POST",

        enctype: "multipart/form-data",

        url:
        "qvision/BusinessProcess/patents/patent_update.php",

        data: data,

        processData: false,

        contentType: false,


        success: function(response) {

            if (
                response.trim() === "Success"
            ) {

                alert(
                    "Updated Successfully"
                );

                back_patent();

            } else {

                alert(response);

            }

        },


        error: function(xhr) {

            alert(
                "Error while updating patent/design."
            );

            console.log(
                xhr.responseText
            );

        }

    });

}

</script>