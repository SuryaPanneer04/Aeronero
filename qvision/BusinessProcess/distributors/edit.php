<?php
require_once __DIR__ . '/../../../connect.php';
session_start();

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$stmt = $con->prepare("SELECT * FROM z_distributors WHERE id = ?");
$stmt->execute([$id]);
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$res) {
    echo "<div class='alert alert-danger'>Distributor record not found!</div>";
    exit;
}

// Fetch countries
$countries = $con->query("SELECT id, countries_name FROM countries ORDER BY (countries_name = 'India') DESC, countries_name ASC")->fetchAll(PDO::FETCH_ASSOC);

// If country_id is missing but country name is present, try resolving ID
$country_id = !empty($res['country_id']) ? $res['country_id'] : 0;
if (!$country_id && !empty($res['country'])) {
    $cLookup = $con->prepare("SELECT id FROM countries WHERE countries_name = ? LIMIT 1");
    $cLookup->execute([$res['country']]);
    $country_id = $cLookup->fetchColumn() ?: 0;
}
if (!$country_id) $country_id = 101; // Default India

// If state_id is missing but state name is present, try resolving ID
$state_id = !empty($res['state_id']) ? $res['state_id'] : 0;
if (!$state_id && !empty($res['state'])) {
    $sLookup = $con->prepare("SELECT id FROM states WHERE statename = ? AND country_id = ? LIMIT 1");
    $sLookup->execute([$res['state'], $country_id]);
    $state_id = $sLookup->fetchColumn() ?: 0;
}

// If city_id is missing but city name is present, try resolving ID
$city_id = !empty($res['city_id']) ? $res['city_id'] : 0;
if (!$city_id && !empty($res['city']) && $state_id) {
    $ctLookup = $con->prepare("SELECT id FROM cities WHERE city_name = ? AND state_id = ? LIMIT 1");
    $ctLookup->execute([$res['city'], $state_id]);
    $city_id = $ctLookup->fetchColumn() ?: 0;
}

