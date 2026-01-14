<?php $this->extend('dashboard/partials/layout') ?>
<?=$this->section('main') ?>

<div class="container-fluid px-4">
    <!-- Patriotic Header -->
    <div class="modern-card mb-4">
        <div class="modern-card-header" style="background: linear-gradient(135deg, #002868 0%, #001F5B 100%);">
            <div class="header-content">
                <div class="header-title">
                    <div class="title-icon" style="background: #BF0A30; box-shadow: 0 0 25px rgba(191,10,48,0.5);">
                        <i class="fas fa-user-edit text-white"></i>
                    </div>
                    <div class="title-text">
                        <h1 class="page-title text-white mb-0">Edit User Account</h1>
                        <p class="page-subtitle text-white opacity-90 mb-0">Update staff member information securely</p>
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
            <div class="modern-card h-100">
                <div class="modern-card-body p-5">
                    <form action="/system_admin/users/edit/<?= esc($user['userId']) ?>" method="post" enctype="multipart/form-data" id="userEditForm">
                        <?= csrf_field() ?>
                        
                        <div class="form-grid">
                            <!-- Full Name -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-user me-2"></i>Full Name</label>
                                <input type="text" name="userFullName" id="userFullName" class="form-control <?= validation_show_error('userFullName') ? 'is-invalid' : '' ?>"
                                       value="<?= old('userFullName', $user['userFullName']) ?>" placeholder="Enter full name" required>
                                <?php if (validation_show_error('userFullName')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userFullName') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                <input type="email" name="userEmail" id="userEmail" class="form-control <?= validation_show_error('userEmail') ? 'is-invalid' : '' ?>"
                                       value="<?= old('userEmail', $user['userEmail']) ?>" placeholder="staff@example.gov.lr" required>
                                <?php if (validation_show_error('userEmail')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userEmail') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Phone -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-phone me-2"></i>Phone Number</label>
                                <input type="tel" name="userPhone" id="userPhone" class="form-control <?= validation_show_error('userPhone') ? 'is-invalid' : '' ?>"
                                       value="<?= old('userPhone', $user['userPhone']) ?>" placeholder="+231 XXX XXX XXX">
                                <?php if (validation_show_error('userPhone')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userPhone') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Position -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-briefcase me-2"></i>Position</label>
                                <input type="text" name="userPosition" id="userPosition" class="form-control <?= validation_show_error('userPosition') ? 'is-invalid' : '' ?>"
                                       value="<?= old('userPosition', $user['userPosition']) ?>" placeholder="e.g. Senior Registrar">
                                <?php if (validation_show_error('userPosition')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userPosition') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Department -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-building me-2"></i>Department</label>
                                <select name="userDepartment" id="userDepartment" class="form-control <?= validation_show_error('userDepartment') ? 'is-invalid' : '' ?>" required>
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

                            <!-- Password (Optional for Edit) -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-lock me-2"></i>New Password</label>
                                <input type="password" name="userPassword" id="userPassword" class="form-control <?= validation_show_error('userPassword') ? 'is-invalid' : '' ?>" 
                                       placeholder="Leave blank to keep current password">
                                <?php if (validation_show_error('userPassword')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userPassword') ?></div>
                                <?php endif; ?>
                                <small class="text-muted">Only fill if you want to change the password</small>
                            </div>

                            <!-- Branch -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-code-branch me-2"></i>Branch</label>
                                <select name="userBreanch" id="userBreanch" class="form-control <?= validation_show_error('userBreanch') ? 'is-invalid' : '' ?>" required>
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
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-user-tag me-2"></i>Account Type</label>
                                <select name="userAccountType" id="userAccountType" class="form-control <?= validation_show_error('userAccountType') ? 'is-invalid' : '' ?>" required>
                                    <option value="">Select Account Type</option>
                                    <!-- Options will be populated by JavaScript based on department -->
                                </select>
                                <?php if (validation_show_error('userAccountType')): ?>
                                    <div class="invalid-feedback"><?= validation_show_error('userAccountType') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Account Status -->
                            <div class="form-group">
                                <label class="form-label"><i class="fas fa-toggle-on me-2"></i>Account Status</label>
                                <select name="userAccountActiveStatus" id="userAccountActiveStatus" class="form-control">
                                    <option value="1" <?= old('userAccountActiveStatus', $user['userAccountActiveStatus']) == '1' ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= old('userAccountActiveStatus', $user['userAccountActiveStatus']) == '0' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- File Uploads Section -->
                        <div class="file-section">
                            <h3 class="section-title"><i class="fas fa-cloud-upload-alt me-2"></i>Update Documents</h3>
                            
                            <!-- Current Signature Display -->
                            <?php if (!empty($user['userSignature'])): ?>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Current Signature:</p>
                                    <img src="<?= base_url('uploads/signatures/' . $user['userSignature']) ?>" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px; background: #f8f9fa; padding: 10px;">
                                </div>
                            <?php endif; ?>
                            
                            <div id="signatureField" style="display: none;">
                                <div class="file-upload-card">
                                    <label for="userSignature" class="file-label">
                                        <div class="file-icon" style="background: linear-gradient(135deg, #6b7280, #4b5563);">
                                            <i class="fas fa-pen-fancy"></i>
                                        </div>
                                        <div>
                                            <div class="file-title" id="signatureTitle">Update Signature Image</div>
                                            <div class="file-subtitle">Upload transparent PNG signature (Leave empty to keep current)</div>
                                        </div>
                                    </label>
                                    <input type="file" name="userSignature" id="userSignature" class="file-input" accept="image/*">
                                </div>
                            </div>
                            
                            <!-- Current Profile Picture Display -->
                            <?php if (!empty($user['userPicture'])): ?>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Current Profile Picture:</p>
                                    <img src="<?= base_url('uploads/profiles/' . $user['userPicture']) ?>" 
                                         class="img-thumbnail rounded-circle" 
                                         style="max-width: 120px; height: 120px; object-fit: cover;">
                                </div>
                            <?php endif; ?>
                            
                            <div class="file-upload-card">
                                <label for="userPicture" class="file-label">
                                    <div class="file-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb);">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <div>
                                        <div class="file-title">Update Profile Picture</div>
                                        <div class="file-subtitle">Upload JPG/PNG image (Leave empty to keep current)</div>
                                    </div>
                                </label>
                                <input type="file" name="userPicture" id="userPicture" class="file-input" accept="image/*">
                            </div>
                            
                            <!-- Current Application File Display -->
                            <?php if (!empty($user['userApplicationFile'])): ?>
                                <div class="mb-3">
                                    <p class="text-muted mb-1">Current Application File:</p>
                                    <a href="<?= base_url('uploads/applications/' . $user['userApplicationFile']) ?>" 
                                       target="_blank" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-file-pdf me-1"></i> View Current PDF
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="file-upload-card">
                                <label for="userApplicationFile" class="file-label">
                                    <div class="file-icon" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div>
                                        <div class="file-title">Update Application File</div>
                                        <div class="file-subtitle">Upload PDF document (Leave empty to keep current)</div>
                                    </div>
                                </label>
                                <input type="file" name="userApplicationFile" id="userApplicationFile" class="file-input" accept=".pdf">
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn-patriotic" id="submitBtn">
                                <span class="btn-text">Update Account</span>
                                <span class="btn-icon"><i class="fas fa-save"></i></span>
                                <span class="btn-loading" style="display: none;"><i class="fas fa-spinner fa-spin"></i> Updating...</span>
                            </button>
                            <a href="/system_admin/users" class="btn btn-outline-secondary ms-2">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Policy Sidebar -->
        <div class="col-lg-4">
            <div class="modern-card h-100">
                <div class="modern-card-header" style="background: linear-gradient(135deg, #BF0A30 0%, #9B0B28 100%);">
                    <div class="header-content">
                        <div class="header-title">
                            <div class="title-icon" style="background: white; color: #BF0A30;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="title-text">
                                <h1 class="page-title text-white mb-0">Update Guidelines</h1>
                                <p class="page-subtitle text-white opacity-90 mb-0">Security & Compliance</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modern-card-body p-5">
                    <div class="policy-box">
                        <div class="policy-list">
                            <div class="policy-item success">
                                <div class="policy-icon">
                                    <i class="fas fa-exchange-alt"></i>
                                </div>
                                <div class="policy-text">
                                    <strong>Department Changes</strong><br>
                                    <span class="text-muted">Changing department updates available signatory options.</span>
                                </div>
                            </div>

                            <div class="policy-item danger">
                                <div class="policy-icon">
                                    <i class="fas fa-user-slash"></i>
                                </div>
                                <div class="policy-text">
                                    <strong>Account Type Rules</strong><br>
                                    <span class="text-muted">Only one active user per account type per branch allowed.</span>
                                </div>
                            </div>

                            <div class="policy-item warning">
                                <div class="policy-icon">
                                    <i class="fas fa-pen-fancy"></i>
                                </div>
                                <div class="policy-text">
                                    <strong>Signature Updates</strong><br>
                                    <span class="text-muted">Signatories can update their signature image anytime.</span>
                                </div>
                            </div>

                            <div class="policy-item info">
                                <div class="policy-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <div class="policy-text">
                                    <strong>Linked Accounts</strong><br>
                                    <span class="text-muted">Accounts linked to certificates cannot be deactivated.</span>
                                </div>
                            </div>

                            <div class="policy-item primary">
                                <div class="policy-icon">
                                    <i class="fas fa-file-contract"></i>
                                </div>
                                <div class="policy-text">
                                    <strong>File Updates</strong><br>
                                    <span class="text-muted">Leave file fields empty to keep existing documents.</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 p-4 bg-light rounded text-center border-start border-primary border-5">
                            <i class="fas fa-history fa-2x text-primary mb-3"></i>
                            <p class="mb-0 fw-bold text-primary">
                                All account modifications are logged in the audit trail system
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* OFFICIAL PATRIOTIC THEME - FULL OVERRIDE (Same as create) */
.modern-card {
    background: white !important;
    border-radius: 18px !important;
    box-shadow: 0 6px 25px rgba(0,40,104,0.12) !important;
    border: 1px solid #e2e8f0 !important;
    overflow: hidden;
    margin-bottom: 1.5rem;
}
.modern-card-header {
    padding: 2rem !important;
    position: relative;
}
.modern-card-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0.1);
    background-image: linear-gradient(45deg, rgba(255,255,255,0.08) 25%, transparent 25%, transparent 50%, rgba(255,255,255,0.08) 50%, rgba(255,255,255,0.08) 75%, transparent 75%, transparent);
    background-size: 25px 25px;
}
.header-content { 
    position: relative; 
    z-index: 2; 
    display: flex; 
    justify-content: space-between; 
    align-items: center; 
    flex-wrap: wrap; 
    gap: 1rem; 
}
.header-title { 
    display: flex; 
    align-items: center; 
    gap: 1.2rem; 
}
.title-icon { 
    width: 62px; 
    height: 62px; 
    border-radius: 16px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    font-size: 1.8rem; 
}
.page-title { 
    font-size: 1.9rem; 
    font-weight: 800; 
    margin: 0; 
    letter-spacing: 0.6px;
}
.page-subtitle { 
    font-size: 1.05rem; 
    opacity: 0.95; 
    margin: 0.5rem 0 0; 
}

.modern-card-body {
    padding: 2rem !important;
}

/* Form Styles */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: #002868;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.85rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #002868;
    box-shadow: 0 0 0 4px rgba(0, 40, 104, 0.15);
    outline: none;
}

.is-invalid {
    border-color: #dc2626 !important;
}

.invalid-feedback {
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

/* File Upload Styles */
.file-section {
    background: #f8fafc;
    border-radius: 16px;
    padding: 2rem;
    margin-top: 2rem;
}

.section-title {
    color: #002868;
    font-weight: 700;
    font-size: 1.25rem;
    margin-bottom: 1.5rem;
}

.file-upload-card {
    background: white;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    margin-bottom: 1.25rem;
    transition: all 0.3s ease;
}

.file-upload-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.file-label {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.file-icon {
    width: 60px;
    height: 60px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.6rem;
    flex-shrink: 0;
}

.file-title {
    font-weight: 700;
    color: #002868;
    font-size: 1rem;
}

.file-subtitle {
    font-size: 0.9rem;
    color: #6b7280;
}

.file-input {
    display: none;
}

/* Form Actions */
.form-actions {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid #f1f5f9;
}

.btn-patriotic {
    background: linear-gradient(135deg, #BF0A30 0%, #9B0B28 100%);
    color: white;
    border: none;
    padding: 1rem 2.5rem;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: 0 8px 25px rgba(191, 10, 48, 0.4);
    transition: all 0.3s ease;
}

.btn-patriotic:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(191, 10, 48, 0.5);
}

.btn-outline-secondary {
    border: 2px solid #e2e8f0;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
}

/* Policy Box Styling */
.policy-box {
    font-size: 1rem;
}

.policy-list {
    display: flex;
    flex-direction: column;
    gap: 1.4rem;
    margin: 1.5rem 0;
}

.policy-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.1rem;
    border-radius: 14px;
    background: #f8fafc;
    border-left: 5px solid;
    transition: all 0.3s ease;
}

.policy-item:hover {
    transform: translateX(8px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.policy-item.success { border-color: #10b981; }
.policy-item.danger { border-color: #ef4444; }
.policy-item.warning { border-color: #f59e0b; }
.policy-item.info { border-color: #3b82f6; }
.policy-item.primary { border-color: #002868; }

.policy-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: white;
    flex-shrink: 0;
}

.policy-item.success .policy-icon { background: #10b981; }
.policy-item.danger .policy-icon { background: #ef4444; }
.policy-item.warning .policy-icon { background: #f59e0b; }
.policy-item.info .policy-icon { background: #3b82f6; }
.policy-item.primary .policy-icon { background: #002868; }

.policy-text strong {
    font-size: 1.05rem;
    color: #1f2937;
}

.policy-text span {
    font-size: 0.92rem;
}

/* Alert Styles */
.alert {
    border-radius: 12px;
    border: none;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
}

.alert-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.alert-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

/* Responsive */
@media (max-width: 992px) {
    .col-lg-8, .col-lg-4 {
        margin-bottom: 1.5rem;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .modern-card-body {
        padding: 1.5rem !important;
    }
}

@media (max-width: 768px) {
    .modern-card-header {
        padding: 1.5rem !important;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .file-label {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const departmentSelect = document.getElementById('userDepartment');
    const accountTypeSelect = document.getElementById('userAccountType');
    const signatureField = document.getElementById('signatureField');
    const signatureTitle = document.getElementById('signatureTitle');
    const signatureInput = document.getElementById('userSignature');
    const currentAccountType = "<?= old('userAccountType', $user['userAccountType']) ?>";

    // Account type options configuration
    const accountTypeOptions = {
        // For all departments
        common: {
            'Registrar': 'Registrar',
            'ENTRY': 'Data Entry Clerk',
            'tradCertEntryClerk': 'Traditional Cert Entry Clerk',
            'ADMIN': 'SYSTEM ADMIN'
        },
        // Department-specific signatories
        matrimonial: {
            'SIGNA': 'Signatory A (Matrimonial)',
            'SIGNB': 'Signatory B (Matrimonial)',
            'SIGNC': 'Signatory C (Matrimonial)'
        },
        cultural: {
            'tradCertSignatoryB': 'Traditional Cert Signatory B',
            'tradCertSignatoryC': 'Traditional Cert Signatory C'
        },
        registrar: {
            // No additional signatories for Registrar
        },
        'system-admin': {
            // No additional signatories for System Admin
        }
    };

    // All signatory roles for validation
    const allSignatoryRoles = ['SIGNA', 'SIGNB', 'SIGNC', 'tradCertSignatoryB', 'tradCertSignatoryC'];

    function populateAccountTypes() {
        const department = departmentSelect.value.toLowerCase();
        const currentValue = currentAccountType;
        
        // Clear existing options
        accountTypeSelect.innerHTML = '<option value="">Select Account Type</option>';
        
        // Add common options for all departments
        const commonGroup = document.createElement('optgroup');
        commonGroup.label = "Staff Roles";
        
        for (const [value, label] of Object.entries(accountTypeOptions.common)) {
            const option = document.createElement('option');
            option.value = value;
            option.textContent = label;
            if (value === currentValue) option.selected = true;
            commonGroup.appendChild(option);
        }
        accountTypeSelect.appendChild(commonGroup);
        
        // Add department-specific signatories
        if (accountTypeOptions[department]) {
            const deptGroup = document.createElement('optgroup');
            
            if (department === 'matrimonial') {
                deptGroup.label = "Matrimonial Signatories";
            } else if (department === 'cultural') {
                deptGroup.label = "Cultural/Traditional Signatories";
            }
            
            for (const [value, label] of Object.entries(accountTypeOptions[department])) {
                const option = document.createElement('option');
                option.value = value;
                option.textContent = label;
                if (value === currentValue) option.selected = true;
                deptGroup.appendChild(option);
            }
            
            if (deptGroup.children.length > 0) {
                accountTypeSelect.appendChild(deptGroup);
            }
        }
        
        // Trigger signature field update
        toggleSignature();
    }

    function toggleSignature() {
        const isSignatory = allSignatoryRoles.includes(accountTypeSelect.value);
        signatureField.style.display = isSignatory ? 'block' : 'none';
        
        // Update signature title based on department
        if (isSignatory) {
            const dept = departmentSelect.value;
            if (dept === 'Matrimonial') {
                signatureTitle.innerHTML = 'Matrimonial Signature Image';
            } else if (dept === 'Cultural') {
                signatureTitle.innerHTML = 'Traditional Cert Signature Image';
            } else {
                signatureTitle.innerHTML = 'Signature Image';
            }
        }
    }

    // Initialize on page load
    populateAccountTypes();
    
    // Event listeners
    departmentSelect.addEventListener('change', function() {
        populateAccountTypes();
    });

    accountTypeSelect.addEventListener('change', toggleSignature);

    // File feedback
    document.querySelectorAll('.file-input').forEach(input => {
        input.addEventListener('change', function() {
            const subtitle = this.closest('.file-upload-card').querySelector('.file-subtitle');
            if (this.files[0]) {
                subtitle.textContent = 'Selected: ' + this.files[0].name;
                subtitle.style.color = '#16a34a';
                subtitle.style.fontWeight = '600';
            } else {
                // Reset to default message
                if (this.id === 'userSignature') {
                    subtitle.textContent = 'Upload transparent PNG signature (Leave empty to keep current)';
                } else if (this.id === 'userPicture') {
                    subtitle.textContent = 'Upload JPG/PNG image (Leave empty to keep current)';
                } else if (this.id === 'userApplicationFile') {
                    subtitle.textContent = 'Upload PDF document (Leave empty to keep current)';
                }
                subtitle.style.color = '#6b7280';
                subtitle.style.fontWeight = 'normal';
            }
        });
    });

    // Submit loading
    document.getElementById('userEditForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.disabled = true;
        btn.querySelector('.btn-text').style.display = 'none';
        btn.querySelector('.btn-icon').style.display = 'none';
        btn.querySelector('.btn-loading').style.display = 'inline-flex';
    });
});
</script>

<?=$this->endSection() ?>