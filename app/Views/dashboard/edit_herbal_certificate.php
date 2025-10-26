<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row mt-3">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-warning py-3">
                <h4 class="text-warning mb-0 font-weight-bold">
                    <i class="fas fa-edit text-warning mr-2"></i>Edit Traditional Certificate
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

                <form action="/dashboard/nativecert/update/<?= esc($certificate['tradCertId']) ?>" method="post" id="certificateForm" enctype="multipart/form-data">
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
                                value="<?= old('tradCertHolderName', $certificate['tradCertHolderName']) ?>" required>
                            <?php if (session('errors.tradCertHolderName')): ?>
                                <div class="invalid-feedback"><?= session('errors.tradCertHolderName') ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Picture -->
                        <div class="col-md-6 mb-3">
                            <label for="tradCertHolderPic" class="form-label font-weight-bold">Holder Picture</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= session('errors.tradCertHolderPic') ? 'is-invalid' : '' ?>" 
                                    id="tradCertHolderPic" name="tradCertHolderPic" accept="image/*">
                                <label class="custom-file-label" for="tradCertHolderPic" id="fileLabel">Choose new picture...</label>
                                <?php if (session('errors.tradCertHolderPic')): ?>
                                    <div class="invalid-feedback"><?= session('errors.tradCertHolderPic') ?></div>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($certificate['tradCertHolderPic'])): ?>
                                <div id="imagePreview" class="mt-2">
                                    <img src="<?= base_url('/uploads/nativecert/' . $certificate['tradCertHolderPic']) ?>" 
                                         alt="Current Picture" class="img-thumbnail" style="max-width:150px; max-height:150px;">
                                </div>
                            <?php else: ?>
                                <div id="imagePreview" class="mt-2" style="display:none;">
                                    <img id="previewImage" src="#" alt="Preview" class="img-thumbnail" style="max-width:150px; max-height:150px;">
                                </div>
                            <?php endif; ?>
                            <small class="form-text text-muted">Upload only if replacing existing picture (Max 2MB)</small>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="tradCertHolderOperationType" class="form-label font-weight-bold">Traditional Position <span class="text-danger">*</span></label>
                            <select class="form-control" id="tradCertHolderOperationType" name="tradCertHolderOperationType" required>
                                <option value="">Select Traditional Position</option>
                                <?php 
                                    $positions = [
                                        'ratualist'=>'Ratualist (Traditional Spiritual Healer)',
                                        'herbalist'=>'Herbalist (Traditional Medicine Practitioner)',
                                        'native_doctor'=>'Native Doctor (Traditional Doctor)',
                                        'zoe'=>'Zoe (Sande Society Leader)',
                                        'bodio'=>'Bodio (Traditional Priest/Diviner)',
                                        'sowei'=>'Sowei (Sande Society Instructor)',
                                        'zoebah'=>'Zoebah (Poro Society Leader)',
                                        'country_doctor'=>'Country Doctor (Rural Traditional Healer)',
                                        'medicine_man'=>'Medicine Man',
                                        'medicine_woman'=>'Medicine Woman',
                                        'spiritual_healer'=>'Spiritual Healer',
                                        'diviner'=>'Diviner (Fortune Teller)',
                                        'traditional_midwife'=>'Traditional Midwife',
                                        'bone_setter'=>'Bone Setter',
                                        'circumciser'=>'Traditional Circumciser',
                                        'rain_maker'=>'Rain Maker',
                                        'juju_man'=>'Juju Man (Charm Maker)',
                                        'juju_woman'=>'Juju Woman (Charm Maker)',
                                        'poro_elder'=>'Poro Society Elder',
                                        'sande_elder'=>'Sande Society Elder',
                                        'tribal_chief'=>'Tribal Chief',
                                        'town_crier'=>'Town Crier',
                                        'cultural_elder'=>'Cultural Elder',
                                        'dance_master'=>'Dance Master',
                                        'drum_master'=>'Drum Master',
                                        'story_teller'=>'Story Teller',
                                        'blacksmith'=>'Blacksmith',
                                        'potter'=>'Potter',
                                        'weaver'=>'Weaver',
                                        'fisherman'=>'Traditional Fisherman',
                                        'hunter'=>'Traditional Hunter',
                                        'farmer'=>'Traditional Farmer'
                                    ];
                                    foreach ($positions as $key => $label): 
                                ?>
                                    <option value="<?= $key ?>" <?= old('tradCertHolderOperationType', $certificate['tradCertHolderOperationType']) == $key ? 'selected' : '' ?>><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tradCertHolderTownorCity" class="form-label font-weight-bold">Town/City <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="tradCertHolderTownorCity" name="tradCertHolderTownorCity" 
                                value="<?= old('tradCertHolderTownorCity', $certificate['tradCertHolderTownorCity']) ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tradCertHolderDistrict" class="form-label font-weight-bold">District</label>
                            <input type="text" class="form-control" id="tradCertHolderDistrict" name="tradCertHolderDistrict" 
                                value="<?= old('tradCertHolderDistrict', $certificate['tradCertHolderDistrict']) ?>">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="tradCertHoldercounty" class="form-label font-weight-bold">County <span class="text-danger">*</span></label>
                            <select class="form-control" id="tradCertHoldercounty" name="tradCertHoldercounty" required>
                                <option value="">Select County</option>
                                <?php 
                                    $counties = ['Bomi','Bong','Gbarpolu','Grand Bassa','Grand Cape Mount','Grand Gedeh','Grand Kru',
                                                 'Lofa','Margibi','Maryland','Montserrado','Nimba','River Cess','River Gee','Sinoe'];
                                    foreach ($counties as $county): ?>
                                    <option value="<?= $county ?>" <?= old('tradCertHoldercounty', $certificate['tradCertHoldercounty']) == $county ? 'selected' : '' ?>><?= $county ?></option>
                                <?php endforeach; ?>
                            </select>
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
                            <label for="tradCertDuration" class="form-label font-weight-bold">Duration (Days)</label>
                            <input type="number" class="form-control" id="tradCertDuration" name="tradCertDuration" 
                                value="<?= old('tradCertDuration', $certificate['tradCertDuration']) ?>" min="1">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tradRevenueNo" class="form-label font-weight-bold">Revenue Number</label>
                            <input type="text" class="form-control" id="tradRevenueNo" name="tradRevenueNo" 
                                value="<?= old('tradRevenueNo', $certificate['tradRevenueNo']) ?>">
                        </div>

                    </div>

                    <!-- Actions -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <a href="/dashboard/nativecert" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-warning text-white">
                                    <i class="fas fa-save mr-2"></i>Update Certificate
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
        <div class="card shadow-sm border-0">
    <div class="card-header bg-warning text-white py-3">
        <h5 class="mb-0"><i class="fas fa-lightbulb mr-2"></i>Editing Guidelines</h5>
    </div>
    <div class="card-body">
        <p class="text-muted mb-3">
            Please review all information carefully before saving changes to a certificate record.
        </p>
        <ul class="list-unstyled">
            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Ensure the holder’s full name is spelled correctly.</li>
            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Verify the town, district, and county are accurate.</li>
            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Only replace the picture if it’s outdated or incorrect.</li>
            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Confirm the operation type reflects the holder’s actual traditional role.</li>
            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Check the issue date and duration to ensure validity.</li>
            <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Review the revenue number and application type for consistency.</li>
        </ul>

        <hr>

        <h6 class="text-secondary font-weight-bold">Important Note:</h6>
        <p class="text-muted mb-0">
            Updating a certificate will <strong>replace the existing record</strong>. 
            Double-check details before saving. Once updated, the new data will appear on the verification portal.
        </p>
    </div>
</div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const appTypeSelect = document.getElementById('tradCertAppliedType');
    const branchField = document.getElementById('branchField');
    appTypeSelect.addEventListener('change', function() {
        branchField.style.display = (this.value === 'branch') ? 'block' : 'none';
    });

    const fileInput = document.getElementById('tradCertHolderPic');
    const fileLabel = document.getElementById('fileLabel');
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        fileLabel.textContent = file ? file.name : 'Choose new picture...';
    });
});
</script>

<style>
.card { border-radius: 0.5rem; }
.img-thumbnail { border-radius: 0.375rem; }
.form-control:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
}
</style>

<?= $this->endSection() ?>
