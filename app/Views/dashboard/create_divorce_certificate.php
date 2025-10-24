<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="text-primary"><i class="fa fa-file-alt"></i> Log a Divorce Certificate</h4>
            </div>
            <div class="card-body">
                <!-- Display flash messages -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                
                <form action="/dashboard/divorce_cert/create" method="post" enctype="multipart/form-data">
                    <!-- Plaintiff Section -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorceplaintiff"><i class="fa fa-user"></i> Plaintiff Name</label>
                        <input type="text" class="form-control form-control-lg <?= isset($validation) && $validation->hasError('divorceplaintiff') ? 'is-invalid' : '' ?>" 
                            name="divorceplaintiff"
                            value="<?= old('divorceplaintiff') ?>"
                            placeholder="Enter full name of plaintiff"
                            required>
                        <?php if (isset($validation) && $validation->hasError('divorceplaintiff')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('divorceplaintiff') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3 col-12">
                        <label for="divorceplaintiffPic"><i class="fa fa-image"></i> Plaintiff Picture</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= isset($validation) && $validation->hasError('divorceplaintiffPic') ? 'is-invalid' : '' ?>" 
                                id="divorceplaintiffPic" 
                                name="divorceplaintiffPic">
                            <label class="custom-file-label" for="divorceplaintiffPic">Choose file</label>
                        </div>
                        <?php if (isset($validation) && $validation->hasError('divorceplaintiffPic')) : ?>
                            <div class="text-danger small mt-1">
                                <?= $validation->getError('divorceplaintiffPic') ?>
                            </div>
                        <?php endif; ?>
                        <small class="form-text text-muted">Upload a clear photo of the plaintiff</small>
                    </div>

                    <!-- Defendant Section -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorcedefendant"><i class="fa fa-user-friends"></i> Defendant Name</label>
                        <input type="text" class="form-control form-control-lg <?= isset($validation) && $validation->hasError('divorcedefendant') ? 'is-invalid' : '' ?>" 
                            name="divorcedefendant"
                            value="<?= old('divorcedefendant') ?>"
                            placeholder="Enter full name of defendant"
                            required>
                        <?php if (isset($validation) && $validation->hasError('divorcedefendant')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('divorcedefendant') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3 col-12">
                        <label for="divorcedefendantPic"><i class="fa fa-image"></i> Defendant Picture</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= isset($validation) && $validation->hasError('divorcedefendantPic') ? 'is-invalid' : '' ?>" 
                                id="divorcedefendantPic" 
                                name="divorcedefendantPic">
                            <label class="custom-file-label" for="divorcedefendantPic">Choose file</label>
                        </div>
                        <?php if (isset($validation) && $validation->hasError('divorcedefendantPic')) : ?>
                            <div class="text-danger small mt-1">
                                <?= $validation->getError('divorcedefendantPic') ?>
                            </div>
                        <?php endif; ?>
                        <small class="form-text text-muted">Upload a clear photo of the defendant</small>
                    </div>

                    <!-- Revision Number -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorceRevNo"><i class="fa fa-file-alt"></i>Certificate Revenue Number</label>
                        <input type="text" class="form-control form-control-lg <?= isset($validation) && $validation->hasError('divorceRevNo') ? 'is-invalid' : '' ?>" 
                            name="divorceRevNo"
                            value="<?= old('divorceRevNo') ?>"
                            placeholder="Enter certificate revenue number">
                        <?php if (isset($validation) && $validation->hasError('divorceRevNo')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('divorceRevNo') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Existing Date Fields -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorcemarriageDate"><i class="fa fa-calendar-check"></i> Date of Marriage</label>
                        <input type="date" class="form-control form-control-lg <?= isset($validation) && $validation->hasError('divorcemarriageDate') ? 'is-invalid' : '' ?>" 
                            name="divorcemarriageDate" 
                            value="<?= old('divorcemarriageDate') ?>"
                            required>
                        <?php if (isset($validation) && $validation->hasError('divorcemarriageDate')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('divorcemarriageDate') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3 col-12">
                        <label for="divorcedateOfDivorce"><i class="fa fa-calendar-times"></i> Date of Divorce</label>
                        <input type="date" class="form-control form-control-lg <?= isset($validation) && $validation->hasError('divorcedateOfDivorce') ? 'is-invalid' : '' ?>" 
                            name="divorcedateOfDivorce" 
                            value="<?= old('divorcedateOfDivorce') ?>"
                            required>
                        <?php if (isset($validation) && $validation->hasError('divorcedateOfDivorce')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('divorcedateOfDivorce') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mb-3 col-12">
                        <label for="divorceissuanceDate"><i class="fa fa-calendar-day"></i> Date of Issuance</label>
                        <input type="date" class="form-control form-control-lg <?= isset($validation) && $validation->hasError('divorceissuanceDate') ? 'is-invalid' : '' ?>" 
                            name="divorceissuanceDate" 
                            value="<?= old('divorceissuanceDate') ?>"
                            required>
                        <?php if (isset($validation) && $validation->hasError('divorceissuanceDate')) : ?>
                            <div class="invalid-feedback">
                                <?= $validation->getError('divorceissuanceDate') ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group mt-3 col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save Divorce Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Guideline Sidebar -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-light">
                <h5><i class="fa fa-info-circle text-primary"></i> Logging Guidelines</h5>
            </div>
            <div class="card-body small text-muted">
                <ul class="mb-0">
                    <li><i class="fa fa-check-circle text-success"></i> Ensure all names are correctly spelled as per official documents.</li>
                    <li><i class="fa fa-calendar text-success"></i> Use the correct date format (YYYY-MM-DD).</li>
                    <li><i class="fa fa-search text-success"></i> Double-check marriage and divorce dates to avoid errors.</li>
                    <li><i class="fa fa-clock text-success"></i> The issuance date is the day this certificate becomes official.</li>
                    <li><i class="fa fa-asterisk text-danger"></i> All fields marked with an asterisk (*) are mandatory.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Update file input labels to show selected filename
document.querySelectorAll('.custom-file-input').forEach(input => {
    input.addEventListener('change', function() {
        let fileName = this.files[0] ? this.files[0].name : 'Choose file';
        this.nextElementSibling.textContent = fileName;
    });
});
</script>

<?= $this->endSection() ?>