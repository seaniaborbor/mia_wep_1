<?= $this->extend('public/partials/layout') ?>

<?= $this->section('main') ?>

<div class="container">
     <div class="row">
         <div class="col-md-8">
             
            <div class="glass-card p-4 mb-4 hover-3d" data-aos="fade-left">


            <!-- marriage_form.php -->
            <form action="/wedcert/create" method="post" enctype="multipart/form-data" id="marriageForm">
                <?= csrf_field() ?>

                <!-- Progress Bar -->
                <div class="container-fluid mb-4">
                    <div class="progress">
                        <div id="formProgress" class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%"></div>
                    </div>
                </div>

                <!-- Step 1: Groom Info -->
                <div class="step card p-4 mb-4" id="step1">
                    <h5 class="card-title mb-4 text-primary">Groom Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Groom Name</label>
                            <input type="text" name="groom_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cell</label>
                            <input type="tel" name="groom_cell" class="form-control" pattern="[0-9]{10}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">County of Origin</label>
                            <select name="groom_county_of_origin" class="form-control" required>
                                <option value="">Select County</option>
                                <option value="Bomi">Bomi</option>
                                <option value="Bong">Bong</option>
                                <option value="Gbarpolu">Gbarpolu</option>
                                <option value="Grand Bassa">Grand Bassa</option>
                                <option value="Grand Cape Mount">Grand Cape Mount</option>
                                <option value="Grand Gedeh">Grand Gedeh</option>
                                <option value="Grand Kru">Grand Kru</option>
                                <option value="Lofa">Lofa</option>
                                <option value="Margibi">Margibi</option>
                                <option value="Maryland">Maryland</option>
                                <option value="Montserrado">Montserrado</option>
                                <option value="Nimba">Nimba</option>
                                <option value="River Cess">River Cess</option>
                                <option value="River Gee">River Gee</option>
                                <option value="Sinoe">Sinoe</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nationality</label>
                            <input type="text" name="groom_nationality" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="groom_dob" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="groom_age" class="form-control" min="18" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Birth City</label>
                            <input type="text" name="groom_birth_city" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Birth County</label>
                            <select name="groom_birth_county" class="form-control" required>
                                <option value="">Select County</option>
                                <option value="Bomi">Bomi</option>
                                <option value="Bong">Bong</option>
                                <option value="Gbarpolu">Gbarpolu</option>
                                <option value="Grand Bassa">Grand Bassa</option>
                                <option value="Grand Cape Mount">Grand Cape Mount</option>
                                <option value="Grand Gedeh">Grand Gedeh</option>
                                <option value="Grand Kru">Grand Kru</option>
                                <option value="Lofa">Lofa</option>
                                <option value="Margibi">Margibi</option>
                                <option value="Maryland">Maryland</option>
                                <option value="Montserrado">Montserrado</option>
                                <option value="Nimba">Nimba</option>
                                <option value="River Cess">River Cess</option>
                                <option value="River Gee">River Gee</option>
                                <option value="Sinoe">Sinoe</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="groom_address" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Married Before?</label>
                            <select name="groom_married_before" class="form-control" required>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3 conditional-field" data-condition="groom_married_before" data-value="1">
                            <label class="form-label">When?</label>
                            <input type="date" name="groom_previous_marriage_date" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 conditional-field" data-condition="groom_married_before" data-value="1">
                            <label class="form-label">Previous Spouse Name</label>
                            <input type="text" name="groom_previous_spouse_name" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Father's Name</label>
                            <input type="text" name="groom_father_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" name="groom_mother_name" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary btn-icon-split next-step" data-step="1">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Bride Info -->
                <div class="step card p-4 mb-4" id="step2">
                    <h5 class="card-title mb-4 text-primary">Bride Information</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bride Name</label>
                            <input type="text" name="bride_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cell</label>
                            <input type="tel" name="bride_cell" class="form-control" pattern="[0-9]{10}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">County of Origin</label>
                            <select name="bride_county_of_origin" class="form-control" required>
                                <option value="">Select County</option>
                                <option value="Bomi">Bomi</option>
                                <option value="Bong">Bong</option>
                                <option value="Gbarpolu">Gbarpolu</option>
                                <option value="Grand Bassa">Grand Bassa</option>
                                <option value="Grand Cape Mount">Grand Cape Mount</option>
                                <option value="Grand Gedeh">Grand Gedeh</option>
                                <option value="Grand Kru">Grand Kru</option>
                                <option value="Lofa">Lofa</option>
                                <option value="Margibi">Margibi</option>
                                <option value="Maryland">Maryland</option>
                                <option value="Montserrado">Montserrado</option>
                                <option value="Nimba">Nimba</option>
                                <option value="River Cess">River Cess</option>
                                <option value="River Gee">River Gee</option>
                                <option value="Sinoe">Sinoe</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nationality</label>
                            <input type="text" name="bride_nationality" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="bride_dob" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="bride_age" class="form-control" min="18" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Birth City</label>
                            <input type="text" name="bride_birth_city" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Birth County</label>
                            <select name="bride_birth_county" class="form-control" required>
                                <option value="">Select County</option>
                                <option value="Bomi">Bomi</option>
                                <option value="Bong">Bong</option>
                                <option value="Gbarpolu">Gbarpolu</option>
                                <option value="Grand Bassa">Grand Bassa</option>
                                <option value="Grand Cape Mount">Grand Cape Mount</option>
                                <option value="Grand Gedeh">Grand Gedeh</option>
                                <option value="Grand Kru">Grand Kru</option>
                                <option value="Lofa">Lofa</option>
                                <option value="Margibi">Margibi</option>
                                <option value="Maryland">Maryland</option>
                                <option value="Montserrado">Montserrado</option>
                                <option value="Nimba">Nimba</option>
                                <option value="River Cess">River Cess</option>
                                <option value="River Gee">River Gee</option>
                                <option value="Sinoe">Sinoe</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="bride_address" class="form-control" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Married Before?</label>
                            <select name="bride_married_before" class="form-control" required>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3 conditional-field" data-condition="bride_married_before" data-value="1">
                            <label class="form-label">When?</label>
                            <input type="date" name="bride_previous_marriage_date" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3 conditional-field" data-condition="bride_married_before" data-value="1">
                            <label class="form-label">Previous Spouse Name</label>
                            <input type="text" name="bride_previous_spouse_name" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Father's Name</label>
                            <input type="text" name="bride_father_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" name="bride_mother_name" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary btn-icon-split prev-step">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Previous</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-icon-split next-step" data-step="2">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Step 3: Photos & Marriage Details -->
                <div class="step card p-4 mb-4" id="step3">
                    <h5 class="card-title mb-4 text-primary">Passport Photos & Marriage Details</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Groom Passport Photo</label>
                            <input type="file" name="groom_passport_photo" class="form-control-file" accept="image/*" required>
                            <small class="form-text text-muted">Please upload a clear passport photo</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bride Passport Photo</label>
                            <input type="file" name="bride_passport_photo" class="form-control-file" accept="image/*" required>
                            <small class="form-text text-muted">Please upload a clear passport photo</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Place of Marriage</label>
                            <input type="text" name="place_of_marriage" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Marriage</label>
                            <input type="date" name="date_of_marriage" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bride Proposed Name</label>
                        <input type="text" name="bride_proposed_name" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary btn-icon-split prev-step">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Previous</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-icon-split next-step" data-step="3">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Step 4: Witness & Declaration -->
                <div class="step card p-4 mb-4" id="step4">
                    <h5 class="card-title mb-4 text-primary">Witness & Declaration</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Witness Name</label>
                            <input type="text" name="witness_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Witness Contact</label>
                            <input type="tel" name="witness_contact" class="form-control" pattern="[0-9]{10}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Officiator Name</label>
                            <input type="text" name="officiator_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Officiator Contact</label>
                            <input type="tel" name="officiator_contact" class="form-control" pattern="[0-9]{10}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Certificate Cost</label>
                            <input type="number" step="0.01" min="0" name="certificate_cost" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Cost in Words</label>
                            <input type="text" name="certificate_cost_words" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Declarant Name</label>
                            <input type="text" name="declarant_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Declaration Date</label>
                            <input type="date" name="declaration_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary btn-icon-split prev-step">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Previous</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-icon-split next-step" data-step="4">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Step 5: Certification & Signatures -->
                <div class="step card p-4 mb-4" id="step5">
                    <h5 class="card-title mb-4 text-primary">Certification & Approval</h5>
                
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Revenue No.</label>
                            <input type="text" name="revenue_no" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Certification Date</label>
                            <input type="date" name="certification_day" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary btn-icon-split prev-step">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Previous</span>
                        </button>
                        <button type="submit" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Submit Form</span>
                        </button>
                    </div>
                </div>
            </form>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('marriageForm');
                const steps = document.querySelectorAll('.step');
                const progressBar = document.getElementById('formProgress');
                let currentStep = 0;
                
                // Initialize form
                showStep(currentStep);
                updateConditionalFields();
                updateProgress();
                
                // Next step button click handler
                document.querySelectorAll('.next-step').forEach(button => {
                    button.addEventListener('click', function() {
                        const stepNumber = parseInt(this.getAttribute('data-step')) - 1;
                        if (validateStep(stepNumber)) {
                            currentStep++;
                            showStep(currentStep);
                            updateProgress();
                        }
                    });
                });
                
                // Previous step button click handler
                document.querySelectorAll('.prev-step').forEach(button => {
                    button.addEventListener('click', function() {
                        currentStep--;
                        showStep(currentStep);
                        updateProgress();
                    });
                });
                
                // Show specific step
                function showStep(index) {
                    steps.forEach((step, i) => {
                        step.style.display = i === index ? 'block' : 'none';
                    });
                }
                
                // Validate current step before proceeding
                function validateStep(stepIndex) {
                    const currentStepElement = steps[stepIndex];
                    const inputs = currentStepElement.querySelectorAll('input, select, textarea');
                    let isValid = true;
                    
                    inputs.forEach(input => {
                        // Skip validation for hidden conditional fields
                        if (input.closest('.conditional-field') && input.closest('.conditional-field').style.display === 'none') {
                            return;
                        }
                        
                        if (input.hasAttribute('required') && !input.value.trim()) {
                            input.classList.add('is-invalid');
                            isValid = false;
                        } else if (input.type === 'tel' && input.value && !input.checkValidity()) {
                            input.classList.add('is-invalid');
                            isValid = false;
                        } else if (input.type === 'file' && input.required && !input.files.length) {
                            input.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    });
                    
                    if (!isValid) {
                        // Scroll to first invalid field
                        const firstInvalid = currentStepElement.querySelector('.is-invalid');
                        if (firstInvalid) {
                            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                        alert('Please fill in all required fields correctly before proceeding.');
                    }
                    
                    return isValid;
                }
                
                // Update progress bar with animation
                function updateProgress() {
                    const progressPercentage = ((currentStep + 1) / steps.length) * 100;
                    
                    // Remove animation classes temporarily
                    progressBar.classList.remove('progress-bar-striped', 'progress-bar-animated');
                    
                    // Force reflow to restart animation
                    void progressBar.offsetWidth;
                    
                    // Update width
                    progressBar.style.width = progressPercentage + '%';
                    
                    // Add animation classes back
                    progressBar.classList.add('progress-bar-striped', 'progress-bar-animated');
                }
                
                // Update conditional fields based on selections
                function updateConditionalFields() {
                    document.querySelectorAll('select').forEach(select => {
                        select.addEventListener('change', function() {
                            const condition = this.getAttribute('name');
                            const value = this.value;
                            
                            document.querySelectorAll(`.conditional-field[data-condition="${condition}"]`).forEach(field => {
                                if (field.getAttribute('data-value') === value) {
                                    field.style.display = 'block';
                                    field.querySelectorAll('input, select, textarea').forEach(input => {
                                        input.required = true;
                                    });
                                } else {
                                    field.style.display = 'none';
                                    field.querySelectorAll('input, select, textarea').forEach(input => {
                                        input.required = false;
                                    });
                                }
                            });
                        });
                    });
                }
                
                // Form submission handler
                form.addEventListener('submit', function(e) {
                    if (!validateStep(steps.length - 1)) {
                        e.preventDefault();
                        alert('Please fix the errors in the form before submitting.');
                    }
                });
                
                // Initialize any conditional fields on page load
                document.querySelectorAll('select').forEach(select => {
                    const event = new Event('change');
                    select.dispatchEvent(event);
                });
            });
            </script>
            </div>

         </div>




         <div class="col-lg-4 mt-4">
             <!-- Applicant Guidelines Accordion -->
