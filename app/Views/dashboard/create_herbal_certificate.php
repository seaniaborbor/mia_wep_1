<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Create New Traditional Certificate</h1>
            <p class="mb-0 text-gray-600">Register traditional practitioners and healers</p>
        </div>
    </div>

    <div class="row">
        <!-- Main Form Card -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #002868 0%, #001F5B 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-certificate mr-2"></i>
                        Traditional Certificate Registration
                    </h6>
                </div>
                <div class="card-body">
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

                    <form action="/cultural_dashboard/nativecert/store" method="post" id="certificateForm" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <!-- Certificate Holder Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="fas fa-user-circle mr-2"></i>Holder Information
                                </h6>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="tradCertHolderName" class="form-label font-weight-bold text-gray-700">
                                    Holder Full Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control <?= session('errors.tradCertHolderName') ? 'is-invalid' : '' ?>" 
                                    id="tradCertHolderName" name="tradCertHolderName" 
                                    value="<?= old('tradCertHolderName') ?>" 
                                    placeholder="Enter full name of certificate holder" required>
                                <?php if (session('errors.tradCertHolderName')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tradCertHolderName') ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Picture Upload -->
                            <div class="col-md-6 mb-3">
                                <label for="tradCertHolderPic" class="form-label font-weight-bold text-gray-700">
                                    Holder Picture
                                </label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?= session('errors.tradCertHolderPic') ? 'is-invalid' : '' ?>" 
                                        id="tradCertHolderPic" name="tradCertHolderPic" 
                                        accept="image/*">
                                    <label class="custom-file-label" for="tradCertHolderPic" id="fileLabel">
                                        Choose picture file...
                                    </label>
                                    <?php if (session('errors.tradCertHolderPic')): ?>
                                        <div class="invalid-feedback"><?= session('errors.tradCertHolderPic') ?></div>
                                    <?php endif; ?>
                                </div>
                                <small class="form-text text-muted">Optional: Upload holder picture (JPG, PNG, GIF - Max 2MB)</small>
                                <div id="imagePreview" class="mt-2" style="display: none;">
                                    <img id="previewImage" src="#" alt="Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="tradCertHolderOperationType" class="form-label font-weight-bold text-gray-700">
                                    Traditional Position <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?= session('errors.tradCertHolderOperationType') ? 'is-invalid' : '' ?>" 
                                    id="tradCertHolderOperationType" name="tradCertHolderOperationType" required>
                                    <option value="">Select Traditional Position</option>
                                    <option value="herbalist" <?= old('tradCertHolderOperationType') == 'herbalist' ? 'selected' : '' ?>>Herbalist</option>
                                    <option value="native_doctor" <?= old('tradCertHolderOperationType') == 'native_doctor' ? 'selected' : '' ?>>Native Doctor</option>
                                    <option value="traditional_midwife" <?= old('tradCertHolderOperationType') == 'traditional_midwife' ? 'selected' : '' ?>>Traditional Midwife</option>
                                    <option value="spiritual_healer" <?= old('tradCertHolderOperationType') == 'spiritual_healer' ? 'selected' : '' ?>>Spiritual Healer</option>
                                    <!-- Add other options as needed -->
                                </select>
                                <?php if (session('errors.tradCertHolderOperationType')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tradCertHolderOperationType') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="tradCertHolderTownorCity" class="form-label font-weight-bold text-gray-700">
                                    Town/City <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control <?= session('errors.tradCertHolderTownorCity') ? 'is-invalid' : '' ?>" 
                                    id="tradCertHolderTownorCity" name="tradCertHolderTownorCity" 
                                    value="<?= old('tradCertHolderTownorCity') ?>" 
                                    placeholder="Enter town or city" required>
                                <?php if (session('errors.tradCertHolderTownorCity')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tradCertHolderTownorCity') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="tradCertHolderDistrict" class="form-label font-weight-bold text-gray-700">
                                    District
                                </label>
                                <input type="text" class="form-control <?= session('errors.tradCertHolderDistrict') ? 'is-invalid' : '' ?>" 
                                    id="tradCertHolderDistrict" name="tradCertHolderDistrict" 
                                    value="<?= old('tradCertHolderDistrict') ?>" 
                                    placeholder="Enter district">
                                <?php if (session('errors.tradCertHolderDistrict')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tradCertHolderDistrict') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="tradCertHoldercounty" class="form-label font-weight-bold text-gray-700">
                                    County <span class="text-danger">*</span>
                                </label>
                                <select class="form-control <?= session('errors.tradCertHoldercounty') ? 'is-invalid' : '' ?>" 
                                    id="tradCertHoldercounty" name="tradCertHoldercounty" required>
                                    <option value="">Select County</option>
                                    <option value="Montserrado" <?= old('tradCertHoldercounty') == 'Montserrado' ? 'selected' : '' ?>>Montserrado</option>
                                    <option value="Nimba" <?= old('tradCertHoldercounty') == 'Nimba' ? 'selected' : '' ?>>Nimba</option>
                                    <option value="Bong" <?= old('tradCertHoldercounty') == 'Bong' ? 'selected' : '' ?>>Bong</option>
                                    <!-- Add other counties as needed -->
                                </select>
                                <?php if (session('errors.tradCertHoldercounty')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tradCertHoldercounty') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Certificate Details -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                                    <i class="fas fa-certificate mr-2"></i>Certificate Details
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tradCertDuration" class="form-label font-weight-bold text-gray-700">
                                    Duration (Days) <span class="text-danger">*</span>
                                </label>
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
                                <label for="tradRevenueNo" class="form-label font-weight-bold text-gray-700">
                                    Revenue Number
                                </label>
                                <input type="text" class="form-control <?= session('errors.tradRevenueNo') ? 'is-invalid' : '' ?>" 
                                    id="tradRevenueNo" name="tradRevenueNo" 
                                    value="<?= old('tradRevenueNo') ?>" 
                                    placeholder="Enter revenue number">
                                <?php if (session('errors.tradRevenueNo')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tradRevenueNo') ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tradCertAmtPaid" class="form-label font-weight-bold text-gray-700">
                                    Amount Paid
                                </label>
                                <input type="number" class="form-control <?= session('errors.tradCertAmtPaid') ? 'is-invalid' : '' ?>" 
                                    id="tradCertAmtPaid" name="tradCertAmtPaid" 
                                    value="<?= old('tradCertAmtPaid') ?>" 
                                    placeholder="Enter amount paid">
                                <?php if (session('errors.tradCertAmtPaid')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tradCertAmtPaid') ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-4">
                            <div class="col-md-6 mb-2">
                                <a href="/certificates" class="btn btn-outline-secondary btn-block">
                                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                                </a>
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save mr-2"></i>Create Certificate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Guidelines Sidebar -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3" style="background: linear-gradient(135deg, #BF0A30 0%, #9B0B28 100%);">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-info-circle mr-2"></i>
                        Issuance Guidelines
                    </h6>
                </div>
                <div class="card-body">
                    <!-- Important Notes -->
                    <div class="alert alert-info border-0 mb-4">
                        <h6 class="font-weight-bold text-info mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>Important Notes
                        </h6>
                        <p class="mb-0 small">Certificate serial numbers are automatically generated based on county and traditional position.</p>
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
                                <span class="small">Confirm traditional position authenticity</span>
                            </div>
                            <div class="list-group-item px-0 py-2 border-0">
                                <i class="fas fa-check-circle text-success mr-2"></i>
                                <span class="small">Validate community recognition</span>
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
                                <i class="fas fa-file text-muted mr-2"></i>Community Recommendation Letter
                            </li>
                            <li class="mb-1">
                                <i class="fas fa-file text-muted mr-2"></i>Traditional Council Endorsement
                            </li>
                        </ul>
                    </div>

                    <!-- Cautions -->
                    <div class="mb-3">
                        <h6 class="font-weight-bold text-danger mb-3">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Important Cautions
                        </h6>
                        <div class="alert alert-warning border-warning small mb-3">
                            <strong>Double-check all information</strong> before submission. Certificate details cannot be easily modified after creation.
                        </div>
                        <div class="alert alert-warning border-warning small">
                            <strong>Verify traditional position</strong> with local authorities before certification.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Patriotic Theme Enhancements -->
<style>
.card {
    transition: transform 0.2s ease-in-out;
}
.card:hover {
    transform: translateY(-2px);
}

.form-control:focus {
    border-color: #002868;
    box-shadow: 0 0 0 0.2rem rgba(0, 40, 104, 0.25);
}

.custom-file-input:focus ~ .custom-file-label {
    border-color: #002868;
    box-shadow: 0 0 0 0.2rem rgba(0, 40, 104, 0.25);
}

.border-bottom-success {
    border-bottom: 3px solid #28a745 !important;
}

.alert {
    border-radius: 0.5rem;
}

.list-group-item {
    background: transparent;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File input label update and image preview
    const fileInput = document.getElementById('tradCertHolderPic');
    const fileLabel = document.getElementById('fileLabel');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Update file label
            fileLabel.textContent = file.name;
            
            // Show image preview
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            fileLabel.textContent = 'Choose picture file...';
            imagePreview.style.display = 'none';
        }
    });
    
    // Form submission validation
    const form = document.getElementById('certificateForm');
    form.addEventListener('submit', function(e) {
        const holderName = document.getElementById('tradCertHolderName').value.trim();
        if (!holderName) {
            e.preventDefault();
            alert('Please enter the certificate holder name.');
            return false;
        }
        
        const operationType = document.getElementById('tradCertHolderOperationType').value;
        if (!operationType) {
            e.preventDefault();
            alert('Please select a traditional position.');
            return false;
        }
        
        // File size validation (2MB limit)
        const fileInput = document.getElementById('tradCertHolderPic');
        if (fileInput.files[0] && fileInput.files[0].size > 2 * 1024 * 1024) {
            e.preventDefault();
            alert('Picture file size must be less than 2MB.');
            return false;
        }
        
        return true;
    });
});
</script>

<?= $this->endSection() ?>