// Fetch states for this country
$states = [];
if ($country_id) {
    $sStmt = $con->prepare("SELECT id, statename FROM states WHERE country_id = ? ORDER BY statename ASC");
    $sStmt->execute([$country_id]);
    $states = $sStmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch cities for this state
$cities = [];
if ($state_id) {
    $ctStmt = $con->prepare("SELECT id, city_name FROM cities WHERE state_id = ? ORDER BY city_name ASC");
    $ctStmt->execute([$state_id]);
    $cities = $ctStmt->fetchAll(PDO::FETCH_ASSOC);
}

$distributor_contact = !empty($res['distributor_contact_no']) ? $res['distributor_contact_no'] : $res['contact_no'];
$contact_person_phone = !empty($res['contact_person_no']) ? $res['contact_person_no'] : '';
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
            <i class="fa fa-edit mr-2" style="color: #FBC710;"></i> Edit Distributor
        </h3>
    </div>
    <form role="form" name="edit_distributor_form" id="edit_distributor_form" method="post">
        <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
        <!-- Hidden name fields for country, state, city -->
        <input type="hidden" name="country" id="edit_country_name" value="<?php echo htmlspecialchars($res['country']); ?>">
        <input type="hidden" name="state" id="edit_state_name" value="<?php echo htmlspecialchars($res['state']); ?>">
        <input type="hidden" name="city" id="edit_city_name" value="<?php echo htmlspecialchars($res['city']); ?>">

        <div class="card-body">
            
            <!-- 1) Distributor Name & 2) Distributor Contact No -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;">1. Distributor Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="distributor_name" id="distributor_name" value="<?php echo htmlspecialchars($res['distributor_name']); ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;">2. Distributor Contact No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="distributor_contact_no" id="distributor_contact_no" value="<?php echo htmlspecialchars($distributor_contact); ?>" required>
                    </div>
                </div>
            </div>

            <!-- 3) Location Section (Country, State, City, Specific Location) -->
            <div class="location-box">
                <div class="form-section-title">
                    <i class="fa fa-map-marker-alt" style="color: #ef4444;"></i> 3. Location (Search & Select)
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label style="font-weight: 600; color: #334155;">Country <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="country_id" id="edit_country_id" required style="width: 100%;">
                                <option value="">-- Select Country --</option>
                                <?php foreach($countries as $c): ?>
                                    <option value="<?php echo $c['id']; ?>" data-name="<?php echo htmlspecialchars($c['countries_name']); ?>" <?php if($c['id'] == $country_id) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($c['countries_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label style="font-weight: 600; color: #334155;">State <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="state_id" id="edit_state_id" required style="width: 100%;">
                                <option value="">-- Select State --</option>
                                <?php foreach($states as $s): ?>
                                    <option value="<?php echo $s['id']; ?>" data-name="<?php echo htmlspecialchars($s['statename']); ?>" <?php if($s['id'] == $state_id) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($s['statename']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label style="font-weight: 600; color: #334155;">City <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="city_id" id="edit_city_id" required style="width: 100%;">
                                <option value="">-- Select City --</option>
                                <?php foreach($cities as $ct): ?>
                                    <option value="<?php echo $ct['id']; ?>" data-name="<?php echo htmlspecialchars($ct['city_name']); ?>" <?php if($ct['id'] == $city_id) echo 'selected'; ?>>
                                        <?php echo htmlspecialchars($ct['city_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label style="font-weight: 600; color: #334155;">Specific Location / Street Address</label>
                            <textarea class="form-control" name="location" id="location" rows="2" placeholder="Street address, building, industrial area, or landmark..."><?php echo htmlspecialchars($res['location']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4) Contact Person & 5) Contact Person No -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;">4. Contact Person <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contact_person" id="contact_person" value="<?php echo htmlspecialchars($res['contact_person']); ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;">5. Contact Person No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="contact_person_no" id="contact_person_no" value="<?php echo htmlspecialchars($contact_person_phone); ?>" placeholder="Enter Contact Person Mobile No" required>
                    </div>
                </div>
            </div>

            <!-- 6) Email ID & Status -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;">6. Email ID <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo htmlspecialchars($res['email']); ?>" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label style="font-weight: 600; color: #334155;">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Active" <?php if($res['status'] == 'Active') echo 'selected'; ?>>Active</option>
                            <option value="Inactive" <?php if($res['status'] == 'Inactive') echo 'selected'; ?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer" style="background-color: #f8fafc; border-top: 1px solid #e2e8f0;">
            <button type="submit" name="submit" id="submit" class="btn btn-primary" style="background-color: #009EE3; border-color: #009EE3; padding: 7px 22px; font-weight: 500;">
                <i class="fa fa-save mr-1"></i> Update
            </button>
            <a onclick="distributors()" class="btn btn-default" style="padding: 7px 22px; cursor: pointer;">Cancel</a>
        </div>
    </form>
</div>

<script src="plugins/select2/js/select2.full.min.js"></script>
<script>
$(document).ready(function() {
    if ($.fn.select2) {
        $('.select2').select2({
            width: '100%'
        });
    }

    function loadEditStates(countryId, selectedStateId = 0) {
        if (!countryId) {
            $('#edit_state_id').html('<option value="">-- Select State --</option>');
            $('#edit_city_id').html('<option value="">-- Select City --</option>');
            if ($.fn.select2) {
                $('#edit_state_id').trigger('change.select2');
                $('#edit_city_id').trigger('change.select2');
            }
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/distributors/get_states.php',
            data: { country_id: countryId, selected_id: selectedStateId },
            success: function(data) {
                $('#edit_state_id').html(data);
                if ($.fn.select2) $('#edit_state_id').trigger('change.select2');
                
                var currentVal = $('#edit_state_id').val();
                if (currentVal) {
                    loadEditCities(currentVal);
                } else {
                    $('#edit_city_id').html('<option value="">-- Select City --</option>');
                    if ($.fn.select2) $('#edit_city_id').trigger('change.select2');
                }
            }
        });
    }

    function loadEditCities(stateId, selectedCityId = 0) {
        if (!stateId) {
            $('#edit_city_id').html('<option value="">-- Select City --</option>');
            if ($.fn.select2) $('#edit_city_id').trigger('change.select2');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/distributors/get_cities.php',
            data: { state_id: stateId, selected_id: selectedCityId },
            success: function(data) {
                $('#edit_city_id').html(data);
                if ($.fn.select2) $('#edit_city_id').trigger('change.select2');
            }
        });
    }

    $('#edit_country_id').on('change', function() {
        var cId = $(this).val();
        var cName = $(this).find('option:selected').data('name') || $(this).find('option:selected').text();
        $('#edit_country_name').val($.trim(cName));
        loadEditStates(cId);
    });

    $('#edit_state_id').on('change', function() {
        var sId = $(this).val();
        var sName = $(this).find('option:selected').data('name') || $(this).find('option:selected').text();
        $('#edit_state_name').val($.trim(sName));
        loadEditCities(sId);
    });

    $('#edit_city_id').on('change', function() {
        var ctName = $(this).find('option:selected').data('name') || $(this).find('option:selected').text();
        $('#edit_city_name').val($.trim(ctName));
    });

    $('#edit_distributor_form').on('submit', function(e) {
        e.preventDefault();

        var cOpt = $('#edit_country_id option:selected');
        if (cOpt.length && cOpt.val()) $('#edit_country_name').val(cOpt.data('name') || cOpt.text());
        var sOpt = $('#edit_state_id option:selected');
        if (sOpt.length && sOpt.val()) $('#edit_state_name').val(sOpt.data('name') || sOpt.text());
        var ctOpt = $('#edit_city_id option:selected');
        if (ctOpt.length && ctOpt.val()) $('#edit_city_name').val(ctOpt.data('name') || ctOpt.text());

        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'qvision/BusinessProcess/distributors/update.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                distributors();
            },
            error: function() {
                alert("An error occurred while updating. Please try again.");
            }
        });
    });
});
</script>
