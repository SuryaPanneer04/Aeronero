<?php

require '../../../connect.php';

include("../../../user.php");

$userrole = $_SESSION['userrole'];

?>

<div class="card card-primary">

    <div class="card-header">

        <h3 style="float: left;">
            <font size="5">ADD PATENT/DESIGN DETAILS</font>
        </h3>

        <a onclick="back_patent()"
           style="float: right;"
           class="btn btn-dark">
            BACK
        </a>

    </div>


    <form id="patent_form" enctype="multipart/form-data">

        <input type="hidden"
               name="userrole"
               value="<?php echo $userrole; ?>">


        <table class="table table-bordered">


            <!-- DATE -->

            <tr>

                <td>Date</td>

                <td colspan="2">

                    <input type="date"
                           class="form-control"
                           name="date"
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
                           required>

                </td>

            </tr>


            <!-- PATENT DOCUMENT ATTACHMENTS -->

            <tr>

                <td>Patent Document Attachments</td>

                <td colspan="2">


                    <div id="patent_attachments">


                        <!-- FIRST ATTACHMENT -->

                        <div class="patent-attachment-row"
                             style="
                                display:flex;
                                gap:10px;
                                margin-bottom:10px;
                                align-items:center;
                             ">


                            <!-- FILE / LINK -->

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

                        <option value="">
                            -- Select Status --
                        </option>

                        <option value="Processing">
                            Processing
                        </option>

                        <option value="Pending">
                            Pending
                        </option>

                        <option value="Complete">
                            Complete
                        </option>

                    </select>

                </td>

            </tr>


        </table>


        <input type="button"
               value="Submit"
               class="btn btn-primary btn-md"
               style="float:right;"
               onclick="save_patent()">

        <br>
        <br>

    </form>

</div>


<script>


/* ==========================================
   BACK TO PATENT LIST
========================================== */

function back_patent() {

    $.ajax({

        type: "POST",

        url: "qvision/BusinessProcess/patents/patents_list.php",

        success: function(data) {

            $("#main_content").html(data);

        }

    });

}


/* ==========================================
   CHANGE FILE / EXTERNAL LINK
========================================== */

function changePatentAttachmentType(select) {

    var row =
        $(select).closest('.patent-attachment-row');

    var inputDiv =
        row.find('.patent-attachment-input');


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
   ADD ANOTHER ATTACHMENT
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


    $('#patent_attachments').append(row);

}


/* ==========================================
   REMOVE NEW ATTACHMENT
========================================== */

function removePatentAttachment(button) {

    $(button)
        .closest('.patent-attachment-row')
        .remove();

}


/* ==========================================
   SAVE PATENT
========================================== */

function save_patent() {

    var form = $('#patent_form')[0];

    var data = new FormData(form);


    $.ajax({

        type: "POST",

        enctype: "multipart/form-data",

        url: "qvision/BusinessProcess/patents/patent_submit.php",

        data: data,

        processData: false,

        contentType: false,


        success: function(response) {

            if (response.trim() === "Success") {

                alert("Submitted Successfully");

                back_patent();

            } else {

                alert(response);

            }

        },


        error: function(xhr) {

            alert("Error while submitting patent/design.");

            console.log(xhr.responseText);

        }

    });

}

</script>