<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="text-primary"><i class="fa fa-file-alt"></i> Edit Divorce Certificate</h4>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="/dashboard/edit_divorce_cert/<?= esc($divorceCert['divorceCertId']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Plaintiff Name -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorceplaintiff"><i class="fa fa-user"></i> Plaintiff Name</label>
                        <input type="text" class="form-control <?= isset($validation) && $validation->hasError('divorceplaintiff') ? 'is-invalid' : '' ?>"
                               name="divorceplaintiff" value="<?= old('divorceplaintiff', $divorceCert['divorceplaintiff']) ?>" required>
                        <?php if (isset($validation) && $validation->hasError('divorceplaintiff')) : ?>
                            <div class="invalid-feedback"><?= $validation->getError('divorceplaintiff') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Plaintiff Picture -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorceplaintiffPic"><i class="fa fa-image"></i> Plaintiff Picture</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="divorceplaintiffPic" id="divorceplaintiffPic">
                            <label class="custom-file-label" for="divorceplaintiffPic">Choose file</label>
                        </div>
                        <?php if (!empty($divorceCert['divorceplaintiffPic'])): ?>
                            <div class="mt-2">
                                <img src="<?= base_url('uploads/divorce/' . $divorceCert['divorceplaintiffPic']) ?>" class="img-thumbnail" style="max-width: 120px;">
                                <small class="text-muted d-block">Current photo</small>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Defendant Name -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorcedefendant"><i class="fa fa-user-friends"></i> Defendant Name</label>
                        <input type="text" class="form-control <?= isset($validation) && $validation->hasError('divorcedefendant') ? 'is-invalid' : '' ?>"
                               name="divorcedefendant" value="<?= old('divorcedefendant', $divorceCert['divorcedefendant']) ?>" required>
                        <?php if (isset($validation) && $validation->hasError('divorcedefendant')) : ?>
                            <div class="invalid-feedback"><?= $validation->getError('divorcedefendant') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Defendant Picture -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorcedefendantPic"><i class="fa fa-image"></i> Defendant Picture</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="divorcedefendantPic" id="divorcedefendantPic">
                            <label class="custom-file-label" for="divorcedefendantPic">Choose file</label>
                        </div>
                        <?php if (!empty($divorceCert['divorcedefendantPic'])): ?>
                            <div class="mt-2">
                                <img src="<?= base_url('uploads/divorce/' . $divorceCert['divorcedefendantPic']) ?>" class="img-thumbnail" style="max-width: 120px;">
                                <small class="text-muted d-block">Current photo</small>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Revision Number -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorceRevNo"><i class="fa fa-file-alt"></i> Certificate Revenue Number</label>
                        <input type="text" class="form-control" name="divorceRevNo" value="<?= old('divorceRevNo', $divorceCert['divorceRevNo']) ?>">
                    </div>

                    <!-- Marriage Date -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorcemarriageDate"><i class="fa fa-calendar-check"></i> Date of Marriage</label>
                        <input type="date" class="form-control" name="divorcemarriageDate" value="<?= old('divorcemarriageDate', $divorceCert['divorcemarriageDate']) ?>" required>
                    </div>

                    <!-- Divorce Date -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorcedateOfDivorce"><i class="fa fa-calendar-times"></i> Date of Divorce</label>
                        <input type="date" class="form-control" name="divorcedateOfDivorce" value="<?= old('divorcedateOfDivorce', $divorceCert['divorcedateOfDivorce']) ?>" required>
                    </div>

                    <!-- Issuance Date -->
                    <div class="form-group mb-3 col-12">
                        <label for="divorceissuanceDate"><i class="fa fa-calendar-day"></i> Date of Issuance</label>
                        <input type="date" class="form-control" name="divorceissuanceDate" value="<?= old('divorceissuanceDate', $divorceCert['divorceissuanceDate']) ?>" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mt-3 col-12">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Divorce Certificate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar Guidelines -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-light">
                <h5><i class="fa fa-info-circle text-primary"></i> Editing Guidelines</h5>
            </div>
            <div class="card-body small text-muted">
                <ul class="mb-0">
                    <li><i class="fa fa-check-circle text-success"></i> Check all names carefully.</li>
                    <li><i class="fa fa-calendar text-success"></i> Date format must be YYYY-MM-DD.</li>
                    <li><i class="fa fa-search text-success"></i> Ensure the marriage and divorce dates are accurate.</li>
                    <li><i class="fa fa-clock text-success"></i> Issuance date makes the document official.</li>
                    <li><i class="fa fa-asterisk text-danger"></i> Required fields must be filled.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Show filename after selecting
document.querySelectorAll('.custom-file-input').forEach(input => {
    input.addEventListener('change', function () {
        const fileName = this.files.length > 0 ? this.files[0].name : 'Choose file';
        this.nextElementSibling.innerText = fileName;
    });
});
</script>
<?= $this->endSection() ?>
