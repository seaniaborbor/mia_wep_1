<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>

<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <!-- ==================== HEADER ==================== -->
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-dark mb-0 font-weight-bold">
                        Marriage Certificate Details
                    </h4>
                    <?php
                        $signA = !empty($certificate['SIGNA']);
                        $signB = !empty($certificate['SIGNB']);
                        $signC = !empty($certificate['SIGNC']);
                        $isCompleted = $signA && $signB && $signC;
                        $anySignature = $signA || $signB || $signC;
                        $allMissing   = !$signA && !$signB && !$signC;
                    ?>
                    <span class="badge badge-pill px-3 py-2 liberia-status-badge
                        <?= $isCompleted
                            ? 'bg-success text-white'
                            : 'bg-warning text-dark animate__animated animate__pulse animate__infinite' ?>">
                        <?= $isCompleted ? 'Completed' : 'Pending' ?>
                    </span>
                    <?php if($certificate['isWedCertIssued'] == 1): ?>
                        <span class="btn btn-sm btn-success rounded-circle">
                            <i class="fa fa-check-circle"></i>
                        </span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ==================== BODY ==================== -->
            <div class="card-body p-4">
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show border-0 liberia-alert" role="alert">
                        <?= session('success') ?>
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <!-- ==================== MAIN CONTENT ==================== -->
                    <div class="col-lg-8">

                        <!-- Certificate Summary -->
                        <div class="card border-0 bg-light mb-4 liberia-card-accent">
                            <div class="card-body py-3">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h3 class="mb-1 liberia-red">Traditional Marriage Certificate</h3>
                                        <p class="text-muted mb-0">
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

                        <!-- Groom & Bride -->
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
                                                <?php
                                                    $photoPath = FCPATH . 'uploads/marriage/' . $certificate['groom_passport_photo'];
                                                    $photoUrl  = base_url('uploads/marriage/' . $certificate['groom_passport_photo']);
                                                    $hasPhoto  = file_exists($photoPath);
                                                ?>
                                                <?php if ($hasPhoto): ?>
                                                    <img src="<?= $photoUrl ?>" alt="Groom Photo"
                                                         class="img-fluid rounded shadow-sm liberia-photo-border"
                                                         style="width:120px;height:120px;object-fit:cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm liberia-photo-border"
                                                         style="width:120px;height:120px;">
                                                        <i class="fas fa-male fa-3x liberia-red"></i>
                                                    </div>
                                                <?php endif; ?>
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
                                    <div the card-body">
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
                                                <?php
                                                    $photoPath = FCPATH . 'uploads/marriage/' . $certificate['bride_passport_photo'];
                                                    $photoUrl  = base_url('uploads/marriage/' . $certificate['bride_passport_photo']);
                                                    $hasPhoto  = file_exists($photoPath);
                                                ?>
                                                <?php if ($hasPhoto): ?>
                                                    <img src="<?= $photoUrl ?>" alt="Bride Photo"
                                                         class="img-fluid rounded liberia-photo-border"
                                                         style="width:120px;height:120px;object-fit:cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center liberia-photo-border"
                                                         style="width:120px;height:120px;">
                                                        <i class="fas fa-female fa-3x liberia-red"></i>
                                                    </div>
                                                <?php endif; ?>
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

                        <!-- Attached Files -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="m-0 liberia-blue">
                                    <i class="fas fa-paperclip liberia-red mr-2"></i>Attached Files
                                </h6>
                                <button type="button" class="btn btn-sm liberia-btn-blue" data-toggle="modal" data-target="#uploadFileModal">
                                    Upload File
                                </button>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($attachedFiles)): ?>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>File Title</th>
                                                    <th>Upload Date</th>
                                                    <th>Uploaded By</th>
                                                    <th width="80">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($attachedFiles as $file): ?>
                                                    <?php
                                                        $filePath = 'uploads/certificates/' . $file['certificateFile'];
                                                        $fileUrl  = base_url($filePath);
                                                        $fileExt  = strtolower(pathinfo($file['certificateFile'], PATHINFO_EXTENSION));
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-decoration-none file-preview-link"
                                                               data-toggle="modal" data-target="#filePreviewModal"
                                                               data-title="<?= esc($file['fileTitle']) ?>"
                                                               data-url="<?= $fileUrl ?>"
                                                               data-type="<?= $fileExt ?>">
                                                                <?= esc($file['fileTitle']) ?>
                                                            </a>
                                                        </td>
                                                        <td><?= date('M j, Y', strtotime($file['fileCreatedAt'])) ?></td>
                                                        <td><?= esc($file['userFullName']) ?></td>
                                                        <td>
                                                            <a href="/dashboard/wedcert/delete_file/<?= $file['fileId'] ?>/<?= $certificate['marriage_cert_id'] ?>"
                                                               class="btn btn-sm btn-outline-danger"
                                                               onclick="return confirm('Delete this file?');">
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <p class="text-muted mb-0">No files attached yet.</p>
                                        <small class="text-muted">Click the upload button to add files.</small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Signatories Grid -->
                        <div class="card border-0 shadow-sm liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="m-0 <?= $isCompleted ? 'liberia-blue' : 'liberia-red' ?>">
                                    <i class="fas fa-signature liberia-red mr-2"></i>Signatories
                                </h6>
                                <?php if (!$isCompleted): ?>
                                    <span class="badge badge-danger px-3 py-2 animate__animated animate__flash animate__infinite">
                                        Incomplete
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <?php foreach (['A', 'B', 'C'] as $sig): ?>
                                        <?php
                                            $sigKey      = "SIGN{$sig}";
                                            $sigDateKey  = "SIGN{$sig}_signedDate";
                                            $sigName     = $certificate[$sigKey] ?? '';
                                            $sigDate     = $certificate[$sigDateKey] ?? '';
                                            $sigPath     = FCPATH . "uploads/users/signatures/{$sigName}";
                                            $sigUrl      = base_url("uploads/users/signatures/{$sigName}");
                                            $hasSig      = !empty($sigName) && file_exists($sigPath);
                                        ?>
                                        <div class="col-md-4 mb-3">
                                            <div class="p-3 border rounded <?= $hasSig ? 'border-success liberia-signed' : 'border-light' ?>">
                                                <?php if ($hasSig): ?>
                                                    <img src="<?= $sigUrl ?>" alt="Signature <?= $sig ?>"
                                                         class="img-fluid mb-2" style="max-height:50px;">
                                                    <p class="mb-0 small liberia-blue">Signed</p>
                                                    <?php if ($sigDate): ?>
                                                        <small class="d-block text-success font-weight-bold">
                                                            <?= date('M j, Y', strtotime($sigDate)) ?>
                                                        </small>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <p class="mb-0 small text-muted">Not Signed</p>
                                                    <small class="d-block text-muted">—</small>
                                                <?php endif; ?>
                                                <small class="d-block text-muted mt-1">Signatory <?= $sig ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php if($isCompleted && $certificate['isWedCertIssued'] == 0) : ?>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p>The certificate is completed, please click <a href="/dashboard/wedcert/issue/<?= $certificate['marriage_cert_id'] ?>">here </a> to mark it as Issued. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- ==================== SIDEBAR ==================== -->
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
                                    <?php
                                        $userBranch      = session()->get('userData')['userBreanch'] ?? '';
                                        $certBranch      = $certificate['cert_branch'] ?? '';
                                        $userAccountType = session()->get('userData')['userAccountType'] ?? '';
                                        $sameBranch      = ($userBranch == $certBranch);
                                    ?>
                                    <?php if ($sameBranch): ?>
                                        <!-- ENTRY user: Edit & Delete only if NO signatures -->
                                        <?php if ($userAccountType === 'ENTRY' && $allMissing): ?>
                                            <a href="/dashboard/wedcert/edit/<?= $certificate['marriage_cert_id'] ?>"
                                               class="btn btn-sm liberia-btn-red">Edit</a>
                                            <a href="/dashboard/wedcert/delete/<?= $certificate['marriage_cert_id'] ?>"
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Delete this certificate?');">Delete</a>
                                        <?php endif; ?>

                                        <!-- Non-ENTRY: Sign if not complete -->
                                        <?php if ($userAccountType !== 'ENTRY' && !$isCompleted): ?>
                                            <a href="/dashboard/wedcert/sign/<?= $certificate['marriage_cert_id'] ?>"
                                               class="btn btn-sm liberia-btn-blue">Sign</a>
                                        <?php endif; ?>

                                        <!-- Allow Edit: ONLY for SIGNC when complete -->
                                        <?php if ($userAccountType === 'SIGNC'): ?>
                                            <a href="/dashboard/wedcert/allow_edit/<?= $certificate['marriage_cert_id'] ?>"
                                               class="btn btn-sm liberia-btn-red">Allow Edit</a>
                                        <?php endif; ?>

                                        <!-- Always available -->
                                        <a href="/dashboard/wedcert/print/<?= $certificate['marriage_cert_id'] ?>"
                                           class="btn btn-sm liberia-btn-blue">Print</a>
                                    <?php endif; ?>
                                    <a href="/wedcert" class="btn btn-sm btn-outline-secondary">Back</a>
                                </div>
                            </div>
                        </div>

                        <!-- Editing Guidelines (only for ENTRY when no signatures) -->
                        <?php if ($userAccountType === 'ENTRY' && $allMissing): ?>
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-primary text-white py-3">
                                <h5 class="mb-0">Editing Guidelines</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">Please review all information carefully before saving changes.</p>
                                <ul class="list-unstyled">
                                    <li class="mb-2">Ensure names and dates are accurate.</li>
                                    <li class="mb-2">Verify places and contacts.</li>
                                    <li class="mb-2">Replace photos only if necessary.</li>
                                    <li class="mb-2">Check marriage details and costs.</li>
                                    <li class="mb-2">Confirm witness and officiator info.</li>
                                </ul>
                                <hr>
                                <h6 class="text-secondary font-weight-bold">Important Note:</h6>
                                <p class="text-muted mb-0">Updating a certificate will <strong>replace the existing record</strong>.</p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Dynamic Status Card -->
                        <?php if ($isCompleted): ?>
                            <div class="card border-0 shadow-sm mb-4 bg-success text-white">
                                <div class="card-body text-center py-4">
                                    <i class="fas fa-check-circle fa-2x mb-3"></i>
                                    <h5 class="mb-2">Processing Complete and Closed</h5>
                                    <p class="mb-0 small">
                                        All three signatories have signed.<br>
                                        This document is now <strong>finalized and locked</strong>.
                                    </p>
                                </div>
                            </div>
                        <?php elseif ($allMissing): ?>
                            <div class="card border-0 shadow-sm mb-4 bg-info text-white">
                                <div class="card-body text-center py-4">
                                    <i class="fas fa-pen fa-2x mb-3"></i>
                                    <h5 class="mb-2">Ready to Sign</h5>
                                    <p class="mb-0 small">
                                        No signatures have been added yet.<br>
                                        You may now <strong>start signing</strong> this document.
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Signatory Profiles (if any) -->
                        <?php
                        $signers = [];
                        foreach (['SIGNA_profile', 'SIGNB_profile', 'SIGNC_profile'] as $key) {
                            if (!empty($signerProfiles[$key])) {
                                $signers[] = array_merge($signerProfiles[$key], ['signatoryLabel' => substr($key, 4, 1)]);
                            }
                        }
                        ?>
                        <?php if (!empty($signers)): ?>
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-blue">Signatory Profiles</h6>
                            </div>
                            <div class="card-body p-0">
                                <?php foreach ($signers as $signer): ?>
                                    <?php
                                        $photoPath = FCPATH . '/uploads/users/pictures/' . ($signer['userPicture'] ?? '');
                                        $photoUrl  = base_url('/uploads/users/pictures/' . ($signer['userPicture'] ?? ''));
                                        $hasPhoto  = !empty($signer['userPicture']) && file_exists($photoPath);
                                        $sigKey    = "SIGN" . $signer['signatoryLabel'];
                                        $hasSigned = !empty($certificate[$sigKey]);
                                    ?>
                                    <div class="p-3 border-bottom signer-card">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <?php if ($hasPhoto): ?>
                                                    <img src="<?= $photoUrl ?>" alt="<?= esc($signer['userFullName']) ?>"
                                                         class="rounded-circle shadow-sm" style="width:50px;height:50px;object-fit:cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width:50px;height:50px;">
                                                        <i class="fas fa-user text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <h6 class="mb-0"><?= esc($signer['userFullName']) ?></h6>
                                                <small class="text-muted">
                                                    Signatory <?= $signer['signatoryLabel'] ?> – <?= esc($signer['userPosition']) ?>
                                                </small>
                                            </div>
                                            <div>
                                                <span class="badge <?= $hasSigned ? 'badge-success' : 'badge-secondary' ?> badge-pill">
                                                    <?= $hasSigned ? 'Signed' : 'Pending' ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Certificate Metadata -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-blue">Certificate Metadata</h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="rounded row align-items-center rounded m-2 shadow-sm">
                                    <div class="col-md-3 text-center">
                                        <?php
                                            $photoPath = FCPATH . 'uploads/users/pictures/' . ($createdBy['userPicture'] ?? '');
                                            $photoUrl = base_url('uploads/users/pictures/' . ($createdBy['userPicture'] ?? ''));
                                            $hasPhoto = !empty($createdBy['userPicture']) && file_exists($photoPath);
                                        ?>
                                        <?php if ($hasPhoto): ?>
                                            <img src="<?= $photoUrl ?>" alt="<?= esc($createdBy['userFullName']) ?>"
                                                 class="rounded-circle shadow-sm img-thumbnail"
                                                 style="width:100px;height:100px;object-fit:cover;">
                                        <?php else: ?>
                                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm img-thumbnail"
                                                 style="width:100px;height:100px;">
                                                <i class="fas fa-user text-muted fa-2x"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-9">
                                        <p class="mb-0"><strong>Uploaded by:</strong> <?= esc($createdBy['userFullName']) ?></p>
                                        <small class="mb-0"><strong>Position:</strong> <?= esc($createdBy['userPosition']) ?></small><br>
                                        <small class="mb-0"><strong>Email:</strong> <?= esc($createdBy['userEmail']) ?></small><br>
                                        <small class="mb-0"><strong>Created on:</strong> <?= date('M j, Y, g:i A', strtotime($certificate['created_at'])) ?></small><br>
                                        <small class="mb-0"><strong>Last Edited:</strong> <?= date('M j, Y, g:i A', strtotime($last_edited_at)) ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </重点

    <!-- ==================== FILE PREVIEW MODAL ==================== -->
    <div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filePreviewTitle">File Preview</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body p-0">
                    <div id="filePreviewContainer" style="height:70vh;"></div>
                </div>
                <div class="modal-footer">
                    <a href="#" id="fileDownloadLink" class="btn btn-sm btn-primary" download>Download</a>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== UPLOAD FILE MODAL ==================== -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header liberia-card-blue">
                    <h5 class="modal-title liberia-blue">Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="/dashboard/certificate_files/upload_file/<?= $certificate['marriage_cert_id'] ?>"
                      method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fileTitle" class="font-weight-bold">File Title</label>
                            <input type="text" class="form-control" id="fileTitle" name="fileTitle" required
                                   placeholder="Enter a descriptive title">
                        </div>
                        <div class="form-group">
                            <label for="fileUpload" class="font-weight-bold">Select File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="fileUpload" name="certificateFile"
                                       required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <label class="custom-file-label" for="fileUpload">Choose file...</label>
                            </div>
                            <small class="form-text text-muted">Max 5 MB. Supported: PDF, DOC, JPG, PNG</small>
                        </div>
                        <input type="hidden" name="certificateFile_category" value="marriage">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn liberia-btn-blue">Upload File</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        .signer-card { transition: background .2s; }
        .signer-card:hover { background: #f8f9fa; }
        .liberia-status-badge { font-size: .9rem; font-weight: 600; }
        .animate__pulse { animation-duration: 2s; }
    </style>

    <script>
        // File upload label
        document.getElementById('fileUpload')?.addEventListener('change', function (e) {
            const label = e.target.nextElementSibling;
            label.innerText = e.target.files[0]?.name || 'Choose file...';
        });

        // File preview modal
        document.querySelectorAll('.file-preview-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const title = this.dataset.title;
                const url   = this.dataset.url;
                const type  = this.dataset.type;
                document.getElementById('filePreviewTitle').textContent = title;
                document.getElementById('fileDownloadLink').href = url;
                const container = document.getElementById('filePreviewContainer');
                container.innerHTML = '';
                if (type === 'pdf') {
                    container.innerHTML = `<iframe src="${url}" class="w-100 h-100" style="border:none;"></iframe>`;
                } else if (['jpg','jpeg','png','gif'].includes(type)) {
                    container.innerHTML = `<img src="${url}" class="img-fluid h-100 w-100" style="object-fit:contain;">`;
                } else {
                    container.innerHTML = `
                        <div class="p-5 text-center text-muted">
                            <i class="fas fa-file-alt fa-3x mb-3"></i>
                            <p>Preview not available for .${type} files</p>
                            <a href="${url}" class="btn btn-primary btn-sm" download>Download to View</a>
                        </div>`;
                }
                $('#filePreviewModal').modal('show');
            });
        });
    </script>

<?= $this->endSection() ?>