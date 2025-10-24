<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row mt-3">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-success py-3">
                <h4 class="text-success mb-0 font-weight-bold">
                    <i class="fas fa-plus-circle text-success mr-2"></i>Create New Herbal Certificate
                </h4>
            </div>

            <div class="card-body p-4">
                <!-- Success/Error Messages -->
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i><?= session('success') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i><?= session('error') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Please correct the following errors:
                        <ul class="mb-0 mt-2">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <form action="/certificates/create" method="post" id="certificateForm">
                    <?= csrf_field() ?>

                    <!-- Certificate Holder Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3 border-bottom pb-2">
                                <i class="fas fa-user-circle mr-2"></i>Holder Information
                            </h5>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="tradCertHolderName" class="form-label font-weight-bold">Holder Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.tradCertHolderName') ? 'is-invalid' : '' ?>" 
                                id="tradCertHolderName" name="tradCertHolderName" 
                                value="<?= old('tradCertHolderName') ?>" 
                                placeholder="Enter full name of certificate holder" required>
                            <?php if (session('errors.tradCertHolderName')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertHolderName') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tradCertHolderOperationType" class="form-label font-weight-bold">Operation Type <span class="text-danger">*</span></label>
                            <select class="form-control <?= session('errors.tradCertHolderOperationType') ? 'is-invalid' : '' ?>" 
                                id="tradCertHolderOperationType" name="tradCertHolderOperationType" required>
                                <option value="">Select Operation Type</option>
                                <option value="manufacturing" <?= old('tradCertHolderOperationType') == 'manufacturing' ? 'selected' : '' ?>>Manufacturing</option>
                                <option value="retail" <?= old('tradCertHolderOperationType') == 'retail' ? 'selected' : '' ?>>Retail</option>
                                <option value="wholesale" <?= old('tradCertHolderOperationType') == 'wholesale' ? 'selected' : '' ?>>Wholesale</option>
                                <option value="service" <?= old('tradCertHolderOperationType') == 'service' ? 'selected' : '' ?>>Service</option>
                                <option value="agriculture" <?= old('tradCertHolderOperationType') == 'agriculture' ? 'selected' : '' ?>>Agriculture</option>
                                <option value="mining" <?= old('tradCertHolderOperationType') == 'mining' ? 'selected' : '' ?>>Mining</option>
                                <option value="construction" <?= old('tradCertHolderOperationType') == 'construction' ? 'selected' : '' ?>>Construction</option>
                            </select>
                            <?php if (session('errors.tradCertHolderOperationType')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertHolderOperationType') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tradCertHolderTownorCity" class="form-label font-weight-bold">Town/City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= session('errors.tradCertHolderTownorCity') ? 'is-invalid' : '' ?>" 
                                id="tradCertHolderTownorCity" name="tradCertHolderTownorCity" 
                                value="<?= old('tradCertHolderTownorCity') ?>" 
                                placeholder="Enter town or city" required>
                            <?php if (session('errors.tradCertHolderTownorCity')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertHolderTownorCity') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tradCertHolderDistrict" class="form-label font-weight-bold">District</label>
                            <input type="text" class="form-control <?= session('errors.tradCertHolderDistrict') ? 'is-invalid' : '' ?>" 
                                id="tradCertHolderDistrict" name="tradCertHolderDistrict" 
                                value="<?= old('tradCertHolderDistrict') ?>" 
                                placeholder="Enter district">
                            <?php if (session('errors.tradCertHolderDistrict')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertHolderDistrict') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tradCertHoldercounty" class="form-label font-weight-bold">County <span class="text-danger">*</span></label>
                            <select class="form-control <?= session('errors.tradCertHoldercounty') ? 'is-invalid' : '' ?>" 
                                id="tradCertHoldercounty" name="tradCertHoldercounty" required>
                                <option value="">Select County</option>
                                <option value="Bomi" <?= old('tradCertHoldercounty') == 'Bomi' ? 'selected' : '' ?>>Bomi</option>
                                <option value="Bong" <?= old('tradCertHoldercounty') == 'Bong' ? 'selected' : '' ?>>Bong</option>
                                <option value="Gbarpolu" <?= old('tradCertHoldercounty') == 'Gbarpolu' ? 'selected' : '' ?>>Gbarpolu</option>
                                <option value="Grand Bassa" <?= old('tradCertHoldercounty') == 'Grand Bassa' ? 'selected' : '' ?>>Grand Bassa</option>
                                <option value="Grand Cape Mount" <?= old('tradCertHoldercounty') == 'Grand Cape Mount' ? 'selected' : '' ?>>Grand Cape Mount</option>
                                <option value="Grand Gedeh" <?= old('tradCertHoldercounty') == 'Grand Gedeh' ? 'selected' : '' ?>>Grand Gedeh</option>
                                <option value="Grand Kru" <?= old('tradCertHoldercounty') == 'Grand Kru' ? 'selected' : '' ?>>Grand Kru</option>
                                <option value="Lofa" <?= old('tradCertHoldercounty') == 'Lofa' ? 'selected' : '' ?>>Lofa</option>
                                <option value="Margibi" <?= old('tradCertHoldercounty') == 'Margibi' ? 'selected' : '' ?>>Margibi</option>
                                <option value="Maryland" <?= old('tradCertHoldercounty') == 'Maryland' ? 'selected' : '' ?>>Maryland</option>
                                <option value="Montserrado" <?= old('tradCertHoldercounty') == 'Montserrado' ? 'selected' : '' ?>>Montserrado</option>
                                <option value="Nimba" <?= old('tradCertHoldercounty') == 'Nimba' ? 'selected' : '' ?>>Nimba</option>
                                <option value="River Cess" <?= old('tradCertHoldercounty') == 'River Cess' ? 'selected' : '' ?>>River Cess</option>
                                <option value="River Gee" <?= old('tradCertHoldercounty') == 'River Gee' ? 'selected' : '' ?>>River Gee</option>
                                <option value="Sinoe" <?= old('tradCertHoldercounty') == 'Sinoe' ? 'selected' : '' ?>>Sinoe</option>
                            </select>
                            <?php if (session('errors.tradCertHoldercounty')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertHoldercounty') ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Certificate Details -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3 border-bottom pb-2">
                                <i class="fas fa-certificate mr-2"></i>Certificate Details
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tradCertDateIssued" class="form-label font-weight-bold">Date Issued <span class="text-danger">*</span></label>
                            <input type="date" class="form-control <?= session('errors.tradCertDateIssued') ? 'is-invalid' : '' ?>" 
                                id="tradCertDateIssued" name="tradCertDateIssued" 
                                value="<?= old('tradCertDateIssued', date('Y-m-d')) ?>" required>
                            <?php if (session('errors.tradCertDateIssued')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertDateIssued') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tradCertDuration" class="form-label font-weight-bold">Duration (Days) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control <?= session('errors.tradCertDuration') ? 'is-invalid' : '' ?>" 
                                id="tradCertDuration" name="tradCertDuration" 
                                value="<?= old('tradCertDuration', '365') ?>" 
                                placeholder="Enter duration in days" min="1" required>
                            <small class="form-text text-muted">Typically 365 days (1 year)</small>
                            <?php if (session('errors.tradCertDuration')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertDuration') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tradRevenueNo" class="form-label font-weight-bold">Revenue Number</label>
                            <input type="text" class="form-control <?= session('errors.tradRevenueNo') ? 'is-invalid' : '' ?>" 
                                id="tradRevenueNo" name="tradRevenueNo" 
                                value="<?= old('tradRevenueNo') ?>" 
                                placeholder="Enter revenue number">
                            <?php if (session('errors.tradRevenueNo')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradRevenueNo') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tradCertAppliedType" class="form-label font-weight-bold">Application Type <span class="text-danger">*</span></label>
                            <select class="form-control <?= session('errors.tradCertAppliedType') ? 'is-invalid' : '' ?>" 
                                id="tradCertAppliedType" name="tradCertAppliedType" required>
                                <option value="">Select Application Type</option>
                                <option value="online" <?= old('tradCertAppliedType') == 'online' ? 'selected' : '' ?>>Online</option>
                                <option value="branch" <?= old('tradCertAppliedType') == 'branch' ? 'selected' : '' ?>>Branch</option>
                            </select>
                            <?php if (session('errors.tradCertAppliedType')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertAppliedType') ?></div>
                            <?php endif; ?>
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="/certificates" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save mr-2"></i>Create Certificate
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Guidance Card Column -->
    <div class="col-lg-4">
        <div class="card shadow-sm ">
            <div class="card-header bg-white py-3">
                <h5 class="text-info mb-0 font-weight-bold">
                    <i class="fas fa-lightbulb text-warning mr-2"></i>Issuance Guidelines
                </h5>
            </div>
            <div class="card-body">
                <!-- Important Notes -->
                <div class="alert alert-info border-0">
                    <h6 class="font-weight-bold text-info">
                        <i class="fas fa-exclamation-circle mr-2"></i>Important Notes
                    </h6>
                    <p class="mb-2 small">Certificate serial numbers are automatically generated based on county and operation type.</p>
                </div>

                <!-- Verification Checklist -->
                <div class="mb-4">
                    <h6 class="font-weight-bold text-primary mb-3">
                        <i class="fas fa-clipboard-check mr-2"></i>Verification Checklist
                    </h6>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item px-0 py-2 border-0">
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <span class="small">Verify holder identity documents</span>
                        </div>
                        <div class="list-group-item px-0 py-2 border-0">
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <span class="small">Confirm business registration status</span>
                        </div>
                        <div class="list-group-item px-0 py-2 border-0">
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <span class="small">Validate operation type classification</span>
                        </div>
                        <div class="list-group-item px-0 py-2 border-0">
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <span class="small">Check for existing certificates</span>
                        </div>
                    </div>
                </div>

                <!-- Required Documents -->
                <div class="mb-4">
                    <h6 class="font-weight-bold text-warning mb-3">
                        <i class="fas fa-file-alt mr-2"></i>Required Documents
                    </h6>
                    <ul class="list-unstyled small">
                        <li class="mb-1">
                            <i class="fas fa-file text-muted mr-2"></i>Valid ID Card/Passport
                        </li>
                        <li class="mb-1">
                            <i class="fas fa-file text-muted mr-2"></i>Business Registration
                        </li>
                        <li class="mb-1">
                            <i class="fas fa-file text-muted mr-2"></i>Tax Clearance Certificate
                        </li>
                        <li class="mb-1">
                            <i class="fas fa-file text-muted mr-2"></i>Proof of Address
                        </li>
                    </ul>
                </div>

                <!-- Cautions -->
                <div class="mb-3">
                    <h6 class="font-weight-bold text-danger mb-3">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Important Cautions
                    </h6>
                    <div class="alert alert-warning border-warning small">
                        <i class="fas fa-shield-alt mr-2"></i>
                        <strong>Double-check all information</strong> before submission. Certificate details cannot be easily modified after creation.
                    </div>
                    <div class="alert alert-warning border-warning small">
                        <i class="fas fa-user-check mr-2"></i>
                        <strong>Ensure proper authorization</strong> for all signatories before adding them to the certificate.
                    </div>
                    <div class="alert alert-warning border-warning small">
                        <i class="fas fa-calendar-check mr-2"></i>
                        <strong>Verify issue date accuracy</strong> as it determines certificate validity period.
                    </div>
                </div>

                <!-- Quick Tips -->
                <div class="mt-4 p-3 bg-light rounded">
                    <h6 class="font-weight-bold text-success mb-2">
                        <i class="fas fa-rocket mr-2"></i>Quick Tips
                    </h6>
                    <p class="small mb-2">• Use the county dropdown for accurate serial number generation</p>
                    <p class="small mb-2">• Signatories can be added later if not available now</p>
                    <p class="small mb-0">• Certificate will be marked as "Pending" until all signatories are added</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/hide branch field based on application type
    const appTypeSelect = document.getElementById('tradCertAppliedType');
    const branchField = document.getElementById('branchField');
    
    function toggleBranchField() {
        if (appTypeSelect.value === 'branch') {
            branchField.style.display = 'block';
        } else {
            branchField.style.display = 'none';
        }
    }
    
    appTypeSelect.addEventListener('change', toggleBranchField);
    toggleBranchField(); // Initial check
    
    // Set default date to today if empty
    const dateIssued = document.getElementById('tradCertDateIssued');
    if (!dateIssued.value) {
        dateIssued.valueAsDate = new Date();
    }
    
    // Form submission validation
    const form = document.getElementById('certificateForm');
    form.addEventListener('submit', function(e) {
        const holderName = document.getElementById('tradCertHolderName').value.trim();
        if (!holderName) {
            e.preventDefault();
            alert('Please enter the certificate holder name.');
            return false;
        }
        
        // Additional validation can be added here
        return true;
    });
});
</script>
<?= $this->endSection() ?>

<style>
.card {
    border-radius: 0.5rem;
}

.card-header {
    border-radius: 0.5rem 0.5rem 0 0 !important;
}

.border-left-info {
    border-left: 4px solid #36b9cc !important;
}

.list-group-item {
    background: transparent;
}

.alert {
    border-radius: 0.5rem;
}

.form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}
</style>