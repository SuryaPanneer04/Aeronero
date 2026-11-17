<?php
	require_once __DIR__ . '/../../../connect.php';
?>

<style>
.card-primary:not(.card-outline)>.card-header {
	background-color: #009EE3 !important;
	color: #ffffff !important;
}
.card-primary:not(.card-outline)>.card-header h4 {
	color: #ffffff !important;
	font-weight: 600;
	margin: 0;
	padding: 5px 0;
}
.filter-box {
	background: #f8f9fa;
	border: 1px solid #e3e6f0;
	border-radius: 6px;
	padding: 15px;
	margin-bottom: 20px;
}
.filter-box label {
	font-weight: 600;
	color: #333333;
	margin-bottom: 5px;
	display: block;
}
</style>

<div class="card card-primary">
    <div class="card-header">
        <div class="col-lg-12">
            <h4><i class="fa fa-phone"></i> Enquiry Report</h4>
        </div>
    </div>

    <div class="card-body">
        <div class="filter-box">
            <form id="enquiry_report_form" method="GET" role="form" onsubmit="event.preventDefault(); enquiryview();">
                <div class="row align-items-end">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="form-group mb-2">
                            <label for="from_date"><i class="fa fa-calendar"></i> From Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="form-group mb-2">
                            <label for="to_date"><i class="fa fa-calendar"></i> To Date</label>
                            <input type="date" name="to_date" id="to_date" class="form-control" value="">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-4 col-sm-12">
                        <div class="form-group mb-2" style="margin-top: 26px;">
                            <button type="button" class="btn btn-primary" onclick="enquiryview()" style="background-color: #009EE3; border-color: #009EE3; font-weight: 600;">
                                <i class="fa fa-search"></i> Search
                            </button>
                            <button type="button" class="btn btn-default" onclick="resetEnquiryFilter()" style="margin-left: 6px; font-weight: 600; border: 1px solid #ced4da;">
                                <i class="fa fa-refresh"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div id="enquiry_report_view">
            <!-- Report content loaded via AJAX -->
        </div>
    </div>
</div>

<script>
function enquiryview() {
    var fromDate = $('#from_date').val();
    var toDate = $('#to_date').val();

    if (fromDate && toDate && fromDate > toDate) {
        alert("From Date cannot be greater than To Date!");
        $('#from_date').focus();
        return false;
    }

    $("#enquiry_report_view").html(
        '<div style="text-align:center; padding: 40px;">' +
        '<i class="fa fa-spinner fa-spin fa-3x" style="color:#009EE3;"></i>' +
        '<p style="margin-top: 15px; font-weight: bold; color: #555;">Loading Enquiry Report...</p>' +
        '</div>'
    );

    var data = $('#enquiry_report_form').serialize();
    $.ajax({
        type: "GET",
        url: "qvision/reports/enquiry_report/enquiryreports.php",
        data: data,
        success: function(data) {
            $("#enquiry_report_view").html(data);
        },
        error: function(xhr, status, error) {
            $("#enquiry_report_view").html(
                '<div class="alert alert-danger" style="margin-top: 20px;">' +
                '<i class="fa fa-exclamation-triangle"></i> Failed to load report. Please try again.' +
                '</div>'
            );
        }
    });
}

function resetEnquiryFilter() {
    $('#from_date').val('');
    $('#to_date').val('');
    enquiryview();
}

// Automatically load report when page loads
$(document).ready(function() {
    enquiryview();
});
</script>