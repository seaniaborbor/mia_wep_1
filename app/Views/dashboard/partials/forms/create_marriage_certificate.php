<!-- partials/forms/create_marriage_certificate.php -->
<form action="/matrimonial_dashboard/wedcert/create" method="post" enctype="multipart/form-data" id="marriageForm">
    <?= csrf_field() ?>

    <!-- Flash Messages -->
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i>
            <?= session('success') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <?= session('error') ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    <?php endif; ?>

    <!-- Progress Bar -->
    <div class="card border-left-primary shadow mb-4">
        <div class="card-body py-3">
            <div class="progress" style="height: 10px;">
                <div id="formProgress" class="progress-bar bg-primary" role="progressbar" style="width: 20%;"></div>
            </div>
            <small class="text-muted d-block mt-2">Step <strong id="currentStep">1</strong> of 5</small>
        </div>
    </div>

    <!-- Step 1: Groom -->
    <div class="step" id="step1">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-male mr-2"></i> Groom Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Groom Name <span class="text-danger">*</span></label>
                        <input type="text" name="groom_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Cell <span class="text-danger">*</span></label>
                        <input type="tel" name="groom_cell" class="form-control" pattern="[0-9]{10}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>County of Origin <span class="text-danger">*</span></label>
                        <select name="groom_county_of_origin" class="form-control" required>
                            <option value="">Select County</option>
                            <option>Bomi</option><option>Bong</option><option>Montserrado</option><option>Nimba</option>
                            <!-- Add remaining counties -->
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nationality <span class="text-danger">*</span></label>
                        <input type="text" name="groom_nationality" class="form-control" value="Liberian" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" name="groom_dob" class="form-control" required max="<?= date('Y-m-d', strtotime('-21 years')) ?>">
                        <small class="form-text text-muted">Must be at least 21 years old</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Age</label>
                        <input type="number" name="groom_age" class="form-control" min="21" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Birth City <span class="text-danger">*</span></label>
                        <input type="text" name="groom_birth_city" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Birth County <span class="text-danger">*</span></label>
                        <select name="groom_birth_county" class="form-control" required>
                            <option value="">Select County</option>
                            <option>Bomi</option><option>Bong</option><option>Montserrado</option><option>Nimba</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Address <span class="text-danger">*</span></label>
                        <textarea name="groom_address" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Married Before? <span class="text-danger">*</span></label>
                        <select name="groom_married_before" class="form-control" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-6 conditional-field" data-condition="groom_married_before" data-value="1">
                        <label>When?</label>
                        <input type="date" name="groom_previous_marriage_date" class="form-control">
                    </div>
                    <div class="col-md-6 conditional-field" data-condition="groom_married_before" data-value="1">
                        <label>Previous Spouse Name</label>
                        <input type="text" name="groom_previous_spouse_name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Father's Name <span class="text-danger">*</span></label>
                        <input type="text" name="groom_father_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Mother's Name <span class="text-danger">*</span></label>
                        <input type="text" name="groom_mother_name" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-primary next-step" data-step="1">
                    Next <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Step 2: Bride -->
    <div class="step" id="step2" style="display:none;">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-danger">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-female mr-2"></i> Bride Information
                </h6>
            </div>
            <div class="card-body">
                <!-- Same structure as Groom, only colors and names changed -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Bride Name <span class="text-danger">*</span></label>
                        <input type="text" name="bride_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Cell</label>
                        <input type="tel" name="bride_cell" class="form-control" pattern="[0-9]{10}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>County of Origin <span class="text-danger">*</span></label>
                        <select name="bride_county_of_origin" class="form-control" required>
                            <option value="">Select County</option>
                            <option>Bomi</option><option>Bong</option><option>Montserrado</option><option>Nimba</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nationality <span class="text-danger">*</span></label>
                        <input type="text" name="bride_nationality" class="form-control" value="Liberian" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" name="bride_dob" class="form-control" required max="<?= date('Y-m-d', strtotime('-18 years')) ?>">
                        <small class="form-text text-muted">Must be at least 18 years old</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Age</label>
                        <input type="number" name="bride_age" class="form-control" min="18" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Birth City <span class="text-danger">*</span></label>
                        <input type="text" name="bride_birth_city" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Birth County <span class="text-danger">*</span></label>
                        <select name="bride_birth_county" class="form-control" required>
                            <option value="">Select County</option>
                            <option>Bomi</option><option>Bong</option><option>Montserrado</option><option>Nimba</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Address <span class="text-danger">*</span></label>
                        <textarea name="bride_address" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Married Before? <span class="text-danger">*</span></label>
                        <select name="bride_married_before" class="form-control" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-6 conditional-field" data-condition="bride_married_before" data-value="1">
                        <label>When?</label>
                        <input type="date" name="bride_previous_marriage_date" class="form-control">
                    </div>
                    <div class="col-md-6 conditional-field" data-condition="bride_married_before" data-value="1">
                        <label>Previous Spouse Name</label>
                        <input type="text" name="bride_previous_spouse_name" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Father's Name <span class="text-danger">*</span></label>
                        <input type="text" name="bride_father_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Mother's Name <span class="text-danger">*</span></label>
                        <input type="text" name="bride_mother_name" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left mr-2"></i> Previous</button>
                    <button type="button" class="btn btn-primary next-step" data-step="2">Next <i class="fas fa-arrow-right ml-2"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 3: Photos & Marriage Details -->
    <div class="step" id="step3" style="display:none;">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-info">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-images mr-2"></i> Passport Photos & Marriage Details
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="text-center">
                            <i class="fas fa-male fa-5x text-primary mb-3"></i>
                            <h6>Groom Passport Photo <span class="text-danger">*</span></h6>
                            <input type="file" name="groom_passport_photo" class="form-control" accept="image/*" required>
                            <small class="text-muted">JPG/PNG, Max 2MB</small>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="text-center">
                            <i class="fas fa-female fa-5x text-danger mb-3"></i>
                            <h6>Bride Passport Photo <span class="text-danger">*</span></h6>
                            <input type="file" name="bride_passport_photo" class="form-control" accept="image/*" required>
                            <small class="text-muted">JPG/PNG, Max 2MB</small>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Place of Marriage <span class="text-danger">*</span></label>
                        <input type="text" name="place_of_marriage" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Date of Marriage <span class="text-danger">*</span></label>
                        <input type="date" name="date_of_marriage" class="form-control" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Bride Proposed Name</label>
                        <input type="text" name="bride_proposed_name" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left mr-2"></i> Previous</button>
                    <button type="button" class="btn btn-primary next-step" data-step="3">Next <i class="fas fa-arrow-right ml-2"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 4: Witness & Declaration -->
    <div class="step" id="step4" style="display:none;">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-warning">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-users mr-2"></i> Witness & Declaration
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Witness Name <span class="text-danger">*</span></label>
                        <input type="text" name="witness_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Witness Contact <span class="text-danger">*</span></label>
                        <input type="tel" name="witness_contact" class="form-control" pattern="[0-9]{10}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Officiator Name <span class="text-danger">*</span></label>
                        <input type="text" name="officiator_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Officiator Contact</label>
                        <input type="tel" name="officiator_contact" class="form-control" pattern="[0-9]{10}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Certificate Cost (USD) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" min="0" name="certificate_cost" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Cost in Words <span class="text-danger">*</span></label>
                        <input type="text" name="certificate_cost_words" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Declarant Name <span class="text-danger">*</span></label>
                        <input type="text" name="declarant_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Declaration Date <span class="text-danger">*</span></label>
                        <input type="date" name="declaration_date" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left mr-2"></i> Previous</button>
                    <button type="button" class="btn btn-primary next-step" data-step="4">Next <i class="fas fa-arrow-right ml-2"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Step 5: Final Certification -->
    <div class="step" id="step5" style="display:none;">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-success">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-certificate mr-2"></i> Final Certification
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Revenue Number <span class="text-danger">*</span></label>
                        <input type="text" name="revenue_no" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Certification Date <span class="text-danger">*</span></label>
                        <input type="date" name="certification_day" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left mr-2"></i> Previous</button>
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-check mr-2"></i> Submit Marriage Certificate
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const steps = Array.from(document.querySelectorAll('.step'));
    const progress = document.getElementById('formProgress');
    const stepNum = document.getElementById('currentStep');
    const form = document.getElementById('marriageForm');

    let current = 0;

    /* ==============================
       SHOW STEP
    ============================== */
    function showStep(index) {
        steps.forEach((step, i) => {
            step.style.display = i === index ? 'block' : 'none';
        });

        stepNum.textContent = index + 1;
        progress.style.width = ((index + 1) / steps.length * 100) + '%';
    }

    showStep(current);

    /* ==============================
       VALIDATE A STEP
    ============================== */
    function validateStep(index) {
        let valid = true;

        const requiredFields = steps[index]
            .querySelectorAll('input[required], select[required], textarea[required]');

        requiredFields.forEach(field => {

            // Skip hidden conditional fields
            const conditionalWrapper = field.closest('.conditional-field');
            if (conditionalWrapper && conditionalWrapper.style.display === 'none') {
                field.classList.remove('is-invalid');
                return;
            }

            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                valid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        return valid;
    }

    /* ==============================
       NEXT BUTTON
    ============================== */
    document.querySelectorAll('.next-step').forEach(btn => {
        btn.addEventListener('click', () => {
            if (validateStep(current)) {
                current++;
                showStep(current);
            } else {
                alert('Please fill all required fields.');
            }
        });
    });

    /* ==============================
       PREVIOUS BUTTON
    ============================== */
    document.querySelectorAll('.prev-step').forEach(btn => {
        btn.addEventListener('click', () => {
            current--;
            showStep(current);
        });
    });

    /* ==============================
       CONDITIONAL FIELDS
    ============================== */
    document.querySelectorAll('select[name$="_married_before"]').forEach(select => {
        const fieldName = select.name;
        const conditionalFields = document.querySelectorAll(
            `.conditional-field[data-condition="${fieldName}"]`
        );

        function toggleConditional() {
            conditionalFields.forEach(field => {
                field.style.display = select.value === '1' ? 'block' : 'none';
            });
        }

        select.addEventListener('change', toggleConditional);
        toggleConditional();
    });

    /* ==============================
       AUTO CALCULATE AGE
    ============================== */
    function calculateAge(dob) {
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--;
        }
        return age;
    }

    document.querySelectorAll('input[name="groom_dob"], input[name="bride_dob"]')
        .forEach(input => {
            input.addEventListener('change', () => {
                const dob = new Date(input.value);
                if (isNaN(dob)) return;

                const target =
                    input.name === 'groom_dob' ? 'groom_age' : 'bride_age';

                form.querySelector(`input[name="${target}"]`).value = calculateAge(dob);
            });
        });

    /* ==============================
       FINAL FORM SUBMIT VALIDATION
    ============================== */
    form.addEventListener('submit', e => {
        let allValid = true;

        steps.some((_, i) => {
            if (!validateStep(i)) {
                current = i;
                showStep(i);
                allValid = false;
                return true; // stop loop
            }
            return false;
        });

        if (!allValid) {
            e.preventDefault();
            alert('Please correct the errors before submitting.');
        }
    });

});
</script>
