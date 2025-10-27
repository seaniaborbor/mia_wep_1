```php
<?php $this->extend('dashboard/partials/layout') ?>

<?= $this->section('main') ?>

<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-dark mb-0 font-weight-bold">
                        <i class="fas fa-certificate mr-2 liberia-red"></i>Marriage Certificate Details
                    </h4>
                    <?php 
                        $isCompleted = $certificate['SIGNA'] && $certificate['SIGNB'] && $certificate['SIGNC'];
                        $isIssued = true; // Adjust based on your logic if needed
                    ?>
                    <span class="badge badge-pill px-3 py-2 liberia-status-badge">
                        <i class="fas fa-<?= $isCompleted ? 'check-circle' : 'clock' ?> mr-1"></i>
                        <?= $isCompleted ? 'Completed' : 'Pending' ?>
                    </span>
                </div>
            </div>

            <div class="card-body p-4">
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 liberia-alert" role="alert">
                        <i class="fas fa-check-circle mr-2"></i><?= session('success') ?>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <!-- Certificate Summary -->
                        <div class="card border-0 bg-light mb-4 liberia-card-accent">
                            <div class="card-body py-3">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h3 class="mb-1 liberia-red">Traditional Marriage Certificate</h3>
                                        <p class="text-muted mb-0">
                                            <i class="fas fa-hashtag liberia-blue mr-1"></i>
                                            <strong><?= esc($certificate['marriage_code']) ?></strong>
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-right">
                                        <div class="h5 mb-0 liberia-blue font-weight-bold">
                                            <?= esc($certificate['reference_no']) ?>
                                        </div>
                                        <small class="text-muted">Reference No</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Groom & Bride Info -->
                        <div class="row mb-4">
                            <!-- Groom -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm liberia-card-red">
                                    <div class="card-header bg-white py-2 border-bottom">
                                        <h6 class="m-0 liberia-red">
                                            <i class="fas fa-male liberia-blue mr-2"></i>Groom's Particulars
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p><span class="govt-label">Full Name:</span><br><?= esc($certificate['groom_name']) ?></p>
                                                <p><span class="govt-label">Date of Birth:</span> <?= esc($certificate['groom_dob']) ?> (<?= esc($certificate['groom_age']) ?> yrs)</p>
                                                <p><span class="govt-label">Origin:</span> <?= esc($certificate['groom_county_of_origin']) ?></p>
                                                <p><span class="govt-label">Birth Place:</span> <?= esc($certificate['groom_birth_city']) ?>, <?= esc($certificate['groom_birth_county']) ?></p>
                                                <p><span class="govt-label">Nationality:</span> <?= esc($certificate['groom_nationality']) ?></p>
                                                <p><span class="govt-label">Contact:</span> <?= esc($certificate['groom_cell']) ?></p>
                                                <p><span class="govt-label">Address:</span><br><?= esc($certificate['groom_address']) ?></p>
                                                <p><span class="govt-label">Parents:</span><br>
                                                    Father: <?= esc($certificate['groom_father_name']) ?><br>
                                                    Mother: <?= esc($certificate['groom_mother_name']) ?>
                                                </p>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <img src="<?= base_url('uploads/marriage/' . $certificate['groom_passport_photo']) ?>" class="photo-id img-fluid mb-2" width="120">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bride -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm liberia-card-blue">
                                    <div class="card-header bg-white py-2 border-bottom">
                                        <h6 class="m-0 liberia-blue">
                                            <i class="fas fa-female liberia-red mr-2"></i>Bride's Particulars
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p><span class="govt-label">Full Name:</span><br><?= esc($certificate['bride_name']) ?></p>
                                                <p><span class="govt-label">Date of Birth:</span> <?= esc($certificate['bride_dob']) ?> (<?= esc($certificate['bride_age']) ?> yrs)</p>
                                                <p><span class="govt-label">Origin:</span> <?= esc($certificate['bride_county_of_origin']) ?></p>
                                                <p><span class="govt-label">Birth Place:</span> <?= esc($certificate['bride_birth_city']) ?>, <?= esc($certificate['bride_birth_county']) ?></p>
                                                <p><span class="govt-label">Nationality:</span> <?= esc($certificate['bride_nationality']) ?></p>
                                                <p><span class="govt-label">Contact:</span> <?= esc($certificate['bride_cell']) ?></p>
                                                <p><span class="govt-label">Address:</span><br><?= esc($certificate['bride_address']) ?></p>
                                                <p><span class="govt-label">Parents:</span><br>
                                                    Father: <?= esc($certificate['bride_father_name']) ?><br>
                                                    Mother: <?= esc($certificate['bride_mother_name']) ?>
                                                </p>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <img src="<?= base_url('uploads/marriage/' . $certificate['bride_passport_photo']) ?>" class="photo-id img-fluid mb-2" width="120">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Marriage Details -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-red">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-red">
                                    <i class="fas fa-heart liberia-blue mr-2"></i>Marriage Details
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <small class="text-muted">Place of Marriage</small>
                                        <p class="mb-1 font-weight-bold liberia-blue"><?= esc($certificate['place_of_marriage']) ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Date of Marriage</small>
                                        <p class="mb-1 font-weight-bold liberia-red"><?= esc($certificate['date_of_marriage']) ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Bride's Proposed Name</small>
                                        <p class="mb-1"><?= esc($certificate['bride_proposed_name']) ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Certificate Cost</small>
                                        <p class="mb-1"><?= esc($certificate['certificate_cost']) ?> (<?= esc($certificate['certificate_cost_words']) ?>)</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Witness</small>
                                        <p class="mb-1"><?= esc($certificate['witness_name']) ?> - <?= esc($certificate['witness_contact']) ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Officiator</small>
                                        <p class="mb-1"><?= esc($certificate['officiator_name']) ?> - <?= esc($certificate['officiator_contact']) ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Declarant</small>
                                        <p class="mb-1"><?= esc($certificate['declarant_name']) ?> - <?= esc($certificate['declaration_date']) ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Revenue No</small>
                                        <p class="mb-1"><?= esc($certificate['revenue_no']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Signatories -->
                        <div class="card border-0 shadow-sm liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="m-0 <?= $isCompleted ? 'liberia-blue' : 'liberia-red' ?>">
                                    <i class="fas fa-signature liberia-red mr-2"></i>Signatories
                                </h6>
                                <?php if (!$isCompleted): ?>
                                    <span class="badge liberia-badge-red">Incomplete</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <?php foreach (['A', 'B', 'C'] as $sig): ?>
                                        <?php 
                                            $sigKey = "SIGN{$sig}";
                                            $sigName = $certificate[$sigKey] ?? '';
                                            $sigPath = FCPATH . "uploads/users/signatures/{$sigName}";
                                            $sigUrl  = base_url("uploads/users/signatures/{$sigName}");
                                            $hasSig  = !empty($sigName) && file_exists($sigPath);
                                        ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="p-3 border rounded <?= $hasSig ? 'border-success liberia-signed' : 'border-light' ?>">
                                                <?php if ($hasSig): ?>
                                                    <img src="<?= $sigUrl ?>" alt="Signature <?= $sig ?>" class="img-fluid mb-2" style="max-height: 50px;">
                                                    <p class="mb-0 small liberia-blue"><i class="fas fa-check-circle"></i> Signed</p>
                                                <?php else: ?>
                                                    <i class="fas fa-signature fa-2x liberia-red mb-2"></i>
                                                    <p class="mb-0 small text-muted">Not Signed</p>
                                                <?php endif; ?>
                                                <small class="d-block text-muted">Signatory <?= $sig ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <?php if (!$isIssued): ?>
                                    <div class="alert alert-light mt-3 liberia-alert-warning">
                                        <i class="fas fa-exclamation-triangle liberia-red mr-2"></i>
                                        This certificate requires all three signatures. 
                                        <a href="/dashboard/wedcert/issue/<?= $certificate['marriage_cert_id'] ?>" class="alert-link liberia-blue">Mark as Issued</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Actions -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-blue">
                                    <i class="fas fa-cogs liberia-red mr-2"></i>Actions
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <?php if(session()->get('userData')['userBreanch'] == $certificate['cert_branch']) : ?>
                                        <?php if (session()->get('userData')['userAccountType'] == "ENTRY"): ?>
                                            <?php if(!$isCompleted): ?>
                                                <a href="/dashboard/wedcert/edit/<?= $certificate['marriage_cert_id'] ?>" class="btn btn-sm liberia-btn-red">
                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php if(!$isCompleted): ?>
                                                <a href="/dashboard/wedcert/sign/<?= $certificate['marriage_cert_id'] ?>" class="btn btn-sm liberia-btn-blue">
                                                    <i class="fas fa-signature mr-1"></i> Sign
                                                </a>
                                            <?php else: ?>
                                                <a href="/dashboard/wedcert/allow_edit/<?= $certificate['marriage_cert_id'] ?>" class="btn btn-sm liberia-btn-red">
                                                    <i class="fas fa-pen mr-1"></i> Allow Edit
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <a href="/dashboard/wedcert/print/<?= $certificate['marriage_cert_id'] ?>" class="btn btn-sm liberia-btn-blue">
                                        <i class="fas fa-print mr-1"></i> Print
                                    </a>
                                    <a href="/wedcert" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-arrow-left mr-1"></i> Back
                                    </a>
                                    <a href="/dashboard/wedcert/delete/<?= $certificate['marriage_cert_id'] ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Are you sure you want to delete this certificate? This action cannot be undone.');">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Guidelines Card -->
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-warning text-white py-3">
                                <h5 class="mb-0"><i class="fas fa-lightbulb mr-2"></i>Editing Guidelines</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">
                                    Please review all information carefully before saving changes to a certificate record.
                                </p>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Ensure names and dates are accurate.</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Verify places and contacts.</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Replace photos only if necessary.</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Check marriage details and costs.</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Confirm witness and officiator info.</li>
                                </ul>
                                <hr>
                                <h6 class="text-secondary font-weight-bold">Important Note:</h6>
                                <p class="text-muted mb-0">
                                    Updating a certificate will <strong>replace the existing record</strong>. 
                                    Double-check details before saving. Once updated, data appears on the verification portal.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
```