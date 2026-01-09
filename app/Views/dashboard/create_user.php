<?php $this->extend('dashboard/partials/layout') ?>
<?=$this->section('main') ?>

<div class="container-fluid px-4">
    <!-- Header -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-user-plus fa-2x"></i>
                </div>
                <div>
                    <h4 class="mb-0">Create New User Account</h4>
                    <p class="mb-0 opacity-75">Register a new staff member securely</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= session('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= session('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Main Form -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="/dashboard/users/create" method="post" enctype="multipart/form-data" id="userCreateForm">
                        <?= csrf_field() ?>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Full Name -->
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="userFullName" class="form-control <?= validation_show_error('userFullName') ? 'is-invalid' : '' ?>"
                                           value="<?= old('userFullName') ?>" placeholder="Enter full name" required>
                                    <?php if (validation_show_error('userFullName')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userFullName') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Email -->
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="userEmail" class="form-control <?= validation_show_error('userEmail') ? 'is-invalid' : '' ?>"
                                           value="<?= old('userEmail') ?>" placeholder="staff@example.gov.lr" required>
                                    <?php if (validation_show_error('userEmail')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userEmail') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Phone -->
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" name="userPhone" class="form-control <?= validation_show_error('userPhone') ? 'is-invalid' : '' ?>"
                                           value="<?= old('userPhone') ?>" placeholder="+231 XXX XXX XXX">
                                    <?php if (validation_show_error('userPhone')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userPhone') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Position -->
                                <div class="mb-3">
                                    <label class="form-label">Position</label>
                                    <input type="text" name="userPosition" class="form-control <?= validation_show_error('userPosition') ? 'is-invalid' : '' ?>"
                                           value="<?= old('userPosition') ?>" placeholder="e.g. Senior Registrar">
                                    <?php if (validation_show_error('userPosition')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userPosition') ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!-- Department -->
                                <div class="mb-3">
                                    <label class="form-label">Department</label>
                                    <select name="userDepartment" class="form-control <?= validation_show_error('userDepartment') ? 'is-invalid' : '' ?>" required>
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
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="userPassword" class="form-control <?= validation_show_error('userPassword') ? 'is-invalid' : '' ?>" 
                                           placeholder="Enter strong password" required>
                                    <?php if (validation_show_error('userPassword')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userPassword') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Branch -->
                                <div class="mb-3">
                                    <label class="form-label">Branch</label>
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
                                <div class="mb-3">
                                    <label class="form-label">Account Type</label>
                                    <select name="userAccountType" id="userAccountType" class="form-control <?= validation_show_error('userAccountType') ? 'is-invalid' : '' ?>" required>
                                        <option value="">Select Account Type</option>
                                        <optgroup label="Certificate Signatory">
                                            <option value="SIGNA" <?= old('userAccountType') == 'SIGNA' ? 'selected' : '' ?>>Signatory A</option>
                                            <option value="SIGNB" <?= old('userAccountType') == 'SIGNB' ? 'selected' : '' ?>>Signatory B</option>
                                            <option value="SIGNC" <?= old('userAccountType') == 'SIGNC' ? 'selected' : '' ?>>Signatory C</option>
                                        </optgroup>
                                        <optgroup label="Other Staff">
                                            <option value="Registrar" <?= old('userAccountType') == 'Registrar' ? 'selected' : '' ?>>Registrar</option>
                                            <option value="ENTRY" <?= old('userAccountType') == 'ENTRY' ? 'selected' : '' ?>>Data Entry Clerk</option>
                                            <option value="ADMIN" <?= old('userAccountType') == 'ADMIN' ? 'selected' : '' ?>>SYSTEM ADMIN</option>
                                        </optgroup>
                                    </select>
                                    <?php if (validation_show_error('userAccountType')): ?>
                                        <div class="invalid-feedback"><?= validation_show_error('userAccountType') ?></div>
                                    <?php endif; ?>
                                </div>

                                <!-- Account Status -->
                                <div class="mb-3">
                                    <label class="form-label">Account Status</label>
                                    <select name="userAccountActiveStatus" class="form-control">
                                        <option value="1" <?= old('userAccountActiveStatus', '1') == '1' ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= old('userAccountActiveStatus') == '0' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- File Uploads -->
                        <div class="mt-4">
                            <h5 class="mb-3">Required Documents</h5>

                            <!-- Profile Picture -->
                            <div class="mb-3">
                                <label class="form-label">Profile Picture <span class="text-danger">*</span></label>
                                <input type="file" name="userPicture" class="form-control" accept="image/*" required>
                                <div class="form-text">Required for all users</div>
                                <?php if (validation_show_error('userPicture')): ?>
                                    <div class="text-danger small"><?= validation_show_error('userPicture') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Signature (Conditional) -->
                            <div class="mb-3" id="signatureField" style="display:none;">
                                <label class="form-label" id="signatureTitle">Signature Image</label>
                                <input type="file" name="userSignature" id="userSignature" class="form-control" accept="image/png">
                                <div class="form-text">Transparent PNG required for signatories</div>
                                <?php if (validation_show_error('userSignature')): ?>
                                    <div class="text-danger small"><?= validation_show_error('userSignature') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Application File -->
                            <div class="mb-3">
                                <label class="form-label">Application File</label>
                                <input type="file" name="userApplicationFile" class="form-control" accept=".pdf">
                                <div class="form-text">Official PDF document required</div>
                                <?php if (validation_show_error('userApplicationFile')): ?>
                                    <div class="text-danger small"><?= validation_show_error('userApplicationFile') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="fas fa-user-plus me-2"></i>
                                Create User Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Guidelines Sidebar -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-user-shield fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Account Creation Rules</h5>
                            <p class="mb-0 opacity-75">User Account Regulations</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">
                        Before creating a new user account, please observe the following official regulations to ensure system security and compliance.
                    </p>

                    <div class="mb-3">
                        <h6><i class="fas fa-users-cog text-success me-2"></i>Unique Account Types</h6>
                        <p class="text-muted small">Only one active user per account type per branch allowed.</p>
                    </div>

                    <div class="mb-3">
                        <h6><i class="fas fa-pen-fancy text-danger me-2"></i>Signature Requirements</h6>
                        <p class="text-muted small">Signatories must upload transparent PNG signature images.</p>
                    </div>

                    <div class="mb-3">
                        <h6><i class="fas fa-lock text-warning me-2"></i>Account Protection</h6>
                        <p class="text-muted small">Accounts linked to certificates cannot be deleted.</p>
                    </div>

                    <div class="mb-3">
                        <h6><i class="fas fa-image text-info me-2"></i>Profile Pictures</h6>
                        <p class="text-muted small">Profile picture is mandatory for all users.</p>
                    </div>

                    <div class="mb-4">
                        <h6><i class="fas fa-file-pdf text-primary me-2"></i>Documentation</h6>
                        <p class="text-muted small">PDF application file must be uploaded for verification.</p>
                    </div>

                    <div class="alert alert-info text-center">
                        <i class="fas fa-shield-alt me-2"></i>
                        All user actions are logged and monitored by the National Registry Office
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const accountType = document.getElementById('userAccountType');
    const signatureField = document.getElementById('signatureField');
    const signatureTitle = document.getElementById('signatureTitle');
    const signatureInput = document.getElementById('userSignature');

    const signatoryRoles = ['SIGNA', 'SIGNB', 'SIGNC'];

    function toggleSignature() {
        const isSignatory = signatoryRoles.includes(accountType.value);
        signatureField.style.display = isSignatory ? 'block' : 'none';
        if (isSignatory) {
            signatureInput.setAttribute('required', 'required');
            signatureTitle.innerHTML = 'Signature Image <span class="text-danger">*</span>';
        } else {
            signatureInput.removeAttribute('required');
            signatureInput.value = '';
            signatureTitle.textContent = 'Signature Image';
        }
    }

    accountType.addEventListener('change', toggleSignature);
    toggleSignature();

    // Form submission loading state
    document.getElementById('userCreateForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Creating...';
    });
});
</script>

<?=$this->endSection() ?>