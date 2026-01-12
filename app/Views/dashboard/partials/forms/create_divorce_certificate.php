<form action="/matrimonial_dashboard/divorce_cert/create" method="post" enctype="multipart/form-data" id="divorceForm">
    <?= csrf_field() ?>

    <div class="row">
        <!-- Plaintiff Section -->
        <div class="col-md-6 mb-3">
            <label class="form-label font-weight-bold text-gray-700">
                <i class="fas fa-user mr-2 text-primary"></i>Plaintiff Name
            </label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('divorceplaintiff') ? 'is-invalid' : '' ?>" 
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

        <!-- Defendant Section -->
        <div class="col-md-6 mb-3">
            <label class="form-label font-weight-bold text-gray-700">
                <i class="fas fa-user-friends mr-2 text-primary"></i>Defendant Name
            </label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('divorcedefendant') ? 'is-invalid' : '' ?>" 
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
    </div>

    <!-- Revenue Number -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label font-weight-bold text-gray-700">
                <i class="fas fa-file-alt mr-2 text-primary"></i>Certificate Revenue Number
            </label>
            <input type="text" class="form-control <?= isset($validation) && $validation->hasError('divorceRevNo') ? 'is-invalid' : '' ?>" 
                name="divorceRevNo"
                value="<?= old('divorceRevNo') ?>"
                placeholder="Enter certificate revenue number">
            <?php if (isset($validation) && $validation->hasError('divorceRevNo')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('divorceRevNo') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Date Fields -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label font-weight-bold text-gray-700">
                <i class="fas fa-calendar-check mr-2 text-primary"></i>Date of Marriage
            </label>
            <input type="date" class="form-control <?= isset($validation) && $validation->hasError('divorcemarriageDate') ? 'is-invalid' : '' ?>" 
                name="divorcemarriageDate" 
                value="<?= old('divorcemarriageDate') ?>"
                required>
            <?php if (isset($validation) && $validation->hasError('divorcemarriageDate')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('divorcemarriageDate') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label font-weight-bold text-gray-700">
                <i class="fas fa-calendar-times mr-2 text-primary"></i>Date of Divorce
            </label>
            <input type="date" class="form-control <?= isset($validation) && $validation->hasError('divorcedateOfDivorce') ? 'is-invalid' : '' ?>" 
                name="divorcedateOfDivorce" 
                value="<?= old('divorcedateOfDivorce') ?>"
                required>
            <?php if (isset($validation) && $validation->hasError('divorcedateOfDivorce')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('divorcedateOfDivorce') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4 mb-3">
            <label class="form-label font-weight-bold text-gray-700">
                <i class="fas fa-calendar-day mr-2 text-primary"></i>Date of Issuance
            </label>
            <input type="date" class="form-control <?= isset($validation) && $validation->hasError('divorceissuanceDate') ? 'is-invalid' : '' ?>" 
                name="divorceissuanceDate" 
                value="<?= old('divorceissuanceDate') ?>"
                required>
            <?php if (isset($validation) && $validation->hasError('divorceissuanceDate')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('divorceissuanceDate') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- File Uploads Section -->
    <div class="mt-4 border-top pt-4">
        <h6 class="font-weight-bold text-gray-800 mb-3">
            <i class="fas fa-cloud-upload-alt mr-2 text-primary"></i>Required Photos
        </h6>

        <div class="row">
            <!-- Plaintiff Picture -->
            <div class="col-md-6 mb-3">
                <div class="card border-left-primary h-100">
                    <div class="card-body">
                        <label for="divorceplaintiffPic" class="font-weight-bold text-gray-700">
                            Plaintiff Picture <span class="text-danger">*</span>
                        </label>
                        <p class="text-muted small mb-2">Upload a clear photo of the plaintiff</p>
                        <input type="file" name="divorceplaintiffPic" id="divorceplaintiffPic" 
                            class="form-control-file" accept="image/*" required>
                        <?php if (isset($validation) && $validation->hasError('divorceplaintiffPic')) : ?>
                            <div class="text-danger small mt-2"><?= $validation->getError('divorceplaintiffPic') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Defendant Picture -->
            <div class="col-md-6 mb-3">
                <div class="card border-left-danger h-100">
                    <div class="card-body">
                        <label for="divorcedefendantPic" class="font-weight-bold text-gray-700">
                            Defendant Picture <span class="text-danger">*</span>
                        </label>
                        <p class="text-muted small mb-2">Upload a clear photo of the defendant</p>
                        <input type="file" name="divorcedefendantPic" id="divorcedefendantPic" 
                            class="form-control-file" accept="image/*" required>
                        <?php if (isset($validation) && $validation->hasError('divorcedefendantPic')) : ?>
                            <div class="text-danger small mt-2"><?= $validation->getError('divorcedefendantPic') ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="mt-4 border-top pt-4">
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    <span class="btn-text">Save Divorce Application</span>
                    <span class="btn-loading" style="display:none;">
                        <i class="fas fa-spinner fa-spin mr-2"></i>Saving...
                    </span>
                </button>
            </div>
            <div class="col-md-6">
                <button type="reset" class="btn btn-outline-secondary btn-block">
                    <i class="fas fa-redo mr-2"></i>Reset Form
                </button>
            </div>
        </div>
    </div>
</form>