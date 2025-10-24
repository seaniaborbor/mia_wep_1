<!-- marriage_edit_form.php -->
<form action="/dashboard/wedcert/edit/<?=$certificate['marriage_cert_id']?>" method="post" enctype="multipart/form-data" id="marriageForm">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="post">

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
                <input type="text" name="groom_name" class="form-control" value="<?= old('groom_name', $certificate['groom_name'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Cell</label>
                <input type="tel" name="groom_cell" class="form-control" pattern="[0-9]{10}" value="<?= old('groom_cell', $certificate['groom_cell'] ?? '') ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">County of Origin</label>
                <select name="groom_county_of_origin" class="form-control" required>
                    <?php
                        $counties = [
                            'Bomi',
                            'Bong',
                            'Gbarpolu',
                            'Grand Bassa',
                            'Grand Cape Mount',
                            'Grand Gedeh',
                            'Grand Kru',
                            'Lofa',
                            'Margibi',
                            'Maryland',
                            'Montserrado',
                            'Nimba',
                            'River Cess',
                            'River Gee',
                            'Sinoe'
                        ];
                        $selected_county = old('groom_county_of_origin', $certificate['groom_county_of_origin'] ?? '');
                        foreach ($counties as $county) {
                            $selected = ($selected_county === $county) ? 'selected' : '';
                            echo "<option value=\"{$county}\" {$selected}>{$county}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nationality</label>
                <input type="text" name="groom_nationality" class="form-control" value="<?= old('groom_nationality', $certificate['groom_nationality'] ?? '') ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="groom_dob" class="form-control" value="<?= old('groom_dob', $certificate['groom_dob'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Age</label>
                <input type="number" name="groom_age" class="form-control" min="18" value="<?= old('groom_age', $certificate['groom_age'] ?? '') ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Birth City</label>
                <input type="text" name="groom_birth_city" class="form-control" value="<?= old('groom_birth_city', $certificate['groom_birth_city'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Birth County</label>
                <select name="groom_birth_county" class="form-control" required>
                    <?php
                        $counties = [
                            'Bomi',
                            'Bong',
                            'Gbarpolu',
                            'Grand Bassa',
                            'Grand Cape Mount',
                            'Grand Gedeh',
                            'Grand Kru',
                            'Lofa',
                            'Margibi',
                            'Maryland',
                            'Montserrado',
                            'Nimba',
                            'River Cess',
                            'River Gee',
                            'Sinoe'
                        ];
                        $selected_county = old('groom_birth_county', $certificate['groom_birth_county'] ?? '');
                        foreach ($counties as $county) {
                            $selected = ($selected_county === $county) ? 'selected' : '';
                            echo "<option value=\"{$county}\" {$selected}>{$county}</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="groom_address" class="form-control" required><?= old('groom_address', $certificate['groom_address'] ?? '') ?></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Married Before?</label>
                <select name="groom_married_before" class="form-control" required>
                    <option value="0" <?= (old('groom_married_before', $certificate['groom_married_before'] ?? 0) == 0) ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= (old('groom_married_before', $certificate['groom_married_before'] ?? 0) == 1) ? 'selected' : '' ?>>Yes</option>
                </select>
            </div>
            <div class="col-md-6 mb-3 conditional-field" data-condition="groom_married_before" data-value="1">
                <label class="form-label">When?</label>
                <input type="date" name="groom_previous_marriage_date" class="form-control" value="<?= old('groom_previous_marriage_date', $certificate['groom_previous_marriage_date'] ?? '') ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 conditional-field" data-condition="groom_married_before" data-value="1">
                <label class="form-label">Previous Spouse Name</label>
                <input type="text" name="groom_previous_spouse_name" class="form-control" value="<?= old('groom_previous_spouse_name', $certificate['groom_previous_spouse_name'] ?? '') ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Father's Name</label>
                <input type="text" name="groom_father_name" class="form-control" value="<?= old('groom_father_name', $certificate['groom_father_name'] ?? '') ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Mother's Name</label>
            <input type="text" name="groom_mother_name" class="form-control" value="<?= old('groom_mother_name', $certificate['groom_mother_name'] ?? '') ?>" required>
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
                <input type="text" name="bride_name" class="form-control" value="<?= old('bride_name', $certificate['bride_name'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Cell</label>
                <input type="tel" name="bride_cell" class="form-control" pattern="[0-9]{10}" value="<?= old('bride_cell', $certificate['bride_cell'] ?? '') ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">County of Origin</label>
                <select name="bride_county_of_origin" class="form-control" required>
                    <?php
                        $counties = [
                            'Bomi',
                            'Bong',
                            'Gbarpolu',
                            'Grand Bassa',
                            'Grand Cape Mount',
                            'Grand Gedeh',
                            'Grand Kru',
                            'Lofa',
                            'Margibi',
                            'Maryland',
                            'Montserrado',
                            'Nimba',
                            'River Cess',
                            'River Gee',
                            'Sinoe'
                        ];
                        $selected_county = old('bride_county_of_origin', $certificate['bride_county_of_origin'] ?? '');
                        foreach ($counties as $county) {
                            $selected = ($selected_county === $county) ? 'selected' : '';
                            echo "<option value=\"{$county}\" {$selected}>{$county}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nationality</label>
                <input type="text" name="bride_nationality" class="form-control" value="<?= old('bride_nationality', $certificate['bride_nationality'] ?? '') ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="bride_dob" class="form-control" value="<?= old('bride_dob', $certificate['bride_dob'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Age</label>
                <input type="number" name="bride_age" class="form-control" min="18" value="<?= old('bride_age', $certificate['bride_age'] ?? '') ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Birth City</label>
                <input type="text" name="bride_birth_city" class="form-control" value="<?= old('bride_birth_city', $certificate['bride_birth_city'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Birth County</label>
                <select name="bride_birth_county" class="form-control" required>
                    <?php
                        $counties = [
                            'Bomi',
                            'Bong',
                            'Gbarpolu',
                            'Grand Bassa',
                            'Grand Cape Mount',
                            'Grand Gedeh',
                            'Grand Kru',
                            'Lofa',
                            'Margibi',
                            'Maryland',
                            'Montserrado',
                            'Nimba',
                            'River Cess',
                            'River Gee',
                            'Sinoe'
                        ];
                        $selected_county = old('bride_birth_county', $certificate['bride_birth_county'] ?? '');
                        foreach ($counties as $county) {
                            $selected = ($selected_county === $county) ? 'selected' : '';
                            echo "<option value=\"{$county}\" {$selected}>{$county}</option>";
                        }
                    ?>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="bride_address" class="form-control" required><?= old('bride_address', $certificate['bride_address'] ?? '') ?></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Married Before?</label>
                <select name="bride_married_before" class="form-control" required>
                    <option value="0" <?= (old('bride_married_before', $certificate['bride_married_before'] ?? 0) == 0) ? 'selected' : '' ?>>No</option>
                    <option value="1" <?= (old('bride_married_before', $certificate['bride_married_before'] ?? 0) == 1) ? 'selected' : '' ?>>Yes</option>
                </select>
            </div>
            <div class="col-md-6 mb-3 conditional-field" data-condition="bride_married_before" data-value="1">
                <label class="form-label">When?</label>
                <input type="date" name="bride_previous_marriage_date" class="form-control" value="<?= old('bride_previous_marriage_date', $certificate['bride_previous_marriage_date'] ?? '') ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3 conditional-field" data-condition="bride_married_before" data-value="1">
                <label class="form-label">Previous Spouse Name</label>
                <input type="text" name="bride_previous_spouse_name" class="form-control" value="<?= old('bride_previous_spouse_name', $certificate['bride_previous_spouse_name'] ?? '') ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Father's Name</label>
                <input type="text" name="bride_father_name" class="form-control" value="<?= old('bride_father_name', $certificate['bride_father_name'] ?? '') ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Mother's Name</label>
            <input type="text" name="bride_mother_name" class="form-control" value="<?= old('bride_mother_name', $certificate['bride_mother_name'] ?? '') ?>" required>
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
                <input type="file" name="groom_passport_photo" class="form-control-file" accept="image/*">
                <?php if (!empty($certificate['groom_passport_photo'])): ?>
                    <div class="mt-2">
                        <small class="text-muted">Current Photo:</small>
                        <img src="<?= base_url('uploads/marriage/'.$certificate['groom_passport_photo']) ?>" alt="Groom Photo" class="img-thumbnail" style="max-height: 100px;">
                        <input type="hidden" name="existing_groom_photo" value="<?= $certificate['groom_passport_photo'] ?>">
                    </div>
                <?php endif; ?>
                <small class="form-text text-muted">Leave blank to keep existing photo</small>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Bride Passport Photo</label>
                <input type="file" name="bride_passport_photo" class="form-control-file" accept="image/*">
                <?php if (!empty($certificate['bride_passport_photo'])): ?>
                    <div class="mt-2">
                        <small class="text-muted">Current Photo:</small>
                        <img src="<?= base_url('uploads/marriage/'.$certificate['bride_passport_photo']) ?>" alt="Bride Photo" class="img-thumbnail" style="max-height: 100px;">
                        <input type="hidden" name="existing_bride_photo" value="<?= $certificate['bride_passport_photo'] ?>">
                    </div>
                <?php endif; ?>
                <small class="form-text text-muted">Leave blank to keep existing photo</small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Place of Marriage</label>
                <input type="text" name="place_of_marriage" class="form-control" value="<?= old('place_of_marriage', $certificate['place_of_marriage'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Date of Marriage</label>
                <input type="date" name="date_of_marriage" class="form-control" value="<?= old('date_of_marriage', $certificate['date_of_marriage'] ?? '') ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Bride Proposed Name</label>
            <input type="text" name="bride_proposed_name" class="form-control" value="<?= old('bride_proposed_name', $certificate['bride_proposed_name'] ?? '') ?>">
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
                <input type="text" name="witness_name" class="form-control" value="<?= old('witness_name', $certificate['witness_name'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Witness Contact</label>
                <input type="tel" name="witness_contact" class="form-control" pattern="[0-9]{10}" value="<?= old('witness_contact', $certificate['witness_contact'] ?? '') ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Officiator Name</label>
                <input type="text" name="officiator_name" class="form-control" value="<?= old('officiator_name', $certificate['officiator_name'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Officiator Contact</label>
                <input type="tel" name="officiator_contact" class="form-control" pattern="[0-9]{10}" value="<?= old('officiator_contact', $certificate['officiator_contact'] ?? '') ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Certificate Cost</label>
                <input type="number" step="0.01" min="0" name="certificate_cost" class="form-control" value="<?= old('certificate_cost', $certificate['certificate_cost'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Cost in Words</label>
                <input type="text" name="certificate_cost_words" class="form-control" value="<?= old('certificate_cost_words', $certificate['certificate_cost_words'] ?? '') ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Declarant Name</label>
                <input type="text" name="declarant_name" class="form-control" value="<?= old('declarant_name', $certificate['declarant_name'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Declaration Date</label>
                <input type="date" name="declaration_date" class="form-control" value="<?= old('declaration_date', $certificate['declaration_date'] ?? '') ?>" required>
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
                <input type="text" name="revenue_no" class="form-control" value="<?= old('revenue_no', $certificate['revenue_no'] ?? '') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Certification Date</label>
                <input type="date" name="certification_day" class="form-control" value="<?= old('certification_day', $certificate['certification_day'] ?? '') ?>" required>
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
                <span class="text">Update Form</span>
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