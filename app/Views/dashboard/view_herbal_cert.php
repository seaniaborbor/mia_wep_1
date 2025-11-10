<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>
<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header d-flex justify-content-between border-bottom-primary py-3">
                <div>
                    <h1 class="h3 mb-0 text-primary font-weight-bold">
                        <i class="fas fa-leaf text-success mr-2"></i>
                        Culture Certificate Details
                        <p style="font-size:13px; margin-left: 50px;" class="text-danger mb-0">
                            <?php if(isset($certificate['branchName']) && !empty($certificate['branchName'])): ?>
                                <?= htmlspecialchars($certificate['branchName']) ?>
                            <?php else: ?> 
                                <?= htmlspecialchars(session()->get('userData')['branchName'] ?? 'Unknown Branch') ?>
                            <?php endif; ?>
                        </p>
                    </h1>
                </div>
                <div class="d-flex align-items-center">
                    <?php
                        $signA = !empty($certificate['tradCertSignatoryA']);
                        $signB = !empty($certificate['tradCertSignatoryB']);
                        $signC = !empty($certificate['tradCertSignatoryC']);
                        $isCompleted = $signA && $signB && $signC;
                        $allMissing = !$signA && !$signB && !$signC;
                        $userBranch = session()->get('userData')['userBreanch'] ?? '';
                        $certBranch = $certificate['tradCertBranch'] ?? '';
                        $userAccountType = session()->get('userData')['userAccountType'] ?? '';
                        $isSameBranch = ($userBranch == $certBranch);
                    ?>
                    
                    <!-- Generate Button -->
                    <a href="/dashboard/nativecert/print/<?= $certificate['tradCertId'] ?>" 
                       class="btn btn-sm btn-primary btn-icon-split mr-2">
                        <span class="icon text-white-50">
                            <i class="fas fa-file-pdf"></i>
                        </span>
                        <span class="text">Generate</span>
                    </a>
                    
                    <!-- Print Button -->
                    <button onclick="window.print();" class="btn btn-sm btn-info btn-icon-split mr-2">
                        <span class="icon text-white-50">
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Print</span>
                    </button>
                    
                    <!-- Sign Button (for non-ENTRY users when not completed) -->
                    <?php if ($isSameBranch && $userAccountType !== 'tradCertEntryClerk' && !$isCompleted): ?>
                    <a href="/nativecert/add-signatories/<?= $certificate['tradCertId'] ?>" 
                       class="btn btn-sm btn-success btn-icon-split mr-2">
                        <span class="icon text-white-50">
                            <i class="fas fa-signature"></i>
                        </span>
                        <span class="text">Sign</span>
                    </a>
                    <?php endif; ?>

                    <!-- Edit Button (for ENTRY users when no signatures) -->
                    <?php if ($isSameBranch && $userAccountType === 'tradCertEntryClerk' && $allMissing): ?>
                    <a href="/dashboard/nativecert/edit/<?= $certificate['tradCertId'] ?>" 
                       class="btn btn-sm btn-warning btn-icon-split mr-2">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Edit</span>
                    </a>
                    <?php endif; ?>

                    <!-- Allow Edit Button (for SIGNC users when complete) -->
                    <?php if ($isSameBranch && $userAccountType === 'SIGNC' && $isCompleted): ?>
                    <a href="/dashboard/nativecert/allow_edit/<?= $certificate['tradCertId'] ?>" 
                       class="btn btn-sm btn-secondary btn-icon-split mr-2">
                        <span class="icon text-white-50">
                            <i class="fas fa-unlock"></i>
                        </span>
                        <span class="text">Allow Edit</span>
                    </a>
                    <?php endif; ?>

                    <!-- Back Button -->
                    <a href="/nativecert" class="btn btn-sm btn-dark btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Back</span>
                    </a>
                </div>
            </div>
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
                                        <h3 class="mb-1 liberia-red">Herbal Certificate</h3>
                                        <p class="text-muted mb-0">
                                            <strong><?= esc($certificate['tradCertSn']) ?></strong>
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-right">
                                        <div class="h5 mb-0 liberia-blue font-weight-bold">
                                            <?= esc($certificate['tradCertCevNo']) ?>
                                        </div>
                                        <small class="text-muted">CEV Number</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Holder & Location -->
                        <div class="row mb-4">
                            <!-- Holder -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm liberia-card-red">
                                    <div class="card-header bg-white py-2 border-bottom">
                                        <h6 class="m-0 liberia-red">Holder's Particulars</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p><span class="govt-label">Full Name:</span><br><?= esc($certificate['tradCertHolderName']) ?></p>
                                                <p><span class="govt-label">Operation Type:</span> <?= ucfirst(str_replace('_', ' ', $certificate['tradCertHolderOperationType'])) ?></p>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <?php
                                                    $photoName = $certificate['tradCertHolderPic'] ?? '';
                                                    $photoPath = FCPATH . 'uploads/certificate_holders/' . $photoName;
                                                    $photoUrl = base_url('uploads/certificate_holders/' . $photoName);
                                                    $hasPhoto = !empty($photoName) && file_exists($photoPath);
                                                ?>
                                                <?php if ($hasPhoto): ?>
                                                    <img src="<?= $photoUrl ?>" alt="Holder Photo"
                                                         class="img-fluid rounded shadow-sm liberia-photo-border"
                                                         style="width:120px;height:120px;object-fit:cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm liberia-photo-border"
                                                         style="width:120px;height:120px;">
                                                        <i class="fas fa-user fa-3x liberia-red"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm liberia-card-blue">
                                    <div class="card-header bg-white py-2 border-bottom">
                                        <h6 class="m-0 liberia-blue">Location</h6>
                                    </div>
                                    <div class="card-body">
                                        <p><span class="govt-label">Town/City:</span><br><?= esc($certificate['tradCertHolderTownorCity']) ?></p>
                                        <p class="mb-0"><span class="govt-label">District / County:</span><br>
                                            <?= esc($certificate['tradCertHolderDistrict'] ?? '—') . ', ' . esc($certificate['tradCertHoldercounty']) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Certificate Details -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-red">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-red">Certificate Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <small class="text-muted">Date Issued</small>
                                        <p class="mb-1 font-weight-bold liberia-blue">
                                            <?= $certificate['tradCertDateIssued']
                                                ? date('M j, Y', strtotime($certificate['tradCertDateIssued']))
                                                : 'N/A' ?>
                                        </p>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted">Expires</small>
                                        <p class="mb-1 font-weight-bold liberia-red">
                                            <?= $certificate['tradCertDateIssued']
                                                ? date('M j, Y', strtotime($certificate['tradCertDateIssued'] . ' + ' . $certificate['tradCertDuration'] . ' days'))
                                                : 'N/A' ?>
                                        </p>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <small class="text-muted">Duration</small>
                                        <p class="mb-1">
                                            <span class="badge liberia-badge-blue">
                                                <?= ucfirst($certificate['tradCertDuration']) ?> Days
                                            </span>
                                        </p>
                                    </div>
                                    <?php if (!empty($certificate['tradRevenueNo'])): ?>
                                    <div class="col-sm-4">
                                        <small class="text-muted">Revenue No</small>
                                        <p class="mb-1"><?= esc($certificate['tradRevenueNo']) ?></p>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($certificate['tradRevenueNo'])): ?>
                                    <div class="col-sm-4">
                                        <small class="text-muted">Amount Paid</small>
                                        <p class="mb-1">$<?= esc($certificate['tradCertAmtPaid']) ?>USD</p>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($certificate['tradRevenueNo'])): ?>
                                    <div class="col-sm-4">
                                        <small class="text-muted">Application Type</small>
                                        <p class="mb-1"><?= esc($certificate['tradCertAppliedType']) ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Attached Files -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="m-0 liberia-blue">Attached Files</h6>
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
                                                        $fileUrl = base_url($filePath);
                                                        $fileExt = strtolower(pathinfo($file['certificateFile'], PATHINFO_EXTENSION));
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
                                                            <a href="/dashboard/certificate_files/delete/<?= $file['fileId'] ?>/<?= $certificate['tradCertId'] ?>"
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
                                <h6 class="m-0 <?= $isCompleted ? 'liberia-blue' : 'liberia-red' ?>">Signatories</h6>
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
                                            $sigKey = "tradCertSignatory{$sig}";
                                            $sigDateKey = "tradCertSignatory{$sig}Date";
                                            $sigName = $certificate[$sigKey] ?? '';
                                            $sigDate = $certificate[$sigDateKey] ?? '';
                                            $sigPath = FCPATH . "uploads/users/signatures/{$sigName}";
                                            $sigUrl = base_url("uploads/users/signatures/{$sigName}");
                                            $hasSig = !empty($sigName) && file_exists($sigPath);
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
                                <div class="row">
                                    <?php if($isCompleted && !$isIssued): ?>
                                        <p>The certificate is completed but has not been marked as issued. Please 
                                            mark it as issued by clicking <a href="/dashboard/nativecert/issue-certificate/<?= $certificate['tradCertId'] ?>">here</a>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== SIDEBAR ==================== -->
                    <div class="col-lg-4">
                        <!-- Actions -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-blue">Actions</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <?php if ($isSameBranch): ?>
                                        <!-- ENTRY user: Edit & Delete only if NO signatures -->
                                        <?php if ($userAccountType === 'tradCertEntryClerk' && $allMissing): ?>
                                            <a href="/dashboard/nativecert/edit/<?= $certificate['tradCertId'] ?>"
                                               class="btn btn-sm liberia-btn-red">Edit</a>
                                            <a href="/dashboard/nativecert/delete/<?= $certificate['tradCertId'] ?>"
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Delete this certificate?');">Delete</a>
                                        <?php endif; ?>

                                        <!-- Non-ENTRY: Sign if not complete -->
                                        <?php if ($userAccountType !== 'tradCertEntryClerk' && !$isCompleted): ?>
                                            <a href="/nativecert/add-signatories/<?= $certificate['tradCertId'] ?>"
                                               class="btn btn-sm liberia-btn-blue">Sign</a>
                                        <?php endif; ?>

                                        <!-- Allow Edit: ONLY for SIGNC when document is complete -->
                                        <?php if ($userAccountType === 'SIGNC'): ?>
                                            <a href="/dashboard/nativecert/allow_edit/<?= $certificate['tradCertId'] ?>"
                                               class="btn btn-sm liberia-btn-red">Allow Edit</a>
                                        <?php endif; ?>

                                        <!-- Always available -->
                                        <a href="/dashboard/nativecert/generate_certificate/<?= $certificate['tradCertId'] ?>"
                                           class="btn btn-sm liberia-btn-blue">Generate</a>
                                        <button onclick="window.print();" class="btn btn-sm liberia-btn-blue">Print</button>
                                    <?php endif; ?>
                                    <a href="/nativecert" class="btn btn-sm btn-outline-secondary">Back</a>
                                </div>
                            </div>
                        </div>

                        <!-- Editing Guidelines -->
                        <?php if ($userAccountType === 'tradCertEntryClerk' && $allMissing): ?>
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-primary text-white py-3">
                                <h5 class="mb-0">Editing Guidelines</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">Please review all information carefully before saving changes.</p>
                                <ul class="list-unstyled">
                                    <li class="mb-2">Ensure holder name, town, district and county are accurate.</li>
                                    <li class="mb-2">Verify operation type and revenue number.</li>
                                    <li class="mb-2">Replace photo only if necessary.</li>
                                    <li class="mb-2">Check issue date and duration.</li>
                                    <li class="mb-2">Confirm CEV number and serial number.</li>
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

                        <!-- Signatory Profiles -->
                        <?php
                        $signers = [];
                        foreach (['A','B','C'] as $lbl) {
                            $key = "tradCertSignatory{$lbl}";
                            if (!empty($signerProfiles[$key])) {
                                $signers[] = array_merge($signerProfiles[$key], ['signatoryLabel' => $lbl]);
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
                                        $photoUrl = base_url('/uploads/users/pictures/' . ($signer['userPicture'] ?? ''));
                                        $hasPhoto = !empty($signer['userPicture']) && file_exists($photoPath);
                                        $sigKey = "tradCertSignatory" . $signer['signatoryLabel'];
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

                        <!-- Certificate History -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-blue">Certificate History</h6>
                            </div>
                            <div class="card-body p-0">
                                <!-- Created By -->
                                <?php if (!empty($tradCertInsertedBy)): ?>
                                    <div class="p-3 border-bottom signer-card">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <?php
                                                    $creatorPhotoPath = FCPATH . '/uploads/users/pictures/' . ($tradCertInsertedBy['userPicture'] ?? '');
                                                    $creatorPhotoUrl = base_url('/uploads/users/pictures/' . ($tradCertInsertedBy['userPicture'] ?? ''));
                                                    $creatorHasPhoto = !empty($tradCertInsertedBy['userPicture']) && file_exists($creatorPhotoPath);
                                                ?>
                                                <?php if ($creatorHasPhoto): ?>
                                                    <img src="<?= $creatorPhotoUrl ?>" alt="<?= esc($tradCertInsertedBy['userFullName']) ?>"
                                                         class="rounded-circle shadow-sm" style="width:50px;height:50px;object-fit:cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width:50px;height:50px;">
                                                        <i class="fas fa-user text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <h6 class="mb-0"><?= esc($tradCertInsertedBy['userFullName']) ?></h6>
                                                <small class="text-muted">
                                                    Created By - <?= esc($tradCertInsertedBy['userPosition']) ?>
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    <?= date('M j, Y g:i A', strtotime($certificate['tradCertCertCreatedAt'])) ?>
                                                </small>
                                            </div>
                                            <div>
                                                <span class="badge badge-info badge-pill">
                                                    Creator
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Last Updated By -->
                                <?php if (!empty($tradCertLastUpdatedBy) && is_array($tradCertLastUpdatedBy) && $tradCertLastUpdatedBy['userId'] != $certificate['tradCertInsertedBy']): ?>
                                    <div class="p-3 border-bottom signer-card">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <?php
                                                    $updaterPhotoPath = FCPATH . '/uploads/users/pictures/' . ($tradCertLastUpdatedBy['userPicture'] ?? '');
                                                    $updaterPhotoUrl = base_url('/uploads/users/pictures/' . ($tradCertLastUpdatedBy['userPicture'] ?? ''));
                                                    $updaterHasPhoto = !empty($tradCertLastUpdatedBy['userPicture']) && file_exists($updaterPhotoPath);
                                                ?>
                                                <?php if ($updaterHasPhoto): ?>
                                                    <img src="<?= $updaterPhotoUrl ?>" alt="<?= esc($tradCertLastUpdatedBy['userFullName']) ?>"
                                                         class="rounded-circle shadow-sm" style="width:50px;height:50px;object-fit:cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width:50px;height:50px;">
                                                        <i class="fas fa-user text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <h6 class="mb-0"><?= esc($tradCertLastUpdatedBy['userFullName']) ?></h6>
                                                <small class="text-muted">
                                                    Last Edited By - <?= esc($tradCertLastUpdatedBy['userPosition']) ?>
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    <?= date('M j, Y g:i A', strtotime($certificate['tradCertLastUpdatedAt'])) ?>
                                                </small>
                                            </div>
                                            <div>
                                                <span class="badge badge-warning badge-pill">
                                                    Editor
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php elseif (!empty($certificate['tradCertLastUpdatedAt']) && $certificate['tradCertLastUpdatedAt'] != $certificate['tradCertCertCreatedAt']): ?>
                                    <!-- Show update timestamp even if same user but different time -->
                                    <div class="p-3 border-bottom signer-card">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                     style="width:50px;height:50px;">
                                                    <i class="fas fa-edit text-muted"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ml-3">
                                                <h6 class="mb-0">Last Updated</h6>
                                                <small class="text-muted">
                                                    <?= date('M j, Y g:i A', strtotime($certificate['tradCertLastUpdatedAt'])) ?>
                                                </small>
                                                <?php if (!empty($tradCertLastUpdatedBy) && is_array($tradCertLastUpdatedBy) && $tradCertLastUpdatedBy['userId'] == $certificate['tradCertInsertedBy']): ?>
                                                    <br>
                                                    <small class="text-muted">
                                                        (by <?= esc($tradCertLastUpdatedBy['userFullName']) ?>)
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== FILE PREVIEW MODAL ==================== -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filePreviewTitle">File Preview</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div id="filePreviewContainer" style="height:70vh;">
                    <!-- Injected via JS -->
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" id="fileDownloadLink" class="btn btn-sm btn-primary" download>
                    Download
                </a>
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
                <button type="button" class="close" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <form action="/dashboard/certificate_files/upload_file/<?= $certificate['tradCertId'] ?>"
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
                                   required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.xls,.txt">
                            <label class="custom-file-label" for="fileUpload">Choose file...</label>
                        </div>
                        <small class="form-text text-muted">Max 2 MB. Supported: PDF, DOC, JPG, PNG, XLS, TXT</small>
                    </div>
                    <input type="hidden" name="certificateFile_category" value="traditional">
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
    .signer-card {
        transition: background .2s;
    }
    .signer-card:hover {
        background: #f8f9fa;
    }
    .liberia-status-badge {
        font-size: 0.9rem;
        font-weight: 600;
    }
    .animate__pulse {
        animation-duration: 2s;
    }
</style>

<script>
    // File Upload Label
    document.getElementById('fileUpload')?.addEventListener('change', function (e) {
        const label = e.target.nextElementSibling;
        label.innerText = e.target.files[0]?.name || 'Choose file...';
    });

    // File Preview Modal
    document.querySelectorAll('.file-preview-link').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const title = this.dataset.title;
            const url = this.dataset.url;
            const type = this.dataset.type;
            document.getElementById('filePreviewTitle').textContent = title;
            document.getElementById('fileDownloadLink').href = url;
            const container = document.getElementById('filePreviewContainer');
            container.innerHTML = '';
            if (type === 'pdf') {
                container.innerHTML = `<iframe src="${url}" class="w-100 h-100" style="border:none;"></iframe>`;
            } else if (['jpg', 'jpeg', 'png', 'gif'].includes(type)) {
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