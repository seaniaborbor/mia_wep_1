<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row mt-3">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-success py-3">
                <h4 class="text-success mb-0 font-weight-bold">
                    <i class="fas fa-plus-circle text-success mr-2"></i>Create New Traditional Certificate
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

                <form action="/dashboard/nativecert/store" method="post" id="certificateForm" enctype="multipart/form-data">
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

                        <!-- Add Pic Input Field -->
                        <div class="col-md-6 mb-3">
                            <label for="tradCertHolderPic" class="form-label font-weight-bold">Holder Picture</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= session('errors.tradCertHolderPic') ? 'is-invalid' : '' ?>" 
                                    id="tradCertHolderPic" name="tradCertHolderPic" 
                                    accept="image/*">
                                <label class="custom-file-label" for="tradCertHolderPic" id="fileLabel">Choose picture file...</label>
                                <?php if (session('errors.tradCertHolderPic')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tradCertHolderPic') ?></div>
                                <?php endif; ?>
                            </div>
                            <small class="form-text text-muted">Optional: Upload a picture of the certificate holder (JPG, PNG, GIF - Max 2MB)</small>
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <img id="previewImage" src="#" alt="Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="tradCertHolderOperationType" class="form-label font-weight-bold">Traditional Position <span class="text-danger">*</span></label>
                            <select class="form-control <?= session('errors.tradCertHolderOperationType') ? 'is-invalid' : '' ?>" 
                                id="tradCertHolderOperationType" name="tradCertHolderOperationType" required>
                                <option value="">Select Traditional Position</option>
                                <option value="ratualist" <?= old('tradCertHolderOperationType') == 'ratualist' ? 'selected' : '' ?>>Ratualist (Traditional Spiritual Healer)</option>
                                <option value="herbalist" <?= old('tradCertHolderOperationType') == 'herbalist' ? 'selected' : '' ?>>Herbalist (Traditional Medicine Practitioner)</option>
                                <option value="native_doctor" <?= old('tradCertHolderOperationType') == 'native_doctor' ? 'selected' : '' ?>>Native Doctor (Traditional Doctor)</option>
                                <option value="zoe" <?= old('tradCertHolderOperationType') == 'zoe' ? 'selected' : '' ?>>Zoe (Sande Society Leader)</option>
                                <option value="bodio" <?= old('tradCertHolderOperationType') == 'bodio' ? 'selected' : '' ?>>Bodio (Traditional Priest/Diviner)</option>
                                <option value="sowei" <?= old('tradCertHolderOperationType') == 'sowei' ? 'selected' : '' ?>>Sowei (Sande Society Instructor)</option>
                                <option value="zoebah" <?= old('tradCertHolderOperationType') == 'zoebah' ? 'selected' : '' ?>>Zoebah (Poro Society Leader)</option>
                                <option value="country_doctor" <?= old('tradCertHolderOperationType') == 'country_doctor' ? 'selected' : '' ?>>Country Doctor (Rural Traditional Healer)</option>
                                <option value="medicine_man" <?= old('tradCertHolderOperationType') == 'medicine_man' ? 'selected' : '' ?>>Medicine Man</option>
                                <option value="medicine_woman" <?= old('tradCertHolderOperationType') == 'medicine_woman' ? 'selected' : '' ?>>Medicine Woman</option>
                                <option value="spiritual_healer" <?= old('tradCertHolderOperationType') == 'spiritual_healer' ? 'selected' : '' ?>>Spiritual Healer</option>
                                <option value="diviner" <?= old('tradCertHolderOperationType') == 'diviner' ? 'selected' : '' ?>>Diviner (Fortune Teller)</option>
                                <option value="traditional_midwife" <?= old('tradCertHolderOperationType') == 'traditional_midwife' ? 'selected' : '' ?>>Traditional Midwife</option>
                                <option value="bone_setter" <?= old('tradCertHolderOperationType') == 'bone_setter' ? 'selected' : '' ?>>Bone Setter (Fracture Specialist)</option>
                                <option value="circumciser" <?= old('tradCertHolderOperationType') == 'circumciser' ? 'selected' : '' ?>>Traditional Circumciser</option>
                                <option value="rain_maker" <?= old('tradCertHolderOperationType') == 'rain_maker' ? 'selected' : '' ?>>Rain Maker</option>
                                <option value="juju_man" <?= old('tradCertHolderOperationType') == 'juju_man' ? 'selected' : '' ?>>Juju Man (Charm Maker)</option>
                                <option value="juju_woman" <?= old('tradCertHolderOperationType') == 'juju_woman' ? 'selected' : '' ?>>Juju Woman (Charm Maker)</option>
                                <option value="poro_elder" <?= old('tradCertHolderOperationType') == 'poro_elder' ? 'selected' : '' ?>>Poro Society Elder</option>
                                <option value="sande_elder" <?= old('tradCertHolderOperationType') == 'sande_elder' ? 'selected' : '' ?>>Sande Society Elder</option>
                                <option value="tribal_chief" <?= old('tradCertHolderOperationType') == 'tribal_chief' ? 'selected' : '' ?>>Tribal Chief</option>
                                <option value="town_crier" <?= old('tradCertHolderOperationType') == 'town_crier' ? 'selected' : '' ?>>Town Crier</option>
                                <option value="cultural_elder" <?= old('tradCertHolderOperationType') == 'cultural_elder' ? 'selected' : '' ?>>Cultural Elder</option>
                                <option value="dance_master" <?= old('tradCertHolderOperationType') == 'dance_master' ? 'selected' : '' ?>>Dance Master</option>
                                <option value="drum_master" <?= old('tradCertHolderOperationType') == 'drum_master' ? 'selected' : '' ?>>Drum Master</option>
                                <option value="story_teller" <?= old('tradCertHolderOperationType') == 'story_teller' ? 'selected' : '' ?>>Story Teller</option>
                                <option value="blacksmith" <?= old('tradCertHolderOperationType') == 'blacksmith' ? 'selected' : '' ?>>Blacksmith</option>
                                <option value="potter" <?= old('tradCertHolderOperationType') == 'potter' ? 'selected' : '' ?>>Potter</option>
                                <option value="weaver" <?= old('tradCertHolderOperationType') == 'weaver' ? 'selected' : '' ?>>Weaver</option>
                                <option value="fisherman" <?= old('tradCertHolderOperationType') == 'fisherman' ? 'selected' : '' ?>>Traditional Fisherman</option>
                                <option value="hunter" <?= old('tradCertHolderOperationType') == 'hunter' ? 'selected' : '' ?>>Traditional Hunter</option>
                                <option value="farmer" <?= old('tradCertHolderOperationType') == 'farmer' ? 'selected' : '' ?>>Traditional Farmer</option>
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
                            <label for="tradCertAmtPaid" class="form-label font-weight-bold">Amount Paid</label>
                            <input type="number" class="form-control <?= session('errors.tradCertAmtPaid') ? 'is-invalid' : '' ?>" 
                                id="tradCertAmtPaid" name="tradCertAmtPaid" 
                                value="<?= old('tradCertAmtPaid') ?>" 
                                placeholder="Enter district">
                            <?php if (session('errors.tradCertAmtPaid')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertAmtPaid') ?></div>
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
                    <p class="mb-2 small">Certificate serial numbers are automatically generated based on county and traditional position.</p>
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
                            <i class="fas fa-file text-muted mr-2"></i>Community Recommendation Letter
                        </li>
                        <li class="mb-1">
                            <i class="fas fa-file text-muted mr-2"></i>Traditional Council Endorsement
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
                        <strong>Verify traditional position</strong> with local authorities before certification.
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
                    <p class="small mb-2">• Picture should be clear and professional</p>
                    <p class="small mb-0">• Select the appropriate traditional position for proper classification</p>
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

.custom-file-input:focus ~ .custom-file-label {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.img-thumbnail {
    border-radius: 0.375rem;
}
</style>