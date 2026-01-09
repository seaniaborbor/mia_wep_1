<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="container-fluid">
    <!-- Header -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-danger rounded-circle p-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-edit text-white fs-4"></i>
                    </div>
                    <div>
                        <h1 class="h3 mb-0 text-white">Edit User Account</h1>
                        <p class="mb-0 text-white opacity-90">Update staff member details securely</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Display Flash Messages -->
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

    <div class="row g-4">
        <!-- Main Form Card -->
        <div class="col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-body p-4">
                    <form action="/dashboard/users/edit/<?= $user['userId'] ?>" method="post" enctype="multipart/form-data" id="userEditForm">
                        <?= csrf_field() ?>

                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-user me-2"></i>Full Name</label>
                                <input type="text" name="userFullName" id="userFullName" class="form-control <?= validation_show_error('userFullName') ? 'is-invalid' : '' ?>"
                                       value="<?= old('userFullName', $user['userFullName']) ?>" placeholder="Enter full name" required>
                                <?php if (validation_show_error('userFullName')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userFullName') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Email (Read-only) -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                <input type="email" class="form-control" value="<?= esc($user['userEmail']) ?>" readonly>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-phone me-2"></i>Phone Number</label>
                                <input type="tel" name="userPhone" id="userPhone" class="form-control <?= validation_show_error('userPhone') ? 'is-invalid' : '' ?>"
                                       value="<?= old('userPhone', $user['userPhone']) ?>" placeholder="+231 XXX XXX XXX">
                                <?php if (validation_show_error('userPhone')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userPhone') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Position -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-briefcase me-2"></i>Position</label>
                                <input type="text" name="userPosition" id="userPosition" class="form-control <?= validation_show_error('userPosition') ? 'is-invalid' : '' ?>"
                                       value="<?= old('userPosition', $user['userPosition']) ?>" placeholder="e.g. Senior Registrar">
                                <?php if (validation_show_error('userPosition')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userPosition') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Department -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-building me-2"></i>Department</label>
                                <select name="userDepartment" id="userDepartment" class="form-select <?= validation_show_error('userDepartment') ? 'is-invalid' : '' ?>" required>
                                    <option value="">Select Department</option>
                                    <option value="Registrar" <?= old('userDepartment', $user['userDepartment']) == 'Registrar' ? 'selected' : '' ?>>Registrar</option>
                                    <option value="Matrimonial" <?= old('userDepartment', $user['userDepartment']) == 'Matrimonial' ? 'selected' : '' ?>>Matrimonial</option>
                                    <option value="Cultural" <?= old('userDepartment', $user['userDepartment']) == 'Cultural' ? 'selected' : '' ?>>Cultural</option>
                                    <option value="System-Admin" <?= old('userDepartment', $user['userDepartment']) == 'System-Admin' ? 'selected' : '' ?>>System Admin</option>
                                </select>
                                <?php if (validation_show_error('userDepartment')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userDepartment') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-lock me-2"></i>Password</label>
                                <input type="password" name="userPassword" id="userPassword" class="form-control <?= validation_show_error('userPassword') ? 'is-invalid' : '' ?>" placeholder="Leave blank to keep current">
                                <?php if (validation_show_error('userPassword')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userPassword') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Branch -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-code-branch me-2"></i>Branch</label>
                                <select name="userBreanch" id="userBreanch" class="form-select <?= validation_show_error('userBreanch') ? 'is-invalid' : '' ?>" required>
                                    <option value="">Select Branch</option>
                                    <?php if (isset($branches) && is_array($branches)): ?>
                                        <?php foreach ($branches as $branch): ?>
                                            <option value="<?= esc($branch['branchId']) ?>" <?= old('userBreanch', $user['userBreanch']) == $branch['branchId'] ? 'selected' : '' ?>>
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
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold"><i class="fas fa-user-tag me-2"></i>Account Type</label>
                                <select name="userAccountType" id="userAccountType" class="form-select <?= validation_show_error('userAccountType') ? 'is-invalid' : '' ?>" required>
                                    <option value="">Select Account Type</option>
                                    <optgroup label="Certificate Signatory">
                                        <option value="SIGNA" <?= old('userAccountType', $user['userAccountType']) == 'SIGNA' ? 'selected' : '' ?>>Signatory A</option>
                                        <option value="SIGNB" <?= old('userAccountType', $user['userAccountType']) == 'SIGNB' ? 'selected' : '' ?>>Signatory B</option>
                                        <option value="SIGNC" <?= old('userAccountType', $user['userAccountType']) == 'SIGNC' ? 'selected' : '' ?>>Signatory C</option>
                                        <option value="tradCertSignatoryA" <?= old('userAccountType', $user['userAccountType']) == 'tradCertSignatoryA' ? 'selected' : '' ?>>Traditional Cert Signatory A</option>
                                        <option value="tradCertSignatoryB" <?= old('userAccountType', $user['userAccountType']) == 'tradCertSignatoryB' ? 'selected' : '' ?>>Traditional Cert Signatory B</option>
                                        <option value="tradCertSignatoryC" <?= old('userAccountType', $user['userAccountType']) == 'tradCertSignatoryC' ? 'selected' : '' ?>>Traditional Cert Signatory C</option>
                                    </optgroup>
                                    <optgroup label="Other Staff">
                                        <option value="Registrar" <?= old('userAccountType', $user['userAccountType']) == 'Registrar' ? 'selected' : '' ?>>Registrar</option>
                                        <option value="ENTRY" <?= old('userAccountType', $user['userAccountType']) == 'ENTRY' ? 'selected' : '' ?>>Data Entry Clerk</option>
                                        <option value="tradCertEntryClerk" <?= old('userAccountType', $user['userAccountType']) == 'tradCertEntryClerk' ? 'selected' : '' ?>>Traditional Cert Entry Clerk</option>
                                        <option value="ADMIN" <?= old('userAccountType', $user['userAccountType']) == 'ADMIN' ? 'selected' : '' ?>>SYSTEM ADMIN</option>
                                    </optgroup>
                                </select>
                                <?php if (validation_show_error('userAccountType')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userAccountType') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- File Uploads Section -->
                        <div class="bg-light rounded p-4 mt-4">
                            <h5 class="fw-bold text-primary mb-4">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Update Documents (Optional)
                            </h5>
                            
                            <div id="signatureField" class="mb-3" style="display: none;">
                                <div class="card border-0 bg-white shadow-sm">
                                    <div class="card-body">
                                        <label for="userSignature" class="form-label fw-bold text-dark">
                                            <i class="fas fa-pen-fancy me-2 text-secondary"></i>Signature Image
                                        </label>
                                        <input type="file" name="userSignature" id="userSignature" class="form-control" accept="image/*">
                                        <small class="form-text text-muted">Upload new transparent PNG signature (Leave blank to keep current)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 bg-white shadow-sm mb-3">
                                <div class="card-body">
                                    <label for="userPicture" class="form-label fw-bold text-dark">
                                        <i class="fas fa-user-circle me-2 text-primary"></i>Profile Picture
                                    </label>
                                    <input type="file" name="userPicture" id="userPicture" class="form-control" accept="image/*">
                                    <small class="form-text text-muted">Upload new JPG/PNG image (Leave blank to keep current)</small>
                                </div>
                            </div>

                            <div class="card border-0 bg-white shadow-sm">
                                <div class="card-body">
                                    <label for="userApplicationFile" class="form-label fw-bold text-dark">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i>Application File
                                    </label>
                                    <input type="file" name="userApplicationFile" id="userApplicationFile" class="form-control" accept=".pdf">
                                    <small class="form-text text-muted">Upload new PDF document (Leave blank to keep current)</small>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top">
                            <a href="/dashboard/users" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-warning text-white" id="submitBtn">
                                <i class="fas fa-save me-2"></i>
                                <span class="btn-text">Update Account</span>
                                <span class="btn-loading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin me-2"></i>Processing...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Profile Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-danger text-white py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-white rounded-circle p-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-shield text-danger"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 text-white">User Profile</h5>
                            <p class="mb-0 text-white opacity-90">Official Registry Record</p>
                        </div>
                    </div>
                </div>

                <div class="card-body text-center p-4">
                    <!-- Profile Picture -->
                    <div class="mb-4">
                        <img src="<?= base_url('uploads/users/pictures/' . $user['userPicture']) ?>"
                             alt="Profile Picture"
                             class="rounded-circle shadow-lg border border-4 border-white"
                             style="width: 140px; height: 140px; object-fit: cover;">
                    </div>

                    <!-- Name & Email -->
                    <h5 class="fw-bold mb-1"><?= esc($user['userFullName']) ?></h5>
                    <p class="text-muted mb-4">
                        <i class="fas fa-envelope text-secondary me-1"></i> <?= esc($user['userEmail']) ?>
                    </p>

                    <!-- Info Grid -->
                    <div class="row text-start g-3 mb-4">
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                                <i class="fas fa-user-shield text-primary fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Account Type</small>
                                    <strong class="text-dark"><?= esc(ucwords(str_replace('_', ' ', $user['userAccountType']))) ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                                <i class="fas fa-code-branch text-success fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Branch</small>
                                    <strong class="text-dark"><?= esc($user['branchName']) ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                                <i class="fas fa-toggle-<?= $user['userAccountActiveStatus'] ? 'on text-success' : 'off text-danger' ?> fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Status</small>
                                    <strong class="<?= $user['userAccountActiveStatus'] ? 'text-success' : 'text-danger' ?>">
                                        <?= $user['userAccountActiveStatus'] ? 'Active' : 'Inactive' ?>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                                <i class="fas fa-calendar-plus text-info fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Created</small>
                                    <strong class="text-dark"><?= date('d M Y', strtotime($user['userDateCreated'])) ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded">
                                <i class="fas fa-history text-secondary fs-5"></i>
                                <div>
                                    <small class="text-muted d-block">Last Modified</small>
                                    <strong class="text-dark"><?= $user['userAccountLastModifiedDate'] ? date('d M Y', strtotime($user['userAccountLastModifiedDate'])) : 'Never' ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activate/Deactivate Button -->
                    <div class="mt-3">
                        <a href="<?= base_url('dashboard/users/activate/' . $user['userId']) ?>"
                           class="btn <?= $user['userAccountActiveStatus'] ? 'btn-outline-danger' : 'btn-success' ?> w-100">
                            <i class="fas fa-<?= $user['userAccountActiveStatus'] ? 'user-slash' : 'user-check' ?> me-2"></i>
                            <?= $user['userAccountActiveStatus'] ? 'Deactivate Account' : 'Activate Account' ?>
                        </a>
                    </div>

                    <div class="mt-3 text-muted small">
                        <i class="fas fa-shield-alt text-primary me-1"></i>
                        All changes are permanently logged
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
    
    const signatoryRoles = ['SIGNA', 'SIGNB', 'SIGNC', 'tradCertSignatoryA', 'tradCertSignatoryB', 'tradCertSignatoryC'];

    function toggleSignature() {
        const isSignatory = signatoryRoles.includes(accountType.value);
        signatureField.style.display = isSignatory ? 'block' : 'none';
    }

    accountType.addEventListener('change', toggleSignature);
    toggleSignature();

    // Submit loading
    document.getElementById('userEditForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.querySelector('.btn-text').style.display = 'none';
        btn.querySelector('.btn-loading').style.display = 'inline';
    });
});
</script>

<?= $this->endSection() ?>