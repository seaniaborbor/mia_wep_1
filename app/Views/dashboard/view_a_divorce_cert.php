<?php $this->extend('dashboard/partials/layout') ?>
<?= $this->section('main') ?>
<div class="row mt-3">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="text-dark mb-0 font-weight-bold">
                        Divorce Certificate Details
                    </h4>
                    <?php
                        $isCompleted = $certificate[0]['divorceSIGN_A'] && $certificate[0]['divorceSIGN_B'] && $certificate[0]['divorceSIGN_C'];
                        $anySignature = !empty($certificate[0]['divorceSIGN_A'])
                                     || !empty($certificate[0]['divorceSIGN_B'])
                                     || !empty($certificate[0]['divorceSIGN_C']);
                    ?>
                    <span class="badge badge-pill px-3 py-2 liberia-status-badge">
                        <?= $isCompleted ? 'Completed' : 'Pending' ?>
                    </span>
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
                                        <h3 class="mb-1 liberia-red">Divorce Certificate</h3>
                                        <p class="text-muted mb-0">
                                            <strong><?= esc($certificate[0]['divorceRefNo']) ?></strong>
                                        </p>
                                    </div>
                                    <div class="col-md-4 text-md-right">
                                        <div class="h5 mb-0 liberia-blue font-weight-bold">
                                            <?= esc($certificate[0]['divorceRefNo']) ?>
                                        </div>
                                        <small class="text-muted">Reference No</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Plaintiff & Defendant -->
                        <div class="row mb-4">
                            <!-- Plaintiff -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm liberia-card-red">
                                    <div class="card-header bg-white py-2 border-bottom">
                                        <h6 class="m-0 liberia-red">Plaintiff's Particulars</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p><span class="govt-label">Full Name:</span><br><?= esc($certificate[0]['divorceplaintiff']) ?></p>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <?php
                                                    $photoName = $certificate[0]['divorceplaintiffPic'] ?? '';
                                                    $photoPath = FCPATH . 'uploads/divorce/' . $photoName;
                                                    $photoUrl = base_url('uploads/divorce/' . $photoName);
                                                    $hasPhoto = !empty($photoName) && file_exists($photoPath);
                                                ?>
                                                <?php if ($hasPhoto): ?>
                                                    <img src="<?= $photoUrl ?>" alt="Plaintiff Photo"
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

                            <!-- Defendant -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm liberia-card-blue">
                                    <div class="card-header bg-white py-2 border-bottom">
                                        <h6 class="m-0 liberia-blue">Defendant's Particulars</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p><span class="govt-label">Full Name:</span><br><?= esc($certificate[0]['divorcedefendant']) ?></p>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <?php
                                                    $photoName = $certificate[0]['divorcedefendantPic'] ?? '';
                                                    $photoPath = FCPATH . 'uploads/divorce/' . $photoName;
                                                    $photoUrl = base_url('uploads/divorce/' . $photoName);
                                                    $hasPhoto = !empty($photoName) && file_exists($photoPath);
                                                ?>
                                                <?php if ($hasPhoto): ?>
                                                    <img src="<?= $photoUrl ?>" alt="Defendant Photo"
                                                         class="img-fluid rounded liberia-photo-border"
                                                         style="width:120px;height:120px;object-fit:cover;">
                                                <?php else: ?>
                                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center liberia-photo-border"
                                                         style="width:120px;height:120px;">
                                                        <i class="fas fa-user fa-3x liberia-red"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Divorce Details -->
                        <div class="card border-0 shadow-sm mb-4 liberia-card-red">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-red">Divorce Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <small class="text-muted">Date of Divorce</small>
                                        <p class="mb-1 font-weight-bold liberia-blue">
                                            <?= esc($certificate[0]['divorceDate'] ?? 'N/A') ?>
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Place of Divorce</small>
                                        <p class="mb-1 font-weight-bold liberia-red">
                                            <?= esc($certificate[0]['divorcePlace'] ?? 'N/A') ?>
                                        </p>
                                    </div>
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
                                                    <?php $file['file_type'] = pathinfo($file['certificateFile'], PATHINFO_EXTENSION); ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?= base_url('uploads/divorce_docs/' . $file['certificateFile']) ?>" target="_blank" class="text-decoration-none">
                                                                <?= esc($file['fileTitle']) ?>
                                                            </a>
                                                        </td>
                                                        <td><?= date('M j, Y', strtotime($file['fileCreatedAt'])) ?></td>
                                                        <td><?= esc($file['userFullName']) ?></td>
                                                        <td>
                                                            <a href="/dashboard/certificate_files/delete/<?= $file['fileId'] ?>/<?= $certificate[0]['divorceCertId'] ?>"
                                                               class="btn btn-sm btn-outline-danger"
                                                               onclick="return confirm('Delete this file?');"
                                                               title="Delete">
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

                        <!-- Signatories (Original Grid) -->
                        <div class="card border-0 shadow-sm liberia-card-blue">
                            <div class="card-header bg-white py-2 border-bottom d-flex justify-content-between align-items-center">
                                <h6 class="m-0 <?= $isCompleted ? 'liberia-blue' : 'liberia-red' ?>">Signatories</h6>
                                <?php if (!$isCompleted): ?>
                                    <span class="badge liberia-badge-red">Incomplete</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <?php foreach (['A', 'B', 'C'] as $sig): ?>
                                        <?php
                                            $sigKey = "divorceSIGN_{$sig}";
                                            $sigName = $certificate[0][$sigKey] ?? '';
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
                                                <?php else: ?>
                                                    <p class="mb-0 small text-muted">Not Signed</p>
                                                <?php endif; ?>
                                                <small class="d-block text-muted">Signatory <?= $sig ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
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
                                    <?php
                                        $userBranch = session()->get('userData')['userBreanch'] ?? '';
                                        $certBranch = $certificate[0]['divorcebreanch_id'] ?? '';
                                        $userAccountType = session()->get('userData')['userAccountType'] ?? '';
                                        $isSameBranch = ($userBranch == $certBranch);
                                        $canEdit = false;
                                        if ($isSameBranch) {
                                            if ($userAccountType === 'ENTRY' && !$anySignature) {
                                                $canEdit = true;
                                            } elseif ($userAccountType !== 'ENTRY' && $anySignature && $userAccountType === 'SIGNC') {
                                                $canEdit = true;
                                            }
                                        }
                                    ?>
                                    <?php if ($isSameBranch): ?>
                                        <?php if ($userAccountType === 'ENTRY' && !$anySignature): ?>
                                            <a href="/dashboard/edit_divorce_cert/<?= $certificate[0]['divorceCertId'] ?>"
                                               class="btn btn-sm liberia-btn-red">Edit</a>
                                        <?php endif; ?>
                                        <?php if ($userAccountType !== 'ENTRY'): ?>
                                            <?php if (!$anySignature): ?>
                                                <a href="/dashboard/divorce_cert/sign/<?= $certificate[0]['divorceCertId'] ?>"
                                                   class="btn btn-sm liberia-btn-blue">Sign</a>
                                            <?php else: ?>
                                                <?php if ($userAccountType === 'SIGNC'): ?>
                                                    <a href="/dashboard/divorce_cert/allow_edit/<?= $certificate[0]['divorceCertId'] ?>"
                                                       class="btn btn-sm liberia-btn-red">Allow Edit</a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <a href="/dashboard/divorce_cert/generate_certificate/<?= $certificate[0]['divorceCertId'] ?>"
                                           class="btn btn-sm liberia-btn-blue">Generate</a>
                                        <button onclick="window.print();" class="btn btn-sm liberia-btn-blue">Print</button>
                                        <?php if (!$anySignature): ?>
                                            <a href="/dashboard/divorce_cert/delete/<?= $certificate[0]['divorceCertId'] ?>"
                                               class="btn btn-sm btn-outline-danger"
                                               onclick="return confirm('Delete this certificate?');">Delete</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <a href="/divorcecert" class="btn btn-sm btn-outline-secondary">Back</a>
                                </div>
                            </div>
                        </div>

                        <!-- Editing Guidelines -->
                        <?php if ($userAccountType === 'ENTRY' && $canEdit): ?>
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
                                    <li class="mb-2">Check divorce details and costs.</li>
                                    <li class="mb-2">Confirm court and official info.</li>
                                </ul>
                                <hr>
                                <h6 class="text-secondary font-weight-bold">Important Note:</h6>
                                <p class="text-muted mb-0">Updating a certificate will <strong>replace the existing record</strong>.</p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Non-ENTRY edit notice -->
                        <?php if ($userAccountType !== 'ENTRY' && $canEdit): ?>
                        <div class="card shadow-sm border-0 mb-4 bg-light">
                            <div class="card-body text-center py-4">
                                <p class="mb-2">This certificate is <strong>subject to edit</strong>.</p>
                                <p class="text-muted small">Please review all details. If everything is correct, you may sign.</p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- ==================== YOUTUBE-STYLE SIGNATORY PROFILES ==================== -->
                        <?php
                        $signers = [];
                        if (!empty($signerProfiles['SIGNA_profile'])) {
                            $signers[] = array_merge($signerProfiles['SIGNA_profile'], ['signatoryLabel' => 'A']);
                        }
                        if (!empty($signerProfiles['SIGNB_profile'])) {
                            $signers[] = array_merge($signerProfiles['SIGNB_profile'], ['signatoryLabel' => 'B']);
                        }
                        if (!empty($signerProfiles['SIGNC_profile'])) {
                            $signers[] = array_merge($signerProfiles['SIGNC_profile'], ['signatoryLabel' => 'C']);
                        }
                        ?>
                        <?php if (!empty($signers)): ?>
                        <div class="card shadow-sm border-0 animate__animated animate__fadeInUp mb-4">
                            <div class="card-header bg-white py-2 border-bottom">
                                <h6 class="m-0 liberia-blue">Signatory Profiles</h6>
                            </div>
                            <div class="card-body ">
                                <?php foreach ($signers as $index => $signer): ?>
                                    <?php
                                        $photoPath = FCPATH . '/uploads/users/pictures/' . ($signer['userPicture'] ?? '');
                                        $photoUrl  = base_url('/uploads/users/pictures/' . ($signer['userPicture'] ?? ''));
                                        $hasPhoto  = !empty($signer['userPicture']) && file_exists($photoPath);
                                        $sigKey    = "divorceSIGN_" . $signer['signatoryLabel'];
                                        $hasSigned = !empty($certificate[0][$sigKey]);
                                        $delay = 0.1 + ($index * 0.15);
                                    ?>
                                    <div class="p-3 border-bottom shadow-sm my-3 signer-youtube-card animate__animated animate__zoomIn"
                                         style="animation-delay: <?= $delay ?>s;">
                                        <!-- Header (blue banner) -->
                                        <div class="youtube-header rounded-top">
                                            <div class="youtube-avatar-wrapper">
                                                <?php if ($hasPhoto): ?>
                                                    <img src="<?= $photoUrl ?>" alt="<?= esc($signer['userFullName']) ?>" class="youtube-avatar">
                                                <?php else: ?>
                                                    <div class="youtube-avatar bg-light d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-user fa-2x text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <!-- Body -->
                                        <div class="p-3 text-center">
                                            <h6 class="mb-0 font-weight-bold text-dark"><?= esc($signer['userFullName']) ?></h6>
                                            <p class="text-muted small mb-2">
                                                Signatory <?= $signer['signatoryLabel'] ?> – <?= esc($signer['userPosition']) ?>
                                            </p>

                                            <!-- Stats -->
                                            <div class="d-flex justify-content-center gap-3 mb-3 text-muted small">
                                                <div>
                                                    <strong><?= $hasSigned ? 'Signed' : 'Pending' ?></strong>
                                                </div>
                                                <div>
                                                    <strong><?= $hasSigned ? 'Done' : 'Waiting' ?></strong>
                                                </div>
                                            </div>

                                            <!-- Button -->
                                            <button class="btn btn-sm <?= $hasSigned ? 'btn-success' : 'btn-outline-primary' ?> w-100 youtube-btn"
                                                    <?= $hasSigned ? 'disabled' : '' ?>>
                                                <?= $hasSigned ? 'Signed' : 'Awaiting Signature' ?>
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== UPLOAD FILE MODAL ==================== -->
<div class="modal fade" id="uploadFileModal" tabindex="-1" role="dialog" aria-labelledby="uploadFileModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header liberia-card-blue">
                <h5 class="modal-title liberia-blue" id="uploadFileModalLabel">Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/dashboard/certificate_files/upload_file/<?= $certificate[0]['divorceCertId'] ?>"
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
                    <input type="hidden" name="certificateFile_category" value="divorce">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn liberia-btn-blue">Upload File</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Animate.css CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* YOUTUBE-STYLE SIGNATORY CARD */
    .signer-youtube-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        transition: all .3s ease;
        margin-bottom: 0 !important;
    }
    .signer-youtube-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0,0,0,.12);
    }

    .youtube-header {
        background: linear-gradient(135deg, #4285f4, #34a853);
        height: 60px;
        position: relative;
    }
    .youtube-avatar-wrapper {
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        width: 72px;
        height: 72px;
        border: 4px solid #fff;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,.2);
    }
    .youtube-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .youtube-btn {
        border-radius: 20px;
        font-weight: 600;
        transition: all .2s;
    }
    .youtube-btn:hover {
        transform: scale(1.05);
    }
</style>

<script>
    // File input label
    document.getElementById('fileUpload')?.addEventListener('change', function (e) {
        const label = e.target.nextElementSibling;
        label.innerText = e.target.files[0]?.name || 'Choose file...';
    });
</script>
<?= $this->endSection() ?>