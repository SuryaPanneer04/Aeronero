<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><font size="5">Add Referral</font></h3>
    </div>
    <div class="card-body">
        <form id="referralForm" onsubmit="event.preventDefault(); submit_referral();" enctype="multipart/form-data">
            
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Referral Type <span style="color:red">*</span></label>
                <div class="col-sm-6">
                    <select class="form-control" name="referral_type" id="referral_type" onchange="toggleFields()" required>
                        <option value="">Select Type</option>
                        <option value="Candidate">Candidate</option>
                        <option value="Client">Client</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" id="lblName">Name <span style="color:red">*</span></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Mobile</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Location</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="location" id="location" placeholder="Enter Location">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label" id="lblDesigOrCompany">Designation / Company Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="designation_or_company" id="designation_or_company" placeholder="Enter Designation or Company">
                </div>
            </div>

            <div class="form-group row" id="resumeGroup" style="display: none;">
                <label class="col-sm-3 col-form-label">Resume</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control-file" name="resume" id="resume" accept=".pdf,.doc,.docx">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Comments / Notes</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="comments" id="comments" rows="3" placeholder="Enter Comments"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 text-center">
                    <button type="submit" class="btn btn-primary" style="width: 100px;">Submit</button>
                    <button type="reset" class="btn btn-default" style="width: 100px; margin-left: 10px;" onclick="resetFields()">Clear</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function toggleFields() {
    var type = document.getElementById('referral_type').value;
    
    if(type === 'Candidate') {
        document.getElementById('lblName').innerHTML = 'Candidate Name <span style="color:red">*</span>';
        document.getElementById('name').placeholder = 'Enter Candidate Name';
        
        document.getElementById('lblDesigOrCompany').innerHTML = 'Designation';
        document.getElementById('designation_or_company').placeholder = 'Enter Candidate Designation';
        
        document.getElementById('resumeGroup').style.display = 'flex';
    } 
    else if(type === 'Client') {
        document.getElementById('lblName').innerHTML = 'Contact Person Name <span style="color:red">*</span>';
        document.getElementById('name').placeholder = 'Enter Contact Person Name';
        
        document.getElementById('lblDesigOrCompany').innerHTML = 'Company Name';
        document.getElementById('designation_or_company').placeholder = 'Enter Company Name';
        
        document.getElementById('resumeGroup').style.display = 'none';
        document.getElementById('resume').value = ''; // clear file
    } 
    else {
        resetFields();
    }
}

function resetFields() {
    document.getElementById('lblName').innerHTML = 'Name <span style="color:red">*</span>';
    document.getElementById('name').placeholder = 'Enter Name';
    
    document.getElementById('lblDesigOrCompany').innerHTML = 'Designation / Company Name';
    document.getElementById('designation_or_company').placeholder = 'Enter Designation or Company Name';
    
    document.getElementById('resumeGroup').style.display = 'none';
}

function submit_referral() {
    var formData = new FormData(document.getElementById("referralForm"));
    
    $.ajax({
        type: "POST",
        url: "qvision/HR/referral/referral_submit.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            if(data.trim() == "success") {
                alert("Referral submitted successfully.");
                $('#referralForm')[0].reset();
                resetFields();
            } else {
                alert(data);
            }
        },
        error: function() {
            alert("An error occurred while submitting referral.");
        }
    });
}
</script>
