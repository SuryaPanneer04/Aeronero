<?php
require_once __DIR__ . '/../../../connect.php';
session_start();

// Fetch countries, prioritizing India at top
$countries = $con->query("SELECT id, countries_name, phonecode FROM countries ORDER BY (countries_name = 'India') DESC, countries_name ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
        border: 1px solid #ced4da !important;
        border-radius: 4px !important;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 26px !important;
        color: #495057 !important;
        padding-left: 8px !important;
    }
    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
    }
    .location-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 18px;
        margin-bottom: 20px;
        margin-top: 5px;
    }
    .form-section-title {
        color: #009EE3;
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
</style>

<div class="card card-primary" style="box-shadow: 0 4px 15px rgba(0,0,0,0.08); border-radius: 8px;">
    <div class="card-header" style="background: linear-gradient(135deg, #009EE3 0%, #007bb5 100%); color: white; border-radius: 8px 8px 0 0; padding: 12px 20px;">
        <h3 class="card-title" style="font-weight: 600; margin: 0; font-size: 1.25rem;">
            <i class="fa fa-user-plus mr-2" style="color: #FBC710;"></i> New Distributor
        </h3>
    </div>
    <form role="form" name="distributor_form" id="distributor_form" method="post">
        <!-- Hidden name fields for country, state, city -->
        <input type="hidden" name="country" id="country_name" value="India">
        <input type="hidden" name="state" id="state_name" value="">
        <input type="hidden" name="city" id="city_name" value="">

        <div class="card-body">
            
            <!-- 1) Distributor Name & 2) Distributor Contact No -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;"> Distributor Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="distributor_name" id="distributor_name" placeholder="Enter Distributor Name" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;"> Distributor Contact No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="distributor_contact_no" id="distributor_contact_no" placeholder="Enter Distributor Phone / Mobile No" required>
                    </div>
                </div>
            </div>

            <!-- 3) Location Section (Country, State, City, Location Address) -->
            <div class="location-box">
                <div class="form-section-title">
                    <i class="fa fa-map-marker-alt" style="color: #ef4444;"></i>  Location (Search & Select)
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label style="font-weight: 600; color: #334155;">Country <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="country_id" id="country_id" required style="width: 100%;">
                                <option value="">-- Select Country --</option>
                                <?php foreach($countries as $c): ?>
                                    <option value="<?php echo $c['id']; ?>" data-name="<?php echo htmlspecialchars($c['countries_name']); ?>" <?php if($c['countries_name'] == 'India') echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($c['countries_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label style="font-weight: 600; color: #334155;">State <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="state_id" id="state_id" required style="width: 100%;">
                                <option value="">-- Select State --</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label style="font-weight: 600; color: #334155;">City <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="city_id" id="city_id" required style="width: 100%;">
                                <option value="">-- Select City --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-weight: 600; color: #334155;">Specific Location / Street Address</label>
                            <textarea class="form-control" name="location" id="location" rows="2" placeholder="Street address, building, industrial area, or landmark..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4) Contact Person & 5) Contact Person No -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;"> Contact Person <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Enter Contact Person Name" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;"> Contact Person No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contact_person_no" id="contact_person_no" placeholder="Enter Contact Person Mobile No" required>
                    </div>
                </div>
            </div>

            <!-- 6) Email ID & Status -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;"> Email ID <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email Address" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Active" selected>Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
            <button type="submit" name="submit" id="submit" class="btn btn-primary" style="background-color: #009EE3; border-color: #009EE3; padding: 7px 22px; font-weight: 500;">
                <i class="fa fa-check mr-1"></i> Submit
            </button>
            <a onclick="distributors()" class="btn btn-default" style="padding: 7px 22px; cursor: pointer;">Cancel</a>
        </div>
    </form>
</div>

<!-- Load Select2 JS -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
$(document).ready(function() {
    if ($.fn.select2) {
        $('.select2').select2({
            width: '100%'
        });
    }

    function loadStates(countryId, selectedStateId = 0) {
        if (!countryId) {
            $('#state_id').html('<option value="">-- Select State --</option>');
            $('#city_id').html('<option value="">-- Select City --</option>');
            if ($.fn.select2) {
                $('#state_id').trigger('change.select2');
                $('#city_id').trigger('change.select2');
            }
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/distributors/get_states.php',
            data: { country_id: countryId, selected_id: selectedStateId },
            success: function(data) {
                $('#state_id').html(data);
                if ($.fn.select2) $('#state_id').trigger('change.select2');
                
                var currentVal = $('#state_id').val();
                if (currentVal) {
                    loadCities(currentVal);
                } else {
                    $('#city_id').html('<option value="">-- Select City --</option>');
                    if ($.fn.select2) $('#city_id').trigger('change.select2');
                }
            }
        });
    }

    function loadCities(stateId, selectedCityId = 0) {
        if (!stateId) {
            $('#city_id').html('<option value="">-- Select City --</option>');
            if ($.fn.select2) $('#city_id').trigger('change.select2');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/distributors/get_cities.php',
            data: { state_id: stateId, selected_id: selectedCityId },
            success: function(data) {
                $('#city_id').html(data);
                if ($.fn.select2) $('#city_id').trigger('change.select2');
            }
        });
    }

    $('#country_id').on('change', function() {
        var cId = $(this).val();
        var cName = $(this).find('option:selected').data('name') || $(this).find('option:selected').text();
        $('#country_name').val($.trim(cName));
        loadStates(cId);
    });

    $('#state_id').on('change', function() {
        var sId = $(this).val();
        var sName = $(this).find('option:selected').data('name') || $(this).find('option:selected').text();
        $('#state_name').val($.trim(sName));
        loadCities(sId);
    });

    $('#city_id').on('change', function() {
        var ctName = $(this).find('option:selected').data('name') || $(this).find('option:selected').text();
        $('#city_name').val($.trim(ctName));
    });

    var initialCountry = $('#country_id').val();
    if (initialCountry) {
        var cName = $('#country_id').find('option:selected').data('name') || $('#country_id').find('option:selected').text();
        $('#country_name').val($.trim(cName));
        loadStates(initialCountry);
    }

    $('#distributor_form').on('submit', function(e) {
        e.preventDefault();

        var cOpt = $('#country_id option:selected');
        if (cOpt.length && cOpt.val()) $('#country_name').val(cOpt.data('name') || cOpt.text());
        var sOpt = $('#state_id option:selected');
        if (sOpt.length && sOpt.val()) $('#state_name').val(sOpt.data('name') || sOpt.text());
        var ctOpt = $('#city_id option:selected');
        if (ctOpt.length && ctOpt.val()) $('#city_name').val(ctOpt.data('name') || ctOpt.text());

        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/distributors/submit.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                distributors();
            },
            error: function() {
                alert("An error occurred while saving. Please try again.");
            }
        });
    });
});
</script>
