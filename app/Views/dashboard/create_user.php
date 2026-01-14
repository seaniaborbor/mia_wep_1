<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-plus mr-2 text-primary"></i>Create New User Account
        </h1>
        <div>
            <a href="/system_admin/users" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50 mr-1"></i> Back to Users
            </a>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <?= session('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <?= session('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-user-plus mr-1"></i> Register New Staff Member
                    </h6>
                </div>
                <div class="card-body">
                    <form action="/system_admin/users/create" method="post" enctype="multipart/form-data" id="userCreateForm">
                        <?= csrf_field() ?>

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Full Name -->
                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">Full Name</label>
                                    <input type="text" name="userFullName" class="form-control <?= validation_show_error('userFullName') ? 'is-invalid' : '' ?>"
                                           value="<?= old('userFullName') ?>" placeholder="Enter full name" required>
                                    <?php if (validation_show_error('userFullName')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userFullName') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">Email Address</label>
                                    <input type="email" name="userEmail" class="form-control <?= validation_show_error('userEmail') ? 'is-invalid' : '' ?>"
                                           value="<?= old('userEmail') ?>" placeholder="staff@example.gov.lr" required>
                                    <?php if (validation_show_error('userEmail')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userEmail') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">Phone Number</label>
                                    <input type="tel" name="userPhone" class="form-control <?= validation_show_error('userPhone') ? 'is-invalid' : '' ?>"
                                           value="<?= old('userPhone') ?>" placeholder="+231 XXX XXX XXX">
                                    <?php if (validation_show_error('userPhone')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userPhone') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Position -->
                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">Position</label>
                                    <input type="text" name="userPosition" class="form-control <?= validation_show_error('userPosition') ? 'is-invalid' : '' ?>"
                                           value="<?= old('userPosition') ?>" placeholder="e.g. Senior Registrar">
                                    <?php if (validation_show_error('userPosition')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userPosition') ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Department -->
                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">Department</label>
                                    <select name="userDepartment" id="userDepartment" class="form-control <?= validation_show_error('userDepartment') ? 'is-invalid' : '' ?>" required>
                                        <option value="">Select Department</option>
                                        <option value="Registrar" <?= old('userDepartment') == 'Registrar' ? 'selected' : '' ?>>Registrar</option>
                                        <option value="Matrimonial" <?= old('userDepartment') == 'Matrimonial' ? 'selected' : '' ?>>Matrimonial</option>
                                        <option value="Cultural" <?= old('userDepartment') == 'Cultural' ? 'selected' : '' ?>>Cultural</option>
                                        <option value="System-Admin" <?= old('userDepartment') == 'System-Admin' ? 'selected' : '' ?>>System Admin</option>
                                    </select>
                                    <?php if (validation_show_error('userDepartment')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userDepartment') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">Password</label>
                                    <input type="password" name="userPassword" class="form-control <?= validation_show_error('userPassword') ? 'is-invalid' : '' ?>" 
                                           placeholder="Enter strong password" required>
                                    <?php if (validation_show_error('userPassword')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userPassword') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Branch -->
                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">Branch</label>
                                    <select name="userBreanch" class="form-control <?= validation_show_error('userBreanch') ? 'is-invalid' : '' ?>" required>
                                        <option value="">Select Branch</option>
                                        <?php if (isset($branches) && is_array($branches)): ?>
                                            <?php foreach ($branches as $branch): ?>
                                                <option value="<?= esc($branch['branchId']) ?>" <?= old('userBreanch') == $branch['branchId'] ? 'selected' : '' ?>>
                                                    <?= esc($branch['branchName']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php if (validation_show_error('userBreanch')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userBreanch') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Account Type -->
                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">Account Type</label>
                                    <select name="userAccountType" id="userAccountType" class="form-control <?= validation_show_error('userAccountType') ? 'is-invalid' : '' ?>" required>
                                        <option value="">Select Account Type</option>
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                    <?php if (validation_show_error('userAccountType')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userAccountType') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Account Status -->
                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">Account Status</label>
                                    <select name="userAccountActiveStatus" class="form-control">
                                        <option value="1" <?= old('userAccountActiveStatus', '1') == '1' ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= old('userAccountActiveStatus') == '0' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- File Uploads -->
                        <div class="mt-4">
                            <h5 class="font-weight-bold text-gray-800 mb-3">
                                <i class="fas fa-paperclip mr-2 text-info"></i> Required Documents
                            </h5>

                            <!-- Profile Picture -->
                            <div class="form-group">
                                <label class="font-weight-bold text-gray-700">Profile Picture <span class="text-danger">*</span></label>
                                <input type="file" name="userPicture" class="form-control" accept="image/*" required>
                                <small class="form-text text-muted">Required for all users</small>
                                <?php if (validation_show_error('userPicture')): ?>
                                    <div class="text-danger small"><?= validation_show_error('userPicture') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Signature (Conditional) -->
                            <div class="form-group" id="signatureField" style="display:none;">
                                <label class="font-weight-bold text-gray-700" id="signatureTitle">Signature Image</label>
                                <input type="file" name="userSignature" id="userSignature" class="form-control" accept="image/png">
                                <small class="form-text text-muted" id="signatureHelp">Transparent PNG required for signatories</small>
                                <?php if (validation_show_error('userSignature')): ?>
                                    <div class="text-danger small"><?= validation_show_error('userSignature') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Application File -->
                            <div class="form-group">
                                <label class="font-weight-bold text-gray-700">Application File</label>
                                <input type="file" name="userApplicationFile" class="form-control" accept=".pdf">
                                <small class="form-text text-muted">Official PDF document required</small>
                                <?php if (validation_show_error('userApplicationFile')): ?>
                                    <div class="text-danger small"><?= validation_show_error('userApplicationFile') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-user-plus mr-2"></i>
                                Create User Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Guidelines Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-danger text-white">
                    <h6 class="m-0 font-weight-bold">
                        <i class="fas fa-user-shield mr-1"></i> Account Creation Rules
                    </h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Before creating a new user account, please observe the following official regulations to ensure system security and compliance.
                    </p>

                    <div class="mb-3">
                        <h6 class="font-weight-bold text-gray-800">
                            <i class="fas fa-exchange-alt text-success mr-2"></i> Department Specific
                        </h6>
                        <p class="text-muted small">Matrimonial department can only have matrimonial signatories.</p>
                    </div>

                    <div class="mb-3">
                        <h6 class="font-weight-bold text-gray-800">
                            <i class="fas fa-pen-fancy text-danger mr-2"></i> Signature Requirements
                        </h6>
                        <p class="text-muted small">Signatories must upload transparent PNG signature images.</p>
                    </div>

                    <div class="mb-3">
                        <h6 class="font-weight-bold text-gray-800">
                            <i class="fas fa-users-cog text-warning mr-2"></i> Unique Account Types
                        </h6>
                        <p class="text-muted small">Only one active user per account type per branch allowed.</p>
                    </div>

                    <div class="mb-3">
                        <h6 class="font-weight-bold text-gray-800">
                            <i class="fas fa-image text-info mr-2"></i> Profile Pictures
                        </h6>
                        <p class="text-muted small">Profile picture is mandatory for all users.</p>
                    </div>

                    <div class="mb-4">
                        <h6 class="font-weight-bold text-gray-800">
                            <i class="fas fa-file-pdf text-primary mr-2"></i> Documentation
                        </h6>
                        <p class="text-muted small">PDF application file must be uploaded for verification.</p>
                    </div>

                    <div class="alert alert-info text-center">
                        <i class="fas fa-shield-alt mr-2"></i>
                        All user actions are logged and monitored by the National Registry Office
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const departmentSelect = document.getElementById('userDepartment');
    const accountTypeSelect = document.getElementById('userAccountType');
    const signatureField = document.getElementById('signatureField');
    const signatureTitle = document.getElementById('signatureTitle');
    const signatureInput = document.getElementById('userSignature');
    const signatureHelp = document.getElementById('signatureHelp');
    const oldDepartment = "<?= old('userDepartment') ?>";
    const oldAccountType = "<?= old('userAccountType') ?>";

    // Account type options configuration
    const accountTypeOptions = {
        // Common options for all departments
        common: [
            { value: 'Registrar', label: 'Registrar' },
            { value: 'ENTRY', label: 'Data Entry Clerk' },
            { value: 'ADMIN', label: 'SYSTEM ADMIN' }
        ],
        // Department-specific signatories
        matrimonial: [
            { value: 'SIGNA', label: 'Signatory A' },
            { value: 'SIGNB', label: 'Signatory B' },
            { value: 'SIGNC', label: 'Signatory C' }
        ],
        cultural: [
            { value: 'tradCertSignatoryB', label: 'Traditional Cert Signatory B' },
            { value: 'tradCertSignatoryC', label: 'Traditional Cert Signatory C' },
            { value: 'tradCertSignatoryA', label: 'Traditional Cert Signatory A' }
        ],
        registrar: [
            // No additional signatories for Registrar
        ],
        'system-admin': [
            // No additional signatories for System Admin
        ]
    };

    // All signatory roles for validation
    const matrimonialSignatories = ['SIGNA', 'SIGNB', 'SIGNC'];
    const culturalSignatories = ['tradCertSignatoryB', 'tradCertSignatoryA', 'tradCertSignatoryC'];
    const allSignatories = [...matrimonialSignatories, ...culturalSignatories];

    function populateAccountTypes() {
        const department = departmentSelect.value.toLowerCase();
        const currentValue = oldAccountType;
        
        // Clear existing options
        accountTypeSelect.innerHTML = '<option value="">Select Account Type</option>';
        
        // Add department-specific signatories first
        if (accountTypeOptions[department] && accountTypeOptions[department].length > 0) {
            const deptGroup = document.createElement('optgroup');
            
            if (department === 'matrimonial') {
                deptGroup.label = "Certificate Signatory (Matrimonial)";
                // Add matrimonial signatories
                accountTypeOptions.matrimonial.forEach(option => {
                    const opt = document.createElement('option');
                    opt.value = option.value;
                    opt.textContent = option.label;
                    if (option.value === currentValue) opt.selected = true;
                    deptGroup.appendChild(opt);
                });
            } else if (department === 'cultural') {
                deptGroup.label = "Certificate Signatory (Cultural)";
                // Add cultural signatories
                accountTypeOptions.cultural.forEach(option => {
                    const opt = document.createElement('option');
                    opt.value = option.value;
                    opt.textContent = option.label;
                    if (option.value === currentValue) opt.selected = true;
                    deptGroup.appendChild(opt);
                });
            }
            
            // Add department group if it exists
            if (deptGroup.children.length > 0) {
                accountTypeSelect.appendChild(deptGroup);
            }
        }
        
        // Add common options for all departments
        const commonGroup = document.createElement('optgroup');
        commonGroup.label = "Other Staff";
        
        accountTypeOptions.common.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option.value;
            opt.textContent = option.label;
            if (option.value === currentValue) opt.selected = true;
            commonGroup.appendChild(opt);
        });
        
        accountTypeSelect.appendChild(commonGroup);
        
        // Trigger signature field update
        toggleSignature();
    }

    function toggleSignature() {
        const selectedAccountType = accountTypeSelect.value;
        const isSignatory = allSignatories.includes(selectedAccountType);
        
        signatureField.style.display = isSignatory ? 'block' : 'none';
        
        // Update signature requirements
        if (isSignatory) {
            signatureInput.setAttribute('required', 'required');
            signatureTitle.innerHTML = 'Signature Image <span class="text-danger">*</span>';
            
            // Update help text based on department
            const dept = departmentSelect.value;
            if (dept === 'Matrimonial') {
                signatureHelp.textContent = 'Transparent PNG signature required for matrimonial signatories';
            } else if (dept === 'Cultural') {
                signatureHelp.textContent = 'Transparent PNG signature required for traditional certificate signatories';
            }
        } else {
            signatureInput.removeAttribute('required');
            signatureInput.value = '';
            signatureTitle.textContent = 'Signature Image';
            signatureHelp.textContent = 'Transparent PNG required for signatories';
        }
    }

    // Initialize on page load
    if (oldDepartment) {
        populateAccountTypes();
    } else {
        // Set default state
        toggleSignature();
    }
    
    // Event listeners
    departmentSelect.addEventListener('change', function() {
        populateAccountTypes();
    });

    accountTypeSelect.addEventListener('change', toggleSignature);

    // Form submission loading state
    document.getElementById('userCreateForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Creating...';
    });

    // File feedback
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const formText = this.nextElementSibling;
            if (formText && formText.classList.contains('form-text')) {
                if (this.files[0]) {
                    const originalText = formText.textContent;
                    formText.dataset.original = originalText;
                    formText.textContent = 'Selected: ' + this.files[0].name;
                    formText.style.color = '#198754';
                    formText.style.fontWeight = 'bold';
                } else {
                    // Reset to original text
                    if (formText.dataset.original) {
                        formText.textContent = formText.dataset.original;
                    }
                    formText.style.color = '#6c757d';
                    formText.style.fontWeight = 'normal';
                }
            }
        });
    });
});
</script>

<?= $this->endSection() ?>