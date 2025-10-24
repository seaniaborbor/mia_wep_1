<?php $this->extend('dashboard/partials/layout')?>

<?=$this->section('main')?>
<div class="container-fluid h-100 mt-3">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-primary mb-0">Applicants or Enrollment</h4>
                    </div>
                    <div class="btn-group">
                        
                           <a class="btn btn-sm btn-outline-primary" download>
                            <i class="fas fa-download me-1"></i> Download Documents
                        </a>
                        <a href="<?= base_url('dashboard/applicants') ?>" 
                           class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row border-bottom mb-5">
                       <div class="col-md-4 mb-0">
                            <h6 class="mb-0">Pending Application</h6>
                            <p><?=$pendingCount?></p>
                       </div>
                       <div class="col-md-4 mb-0">
                            <h6 class="mb-0">Accept Application</h6>
                            <p><?=$approvedCount?></p>
                       </div>
                       <div class="col-md-4 mb-0">
                            <h6 class="mb-0">Rejected Applicant</h6>
                            <p><?=$rejectedCount?></p>
                       </div>
                    </div>
                    <?php if (isset($applicants) && !empty($applicants)): ?>
                       
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Ref ID</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($applicants as $app): ?>
                                    <tr>
                                        <td class="bg-light"><?= $app['applicantRefId'] ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if ($app['applicantProfilePic']): ?>
                                                    <img src="<?= base_url('public_assets/img/applicants/profiles/'.$app['applicantProfilePic']) ?>" 
                                                         class="rounded-circle me-2" width="30" height="30">
                                                <?php else: ?>
                                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-2" 
                                                         style="width:30px;height:30px">
                                                        <?= strtoupper(substr($app['applicantName'], 0, 1)) ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?= $app['applicantName'] ?>
                                            </div>
                                        </td>
                                        <td><?= $app['applicantCourse'] ?></td>
                                        <td class="bg-light">
                                            <?= $app['applicantStatus'] ?>
                                        </td>
                                        <td><?= date('M d, Y', strtotime($app['applicantCreatedAt'])) ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?= base_url('dashboard/applicants/view/'.$app['applicantId']) ?>" 
                                                   class="btn btn-sm btn-outline-warning" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= base_url('dashboard/applicants/approve/'.$app['applicantId']) ?>" 
                                                   class="btn btn-sm btn-outline-primary" title="Approve">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                <a href="<?= base_url('dashboard/applicants/reject/'.$app['applicantId']) ?>" 
                                                   class="btn btn-sm btn-outline-secondary" title="Reject">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <?= $pager->links() ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="text-primary mb-0">New Application</h4>
                </div>
                <div class="card-body">
                   <?php $errors = session('errors') ?? []; ?>

<form action="<?= base_url('dashboard/applicants/store') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="applicantName" class="form-control <?= isset($errors['applicantName']) ? 'is-invalid' : '' ?>" value="<?= old('applicantName') ?>">
        <?php if (isset($errors['applicantName'])): ?>
            <div class="invalid-feedback"><?= $errors['applicantName'] ?></div>
        <?php endif; ?>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select name="applicantGender" class="form-select <?= isset($errors['applicantGender']) ? 'is-invalid' : '' ?>">
                <option value="">Select</option>
                <option value="Male" <?= old('applicantGender') == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Female" <?= old('applicantGender') == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Other" <?= old('applicantGender') == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
            <?php if (isset($errors['applicantGender'])): ?>
                <div class="invalid-feedback"><?= $errors['applicantGender'] ?></div>
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="applicantDob" class="form-control <?= isset($errors['applicantDob']) ? 'is-invalid' : '' ?>" value="<?= old('applicantDob') ?>">
            <?php if (isset($errors['applicantDob'])): ?>
                <div class="invalid-feedback"><?= $errors['applicantDob'] ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label">Country</label>
            <input type="text" name="applicantCountry" class="form-control <?= isset($errors['applicantCountry']) ? 'is-invalid' : '' ?>" value="<?= old('applicantCountry') ?>">
            <?php if (isset($errors['applicantCountry'])): ?>
                <div class="invalid-feedback"><?= $errors['applicantCountry'] ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <label class="form-label">City/Town</label>
            <input type="text" name="applicantCityOrTown" class="form-control <?= isset($errors['applicantCityOrTown']) ? 'is-invalid' : '' ?>" value="<?= old('applicantCityOrTown') ?>">
            <?php if (isset($errors['applicantCityOrTown'])): ?>
                <div class="invalid-feedback"><?= $errors['applicantCityOrTown'] ?></div>
            <?php endif; ?>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Nationality</label>
        <input type="text" name="applicantNationality" class="form-control <?= isset($errors['applicantNationality']) ? 'is-invalid' : '' ?>" value="<?= old('applicantNationality') ?>">
        <?php if (isset($errors['applicantNationality'])): ?>
            <div class="invalid-feedback"><?= $errors['applicantNationality'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="tel" name="applicantPhone" class="form-control <?= isset($errors['applicantPhone']) ? 'is-invalid' : '' ?>" value="<?= old('applicantPhone') ?>">
        <?php if (isset($errors['applicantPhone'])): ?>
            <div class="invalid-feedback"><?= $errors['applicantPhone'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label">Program Applied</label>
        <select name="applicantCourse" class="form-select <?= isset($errors['applicantCourse']) ? 'is-invalid' : '' ?>">
            <option value="">Select Course</option>
            <?php if(isset($courses) && !empty($courses)): ?>
                <?php foreach($courses as $course) : ?>
                    <option value="<?=$course['courseTitle']?>"><?=$course['courseTitle']?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <?php if (isset($errors['applicantCourse'])): ?>
            <div class="invalid-feedback"><?= $errors['applicantCourse'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label">Profile Picture</label>
        <input type="file" name="applicantProfilePic" class="form-control <?= isset($errors['applicantProfilePic']) ? 'is-invalid' : '' ?>">
        <?php if (isset($errors['applicantProfilePic'])): ?>
            <div class="invalid-feedback"><?= $errors['applicantProfilePic'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label class="form-label">Application Documents (PDF)</label>
        <input type="file" name="applicantApplicationFile" class="form-control <?= isset($errors['applicantApplicationFile']) ? 'is-invalid' : '' ?>">
        <?php if (isset($errors['applicantApplicationFile'])): ?>
            <div class="invalid-feedback"><?= $errors['applicantApplicationFile'] ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="fas fa-save me-2"></i> Submit Application
    </button>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>