<div class="accordion mt-4" id="applicationGuide">

    <!-- Section 1 -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingIntro">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIntro" aria-expanded="true" aria-controls="collapseIntro">
                <i class="fas fa-info-circle me-2"></i> Before You Begin
            </button>
        </h2>
        <div id="collapseIntro" class="accordion-collapse collapse show" aria-labelledby="headingIntro" data-bs-parent="#applicationGuide">
            <div class="accordion-body">
                <p>
                    This online form allows you to apply for an official <strong>Marriage Certificate</strong> under the 
                    Decentralized Digital Certificate Management System (DDCMS).
                </p>
                <ul class="mb-0">
                    <li>Ensure all personal details are accurate and match your identification documents.</li>
                    <li>All required fields (<span class="text-danger">*</span>) must be filled before proceeding.</li>
                    <li>Prepare clear digital passport photos for both bride and groom before starting.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Section 2 -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingDocs">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDocs" aria-expanded="false" aria-controls="collapseDocs">
                <i class="fas fa-file-upload me-2"></i> Documents & Requirements
            </button>
        </h2>
        <div id="collapseDocs" class="accordion-collapse collapse" aria-labelledby="headingDocs" data-bs-parent="#applicationGuide">
            <div class="accordion-body">
                <ul>
                    <li>National ID or Passport of both bride and groom.</li>
                    <li>Two recent passport-size photos each.</li>
                    <li>Proof of previous marital status (if applicable).</li>
                    <li>Revenue receipt number will be required for certification.</li>
                </ul>
                <p class="mb-0"><strong>Tip:</strong> Uploads must be clear and less than 2MB in size.</p>
            </div>
        </div>
    </div>

    <!-- Section 3 -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingSteps">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSteps" aria-expanded="false" aria-controls="collapseSteps">
                <i class="fas fa-list-ol me-2"></i> Step-by-Step Process
            </button>
        </h2>
        <div id="collapseSteps" class="accordion-collapse collapse" aria-labelledby="headingSteps" data-bs-parent="#applicationGuide">
            <div class="accordion-body">
                <ol class="mb-0">
                    <li>Enter all <strong>Groom Information</strong> and proceed to the next step.</li>
                    <li>Provide <strong>Bride Information</strong> as required.</li>
                    <li>Upload clear passport photos and complete <strong>Marriage Details</strong>.</li>
                    <li>Enter <strong>Witness</strong> and <strong>Declaration</strong> information.</li>
                    <li>Finish with <strong>Certification and Approval</strong> details, then submit.</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Section 4 -->
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingHelp">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHelp" aria-expanded="false" aria-controls="collapseHelp">
                <i class="fas fa-question-circle me-2"></i> Need Help?
            </button>
        </h2>
        <div id="collapseHelp" class="accordion-collapse collapse" aria-labelledby="headingHelp" data-bs-parent="#applicationGuide">
            <div class="accordion-body">
                <p>If you encounter any issue while filling the form:</p>
                <ul>
                    <li>Use the <strong>Ask Assistant</strong> button on the homepage for live guidance.</li>
                    <li>Contact your nearest <strong>County Service Center</strong> for assistance.</li>
                    <li>Double-check all inputs before submission to avoid delays.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

         </div>



     </div>
</div>

<?= $this->endSection() ?>
